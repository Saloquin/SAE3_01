
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des compétences - Journal de Plongée</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="./js/tailwind.config.js"></script>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>

<body class="flex flex-col items-center triomphe">
<p class=" triomphe text-[6vw] lg:text-[2vw] mb-[10]">Gestion des compétences</p>

<div class=" flex flex-col justify-between ">
    <div class="flex flex-row justify-between mb-[1vh]">
        <p class="triomphe text-[3vw] lg:text-[1.3vw]">Liste des compétences</p>
        <button class=" triomphe lg:text-[1vw] text-[3vw] rounded-[0.25vw] bg-[#1962A1] px-[1vw] py-[0.8vh] text-white">Créer une compétence</button>
    </div>

    <table class="border-[0.1vw] rounded-[0.5vw] border-[#1962A1] mb-[10vh] border-separate border-spacing-[0.5vw]">
        <thead>
        <tr>
            <th class="table_header">ID</th>
            <th class="table_header">Compétence</th>
            <th class="table_header">Niveau</th>
        </tr>
        </thead>
        <tbody>
        <tr class="">
            <td class="table_cell">C1</td>
            <td class="table_cell">Nager</td>
            <td class="table_cell">N1</td>
            <td><button class="triomphe lg:text-[0.8vw] text-[2vw] rounded-[0.25vw] bg-[#1962A1] px-[1vw] py-[0.8vh] text-white">Gérer</button></td>
            <td><button class="triomphe lg:text-[0.8vw] text-[2vw] rounded-[0.25vw] bg-[#DD281F] px-[1vw] py-[0.8vh] text-white">X</button></td>
        </tr>

        <tr class="">
            <td class="table_cell">C1</td>
            <td class="table_cell">Nager</td>
            <td class="table_cell">N1</td>
            <td><button class="triomphe lg:text-[0.8vw] text-[2vw] rounded-[0.25vw] bg-[#1962A1] px-[1vw] py-[0.8vh] text-white">Gérer</button></td>
            <td><button class="triomphe lg:text-[0.8vw] text-[2vw] rounded-[0.25vw] bg-[#DD281F] px-[1vw] py-[0.8vh] text-white">X</button></td>
        </tr>



        <tr class="">
            <td class="table_cell">C1</td>
            <td class="table_cell">Nager</td>
            <td class="table_cell">N1</td>
            <td><button class="triomphe lg:text-[0.8vw] text-[2vw] rounded-[0.25vw] bg-[#1962A1] px-[1vw] py-[0.8vh] text-white">Gérer</button></td>
            <td><button class="triomphe lg:text-[0.8vw] text-[2vw] rounded-[0.25vw] bg-[#DD281F] px-[1vw] py-[0.8vh] text-white">X</button></td>
        </tr>

        </tbody>
    </table>
</div>

</body>

<?php
require_once('../resources/includes/footer.php');
?>

</html>
