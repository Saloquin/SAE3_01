<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Journal de Plongée</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="./js/tailwind.config.js"></script>
    <link rel="stylesheet" href="{{URL::to('css/app.css')}}">
</head>
<body class="flex justify-center items-center w-screen h-screen background">

<div class="border-[0.1vw] rounded-[0.5vw] border-[#1962A1] flex flex-col items-center justify-center pt-[8vh]  pb-[3vh] bg-white/50">
    <h1 class="triomphe text-[#223a5d] text-[7vw] mb-[8vh] mx-[7vw] md:text-[3vw] stroke-black">Journal de Plongée</h1>
    <h2 class="triomphe text-[#1962A1] text-[6vw] md:text-[2vw] mb-[5vh] stroke-black connexion-title">Connexion</h2>

    <form class="ml-0 connexion-form" action="login" method="post">
        @csrf
        <div class="mb-[0.8vh] flex-col flex">
            <label for="licence" class="md:text-[1vw] text-[3vw] triomphe connexion-label">Licence</label>
            <input required name="licence" type="text" placeholder="A-00-000000" class="md:text-[0.8vw] text-[2vw] border-[0.05vw] rounded border-[#C6C6C6] pl-[0.5vw] py-[0.5vh] ml-[0.5vw] w-full connexion-input">
        </div>

        <div class="mb-[5vh] flex flex-col">
            <label for="password" class="md:text-[1vw] text-[3vw] triomphe connexion-label">Mot de passe</label>
            <input required name="password" type="password"  class="md:text-[0.8vw] text-[2vw] border-[0.05vw] rounded border-[#C6C6C6] pl-[0.5vw] py-[0.5vh] ml-[0.5vw] min-w-[15vw] connexion-input">
        </div>
        <div class="flex justify-center flex-col">
            <button type="submit" class="md:text-[1vw] text-[3vw] rounded-[0.25vw] bg-[#1962A1] px-[1vw] py-[0.8vh] text-white">Se connecter</button>
        </div>
    </form>

<div class="flex justify-center mt-[2vh]">
    <a href="#" class="md:text-[1vw] text-[3vw] text-[#1962A1] underline" onclick="document.getElementById('emailModal').classList.remove('hidden')">J'ai perdu mon mot de passe</a>
</div>

<div id="emailModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center">
    <div class="bg-white p-6 rounded-lg">
        <h3 class="text-2xl mb-4">Récupération de mot de passe</h3>
        <form action="{{route('mdp-perdu')}}" method="post">
            @csrf
            <label for="email" class="block mb-2">Adresse e-mail</label>
            <input type="email" name="email" id="email" class="border p-2 w-full mb-4" required>
            <div class="flex justify-end">
                <button type="button" class="mr-2 px-4 py-2 bg-gray-300 rounded" onclick="document.getElementById('emailModal').classList.add('hidden')">Annuler</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Envoyer</button>
            </div>
        </form>
    </div>
</div>
</div>
<img class="md:w-[7vw] w-[20vw]  bottom-0 right-0 absolute invert" src="./assets/FFESSM_black_logo.png" alt="Logo blanc FFESSM">
</body>
</html>


