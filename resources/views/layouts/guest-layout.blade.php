<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'People List' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js']) <!-- Charger les assets avec Vite -->
</head>
<body class="bg-gray-100 font-sans">
    <div class="min-h-screen flex flex-col items-center justify-center p-4">
        {{ $slot }} <!-- Contenu dynamique -->
    </div>
</body>
</html>