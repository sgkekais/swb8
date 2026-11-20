const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.copy('node_modules/trix/dist/trix.js', 'public/vendor/trix/trix.js');
mix.copy('node_modules/chart.js/dist/chart.umd.min.js', 'public/vendor/chartjs/chart.umd.min.js');
mix.copy('node_modules/@fortawesome/fontawesome-free/css/all.min.css', 'public/vendor/fontawesome/css/all.min.css');
mix.copy([
    'node_modules/@fortawesome/fontawesome-free/webfonts/fa-solid-900.woff2',
    'node_modules/@fortawesome/fontawesome-free/webfonts/fa-solid-900.woff',
    'node_modules/@fortawesome/fontawesome-free/webfonts/fa-regular-400.woff2',
    'node_modules/@fortawesome/fontawesome-free/webfonts/fa-regular-400.woff',
], 'public/vendor/fontawesome/webfonts');

mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
    ]).browserSync({
        proxy: 'swb8.test'
});
