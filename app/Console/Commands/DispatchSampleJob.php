<?php

namespace App\Console\Commands;

use App\Jobs\SampleJob;
use Illuminate\Console\Command;

class DispatchSampleJob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:dispatch-sample-job';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Dispatches sample jobs to the queue';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        for ($i=0; $i < 10; $i++) {
            SampleJob::dispatch("sample data {$i}");
        }
    }
}
