<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
</head>
<body>
    
    
     <h2>Students</h2>   
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
    
    <h2>Teachers</h2>
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
    
    
</body>
</html>