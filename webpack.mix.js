const mix = require('laravel-mix')
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const WebpackAssetsManifest = require("webpack-assets-manifest");
const path = require("path");
const WebpackRequireFrom = require("webpack-require-from");
const {CleanWebpackPlugin} = require("clean-webpack-plugin");
const TerserPlugin = require("terser-webpack-plugin");
const CssMinimizerPlugin = require("css-minimizer-webpack-plugin");

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.webpackConfig(webpack => {
    return {
        plugins: [
            new WebpackAssetsManifest({
                merge: false,
                output: path.resolve(__dirname, 'public/manifest.json'),
                publicPath: false,
                sortManifest: false
            }),
            new webpack.ProvidePlugin({
                $: 'jquery',
                jQuery: 'jquery',
            }),
        ],
        optimization: {
            usedExports: true,
            sideEffects: false
        },
    }
});

mix.js('resources/js/admin.js', 'public/js')
    .sass('resources/sass/admin.scss', 'public/css')

mix.js('resources/js/app.js', 'public/js/app.js')
mix.sass('resources/sass/app.sass', 'public/css/app.css')

mix.copy('node_modules/flickity/dist/flickity.pkgd.min.js', 'public/js/flickity.min.js')
mix.copy('node_modules/trumbowyg/dist/ui/icons.svg', 'public/js/ui/icons.svg')

mix.copy('resources/img', 'public/images')
mix.copy('resources/fonts', 'public/fonts')
mix.copy('resources/videos', 'public/videos')

if (mix.inProduction()) {
    mix.version()
}