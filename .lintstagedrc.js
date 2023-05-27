module.exports = {
	'*.scss': 'npm run format:css',
	'*.js': 'npm run format:js',
	'*.md': 'npm run format:md',
	'*.php': 'composer format',
	'*': "npm run cspell-params" // Only cspell on changed files.
};
