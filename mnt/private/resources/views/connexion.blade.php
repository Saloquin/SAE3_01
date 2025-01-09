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
    <h2 class="triomphe text-[#1962A1] text-[6vw] md:text-[2vw] mb-[5vh] stroke-black">Connexion</h2>

    <form class="ml-0" action="login" method="post">
        @csrf
        <div class="mb-[0.8vh] flex flex-row ">
            <label for="licence" class="md:text-[1vw] text-[3vw]">Licence</label>
            <input name="licence" type="text" value="ABCDE" class="md:text-[0.8vw] text-[2vw] border-[0.05vw] rounded border-[#C6C6C6] pl-[0.5vw] py-[0.5vh] ml-[0.5vw] w-full">
        </div>

        <div class="mb-[5vh] flex flex-row ">
            <label for="password" class="md:text-[1vw] text-[3vw]">Mot de passe</label>
            <input name="password" type="password" value="test" class="md:text-[0.8vw] text-[2vw] border-[0.05vw] rounded border-[#C6C6C6] pl-[0.5vw] py-[0.5vh] ml-[0.5vw] min-w-[15vw]">
        </div>
        <div class="flex justify-center">
            <button type="submit" class="md:text-[1vw] text-[3vw] rounded-[0.25vw] bg-[#1962A1] px-[1vw] py-[0.8vh] text-white">Se connecter</button>
        </div>
    </form>
</div>
<img class="md:w-[7vw] w-[20vw]  bottom-0 right-0 absolute invert" src="./assets/FFESSM_black_logo.png" alt="Logo blanc FFESSM">
</body>
</html>


