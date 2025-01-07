<!DOCTYPE html>
<html>
<head>
    <title>Compte Créé</title>
</head>
<body>
    <h1>Bonjour {{ $user['name'] }}</h1>
    <p>Votre compte a été créé avec succès.</p>
    <p>Email : {{ $user['email'] }}</p>
    <p>Mot de passe temporaire : {{ $user['password'] }}</p>
</body>
</html>