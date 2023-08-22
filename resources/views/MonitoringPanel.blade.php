<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <link rel="icon" type="image/svg+xml" href="/stethoscope.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Monitoring Panel</title>
  </head>
  <body class="bg-gray-100">
    <div id="app"></div>
    @vite(['resources/js/src/main.js', 'resources/js/src/style.css'], 'vendor/stethoscope')

    <script>
      window.stethoscope = @json($stethoscopeScriptVariables);
    </script>
  </body>
</html>
