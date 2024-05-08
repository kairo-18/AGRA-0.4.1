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

    <link rel="stylesheet" href="/styles2.css">
</head>

<body>
<!-- Sidebar Wrapper -->
<div class="wrapper">

    <!-- Sidebar -->
<x-sidebar></x-sidebar>
    <!-- Main Content -->
    <x-divlayouts>
            <!--Middle Cotent-->
            <div class="middle-bar">
                <div class="top-middle-bar">
                    <div class="navigations-middle-bar">

                        <!--Courses Title-->
                        <div class="course-h1-name">
                            <h1>Lesson</h1>
                            <h4 class="course-h2">{{$lesson->LessonName}}</h4>


                        </div>

                    </div>


                </div>


                <div class="modules-div">
                    <h3 class="pdf">Java</h3>
                    <div class="modules-box">
                        <iframe frameborder="0" width="560" height="315" src="{{asset("storage/app/public/" . $lesson->LessonFile)}}" allowfullscreen allow="autoplay"></iframe>
                    </div>
                    <h6 class="pdf">IT2207_Syllabus_and_Course_Outline.pdf</h6>
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
                        <x-stuName>
                            <h5>{{$user->name}}</h5>
                            <h6>{{$user->email}}</h6>
                        </x-stuName>
                    </div>
                </div>

                <div class="topic">
                    <h4>Lessons Overview</h4>
                </div>

                <div class="right-bar-inner">

                    @foreach($lessons as $lesson)
                    <div class="course-minipan">
                        <div class="text-holder">
                            <h4><a href="/lessons/{{$course->id}}/{{$lesson->id}}">{{$lesson->LessonName}}</a></h4>
                        </div>
                        <span class="file-name">{{$lesson->LessonFile}}</span>
                    </div>
                    @endforeach


                </div>
            </div>


</x-divlayouts>
<!-- Bootstrap JS Bundle -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
<!-- Custom Script -->
<script src="courses.js"></script>
</body>

</html>
