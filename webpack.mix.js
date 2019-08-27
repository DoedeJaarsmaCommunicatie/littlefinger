const mix = require('laravel-mix');

mix
    .sass('assets/styles/main.scss', 'dist/styles/app.css')
    .copyDirectory('assets/images', 'dist/images')
    .ts('assets/scripts/app.ts', 'dist/scripts')
    .options({
        processCssUrls: false,
        postCss: [
            require('tailwindcss'),
            require('autoprefixer')
        ]
    })
