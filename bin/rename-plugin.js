/* eslint-disable no-console */
const replace = require( 'replace-in-file' );
const fs = require( 'fs' ).promises;
const path = require( 'path' );
const { pkgName, parseArgs } = require( './functions' );
const { name } = require( path.join(
	path.dirname( __dirname ),
	'package.json'
) );

const scriptArgs = parseArgs( process.argv.splice( 2 ), { name: [ name ] } );
const newName = scriptArgs.name.pop();

// If we made the change, update files that referenced that name.
const renameOptions = {
	files: [
		'*.php',
		'.lando.yml',
		'bin/wp-pot.js',
		'docker-compose.yaml',
		'php/**/*.php',
	],
	from: [ /wordpress-plugin-starter/g, /Wordpress_Plugin_Starter/g ],
	to: [ newName, pkgName( newName ) ],
};

replace( renameOptions )
	.then( ( affectedFiles ) => {
		affectedFiles.forEach( ( file ) => {
			if ( file.hasChanged ) {
				console.log( 'Changed ', file.file );
			} else {
				console.warn( 'No changes in ', file.file );
			}
		} );
	} )
	.then( () => {
		const orig = path.join(
			path.dirname( __dirname ),
			'wordpress-plugin-starter.php'
		);
		const dest = path.join( path.dirname( __dirname ), newName + '.php' );
		fs.rename( orig, dest );
	} )
	.catch( ( error ) =>
		console.error( 'There was an error making the replacement', error )
	);
