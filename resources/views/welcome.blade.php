<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
      @vite('resources/css/app.css')
</head>
<body>
    <h1 class="text-3xl font-bold underline">Welcome to {{ config('app.name', 'Laravel') }}</h1>
    <p>This is the default welcome page.</p>
</body>
</html>