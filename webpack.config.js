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
        filename: 'public/js/[name].js',
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
                test: /\.(woff2|woff|ttf|eot)?$/,
                exclude: /(node_modules|bower_components)/,
                use: {
                    loader: "url-loader",
                    options: {
                        limit: 100000,
                        mimetype: "application/font-woff",
                        name: "public/fonts/[name].[ext]",
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
            index: path.resolve(__dirname, 'public/js/app.js')
        }
    },
    plugins: [
        new MiniCssExtractPlugin({
            filename: 'public/css/[name].css',
        }),
        new WebpackAssetsManifest({
            merge: false,
            output: path.resolve(__dirname, 'public/manifest.json'),
            publicPath: path.resolve(__dirname, 'public/')
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
    ]
};