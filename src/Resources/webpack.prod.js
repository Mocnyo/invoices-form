const merge = require('webpack-merge');
const common = require('./webpack.common');

module.exports = merge(common, {
    mode: 'production',
    devtool: 'inline-source-map',
    resolve: {
        alias: {
            'vue$': 'vue/dist/vue.js',
        }
    },
});
