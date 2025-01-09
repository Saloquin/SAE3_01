
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validation des formations - Journal de Plongée</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>

<body class="flex flex-col items-center triomphe">
<p class=" triomphe text-[6vw] lg:text-[2vw] mb-[10vh]">Validation des formations</p>

<div class=" flex flex-col lg:w-auto w-[90%]">
    <div class="flex lg:flex-row flex-col lg:justify-center items-center mb-[1vh]">
        <p class="triomphe text-[3vw] lg:text-[1.3vw] text-center">Liste des élèves de la formation N1 ayant acquis toutes les compétences</p>
    </div>

    <table class="border-[0.1vw] rounded-[0.5vw] border-[#1962A1] mb-[10vh] border-separate border-spacing-[0.5vw]">
        <thead>
        <tr>
            <th class="table_header">Licence</th>
            <th class="table_header">Nom</th>
            <th class="table_header">Prénom</th>
            <th class="table_header">Mail</th>
            <th class="table_header lg:table-cell hidden">Mail</th>
            <th class="table_header">Niveau en cours</th>
            <th class="table_header">Certif.</th>
            <th class="table_header">Nais.</th>
        </tr>
        </thead>
        @foreach($rq as $row)
            <tbody>
            <tr class="">
            <td class="table_cell">{{$row->uti_licence}}</td>
            <td class="table_cell">{{$row->uti_nom}}</td>
            <td class="table_cell">{{$row->uti_prenom}}</td>
            <td class="table_cell lg:table-cell hidden">{{$row->uti_mail}}</td>
            <td class="table_cell">{{$row->niv_id+1}}</td>
            <td class="table_cell">{{$row->uti_date_certif}}</td>
            <td class="table_cell">{{$row->uti_date_naiss}}</td>
            <td>
                <form action="{{route('acceptStudent')}}" method="POST">
                    @csrf
                    @method('POST')
                    <input type='hidden' name="id" value= "{{$row->uti_id}}">
                    <button class="triomphe lg:text-[0.8vw] text-[2vw] rounded-[0.25vw] bg-[#223A5D] px-[1vw] py-[0.8vh] text-white">✔</button>
                </form>
            </td>
        </tr>
            @endforeach
    </table>
</div>

</body>

<?php
include resource_path('includes/footer.php');
?>

</html>
