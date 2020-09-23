<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\News;
use Log;
// use DateTime;

class ClearOldNewsCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clearoldnews:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This will clear all news entries older than 14 days';

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
        // Alternative Method
        // $date = new DateTime;
        // $date->modify('-14 Days');
        // $formatted = $date->format('Y-m-d H:i:s');
        
        $date_formatted =  now()->subDays(14)->getTimestamp();
        News::where('created_at', '<=', $date_formatted)->delete();
        Log::info("Removed News Entries Older then 14 Days - ".$date_formatted);
      
        $this->info('clearoldnews:cron Command Run successfully!');
    }
}
