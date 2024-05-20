<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Courses Lessons New</title>

    


    <style>
        .calendar-panel {
    
    
}
.lbl-title{
    display: flex;
    justify-content: space-between;
    align-items: center;
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
    transition: all 0.3s ease-in-out 0.15s;
}

.calendar-cell:hover {
    background-color: #004AAD;
    color: #FFFFFF;
    transform: translateY(-0.25rem) scale(1.1); /* hover:-translate-y-1 hover:scale-110 */
    
}
.calendar-cell:focus {
  outline: none; /* focus:outline-none */
}

.calendar-cell:focus-visible {
  box-shadow: 0 0 0 3px #1e40af; /* dark:focus:ring-blue-800 */
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
                <div class="calendar-panel pl-7 pr-7 pb-7 pt-2 bg-white h-1/3 w-full rounded-lg overflow-auto shadow">
                
                    <div class="lbl-title flex justify-end">
                        <h3 class = "text-2xl font-semibold text-gray-900">Calendar</h3>
                        <a href="/calendar" class="text-blue-600">view</a>
                    </div>
                    
                    <div class="calendar">
                        <div class="calendar-header">
                            
                            <div class="flex justify-start font-semibold text-blue-800">
                                <h4 id="currentMonthYear"></h4>
                            </div>
                            
                            <div class="flex justify-end gap-x-3">

                                <button id="prevMonthBtn">
                                    <svg class="flex items-center space-x-3 rtl:space-x-reverse transition ease-in-out delay-150 bg-transparent hover:-translate-y-1 hover:scale-110 hover:bg-transparent duration-300 rounded-lg w-30 h-full" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" d="M13.729 5.575c1.304-1.074 3.27-.146 3.27 1.544v9.762c0 1.69-1.966 2.618-3.27 1.544l-5.927-4.881a2 2 0 0 1 0-3.088l5.927-4.88Z" clip-rule="evenodd"/>
                                    </svg>
                                </button>
                                <button id="nextMonthBtn">
                                    <svg class="flex items-center space-x-3 rtl:space-x-reverse transition ease-in-out delay-150 bg-transparent hover:-translate-y-1 hover:scale-110 hover:bg-transparent duration-300 rounded-lg w-30 h-full" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" d="M10.271 5.575C8.967 4.501 7 5.43 7 7.12v9.762c0 1.69 1.967 2.618 3.271 1.544l5.927-4.881a2 2 0 0 0 0-3.088l-5.927-4.88Z" clip-rule="evenodd"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="week-header text-blue-800">
                            <div class="week-cell">Sun</div>
                            <div class="week-cell">Mon</div>
                            <div class="week-cell">Tue</div>
                            <div class="week-cell">Wed</div>
                            <div class="week-cell">Thu</div>
                            <div class="week-cell">Fri</div>
                            <div class="week-cell">Sat</div>
                        </div>

                        <div class="calendar-body text-blue-800" id="calendarBody"></div>
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
