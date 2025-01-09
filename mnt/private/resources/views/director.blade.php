<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel directeur - Journal de Plongée</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>

<body class="flex flex-col items-center triomphe">

    <p class=" triomphe text-[6vw] lg:text-[2vw]">Panel directeur</p>
    <p class="mb-[7vh] triomphe text-[6vw] lg:text-[2vw]">{{$me->UTI_PRENOM}} {{$me->UTI_NOM}}</p>

    <div class=" flex flex-col">
        <div class="flex lg:flex-row flex-col lg:justify-between items-center mb-[1vh]">
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
                    <th class="text-[3vw] lg:text-[1vw] triomphe hidden lg:table-cell">Niveau</th>
                    <th class="text-[3vw] lg:text-[1vw] triomphe  lg:hidden">Nv</th>
                    <th class="text-[3vw] lg:text-[1vw] triomphe hidden lg:table-cell">Date de début</th>
                    <th class="text-[3vw] lg:text-[1vw] triomphe  lg:hidden">Début</th>
                    <th class="text-[3vw] lg:text-[1vw] triomphe hidden lg:table-cell">Responsable</th>
                    <th class="text-[3vw] lg:text-[1vw] triomphe  lg:hidden">Resp</th>
                    <th class="text-[3vw] lg:text-[1vw] triomphe"></th>
                    <th class="text-[3vw] lg:text-[1vw] triomphe"></th>
                    <th class="text-[3vw] lg:text-[1vw] triomphe hidden lg:table-cell">Changer
                        de responsable</th>
                    <th class="text-[2vw] lg:text-[1vw] triomphe lg:hidden">Changer
                        responsable</th>
                    <th class="text-[2vw] lg:text-[1vw] triomphe">Supprimer la formation</th>

                </tr>
            </thead>
            <tbody>
                @foreach($formations as $formation)
                    <tr>
                        <td class="text-[3vw] lg:text-[0.8vw] triomphe">{{ $formation->NIV_ID }}</td>
                        <td class="text-[3vw] lg:text-[0.8vw] triomphe">{{ $formation->FOR_ANNEE }}</td>
                        <td class="text-[3vw] lg:text-[0.8vw] triomphe">{{\App\Models\Uti::find($formation->UTI_ID)->UTI_PRENOM}} {{\App\Models\Uti::find($formation->UTI_ID)->UTI_NOM}}</td>
                        <td class="text-[3vw] lg:text-[0.8vw] triomphe lg:hidden">{{ $formation->responsable->UTI_NOM }}</td>
                        <td>
                            <form action="{{route('directeur.gestion-initiateur')}}" method="post">
                                @csrf
                                <input type="hidden" name="FOR_ID" value="{{ $formation->FOR_ID }}">
                                <button type="submit"
                                    class="triomphe lg:text-[0.8vw] text-[2vw] rounded-[0.25vw] bg-[#1962A1] px-[1vw] py-[0.8vh] text-white hidden lg:table-cell">Liste
                                    des initiateurs</button>
                            </form>
                        </td>
                        <td>
                            <form action="{{route('directeur.gestion-eleve')}}" method="post">
                                @csrf
                                <input type="hidden" name="FOR_ID" value="{{ $formation->FOR_ID }}">
                               <button type="submit"
                                    class="triomphe lg:text-[0.8vw] text-[2vw] rounded-[0.25vw] bg-[#1962A1] px-[1vw] py-[0.8vh] text-white hidden lg:table-cell">Liste
                                    des élèves</button>
                                <button type="submit"
                                        class="triomphe lg:text-[0.8vw] text-[2vw] rounded-[0.25vw] bg-[#1962A1] px-[1vw] py-[0.8vh] text-white  lg:hidden">Élèves</button>
                            </form>
                        </td>

                    <td>
                        <form action="{{route('directeur.gestion-responsable')}}" method="post" >
                            @csrf
                            <input type="hidden" name="formation" value="{{ $formation->FOR_ID }}">
                            <select name="responsable" class="triomphe lg:text-[0.8vw] text-[2vw] rounded-[0.25vw] bg-white lg:px-[1vw] px-[0.5vw] py-[0.8vh] text-black hidden lg:table-cell">
                                @foreach($init as $initiateur)
                                    <option value="{{ $initiateur->UTI_ID }}">{{ $initiateur->UTI_PRENOM }} {{ $initiateur->UTI_NOM }}</option>
                                @endforeach
                            </select>
                            <select name="responsable" class="triomphe lg:text-[0.8vw] text-[2vw] rounded-[0.25vw] bg-white px-[1vw] py-[0.8vh] text-black lg:hidden">
                                @foreach($init as $initiateur)
                                    <option value="{{ $initiateur->UTI_ID }}"> {{ $initiateur->UTI_NOM }}</option>
                                @endforeach
                            </select>
                            <button type="submit"
                                class="triomphe lg:text-[0.8vw] text-[2vw] rounded-[0.25vw] bg-[#1962A1] px-[1vw] py-[0.8vh] text-white">✔</button>
                        </form>
                    </td>
                    <td>
                        @if(\App\Models\Lesson::where('FOR_ID', $formation->FOR_ID)->count() == 0)
                            <form action="{{route('directeur.supprimer-formation')}}" method="post">
                                @csrf
                                <input type="hidden" name="FOR_ID" value="{{ $formation->FOR_ID }}">
                                <button type="submit"
                                    class="triomphe lg:text-[0.8vw] text-[2vw] rounded-[0.25vw] bg-red-600 px-[1vw] py-[0.8vh] text-white"
                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette formation ?')">Supprimer</button>
                            </form>
                        @endif
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
