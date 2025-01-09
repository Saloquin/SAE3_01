<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Synthèse des compétences - Journal de Plongée</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="./js/tailwind.config.js"></script>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>

<?php
require_once('../resources/includes/header.php');
?>

<body class="flex flex-col items-center triomphe">
<p class=" triomphe text-[6vw] lg:text-[2vw]">Synthèse des aptitudes et des compétences</p>
<p class="mb-[7vh] triomphe text-[6vw] lg:text-[2vw]">Titouan JEAN</p>

<div class=" flex flex-col justify-between ">

<table class="border-[0.1vw] rounded-[0.5vw] border-[#1962A1] mb-[10vh] border-separate border-spacing-[0.5vw]">
        <thead>
        <tr>
            <th></th>
            <th rowspan="2"></th>

            <?php
                $code = ''; 
                $compIndex = 1;
                foreach ($listCompetence as $comp) {
                    $code .= '<th class="table_header" ';
                    $code .= 'colspan="' . $comp->nb . '">';
                    $code .= 'C'. $compIndex . '</th>';

                    $compIndex++;
                }
                echo $code;
            ?>
        </tr>
        <tr>
                <th></th>
            <?php
                $code = ''; 
                $compIndex = 1;
                foreach ($listCompetence as $comp) {
                    for ($i = 1; $i <= $comp->nb; $i++) {
                        $code .= '<th class="table_header">A'. $compIndex . $i . '</th>';
                    }
                    $compIndex++;
                }
                echo $code;
            ?>
        </tr>
        </thead>
        <tbody>
            
            <!-- cases/lignes ici-->
        </tbody>
    </table>

</div>

<button class="lg:text-[1vw] text-[3vw] rounded-[0.25vw] bg-[#1962A1] px-[1vw] py-[0.8vh] text-white">Gestion des comptes</button>

</body>

<?php
require_once('../resources/includes/footer.php');
?>

</html>
