let mix = require('laravel-mix');
const sourceAssets = 'resources/assets/';
const nodePath = 'node_modules/';

mix.styles([
    sourceAssets + 'css/bootstrap.min.css',
    nodePath + 'bootstrap-select/dist/css/bootstrap-select.min.css',
    sourceAssets + 'css/helper.css',
    sourceAssets + 'css/spinners.css',
    sourceAssets + 'css/animate.css',
    sourceAssets + 'css/style.css',
    sourceAssets + 'css/notification.css',
    sourceAssets + 'css/tagsinput.css'
], 'public/css/tokki/auth/style.css');

mix.styles([
    sourceAssets + 'icons/font-awesome/css/font-awesome.min.css',
    sourceAssets + 'icons/simple-line-icons/css/simple-line-icons.css',
    sourceAssets + 'icons/weather-icons/css/weather-icons.min.css',
    sourceAssets + 'icons/linea-icons/linea.css',
    sourceAssets + 'icons/themify-icons/themify-icons.css',
    sourceAssets + 'icons/flag-icon-css/flag-icon.min.css',
    sourceAssets + 'icons/material-design-iconic-font/css/materialdesignicons.min.css'
], 'public/css/tokki/auth/icons/icons.css');

mix.scripts([
    sourceAssets + 'js/jquery.min.js',
    sourceAssets + 'js/popper.min.js',
    sourceAssets + 'js/bootstrap.min.js',
    nodePath + 'bootstrap-select/dist/js/bootstrap-select.min.js',
    nodePath + 'angular/angular.js',
    sourceAssets + 'js/jquery.slimscroll.js',
    sourceAssets + 'js/sidebarmenu.js',
    sourceAssets + 'js/sticky-kit.min.js',
    sourceAssets + 'js/scripts.js',
    sourceAssets + 'js/notification.js',
    nodePath + 'sweetalert/dist/sweetalert.min.js',
    sourceAssets + 'js/tagsinput.js',
], 'public/js/tokki/auth/script.js');

// CK Editor Lib
mix.scripts([
    nodePath + '@ckeditor/ckeditor5-build-classic/build/ckeditor.js'
], 'public/js/tokki/auth/editor.js');

// Date Picker Lib
mix.styles([
    nodePath + '@chenfengyuan/datepicker/dist/datepicker.min.css'
], 'public/css/tokki/auth/datepicker.css');

mix.scripts([
    nodePath + '@chenfengyuan/datepicker/dist/datepicker.min.js'
], 'public/js/tokki/auth/datepicker.js');

// WEB RELATED STYLES and SCRIPT

mix.style([

]);