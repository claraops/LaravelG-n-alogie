<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="{{ route('proposals.validate', ['proposalId' => 1]) }}" method="POST">
    @csrf <!-- Token CSRF pour la sécurité -->
    <button type="submit">Valider la proposition</button>
</form>
</body>
</html>