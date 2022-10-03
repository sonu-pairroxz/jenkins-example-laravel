<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CustomQuery extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'custom:query';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Custom query';

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
     * @return int
     */
    public function handle()
    {
        Log::debug('Deleting DB....');
        DB::statement('DROP DATABASE vklaravel;');
        Log::debug('DB Deleted....');

        //
        Log::debug('Creating new DB....');
        DB::statement('CREATE DATABASE vklaravel;');
        Log::debug('New DB Created....');
    }
}
