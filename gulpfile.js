var elixir = require('laravel-elixir');
var scss   = require('postcss-scss');
var config = elixir.config;

require('laravel-elixir-stylelint');

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

elixir(function(mix) {
    mix
      .stylelint([
        config.get('assets.css.sass.folder') + '/**/*.scss'
      ], {syntax: scss})
      .sass('app.scss');
});
