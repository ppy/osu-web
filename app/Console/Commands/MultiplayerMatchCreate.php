<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\Multiplayer;
use App\Models\User;

class MultiplayerMatchCreate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mp:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a random multiplayer lobby and returns a link to it.';

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
        if (config('app.debug') === false) {
            $this->error("This command can only be run in debug environments.");
        }

        $match = factory(Multiplayer\Match::class)->create();

        factory(Multiplayer\Event::class)->states('create')->create([
            'match_id' => $match->match_id,
            'user_id' => User::inRandomOrder()->first()->user_id,
        ]);

        $this->info(action('MatchesController@show', $match->match_id));
    }
}
