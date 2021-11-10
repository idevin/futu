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
            new WebpackRequireFrom({
                path: "/"
            }),
            new CleanWebpackPlugin({
                dry: false,
                cleanOnceBeforeBuildPatterns: [
                    path.resolve(__dirname, 'public/js'),
                    path.resolve(__dirname, 'public/css')
                ],
                verbose: true
            }),
            new webpack.ProvidePlugin({
                $: 'jquery',
                jQuery: 'jquery',
            }),
        ],
        optimization: {
            splitChunks: {
                cacheGroups: {
                    commons: {
                        test: /[\\/]node_modules[\\/]/,
                        name: 'vendor/app-vendor',
                        chunks: 'all'
                    }
                }
            },
            minimize: true,
            minimizer: [
                new TerserPlugin({
                    terserOptions: {
                        ecma: 6,
                        compress: true,
                        output: {
                            comments: false,
                            beautify: false
                        }
                    }
                }),
                new CssMinimizerPlugin({
                    test: /\.s[ca]ss$/i
                })
            ],
            usedExports: true,
            sideEffects: false
        },
    }
});

mix.js('resources/js/admin.js', 'public/js')
    .sass('resources/sass/admin.scss', 'public/css')

mix.js('src/js/app.js', 'public/js/app.js')
mix.sass('src/sass/app.sass', 'public/css/app.css')

mix.copy('node_modules/flickity/dist/flickity.pkgd.min.js', 'public/js/flickity.min.js')
mix.copy('node_modules/trumbowyg/dist/ui/icons.svg', 'public/js/ui/icons.svg')

mix.copy('src/img', 'public/images')
mix.copy('src/fonts', 'public/fonts')
mix.copy('src/videos', 'public/videos')

if (mix.inProduction()) {
    mix.version()
}