<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grades</title>

    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <!-- Bootstrap Icons CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/styles-courses-grades.css">
</head>
<body>
<div id="wrapper" class="toggled-2">
    <!-- Sidebar -->
    <nav-sidebar></nav-sidebar>

    <!-- Main Content -->
    <div class="main">
        <!-- Inner div -->
        <div class="second-main">
            <!-- the div is in col going down -->

            <!-- 1st div -->
            <div class="courses-profile">
                <div class="courses-profile-inner">
                    <div class="name-corse">
                        <h1 id="name-coursez">Courses</h1>
                    </div>
                    <div class="name-profile">
                        <div class="name-profile-inner">
                            <p>Lance Rizzel Cortel</p>
                            <h6>@cortel.123456</h6>
                        </div>
                        <div class="img-profile-inner">
                            <img src="Group 18.png" alt="corts">
                        </div>
                    </div>

                </div>
            </div>

            <!-- 2nd div -->
            <!-- When grades is pressed from the course panel add a div "mini-nav-[name]-inner" -->
            <div class="mini-nav">
                <div class="mini-nav-inner">
                    <div class="mini-nav-home-inner">
                        <p>Courses</p>
                    </div>
                    <div class="mini-nav-grades-inner">
                        <p>Grades</p>
                    </div>

                </div>
            </div>
            <div class="panel-title">
                <h2 id="panel-grades-color">Grades:</h2><h2 id="panel-subject-size">Computer Programming 1</h2>
            </div>
            <!-- Updated HTML with table structure -->
            <div class="panel-content">
                <table class="panel-table">
                    <thead>
                    <tr>
                        <th>Activities</th>
                        <th>Start</th>
                        <th>Due</th>
                        <th>Status</th>
                        <th>Score</th>
                        <th>Grade</th>
                    </tr>
                    </thead>
                    <tbody>
                    <!-- Rows -->

                    @foreach($tasks as $task)

                    <tr>
                        <td>
                            <h4>{{$task->TaskName}}</h4>
                            <p>{{$task->lesson->LessonName}}</p>
                        </td>
                        <td>{{ Carbon\Carbon::parse($task->DateGiven)->format('d F, Y g:i A') }}</td>
                        <td>{{ Carbon\Carbon::parse($task->Deadline)->format('d F, Y g:i A') }}</td>

                        <?php
                            $taskStatus = 'Pending';  // Initialize with default status

                            foreach($doneTasks as $doneTask) {
                                if($task->id === $doneTask->id) {
                                    $taskStatus = 'Done';
                                    break;  // Exit loop once a match is found
                                }
                            }
                            ?>

                        <td><?php echo $taskStatus; ?></td>

                        @if($taskStatus == "Done")
                            @php
                                $latestScore = null;
                            @endphp

                            @foreach($task->score as $sc)
                                @if ($sc->user_id == $user->id)
                                    @if (is_null($latestScore) || $sc->created_at > $latestScore->created_at)
                                        @php
                                            $latestScore = $sc;
                                        @endphp
                                    @endif
                                @endif
                            @endforeach

                            @if ($latestScore)
                                <td>{{ $latestScore->score }} / {{ $latestScore->MaxScore }}</td>
                                <td>{{ $latestScore->Percentage }}%</td>
                            @else
                                <td>N/A</td>
                            @endif
                        @else
                            <td>N/A</td>
                            <td>N/A</td>
                        @endif



                    </tr>

                    @endforeach

                    <!-- More rows can be added similarly -->
                    </tbody>
                </table>
            </div>


        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>

<!-- Importing the component script -->
<script src="/script-courses-grades.js"></script>
</body>
</html>
