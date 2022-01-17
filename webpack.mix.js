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

mix.js('resources/js/admin/admin.js', 'js/admin.js')
    // .js('resources/js/public/public.js', 'js/public.js')
    // .js('resources/js/users/users.js', 'js/users.js')
    // .sass('resources/sass/admin/admin.scss', 'css/admin.css')
    .sass('resources/sass/public/public.scss', 'css/public.css')
    // .sass('resources/sass/users/users.scss', 'css/users.css')
    // .sass('resources/sass/auth/auth.scss', 'css/auth.css')
    // .copy(
    //     'node_modules/@fortawesome/fontawesome-free/webfonts',
    //     'public/webfonts'
    // )
    .sourceMaps(false, 'source-map');