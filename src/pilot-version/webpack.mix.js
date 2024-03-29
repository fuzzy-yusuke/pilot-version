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
 
mix.js('resources/js/app.js', 'public/js').vue()
    .postCss('resources/css/app.css', 'public/css', [
        //
    ])
    .postCss('resources/css/dashboard.css', 'public/css', [
        //
    ])
    .postCss('resources/css/header.css', 'public/css', [
        //
    ])
    .postCss('resources/css/login_ex.css', 'public/css', [
        //
    ])
    .sass('resources/sass/app.scss', 'public/css');
