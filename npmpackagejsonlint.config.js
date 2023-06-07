// Add the list of allowed licenses.
const config = require( '@wordpress/npm-package-json-lint-config' );
config.rules[ 'valid-values-license' ][ 1 ].push( 'unlicensed', 'UNLICENSED' );
module.exports = config;
