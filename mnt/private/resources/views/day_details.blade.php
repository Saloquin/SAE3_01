
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Détails du jour</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="./js/tailwind.config.js"></script>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>

<?php
require_once('../resources/includes/header.php');
?>

<body class="flex flex-col items-center triomphe">
<p class=" triomphe text-[6vw] lg:text-[2vw] mb-[7vh]">Détails 12 février</p>

<div class=" flex flex-col justify-between min-w-20 ">
    <div class="flex flex-row justify-between mb-[1vh]">
        <p class="triomphe text-[3vw] lg:text-[1.3vw]">Liste des cours</p>
        <button class=" triomphe lg:text-[1vw] text-[3vw] rounded-[0.25vw] bg-[#1962A1] px-[1vw] py-[0.8vh] text-white">Ajouter un cours</button>
    </div>

    <table class="border-[0.1vw] rounded-[0.5vw] border-[#1962A1] mb-[10vh] border-separate border-spacing-[0.5vw]">
        <thead>
        <tr class="flex justify-start">
            <th class="text-[2vw] lg:text-[1vw] triomphe">Initiateur</th>
        </tr>
        </thead>
        <tbody>
        <tr class="flex justify-between">
            <td class="lg:text-[0.8vw] text-[1.5vw] triomphe">Yves Ynitiation</td>
            <td><button class="triomphe lg:text-[0.8vw] text-[2vw] rounded-[0.25vw] bg-[#1962A1] px-[1vw] py-[0.8vh] text-white">Détails</button></td>
        </tr>
        <tr class="flex justify-between">
            <td class="lg:text-[0.8vw] text-[1.5vw] triomphe">Isabelle Initie</td>
            <td><button class="triomphe lg:text-[0.8vw] text-[2vw] rounded-[0.25vw] bg-[#1962A1] px-[1vw] py-[0.8vh] text-white">Détails</button></td>
        </tr>
        </tbody>
    </table>
</div>

</body>

<?php
require_once('../resources/includes/footer.php');
?>


</html>
