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

<?php
require_once('../resources/includes/header.php');
?>

<body class="flex flex-col items-center triomphe">
<p class=" triomphe text-[6vw] lg:text-[2vw]">Synthèse des aptitudes et des compétences</p>
<p class="mb-[7vh] triomphe text-[6vw] lg:text-[2vw]">Groupe Formation N1</p>

<div class=" flex flex-col justify-between ">

    <table class="border-[0.1vw] rounded-[0.5vw] border-[#1962A1] mb-[10vh] border-separate border-spacing-[0.5vw]">
        <thead>
        <tr>
            <th rowspan="2"></th>
            <th class="table_header" colspan="3">C1</th>
            <th class="table_header" colspan="3">C2</th>
            <th class="table_header" colspan="3">C3</th>
        </tr>
        <tr>
            <th class="table_header">A11</th>
            <th class="table_header">A12</th>
            <th class="table_header">A13</th>
            <th class="table_header">A21</th>
            <th class="table_header">A22</th>
            <th class="table_header">A23</th>
            <th class="table_header">A31</th>
            <th class="table_header">A32</th>
            <th class="table_header">A33</th>
        </tr>
        </thead>
        <tbody>
        <tr class="">
            <th class="table_cell">Élève 1</th>
            <td class="table_cell bg-orange-300">En cours</td>
            <td class="table_cell bg-green-400">Acquis</td>
            <td class="table_cell bg-green-400">Acquis</td>
            <td class="table_cell bg-orange-300">En cours</td>
            <td class="table_cell bg-green-400">Acquis</td>
            <td class="table_cell bg-orange-300">En cours</td>
            <td class="table_cell bg-orange-300">En cours</td>
            <td class="table_cell bg-green-400">Acquis</td>
            <td class="table_cell bg-orange-300">En cours</td>
        </tr>
        <tr class="">
            <th class="table_cell">Élève 1</th>
            <td class="table_cell bg-orange-300">En cours</td>
            <td class="table_cell bg-green-400">Acquis</td>
            <td class="table_cell bg-green-400">Acquis</td>
            <td class="table_cell bg-orange-300">En cours</td>
            <td class="table_cell bg-green-400">Acquis</td>
            <td class="table_cell bg-orange-300">En cours</td>
            <td class="table_cell bg-orange-300">En cours</td>
            <td class="table_cell bg-green-400">Acquis</td>
            <td class="table_cell bg-orange-300">En cours</td>
        </tr>
        </tbody>
    </table>
</div>

</body>

<?php
require_once('../resources/includes/footer.php');
?>

</html>
