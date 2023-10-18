<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1">

    <!-- inertia head  -->
    @inertiaHead

    <!-- fonts  -->
    <link rel="preconnect"
          href="https://fonts.googleapis.com">
    <link rel="preconnect"
          href="https://fonts.gstatic.com"
          crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap"
          rel="stylesheet">

    <!-- script  -->
    @vite(['resources/js/app.ts', "resources/js/pages/{$page['component']}.vue"])
</head>
<body class="font-sans text-slate-700 antialiased">
@inertia
</body>
</html>
