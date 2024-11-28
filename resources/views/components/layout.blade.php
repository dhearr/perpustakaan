<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <title>Pustakawan</title>
</head>

<body class="h-full bg-[#FAFAFA] dark:bg-[#09090B]">
    <div class="min-h-full">
        <main>
            <section class="w-full relative">
                {{ $slot }}
            </section>
        </main>
    </div>
</body>

</html>
