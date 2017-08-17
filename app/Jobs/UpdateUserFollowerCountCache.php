<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\UserRelation;
use Cache;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateUserFollowerCountCache implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;
    protected $user_id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user_id)
    {
        $this->user_id = $user_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $count = UserRelation::where('zebra_id', $this->user_id)->where('friend', 1)->count();
        Cache::put(User::CACHE_KEYS['follower_count'].":{$this->user_id}", $count, Carbon::now()->addDay(1));
    }
}
