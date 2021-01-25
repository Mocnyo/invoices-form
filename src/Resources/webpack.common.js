'use strict';

const exec = require('child_process').exec;
const path = require('path');
const CleanWebpackPlugin = require('clean-webpack-plugin');
const { VueLoaderPlugin } = require('vue-loader');
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const HtmlWebpackPlugin = require('html-webpack-plugin');

const command = 'mv ' + path.resolve(__dirname, 'dist/css.html.twig') + ' ' + path.resolve(__dirname, '../../templates/dist') + ' && ' +
    'mv ' + path.resolve(__dirname, 'dist/js.html.twig') + ' ' + path.resolve(__dirname, '../../templates/dist') + ' && ' +
    'cp -r ' + path.resolve(__dirname, 'dist') + ' ' + path.resolve(__dirname, '../../public');

module.exports = {
    entry: {
        app: './src/js/app.js',
    },
    output: {
        filename: '[name].[contenthash].bundle.js',
        path: path.resolve(__dirname, 'dist')
    },
    module: {
        rules: [
            {
                test: /\.vue$/,
                use: 'vue-loader'
            },
            {
                test: /\.m?js$/,
                exclude: /(node_modules)/,
                use: {
                    loader: 'babel-loader',
                    options: {
                        presets: [
                            '@babel/preset-env',
                            {
                                plugins: [
                                    '@babel/plugin-proposal-class-properties'
                                ]
                            }
                        ]
                    }
                }
            },
            {
                test: /\.css$/,
                use: [
                    MiniCssExtractPlugin.loader,
                    "css-loader"
                ]
            },
            {
                test: /\.less$/,
                use: [
                    MiniCssExtractPlugin.loader,
                    "css-loader",
                    'less-loader'
                ]
            },
            {
                test: /\.(ttf|eot|svg|woff|woff2|png|jpg|gif|ico)(\?v=[0-9]\.[0-9]\.[0-9])?$/,
                use: [
                    'url-loader'
                ]
            }
        ]
    },
    plugins: [
        new CleanWebpackPlugin(['dist']),
        new VueLoaderPlugin(),
        new MiniCssExtractPlugin({
            filename: "[name].[contenthash].css",
        }),
        new HtmlWebpackPlugin(),
        new HtmlWebpackPlugin({
            filename: 'css.html.twig',
            template: '../../templates/assets/css-template.html.twig',
            minify: false,
            inject: false,
        }),
        new HtmlWebpackPlugin({
            filename: 'js.html.twig',
            template: '../../templates/assets/js-template.html.twig',
            minify: false,
            inject: false,
        }),
        {
            apply: (compiler) => {
                compiler.hooks.afterEmit.tap('AfterEmitPlugin', (compilation) => {
                    exec(command, (err, stdout, stderr) => {
                        if (stdout) process.stdout.write(stdout);
                        if (stderr) process.stderr.write(stderr);
                    });
                });
            }
        }
    ],
    optimization: {
        splitChunks: {
            chunks: 'all',
            maxSize: 500000,
            cacheGroups: {
                vendor: {
                    test: /[\\/]node_modules[\\/]/,
                    name: 'vendors',
                }
            }
        }
    }
};
