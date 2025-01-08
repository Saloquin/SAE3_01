const prevMonthBtn = document.getElementById('prevMonth');
const nextMonthBtn = document.getElementById('nextMonth');
const monthYearDisplay = document.getElementById('monthYear');
const daysContainer = document.getElementById('days');
const messageDisplay = document.getElementById('message');

let data = [];

for (let i = 0; i < sessionData.length; i += 4) {
    let record = {
      description: sessionData[i],
      date: sessionData[i + 1],
      lastname: sessionData[i + 2],
      name: sessionData[i + 3]
    };
    data.push(record);
}
let cou = [];

for (let i = 0; i < sessionData.length; i += 2) {
    let record = {
      id: sessionData[i],
      date: sessionData[i + 1],
    };
    cou.push(record);
}

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
        dayElement.dataset.date = fullDate; 

        if (sessionData.includes(fullDate)) {
            dayElement.classList.add('highlight');
        }

        if (tt == 0) {
            dayElement.addEventListener('click', () => rateCourse(fullDate));
        } else if (tt == 1) {
            dayElement.addEventListener('click', () => showCourse(fullDate));
        }else{
            dayElement.addEventListener('click', () => editCourse(fullDate));
        }

        daysContainer.appendChild(dayElement);
    }
}

function editCourse(date){
    let isIn = false;
    cou.forEach((elem) => {
        
        if (elem.date == date) {
            isIn = true;
            
        }
    });
    if (!isIn){
        console.log("aaaaaaa");
        const form = document.getElementById('formulaire');
        const idInput = document.createElement('input');
        idInput.type = 'hidden';
        idInput.name = 'cou_date';
        idInput.value = date;
        form.appendChild(idInput);
        document.body.appendChild(form);
        form.submit();
    }

    const days = document.querySelectorAll('.day');

    days.forEach(day => {
        day.classList.remove('active');
    });

    // Add the 'active' class to the clicked day
    const clickedDay = document.querySelector(`[data-date='${date}']`);
    if (clickedDay) {
        clickedDay.classList.add('active');
    }


}

function rateCourse(date){
    sessionData.forEach((elem, index) => {
        const infoData = info[index];
        if (elem == date){
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

    const days = document.querySelectorAll('.day');

    days.forEach(day => {
        day.classList.remove('active');
    });

    // Add the 'active' class to the clicked day
    const clickedDay = document.querySelector(`[data-date='${date}']`);
    if (clickedDay) {
        clickedDay.classList.add('active');
    }
  }

function showCourse(date) {
    let first = false;
    let isIn = false;
    let str = "";

    data.forEach((elem) => {
        if (elem.date == date) {
            if (!first) { 
                str += elem.date + "<br>Aptitudes vues lors de la session avec " + elem.name + " " + elem.lastname + " : <br>";
                first = true;
            }
            str += elem.description + "<br> ";
            isIn = true;
        }
    });

    if (isIn) {
        messageDisplay.innerHTML = str;
    } else {
        messageDisplay.innerHTML = "";
    }


    const days = document.querySelectorAll('.day');

    days.forEach(day => {
        day.classList.remove('active');
    });

    const clickedDay = document.querySelector(`[data-date='${date}']`);
    if (clickedDay) {
        clickedDay.classList.add('active');
    }
}

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
