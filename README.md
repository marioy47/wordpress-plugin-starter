# Wordpress Plugin Starter

A minimal file and minimal configuration plugin to work as an starter for how I work when I create WordPress plugins

The main advantages (and reasons) for using this starter are:

- 100% PHPCS friendly
- Uses Gulp for task automation
- Users WebPack+Babel for compiling JS scripts
- Uses composer for code sniffing
- You can add composer packages without any additional configuration
- If you use VSCode you'll be prompted to install recommended packages


## Requirements & Tools

To start working with this starter you don't need anything outside for a worpress installation...

If you want to use Composer Packages, you'll need to get [composer](https://getcomposer.com) and install it globally

If you want to compile Js and Sass files you'll need to install [node](https://nodejs.org/)

The recommended editor is [Visual Studio Code](https://code.visualstudio.com) with the following extensions installed:

- [EditorConfig for VS Code](https://marketplace.visualstudio.com/items?itemName=EditorConfig.EditorConfig)
- [PHP Sniffer](https://marketplace.visualstudio.com/items?itemName=wongjn.php-sniffer)
- [Prettier](https://marketplace.visualstudio.com/items?itemName=esbenp.prettier-vscode) If you are creating CSS or JS files.
- [PHP DocBlocker](https://marketplace.visualstudio.com/items?itemName=neilbrayfield.php-docblocker)

**Note**: You'll get prompted to auto-install this extensions on new projects.

## Start developing

### In `wordpress-plugin-starter.php` do

1. Update the initial comments the file so WordPress registers the plugin correctly.
2. Select a **Namespace** for you plugin and change it in the file
3. Change **the name** of the definition `WORDPRESS_PLUGIN_STARTER_VERSION` (You should use that definition when enqueuing  scripts and styles)
4. Rename the file to something that reflects your plugin name. Maybe the name of the plugin but _"hypenized"_

### In `includes/autoload.php`

1. Change the name of the Namespace **inside** the function `wp_plugin_starter_autoloader` to match the name selected in the previous step
2. Change the name of the **function** `wp_plugin_starter_autoloader` so there are no name collisions.
2. Change action of the **hook** `wp_plugin_starter_autoloader` so it matches the name of the function you used in the previous step.

### In `gulpfile.js`

Change the values for the variables `pluginPackage`, `pluginSlug` and  `pluginTextdomain` at the top of the file so they matches the values of your project.


### Workflow

1. Start creating classes inside `includes` following the WordPress coding standards with your plugin logic
2. Issue `composer phpcs` in the root of the project regularly to check for errors and code-smells

## Composer Commands

This project uses composer mainly for _Code Sniffing_ and _Beautifying_

In the terminal you can issue the following commands to check you're code styling:

- `composer phpcs` : To detect styling errors.
- `composer phpbf` : Fixes styling errors.
- `composer php-i` : To verify the installed standards (no space between `phpcs` and the -i).
- `composer phpcs-wp` : Executes `phpcs` but only with WordPress rules (no variable verifications).
- `composer phpcbf-wp` : Executes `phpcbf` but only with WordPress rules (no variable verifications).

## Coding Standards

This plugin is configured to be kind of rigorous when checking the code standards. That's why is recommended that you read [https://make.wordpress.org/core/handbook/coding-standards/](https://make.wordpress.org/core/handbook/coding-standards/)

## NPM commands

- `npm start` to watch for changes in `src/js/` and `src/sass/` and compile
- `npm run build` Compiles and optimizes `js` and `scss` files and saves them in `js/` and `css` respectively. Also creates the `.pot` file for plugin translation and saves it `languages/`.
- `npm run compress` Builds (previous step) but also creates a `.zip` file for the plugin that can be used in a WordPress installation
- `npm run clean` Removes compiled files
- `npm run pot` Extracts translatable strings from the php files and save the `.pot` file in `languages/`
