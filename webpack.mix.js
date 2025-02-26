const mix = require('laravel-mix');

// Menentukan folder untuk file CSS dan JS
mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sourceMaps(); // Opsional: Mengaktifkan source maps untuk debugging