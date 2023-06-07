module.exports = {
	version: '0.2',
	language: 'en',
	ignorePaths: [
		'.git/',
		'.gitignore',
		'.vscode/**', // Otherwise VSCode package names will give errors.
		'bin/strauss.phar',
		'composer.json', // Otherwise we need to add all of GitHub handles in 'words'.
		'dist/',
		'languages/',
		'node_modules/**',
		'vendor-prefixed/**',
		'vendor/**',
		'wp-www',
	],
	words: [
		'akismet',
		'commitlint',
		'huskyrc',
		'lando',
		'mailhog',
		'mario',
		'marioy',
		'monthnum',
		'phar',
		'phpcbf',
		'phpcs',
		'phpmyadmin',
		'postname',
		'xdebug',
		'yepes',
	],
};
