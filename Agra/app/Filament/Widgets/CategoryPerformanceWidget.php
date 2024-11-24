<?php

namespace App\Filament\Widgets;

use App\Models\Section;
use App\Models\Task;
use App\Models\TaskScore;
use Filament\Widgets\ChartWidget;

class CategoryPerformanceWidget extends ChartWidget
{
    protected static ?string $heading = 'Section Performance per Topic';
    protected static ?int $sort = 2;
    protected function getData(): array
    {
        // Fetch all sections
        $sections = Section::all();

        // Initialize an empty array to store dataset for each section
        $datasets = [];
        $colors = ['rgba(255, 99, 132, 0.5)', 'rgba(54, 162, 235, 0.5)', 'rgba(75, 192, 192, 0.5)'];  // Colors for different sections
        $borderColors = ['rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)', 'rgba(75, 192, 192, 1)'];  // Border colors for different sections

        $i = 0;
        $categories = []; // Initialize an empty array to store category names

        // Iterate through each section to fetch performance data for its users
        foreach ($sections as $section) {
            // Fetch task data grouped by categories for this section
            $taskData = $this->fetchUserDataByLessonCategory($section);

            // Collect all unique category names across all sections
            foreach ($taskData as $categoryName => $data) {
                if (!in_array($categoryName, $categories)) {
                    $categories[] = $categoryName;
                }
            }

            // Extract the overall performance data for each category in the section
            $sectionPerformance = [];
            foreach ($categories as $categoryName) {
                // Default performance to 0 if no data is available for the category
                $performance = 0;

                if (isset($taskData[$categoryName])) {
                    // Calculate the performance for the category
                    $performanceData = $this->calculateOverallPerformanceByCategory($taskData[$categoryName]);

                    if (is_array($performanceData) && isset($performanceData['overallPerformance'])) {
                        $performance = $performanceData['overallPerformance'];
                    }
                }

                // Store the overall performance for the category
                $sectionPerformance[] = $performance;
            }

            // Create dataset for this section
            $datasets[] = [
                'label' => $section->SectionCode,  // Section name as the label for the chart
                'data' => $sectionPerformance,  // Data for each category's overall performance
                'backgroundColor' => $colors[$i % count($colors)],  // Color for the section
                'borderColor' => $borderColors[$i % count($borderColors)],  // Border color for the section
                'borderWidth' => 1,
            ];

            $i++;  // Increment color index for the next section
        }

        // Return the chart data with datasets and category labels
        return [
            'datasets' => $datasets,
            'labels' => $categories,  // X-axis labels (category names)
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

    function calculateOverallPerformanceByCategory($categoryData)
    {
        // Initialize variables to calculate performance metrics for the category
        $taskCategoryAccuracy = [];
        $taskCategoryCodingSpeed = [];
        $taskCategoryScore = [];

        $overallAccuracy = 0;
        $overallSpeed = 0;
        $overallScore = 0;
        $overallPerformance = 0;

        // Get the total number of tasks in the category
        $totalTasks = isset($categoryData['tasks']) ? count($categoryData['tasks']) : 0;

        // If there are tasks in the category, process them
        if ($totalTasks > 0) {
            // Iterate through category tasks for accuracy and score
            foreach ($categoryData['score'] as $index => $score) {
                $accuracy = calculateAccuracy(
                    $score,
                    $categoryData['maxScore'][$index],
                    $categoryData['errors'][$index]
                );
                $scorePercentage = calculateScore($score, $categoryData['maxScore'][$index]);

                $taskCategoryAccuracy[] = $accuracy;
                $taskCategoryScore[] = $scorePercentage;

                $overallScore += $scorePercentage;
                $overallAccuracy += $accuracy;
            }

            // Iterate through category tasks for coding speed
            foreach ($categoryData['timeLeft'] as $index => $timeLeft) {
                $speed = calculateCodingSpeed($timeLeft, $categoryData['timeTaken'][$index]);
                $taskCategoryCodingSpeed[] = $speed;
                $overallSpeed += $speed;
            }

            // Calculate overall accuracy, speed, and score for this category
            $categoryAccuracy = $overallAccuracy / $totalTasks;
            $categorySpeed = $overallSpeed / $totalTasks;
            $categoryScore = $overallScore / $totalTasks;

            // Calculate the overall performance for this category
            $categoryPerformance = ($categoryScore + $categorySpeed + $categoryAccuracy) / 3;
            $overallPerformance = $categoryPerformance;
        }

        // Return the overall performance data for this category
        return [
            'overallAccuracy' => $categoryAccuracy ?? 0,
            'overallSpeed' => $categorySpeed ?? 0,
            'overallScore' => $categoryScore ?? 0,
            'overallPerformance' => $overallPerformance,
            'taskCategoryAccuracy' => $taskCategoryAccuracy,
            'taskCategoryCodingSpeed' => $taskCategoryCodingSpeed,
            'taskCategoryScore' => $taskCategoryScore,
        ];
    }


    function fetchUserDataByLessonCategory($section)
    {
        // Initialize an empty array to store task data per lesson category
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
                    // Retrieve the lesson and its categories
                    $lesson = $task->lesson;
                    $categories = $lesson->categories; // Assuming the Lesson model has a `categories` relationship

                    foreach ($categories as $category) {
                        $categoryName = $category->name; // Access category name

                        // Fetch score details from the Score model
                        $score = \App\Models\Score::find($taskScore->score_id);

                        // Check if $score is found
                        if ($score) {
                            // Initialize category data if it doesn't exist in the taskData array
                            if (!isset($taskData[$categoryName])) {
                                $taskData[$categoryName] = [
                                    'errors' => [],
                                    'timeTaken' => [],
                                    'timeLeft' => [],
                                    'score' => [],
                                    'maxScore' => [],
                                    'tasks' => []
                                ];
                            }

                            // Add the task data (even for the first attempt) without removing anything
                            $taskData[$categoryName]['errors'][] = $taskScore->Errors;
                            $taskData[$categoryName]['timeTaken'][] = $taskScore->TimeTaken;
                            $taskData[$categoryName]['timeLeft'][] = $taskScore->TimeLeft;
                            $taskData[$categoryName]['score'][] = $score->score;
                            $taskData[$categoryName]['maxScore'][] = $score->MaxScore;
                            $taskData[$categoryName]['tasks'][] = 'Task ' . $taskScore->task_id;
                        }
                    }
                }
            }
        }

        // Ensure no data is removed prematurely on the first attempt
        foreach ($taskData as $categoryName => &$data) {
            // Only remove the default values if actual data exists
            if (count($data['tasks']) > 0) {
                // This check ensures we do not accidentally remove the first data entry
                // Remove the initial default 0 values only if more than one entry exists
                if (count($data['tasks']) > 1) {
                    array_shift($data['errors']);
                    array_shift($data['timeTaken']);
                    array_shift($data['timeLeft']);
                    array_shift($data['score']);
                    array_shift($data['maxScore']);
                    array_shift($data['tasks']);
                }
            }
        }

        return $taskData;
    }


    function calculateAccuracy($score, $maxScore, $errors, $errorPenaltyPercent = 1.5)
    {
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

    function calculateScore($score, $maxScore)
    {
        return ($score / $maxScore) * 100;
    }

    function calculateCodingSpeed($timeLeft, $timeTaken)
    {
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
