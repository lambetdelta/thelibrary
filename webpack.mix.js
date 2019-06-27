let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.babel([
      'resources/assets/js/functions.js',
      'resources/assets/js/Ms.js',
      'resources/assets/js/Path.js',
      'resources/assets/js/List.js',
      'resources/assets/js/ConfigListBasic.js',
      'resources/assets/js/EvaluatePassword.js',
      'resources/assets/js/ImgPreview.js',
      'resources/assets/js/HttpResponses.js',
   ], 'public/js/app.js')
   .babel('resources/assets/js/DocReady.js', 'public/js/DocReady.js')
   .babel('resources/assets/js/ConfigListUser.js', 'public/js/ConfigListUser.js')
   .scripts([
      'resources/assets/vendor/Bootstrap-4.1.3/js/bootstrap.min.js',
      'resources/assets/vendor/air-datepicker/dist/js/datepicker.min.js',
      'resources/assets/vendor/air-datepicker/dist/js/i18n/datepicker.es.js',
      'resources/assets/vendor/MultiselectBootstrap/js/bootstrap-multiselect.js',
      'resources/assets/vendor/DataTables/datatables.js',
      'resources/assets/vendor/Moment/moment-with-locales.min.js',
      'resources/assets/vendor/Selectize/dist/js/standalone/selectize.js',
      'resources/assets/vendor/Notify/notify.min.js',
      'resources/assets/vendor/jquery-confirm-v3/jquery-confirm.min.js',
      'resources/assets/vendor/Utf8/Utf8.js',
      'node_modules/izitoast/dist/js/iziToast.min.js',
   ], 'public/js/vendor.js')
   .scripts('resources/assets/vendor/Popper/popper.min.js','public/js/popper.min.js')
   .scripts([
       'resources/assets/js/ConfigListBook.js',
       'resources/assets/js/Borrowings.js'
    ],'public/js/list_book.js')
   .styles([
      'resources/assets/vendor/Bootstrap-4.1.3/css/bootstrap.css',
      'resources/assets/vendor/air-datepicker/dist/css/datepicker.min.css',
      'resources/assets/vendor/MultiselectBootstrap/css/bootstrap-multiselect.css',
      'resources/assets/vendor/fontawesome-free-5.5.0/css/all.css',
      'resources/assets/vendor/DataTables/datatables.css',
      'resources/assets/vendor/jquery-confirm-v3/jquery-confirm.min.css',
      'node_modules/izitoast/dist/css/iziToast.min.css',
      'resources/assets/vendor/Selectize/dist/css/selectize.default.css',
   ], 'public/css/vendor.css')
   .styles([
      'resources/assets/css/app.css'
   ], 'public/css/app.css');

   mix.copyDirectory('resources/assets/css/font', 'public/css/font');
   // mix.copyDirectory('node_modules/laravel-echo', 'public/js/laravel-echo');
   // mix.copyDirectory('node_modules/pusher-js', 'public/js/pusher-js');
