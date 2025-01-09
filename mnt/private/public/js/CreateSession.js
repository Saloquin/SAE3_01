document.addEventListener("DOMContentLoaded", () => {
    const tableHeader = document.getElementById('students-table-header');
    const tableBody = document.getElementById('students-table-body');

    function updateTableHeaderVisibility() {
        tableHeader.style.display = tableBody.children.length > 0 ? '' : 'none';
        document.getElementById('student-table-title').style.display = tableBody.children.length > 0 ? '' : 'none';
    }

    const studentsData = JSON.parse(document.getElementById('studentsData').textContent);
    const skillsData = JSON.parse(document.getElementById('skillsData').textContent);
    const initiatorsData = JSON.parse(document.getElementById('initiatorsData').textContent);

    const usedStudents = new Set();
    const initiatorCounts = {};
    const oldStudents = JSON.parse(document.getElementById('oldStudents').textContent);
    const oldCompetences = JSON.parse(document.getElementById('oldCompetences').textContent);
    const oldInitiators = JSON.parse(document.getElementById('oldInitiators').textContent);
    const studentDataExisting = JSON.parse(document.getElementById('studentDataExisting').textContent);

    const buttonStudent = document.getElementById('addStudentButton');
    buttonStudent.addEventListener('click', () => addStudentRow());

    updateTableHeaderVisibility();

    if (studentDataExisting && Object.keys(studentDataExisting).length > 0) {
        populateTableWithExistingData(studentDataExisting);
    }

    function addStudentRow() {
        const row = document.createElement('tr');
        row.className = "student-row";

        const studentCell = document.createElement('td');
        studentCell.className = "px-4 py-2";
        const studentSelect = document.createElement('select');
        studentSelect.className = "shadow border rounded w-full py-2 px-3 text-gray-700";
        studentSelect.name = "student[]";

        const defaultOption = document.createElement('option');
        defaultOption.value = "";
        defaultOption.textContent = "-- Sélectionnez un élève --";
        studentSelect.appendChild(defaultOption);

        studentsData.forEach(student => {
            const option = document.createElement('option');
            option.value = student.UTI_ID;
            option.textContent = `${student.UTI_NOM} ${student.UTI_PRENOM}`;
            studentSelect.appendChild(option);
        });

        studentCell.appendChild(studentSelect);

        const aptitudeCell = document.createElement('td');
        aptitudeCell.className = "px-4 py-2";
        const addAptitudeButton = document.createElement('button');
        addAptitudeButton.type = "button";
        addAptitudeButton.textContent = "Ajouter une aptitude";
        addAptitudeButton.className = "bg-green-500 text-white px-4 py-2 rounded shadow";
        addAptitudeButton.onclick = () => {
            const studentId = studentSelect.value;
            if (studentId) {
                addAptitude(aptitudeCell, studentId);
            }
        };

        aptitudeCell.appendChild(addAptitudeButton);

        const initiatorCell = document.createElement('td');
        initiatorCell.className = "px-4 py-2";
        const initiatorSelect = document.createElement('select');
        initiatorSelect.className = "shadow border rounded w-full py-2 px-3 text-gray-700";
        initiatorSelect.name = "initiator[]";
        initiatorSelect.disabled = true;

        const initiatorDefaultOption = document.createElement('option');
        initiatorDefaultOption.value = "";
        initiatorDefaultOption.textContent = "-- Sélectionnez un initiateur --";
        initiatorSelect.appendChild(initiatorDefaultOption);

        initiatorsData.forEach(initiator => {
            const option = document.createElement('option');
            option.value = initiator.UTI_ID;
            option.textContent = `${initiator.UTI_NOM} ${initiator.UTI_PRENOM}`;
            initiatorSelect.appendChild(option);
        });

        studentSelect.onchange = () => {
            const previousValue = studentSelect.getAttribute('data-previous-value');
            if (previousValue) {
                usedStudents.delete(previousValue);
            }

            const currentValue = studentSelect.value;
            if (currentValue) {
                usedStudents.add(currentValue);
            }

            studentSelect.setAttribute('data-previous-value', currentValue);
            updateStudentOptions();
            initiatorSelect.disabled = !currentValue;
            updateInitiatorOptions();
        };

        initiatorSelect.onchange = () => {
            const previousValue = initiatorSelect.getAttribute('data-previous-value');
            if (previousValue) {
                initiatorCounts[previousValue] = Math.max(0, (initiatorCounts[previousValue] || 0) - 1);
            }

            const currentValue = initiatorSelect.value;
            if (currentValue) {
                initiatorCounts[currentValue] = (initiatorCounts[currentValue] || 0) + 1;
            }

            initiatorSelect.setAttribute('data-previous-value', currentValue);
            updateInitiatorOptions();
        };

        initiatorCell.appendChild(initiatorSelect);

        const actionCell = document.createElement('td');
        actionCell.className = "px-4 py-2 text-center";
        const removeButton = document.createElement('button');
        removeButton.type = "button";
        removeButton.textContent = "Supprimer";
        removeButton.className = "bg-red-500 text-white px-4 py-2 rounded shadow";
        removeButton.onclick = () => {
            usedStudents.delete(studentSelect.value);
            const initiatorId = initiatorSelect.value;
            if (initiatorId) {
                initiatorCounts[initiatorId] = Math.max(0, (initiatorCounts[initiatorId] || 0) - 1);
            }
            row.remove();
            updateStudentOptions();
            updateInitiatorOptions();
            updateTableHeaderVisibility();
        };

        actionCell.appendChild(removeButton);

        row.appendChild(studentCell);
        row.appendChild(aptitudeCell);
        row.appendChild(initiatorCell);
        row.appendChild(actionCell);

        tableBody.appendChild(row);
        updateTableHeaderVisibility();
        updateStudentOptions();
    }

    function addAptitude(cell, studentId) {
        const existingAptitudes = cell.querySelectorAll('select[name^="competences["]');
        if (existingAptitudes.length >= 3) {
            alert("Un élève ne peut avoir que 3 aptitudes au maximum.");
            return;
        }

        const aptitudeRow = document.createElement('div');
        aptitudeRow.className = "flex items-center space-x-2 mt-2";

        const select = document.createElement('select');
        select.className = "shadow border rounded w-full py-2 px-3 text-gray-700";
        select.name = `competences[${studentId}][]`;

        skillsData.forEach(skill => {
            const option = document.createElement('option');
            option.value = skill.APT_ID;
            option.textContent = skill.APT_LIBELLE;
            select.appendChild(option);
        });

        const removeButton = document.createElement('button');
        removeButton.type = "button";
        removeButton.textContent = "Retirer";
        removeButton.className = "bg-red-500 text-white px-4 py-2 rounded shadow";
        removeButton.onclick = () => aptitudeRow.remove();

        aptitudeRow.appendChild(select);
        aptitudeRow.appendChild(removeButton);

        cell.insertBefore(aptitudeRow, cell.lastElementChild);
    }

    function updateStudentOptions() {
        const studentSelects = document.querySelectorAll('select[name="student[]"]');
        studentSelects.forEach(studentSelect => {
            let selected = studentSelect.selectedOptions[0].value;
            const studentOptions = studentSelect.querySelectorAll('option');
            studentOptions.forEach(option => {
                const studentId = option.value;
                option.disabled = usedStudents.has(studentId) && studentId !== selected;
            });
        });
    }

    function updateInitiatorOptions() {
        const initiatorSelects = document.querySelectorAll('select[name="initiator[]"]');
        initiatorSelects.forEach(initiatorSelect => {
            const selectedValue = initiatorSelect.value;
            const initiatorOptions = initiatorSelect.querySelectorAll('option');
            initiatorOptions.forEach(option => {
                const initiatorId = option.value;
                const count = initiatorCounts[initiatorId] || 0;
                option.disabled = count >= 2 && initiatorId !== selectedValue;
            });
        });
    }

    function populateTableWithExistingData(existingData) {
        Object.entries(existingData).forEach(([index, data]) => {
            addStudentRow();
            const studentSelect = document.querySelectorAll('select[name="student[]"]')[index];
            const initiatorSelect = document.querySelectorAll('select[name="initiator[]"]')[index];

            studentSelect.value = data.studentId;
            initiatorSelect.value = data.initiatorId;

            if (data.initiatorId) {
                initiatorCounts[data.initiatorId] = (initiatorCounts[data.initiatorId] || 0) + 1;
            }

            data.aptitudes.forEach(aptitudeId => {
                const cell = studentSelect.closest('tr').children[1];
                addAptitude(cell, data.studentId);
            });
        });

        updateInitiatorOptions();
    }

    oldStudents.forEach((studentId, index) => {
        addStudentRow();
        const studentSelect = document.querySelectorAll('select[name="student[]"]')[index];
        const initiatorSelect = document.querySelectorAll('select[name="initiator[]"]')[index];
        const studentCompetences = oldCompetences[studentId] || [];
        const initiatorId = oldInitiators[index] || "";

        studentSelect.value = studentId;
        initiatorSelect.value = initiatorId;

        if (initiatorId) {
            initiatorCounts[initiatorId] = (initiatorCounts[initiatorId] || 0) + 1;
        }

        studentCompetences.forEach(competence => {
            const cell = studentSelect.closest('tr').children[1];
            addAptitude(cell, studentId);
        });
    });

    updateInitiatorOptions();
});
