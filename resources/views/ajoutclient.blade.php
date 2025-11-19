<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title> inscription</title>
</head>
<body>
    <form action="/account/add" method="POST">
    @csrf

    Nom : <input type="text" name="nom"><br>
    Prénom : <input type="text" name="prenom"><br>
    Email : <input type="email" name="email"><br>
    Adresse : <input type="text" name="adresse"><br>
    Téléphone : <input type="text" name="tel"><br>

    <button type="submit">Ajouter</button>
</form>
</body>