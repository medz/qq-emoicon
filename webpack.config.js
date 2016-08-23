let webpack = require('webpack');

module.exports = {
  // 插件
  plugins: [],

  // 页面入口文件配置
  entry: {
    'qq-emoicon': './index.js',
  },

  // 入口文件输出配置
  output: {
    path: 'dist',
    filename: '[name].js'
  },

  devtool: 'source-map',

  module: {
    // 加载器配置
    loaders: [
      {
        test: /\.css$/,
        loader: 'style-loader!css-loader?sourceMap',
      },
      {
        test: /\.(png|jpe?g)$/,
        loader: 'url-loader?limit=100000',
      },
      {
        test: /\.scss$/,
        loaders: 'style-loader!css-loader?sourceMap!sass-loader?sourceMap'
      },
    ]
  }

};
