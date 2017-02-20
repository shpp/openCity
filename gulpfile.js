const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(mix => {
    mix
    .sass(['bulma/bulma.sass', 'map.scss'], 'public/assets/css/map.css')
    .sass('app.scss')
    .webpack('map.js')
    .webpack('app.js')
    .version(['assets/css/map.css', 'js/map.js']);
})
;
