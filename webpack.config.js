const webpackWpConfig = require( '@wordpress/scripts/config/webpack.config' );
const BrowserSyncPlugin = require( 'browser-sync-webpack-plugin' );
const FixStyleOnlyEntriesPlugin = require( 'webpack-fix-style-only-entries' );
const path = require( 'path' );

module.exports = {
	...webpackWpConfig,
	entry: {
		'js/scripts': './js/scripts.js',
		'css/styles': './scss/styles.scss',
	},
	output: {
		// Change the output folder from build to dist
		path: path.resolve( __dirname, 'dist' ),
		filename: '[name].js',
	},
	plugins: [
		...webpackWpConfig.plugins,

		// Remove the empty JS files that webpack creates after compiling SCSS files
		new FixStyleOnlyEntriesPlugin(),

		// Add browsersync for automatic browser reload
		new BrowserSyncPlugin( {
			host: 'localhost',
			port: 3000,
			proxy: process.env.PROXY_URL ?? 'https://wordpress-plugin-starter.lndo.site/',
		} ),
	],
};
