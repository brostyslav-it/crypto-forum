<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex flex-col items-center min-h-screen">
<x-header />
{{ $slot }}
<script>
    document.getElementById('nav-toggle').addEventListener('click', () => {
        const menu = document.getElementById('mobile-menu');
        menu.style.display = menu.style.display === 'none' ? 'block' : 'none';
    });
</script>
</body>
</html>
