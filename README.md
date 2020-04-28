# Wordpress Plugin Starter

A minimal file and minimal configuration WordPress plugin focused on a productive workflow.

The main advantages (and reasons) for using this starter are:

- 100% PHPCS friendly
- Uses Gulp for task automation
- Users WebPack+Babel for compiling JS scripts
- You can use JSX (and React for that matter) for Javascript development
- Uses composer for code sniffing and autoloading classes
- Minimal dependencies, just `composer` and `node`
- You can add composer packages without any additional configuration
- If you use VSCode you'll be prompted to install recommended extensions

## Requirements & Tools

There are only 2 dependencies that most WordPress developers should already have:

- [composer](https://getcomposer.com)
- [node](https://nodejs.org/) (If you want to compile Js and Sass)

The recommended editor is [Visual Studio Code](https://code.visualstudio.com) with the following extensions installed:

- [EditorConfig for VS Code](https://marketplace.visualstudio.com/items?itemName=EditorConfig.EditorConfig)
- [PHP Sniffer](https://marketplace.visualstudio.com/items?itemName=wongjn.php-sniffer)
- [Prettier](https://marketplace.visualstudio.com/items?itemName=esbenp.prettier-vscode) If you are creating CSS or JS files.
- [PHP DocBlocker](https://marketplace.visualstudio.com/items?itemName=neilbrayfield.php-docblocker)

**Note**: You'll get prompted to auto-install this extensions on new projects.

## Preparation before developing

Just clone the repo and install composer and npm packages

```bash
git clone git@github.com:marioy47/wordpress-plugin-starter.git my-new-plugin
cd my-new-plugin
npm install
composer install
# Setup you plugin
npm start
```

## Plugin setup

After you've installed the required packages and dependencias (previous step) you have to take a series of steps to have a valid plugin:

### In `wordpress-plugin-starter.php` do

1. Update the comments in this file so WordPress registers the plugin correctly.
2. Select a **text domain** and change it in the comments
3. Select a **Namespace** for you plugin and change it the file
4. Change **the name** of the definition `WORDPRESS_PLUGIN_STARTER_VERSION` (You should use that definition when enqueuing scripts and styles)
5. **Rename the file and the dir** to something that reflects your plugin name. Maybe the name of the plugin but _"hypenized"_

### In `phpcs.xml.dist`

1. Change the `text-domain` parameter so it matches the selected name in the previous step.
2. Change the _path_ for `wordpress-plugin-starter.php` so it matches the name selected in the previous step.

### In `gulpfile.js`

_Only if you are going to compile SCSS/JS files or use the `compress` or `zip` tasks_

Change the values for the variables `pluginPackage`, `pluginSlug` and `pluginTextdomain` at the top of the file so they matches the values of your project.

## Workflow

**Every time you add a new class in `includes/` you have to execute `composer dump-autoload`**

The idea behind this project is to have an efficient workflow.

1. Create a class (or classes) in `includes` following the WordPress coding standards with your plugin logic
2. Issue `composer dump-autoload` so the new classes get recognized
3. Instantiate this class (or use the _singleton_ parterns) in the start file (by default `wordpres-plugin-starter.php`) **without** requiring the file since the autoloader will take care if the inclussion.
4. Issue `composer phpcs` in the root of the project regularly to check for errors and code-smells

## Composer Commands

This project uses composer mainly for _Code Sniffing_ and _Beautifying_

In the terminal you can issue the following commands to check you're code styling:

- `composer phpcs` : To detect styling errors.
- `composer phpbf` : Fixes styling errors.
- `composer php-i` : To verify the installed standards (no space between `phpcs` and the -i).

## Coding Standards

This plugin is configured to be kind of rigorous when checking the code standards. That's why is recommended that you read [https://make.wordpress.org/core/handbook/coding-standards/](https://make.wordpress.org/core/handbook/coding-standards/)

## NPM commands

- `npm start` to watch for changes in `src/js/` and `src/sass/` and compile
- `npm run build`
  - Compiles and optimizes the files in `src/js/` and saves them in `js/`
  - Compiles and optimizes the files in `src/scss/` and saves them in `css/`
  - Parses the `.php` files looking for translatable strings and save the in `languages/` as a `.pot`.
  - Executes `composer dump-autoload` in optimized mode and without development dependencies
- `npm run compress` Builds (previous step) but also creates a `.zip` file for the plugin that can be used in a WordPress installation
- `npm run clean` Removes compiled files and reinstalls the _development_ packages of composer (phpcs mainly)
- `npm run pot` Extracts translatable strings from the php files and save the `.pot` file in `languages/`
