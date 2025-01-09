<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création d'une formation - Journal de Plongée</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="./tailwind.config.js"></script>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>


<body class="triomphe flex flex-col items-center">
    <p class="  text-[6vw] lg:text-[2vw] mb-[8vh]">Création d'une formation</p>

    <form action="{{route('directeur.ajoute-formation')}}" method="post" class="mb-[5vh]">
        @csrf
        <div class="flex flex-col mb-[2vh addtraining-container">
            <label for="level" class=" text-[3vw] lg:text-[1.3vw] mr-[5vw] addtraining-label">Niveau</label>
            <select name="level" value=""
                class="lg:text-[0.8vw] text-[2vw] border-[0.05vw] rounded border-[#C6C6C6] pl-[0.5vw] py-[0.5vh] ml-[0.5vw] min-w-[15vw] bg-white"
                required>
                @foreach ($levels as $level)
                    <option value="{{ $level->NIV_ID }}">{{ $level->NIV_ID }} - {{ $level->NIV_DESCRIPTION }}</option>
                @endforeach
            </select>
        </div>

        <div class="flex flex-col mb-[2vh] addtraining-container">
            <p class=" text-[3vw] lg:text-[1.3vw] mr-[5vw] addtraining-label">Date de départ</p>
            <input type="date" name="start"
                class="lg:text-[0.8vw] text-[2vw] border-[0.05vw] rounded border-[#C6C6C6] pl-[0.5vw] py-[0.5vh] ml-[0.5vw] min-w-[15vw]"
                min="{{  now() }}" required>
        </div>

        <div class="flex flex-col mb-[2vh] addtraining-container">
            <label for="init" class=" text-[3vw] lg:text-[1.3vw] mr-[5vw] addtraining-label">Responsable</label>
            <select name="init" value=""
                class="lg:text-[0.8vw] text-[2vw] border-[0.05vw] rounded border-[#C6C6C6] pl-[0.5vw] py-[0.5vh] ml-[0.5vw] min-w-[15vw] bg-white"
                required>
                @foreach ($init as $resp)
                    <option value="{{ $resp->UTI_ID }}">{{ $resp->UTI_PRENOM }} {{ $resp->UTI_NOM }}</option>
                @endforeach
            </select>
        </div>

        <div class="flex flex-row mb-[2vh] items-center"></div>
        <input type="checkbox" id="recurrent" name="recurrent"
            class="lg:text-[0.8vw] text-[2vw] border-[0.05vw] rounded border-[#C6C6C6] mr-[1vw] addtraining-checkbox">
        <label for="recurrent" class="text-[3vw] lg:text-[1.3vw]">Définir un horaire récurrent pour les séances</label>
        </div>

        <div id="recurrent-schedule" class="flex flex-row mb-[2vh] items-center hidden addtraining-container">
            <label for="day" class="text-[3vw] lg:text-[1.3vw] mr-[5vw]">Jour</label>
            <select name="day" id="day"
                class="lg:text-[0.8vw] text-[2vw] border-[0.05vw] rounded border-[#C6C6C6] pl-[0.5vw] py-[0.5vh] ml-[0.5vw] min-w-[15vw] bg-white">
                <option value="0">Choississez un jour</option>
                <option value="1">Lundi</option>
                <option value="2">Mardi</option>
                <option value="3">Mercredi</option>
                <option value="4">Jeudi</option>
                <option value="5">Vendredi</option>
                <option value="6">Samedi</option>
                <option value="7">Dimanche</option>
            </select>
        </div>

        <script>
            document.getElementById('recurrent').addEventListener('change', function () {
                var scheduleDiv = document.getElementById('recurrent-schedule');
                if (this.checked) {
                    scheduleDiv.classList.remove('hidden');
                } else {
                    scheduleDiv.classList.add('hidden');
                }
            });
        </script>

        <div class="flex justify-center">
            <button type="submit"
                class=" lg:text-[1vw] text-[3vw] rounded-[0.25vw] bg-[#1962A1] px-[1vw] py-[0.8vh] text-white addtraining-button">Créer</button>
        </div>
    </form>

</body>

<?php
require_once('../resources/includes/footer.php');
?>

</html>