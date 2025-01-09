
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

<?php
include resource_path('includes/header.php');
?>

<body class="flex flex-col items-center triomphe">
<p class=" triomphe text-[6vw] lg:text-[2vw] mb-[10vh]">Gestion des élèves</p>

<div class=" flex flex-col justify-between ">
    <div class="flex flex-row justify-between mb-[1vh]">
        <p class="triomphe text-[3vw] lg:text-[1.3vw]">Liste des élèves de la formation de niveau {{ $formation->NIV_ID }}</p>
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
        @foreach($users as $eleve)
            <tr class="">
                <td class="table_cell">{{ $eleve->UTI_LICENCE }}</td>
                <td class="table_cell">{{ $eleve->UTI_NOM }}</td>
                <td class="table_cell">{{ $eleve->UTI_PRENOM }}</td>
                <td class="table_cell">{{ $eleve->UTI_MAIL }}</td>
                <td class="table_cell">{{ $eleve->NIV_ID }}</td>
                <td class="table_cell">{{ $eleve->UTI_DATE_CERTIF }}</td>
                <td class="table_cell">{{ $eleve->UTI_DATE_NAISS }}</td>
                <td>
                    <form action="{{ route('directeur.supprime-eleve-formation') }}" method="post">
                        @csrf
                        <input type="hidden" name="FOR_ID" value="{{ $formation->FOR_ID }}">
                        <input type="hidden" name="UTI_ID" value="{{ $eleve->UTI_ID }}">
                        <button type="submit" class="triomphe lg:text-[0.8vw] text-[2vw] rounded-[0.25vw] bg-[#C80000] px-[1vw] py-[0.8vh] text-white">X</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<div class="flex justify-around">
    <form action="{{ route('directeur.ajoute-eleve-formation') }}" method="post">
    @csrf
        <select class="triomphe lg:text-[1vw] text-[3vw] rounded-[0.25vw] px-[1vw] py-[0.8vh] mr-[5vw]" name="UTI_ID" id="user">
            
            @foreach($usersPossible as $user)
                <option value="{{ $user->UTI_ID }}">{{ $user->UTI_NOM }} {{ $user->UTI_PRENOM }}</option>
            @endforeach
        </select>

        <input type="hidden" name="FOR_ID" value="{{ $formation->FOR_ID }}">
        <button type="submit" class=" triomphe lg:text-[1vw] text-[3vw] rounded-[0.25vw] bg-[#1962A1] px-[1vw] py-[0.8vh] text-white">Ajouter l'élève</button>
    </form>
</div>

</body>

<?php
include resource_path('includes/footer.php');
?>

</html>
