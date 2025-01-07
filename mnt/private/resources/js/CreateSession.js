// Wait for the DOM to load before executing the script
document.addEventListener('DOMContentLoaded', () => {
    // Get references to form elements
    const form = document.getElementById('sessionForm');
    const studentsSelect = document.getElementById('students');
    const teachersSelect = document.getElementById('teachers');
    const createButton = document.getElementById('createButton');

    form.addEventListener('submit', (event) => {
        const selectedStudents = Array.from(studentsSelect.selectedOptions).length;
        const selectedTeachers = Array.from(teachersSelect.selectedOptions).length;

        if (selectedStudents / 2 > selectedTeachers) {
            alert('Le nombre de formateurs doit être au moins égal à la moitié du nombre d\'élèves.');
            event.preventDefault(); 
        }
    });
});

