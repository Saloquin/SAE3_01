
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel élève - Journal de Plongée</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="./js/tailwind.config.js"></script>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{ asset('css/calendar.css') }}">
    <script>
        const tt = 1;
    </script>
</head>
<?php
require_once('../resources/includes/header.php');
?>

<body class="flex flex-col items-center triomphe">
<p class=" triomphe text-[6vw] lg:text-[2vw]">Panel élève</p>
<p class="mb-[7vh] triomphe text-[6vw] lg:text-[2vw]">Titouan JEAN</p>

<div class="flex">
    <div class="calendar">
        <div class="calendar-header">
            <button id="prevMonth">&lt;</button>
            <span id="monthYear">October 2025</span>
            <button id="nextMonth">&gt;</button>
        </div>
        <div class="calendar-body">
            <div class="days-of-week">
                <div>Dim</div>
                <div>Lun</div>
                <div>Mar</div>
                <div>Mer</div>
                <div>Jeu</div>
                <div>Ven</div>
                <div>Sam</div>

            </div>
            <div class="days" id="days"></div>
        </div>
    </div>
    </div>


    <div id="message"></div>
    <script>
        var sessionData = @json($arr);
    </script>
    <script src="{{ asset('js/tt.js') }}"></script>

<button class="lg:text-[1vw] text-[3vw] rounded-[0.25vw] bg-[#1962A1] px-[1vw] py-[0.8vh] text-white">Mes compétences</button>

<?php
require_once('../resources/includes/footer.php');
?>
</body>
</html>
