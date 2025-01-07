<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
</head>
<body>
    <h1>Profil</h1>
    <!-- DT -->
    <h2>Ajouter dans une formation</h2>
    @if (session('success') || session('failed'))
        <div>
            {{ session('success') }}
            {{ session('failed') }}
        </div>
    @endif
     <h3>Students</h3>   
     <form action="{{ route('addStudent') }}" method="POST">
        @csrf
        @foreach ($students as $student)
            <div>
                <input type="checkbox" id="student_{{ $student->UTI_ID }}" name="students[]" value="{{ $student->UTI_ID }}">
                <label for="student_{{ $student->UTI_ID }}">{{ $student->UTI_PRENOM }} {{ $student->UTI_NOM ?? 'Nom non disponible' }}</label>
            </div>
        @endforeach
        <label for="formation_student">Sélectionner une formation :</label>
        <select name="formation" id="formation_student">
            @foreach ($formations as $formation)
                <option value="{{ $formation->FOR_ID }}">{{ $formation->FOR_ANNEE }} - {{ $formation->level->NIV_DESCRIPTION }}</option>
            @endforeach
        </select>
        <button type="submit">Submit</button>
    </form>
    
    <h3>Teachers</h3>
    <form action="{{ route('addTeacher') }}" method="POST">
        @csrf
        @foreach ($teachers as $teacher)
            <div>
                <input type="checkbox" id="teacher_{{ $teacher->UTI_ID }}" name="teachers[]" value="{{ $teacher->UTI_ID }}">
                <label for="teacher_{{ $teacher->UTI_ID }}">{{ $teacher->UTI_PRENOM }} {{ $teacher->UTI_NOM ?? 'Nom non disponible' }}</label>
            </div>
        @endforeach
        <label for="formation_teacher">Sélectionner une formation :</label>
        <select name="formation" id="formation_teacher">
            @foreach ($formations as $formation)
                <option value="{{ $formation->FOR_ID }}">{{ $formation->FOR_ANNEE }} - {{ $formation->level->NIV_DESCRIPTION }}</option>
            @endforeach
        </select>
        <button type="submit">Submit</button>
    </form>

    <h2>Definir un chef de formation</h2>
    
    <form action="{{ route('addRespForm') }}" method="POST">
        @csrf
        
        <label for="responsable">Sélectionner un Initiateur :</label>
        <select name="responsable" id="responsable">
            @foreach ($teachers as $teacher)
                <option value="{{ $teacher->UTI_ID }}">{{ $teacher->UTI_PRENOM }}-{{ $teacher->UTI_NOM }} - {{ $teacher->level->NIV_DESCRIPTION }}</option>
            @endforeach
        </select>

        <label for="formation_teacher">Sélectionner une formation :</label>
        <select name="formation" id="formation_teacher">
            @foreach ($formations as $formation)
                <option value="{{ $formation->FOR_ID }}">{{ $formation->FOR_ANNEE }} - {{ $formation->level->NIV_DESCRIPTION }}</option>
            @endforeach
        </select>
        <button type="submit">Submit</button>
    </form>

    <h2>Creer un compte pour mon club</h2>

    <form action="{{ route('addUser') }}" method="POST">
        @csrf
    
        <div>
            <label for="UTI_NOM">Nom</label>
            <input type="text" name="UTI_NOM" id="UTI_NOM" value="{{ old('UTI_NOM') }}" required>
            @error('UTI_NOM')
                <div>{{ $message }}</div>
            @enderror
        </div>
    
        <div>
            <label for="UTI_PRENOM">Prénom</label>
            <input type="text" name="UTI_PRENOM" id="UTI_PRENOM"  required>
            @error('UTI_PRENOM')
                <div>{{ $message }}</div>
            @enderror
        </div>
    
        <div>
            <label for="UTI_MAIL">Email</label>
            <input type="email" name="UTI_MAIL" id="UTI_MAIL"  required>
            @error('UTI_MAIL')
                <div>{{ $message }}</div>
            @enderror
        </div>

        <label for="lvl">Sélectionner un niveau :</label>
        <select name="lvl" id="lvl">
            @foreach ($levels as $level)
                <option value="{{ $level->NIV_ID }}">{{ $level->NIV_DESCRIPTION }}</option>
            @endforeach
        </select>
    
        <div>
            <label for="init">Initiateur</label>
            <input type="radio" id="oui" name="init" value="1" required>
            <label for="active_yes">Oui</label>
            <input type="radio" id="non" name="init" value="0" required>
            <label for="active_no">Non</label>
        </div>
        <input type="hidden" name="clubId" value="{{ $clubId }}">
        <button type="submit">Créer un compte</button>
    </form>
    
    <!-- fin DT -->

</body>
</html>