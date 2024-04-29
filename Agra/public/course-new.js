
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

        const firstDayOfMonth = new Date(year, month, 1).getDay();
        const daysInMonth = new Date(year, month + 1, 0).getDate();

        const today = new Date();
        const currentDay = today.getDate();
        const currentMonth = today.getMonth();
        const currentYear = today.getFullYear();

        for (let i = 0; i < firstDayOfMonth; i++) {
            const cell = document.createElement("div");
            cell.classList.add("calendar-cell");
            cell.textContent = "";
            calendarBody.appendChild(cell);
        }

        for (let day = 1; day <= daysInMonth; day++) {
            const cell = document.createElement("div");
            cell.classList.add("calendar-cell");
            cell.textContent = day;

            // Check if the current date matches today's date
            if (year === currentYear && month === currentMonth && day === currentDay) {
                cell.classList.add("today");
            }

            calendarBody.appendChild(cell);
        }
    }

});
