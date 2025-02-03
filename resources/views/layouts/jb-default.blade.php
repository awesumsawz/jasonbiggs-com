<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jason Biggs Developer</title>
</head>

<body>
    <header id="main-menu" class="topbar navbar">
        section.title
    </header>
    <main>
        <div>
            <h1>{{ $title }}</h1>
            {{ $content }}
        </div>
    </main>
    <footer>
        <div>
            {{ $footer }}
        </div>
    </footer>
    </body>
</html>
