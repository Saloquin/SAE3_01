<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création d'un compte - Journal de Plongée</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="./tailwind.config.js"></script>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>

<body class="triomphe flex flex-col items-center">
    @if (session('success') || session('failed'))
        <div class="flex flex-row mb-[2vh]">
            <p class=" text-[3vw] lg:text-[1.3vw] mr-[5vw]">{{ session('success') }}
            {{ session('failed') }}</p>
        </div>
    @endif
<p class="  text-[6vw] lg:text-[2vw] mb-[8vh]">Création d'un compte</p>

<form action="{{ route('addStudent') }}" method="post" class="mb-[5vh]">
    @csrf
    
    <div class="flex flex-row mb-[2vh]">
        <p class=" text-[3vw] lg:text-[1.3vw] mr-[5vw]">Nom</p>
        <input type="text" name="UTI_NOM"  class="lg:text-[0.8vw] text-[2vw] border-[0.05vw] rounded border-[#C6C6C6] pl-[0.5vw] py-[0.5vh] ml-[0.5vw] min-w-[15vw]" required>
    </div>
    <div class="flex flex-row mb-[2vh]">
        <p class=" text-[3vw] lg:text-[1.3vw] mr-[5vw]">Prénom</p>
        <input type="text" name="UTI_PRENOM"  class="lg:text-[0.8vw] text-[2vw] border-[0.05vw] rounded border-[#C6C6C6] pl-[0.5vw] py-[0.5vh] ml-[0.5vw] min-w-[15vw]" required>
    </div>

    <div class="flex flex-row mb-[2vh]">
        <p class=" text-[3vw] lg:text-[1.3vw] mr-[5vw]">Ville</p>
        <input type="text" name="UTI_VILLE"  class="lg:text-[0.8vw] text-[2vw] border-[0.05vw] rounded border-[#C6C6C6] pl-[0.5vw] py-[0.5vh] ml-[0.5vw] min-w-[15vw]" required>
    </div>

    <div class="flex flex-row mb-[2vh]">
        <p class=" text-[3vw] lg:text-[1.3vw] mr-[5vw]">Code Postal</p>
        <input type="text" name="UTI_CODE_POSTAL"  class="lg:text-[0.8vw] text-[2vw] border-[0.05vw] rounded border-[#C6C6C6] pl-[0.5vw] py-[0.5vh] ml-[0.5vw] min-w-[15vw]" required>
    </div>

    <div class="flex flex-row mb-[2vh]">
        <p class=" text-[3vw] lg:text-[1.3vw] mr-[5vw]">Rue</p>
        <input type="text" name="UTI_RUE"  class="lg:text-[0.8vw] text-[2vw] border-[0.05vw] rounded border-[#C6C6C6] pl-[0.5vw] py-[0.5vh] ml-[0.5vw] min-w-[15vw]" required>
    </div>

    <div class="flex flex-row mb-[2vh]">
        <p class=" text-[3vw] lg:text-[1.3vw] mr-[5vw]">Date de naissance</p>
        <input type="date" name="UTI_DATE_NAISSANCE" min="{{now()->subyear(120)->format('Y-m-d') }}" max="{{ now()->subyear(16)->format('Y-m-d') }}" class="lg:text-[0.8vw] text-[2vw] border-[0.05vw] rounded border-[#C6C6C6] pl-[0.5vw] py-[0.5vh] ml-[0.5vw] min-w-[15vw]" required>
    </div>
    <div class="flex flex-row mb-[2vh]">
        <p class=" text-[3vw] lg:text-[1.3vw] mr-[5vw]">Certificat médical</p>
        <input type="date" name="UTI_DATE_CERTIFICAT" min="{{ now()->subYear()->format('Y-m-d') }}" max="{{ now()->format('Y-m-d') }}" class="lg:text-[0.8vw] text-[2vw] border-[0.05vw] rounded border-[#C6C6C6] pl-[0.5vw] py-[0.5vh] ml-[0.5vw] min-w-[15vw]" required>
    </div>
    <div class="flex flex-row mb-[2vh]">
        <label for="UTI_MAIL" class=" text-[3vw] lg:text-[1.3vw] mr-[5vw]">E-Mail</label>
        <input type="email" name="UTI_MAIL" value="" class="lg:text-[0.8vw] text-[2vw] border-[0.05vw] rounded border-[#C6C6C6] pl-[0.5vw] py-[0.5vh] ml-[0.5vw] min-w-[15vw]" required>
    </div>
    <div class="flex flex-row mb-[2vh]">
        <label for="lvl" class=" text-[3vw] lg:text-[1.3vw] mr-[5vw]">Niveau</label>
        <select name="lvl" value="" class="lg:text-[0.8vw] text-[2vw] border-[0.05vw] rounded border-[#C6C6C6] pl-[0.5vw] py-[0.5vh] ml-[0.5vw] min-w-[15vw] bg-white" required>
            <option value="0">0 - Pas de niveau</option>
            @foreach ($levels as $level)
            <option value="{{ $level->NIV_ID }}">{{ $level->NIV_ID }} - {{ $level->NIV_DESCRIPTION }}</option>
            @endforeach
        </select>
    </div>
    <div class="flex flex-row mb-[5vh] items-center">
        <label for="init" class="text-[3vw] lg:text-[1.3vw] mr-[5vw]">Initiateur</label>
        <div class="flex items-center">
            <input type="radio" id="oui" name="init" value="1" class="mr-[1vw]" required>
            <label for="oui" class="mr-[2vw] lg:text-[1vw] text-[2.5vw]">Oui</label>
            <input type="radio" id="non" name="init" value="0" class="mr-[1vw]" required>
            <label for="non" class="lg:text-[1vw] text-[2.5vw]">Non</label>
        </div>
    </div>
    <input type="hidden" name="UTI_ID" value="{{ $user->UTI_ID }}">
    <div class="flex justify-center">
        <button type="submit" class=" lg:text-[1vw] text-[3vw] rounded-[0.25vw] bg-[#1962A1] px-[1vw] py-[0.8vh] text-white">Créer</button>
    </div>

</form>

</body>

<?php
require_once('../resources/includes/footer.php');
?>
</html>
