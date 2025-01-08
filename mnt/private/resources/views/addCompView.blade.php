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

<form action="{{ route('superadmin.addcompform') }}" method="POST">
            @csrf 
            
            <!-- Liste déroulante générée dynamiquement -->
            <div class="mb-4">
                <label for="selection" class="block text-sm font-medium text-gray-700">Choisissez le niveau sur lequel ajouter une compétence</label>
                <select id="selection" name="selection" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md">
                    <option value="">Sélectionnez une option...</option>
                    @foreach($lvls as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Champ de texte -->
            <div class="mb-4">
                <label for="texte" class="block text-sm font-medium text-gray-700">Entrez une description de la compétence</label>
                <input type="text" id="texte" name="texte" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md" placeholder="Entrez votre texte ici" />
            </div>

            <!-- Bouton de soumission -->
            <button type="submit" class="w-full py-2 px-4 bg-blue-500 text-white font-semibold rounded-md hover:bg-blue-600">
                Soumettre
            </button>
        </form>

<?php
require_once('../resources/includes/footer.php');
?>
</body>
</html>