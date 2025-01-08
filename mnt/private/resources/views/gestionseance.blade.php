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
    <h1 class="mb-10 text-4xl font-bold text-blue-600">Création d'un cours de plongée</h1>
    <form action="{{ url('SessionManager/TraitementCreationSession')}}" method="post" class="bg-white shadow-md rounded px-8 pt-6 pb-8 w-full max-w-lg">
        @csrf
        <!-- Date Selector -->
        <div class="mb-4">
            <label for="date" class="block text-gray-700 font-bold mb-2">Date de la session</label>
            <input type="date" id="date" name="date" class="shadow border rounded w-full py-2 px-3 text-gray-700" required>
        </div>

        <!-- Students Section -->
        <div id="students-section" class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Élèves</label>
            <div class="flex items-center space-x-2 mb-2">
                <select class="shadow border rounded w-full py-2 px-3 text-gray-700" name="student[]">
                    <?php foreach ($student as $stu): ?>
                        <option value="<?= $stu->UTI_ID; ?>">
                            <?= htmlspecialchars($stu->UTI_NOM . " " . $stu->UTI_PRENOM); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <button type="button" class="bg-blue-500 text-white px-4 py-2 rounded shadow" onclick="addField('students-section', 'student[]')">+ Ajouter</button>
            </div>
        </div>

        <!-- Initiators Section -->
        <div id="initiators-section" class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Initiateur</label>
            <div class="flex items-center space-x-2 mb-2">
                <select class="shadow border rounded w-full py-2 px-3 text-gray-700" name="teacher[]">
                    <?php foreach ($initiator as $init): ?>
                        <option value="<?= $init->UTI_ID; ?>">
                            <?= htmlspecialchars($init->UTI_NOM . " " . $init->UTI_PRENOM); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <button type="button" class="bg-blue-500 text-white px-4 py-2 rounded shadow" onclick="addField('initiators-section', 'teacher[]')">+ Ajouter</button>
            </div>
        </div>

        <!-- Competencies Section -->
        <div id="competencies-section" class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Aptitudes</label>
            <div class="flex items-center space-x-2 mb-2">
                <select class="shadow border rounded w-full py-2 px-3 text-gray-700" name="competence[]">
                    <?php foreach ($skills as $skill): ?>
                        <option value="<?= $skill->APT_ID; ?>">
                            <?= htmlspecialchars($skill->APT_LIBELLE); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <button type="button" class="bg-blue-500 text-white px-4 py-2 rounded shadow" onclick="addField('competencies-section', 'competence[]')">+ Ajouter</button>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="flex justify-center">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Créer</button>
        </div>
    </form>

    <!-- Script for dynamic field addition -->
    <script>
        function addField(sectionId, fieldName) {
            const section = document.getElementById(sectionId);
            const newField = document.createElement('div');
            newField.className = 'flex items-center space-x-2 mb-2';
            newField.innerHTML = `
                <select class="shadow border rounded w-full py-2 px-3 text-gray-700" name="${fieldName}">
                    ${section.querySelector('select').innerHTML}
                </select>
                <button type="button" class="bg-red-500 text-white px-4 py-2 rounded shadow" onclick="this.parentElement.remove()">- Retirer</button>
            `;
            section.appendChild(newField);
        }
    </script>
</body>
</html>
