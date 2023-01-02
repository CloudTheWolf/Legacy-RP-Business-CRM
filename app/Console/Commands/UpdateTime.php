<?php

namespace App\Console\Commands;

use App\Models\WorkTime;
use Illuminate\Console\Command;

class UpdateTime extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'staff:updatetime';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info("Start updating work time");
        $todo = WorkTime::whereTotalTime(0)->where("clockOutAt","!=",null)->get();
        foreach ($todo as $job)
        {
            $seconds = $job->clockOutAt->diffInSeconds($job->clockInAt);
            $this->info("User ".$job->cid." worked for ".$seconds." seconds");
            $job->totalTime = $seconds;
            $job->save();
        }

        return Command::SUCCESS;
    }
}
