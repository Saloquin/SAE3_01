
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel directeur - Journal de Plongée</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="./js/tailwind.config.js"></script>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<?php
require_once('../resources/includes/header.php');
?>


<body class="flex flex-col items-center triomphe">
<button class="lg:text-[1vw] text-[3vw] rounded-[0.25vw] bg-[#1962A1] px-[1vw] py-[0.8vh] text-white">Gestion des comptes</button>
<button class="lg:text-[1vw] text-[3vw] rounded-[0.25vw] bg-[#1962A1] px-[1vw] py-[0.8vh] text-white">Gestion des formations</button>


<p class=" triomphe text-[6vw] lg:text-[2vw]">Panel directeur</p>
<p class="mb-[7vh] triomphe text-[6vw] lg:text-[2vw]">Titouan JEAN</p>

<div class=" flex flex-col justify-between ">
    <div class="flex flex-row justify-between mb-[1vh]">
        <p class="triomphe text-[3vw] lg:text-[1.3vw]">Liste des formations</p>
        <button class=" triomphe lg:text-[1vw] text-[3vw] rounded-[0.25vw] bg-[#1962A1] px-[1vw] py-[0.8vh] text-white">Ajouter une formation</button>
    </div>

    <table class="border-[0.1vw] rounded-[0.5vw] border-[#1962A1] mb-[10vh] border-separate border-spacing-[0.5vw]">
        <thead>
        <tr>
            <th class="text-[2vw] lg:text-[1vw] triomphe">Niveau</th>
            <th class="text-[2vw] lg:text-[1vw] triomphe">Date de début</th>
        </tr>
        </thead>
        <tbody>
        <tr class="">
            <td class="text-[0.8vw] triomphe">1</td>
            <td class="text-[0.8vw] triomphe">01/09/2024</td>
            <td><button class=" triomphe lg:text-[0.8vw] text-[2vw] rounded-[0.25vw] bg-[#1962A1] px-[1vw] py-[0.8vh] text-white">Liste des initiateurs</button></td>
            <td><button class="triomphe lg:text-[0.8vw] text-[2vw] rounded-[0.25vw] bg-[#1962A1] px-[1vw] py-[0.8vh] text-white">Liste des élèves</button></td>
            <td><button class="triomphe lg:text-[0.8vw] text-[2vw] rounded-[0.25vw] bg-[#1962A1] px-[1vw] py-[0.8vh] text-white">Détails</button></td>

        </tr>
        <tr class="">
            <td class="triomphe text-[0.8vw]">2</td>
            <td class="triomphe text-[0.8vw]">04/09/2024</td>
            <td><button class="triomphe lg:text-[0.8vw] text-[2vw] rounded-[0.25vw] bg-[#1962A1] px-[1vw] py-[0.8vh] text-white">Liste des initiateurs</button></td>
            <td><button class="triomphe lg:text-[0.8vw] text-[2vw] rounded-[0.25vw] bg-[#1962A1] px-[1vw] py-[0.8vh] text-white">Liste des élèves</button></td>
            <td><button class="triomphe lg:text-[0.8vw] text-[2vw] rounded-[0.25vw] bg-[#1962A1] px-[1vw] py-[0.8vh] text-white">Détails</button></td>
        </tr>
        </tbody>
    </table>
</div>

<?php
require_once('../resources/includes/footer.php');
?>
</body>
</html>
