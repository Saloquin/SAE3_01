
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pas de formation - Journal de Plongée</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="./js/tailwind.config.js"></script>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>

<body class="flex flex-col triomphe h-screen">
    <div class="flex flex-col items-center triomphe justify-center h-[90%]" >
        <p class="triomphe text-[3vw] lg:text-[1.3vw]">Vous n'êtes inscrit dans aucune formation cette année.
        <p class="triomphe text-[2vw] lg:text-[1vw]">Si ce n'est pas normal, veuillez contacter l'administrateur de l'application.</p>
    </div>
</body>

<?php
require_once('../resources/includes/footer.php');
?>

</html>
