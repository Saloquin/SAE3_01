<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des utilisateurs - Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>



<body class="flex flex-col items-center triomphe">


    <p class=" triomphe text-[6vw] lg:text-[2vw] mb-[10vh]">Gestion des utilisateurs</p>

    <div class=" flex flex-col lg:w-auto w-[90%]">
        <div class="flex lg:flex-row flex-col lg:justify-between items-center mb-[1vh]">
            <p class="triomphe text-[3vw] lg:text-[1.3vw] user-title">Liste des utilisateurs</p>
            <form method="GET" action="{{ route('directeur.ajouter-utilisateur') }}">
                <button
                    class=" triomphe lg:text-[1vw] text-[3vw] rounded-[0.25vw] bg-[#1962A1] px-[1vw] py-[0.8vh] text-white">Créer
                    un utilisateur</button>
            </form>
        </div>

        <table class="border-[0.1vw] rounded-[0.5vw] border-[#1962A1] mb-[10vh] border-separate border-spacing-[0.5vw]">
            <thead>
                <tr>
                    <th class="table_header">Licence</th>
                    <th class="table_header">Nom</th>
                    <th class="table_header">Prénom</th>
                    <th class="table_header text-[3vw] lg:text-[1vw] lg:table-cell hidden triomphe">Mail</th>
                    <th class="table_header">Niveau</th>
                    <th class="table_header text-[3vw] lg:text-[1vw] lg:table-cell hidden triomphe">Certif.</th>
                    <th class="table_header text-[3vw] lg:text-[1vw] lg:table-cell hidden triomphe">Nais.</th>
                    <th class="table_header">Ville</th>
                    <th class="table_header">CP</th>
                    <th class="table_header">Adresse</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr class="">
                        <td class="table_cell">{{ $user->UTI_LICENCE }}</td>
                        <td class="table_cell">{{ $user->UTI_NOM }}</td>
                        <td class="table_cell">{{ $user->UTI_PRENOM }}</td>
                        <td class="table_cell">{{ $user->UTI_MAIL }}</td>
                        <td class="table_cell">{{ $user->NIV_ID }}</td>
                        <td class="table_cell">{{ $user->UTI_DATE_CERTIF }}</td>
                        <td class="table_cell">{{ $user->UTI_DATE_NAISS }}</td>
                        <td class="table_cell">{{ $user->UTI_VILLE }}</td>
                        <td class="table_cell">{{ $user->UTI_CP }}</td>
                        <td class="table_cell">{{ $user->UTI_RUE }}</td>
                        <td>
                            <form action="{{ route('directeur.modifier-utilisateur') }}" method="post">
                                @csrf
                                <input type="hidden" name="UTI_ID" value="{{ $user->UTI_ID }}">
                                <button type="submit" class="lg:table-cell hidden triomphe lg:text-[0.8vw] text-[2vw] rounded-[0.25vw] bg-[#1962A1] px-[1vw] py-[0.8vh] text-white">Gérer
                                    l'utilisateur
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>

<?php
include resource_path('includes/footer.php');
?>

</html>
