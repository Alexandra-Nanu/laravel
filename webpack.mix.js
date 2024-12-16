//import the laravel mix module (simplifies compiling and bundling styling
const mix = require('laravel-mix');

//define a task to process css files
mix.css('resources/css/app.css', 'public/css');
