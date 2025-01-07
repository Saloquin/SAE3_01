<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion du compte - Journal de Plongée</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="./tailwind.config.js"></script>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>

<?php
require_once('../resources/includes/header.php');
?>

<body class="triomphe flex flex-col items-center">
<p class="  text-[6vw] lg:text-[2vw] mb-[8vh]">Gestion du compte</p>

<form action="" method="post" class="mb-[3vh]">
    <div class="flex flex-row mb-[2vh]">
        <p class=" text-[3vw] lg:text-[1.3vw] mr-[5vw]">Licence</p>
        <p class=" text-[3vw] lg:text-[1.3vw] ">ABCD</p>
    </div>
    <div class="flex flex-row mb-[2vh]">
        <p class=" text-[3vw] lg:text-[1.3vw] mr-[5vw]">Nom</p>
        <p class=" text-[3vw] lg:text-[1.3vw]">Jean</p>
    </div>
    <div class="flex flex-row mb-[2vh]">
        <p class=" text-[3vw] lg:text-[1.3vw] mr-[5vw]">Prénom</p>
        <p class=" text-[3vw] lg:text-[1.3vw]">Titouan</p>
    </div>
    <div class="flex flex-row mb-[2vh]">
        <label for="mail" class=" text-[3vw] lg:text-[1.3vw] mr-[5vw]">E-Mail</label>
        <input type="text" name="mail" value="titouan@gmail.com" class="lg:text-[0.8vw] text-[2vw] border-[0.05vw] rounded border-[#C6C6C6] pl-[0.5vw] py-[0.5vh] ml-[0.5vw] min-w-[15vw]">
    </div>
    <div class="flex flex-row mb-[5vh]">
        <label for="password" class=" text-[3vw] lg:text-[1.3vw] mr-[5vw]">Mot de passe</label>
        <input type="password" name="password" value="abcd" class="lg:text-[0.8vw] text-[2vw] border-[0.05vw] rounded border-[#C6C6C6] pl-[0.5vw] py-[0.5vh] ml-[0.5vw] min-w-[15vw]">
    </div>

    <div class="flex justify-center">
        <button class=" lg:text-[1vw] text-[3vw] rounded-[0.25vw] bg-[#1962A1] px-[1vw] py-[0.8vh] text-white">Modifier</button>
    </div>
</form>

<button class=" lg:text-[1vw] text-[3vw] rounded-[0.25vw] bg-[#DD281F] px-[1vw] py-[0.8vh] text-white">Déconnexion</button>

</body>

<?php
require_once('../resources/includes/footer.php');
?>

</html>
