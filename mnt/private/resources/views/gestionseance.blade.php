<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création d'un cours de plongée</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body class="flex items-center flex-col bg-blue-50 p-6">
    <h1 class="mb-10 text-4xl font-bold text-blue-700">Création d'une séance de plongée</h1>

    @if(session('error'))
        <div class="bg-red-500 text-white px-4 py-3 mb-6 rounded">
            {{ session('error') }}
        </div>
    @endif

    @if(session('success'))
        <div class="bg-green-500 text-white px-4 py-3 mb-6 rounded">
            {{ session('success') }}
        </div>
    @endif   

    <form action="{{ url('responsable-formation/TraitementCreationSession') }}" method="post" class="bg-white shadow-xl rounded-lg px-8 pt-6 pb-8 w-full max-w-4xl">
        <input type="hidden" name="course_id" value="{{ $course ? $course->COU_ID : '' }}">
        @csrf
        <div class="mb-6">
            <label for="session_date" class="block text-blue-700 font-semibold mb-2">Date de la séance</label>
            <input type="text" 
                   id="session_date" 
                   name="session_date" 
                   value="{{ $date }}" 
                   class="bg-gray-100 border border-gray-300 text-gray-800 text-sm rounded-lg block w-full p-2.5"
                   readonly>
        </div>

        <div class="mb-6">
            <h2 class="text-blue-700 font-semibold mb-4" id="student-table-title">Élèves et leurs aptitudes</h2>
            <div class="overflow-x-auto bg-blue-50 rounded-lg shadow-lg">
                <table class="table-auto w-full text-sm text-left text-gray-700">
                    <thead id="students-table-header" class="text-xs text-white uppercase bg-blue-600">
                        <tr>
                            <th class="px-6 py-3">Élève</th>
                            <th class="px-6 py-3">Aptitudes</th>
                            <th class="px-6 py-3">Initiateur</th>
                            <th class="px-6 py-3"></th>
                        </tr>
                    </thead>
                    <tbody id="students-table-body">
                    </tbody>
                </table>
            </div>
            <button type="button" class="mt-4 bg-blue-600 text-white px-4 py-2 rounded-lg shadow-lg hover:bg-blue-700" id="addStudentButton">Ajouter un élève</button>
        </div>

        <div class="flex justify-center mt-6">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg shadow-lg transition duration-300">Créer</button>
        </div>
    </form>

    <script id="studentsData" type="application/json">@json($student)</script>
    <script id="skillsData" type="application/json">@json($skills)</script>
    <script id="initiatorsData" type="application/json">@json($initiator)</script>
    <script id="oldStudents" type="application/json">@json(old('student', []))</script>
    <script id="oldCompetences" type="application/json">@json(old('competences', []))</script>
    <script id="oldInitiators" type="application/json">@json(old('initiator', []))</script>
    <script id="studentDataExisting" type="application/json">@json($students_data)</script>
    <script>
        function updateSessionData() {
            var date = document.getElementById('date').value;
            console.log(date)
            $.ajax({
                url: "{{ url('responsable-formation/gestion-seance') }}",
                method: "GET",
                data: {
                    date: date
                },
                success: function(response) {
                    console.log(response)
                    location.href = '/responsable-formation/gestion-seance'
                },
                error: function() {
                    alert('Erreur lors de la récupération des données');
                }
            });
        }
    </script>
    
    <script>
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

            function addAptitude(cell, studentId, aptitudeId = null) {
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

                    if (aptitudeId && skill.APT_ID == aptitudeId) {
                        option.selected = true;
                    }

                    const alreadySelected = Array.from(cell.querySelectorAll('select')).some(existingSelect => 
                        existingSelect.value == skill.APT_ID && skill.APT_ID != aptitudeId
                    );
                    option.disabled = alreadySelected;

                    select.appendChild(option);
                });

                select.addEventListener('change', () => {
                    updateAptitudeOptions(cell, studentId);
                });

                const removeButton = document.createElement('button');
                removeButton.type = "button";
                removeButton.textContent = "Retirer";
                removeButton.className = "bg-red-500 text-white px-4 py-2 rounded shadow";
                removeButton.onclick = () => {
                    aptitudeRow.remove();
                    updateAptitudeOptions(cell, studentId);
                };

                aptitudeRow.appendChild(select);
                aptitudeRow.appendChild(removeButton);

                cell.insertBefore(aptitudeRow, cell.lastElementChild);
                updateAptitudeOptions(cell, studentId);
            }


            function updateAptitudeOptions(cell, studentId) {
                const selectedAptitudes = Array.from(cell.querySelectorAll('select[name^="competences["]')).map(select => select.value);

                cell.querySelectorAll('select[name^="competences["]').forEach(select => {
                    const currentValue = select.value;
                    Array.from(select.options).forEach(option => {
                        option.disabled = selectedAptitudes.includes(option.value) && option.value !== currentValue;
                    });
                });
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
                console.log(existingData);
                Object.entries(existingData).forEach(([index, data]) => {
                    console.log(index);
                    addStudentRow();

                    const studentSelect = document.querySelectorAll('select[name="student[]"]')[document.querySelectorAll('select[name="student[]"]').length - 1];
                    const initiatorSelect = document.querySelectorAll('select[name="initiator[]"]')[document.querySelectorAll('select[name="initiator[]"]').length - 1];

                    studentSelect.value = index;
                    const selectedOption = studentSelect.querySelector(`option[value="${index}"]`);
                    if (selectedOption) {
                        selectedOption.selected = true;
                    }

                    const initiatorId = data.initiator_id;
                    initiatorSelect.value = initiatorId;
                    const selectedInitiatorOption = initiatorSelect.querySelector(`option[value="${initiatorId}"]`);
                    if (selectedInitiatorOption) {
                        selectedInitiatorOption.selected = true;
                    }

                    const aptitudeCell = studentSelect.closest('tr').children[1];
                    data.aptitudes.forEach((aptitudeId, i) => {
                        if (i < 3) {
                            addAptitude(aptitudeCell, index, aptitudeId);
                        }
                    });
                });

                updateStudentOptions();
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

    </script>

    <?php require_once('../resources/includes/footer.php')?>
</body>
</html>