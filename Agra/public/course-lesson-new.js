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
