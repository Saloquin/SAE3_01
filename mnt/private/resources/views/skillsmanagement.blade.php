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
<p class="mb-[7vh] triomphe text-[6vw] lg:text-[2vw]">Groupe Formation N1</p>

<div class=" flex flex-col justify-between ">

    <table class="border-[0.1vw] rounded-[0.5vw] border-[#1962A1] mb-[10vh] border-separate border-spacing-[0.5vw]">
        <thead>
        <tr>
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
            <?php

            $code = "";
            $j = 0;
            foreach ($listTrainee as $trainee) {
                $code .= '<tr class=""> <th class="table_cell">';
                $code .= $trainee->nom;
                $code .= '</th>';

                for ($i = 0; $i < count($listSkills); $i++) {
                    $skill = $tab[$i][$j];
                    $code .= '<td class="table_cell ';
                    if ($skill->val_statut == 'Acquise') {
                        $code .= 'bg-green-400">';
                    } else {
                        $code .= 'bg-orange-300">';
                    }
                    $code .= $skill->val_statut;
                    $code .= '</td>';
                }

                $code .= '</tr>';
                $j++;
            }
            echo $code;
            ?>
        </tbody>
    </table>
</div>

</body>

<?php
require_once('../resources/includes/footer.php');
?>

</html>
