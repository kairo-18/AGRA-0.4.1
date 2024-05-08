<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Courses Lessons New</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <!-- Bootstrap Icons CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    
    <link rel="stylesheet" href="course-lesson-new.css">


    <style>
        /* -------4 div---------- */
.calendar-panel {
    background-color: #FFFFFF;
    border-radius: 10px;
    width: 100%;
    height: 100%;
    padding: 10px;
    box-sizing: border-box;
}
.lbl-title{
    display: flex;
    justify-content: space-between;
    height: 12%;
    width: 100%;
}
.calendar {
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 10px;
    width: 100%;
    height: 88%;
    overflow: auto;
    background-color: #D6E2F1;
}

.calendar-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 10px;
}

.calendar-body {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    gap: 5px;
}

.calendar-cell {
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 5px;
    text-align: center;
    width: 100%;
    height: 100%;
}
.week-header {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    gap: 5px;
    font-weight: bold;
}

.week-cell {
    border: #004AAD 1px solid;
    border-radius: 5px;
    padding: 5px;
    text-align: center;
    margin-bottom: 10px;
}
.calendar-cell.today {
    background-color: #004AAD;
    color: #FFFFFF;
}
.calendar-cell a {
    display: block;
    text-decoration: none;
    color: inherit;
}
.current-date {
    background-color: #004AAD;
    color: #ffffff; /* Yellow background color for today's date */
}
.calendar-cell {
    position: relative; /* Add this line to allow positioning of the tooltip */
    border-radius: 5px;
    padding: 5px;
    text-align: center;
    border: #004AAD 1px solid;
}

.calendar-cell:hover {
    background-color: #004AAD;
    color: #FFFFFF;
}

.calendar-cell:hover::after {
    content: "No deadline"; /* Tooltip text */
    position: absolute;
    bottom: 100%; /* Position the tooltip above the cell */
    left: 50%;
    transform: translateX(-50%); /* Center the tooltip horizontally */
    background-color: #333;
    color: #fff;
    padding: 5px;
    border-radius: 5px;
    font-size: 12px;
    white-space: nowrap; /* Prevent tooltip text from wrapping */
    opacity: 1; /* Show the tooltip */
    pointer-events: none; /* Ensure the tooltip doesn't interfere with hover */
    z-index: 1; /* Ensure the tooltip appears above other elements */
}

    </style>
</head>
<body>
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


                

                

                <script>
                    document.addEventListener("DOMContentLoaded", function () {
                        const prevMonthBtn = document.getElementById("prevMonthBtn");
                        const nextMonthBtn = document.getElementById("nextMonthBtn");
                        const currentMonthYear = document.getElementById("currentMonthYear");
                        const calendarBody = document.getElementById("calendarBody");
                    
                        let currentDate = new Date();
                        let currentMonth = currentDate.getMonth();
                        let currentYear = currentDate.getFullYear();
                    
                        renderCalendar(currentMonth, currentYear);
                    
                        prevMonthBtn.addEventListener("click", () => {
                            currentMonth--;
                            if (currentMonth < 0) {
                                currentMonth = 11;
                                currentYear--;
                            }
                            renderCalendar(currentMonth, currentYear);
                        });
                    
                        nextMonthBtn.addEventListener("click", () => {
                            currentMonth++;
                            if (currentMonth > 11) {
                                currentMonth = 0;
                                currentYear++;
                            }
                            renderCalendar(currentMonth, currentYear);
                        });
                    
                        function renderCalendar(month, year) {
                            currentMonthYear.textContent = `${new Date(year, month).toLocaleString('default', { month: 'long' })} ${year}`;
                            calendarBody.innerHTML = "";
                    
                            const today = new Date();
                            const firstDayOfMonth = new Date(year, month, 1).getDay();
                            const daysInMonth = new Date(year, month + 1, 0).getDate();
                    
                            for (let i = 0; i < firstDayOfMonth; i++) {
                                const cell = document.createElement("div");
                                cell.classList.add("calendar-cell");
                                calendarBody.appendChild(cell);
                            }
                    
                            for (let day = 1; day <= daysInMonth; day++) {
                                const cell = document.createElement("div");
                                cell.classList.add("calendar-cell");
                                
                                // Create a link element
                                const link = document.createElement("a");
                                link.href = "/calendar"; // Set the href attribute to "/calendar"
                                link.textContent = day; // Set the link text to the day
                                cell.appendChild(link);
                    
                                // Add div for deadline
                                const div = document.createElement("div");
                                div.classList.add("deadline-div");
                                cell.appendChild(div);
                    
                                // Highlight the current date
                                if (day === today.getDate() && month === today.getMonth() && year === today.getFullYear()) {
                                    cell.classList.add("current-date");
                                }
                    
                                // Check if the date is April 25th
                                if (day === 25 && month === 3 && year === today.getFullYear()) {
                                    div.textContent = "Deadline: Thursday, April 25";
                                }
                    
                                calendarBody.appendChild(cell);
                            }
                        }
                    });                    
                </script>
            

    <!-- Bootstrap JS Bundle -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- Custom Script -->
    <script src="/courses.js"></script>
    <script src="/sidebar-compo.js"></script>


</body>
</html>
