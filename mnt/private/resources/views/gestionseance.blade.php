<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création d'un cours - Journal de Plongée</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="./style/style.css">
</head>
<body class="flex items-center flex-col bg-gray-100 p-6">
    <h1 class="mb-10 text-4xl font-bold text-blue-600">Création d'une scéance de plongée</h1>
    <form action="{{ url('SessionManager/TraitementCreationSession') }}" method="post" class="bg-white shadow-md rounded px-8 pt-6 pb-8 w-full max-w-5xl">
        @csrf
        <!-- Date Selector -->
        <div class="mb-6">
            <label for="date" class="block text-gray-700 font-bold mb-2">Date de la session</label>
            <input type="date" id="date" name="date" class="shadow border rounded w-full py-2 px-3 text-gray-700" required>
        </div>

        <!-- Students Table -->
        <div class="mb-6">
            <h2 class="text-gray-700 font-bold mb-4">Élèves et leurs aptitudes</h2>
            <table class="table-auto w-full bg-gray-50 rounded shadow">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="px-4 py-2">Élève</th>
                        <th class="px-4 py-2">Aptitudes</th>
                        <th class="px-4 py-2">Initiateur</th> <!-- Nouvelle colonne pour l'initiateur -->
                        <th class="px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody id="students-table-body">
                    <!-- Rows added dynamically -->
                </tbody>
            </table>
            <button type="button" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded shadow" onclick="addStudentRow()">Ajouter un élève</button>
        </div>

        <!-- Submit Button -->
        <div class="flex justify-center">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Créer</button>
        </div>
    </form>

    <script>
        const studentsData = @json($student);
        const skillsData = @json($skills);
        const initiatorsData = @json($initiator);

        const usedStudents = new Set();
        const initiatorCounts = {};  

        function addStudentRow() {
            const tableBody = document.getElementById('students-table-body');

            const row = document.createElement('tr');
            row.className = "student-row";

            const studentCell = document.createElement('td');
            studentCell.className = "px-4 py-2";

            const studentSelect = document.createElement('select');
            studentSelect.className = "shadow border rounded w-full py-2 px-3 text-gray-700";
            studentSelect.name = "student[]";
            studentSelect.onchange = () => {
                restrictStudentSelection(studentSelect);
                const studentId = studentSelect.value;
                addAptitude(aptitudeCell, studentId);  
            };

            const defaultOption = document.createElement('option');
            defaultOption.value = "";
            defaultOption.textContent = "-- Sélectionnez un élève --";
            studentSelect.appendChild(defaultOption);

            studentsData.forEach(student => {
                if (!usedStudents.has(student.UTI_ID)) {
                    const option = document.createElement('option');
                    option.value = student.UTI_ID;
                    option.textContent = `${student.UTI_NOM} ${student.UTI_PRENOM}`;
                    studentSelect.appendChild(option);
                }
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
                const count = initiatorCounts[initiator.UTI_ID] || 0;
                if (count < 2) {  
                    const option = document.createElement('option');
                    option.value = initiator.UTI_ID;
                    option.textContent = `${initiator.UTI_NOM} ${initiator.UTI_PRENOM}`;
                    initiatorSelect.appendChild(option);
                }
            });

            studentSelect.onchange = () => {
                restrictStudentSelection(studentSelect);
                initiatorSelect.disabled = !studentSelect.value;  
                updateInitiatorOptions(initiatorSelect); 
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
                updateInitiatorOptions(initiatorSelect);
            };

            actionCell.appendChild(removeButton);

            row.appendChild(studentCell);
            row.appendChild(aptitudeCell);
            row.appendChild(initiatorCell);
            row.appendChild(actionCell);

            tableBody.appendChild(row);
        }

        function addAptitude(cell, studentId) {
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


        function restrictStudentSelection(select) {
            const previousValue = Array.from(usedStudents).find(id => select.options.namedItem(id));
            if (previousValue) usedStudents.delete(previousValue);
            usedStudents.add(select.value);
            updateInitiatorOptions(select);
        }

        function updateInitiatorOptions(select) {
            const initiatorSelects = document.querySelectorAll('select[name="initiator[]"]');
            initiatorSelects.forEach(initiatorSelect => {
                const initiatorOptions = initiatorSelect.querySelectorAll('option');
                initiatorOptions.forEach(option => {
                    const initiatorId = option.value;
                    const count = initiatorCounts[initiatorId] || 0;
                    if (count >= 2) {
                        option.disabled = true; 
                    } else {
                        option.disabled = false; 
                    }
                });
            });
        }
    </script>
</body>
</html>
