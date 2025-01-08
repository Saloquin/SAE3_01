<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création d'un cours de plongée</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center flex-col bg-blue-50 p-6">
    <h1 class="mb-10 text-4xl font-bold text-blue-700">Création d'une séance de plongée</h1>

    @if(session('error'))
        <div class="bg-red-500 text-white px-4 py-3 mb-6 rounded">
            {{ session('error') }}
        </div>
    @endif

    @if(session('success'))
        <div class="bg-green-500 text-white px-4 py-3 mb-6 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ url('responsable-formation/TraitementCreationSession') }}" method="post" class="bg-white shadow-xl rounded-lg px-8 pt-6 pb-8 w-full max-w-4xl">
        @csrf
        <div class="mb-6">
            <label for="date" class="block text-gray-800 font-semibold mb-2">Date de la session</label>
            <input type="date" id="date" name="date" value="{{ old('date') }}" class="shadow border rounded w-full py-2 px-3 text-gray-800" required>
        </div>

        <div class="mb-6">
            <h2 class="text-blue-700 font-semibold mb-4">Élèves et leurs aptitudes</h2>
            <div class="overflow-x-auto bg-blue-50 rounded-lg shadow-lg">
                <table class="table-auto w-full text-sm text-left text-gray-700">
                    <thead class="text-xs text-white uppercase bg-blue-600">
                        <tr>
                            <th class="px-6 py-3">Élève</th>
                            <th class="px-6 py-3">Aptitudes</th>
                            <th class="px-6 py-3">Initiateur</th>
                            <th class="px-6 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="students-table-body">
                    </tbody>
                </table>
            </div>
            <button type="button" class="mt-4 bg-blue-600 text-white px-4 py-2 rounded-lg shadow-lg hover:bg-blue-700" id="addStudentButton">Ajouter un élève</button>
        </div>

        <div class="flex justify-center mt-6">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg shadow-lg transition duration-300">Créer</button>
        </div>
    </form>

    <script id="studentsData" type="application/json">@json($student)</script>
    <script id="skillsData" type="application/json">@json($skills)</script>
    <script id="initiatorsData" type="application/json">@json($initiator)</script>
    <script id="oldStudents" type="application/json">@json(old('student', []))</script>
    <script id="oldCompetences" type="application/json">@json(old('competences', []))</script>
    <script id="oldInitiators" type="application/json">@json(old('initiator', []))</script>
    <script src="{{ asset('js/CreateSession.js') }}"></script>

</body>
</html>
