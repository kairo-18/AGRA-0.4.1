<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Agra Courses</title>
    <link rel="stylesheet" href="/app.css">
</head>
<body>

    <header>
        <h2><img src="/image-removebg-preview (22) 1.png" alt="logo"></h2>
        <nav>
            <ul class="nav_links">
                <li><a href="/">Home</a></li>
                <li><a href="/register">Account</a></li>
                <li><a href="/">Courses</a></li>
                <li><a href="#">Exercises</a></li>
            </ul>

            <form method="POST" action="{{ route('logout') }}">
                <button type="submit" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                    Log out
                </button>
                {{ csrf_field() }}
            </form>

            <form method="GET" action="{{ route('profile.edit') }}">
                <button type="submit" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                    Profile
                </button>
                {{ csrf_field() }}
            </form>

            <form method="GET" action="{{ route('enroll.store') }}">
                <input type="hidden" value="{{$user->id}}" name="userid">
                <input type="hidden" value="{{$courses[0]->id}}" name="courseid">
                <button type="submit" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                    Enroll
                </button>
                {{ csrf_field() }}
            </form>
        </nav>
    </header>

    <div class="outer-title-enrolled">
        <div class="title-enrolled">
            ENROLLED
        </div>
    </div>

    <article class="outer-container">
        <article class="container">

            @foreach($courses as $course)
            <article class="box" id="box1">
                <img src="/sampleImg.png" alt="img">
                <div class="description-box">
                    <h1>{{$course->CourseName}}</h1>>
                    <h3>Category: <a href="/categories/{{$course->category->slug}}">{{$course->category->name}}</a></h3>
                    <p>
                        {{$course->CourseDescription}}
                    </p>
                    <button class="btn" onclick="location.href='/courses/{{$course->id}}'">START</button>
                </div>
            </article>

            @endforeach
        </article>
    </article>
    <footer>
        <img src="/agraFooter.png" alt="footer">
    </footer>

</body>
</html>
