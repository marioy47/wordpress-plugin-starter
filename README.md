# wordpress-plugin-starter

A minimal file and minimal configuration for how I work when I create WordPress plugins

I created this starter since most of the plugin starters are not friendly with the usage of composer and autoload.

## Start developing

Just issue `composer install` and add your classes to the `app/` directory.

If you are using Visual Studio Code install _PHP Snffer_ by **wongjn** with `code --install-extension wongjn.php-sniffer`

## Composer Commands

The default composer command offers the following scripts:

- `composer phpcs` : To detect styling errors.
- `composer phpbf` : Fixes styling errors.
- `composer php-i` : To verify the installed standards (no space between phpcs and the -i).
- `composer phpcs-wp` : Executes `phpcs` but only with WordPress rules (no variable verifications).
- `composer phpcbf-wp` : Executes `phpcbf` but only with WordPress rules (no variable verifications).
