<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du cours - Journal de Plongée</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="./tailwind.config.js"></script>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<?php
include resource_path('includes/header.php');
?>
<body class="triomphe flex flex-col items-center">

<p class="  text-[6vw] md:text-[2vw] mb-[8vh]">Détails du cours</p>

<p class="md:text-[2.5vw] text-[5vw]">Niveau : 1</p>
<p class="md:text-[2.5vw] text-[5vw]">Initiateur : Patrick Prof</p>
<p class="md:text-[2.5vw] text-[5vw] mb-[10vh]">Date : 21/12/2024</p>

<div class=" flex flex-col justify-between session-table">


    <p class=" text-[5vw] lg:text-[2vw]">Liste des élèves</p>
    <table class="border-[0.1vw] rounded-[0.5vw] bg-[#1962A1]/20 mb-[10vh] border-separate border-spacing-[0.5vw]">
        <tbody>
        <tr class="">
            <td class="md:text-[1.5vw] text-[4vw]">Camille Camarade</td>
        </tr>
        <tr class="">
            <td class="md:text-[1.5vw] text-[4vw]">Quentin Quopin</td>
        </tr>
        </tbody>
    </table>
</div>

</body>

<?php
include resource_path('includes/footer.php');
?>
</html>
