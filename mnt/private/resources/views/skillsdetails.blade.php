<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Synthèse des compétences - Journal de Plongée</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="./js/tailwind.config.js"></script>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>

<body class="flex flex-col items-center triomphe">
<p class=" triomphe text-[6vw] lg:text-[2vw]">Synthèse des aptitudes et des compétences</p>
<p class="mb-[7vh] triomphe text-[6vw] lg:text-[2vw]">Titouan JEAN</p>

<div class=" flex flex-col justify-between ">

    <table class="border-[0.1vw] rounded-[0.5vw] border-[#1962A1] mb-[10vh] border-separate border-spacing-[0.5vw]">
        <thead>
        <tr>
            <th rowspan="2"></th>
            <th class="table_header bg-green-400" colspan="3">C1</th>
            <th class="table_header bg-orange-300" colspan="3">C2</th>
            <th class="table_header bg-orange-300" colspan="3">C3</th>
        </tr>
        <tr>
            <th class="table_header bg-green-400">A11</th>
            <th class="table_header bg-green-400">A12</th>
            <th class="table_header bg-green-400">A13</th>
            <th class="table_header bg-green-400">A21</th>
            <th class="table_header bg-orange-300">A22</th>
            <th class="table_header bg-green-400">A23</th>
            <th class="table_header bg-orange-300">A31</th>
            <th class="table_header bg-green-400">A32</th>
            <th class="table_header bg-orange-300">A33</th>
        </tr>
        </thead>
        <tbody>
        <tr class="">
            <th class="table_cell">22/10/18</th>
            <td class="table_cell bg-orange-300">En cours</td>
            <td class="table_cell"></td>
            <td class="table_cell"></td>
            <td class="table_cell bg-orange-300">En cours</td>
            <td class="table_cell"></td>
            <td class="table_cell"></td>
            <td class="table_cell"></td>
            <td class="table_cell bg-green-400">Acquis</td>
            <td class="table_cell"></td>
        </tr>
        <tr class="">
            <th class="table_cell">29/10/18</th>
            <td class="table_cell bg-orange-300">En cours</td>
            <td class="table_cell"></td>
            <td class="table_cell"></td>
            <td class="table_cell bg-orange-300">En cours</td>
            <td class="table_cell"></td>
            <td class="table_cell"></td>
            <td class="table_cell"></td>
            <td class="table_cell bg-green-400">Acquis</td>
            <td class="table_cell"></td>
        </tr>
        </tbody>
    </table>
</div>

<button class="lg:text-[1vw] text-[3vw] rounded-[0.25vw] bg-[#1962A1] px-[1vw] py-[0.8vh] text-white">Gestion des comptes</button>

</body>

<?php
require_once('../resources/includes/footer.php');
?>

</html>
