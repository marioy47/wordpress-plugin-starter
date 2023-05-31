/* eslint-disable no-console */

// Script to generate the .pot files for all translatable string found in PHP and JS files.
// Usage: node bin/wp-pot.js --domain the-language-domain --package The_Pot_Package_Name --src path1 --src path2 --src ...

const wpPot = require( 'wp-pot' );
const path = require( 'path' );
const fs = require( 'fs' );
const { pkgName, parseArgs } = require( './functions' );
const pkgJson = path.join( path.dirname( __dirname ), 'package.json' );
const { name } = require( pkgJson );

// Parse call arguments providing some default values.
const scriptArgs = parseArgs( process.argv.splice( 2 ), {
	domain: [ name ],
	package: [ pkgName( name ) ],
	src: [],
} );

const wpPotParams = {
	domain: scriptArgs.domain.pop(),
	package: pkgName( scriptArgs.package.pop() ),
	src: scriptArgs.src,
};

// Create languages directory if not exist
const rootPath = path.dirname( __dirname );
if ( ! fs.existsSync( path.resolve( rootPath, 'languages' ) ) ) {
	fs.mkdirSync( path.resolve( rootPath, 'languages' ) );
}

console.log( 'Generating POT file for', wpPotParams ); // eslint-disable-line no-console

// Actual pot generation.
wpPot( {
	domain: wpPotParams.domain,
	package: wpPotParams.package,
	destFile: path.resolve(
		rootPath,
		'languages',
		wpPotParams.domain + '.pot'
	),
	src: wpPotParams.src,
	relativeTo: rootPath,
} );
