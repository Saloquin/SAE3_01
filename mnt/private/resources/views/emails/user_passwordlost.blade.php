<!DOCTYPE html>
<html>
<head>
    <title>Compte Créé</title>
</head>
<body>
    <h1>Bonjour, {{ $user['name'] }}</h1>
    <p>Voici votre mot de passe de récupération.</p>
    <p>Email : {{ $user['email'] }}</p>
    <p>Licence  : {{ $user['licence'] }}</p>
    <p>Mot de passe temporaire : {{ $user['password'] }}</p>
</body>
</html>