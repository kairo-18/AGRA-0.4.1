<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Courses Lessons New</title>

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


</body>
</html>
