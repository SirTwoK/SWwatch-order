<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Star Wars Watchlist') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@300;400;600;700;800&family=Rajdhani:wght@400;500;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
</head>
<body>

    <canvas id="starfield"></canvas>
    <div class="content-fade content-fade-left"></div>
    <div class="content-fade content-fade-right"></div>

    <div id="app-content">
        {{ $slot }}
    </div>

    <script>
        (function () {
            const canvas = document.getElementById('starfield');
            const ctx = canvas.getContext('2d');

            function resize() {
                canvas.width = window.innerWidth;
                canvas.height = window.innerHeight;
                draw();
            }

            function draw() {
                const w = canvas.width;
                const h = canvas.height;
                ctx.clearRect(0, 0, w, h);
                ctx.fillStyle = '#06080c';
                ctx.fillRect(0, 0, w, h);

                for (let i = 0; i < 320; i++) {
                    const x = Math.random() * w;
                    const y = Math.random() * h;
                    const r = Math.random() * 1.1 + 0.2;
                    const alpha = 0.25 + Math.random() * 0.55;
                    ctx.beginPath();
                    ctx.arc(x, y, r, 0, Math.PI * 2);
                    ctx.fillStyle = `rgba(255,255,255,${alpha})`;
                    ctx.fill();
                }

                for (let i = 0; i < 60; i++) {
                    const onLeft = Math.random() < 0.5;
                    const x = onLeft
                        ? Math.random() * w * 0.28
                        : w * 0.72 + Math.random() * w * 0.28;
                    const y = Math.random() * h;
                    const r = Math.random() * 1.6 + 0.4;
                    const alpha = 0.5 + Math.random() * 0.5;
                    ctx.beginPath();
                    ctx.arc(x, y, r, 0, Math.PI * 2);
                    ctx.fillStyle = `rgba(255,255,255,${alpha})`;
                    ctx.fill();
                }
            }

            resize();
            window.addEventListener('resize', resize);
        })();
    </script>

</body>
</html>