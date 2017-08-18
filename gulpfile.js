const elixir = require('laravel-elixir');
// let mix = require('laravel-mix').mix;
// require('laravel-elixir-vue-2');

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
    .sass('app.scss')
    .webpack('map.js')
    .webpack('app.js')
    .version(['css/app.css', 'js/map.js', 'js/app.js']);
})
// ;
