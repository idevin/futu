const path = require('path');
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const TerserPlugin = require('terser-webpack-plugin');
const CssMinimizerPlugin = require("css-minimizer-webpack-plugin");
const WebpackAssetsManifest = require('webpack-assets-manifest');
const WebpackRequireFrom = require("webpack-require-from");
const {CleanWebpackPlugin} = require('clean-webpack-plugin');
const webpack = require("webpack");

module.exports = {
    mode: 'production',
    entry: {
        app: path.resolve(__dirname, 'src/js/app.js')
    },
    output: {
        filename: 'dist/js/[name].js',
        path: path.resolve(__dirname)
    },
    optimization: {
        splitChunks: {
            cacheGroups: {
                commons: {
                    test: /[\\/]node_modules[\\/]/,
                    name: 'app-vendors',
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
    module: {
        rules: [
            {
                test: /\.jsx$|\.es6$|\.js$/,
                loader: 'babel-loader',
                exclude: /(node_modules|bower_components)/,
                options: {
                    babelrc: true,
                    compact: true
                }
            },
            {
                test: /\.(woff2|woff|ttf|eot|svg)?$/,
                exclude: /(node_modules|bower_components)/,
                use: {
                    loader: "url-loader",
                    options: {
                        limit: 100000,
                        mimetype: "application/font-woff",
                        name: "dist/fonts/[name].[ext]",
                    }
                },
            },
            {
                test: /\.s[ca]ss$/i,
                use: [
                    MiniCssExtractPlugin.loader,
                    {
                        loader: 'css-loader',
                        options: {
                            importLoaders: 2
                        }
                    },
                    {
                        loader: 'sass-loader',
                        options: {
                            sassOptions: {
                                outputStyle: 'compressed'
                            }
                        }
                    }
                ],
            },
        ],
    },
    resolve: {
        alias: {
            jquery: "jquery/dist/jquery",
            index: path.resolve(__dirname, 'src/js/app.js')
        }
    },
    plugins: [
        new MiniCssExtractPlugin({
            filename: 'dist/css/[name].css',
        }),
        new WebpackAssetsManifest({
            merge: false,
            output: path.resolve(__dirname, 'dist/manifest.json'),
            publicPath: path.resolve(__dirname, 'dist/')
        }),
        new WebpackRequireFrom({
            path: "/"
        }),
        new CleanWebpackPlugin({
            dry: false,
            cleanOnceBeforeBuildPatterns: [path.resolve(__dirname, 'dist/**')],
            verbose: true
        }),
        new webpack.ProvidePlugin({
            $: 'jquery',
            jQuery: 'jquery',
        }),
    ]
};