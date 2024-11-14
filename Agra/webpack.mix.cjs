const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        require('tailwindcss'),
        require('postcss-import'),
    ]);

// Copy the intro.js file from node_modules to public/js
mix.copy('node_modules/intro.js/minified/intro.min.js', 'public/js/intro.min.js');
// Copy the intro.js CSS file
mix.copy('node_modules/intro.js/minified/introjs.min.css', 'public/css/introjs.min.css');
