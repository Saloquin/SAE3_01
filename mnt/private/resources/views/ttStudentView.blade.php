<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TT</title>
    <link rel="stylesheet" href="{{ asset('css/calendar.css') }}">
    <script>
        const tt = 1;
    </script>
</head>

<body>
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
</body>

</html>