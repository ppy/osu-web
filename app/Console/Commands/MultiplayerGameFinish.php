<?php

namespace App\Console\Commands;

use App\Models\Multiplayer\Game;
use Carbon\Carbon;
use Illuminate\Console\Command;

class MultiplayerGameFinish extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mp:game-finish {gameId}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Marks a multiplayer game (map, not lobby) as finished.';

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
            $this->error('This command can only be run in debug environments.');
        }

        $game = Game::find($this->argument('gameId'));

        if ($game === null) {
            $this->error('No game with this id found!');

            return;
        }

        if (!$game->end_time) {
            $game->end_time = Carbon::now();
            $game->save();
        }
    }
}
