<!DOCTYPE html>
<html>
<head>
    <title>Create Website</title>
</head>
<body>
    <h1>Create Website</h1>
    <form method="POST" action="/api/websites">
        @csrf
        <label for="name">Website Name:</label>
        <input type="text" name="name" id="name" required>
        <button type="submit">Create Website</button>
    </form>
</body>
</html>
