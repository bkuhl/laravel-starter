<?php
/**
 * This script enables us to reset the state of the staging environment
 *
 * It can be used to create a service in seeded environments that runs
 * this script within the CLI container.
 */

// dev dependencies allow us to utilize faker and similar
// packages within our seeders
echo "Installing composer development dependencies...".PHP_EOL;
shell_exec('composer install --prefer-dist --dev');

echo "Resetting the database...".PHP_EOL;
shell_exec('php artisan migrate:refresh --seed');