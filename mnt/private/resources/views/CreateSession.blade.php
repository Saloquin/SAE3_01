<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Creation - Diving Journal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="./tailwind.config.js"></script>
    <link rel="stylesheet" href="./style/style.css">
</head>
<body class="flex items-center flex-col">
    <h1 class="mb-[7vh] triomphe text-[6vw] lg:text-[2vw]">Course Creation</h1>
    <form action="" method="post">
        <!-- Students List -->
        <p class="lg:text-[1vw] text-[3vw]">Students</p>
        <select class="mb-[3vh] border-[0.1vw] rounded p-[0.2vw]" name="student" multiple>
            <?php
            foreach ($student as $student): ?>
                <option value="<?= $student->UTI_ID; ?>">
                    <?= htmlspecialchars($student->UTI_NOM . " " . $student->UTI_PRENOM); ?>
                </option>
            <?php endforeach; ?>
        </select>

        <!-- Initiators List -->
        <p class="lg:text-[1vw] text-[3vw]">Initiators</p>
        <select class="mb-[3vh] border-[0.1vw] rounded p-[0.2vw]" name="teacher" multiple>
            <?php
            foreach ($initiator as $initiator): ?>
                <option value="<?= $initiator->UTI_ID; ?>">
                    <?= htmlspecialchars($initiator->UTI_NOM . " " . $initiator->UTI_PRENOM); ?>
                </option>
            <?php endforeach; ?>
        </select>

        <!-- Competencies List -->
        <p class="lg:text-[1vw] text-[3vw]">Competencies</p>
        <select class="mb-[3vh] border-[0.1vw] rounded p-[0.2vw]" name="competence" multiple>
            <?php
            foreach ($skills as $competence): ?>
                <option value="<?= $competence->APT_ID; ?>">
                    <?= htmlspecialchars($competence->APT_LIBELLE);  ?>
                </option>
            <?php endforeach; ?>
        </select>

        <!-- Submit Button -->
        <div class="flex justify-center">
            <button type="submit" class="lg:text-[1vw] text-[3vw] rounded-[0.25vw] bg-[#1962A1] px-[1vw] py-[0.8vh] text-white">Créai</button>
        </div>
    </form>
</body>
</html>

