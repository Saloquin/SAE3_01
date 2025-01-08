<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Directeur - Journal de Plongée</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="./tailwind.config.js"></script>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<?php
require_once('../resources/includes/header.php');
?>
<body class="triomphe flex flex-col items-center">

<p class="  text-[6vw] lg:text-[2vw] mb-[8vh]">Détails du cours</p>

<p class="lg:text-[1vw] text-[3vw]">Niveau : 1</p>
<p class="lg:text-[1vw] text-[3vw]">Initiateur : Patrick Prof</p>
<p class="lg:text-[1vw] text-[3vw] mb-[18vh]">Date : 21/12/2024</p>

<div class=" flex flex-col justify-between ">


    <div class=" flex flex-col justify-between ">
        <p class=" text-[3vw] lg:text-[1.3vw]">Liste des élèves</p>
            <table class="border-[0.1vw] rounded-[0.5vw] bg-[#1962A1]/20 mb-[10vh] border-separate border-spacing-[0.5vw]">
                <thead>
                <tr>
                    <th></th>
                    <th class="table_header">A11</th>
                    <th class="table_header">A12</th>
                    <th class="table_header">A13</th>
                    <th class="table_header">Commentaire</th>
                </tr>
                </thead>
                <tbody>
                <tr class="">
                    <input type="hidden" name="user" value="Camille Camarade">
                    <td class="table_cell">Camille Camarade</td>
                    <td class="table_cell">Acquise</td>
                    <td class="table_cell">En cours d'acquisition</td>
                    <td class="table_cell">En cours d'acquisition</td>
                    <td class="table_cell">Super fort !</td>

                </tr>
                <tr class="">
                    <input type="hidden" name="user" value="Camille Camarade">
                    <td class="table_cell">Camille Camarade</td>
                    <td class="table_cell">Acquise</td>
                    <td class="table_cell">En cours d'acquisition</td>
                    <td class="table_cell">En cours d'acquisition</td>
                    <td class="table_cell">Super fort !</td>

                </tr>
                <tr class="">
                    <input type="hidden" name="user" value="Camille Camarade">
                    <td class="table_cell">Camille Camarade</td>
                    <td class="table_cell">Acquise</td>
                    <td class="table_cell">En cours d'acquisition</td>
                    <td class="table_cell">En cours d'acquisition</td>
                    <td class="table_cell">Super fort !</td>

                </tr>
                </tbody>
            </table>
    </div>
</div>

</body>

<?php
require_once('../resources/includes/footer.php');
?>
</html>
