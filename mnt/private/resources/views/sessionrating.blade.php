<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion du cours - Journal de Plongée</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="./tailwind.config.js"></script>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>

<body class="triomphe flex flex-col items-center">

<p class="  text-[6vw] lg:text-[2vw] mb-[8vh]">Gestion du cours</p>

<p class="lg:text-[1vw] text-[3vw]">Niveau : 1</p>
<p class="lg:text-[1vw] text-[3vw]">Initiateur : Patrick Prof</p>
<p class="lg:text-[1vw] text-[3vw] mb-[18vh]">Date : 21/12/2024</p>

<div class=" flex flex-col justify-between ">
    <p class=" text-[3vw] lg:text-[1.3vw]">Liste des élèves</p>
    <form action="" method="post">
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
                <td>
                    <p class="table_header">Camille Camarade</p>
                </td>
                <td>
                    <select name="A11" id="">
                        <option value="1" selected>Non évaluée</option>
                        <option value="2">En cours d'acquisition</option>
                        <option value="3">Acquise</option>
                        <option value="4">Absent</option>
                    </select>
                </td>
                <td>
                    <select name="A12" id="">
                        <option value="1" selected>Non évaluée</option>
                        <option value="2">En cours d'acquisition</option>
                        <option value="3">Acquise</option>
                        <option value="4">Absent</option>
                    </select>
                </td>
                <td>
                    <select name="A13" id="">
                        <option value="1" selected>Non évaluée</option>
                        <option value="2">En cours d'acquisition</option>
                        <option value="3">Acquise</option>
                        <option value="4">Absent</option>
                    </select>
                </td>
                <td>
                    <input type="text" name="comment" id="" class="md:text-[0.8vw] text-[2vw] border-[0.05vw] rounded border-[#C6C6C6] pl-[0.5vw] py-[0.5vh] ml-[0.5vw]">
                </td>

            </tr>
            <tr class="">
                <input type="hidden" name="user" value="Camille Camarade">
                <td>
                    <p class="table_header">Camille Camarade</p>
                </td>
                <td>
                    <select name="A11" id="">
                        <option value="1" selected>Non évaluée</option>
                        <option value="2">En cours d'acquisition</option>
                        <option value="3">Acquise</option>
                        <option value="4">Absent</option>
                    </select>
                </td>
                <td>
                    <select name="A12" id="">
                        <option value="1" selected>Non évaluée</option>
                        <option value="2">En cours d'acquisition</option>
                        <option value="3">Acquise</option>
                        <option value="4">Absent</option>
                    </select>
                </td>
                <td>
                    <select name="A13" id="">
                        <option value="1" selected>Non évaluée</option>
                        <option value="2">En cours d'acquisition</option>
                        <option value="3">Acquise</option>
                        <option value="4">Absent</option>
                    </select>
                </td>
                <td>
                    <input type="text" name="comment" id="" class="md:text-[0.8vw] text-[2vw] border-[0.05vw] rounded border-[#C6C6C6] pl-[0.5vw] py-[0.5vh] ml-[0.5vw]">
                </td>

            </tr>
            <tr class="">
                <input type="hidden" name="user" value="Camille Camarade">
                <td>
                    <p class="table_header">Camille Camarade</p>
                </td>
                <td>
                    <select name="A11" id="">
                        <option value="1" selected>Non évaluée</option>
                        <option value="2">En cours d'acquisition</option>
                        <option value="3">Acquise</option>
                        <option value="4">Absent</option>
                    </select>
                </td>
                <td>
                    <select name="A12" id="">
                        <option value="1" selected>Non évaluée</option>
                        <option value="2">En cours d'acquisition</option>
                        <option value="3">Acquise</option>
                        <option value="4">Absent</option>
                    </select>
                </td>
                <td>
                    <select name="A13" id="">
                        <option value="1" selected>Non évaluée</option>
                        <option value="2">En cours d'acquisition</option>
                        <option value="3">Acquise</option>
                        <option value="4">Absent</option>
                    </select>
                </td>
                <td>
                    <input type="text" name="comment" id="" class="md:text-[0.8vw] text-[2vw] border-[0.05vw] rounded border-[#C6C6C6] pl-[0.5vw] py-[0.5vh] ml-[0.5vw]">
                </td>

            </tr>
            </tbody>
        </table>
    </form>
</div>

<div class="flex flex-row">
    <button type="submit" class="lg:text-[1vw] text-[3vw] rounded-[0.25vw] bg-[#1962A1] px-[1vw] py-[0.8vh] text-white mr-[5vw]">Modifier</button>
    <button class="lg:text-[1vw] text-[3vw] rounded-[0.25vw] bg-[#DD281F] px-[1vw] py-[0.8vh] text-white">Annuler</button>
</div>

</body>

<?php
require_once('../resources/includes/footer.php');
?>


</html>
