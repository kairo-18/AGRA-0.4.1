<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Courses Lessons New</title>

    <style>
        .calendar-panel {
            /* Styles... */
        }
        .lbl-title {
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
            color: #ffffff;
        }
        .calendar-cell {
            position: relative;
            border-radius: 5px;
            padding: 5px;
            text-align: center;
            border: #004AAD 1px solid;
            transition: all 0.3s ease-in-out 0.15s;
        }
        .calendar-cell:hover {
            background-color: #004AAD;
            color: #FFFFFF;
            transform: translateY(-0.25rem) scale(1.1);
        }
        .calendar-cell:focus {
            outline: none;
        }
        .calendar-cell:focus-visible {
            box-shadow: 0 0 0 3px #1e40af;
        }
        .deadline-date {
            background-color: #ADD8E6;
            color: #FFFFFF;
        }
        .tooltip {
            display: none;
            position: absolute;
            bottom: 100%;
            left: 50%;
            transform: translateX(-50%);
            background-color: #333;
            color: #fff;
            padding: 5px;
            border-radius: 5px;
            font-size: 12px;
            white-space: nowrap;
            z-index: 1;
        }
        .calendar-cell:hover .tooltip {
            display: block;
        }
    </style>
</head>
<body>
    <div class="calendar-panel pl-5 pr-5 pb-5 pt-2 bg-white h-full w-full rounded-lg overflow-auto   shadow">
        <div class="lbl-title flex justify-end">
            <h3 class="text-xl font-semibold text-blue-900">Calendar</h3>
{{--            <a href="/calendar" class="text-blue-600">view</a>--}}
        </div>
        <div class="calendar">
            <div class="calendar-header">
                <div class="flex justify-start font-semibold text-blue-800">
                    <h4 id="currentMonthYear"></h4>
                </div>
                <div class="flex justify-end gap-x-3">
                    <button id="prevMonthBtn">Prev</button>
                    <button id="nextMonthBtn">Next</button>
                </div>
            </div>
            <div class="week-header text-blue-800">
                <div class="week-cell text-xs">Sun</div>
                <div class="week-cell text-xs">Mon</div>
                <div class="week-cell text-xs">Tue</div>
                <div class="week-cell text-xs">Wed</div>
                <div class="week-cell text-xs">Thu</div>
                <div class="week-cell text-xs">Fri</div>
                <div class="week-cell text-xs">Sat</div>
            </div>
            <div class="calendar-body text-blue-800 text-xs pb-3" id="calendarBody"></div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const prevMonthBtn = document.getElementById("prevMonthBtn");
            const nextMonthBtn = document.getElementById("nextMonthBtn");
            const currentMonthYear = document.getElementById("currentMonthYear");
            const calendarBody = document.getElementById("calendarBody");

            const tasks = @json($tasks); // Array of all tasks
            const taskMap = new Map();

            // Populate the taskMap with arrays of task IDs for each date
            tasks.forEach(task => {
                const dateStr = new Date(task.Deadline).toISOString().split('T')[0];
                if (!taskMap.has(dateStr)) {
                    taskMap.set(dateStr, []);
                }
                taskMap.get(dateStr).push(task.id);
            });

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

                    const date = new Date(Date.UTC(year, month, day));
                    const dateString = date.toISOString().split('T')[0];

                    const link = document.createElement("a");
                    link.href = `/taskDeadlines/${dateString}`;
                    link.textContent = day;
                    cell.appendChild(link);

                    if (day === today.getUTCDate() && month === today.getUTCMonth() && year === today.getUTCFullYear()) {
                        cell.classList.add("current-date");
                    }

                    if (taskMap.has(dateString)) {
                        const deadlines = taskMap.get(dateString).length;
                        cell.classList.add("deadline-date");

                        const tooltip = document.createElement("div");
                        tooltip.classList.add("tooltip");
                        tooltip.textContent = `${deadlines} deadline${deadlines > 1 ? 's' : ''}`;
                        cell.appendChild(tooltip);
                    }

                    calendarBody.appendChild(cell);
                }
            }
        });
    </script>
</body>
</html>
