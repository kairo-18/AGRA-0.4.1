<?php

namespace App\Filament\Widgets;

use App\Models\Section;
use App\Models\Task;
use App\Models\TaskScore;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Log;

class SectionPerformanceWidget extends ChartWidget
{
    protected static ?string $heading = 'Chart';

    protected function getData(): array
    {
        // Fetch all sections (or a specific section as needed)
        $sections = Section::all();

        // Initialize an empty array to store dataset for each section
        $datasets = [];
        $colors = ['rgba(255, 99, 132, 0.5)', 'rgba(54, 162, 235, 0.5)', 'rgba(75, 192, 192, 0.5)'];  // Colors for different sections
        $borderColors = ['rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)', 'rgba(75, 192, 192, 1)'];  // Border colors for different sections

        $i = 0;
        $courses = []; // Initialize an empty array to store course names

        // Iterate through each section to fetch performance data for its users
        foreach ($sections as $section) {
            // Get courses for this section and add their names to the $courses array
            foreach ($section->courses as $course) {
                if (!in_array($course->CourseName, $courses)) {
                    $courses[] = $course->CourseName;  // Add the course name to the courses array
                }
            }

            // Fetch task data for each section's users
            $taskData = $this->fetchUserDataBySection($section);

            // Extract the overall performance data for each course in the section
            $sectionPerformance = [];
            foreach ($courses as $courseName) {
                // Ensure we have valid data for each course, and calculate the overall performance for that course
                $performance = 0;  // Default to 0 if no data is available for the course
                if (isset($taskData[$courseName])) {
                    // Calculate the performance for the course
                    $performanceData = $this->calculateOverallPerformanceByCourse($taskData[$courseName]);

                    Log::error($performanceData["overallPerformance"]);
                    if (is_array($performanceData) && isset($performanceData['overallPerformance'])) {
                        $performance = $performanceData['overallPerformance'];
                    }
                }

                // Store the overall performance for the course
                $sectionPerformance[] = $performance;
            }

            // Create dataset for this section
            $datasets[] = [
                'label' => $section->SectionCode,  // Section name as the label for the chart
                'data' => $sectionPerformance,  // Data for each course's overall performance
                'backgroundColor' => $colors[$i % count($colors)],  // Color for the section
                'borderColor' => $borderColors[$i % count($borderColors)],  // Border color for the section
                'borderWidth' => 1,
            ];


            $i++;  // Increment color index for the next section
        }

        // Return the chart data with datasets and course labels
        return [
            'datasets' => $datasets,
            'labels' => $courses,  // X-axis labels (course names)
        ];


    }



    protected function getType(): string
    {
        return 'bar';
    }

    public function getColumnSpan(): int | string | array
    {
        return 'full'; // Options: 'full', 1, 2, 3, 4, etc.
    }

    function fetchUserDataBySection($section) {
        // Initialize an empty array to store task data per course
        $taskData = [];

        // Fetch all users in the section
        $users = $section->users; // Assuming the Section model has a `users` relationship

        // Loop through all users in the section
        foreach ($users as $user) {
            // Fetch task scores for the current user
            $taskScores = TaskScore::where('user_id', $user->id)->get();

            // Loop through each task score for the user
            foreach ($taskScores as $taskScore) {
                // Retrieve the task using task_id
                $task = Task::find($taskScore->task_id);

                if ($task) {
                    // Retrieve the course and category name
                    $courseName = $task->lesson->course->CourseName;
                    $categoryName = $task->lesson->course->category->name;

                    // Fetch score details from the Score model
                    $score = \App\Models\Score::find($taskScore->score_id);

                    // Check if $score is found
                    if ($score) {
                        // Initialize course data if it doesn't exist in the taskData array
                        if (!isset($taskData[$courseName])) {
                            $taskData[$courseName] = [
                                'errors' => [],
                                'timeTaken' => [],
                                'timeLeft' => [],
                                'score' => [],
                                'maxScore' => [],
                                'categories' => []
                            ];
                        }

                        // Add the task data (even for the first attempt) without removing anything
                        $taskData[$courseName]['errors'][] = $taskScore->Errors;
                        $taskData[$courseName]['timeTaken'][] = $taskScore->TimeTaken;
                        $taskData[$courseName]['timeLeft'][] = $taskScore->TimeLeft;
                        $taskData[$courseName]['score'][] = $score->score;
                        $taskData[$courseName]['maxScore'][] = $score->MaxScore;
                        $taskData[$courseName]['categories'][] = 'Task ' . $taskScore->task_id;
                    } else {
                        // Handle the case where the score is not found
                        // Optionally log this issue or store a default value
                        // $taskData[$courseName]['score'][] = 0; // Example of default value
                    }
                }
            }
        }

        // Ensure no data is removed prematurely on the first attempt
        foreach ($taskData as $courseName => &$data) {
            // Only remove the default values if actual data exists
            if (count($data['categories']) > 0) {
                // This check ensures we do not accidentally remove the first data entry
                // Remove the initial default 0 values only if more than one entry exists
                if (count($data['categories']) > 1) {
                    array_shift($data['errors']);
                    array_shift($data['timeTaken']);
                    array_shift($data['timeLeft']);
                    array_shift($data['score']);
                    array_shift($data['maxScore']);
                    array_shift($data['categories']);
                }
            }
        }

        return $taskData;
    }


