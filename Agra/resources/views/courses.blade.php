<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Agra Courses</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <!-- Bootstrap Icons CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/app.css')}}"/>
    <script src="{{asset('js/app.js')}}"></script>

    <style>
        /* Importing Google Font */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');

        /* Resetting box model */
        ::after,
        ::before {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        /* Removing default link underline */
        a {
            text-decoration: none;
        }

        /* Removing default list styling */
        li {
            list-style: none;
        }

        /* Styling for heading */
        h1 {
            font-weight: 600;
            font-size: 1.5rem;
        }

        /* Setting font family for the whole body */
        body {
            font-family: 'Poppins', sans-serif;
        }

        /* Wrapper for sidebar and main content */
        .wrapper {
            display: flex;
        }

        /* Main content */
        .main {
            padding: 1rem;
            margin-left: 1.2rem;
            min-height: 100vh;
            width: 100%;
            overflow: hidden;
            transition: all 0.35s ease-in-out;
            background-color: #004AAD;
        }
        .second-main {
            border-radius: 20px;
            background-color: #D6E2F1;
            height: 55.50rem;
            box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.5);
            overflow: auto;
        }

    </style>
</head>
<body>

<!-- Sidebar Wrapper -->
<div class="wrapper">
    <x-sidebar></x-sidebar>

    <!-- Main Content -->
    <div class="main">
        <div class="second-main">
            <!-- Left Panel -->
            <div class="left-panel">
                <!-- Header -->
                <div class="header-courses">
                    <h1>Courses</h1>
                </div>

                <!-- Navigation -->
                <div class="nav-outer-direction">
                    <div class="nav-inner-direction">
                        <div class="btn-navigation">
                            <span>COURSES</span>
                        </div>
                    </div>
                </div>

                <!-- Filter Dropdown -->
                <div class="drpbtn-filter">
                    <label for="cars"><h5>Filter:</h5></label>
                    <select id="drpbtn" name="language">
                        <option disabled selected>Language</option>
                        <option value="java">Java</option>
                        <option value="c#">C#</option>
                    </select>
                </div>

                <!-- Content -->

                    @foreach($courses as $course)
                        <div class="m-5 card lg:card-side bg-base-100 shadow-xl">
                            <figure><img src="https://img.daisyui.com/images/stock/photo-1494232410401-ad00d5433cfa.jpg" alt="Album"/></figure>
                            <div class="card-body">
                                <h2 class="card-title">{{$course->CourseName}}</h2>
                                <p>{{$course->CourseDescription}}</p>
                                <div class="card-actions justify-end">
                                    <button class="btn btn-primary" onclick="location.href='/courses/{{$course->id}}'">Learn</button>
                                </div>
                            </div>
                        </div>
                    @endforeach

            </div>

            <!-- Right Panel -->
            <div class="right-panel">
                <!-- Student Profile -->
                <div class="student-profile">
                    <x-stuName>
                        <h4>{{$user->name}}</h4>
                        <h6>{{$user->email}}</h6>
                    </x-stuName>
                </div>

                <!-- Agenda Panel -->
                <div class="agenda-panel">
                    <div class="lbl-agenda">
                        <h4>Agenda</h4>
                    </div>
                    @foreach($tasks as $task)
                        <div class="container-now">
                            <div class="box-now">
                                <div class="box-now-inner overflow-y-scroll">
                                    <p>{{ \Carbon\Carbon::parse($task->Deadline)->format('m/d/Y h:i a') }}</p>
                                    @if($task->TaskDifficulty == "Easy")
                                        <p><a class="text-white" href="/tasks/{{$task->id}}">{{$task->TaskName}}</a></p>
                                    @elseif($task->TaskDifficulty == "Intermediate")
                                        <p><a class="text-white" href="/tasks/ship/{{$task->id}}">{{$task->TaskName}}</a></p>
                                    @elseif($task->TaskDifficulty == "Beginner")
                                        <p><a class="text-white" href="/tasks/fitb/{{$task->id}}">{{$task->TaskName}}</a></p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>

                <!-- Calendar Component -->
                <x-calendar></x-calendar>
            </div>
        </div>
    </div>

</div>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
<!-- Custom Script -->
</body>
</html>
