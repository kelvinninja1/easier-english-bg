var elixir = require('laravel-elixir');

require('laravel-elixir-imagemin');

config.assetsPath = './content/themes/easier-english-bg-theme';

elixir(function(mix) {
    mix
    /**
     * Compile the main .scss file to .css
     * and combine the css files into a single file.
     * During the compilation elixir AutoPrefixes the css
     * http://laravel.com/docs/5.1/elixir#sass
     */
    .sass([
        '../../../lib/normalize-css/normalize.css',

        'style.scss'
    ], 'content/themes/easier-english-bg-theme/css/style.min.css')
    .sass('text-to-speech.scss', 'content/themes/easier-english-bg-theme/css/text-to-speech.min.css')
    /**
     * Combine the js files into a single file
     * http://laravel.com/docs/5.1/elixir#javascript
     */
    .scripts([
        'jquery.mmenu.min.js',

        // Hiding your header until you need it
        '../../../lib/headroom.js/dist/headroom.js',

        // JS responsible for the Speech Synthesis API integration
        'text-to-speech.js',

        // Build and init mobile menu plugin
        'mobile-menu.js',

        'script.js'
    ], 'content/themes/easier-english-bg-theme/js/script.min.js')
    /**
     * Minify images with ImageMin: https://github.com/imagemin/imagemin
     *  - gifsicle — Compress GIF images
     *  - jpegtran — Compress JPEG images
     *  - optipng — Compress PNG images
     *  - svgo — Compress SVG images
     * Use a Laravel Elixir wrapper for ImageMin
     * https://github.com/nathanmac/laravel-elixir-imagemin
     */
    .imagemin(
        './content/themes/easier-english-bg-theme/img-uncompressed',
        './content/themes/easier-english-bg-theme/img',
        { optimizationLevel: 3, progressive: true, interlaced: true }
    );
});
