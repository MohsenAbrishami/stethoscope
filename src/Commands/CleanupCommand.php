<?php

namespace MohsenAbrishami\Stethoscope\Commands;
use MohsenAbrishami\Stethoscope\LogRecord\Facades\Record;

use Illuminate\Console\Command;

class CleanupCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stethoscope:clean';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete all resource logs older than specified number of days in config.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Record::clean();
    }
}
