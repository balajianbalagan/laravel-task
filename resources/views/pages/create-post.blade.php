<!DOCTYPE html>
<html>
<head>
    <title>Create Post</title>
</head>
<body>
    <h1>Create Post</h1>
    <form method="POST" action="/websites/{{ $website->id }}/posts">
        @csrf
        <label for="title">Post Title:</label>
        <input type="text" name="title" required><br>
        <label for="description">Post Description:</label>
        <textarea name="description" required></textarea><br>
        <button type="submit">Create Post</button>
    </form>
</body>
</html>
