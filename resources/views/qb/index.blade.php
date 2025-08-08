<!DOCTYPE html>
<html>
<head>
    <title>Query Builder Practice</title>
</head>
<body>
    <h1>Query Builder Results</h1>
    <ul>
        @foreach($data as $row)
            <li>{{ $row->id }} - {{ $row->name }} ({{ $row->email }})</li>
        @endforeach
    </ul>
</body>
</html>
