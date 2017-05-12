<?php

namespace App\Console\Commands;

use App\Models\Build;
use App\Models\BuildPropagationHistory;
use Illuminate\Console\Command;

class BuildsUpdatePropagationHistory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'builds:update-propagation-history';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates the build propagation history based on current data.';

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
        foreach(config('osu.changelog.tracked_streams') as $stream_id) {
            $count = Build::propagationHistory()
                ->where('stream_id', $stream_id)
                ->sum('users');

            BuildPropagationHistory::create([
                'stream_id' => $stream_id,
                'user_count' => get_int($count),
            ]);
        }
    }
}
