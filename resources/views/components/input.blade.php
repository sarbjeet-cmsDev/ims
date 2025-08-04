<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
      @vite('resources/css/app.css')
</head>
<body class="m-8 ...">
 <input type="{{ $type ?? 'text' }}"
    name="{{ $name }}"
    id="{{ $id ?? $name }}"
    value="{{ $value ?? '' }}"
    class="form-input block w-full p-2.5 border border-gray-300 rounded-lg"
    placeholder="{{ $placeholder ?? '' }}" />
</body>
</html>
