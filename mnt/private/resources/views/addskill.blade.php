<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création d'une compétence - Journal de Plongée</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="./tailwind.config.js"></script>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body class="triomphe flex flex-col items-center">
<p class="  text-[6vw] lg:text-[2vw] mb-[8vh]">Création d'une compétence</p>

<form action="" method="post" class="mb-[5vh]">

    <div class="flex flex-row mb-[2vh]">
        <p class=" text-[3vw] lg:text-[1.3vw] mr-[5vw]">Nom</p>
        <input type="text" name="name" class="lg:text-[0.8vw] text-[2vw] border-[0.05vw] rounded border-[#C6C6C6] pl-[0.5vw] py-[0.5vh] ml-[0.5vw] min-w-[15vw]">
    </div>

    <div class="flex flex-row mb-[2vh]">
        <label for="mail" class=" text-[3vw] lg:text-[1.3vw] mr-[5vw]">Niveau</label>
        <select  name="level" class="lg:text-[0.8vw] text-[2vw] border-[0.05vw] rounded border-[#C6C6C6] pl-[0.5vw] py-[0.5vh] ml-[0.5vw] min-w-[15vw] bg-white">
            <option value="N1">N1</option>
            <option value="N2">N2</option>
            <option value="N3">N3</option>
        </select>
    </div>

    <div class="flex flex-row mb-[2vh]">
        <label for="mail" class=" text-[3vw] lg:text-[1.3vw] mr-[5vw]">Aptitudes</label>
        <select  multiple name="level" class="lg:text-[0.8vw] text-[2vw] border-[0.05vw] rounded border-[#C6C6C6] pl-[0.5vw] py-[0.5vh] ml-[0.5vw] min-w-[15vw] bg-white">
            <option value="N1">A11</option>
            <option value="N2">A12</option>
            <option value="N3">A13</option>
        </select>
    </div>

    <div class="flex justify-center">
        <button type="submit" class=" lg:text-[1vw] text-[3vw] rounded-[0.25vw] bg-[#1962A1] px-[1vw] py-[0.8vh] text-white">Créer</button>
    </div>
</form>

</body>

<?php
require_once('../resources/includes/footer.php');
?>


</html>
