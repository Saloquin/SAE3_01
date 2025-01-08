const prevMonthBtn = document.getElementById('prevMonth');
const nextMonthBtn = document.getElementById('nextMonth');
const monthYearDisplay = document.getElementById('monthYear');
const daysContainer = document.getElementById('days');
const messageDisplay = document.getElementById('message');

// Get current date and initialize the month/year
let currentDate = new Date();
let currentMonth = currentDate.getMonth();
let currentYear = currentDate.getFullYear();
function renderCalendar() {
    const firstDayOfMonth = new Date(currentYear, currentMonth, 1);
    const lastDayOfMonth = new Date(currentYear, currentMonth + 1, 0);
    const numberOfDaysInMonth = lastDayOfMonth.getDate();
    const firstDayOfWeek = firstDayOfMonth.getDay(); 

    monthYearDisplay.textContent = `${firstDayOfMonth.toLocaleString('default', { month: 'long' })} ${currentYear}`;

    daysContainer.innerHTML = '';

    for (let i = 0; i < firstDayOfWeek; i++) {
        daysContainer.innerHTML += `<div class="day"></div>`;
    }

    for (let day = 1; day <= numberOfDaysInMonth; day++) {
        const dayElement = document.createElement('div');
        dayElement.classList.add('day');
        dayElement.textContent = day;

        const fullDate = `${currentYear}-${String(currentMonth + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;

        if (specialDates.includes(fullDate)) {
            dayElement.classList.add('highlight'); 
        }

        dayElement.addEventListener('click', () => editCourse(fullDate));
        daysContainer.appendChild(dayElement);
    }
}
//navigate to the edit page of the course giving the cou_id as $_POST
function editCourse(date){
  specialDates.forEach((elem, index) => {
      const infoData = info[index];
      if (elem == date){
          console.log(infoData[8]);
          const form = document.createElement('form');
          form.action = 'verify_id.html'; 
          form.method = 'POST';
      
          const idInput = document.createElement('input');
          idInput.type = 'hidden';
          idInput.name = 'cou_id';
          idInput.value = infoData[8];
          form.appendChild(idInput);
          document.body.appendChild(form);
          form.submit();
      }
  });
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

renderCalendar();
console.log(specialDates);
