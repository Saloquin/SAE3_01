<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion du compte - Journal de Plongée</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="./tailwind.config.js"></script>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>

<body class="triomphe flex flex-col items-center">
<p class="  text-[6vw] lg:text-[2vw] mb-[8vh]">Gestion du compte</p>


    <div class="flex flex-row mb-[2vh]">
        <p class=" mr-[5vw]">Licence</p>
        <p class="">{{$user->UTI_LICENCE}}</p>
    </div>
    <div class="flex flex-row mb-[2vh]">
        <p class="mr-[5vw]">Nom</p>
        <p class="">{{$user->UTI_NOM}}</p>
    </div>
    <div class="flex flex-row mb-[2vh]">
        <p class="mr-[5vw]">Prénom</p>
        <p class="">{{$user->UTI_PRENOM}}</p>
    </div>
    <div class="flex flex-row mb-[2vh]">
        <p class="mr-[5vw]">Date de naissance</p>
        <p class="">{{$user->UTI_DATE_NAISS}}</p>
    </div>
    <div class="flex flex-row mb-[2vh]">
        <p class="mr-[5vw]">Certificat médical</p>
        <p class="">{{$user->UTI_DATE_CERTIF}}</p>
    </div>
    <div class="flex flex-row mb-[2vh]">
        <p class="mr-[5vw]">Niveau</p>
        <p class="">{{$user->NIV_ID}}</p>
    </div>
    <div class="flex flex-row mb-[2vh]">
        <p class="mr-[5vw]">Email</p>
        <p class="">{{$user->UTI_MAIL}}</p>
    </div>
    <div class="flex justify-center mt-[3vh]">
        <a href="{{ route('edit-profile') }}" class="lg:text-[1vw] text-[3vw] rounded-[0.25vw] bg-[#1962A1] px-[1vw] py-[0.8vh] text-white">Modifier</a>

    </div>

<form action="{{ route('logout') }}" method="post">
    @csrf
    <button type="submit" class="lg:text-[1vw] text-[3vw] rounded-[0.25vw] bg-[#DD281F] px-[1vw] py-[0.8vh] text-white">Déconnexion</button>
</form>

</body>

<?php
include resource_path('includes/footer.php');
?>

</html>
