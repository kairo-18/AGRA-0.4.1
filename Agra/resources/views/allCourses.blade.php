<!DOCTYPE html>
<html lang="en">
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

    <link rel="stylesheet" href="/app.css">
</head>
<body>

<!-- Sidebar Wrapper -->
<div class="wrapper">

    <!-- Sidebar -->
    <aside id="sidebar">
        <div class="space p-3"></div>

        <!-- Sidebar Header -->
        <div class="d-flex">

            <!-- Toggle Button -->
            <button class="toggle-btn mx-4" type="button">
                <img src="/image-removebg-preview (23) 1.png">
            </button>
            <!-- Sidebar Logo -->
            <div class="sidebar-logo">
                <a href="#">CodzSword</a>
            </div>
        </div>

        <!-- Sidebar Navigation -->
        <ul class="sidebar-nav">

            <!-- Profile -->
            <li class="sidebar-item">
                <a href="/" class="sidebar-link">
                    <i class="bi bi-house"> </i> Home
                    <span>Home</span>
                </a>
            </li>

            <!-- Task -->
            <li class="sidebar-item">
                <a href="/agra" class="sidebar-link">
                    <i class="bi bi-triangle"> </i>AGRA
                    <span>AGRA</span>
                </a>
            </li>

            <!-- Notification -->
            <li class="sidebar-item">
                <a href="/courses" class="sidebar-link">
                    <i class="bi bi-book">  </i> Course
                    <span>Course</span>
                </a>
            </li>

            <!-- Setting -->
            <li class="sidebar-item">
                <a href="#" class="sidebar-link">
                    <i class="bi bi-question-circle"> </i> Help
                    <span>Setting</span>
                </a>
            </li>
        </ul>

        <div class="line"></div>

        <!-- Setting -->
        <li class="sidebar-item">
            <a href="#" class="sidebar-link">
                <i class="lni lni-cog"> </i> Setting
                <span>Setting</span>
            </a>
        </li>
        </ul>

        <!-- Sidebar Footer -->
        <div class="sidebar-footer">
            <form method="POST" id="logout" action="{{ route('logout') }}">
                <a href="javascript:document.getElementById('logout').submit();" class="sidebar-link">
                    <i class="lni lni-exit"> </i> Logout
                    <span>Logout</span>
                </a>
                {{ csrf_field() }}
            </form>
        </div>

        <div class="space p-4"></div>
    </aside>

    <!-- Main Content -->
    <div class="main">
        <div class="second-main">
            <!--Middle Cotent-->
            <div class="middle-bar">
                <div class="top-middle-bar">
                    <div class="navigations-middle-bar">

                        <!--Courses Title-->
                        <div class="course-h1-name">
                            <h1 class="course-h1">Agra Courses</h1>
                        </div>

                    </div>

                    <div class="navigations-middle-filter">
                        <div class="filter-name m-3">Filter: </div>

                        <!--Language Dropdown-->
                        <div class="dropdown m-3">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="languageDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                Language
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="languageDropdown">
                                <li><a class="dropdown-item" href="/categories/java">Java</a></li>
                                <li><a class="dropdown-item" href="/categories/csharp">C#</a></li>
                                <!-- Add more dropdown items as needed -->
                            </ul>
                        </div>

                    </div>
                </div>
                <div class="courses-div">
                    @foreach($courses as $course)

                        <!--Course Box-->
                        <div class="courses-box">
                            <div class="course-inner-box">
                                <div class="image-container">
                                    <img src="/laptop with code.png" alt="laptop" class="image m-3">
                                </div>

                                <div class="name-container m-3">
                                    <h1>{{$course->CourseName}}</h1>
                                    <p class="subject-java mb-5">{{$course->CourseDescription}}</p>
                                </div>
                            </div>

                            <div class="btn-start-course">
                                <form method="GET" action="{{ route('enroll.store') }}">
                                    <input type="hidden" value="{{$user->id}}" name="userid">
                                    <input type="hidden" value="{{$course->id}}" name="courseid">
                                <button type="submit" class="btn btn-primary rounded-circle  m-3 btn-lg">
                                    <i class="bi bi-play fs-1"></i>
                                </button>
                                    {{csrf_field()}}
                                </form>
                            </div>
                        </div>

                    @endforeach
                </div>


            </div>
            <div class="right-bar">

                <div class="student-info">
                    <div class="student-name">
                        <div class="img-class">
                            <form method="GET" id="profileEdit" action="{{ route('profile.edit') }}">
                                <a href="javascript:document.getElementById('profileEdit').submit();">
                                    <img src="/profileIcon50.png" alt="profile">
                                </a>
                                {{ csrf_field() }}
                            </form>
                        </div>
                        <div class="name">
                            <h5>{{$user->name}}</h5>
                            <h6>{{$user->email}}</h6>
                        </div>

                    </div>

                </div>

                <div class="task-box">
                    <div class="title m-3"><h2>Task</h2><h6>(Deadlines)</h6></div>


                    @foreach($tasks as $task)
                        <div class="time-subject">
                            <div class="subject-comprog-1">
                                <div class="bilog"></div>
                                @if($task->TaskDifficulty == "Easy")
                                    <p><a href="/tasks/{{$task->id}}">{{$task->TaskName}}</a></p>
                                @elseif($task->TaskDifficulty == "Intermediate")
                                    <p><a href="/tasks/ship/{{$task->id}}">{{$task->TaskName}}</a></p>
                                @endif
                                <h6>{{ $task->DateGiven->format('m-d-Y') }} - {{ $task->Deadline->format('m-d-Y') }}</h6>
                            </div>
                        </div>

                        <div class="line"></div>

                    @endforeach

                </div>

                <div class="calendar-box">
                    <div class="header">
                        <button class="calendar-btn" id="prevBtn">&lt;</button>
                        <div id="monthYear"></div>
                        <button class="calendar-btn" id="nextBtn">&gt;</button>
                    </div>
                    <div class="days"></div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS Bundle -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<!-- Custom Script -->
<script src="/courses.js"></script>


</body>
</html>
