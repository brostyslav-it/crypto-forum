<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        function updateFileName() {
            const input = document.getElementById('avatar');
            document.getElementById('file-name').textContent = input.files.length ? input.files[0].name : 'No file chosen';
        }

        function like(postId) {
            fetch(`/like/post/${postId}`, {
                method: "POST",
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
                .then(response => response.json())
                .then(data => {
                    document.getElementById(`like-count-${postId}`).textContent = data.likes
                    document.getElementById(`like-for-${postId}`).innerHTML = data.liked
                        ? `<x-like-filled onclick="like(${postId})" />`
                        : `<x-like-empty onclick="like(${postId})" />`

                    if (data.dislike_deleted) {
                        document.getElementById(`dislike-count-${postId}`).textContent = data.dislikes
                        document.getElementById(`dislike-for-${postId}`).innerHTML = `<x-dislike-empty onclick="dislike(${postId})" />`
                    }
                })
                .catch(error => console.error("Error:", error))
        }

        function dislike(postId) {
            fetch(`/dislike/post/${postId}`, {
                method: "POST",
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
                .then(response => response.json())
                .then(data => {
                    document.getElementById(`dislike-count-${postId}`).textContent = data.dislikes
                    document.getElementById(`dislike-for-${postId}`).innerHTML = data.disliked
                        ? `<x-dislike-filled onclick="dislike(${postId})" />`
                        : `<x-dislike-empty onclick="dislike(${postId})" />`

                    if (data.like_deleted) {
                        document.getElementById(`like-count-${postId}`).textContent = data.likes
                        document.getElementById(`like-for-${postId}`).innerHTML = `<x-like-empty onclick="like(${postId})" />`
                    }
                })
                .catch(error => console.error("Error:", error))
        }
    </script>
</head>
<body class="bg-gray-100 flex flex-col items-center min-h-screen">
<x-header />
{{ $slot }}
</body>
</html>
