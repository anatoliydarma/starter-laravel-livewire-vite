<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class IseedAll extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'iseed:all {--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command plugin for iseed to seed all databases except migrations table';

    protected $exclusions = [
        'audits',
        'migrations',
        'jobs',
        'failed_jobs',
        'enquiries',
        'password_resets',
        'telescope_entries',
        'telescope_entries_tags',
        'telescope_monitoring',
    ];

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $dbName = env('DB_DATABASE');

        $query = \DB::select("SHOW TABLES WHERE Tables_in_${dbName} <> 'migrations'");
        $collection = new \Illuminate\Support\Collection($query);
        $tables = $collection->implode("Tables_in_${dbName}", ',');

        $tables_array = explode(',', $tables);
        $allowed_tables = array_merge(array_diff($tables_array, $this->exclusions));

        $this->info('Calling iseed for all tables except: '.implode(', ', $this->exclusions));

        $this->call('iseed', [
            'tables'  => implode(',', $allowed_tables),
            '--force' => $this->option('force'),
        ]);
    }
}
