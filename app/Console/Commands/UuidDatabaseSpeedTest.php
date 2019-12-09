<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Str;
use App\UuidSpeedTest;

class UuidDatabaseSpeedTest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'uuid:database-speed-test {--count=20000 : number of rows to create}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run speed test with different types of UUIDs as primary keys';

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
        $v4_uuids = [];
        $timestamp_uuids = [];

        $count = (int) $this->option('count');

        $this->info('generating uuids...');
        $bar = $this->output->createProgressBar($count);
        for($i = 0; $i < $count; $i++)
        {
            $v4_uuids[] = Uuid::uuid4();
            $timestamp_uuids[] = Str::orderedUuid();
            $bar->advance();
        }
        $bar->finish();

        $this->info("\nInserting {$count} uuid4 rows");
        UuidSpeedTest::truncate();
        $start = microtime(true);
        $bar = $this->output->createProgressBar($count);
        foreach ($v4_uuids as $uuid)
        {
            $row = new UuidSpeedTest();
            $row->id = $uuid;
            $row->save();
            $bar->advance();
        }
        $bar->finish();
        $duration = microtime(true) - $start;
        $this->info("\nUUIDv4 Duration: {$duration}s");


        $this->info("\nInserting {$count} timestamp_uuids rows");
        UuidSpeedTest::truncate();
        $start = microtime(true);
        $bar = $this->output->createProgressBar($count);
        foreach ($timestamp_uuids as $uuid)
        {
            $row = new UuidSpeedTest();
            $row->id = $uuid;
            $row->save();
            $bar->advance();
        }
        $bar->finish();
        $duration = microtime(true) - $start;
        $this->info("\nTimestamp-first UUIDs Duration: {$duration}s");
    }
}
