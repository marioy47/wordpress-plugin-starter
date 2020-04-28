'use strict';

const bsync = require('browser-sync').create();
const composer = require('gulp-composer');
const del = require('del');
const gulp = require('gulp');
const sass = require('gulp-sass');
const webpack = require('webpack-stream');
const wpPot = require('gulp-wp-pot');
const zip = require('gulp-zip');

// Change this variables values.
const pluginPackage = 'Wordpres_Plugin_Starter';
const pluginSlug = 'wordpress-plugin-starter';
const pluginTextdomain = 'wordpress-plugin-starter';

// Use node-sass for better performance.
sass.compiler = require('node-sass');

/**
 * Compiles and bundles JavaScript using WebPack.
 */
function scripts() {
	const webpackConfig = require('./webpack.config.js');
	return gulp.src('.').pipe(webpack(webpackConfig)).pipe(gulp.dest('js/')).pipe(bsync.stream());
}

/**
 * Creates css files from sass source.
 */
function styles() {
	const prod = process.env.NODE_ENV == 'production' ? true : false;
	return gulp
		.src(['src/sass/*.scss'], { sourcemaps: !prod })
		.pipe(
			sass({
				outputStyle: prod ? 'compressed' : 'compact',
			}).on('error', sass.logError)
		)
		.pipe(gulp.dest('./css', { sourcemaps: !prod }))
		.pipe(bsync.stream());
}

/**
 * Creates a zip file of the plugin.
 */
function compress() {
	return gulp
		.src(['includes/**', 'js/**', 'css/**', 'languages/*', 'vendor/**', pluginSlug + '.php'], {
			base: '../',
		})
		.pipe(zip(pluginSlug + '.zip'))
		.pipe(gulp.dest('./'));
}

/**
 * Executes composer on prod or dev dpending on the NODE_ENV status.
 */
function composerExe() {
	if (process.env.NODE_ENV == 'production') {
		composer('install --no-dev', { async: false });
		return composer('dump-autoload -o', { async: false });
	} else {
		composer('install', { async: false });
		return composer('dump-autoload', { async: false });
	}
}

/**
 * Removes compiled files and any cache that exits.
 */
function clean() {
	return del(['js/', 'css/', '*.zip']);
}

/**
 * Extract translatable strings from php files and save the .pot file in languages/
 */
function potCreate() {
	return gulp
		.src([pluginSlug + '.php', 'includes/*.php'])
		.pipe(
			wpPot({
				domain: pluginTextdomain,
				package: pluginPackage,
			})
		)
		.pipe(gulp.dest('languages/' + pluginTextdomain + '.pot'));
}

/**
 * Whatch for changes int .scss and .js files and compile them.
 */
function watch() {
	bsync.init({
		proxy: process.env.DEV_HOST || 'https://wp.devenv/',
	});
	gulp.watch(['src/sass/*.scss'], styles);
	gulp.watch(['src/js/*.js'], scripts);
}

/**
 * Exportes tasks.
 */
exports.build = gulp.series(clean, composerExe, scripts, styles, potCreate);
exports.clean = gulp.parallel(clean, composerExe);
exports.composer = composerExe;
exports.compress = gulp.series(clean, composerExe, scripts, styles, potCreate, compress);
exports.pot = gulp.series(potCreate);
exports.scripts = scripts;
exports.styles = styles;
exports.watch = watch;
exports.zip = compress;
