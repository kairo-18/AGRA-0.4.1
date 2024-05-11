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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{asset('css/app.css')}}"/>
    <script src="{{asset('js/app.js')}}"></script>
    <link rel="stylesheet" href="/course-new.css">
</head>
<body>

<!-- Sidebar Wrapper -->
<div class="wrapper">

    <x-sidebar>

    </x-sidebar>



    <!-- Main Content -->
    <x-divlayouts>
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
                <select id="drpbtn" name="language">
                    <option disabled selected>Language</option>
                    <option value="java">Java</option>
                    <option value="c#">C#</option>
                </select>
            </div>


            <!--5th div  -->
            <div class="content-subj mt-4">
                @foreach($courses as $course)
                    <div class="card w-96 bg-base-100 shadow-xl rounded">
                        <div class="bg-blue-500 rounded"><img src="young woman leaning on table.png" alt="Shoes" /></div>
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

        </div>

        <!--Note: flex-direction of this panel is column-->
        <div class="right-panel">

            <!--1st div  -->
            <div class="student-profile">
                <x-stuName>
                    <h4>{{$user->name}}</h4>
                    <h6>{{$user->email}}</h6>
                </x-stuName>
            </div>

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

            <!--4th div  -->
                <x-calendar></x-calendar>

    </x-divlayouts>
</div>


<!-- Bootstrap JS Bundle -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<!-- Custom Script -->
<script src="/course-new.js"></script>
<script src="/sidebar-compo.js"></script>


</body>
</html>
