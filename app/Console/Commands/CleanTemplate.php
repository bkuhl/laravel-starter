<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Process\Process;

class CleanTemplate extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'clean:template {--f|force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cleans the example files out of the project';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->option('force')) {
            $db_reset = true;
            $migrations = true;
            $seeds = true;
            $test = true;
            $name = 'App';
        } else {
            $db_reset = $this->confirm('Reset database migrations?', true);
            $migrations = $this->confirm(
                'Remove example database migration?',
                true
            );
            $seeds = $this->confirm('Remove example database seed?', true);
            $test = $this->confirm('Remove example test?', true);
            $name = $this->ask('Application namespace?', 'App');
        }

        if ($db_reset) {
            $this->info('Resetting database migrations...');
            $db_reset_process = new Process('docker-compose run --rm fpm php artisan migrate:reset');
            $db_reset_process->run();
        }

        if ($migrations) {
            $migration_filename = database_path('migrations/2014_10_12_000000_create_users_table.php');
            if ($this->deleteFile(
                $migration_filename,
                'Example user migration'
            )
            ) {
                $this->info('Removing example user database migration...');
            }
            $migration_filename = database_path('migrations/2014_10_12_100000_create_password_resets_table.php');
            if ($this->deleteFile(
                $migration_filename,
                'Example password reset migration'
            )
            ) {
                $this->info('Removing example password reset database migration...');
            }
        }

        if ($seeds) {
            $seed_filename = database_path('seeds/UsersTableSeeder.php');
            if ($this->deleteFile($seed_filename, 'Example seed')) {
                $this->info('Removing example database seed...');
            }

            $this->info('Altering DatabaseSeeder file...');
            $seeder_filename = database_path('seeds/DatabaseSeeder.php');
            $this->removeLineContaining($seeder_filename, 'UsersTableSeeder');
        }

        if ($test) {
            $route_filename = base_path('tests/ExampleTest.php');
            if ($this->deleteFile($route_filename, 'Example test')) {
                $this->info('Removing example test...');
            }
        }

        if ($name != 'App') {
            $this->info('Changing the application namespace');
            $this->call('app:name', ['name' => $name]);
        } else {
            $this->warn("Application namespace remaining 'App'");
        }

        $this->info('Reverting readme...');
        $system = new Filesystem();
        $filename = base_path('readme.md');
        if ($system->exists($filename)) {
            $system->put($filename, '');
        }

        $this->info('Removing Travis CI notifications...');
        $this->removeTravisNotification();

        $this->info('Removing this command...');
        $this->removeLineContaining(
            base_path('app/Console/kernel.php'),
            'CleanTemplate'
        );
        $this->deleteFile(base_path('app/Console/Commands/CleanTemplate.php'));
    }

    private function deleteFile($filename, $type = null)
    {
        $system = new Filesystem();
        if ($system->exists($filename)) {
            $system->delete($filename);
        } else {
            $this->warn("$type already deleted.");
            return false;
        }
        return true;
    }

    private function removeLineContaining($filename, $blacklist)
    {
        $system = new Filesystem();
        $rows = explode("\n", $system->get($filename));

        foreach ($rows as $key => $row) {
            if (preg_match("/($blacklist)/", $row)) {
                unset($rows[$key]);
            }
        }

        $system->put($filename, implode("\n", $rows));
    }

    private function removeTravisNotification()
    {
        $system = new Filesystem();
        $filename = base_path('.travis.yml');
        $blacklist = 'notifications';
        $rows = explode("\n", $system->get($filename));

        $section = false;
        foreach ($rows as $key => $row) {
            if ($section) {
                if (!empty($row) && preg_match('/\s/', $row[0])) {
                    unset($rows[$key]);
                } else {
                    $section = false;
                }
            } elseif (preg_match("/($blacklist)/", $row)) {
                $section = true;
                unset($rows[$key]);
            }
        }

        $system->put($filename, implode("\n", $rows));
    }
}