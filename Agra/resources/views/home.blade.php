<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Title -->
    <title>Modules Lessons</title>

    <!-- External CSS -->
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <!-- Bootstrap Icons CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.0/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="quer.css">
</head>

<body>
<!-- Sidebar Wrapper -->
<div class="wrapper">

    <x-sidebar>

    </x-sidebar>


    <!-- Main Content -->

    <x-divlayouts>
        <div class="left-panel">

            <div class="lbl-outer-welcome">
                Hello, {{$user->name}}!
            </div>

            <div class="nav-outer-direction">
                <div class="nav-inner-direction">
                    <div class="btn-navigation">
                        <span>HOME</span>
                    </div>
                </div>
            </div>

            <div class="ad-outer-agra">
                <div class="ad-inner-agra">
                    <div class="ad-inner-left">
                        <h2>AGRA</h2>
                        <p>Learning back to square one, but with fun.
                            Where Beginners Level Up Through Fun, One
                            Line of Code at a Time!
                        </p>
                        <div class="btn-learn-begin">
                            <button class="btnBegin">Begin.</button>
                        </div>
                    </div>
                    <div class="ad-inner-right">
                        <img src="img-agraDesign.png" alt="des">
                    </div>
                </div>
            </div>

            <div class="grp-outer-enrolledCourses">
                <div class="grp-inner-enrolledCourses">
                    <div class="lbl-enrolled">
                        <p>Enrolled Courses</p>
                    </div>

                    <div class="grp-Ecourses">
                        @foreach($courses as $course)
                            <div class="container-suubj-1">
                                <div class="img-container">
                                    <div class="lbl-language">
                                        <h2>Java</h2>
                                    </div>
                                </div>

                                <div class="lbl-placer">
                                    <h2>{{$course->CourseName}}</h2>
                                    <p>Mr.Dungo</p>
                                </div>
                            </div>
                        @endforeach





                        <div class="lbl-ads">
                            <h1>EXPLORE - LEARN - ENJOY</h1>
                            <p>Master Java and C#: Learn OOP,
                                data structures, algorithms, syntax, and
                                best practices for both languages.
                            </p>
                            <button class="btnLearnM">Learn more.</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <!-- Right div of inner div -->
        <div class="right-panel">

            <div class="user-info">
                <div class="user-name">
                    <h4>{{$user->name}}</h4>
                    <h6>{{$user->email}}</h6>
                </div>
                <div class="user-icon">

                </div>
            </div>
            <div class="outer-calendar">
                <x-calendar>

                </x-calendar>
            </div>

            <div class="query">
                <div class="outer-schedule">
                    <div class="inner-scheddule">
                        <div class="name-notif">
                            <h2>To-do:</h2>
                            <a href="/courses">explore</a>
                        </div>

                        <div class="sched-box-out">
                            <!-- schudele box 1 -->
                            @foreach($tasks as $task)
                                <div class="sched-box">

                                    <div class="sched-box-circle">
                                    </div>

                                    <div class="sched-box-name">
                                        <h5>{{$task->TaskName}}</h5>
                                        <p>March 07 - April 03</p>
                                    </div>
                                    <div class="sched-box-btn">
                                        >
                                    </div>
                                </div>
                            @endforeach

                        </div>



                    </div>
                </div>


            </div>

        </div>
    </x-divlayouts>
</div>
</div>

<!-- Bootstrap JS Bundle -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
<!-- Custom Script -->
<script src="jav.js"></script>
</body>

</html>
