<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification d'un compte - Journal de Plongée</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="./tailwind.config.js"></script>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>

<?php
require_once('../resources/includes/header.php');
?>

<body class="triomphe flex flex-col items-center">
    @if (session('success') || session('failed'))
        <div class="flex flex-row mb-[2vh]">
            <p class=" text-[3vw] lg:text-[1.3vw] mr-[5vw]">{{ session('success') }}
            {{ session('failed') }}</p>
        </div>
    @endif
<p class="  text-[6vw] lg:text-[2vw] mb-[8vh]">Modification d'un compte</p>

<form action="{{ route('edit-profile')}}" method="post" class="mb-[5vh]">
    @csrf
    <div class="flex flex-row mb-[2vh]">
        <label for="UTI_MAIL" class=" text-[3vw] lg:text-[1.3vw] mr-[5vw]">E-Mail</label>
        <input type="email" name="UTI_MAIL" value="{{ $user->UTI_MAIL }}" class="lg:text-[0.8vw] text-[2vw] border-[0.05vw] rounded border-[#C6C6C6] pl-[0.5vw] py-[0.5vh] ml-[0.5vw] min-w-[15vw]" required>
    </div>
    <div class="flex flex-row mb-[2vh]">
        <label for="password1" class=" text-[3vw] lg:text-[1.3vw] mr-[5vw]">Entrer vore nouveau mot de passe</label>
        <input type="password" name="password1"  class="lg:text-[0.8vw] text-[2vw] border-[0.05vw] rounded border-[#C6C6C6] pl-[0.5vw] py-[0.5vh] ml-[0.5vw] min-w-[15vw]" required>
    </div>
    <div class="flex flex-row mb-[2vh]">
        <label for="password2" class=" text-[3vw] lg:text-[1.3vw] mr-[5vw]">Entrer à nouveau votre mot de passe</label>
        <input type="password" name="password2"  class="lg:text-[0.8vw] text-[2vw] border-[0.05vw] rounded border-[#C6C6C6] pl-[0.5vw] py-[0.5vh] ml-[0.5vw] min-w-[15vw]" required>
    </div>
    <input type="hidden" name="UTI_ID" value="{{ $user->UTI_ID }}">
    <div class="flex justify-center">
        <button type="submit" class=" lg:text-[1vw] text-[3vw] rounded-[0.25vw] bg-[#1962A1] px-[1vw] py-[0.8vh] text-white">Modifier</button>
    </div>
</form>

</body>

<?php
require_once('../resources/includes/footer.php');
?>
</html>
