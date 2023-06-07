<!-- cSpell:ignore autoload hypenized degit autoloading autoloader autoload -->
<!-- markdownlint-disable MD030 -->

# WordPress Plugin Starter

A minimal file and minimal configuration WordPress plugin focused on a productive development workflow.

The main advantages (and reasons) for using this starter are:

-   Uses [wp-scripts](https://www.npmjs.com/package/@wordpress/scripts) for linting and building JavaScript, Sass and Markdown.
-   Uses [strauss](https://github.com/BrianHenryIE/strauss) for composer package inclusion and auto-loading Enforces WordPress coding standards
-   Uses `husky`, `lint-staged` and `commitlint` to prevent bad commits in your repo
-   You can use `.jsx` (and React for that matter) for JavaScript development
-   Minimal dependencies on your system, just `composer` and `npm` and optionally `lando` and/or `docker`
-   If you use [Visual Studio Code](https://code.visualstudio.com) you'll be prompted to install recommended extensions

## Requirements & Tools

There are only 2 dependencies that most WordPress developers should already have:

-   [composer](https://getcomposer.com)
-   [npm](https://nodejs.org/) (If you want to compile Js and Sass)

The recommended editor is [Visual Studio Code](https://code.visualstudio.com).

**Note**: You'll get prompted to auto-install the recommended extensions on new projects.

## Setup

You can use [degit](https://github.com/Rich-Harris/degit) to create a new project from scratch:

```bash
cd /path/to/wordpress/wp-content/plugins
npx degit marioy47/wordpress-plugin-starter my-new-plugin
cd my-new-plugin
code package.json # (recommended) Change the name of the plugin
npm install
lando start # or `docker-compose up -d`
npm start
```

> **Note**: The `postinstall` script in [`package.json`](package.json) will do the following:
>
> -   Install `composer` packages for you
> -   Setup `husky` for linting commits
> -   Execute the `bin/rename-plugin.js` script

## Coding Standards

This plugin is configured to be rigorous when checking the code standards. That's why is recommended that you read [https://make.wordpress.org/core/handbook/coding-standards/](https://make.wordpress.org/core/handbook/coding-standards/) beforehand.

## Npm and Composer commands

There are multiple helper `scripts` in [`package.json`](package.json) and [`composer`](composer.json) but the more important ones are:

-   `npm run build` To build the JS and Scss files to the final format
-   `npm start` To start a "watch" command that will compile any changed JS and SCSS files

## Common issues

### Issues with PHPCS and PHPCBF

If you are using a version of PHP newer than 8.1 you might get errors in the form:

<!-- cSpell:disable -->
```text
FILE: /Users/mario/Projects/wordpress-plugin-starter/php/class-my-test-class.php
--------------------------------------------------------------------------------------------------------------------------------------------------------------
FOUND 1 ERROR AFFECTING 1 LINE
--------------------------------------------------------------------------------------------------------------------------------------------------------------
 1 | ERROR | An error occurred during processing; checking has been aborted. The error message was: trim(): Passing null to parameter #1 ($string) of type
   |       | string is deprecated in
   |       | /Users/mario/Projects/wordpress-plugin-starter/vendor/wp-coding-standards/wpcs/WordPress/Sniffs/NamingConventions/PrefixAllGlobalsSniff.php on
   |       | line 280 (Internal.Exception)
--------------------------------------------------------------------------------------------------------------------------------------------------------------
```

The solution would be to downgrade PHP to 8.0 (recommended) or 7.4. This is how to do it using `brew`

```bash
brew tap shivammathur/php
brew install shivammathur/php/php@8.0
brew link --overwrite --force shivammathur/php/php@8.0
php --version # Should be 8.0.X
```
<!-- cSpell:enable -->
