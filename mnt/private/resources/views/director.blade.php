<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel directeur - Journal de Plongée</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="./js/tailwind.config.js"></script>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>

<?php
require_once('../resources/includes/header.php');
?>

<body class="flex flex-col items-center triomphe">

    <form action="{{route('directeur.gestion-utilisateur')}}" method="get">
        <button type="submit"
            class="lg:text-[1vw] text-[3vw] rounded-[0.25vw] bg-[#1962A1] px-[1vw] py-[0.8vh] text-white">Gestion des
            comptes</button>
    </form>
    <form action="{{route('directeur.gestion-formation')}}" method="get">
        <button type="submit"
            class="lg:text-[1vw] text-[3vw] rounded-[0.25vw] bg-[#1962A1] px-[1vw] py-[0.8vh] text-white">Gestion des
            formations</button>
    </form>


    <p class=" triomphe text-[6vw] lg:text-[2vw]">Panel directeur</p>
    <p class="mb-[7vh] triomphe text-[6vw] lg:text-[2vw]">{{$me->UTI_PRENOM}} {{$me->UTI_NOM}}</p>

    <div class=" flex flex-col justify-between ">
        <div class="flex flex-row justify-between mb-[1vh]">
            <p class="triomphe text-[3vw] lg:text-[1.3vw]">Liste des formations</p>
            <form action="{{route('directeur.ajouter-formation')}}" method="get">
                @csrf
                <button type="submit"
                    class="triomphe lg:text-[1vw] text-[3vw] rounded-[0.25vw] bg-[#1962A1] px-[1vw] py-[0.8vh] text-white">Ajouter
                    une formation</button>
            </form>
        </div>

        <table class="border-[0.1vw] rounded-[0.5vw] border-[#1962A1] mb-[10vh] border-separate border-spacing-[0.5vw]">
            <thead>
                <tr>
                    <th class="text-[2vw] lg:text-[1vw] triomphe">Niveau</th>
                    <th class="text-[2vw] lg:text-[1vw] triomphe">Date de début</th>
                    <th class="text-[2vw] lg:text-[1vw] triomphe">Responsable</th>
                    <th class="text-[2vw] lg:text-[1vw] triomphe"></th>
                    <th class="text-[2vw] lg:text-[1vw] triomphe"></th>
                    <th class="text-[2vw] lg:text-[1vw] triomphe">Changer
                        de responsable</th>
                </tr>
            </thead>
            <tbody>
                @foreach($formations as $formation)
                    <tr>
                        <td class="text-[0.8vw] triomphe">{{ $formation->NIV_ID }}</td>
                        <td class="text-[0.8vw] triomphe">{{ $formation->FOR_ANNEE }}</td>
                        <td class="text-[0.8vw] triomphe">{{$formation->responsable->UTI_PRENOM}}
                            {{ $formation->responsable->UTI_NOM }}</td>
                        <td>
                            <form action="{{route('directeur.gestion-initiateur')}}" method="post">
                                @csrf
                                <input type="hidden" name="FOR_ID" value="{{ $formation->FOR_ID }}">
                                <button type="submit"
                                    class="triomphe lg:text-[0.8vw] text-[2vw] rounded-[0.25vw] bg-[#1962A1] px-[1vw] py-[0.8vh] text-white">Liste
                                    des initiateurs</button>
                            </form>
                        </td>
                        <td>
                            <form action="{{route('directeur.gestion-eleve')}}" method="post">
                                @csrf
                                <input type="hidden" name="FOR_ID" value="{{ $formation->FOR_ID }}">
                                <button type="submit"
                                    class="triomphe lg:text-[0.8vw] text-[2vw] rounded-[0.25vw] bg-[#1962A1] px-[1vw] py-[0.8vh] text-white">Liste
                                    des élèves</button>
                            </form>
                        </td>
                        
                    <td>
                        <form action="{{route('directeur.gestion-responsable')}}" method="post" >
                            @csrf
                            <input type="hidden" name="formation" value="{{ $formation->FOR_ID }}">
                            <select name="responsable" class="triomphe lg:text-[0.8vw] text-[2vw] rounded-[0.25vw] bg-white px-[1vw] py-[0.8vh] text-black">
                                @foreach($init as $initiateur)
                                    <option value="{{ $initiateur->UTI_ID }}">{{ $initiateur->UTI_PRENOM }} {{ $initiateur->UTI_NOM }}</option>
                                @endforeach
                            </select>
                            <button type="submit"
                                class="triomphe lg:text-[0.8vw] text-[2vw] rounded-[0.25vw] bg-[#1962A1] px-[1vw] py-[0.8vh] text-white">Confirmer</button>
                        </form>
                    </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <?php
require_once('../resources/includes/footer.php');
?>
</body>

</html>