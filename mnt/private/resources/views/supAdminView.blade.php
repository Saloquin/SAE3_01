<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel SuperAdmin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="./js/tailwind.config.js"></script>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<?php
require_once('../resources/includes/header.php');
?>

<body class="flex flex-col items-center triomphe">
<p class=" triomphe text-[6vw] lg:text-[2vw]">Panel SuperAdmin</p>


<a href="{{ route('superadmin.addcomp') }}">
    <button>Ajouter une compétence</button>
</a>
<a href="{{ route('superadmin.addapt') }}">
    <button>Ajouter une aptitude</button>
</a>
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<?php
require_once('../resources/includes/footer.php');
?>
</body>
</html>