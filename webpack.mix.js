const mix = require('laravel-mix');


mix.sass('resources/assets/admin/scss/style.scss', 'public/admin/assets/css/style.css')
    .sass('resources/assets/admin/scss/style_dark.scss', 'public/admin/assets/css/style_dark.css')
    .js(['resources/assets/admin/js/app.js'], 'public/admin/assets/js/app.js')
    .browserSync({
        proxy: 'backstarter.test'
    })
    .options({
        processCssUrls: false
    });


