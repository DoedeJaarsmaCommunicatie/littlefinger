const mix = require('laravel-mix');

const purger = mix.inProduction()
    ? [
        require('@fullhuman/postcss-purgecss')({
            content: [
                './templates/**/*.html.twig',
                './assets/scripts/**/*.vue',
                './assets/scripts/**/*.jsx',
                './assets/styles/**/*.scss',
                './templates/**/*.html',
                './templates/**/*.twig',
            ],

            defaultExtractor: content => content.match(/[\w-\/:]+(?<!:)/g) || [],
        })
        ] : [];

mix
    .sass('assets/styles/main.scss', 'dist/styles/app.css')
    .copyDirectory('assets/images', 'dist/images')
    .ts('assets/scripts/app.ts', 'dist/scripts')
    .options({
        processCssUrls: false,
        postCss: [
        require('tailwindcss'),
        require('autoprefixer'),
        ...purger
        ]
    })
