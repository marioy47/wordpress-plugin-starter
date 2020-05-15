const path = require('path');

module.exports = {
	entry: {
		frontend: './src/js/frontend.js',
	},
	output: {
		filename: '[name].js',
		path: path.resolve(__dirname, 'js'),
	},
	devtool: process.env.NODE_ENV == 'production' ? false : 'eval-source-map',
	module: {
		rules: [
			{
				test: /\.js$/,
				exclude: /node_modules/,
				loader: 'babel-loader',
				options: {
					presets: ['@babel/preset-env', '@babel/preset-react'],
				},
			},
		],
	},
	mode: process.env.NODE_ENV == 'production' ? 'production' : 'development',
};
