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
            $dbReset = true;
            $seeds = true;
            $test = true;
            $name = 'App';
        } else {
            $dbReset = $this->confirm('Reset database migrations?', true);
            $seeds = $this->confirm('Remove example database seed?', true);
            $test = $this->confirm('Remove example test?', true);
            $name = $this->ask('Application namespace?', 'App');
        }

        if ($dbReset) {
            $this->info('Resetting database migrations...');
            $dbResetProcess = new Process('docker-compose run --rm fpm php artisan migrate:reset');
            $dbResetProcess->run();
        }

        if ($seeds) {
            $seedFilename = database_path('seeds/UsersTableSeeder.php');
            if ($this->deleteFile($seedFilename, 'Example seed')) {
                $this->info('Removing example database seed...');
            }

            $this->info('Altering DatabaseSeeder file...');
            $seederFilename = database_path('seeds/DatabaseSeeder.php');
            $this->removeLineContaining($seederFilename, 'UsersTableSeeder');
        }

        if ($test) {
            $routeFilename = base_path('tests/ExampleTest.php');
            if ($this->deleteFile($routeFilename, 'Example test')) {
                $this->info('Removing example test...');
            }
        }

        if ($name != 'App') {
            $this->info('Changing the application namespace');
            $this->call('app:name', ['name' => $name]);
        } else {
            $this->warn("Application namespace remaining $name");
        }

        $this->info('Reverting readme...');
        $system = new Filesystem();
        if ($this->deleteFile(base_path('README.md'))) {
            $system->move(base_path('README_DEFAULT.md'), base_path('README.md'));
        }

        $this->info('Removing Travis CI notifications...');
        $this->removeTravisNotification();

        $this->info('Removing example Rancher configuration...');
        $this->deleteDirectory(base_path('infrastructure/rancher'));

        $this->info('Removing this command...');
        $this->removeLineContaining(
            base_path('app/Console/Kernel.php'),
            'CleanTemplate'
        );
        $this->deleteFile(base_path('app/Console/Commands/CleanTemplate.php'));

        $this->warn("Review links in README.md and CONTRIBUTING.md to make sure they're relevant to this project");
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

    private function deleteDirectory($dirname, $type = null)
    {
        $system = new Filesystem();
        if ($system->exists($dirname)) {
            $system->deleteDirectory($dirname);
        } else {
            $this->warn("$type already deleted");
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
