<!DOCTYPE html>
<html>
<head>
    <title>Subscribe to Website</title>
</head>
<body>
    <h1>Subscribe to Website</h1>
    <form method="POST" action="/websites/{{ $website->id }}/subscribe">
        @csrf
        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
        <p>Subscribing to: {{ $website->name }}</p>
        <button type="submit">Subscribe</button>
    </form>
</body>
</html>
