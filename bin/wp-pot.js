/**
 * Generates the .pot files for all translatable string found in PHP and JS files.
 *
 * Usage: node bin/wp-pot.js --domain the-language-domain --package The_Pot_Package_Name --src path1 --src path2 --src ...
 */
const wpPot = require( 'wp-pot' );
const path = require( 'path' );
const fs = require( 'fs' );

// Parse plugin call parameters.
const params = {
	domain: 'wordpress-plugin-starter',
	package: 'WordPress_Plugin_Starter',
	src: [],
};
let currentFlag = '';
process.argv.splice( 2 ).forEach( ( item ) => {
	if ( item.startsWith( '--' ) ) {
		currentFlag = item;
		return;
	}
	switch ( currentFlag ) {
		case '--domain':
			params.domain = item.trim();
			break;
		case '--package':
			params.package = item.trim();
			break;
		case '--src':
			params.src.push( item.trim() );
			break;
	}
} );

// Create languages directory if not exist
const rootPath = path.dirname( __dirname );
if ( ! fs.existsSync( path.resolve( rootPath, 'languages' ) ) ) {
	fs.mkdirSync( path.resolve( rootPath, 'languages' ) );
}

console.log( 'Generating POT file for', params ); // eslint-disable-line no-console

// Actual pot generation.
wpPot( {
	domain: params.domain,
	package: params.package,
	destFile: path.resolve( rootPath, 'languages', params.domain + '.pot' ),
	src: params.src,
	relativeTo: rootPath,
} );
