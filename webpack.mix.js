const mix = require('laravel-mix');

mix
    .postCss('assets/styles/main.pcss', 'dist/styles')
    .options({
        postCss: [
            require('postcss-import'),
            require('tailwindcss'),
            require('precss'),
            require('postcss-short-border'),
            require('postcss-short-spacing'),
            require('postcss-color-mod-function'),
        ]
    })
