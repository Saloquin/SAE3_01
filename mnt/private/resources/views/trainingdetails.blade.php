
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de la formation - Journal de Plongée</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="./js/tailwind.config.js"></script>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>

<body class="flex flex-col items-center triomphe">
<p class=" triomphe text-[6vw] lg:text-[2vw] mb-[10vh]">Détails de la formation</p>

<div class=" flex flex-col justify-between ">
    <div class="flex flex-row justify-between mb-[1vh]">
        <p class="triomphe text-[3vw] lg:text-[1.3vw]">Liste des élèves</p>
    </div>

    <table class="border-[0.1vw] rounded-[0.5vw] border-[#1962A1] mb-[5vh] border-separate border-spacing-[0.5vw]">
        <thead>
        <tr>
            <th class="table_header">Licence</th>
            <th class="table_header">Nom</th>
            <th class="table_header lg:table-cell hidden">Prénom</th>
            <th class="table_header lg:table-cell hidden">Mail</th>
            <th class="table_header">Niveau</th>
            <th class="table_header">Certif.</th>
            <th class="table_header">Nais.</th>
        </tr>
        </thead>
        <tbody>
        @foreach($students as $user)
        <tr class="">
            <td class="table_cell">{{ $user->uti_licence }}</td>
            <td class="table_cell lg:table-cell hidden">{{ $user->uti_nom }}</td>
            <td class="table_cell lg:table-cell hidden">{{ $user->uti_prenom }}</td>
            <td class="table_header lg:hidden">{{$user->uti_nom }} {{ $user->uti_prenom }}</td>
            <td class="table_cell lg:table-cell hidden">{{ $user->uti_mail }}</td>
            <td class="table_cell">{{ $user->niv_id }}</td>
            <td class="table_cell">{{ $user->uti_date_certif }}</td>
            <td class="table_cell">{{ $user->uti_date_naiss }}</td>
            <td><button class="triomphe lg:text-[0.8vw] text-[2vw] rounded-[0.25vw] bg-[#C80000] px-[1vw] py-[0.8vh] text-white">X</button></td>
        </tr>
        @endforeach
        </tbody>
    </table>


</div>

<div class=" flex flex-col justify-between mt-[5vh]">
    <div class="flex flex-row justify-between mb-[1vh]">
        <p class="triomphe text-[3vw] lg:text-[1.3vw]">Liste des initiateurs</p>
    </div>

    <table class="border-[0.1vw] rounded-[0.5vw] border-[#1962A1] mb-[5vh]  border-separate border-spacing-[0.5vw]">
        <thead>
        <tr>
            <th class="table_header">Licence</th>
            <th class="table_header">Nom</th>
            <th class="table_header lg:table-cell hidden">Prénom</th>
            <th class="table_header lg:table-cell hidden">Mail</th>
            <th class="table_header">Niveau</th>
            <th class="table_header">Certif.</th>
            <th class="table_header">Nais.</th>
        </tr>
        </thead>
        <tbody>
                @foreach($initiators as $user)
                    <tr class="">
                        <td class="table_cell">{{ $user->uti_licence }}</td>
                        <td class="table_cell lg:table-cell hidden">{{ $user->uti_nom }}</td>
                        <td class="table_cell lg:table-cell hidden">{{ $user->uti_prenom }}</td>
                        <td class="table_header lg:hidden">{{$user->uti_nom }} {{ $user->uti_prenom }}</td>
                        <td class="table_cell lg:table-cell hidden">{{ $user->uti_mail }}</td>
                        <td class="table_cell">{{ $user->niv_id }}</td>
                        <td class="table_cell">{{ $user->uti_date_certif }}</td>
                        <td class="table_cell">{{ $user->uti_date_naiss }}</td>
                        <td><button class="triomphe lg:text-[0.8vw] text-[2vw] rounded-[0.25vw] bg-[#C80000] px-[1vw] py-[0.8vh] text-white">X</button></td>
                    </tr>
                @endforeach
            </tbody>
    </table>
</div>

</body>

<?php
require_once('../resources/includes/footer.php');
?>

</html>
