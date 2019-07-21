<?php

namespace App\Console\Commands;

use App\Models\Multiplayer;
use App\Models\User;
use Illuminate\Console\Command;

class MultiplayerEventCreate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mp:event {matchId} {--type=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates an event in a given multiplayer lobby.';

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

        if (array_search_null($this->option('type'), ['create', 'disband', 'join', 'part', 'game']) === null) {
            $this->error('Invalid event type provided!');
            $this->info('Available event types: create, disband, join, part, game.');

            return;
        }

        $match = Multiplayer\Match::find($this->argument('matchId'));

        if ($match === null) {
            $this->error('No match with this id found!');

            return;
        }

        $event = factory(Multiplayer\Event::class)->states($this->option('type'))->make([
            'match_id' => $match->match_id,
            'user_id' => User::inRandomOrder()->first()->user_id,
        ]);

        if ($this->option('type') === 'game') {
            $game = factory(Multiplayer\Game::class)->states('in_progress')->create([
                'match_id' => $match->match_id,
            ]);

            $event->text = 'test game';
            $event->game_id = $game->game_id;
            $this->info("Game id: {$game->game_id}");
        }

        $event->save();

        $this->info("Event id: {$event->event_id}");
    }
}
