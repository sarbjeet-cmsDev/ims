<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Component Preview</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="p-10 space-y-10">
    <h1 class="text-2xl font-bold mb-4">Flowbite Blade Components Demo</h1>

<x-input name="name" placeholder="Name" />
<x-input-date name="dob" />
<x-file-uploader name="resume" />
<x-button>Submit</x-button>
<x-search />
<x-pagination :data="$data ?? collect()" />
<x-rating :rating="3" />
<x-action-dropdown />
<x-phone-input />
<x-address />
</body>
</html>