    function calculateOverallPerformanceByCourse($courseData) {
        // Initialize variables to calculate performance metrics for the course
        $taskCourseAccuracy = [];
        $taskCourseCodingSpeed = [];
        $taskCourseScore = [];

        $overallAccuracy = 0;
        $overallSpeed = 0;
        $overallScore = 0;
        $overallPerformance = 0;

        // Get the total number of tasks in the course
        $totalTasks = isset($courseData['categories']) ? count($courseData['categories']) : 0;

        // If there are tasks in the course, process them
        if ($totalTasks > 0) {
            // Iterate through course tasks for accuracy and score
            foreach ($courseData['score'] as $index => $score) {
                $accuracy = calculateAccuracy(
                    $score,
                    $courseData['maxScore'][$index],
                    $courseData['errors'][$index]
                );
                $score = calculateScore($courseData['score'][$index], $courseData['maxScore'][$index]);

                $taskCourseAccuracy[] = $accuracy;
                $taskCourseScore[] = $score;

                $overallScore += $score;
                $overallAccuracy += $accuracy;
            }

            // Iterate through course tasks for coding speed
            foreach ($courseData['timeLeft'] as $index => $timeLeft) {
                $speed = calculateCodingSpeed($timeLeft, $courseData['timeTaken'][$index]);
                $taskCourseCodingSpeed[] = $speed;
                $overallSpeed += $speed;
            }

            // Calculate overall accuracy, speed, and score for this course
            $courseAccuracy = $overallAccuracy / $totalTasks;
            $courseSpeed = $overallSpeed / $totalTasks;
            $courseScore = $overallScore / $totalTasks;

            // Calculate the overall performance for this course
            $coursePerformance = ($courseScore + $courseSpeed + $courseAccuracy) / 3;
            $overallPerformance = $coursePerformance;
        }

        // Return the overall performance data for this course
        return [
            'overallAccuracy' => $courseAccuracy,
            'overallSpeed' => $courseSpeed,
            'overallScore' => $courseScore,
            'overallPerformance' => $overallPerformance,
            'taskCourseAccuracy' => $taskCourseAccuracy,
            'taskCourseCodingSpeed' => $taskCourseCodingSpeed,
            'taskCourseScore' => $taskCourseScore,
        ];
    }

    function calculateAccuracy($score, $maxScore, $errors, $errorPenaltyPercent = 1.5) {
        // Calculate the base accuracy as a percentage

        // Calculate the penalty per error as a percentage
        //20  * 0.2 = 0.4
        $basePenalty = ($maxScore * 0.02);

        //Calculate error percentage
        //5 errors = 2
        $errorPenalty = $basePenalty * $errors;

        // Calculate adjusted accuracy by deducting the penalty for errors
        $adjustedAccuracy = $maxScore - $errorPenalty;
        $adjustedAccuracy = ($adjustedAccuracy / $maxScore) * 100;

        // Ensure adjusted accuracy doesn't go below 0
        $adjustedAccuracy = max($adjustedAccuracy, 0);

        // Round the accuracy to two decimal places for precision
        $adjustedAccuracy = round($adjustedAccuracy, 2);

        return $adjustedAccuracy;
    }

    function calculateScore($score, $maxScore){
        return ($score / $maxScore) * 100;
    }

    function calculateCodingSpeed($timeLeft, $timeTaken) {
        // Ensure timeLeft and timeTaken are non-negative
        $timeLeft = max($timeLeft, 0);
        $timeTaken = max($timeTaken, 0);

        // Calculate total time spent coding
        $totalTime = $timeTaken + $timeLeft;

        // Check if the user has more than 50% of time left
        if ($timeLeft / $totalTime > 0.5) {
            return 5 * 20; // Set coding speed to 5
        } else {
            // Calculate the percentage of time left
            $percentageTimeLeft = ($timeLeft / $totalTime) * 100;

            // Calculate rating based on percentage of time left
            $rating = max(1, $percentageTimeLeft / 10) * 20;

            return round($rating, 1);
        }
    }



}
