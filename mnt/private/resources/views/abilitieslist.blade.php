
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
<body class="flex flex-col items-center triomphe">
<p class=" triomphe text-[6vw] lg:text-[2vw] mb-[4vh]">Détails C1</p>
<p class=" triomphe text-[6vw] lg:text-[2vw] mb-[7vh]">Apprendre à nager</p>

<div class=" flex flex-col justify-between min-w-20 ">
    <div class="flex flex-row justify-between mb-[1vh]">
        <p class="triomphe text-[3vw] lg:text-[1.3vw]">Liste des aptitudes</p>
    </div>

    <table class="border-[0.1vw] rounded-[0.5vw] border-[#1962A1] mb-[10vh] border-separate border-spacing-[0.5vw]">
        <thead>
        <tr class="">
            <th class="text-[2vw] lg:text-[1vw] triomphe">ID</th>
            <th class="text-[2vw] lg:text-[1vw] triomphe">Aptitude</th>
        </tr>
        </thead>
        <tbody>
        <tr class="">
            <th class="lg:text-[0.8vw] text-[1.5vw] triomphe">A1</th>
            <td class="lg:text-[0.8vw] text-[1.5vw] triomphe">Mettre une jambe dans l'eau</td>
            <td><button class="triomphe lg:text-[0.8vw] text-[2vw] rounded-[0.25vw] bg-[#DD281F] px-[1vw] py-[0.8vh] text-white">X</button></td>
        </tr>
        <tr class="">
            <th class="lg:text-[0.8vw] text-[1.5vw] triomphe">A2</th>
            <td class="lg:text-[0.8vw] text-[1.5vw] triomphe">Mettre l'autre jambe dans l'eau</td>
            <td><button class="triomphe lg:text-[0.8vw] text-[2vw] rounded-[0.25vw] bg-[#DD281F] px-[1vw] py-[0.8vh] text-white">X</button></td>
        </tr>
        </tbody>
    </table>

    <div class="flex justify-around mb-[5vh]">
        <form action="" method="post">
            @csrf
            <select name="ability" id="">
                <option value="1">A13</option>
                <option value="1">A14</option>
            </select>
            <button class=" triomphe lg:text-[1vw] text-[3vw] rounded-[0.25vw] bg-[#1962A1] px-[1vw] py-[0.8vh] text-white">Ajouter une aptitude</button>
        </form>
    </div>

    <button class="triomphe lg:text-[0.8vw] text-[2vw] rounded-[0.25vw] bg-[#DD281F] px-[1vw] py-[0.8vh] text-white">Supprimer la compétence</button>
</div>


</body>

<?php
include resource_path('includes/footer.php');
?>


</html>
