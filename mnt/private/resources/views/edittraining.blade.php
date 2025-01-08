<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion de formation - Journal de Plongée</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="./tailwind.config.js"></script>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>

<?php
require_once('../resources/includes/header.php');
?>


<body class="triomphe flex flex-col items-center">
<p class="  text-[6vw] lg:text-[2vw] mb-[8vh]">Gestion de la formation N1</p>

<form action="" method="post" class="mb-[5vh]">

    <div class="flex flex-row mb-[2vh]">
        <label for="mail" class=" text-[3vw] lg:text-[1.3vw] mr-[5vw]">Niveau</label>
        <select name="level" value="titouan@gmail.com" class="lg:text-[0.8vw] text-[2vw] border-[0.05vw] rounded border-[#C6C6C6] pl-[0.5vw] py-[0.5vh] ml-[0.5vw] min-w-[15vw] bg-white">
            <option value="N1">N1</option>
            <option value="N2">N2</option>
            <option value="N3">N3</option>
        </select>
    </div>

    <div class="flex flex-row mb-[2vh]">
        <p class=" text-[3vw] lg:text-[1.3vw] mr-[5vw]">Date de départ</p>
        <input value="2024-09-01" type="date" name="start" class="lg:text-[0.8vw] text-[2vw] border-[0.05vw] rounded border-[#C6C6C6] pl-[0.5vw] py-[0.5vh] ml-[0.5vw] min-w-[15vw]">
    </div>

    <div class="flex flex-row mb-[2vh]">
        <label for="mail" class=" text-[3vw] lg:text-[1.3vw] mr-[5vw]">Responsable</label>
        <select name="level" value="titouan@gmail.com" class="lg:text-[0.8vw] text-[2vw] border-[0.05vw] rounded border-[#C6C6C6] pl-[0.5vw] py-[0.5vh] ml-[0.5vw] min-w-[15vw] bg-white">
            <option value="N1">Michel Responsable</option>
            <option value="N2">Pauline Troforte</option>
            <option value="N3">Oscar Leboss</option>
        </select>
    </div>

    <div class="flex justify-center">
        <button type="submit" class=" lg:text-[1vw] text-[3vw] rounded-[0.25vw] bg-[#1962A1] px-[1vw] py-[0.8vh] text-white">Modifier</button>
    </div>
</form>

</body>

<?php
require_once('../resources/includes/footer.php');
?>

</html>
