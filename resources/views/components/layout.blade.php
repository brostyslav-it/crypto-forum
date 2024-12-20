<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        function updateFileName() {
            const input = document.getElementById('avatar');
            const fileName = input.files.length ? input.files[0].name : 'No file chosen';
            document.getElementById('file-name').textContent = fileName;
        }
    </script>
</head>
<body class="bg-gray-100 flex flex-col items-center min-h-screen">
<x-header />
{{ $slot }}
</body>
</html>
