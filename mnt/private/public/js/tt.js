  // Get elements
  const prevMonthBtn = document.getElementById('prevMonth');
  const nextMonthBtn = document.getElementById('nextMonth');
  const monthYearDisplay = document.getElementById('monthYear');
  const daysContainer = document.getElementById('days');
  const messageDisplay = document.getElementById('message');

  // Get current date and initialize the month/year
  let currentDate = new Date();
  let currentMonth = currentDate.getMonth();
  let currentYear = currentDate.getFullYear();

  // Function to render the calendar
  function renderCalendar() {
      const firstDayOfMonth = new Date(currentYear, currentMonth, 1);
      const lastDayOfMonth = new Date(currentYear, currentMonth + 1, 0);
      const numberOfDaysInMonth = lastDayOfMonth.getDate();
      const firstDayOfWeek = firstDayOfMonth.getDay(); // Day of the week (0-6)

      // Set the month/year label
      monthYearDisplay.textContent = `${firstDayOfMonth.toLocaleString('default', { month: 'long' })} ${currentYear}`;

      // Clear previous days
      daysContainer.innerHTML = '';

      // Create empty divs for the first week leading up to the first day
      for (let i = 0; i < firstDayOfWeek; i++) {
          daysContainer.innerHTML += `<div class="day"></div>`;
      }

      // Create the days of the month
      for (let day = 1; day <= numberOfDaysInMonth; day++) {
          const dayElement = document.createElement('div');
          dayElement.classList.add('day');
          dayElement.textContent = day;

          // Create a string representing the full date (e.g., "2025-01-12")
          const fullDate = `${currentYear}-${String(currentMonth + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;

          // Check if the day is in the specialDates array
          if (specialDates.includes(fullDate)) {
              dayElement.classList.add('highlight'); // Add 'highlight' class if it's in the array
          }

          // Add event listener for day click
          dayElement.addEventListener('click', () => showMessage(fullDate));
          daysContainer.appendChild(dayElement);
      }
  }

  console.log(info);

  // Function to handle day click and display message
  function showMessage(date) {
    isIn = false;
    let i = 0;
    specialDates.forEach((elem) => {
        if (elem == date){
            messageDisplay.textContent = `Vous allez encadrer ${info[i]['3']} ${info[i]['4']} ${info[i]['5']} ${info[i]['6']} (${date}).`;
            isIn = true;
        }
        i++;
    });
    if (!isIn) messageDisplay.textContent = '';
      //messageDisplay.textContent = `Vous allez encadrer ${day} ${monthYearDisplay.textContent.split(' ')[0]} (${date}).`;
  }

  function lookForSpecialDays(date){

  }

  // Event listeners for navigating between months
  prevMonthBtn.addEventListener('click', () => {
      currentMonth--;
      if (currentMonth < 0) {
          currentMonth = 11;
          currentYear--;
      }
      renderCalendar();
  });

  nextMonthBtn.addEventListener('click', () => {
      currentMonth++;
      if (currentMonth > 11) {
          currentMonth = 0;
          currentYear++;
      }
      renderCalendar();
  });

  // Initial render of the calendar
  renderCalendar();
  console.log(specialDates);
  