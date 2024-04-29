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
    <link rel="stylesheet" href="/course.css">
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


            <!--Note: flex-direction of this panel is column-->
            <div class="left-panel">
                <!--1st div  -->
                <div class="header-courses">
                    <h1>Courses</h1>
                </div>

                <!--2nd div  -->
                <div class="nav-outer-direction"><!--NEED TO COMPONENT-->
                    <div class="nav-inner-direction">
                        <div class="btn-navigation">
                            <span>COURSES</span>
                        </div>
                    </div>
                </div>

                <!--3rd div  -->
                <div class="drpbtn-filter"><!--NEED TO COMPONENT-->
                    <label for="cars"><h5>Filter:</h5></label>
                    <!-- language -->
                    <select id="drpbtn" name="language" onchange="goToPage();">
                        <option disabled selected>Language</option>
                        <option value="java">Java</option>
                        <option value="c#">C#</option>
                    </select>

                    <select id="drpbtn" name="subject">
                        <option disabled selected>Subject</option>
                        <option value="java" >Computer programming 1</option>
                        <option value="c#">Data structures</option>
                    </select>

                    <select id="drpbtn" name="subject">
                        <option disabled selected>Teacher</option>
                        <option value="java">Mr.Dungo</option>
                        <option value="c#">Mr.Batchoy</option>
                    </select>
                </div>

                <!--4th div  -->
                <div class="lbl-filter">
                    <h2>Filtered: </h2><p>[based on user filter seclect]</p>
                </div>

                <!--5th div  -->
                <div class="content-subj">

                    @foreach($courses as $course)
                    <div class="box-subj">
                        <div class="img-holder">
                            <div class="img-holder-inner">
                                <img src="/image-course.png" alt="img" id="img-hold">
                            </div>

                        </div>
                        <div class="lbl-btn">
                            <div class="lbl-sbj">
                                <h3>{{$course->CourseName}}</h3>
                                <div class="lbl-box">
                                    <p>{{$course->category->name}}</p>
                                </div>
                                <p>STI</p>
                            </div>

                            <div class="btn-sbj">
                                <button type="button" onclick="location.href='/courses/{{$course->id}}'" style="background-color: transparent; border: 0px;">
                                    <h2> > </h2>
                                </button>
                            </div>
                        </div>
                    </div>
                    @endforeach



                </div>
            </div>

            <!--Note: flex-direction of this panel is column-->
            <div class="right-panel">

                <!--1st div  -->
                <div class="student-profile">
                    <div class="student-profile-inner">
                        <p>Lance Rizzel Cortel</p>
                        <h6>@cortel.123456</h6>
                    </div>
                    <div class="img-profile-inner">
                        <form method="GET" id="profileEdit" action="{{ route('profile.edit') }}">
                            <a href="javascript:document.getElementById('profileEdit').submit();">
                                <img src="/profileIcon50.png" alt="profile">
                            </a>
                            {{ csrf_field() }}
                        </form>
                    </div>
                </div>



                <!--2nd div  -->
                <div class="agenda-panel">
                    <div class="lbl-agenda">
                        <h4>Agenda</h4>
                        <a href="">view</a>
                    </div>
                    <div class="container-tomorrow">
                        <p></p>
                        @foreach($tasks as $task)
                            <div class="box-tom">
                                <div class="box-tom-inner">
                                    <p>{{ Carbon\Carbon::parse($task->Deadline)->format('m/d/y h:i A') }}</p>
                                    @if($task->TaskDifficulty == "Easy")
                                        <p><a href="/tasks/{{$task->id}}">{{$task->TaskName}}</a></p>
                                    @elseif($task->TaskDifficulty == "Intermediate")
                                        <p><a href="/tasks/ship/{{$task->id}}">{{$task->TaskName}}</a></p>
                                    @endif
                                </div>

                            </div>
                        @endforeach
                    </div>

{{--                    @foreach($tasks as $task)--}}
{{--                        <div class="container-now">--}}
{{--                            <p>Now: </p>--}}
{{--                            <div class="box-now">--}}
{{--                                <div class="box-now-inner">--}}
{{--                                    @if($task->TaskDifficulty == "Easy")--}}
{{--                                        <p><a style="color:white;" href="/tasks/{{$task->id}}">{{$task->TaskName}}</a></p>--}}
{{--                                    @elseif($task->TaskDifficulty == "Intermediate")--}}
{{--                                        <p><a style="color:white;" href="/tasks/ship/{{$task->id}}">{{$task->TaskName}}</a></p>--}}
{{--                                    @endif--}}
{{--                                </div>--}}

{{--                            </div>--}}
{{--                        </div>--}}
{{--                    @endforeach--}}





                </div>

                <!--4th div  -->
                <div class="calendar-panel">
                    <div class="lbl-title">
                        <h3>Calendar</h3>
                        <a href="">view</a>
                    </div>
                    <div class="calendar">
                        <div class="calendar-header">
                            <button id="prevMonthBtn">&lt;</button>
                            <h4 id="currentMonthYear"></h4>
                            <button id="nextMonthBtn">&gt;</button>
                        </div>
                        <div class="week-header">
                            <div class="week-cell">Sun</div>
                            <div class="week-cell">Mon</div>
                            <div class="week-cell">Tue</div>
                            <div class="week-cell">Wed</div>
                            <div class="week-cell">Thu</div>
                            <div class="week-cell">Fri</div>
                            <div class="week-cell">Sat</div>
                        </div>

                        <div class="calendar-body" id="calendarBody"></div>
                    </div>
                </div>






                <script src="/course-new.js"></script>
            </div>

        </div>
    </div>
</div>
</div>

    <!-- Bootstrap JS Bundle -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- Custom Script -->
    <script src="/courses.js"></script>

<script>
    function goToPage() {
        var dropdown = document.getElementById("drpbtn");
        var selectedValue = dropdown.options[dropdown.selectedIndex].value;
        if (selectedValue === "java") {
            window.location.href = "/courses/categories/java";
        } else if (selectedValue === "c#") {
            window.location.href = "/courses/categories/csharp";
        }
    }
</script>

</body>
</html>
