const path = require('path');
const fs = require('fs');

module.exports = {
  entry: [path.resolve(__dirname, 'js') + '/image-sizes.jsx'],
  output: {
    path: path.resolve(__dirname,'js'),
    filename: 'image-sizes.es.js'
  },
  module: {
    rules: [
      {
        test: /\.jsx$/,
        exclude: /node_modules/,
        loader: 'babel-loader',
        options: {
          presets: [
            [
              "@babel/preset-env",
              {
                "useBuiltIns": "entry"
              }
            ]
          ],
        }
      }
    ]
  }
}
