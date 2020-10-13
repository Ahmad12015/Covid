<?php

namespace App\Console\Commands;

use App\Models\patient;
use Illuminate\Console\Command;

class injuryDays extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'injured:day';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'increase one day to injured days of injured patient for every day';

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
        $patients= patient::where('status','injured')->orderByDesc('date_injury')->get();
        $patients->each(function ($patient){
            $patient->increment('injury_days',1);
        });

    }
}
