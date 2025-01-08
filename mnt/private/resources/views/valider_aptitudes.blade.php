<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification de la progression des aptitudes des élèves</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="./style/style.css">
</head>
<body class="flex items-center flex-col bg-gray-100 p-6">
    <h1 class="mb-10 text-4xl font-bold text-blue-600">Modification de la progression des aptitudes des élèves</h1>
    <form action="{{ url('traitement_validation_aptitudes')}}" method="post" class="bg-white shadow-md rounded px-8 pt-6 pb-8 w-full max-w-lg">
        @csrf
        <div class="mb-4">
            <div>Date de la séance</div>
            <div><?= $session->COU_DATE; ?></div>
        </div>

        <input style="display: none" name="sessionId" value="<?= $sessionId; ?>">

        <input style="display: none" name="studentId1" value="<?= $studentId1; ?>">
        <input style="display: none" name="studentId2" value="<?= $studentId2; ?>">

        <select style="display: none" name="skills1[]" multiple>
            <?php foreach ($skills1 as $skill): ?>
                <option value="<?= $skill->APT_ID; ?>" selected><?= $skill->APT_ID; ?></option>
            <?php endforeach; ?>
        </select>
        
        <select style="display: none" name="skills2[]" multiple>
            <?php foreach ($skills2 as $skill): ?>
                <option value="<?= $skill->APT_ID; ?>" selected><?= $skill->APT_ID; ?></option>
            <?php endforeach; ?>
        </select>
        
        <div id="students-section" class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Élève 1</label>
            <div class="student-entry flex flex-col mb-4" data-student-index="0">
                <div class="flex items-center space-x-2 mb-2">
                    <?= htmlspecialchars($student1->UTI_NOM . " " . $student1->UTI_PRENOM); ?>
                </div>
                <div class="competencies-for-student flex flex-col space-y-2">
                    <label class="text-gray-700">Aptitudes :</label>
                    <div class="flex items-center space-x-2">
                        <?php foreach ($skills1 as $skill): ?>
                            <div>
                                <div><?= $skill->APT_LIBELLE; ?></div>
                                <select class="shadow border rounded w-full py-2 px-3 text-gray-700" name="mai_progress_student1_apt_<?= $skill->APT_ID; ?>">
                                    <option value="Non évaluée">Non évaluée</option>
                                    <option value="En cours d'acquisition">En cours d'acquisition</option>
                                    <option value="Acquise">Acquise</option>
                                    <option value="Absent">Absent</option>
                                </select>
                                <label for="commentary" class="block text-gray-700 font-bold mb-2">Commentaire</label>
                                <input type="text" id="commentary" name="commentary_student1_apt_<?= $skill->APT_ID; ?>" class="shadow border rounded w-full py-2 px-3 text-gray-700">
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        
        @if($studentId2)
        <div id="students-section" class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Élève 2</label>
            <div class="student-entry flex flex-col mb-4" data-student-index="0">
                <div class="flex items-center space-x-2 mb-2">
                    <?= htmlspecialchars($student2->UTI_NOM . " " . $student2->UTI_PRENOM); ?>
                </div>
                <div class="competencies-for-student flex flex-col space-y-2">
                    <label class="text-gray-700">Aptitudes :</label>
                    <div class="flex items-center space-x-2">
                        <?php foreach ($skills2 as $skill): ?>
                            <div>
                                <div><?= $skill->APT_LIBELLE; ?></div>
                                <select class="shadow border rounded w-full py-2 px-3 text-gray-700" name="mai_progress_student2_apt_<?= $skill->APT_ID; ?>">
                                    <option value="Non évaluée">Non évaluée</option>
                                    <option value="En cours d'acquisition">En cours d'acquisition</option>
                                    <option value="Acquise">Acquise</option>
                                    <option value="Absent">Absent</option>
                                </select>
                                <label for="commentary" class="block text-gray-700 font-bold mb-2">Commentaire</label>
                                <input type="text" id="commentary" name="commentary_student2_apt_<?= $skill->APT_ID; ?>" class="shadow border rounded w-full py-2 px-3 text-gray-700">
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <div class="flex justify-center">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Valider</button>
        </div>
    </form>
</body>
</html>
