# Wordpress Plugin Starter

A minimal file and minimal configuration for how I work when I create WordPress plugins

I created this starter since most of the plugin starters are not friendly with the usage of composer and autoload.

## Requirements & Tools

Right now the only requirement is having [composer](https://getcomposer.com) installed globally

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
2. Change the name of the function `wp_plugin_starter_autoloader` and the hook that calls it afterwards so there are no name collisions.

### Workflow

1. Start creating classes inside `includes` following the WordPress coding standards with your plugin logic
2. Issue `composer phpcs` in the root of the project regularly to check for errors and codesmells

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