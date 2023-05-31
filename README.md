<!-- cSpell:ignore autoload hypenized degit autoloading autoloader autoload -->
<!-- markdownlint-disable MD030 -->

# WordPress Plugin Starter

A minimal file and minimal configuration WordPress plugin focused on a productive workflow.

The main advantages (and reasons) for using this starter are:

-   Uses [wp-scripts](https://www.npmjs.com/package/@wordpress/scripts) for linting and building JavaScript and SCSS
-   Uses [strauss](https://github.com/BrianHenryIE/strauss) for composer package inclusion and autoloading
-   Enforces WordPress coding standards
-   Uses husky, lint-staged and commitlint to prevent bad commits in your repo
-   You can use JSX (and React for that matter) for Javascript development
-   Minimal dependencies on your system, just `composer` and `npm` and optionally `lando` and/or `docker`
-   If you use VSCode you'll be prompted to install recommended extensions

## Requirements & Tools

There are only 2 dependencies that most WordPress developers should already have:

-   [composer](https://getcomposer.com)
-   [npm](https://nodejs.org/) (If you want to compile Js and Sass)

The recommended editor is [Visual Studio Code](https://code.visualstudio.com).

**Note**: You'll get prompted to auto-install the recommended extensions on new projects.

## Preparation before developing

You can use [degit](https://github.com/Rich-Harris/degit) to create a new project from scratch:

```bash
cd /path/to/wordpress/wp-content/plugins
npx degit marioy47/wordpress-plugin-starter my-new-plugin
cd my-new-plugin
npm install
```

You can go a step further and change the default the name of the plugin by

- Editing the `name` in `package.json`
- And then running the rename function with `npm run rename`

```bash
# Optional (You have to edit the name in package.json file first)
npm run rename
```

**Note**: You have to do the rename **before** executing `lando` or `docker-compose`

Finally, you can start a full fledged development environment with Lando **or** Docker:

```bash
# Select one of this 2
lando start
# Or
docker-compose up
```

## Coding Standards

This plugin is configured to be kind of rigorous when checking the code standards. That's why is recommended that you read [https://make.wordpress.org/core/handbook/coding-standards/](https://make.wordpress.org/core/handbook/coding-standards/)

## Npm and Composer commands

There are multiple helper `scripts` in [`package.json`](package.json) and [`composer`](composer.json) that you should take a look before starting the development
