
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

<body class="flex flex-col items-center triomphe">
<p class=" triomphe text-[6vw] lg:text-[2vw]">Panel élève</p>
<div class="flex">
    <div class="calendar">
        <div class="calendar-header">
            <button id="prevMonth" class="mx-2">&lt;</button>
            <span id="monthYear">October 2025</span>
            <button id="nextMonth" class="mx-2">&gt;</button>
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

<?php
include resource_path('includes/footer.php');
?>
</body>
</html>
