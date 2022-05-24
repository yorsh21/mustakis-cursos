const mix = require('laravel-mix');

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


//Backend
mix.scripts([
    'resources/assets/js/jquery-3.1.1.min.js',
    'resources/assets/js/popper/popper.min.js',
    'resources/assets/js/bootstrap.min.js',
    'resources/assets/js/plugins/dropzone/dropzone.js',
    'resources/assets/js/plugins/jasny/jasny-bootstrap.min.js',
    'resources/assets/js/plugins/metisMenu/jquery.metisMenu.js',
    'resources/assets/js/plugins/slimscroll/jquery.slimscroll.min.js',
    'resources/assets/js/inspinia.js',
    'resources/assets/js/plugins/pace/pace.min.js',
    'resources/assets/js/plugins/dataTables/datatables.min.js',
    'resources/assets/js/plugins/sweetalert/sweetalert.min.js',
    'resources/assets/js/plugins/summernote/summernote.min.js',
    'resources/assets/js/plugins/select2/select2.full.min.js',
    'resources/assets/js/plugins/chartJs/Chart.min.js',
    'resources/assets/js/plugins/fullcalendar/moment.min.js',
    'resources/assets/js/plugins/jquery-ui/jquery-ui.min.js',
    'resources/assets/js/plugins/iCheck/icheck.min.js',
    'resources/assets/js/plugins/fullcalendar/fullcalendar.min.js',
    'resources/assets/js/plugins/fullcalendar/lang-es.js',
    'resources/assets/js/backend.js',
], 'public/js/backend.js');

mix.styles([
    'resources/assets/css/bootstrap.min.css',
    'resources/assets/css/font-awesomes.min.css',
    'resources/assets/sass/plugins/dropzone/basic.css',
    'resources/assets/sass/plugins/dropzone/dropzone.css',
    'resources/assets/sass/plugins/dataTables/datatables.min.css',
    'resources/assets/sass/plugins/jasny/jasny-bootstrap.min.css',
    'resources/assets/sass/plugins/sweetalert/sweetalert.css',
    'resources/assets/sass/plugins/summernote/summernote.css',
    'resources/assets/sass/plugins/select2/select2.min.css',
    'resources/assets/sass/plugins/select2/select2.min.css',
    'resources/assets/sass/plugins/jQueryUI/jquery-ui.css',
    'resources/assets/sass/plugins/iCheck/custom.css',
    'resources/assets/sass/plugins/fullcalendar/fullcalendar.css',
], 'public/css/plugins.css');

mix.sass('resources/assets/sass/app.scss','public/css/backend.css');


//Encuestas
mix.scripts([
    'resources/assets/js/plugins/from-builder/jquery-2.1.4.min.js',
    'resources/assets/js/plugins/from-builder/jquery-ui.min.js',
    'resources/assets/js/plugins/from-builder/from-builder.min.js',
    'resources/assets/js/plugins/from-builder/form-render.min.js',

    'resources/assets/js/bootstrap.min.js',
    'resources/assets/js/inspinia.js',
    'resources/assets/js/plugins/dropzone/dropzone.js',
    'resources/assets/js/plugins/jasny/jasny-bootstrap.min.js',
    'resources/assets/js/plugins/metisMenu/jquery.metisMenu.js',
    'resources/assets/js/plugins/slimscroll/jquery.slimscroll.min.js',
    
], 'public/js/survey.js');


//Frontend
mix.styles([
	'resources/assets/website/bootstrap-v4.css',
	'resources/assets/website/font-awesome.css',
	'resources/assets/website/magnific-popup/magnific-popup.css',
	'resources/assets/website/freelancer.css'
], 'public/css/web.css');

mix.scripts([
	'resources/assets/website/jquery-v3.3.1.js',
	'resources/assets/website/bootstrap-v4.bundle.js',
	'resources/assets/website/jquery.easing.js',
	'resources/assets/website/jquery.magnific-popup.js',
	'resources/assets/website/jqBootstrapValidation.js',
	'resources/assets/website/contact_me.js',
    'resources/assets/website/freelancer.js',
    'resources/assets/js/frontend.js',
], 'public/js/web.js');

mix.copyDirectory('resources/assets/img', 'public/img');
mix.copyDirectory('resources/assets/fonts', 'public/fonts');
