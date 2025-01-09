
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des élèves - Journal de Plongée</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="./js/tailwind.config.js"></script>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>

<body class="flex flex-col items-center triomphe">
<p class=" triomphe text-[6vw] lg:text-[2vw] mb-[10vh]">Gestion des élèves</p>

<div class=" flex flex-col justify-between ">
    <div class="flex flex-row justify-between mb-[1vh]">
        <p class="triomphe text-[3vw] lg:text-[1.3vw]">Liste des élèves de la formation N1</p>
    </div>

    <table class="border-[0.1vw] rounded-[0.5vw] border-[#1962A1] mb-[10vh] border-separate border-spacing-[0.5vw]">
        <thead>
        <tr>
            <th class="table_header">Licence</th>
            <th class="table_header">Nom</th>
            <th class="table_header">Prénom</th>
            <th class="table_header">Mail</th>
            <th class="table_header">Niveau</th>
            <th class="table_header">Certif.</th>
            <th class="table_header">Nais.</th>
        </tr>
        </thead>
        <tbody>
        <tr class="">
            <td class="table_cell">A-00-000000</td>
            <td class="table_cell">MARTIN</td>
            <td class="table_cell">Frank</td>
            <td class="table_cell">franklefou@gmail.com</td>
            <td class="table_cell">N1</td>
            <td class="table_cell">17/08/2024</td>
            <td class="table_cell">12/03/2006</td>
            <td><button class="triomphe lg:text-[0.8vw] text-[2vw] rounded-[0.25vw] bg-[#C80000] px-[1vw] py-[0.8vh] text-white">X</button></td>
        </tr>

        <tr class="">
            <td class="table_cell">A-00-000000</td>
            <td class="table_cell">MARTIN</td>
            <td class="table_cell">Frank</td>
            <td class="table_cell">franklefou@gmail.com</td>
            <td class="table_cell">N1</td>
            <td class="table_cell">17/08/2024</td>
            <td class="table_cell">12/03/2006</td>
            <td><button class="triomphe lg:text-[0.8vw] text-[2vw] rounded-[0.25vw] bg-[#C80000] px-[1vw] py-[0.8vh] text-white">X</button></td>
        </tr>


        <tr class="">
            <td class="table_cell">A-00-000000</td>
            <td class="table_cell">MARTIN</td>
            <td class="table_cell">Frank</td>
            <td class="table_cell">franklefou@gmail.com</td>
            <td class="table_cell">N1</td>
            <td class="table_cell">17/08/2024</td>
            <td class="table_cell">12/03/2006</td>
            <td><button class="triomphe lg:text-[0.8vw] text-[2vw] rounded-[0.25vw] bg-[#C80000] px-[1vw] py-[0.8vh] text-white">X</button></td>
        </tr>
        </tbody>
    </table>
</div>

<div class="flex justify-around">
    <form action="" method="post">
        <select class="triomphe lg:text-[1vw] text-[3vw] rounded-[0.25vw] px-[1vw] py-[0.8vh] mr-[5vw]" name="trainee" id="trainee">
            <option value="1">Jean Apprend</option>
            <option value="2">Michel Eleve</option>
            <option value="3">Titouan Travaille</option>
        </select>
        <button type="submit" class=" triomphe lg:text-[1vw] text-[3vw] rounded-[0.25vw] bg-[#1962A1] px-[1vw] py-[0.8vh] text-white">Ajouter l'élève</button>
    </form>
</div>

</body>

<?php
require_once('../resources/includes/footer.php');
?>

</html>
