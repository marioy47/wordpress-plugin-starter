#!/bin/bash

# Provision script for WordPress installation when using Lando.
# This script is called from the .lando.yml file

# cSpell:ignore akismet appserver creds dbhost dbname dbpass dbuser getenv lando_webroot

# LANDO_INFO is a Json string with all the parameters.
DBNAME=$(php -r "echo json_decode(getenv('LANDO_INFO'), true)['database']['creds']['database'];")
DBUSER=$(php -r "echo json_decode(getenv('LANDO_INFO'), true)['database']['creds']['user'];")
DBPASS=$(php -r "echo json_decode(getenv('LANDO_INFO'), true)['database']['creds']['password'];")
APP_URL=$(php -r "echo json_decode(getenv('LANDO_INFO'), true)['appserver_nginx']['urls'][1];")

# Download and install WordPress.
wp --path="${LANDO_WEBROOT}" core download
wp --path="${LANDO_WEBROOT}" config create --dbhost=database --dbname="${DBNAME}" --dbuser="${DBUSER}" --dbpass="${DBPASS}" --extra-php="
define( 'WP_DEBUG', true );
define( 'SCRIPT_DEBUG', true );
define( 'WP_DEBUG_LOG', true );
define( 'WP_REDIS_HOST', 'redis' );
define( 'DISALLOW_FILE_EDIT', true );
"
wp --path="${LANDO_WEBROOT}" core install --title="DEV" --url="${APP_URL}" --admin_user=admin --admin_password=password --admin_email=admin@example.com

# delete the default plugins
wp --path="${LANDO_WEBROOT}" plugin delete akismet hello

# Install additional plugins
wp --path="${LANDO_WEBROOT}" plugin install "redis-cache" --activate
wp --path="${LANDO_WEBROOT}" plugin install "debug-bar" --activate
wp --path="${LANDO_WEBROOT}" plugin install "query-monitor" --activate
wp --path="${LANDO_WEBROOT}" plugin install "simply-show-hooks" --activate
wp --path="${LANDO_WEBROOT}" plugin install "user-switching" --activate

# The adds redis to the must-use plugins
wp --path="${LANDO_WEBROOT}" redis enable

# Fix permalinks
wp --path="${LANDO_WEBROOT}" option update permalink_structure "/%year%/%monthnum%/%postname%/"
