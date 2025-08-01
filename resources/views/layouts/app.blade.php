<!doctype html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')
    
  </head>
  <body id="app">
    <h1 class="text-3xl font-bold underline">
      Hello world!
    </h1>

    <script type="module" src="{{ mix('js/app.js') }}"></script>
  </body>
</html>