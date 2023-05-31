// Common functions used on other scripts.
// cSpell:ignore getopt
module.exports = {
	/**
	 * Converts a kebab-provided-string into a Capitalized_Snake_String.
	 * Used to convert the `@package`, in `.php` files, from the plugin name.
	 *
	 * @param {string} name - The string to convert
	 * @return {string} The capitalized string.
	 */
	pkgName( name ) {
		return name.split( '-' ).reduce( ( prev, curr ) => {
			return (
				prev.charAt( 0 ).toUpperCase() +
				prev.slice( 1 ) +
				'_' +
				curr.charAt( 0 ).toUpperCase() +
				curr.slice( 1 )
			);
		} );
	},

	/**
	 * A poor mans getopt.
	 * - Only works with `--` parameters
	 * - Elements without `--` will be assigned to a key called `_extra`
	 *
	 *  ## Example:
	 *
	 *  ```javascript
	 *  parseArgs(['--src', 'test', 'one', '--src', 'mine', 'two'])
	 *  // {'src':['test','min'], '_extra': ['one', 'two'] }
	 * ```
	 *
	 * @param {Array<string>}        argv     - The parameters to parse. Normally it would be `process.argv.splice(2)`.
	 * @param {Object<string|Array>} defaults - Default values if they are needed.
	 * @return {Object<string|string>} - The resulting parameters.
	 */
	parseArgs( argv, defaults = {} ) {
		let currentFlag = '_extra';
		argv.forEach( ( item ) => {
			if ( item.startsWith( '--' ) ) {
				currentFlag = item.slice( 2 );
				return;
			}

			if ( typeof defaults[ currentFlag ] === 'undefined' ) {
				defaults[ currentFlag ] = new Array();
			}
			defaults[ currentFlag ].push( item.trim() );
			currentFlag = '_extra';
		} );

		return defaults;
	},
};
