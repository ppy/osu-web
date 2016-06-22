<?php
/**
 *    Copyright 2015 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */
namespace App\Http\Controllers;

use App\Models\Team;
use App\Transformers\TeamTransformer;
use App\Models\TeamMembers;
use App\Models\User;
use App\Models\TeamProfileCustomization;
use Auth;
use Request;

class TeamsController extends Controller
{
    protected $section = 'community';

    public function __construct()
    {
        $this->middleware('auth');
        parent::__construct();
    }

    public function index()
    {
        return view('teams.index');
    }

    public function show($id)
    {
        $team = Team::lookup($id);
        if ($team === null) {
            abort(404);
        }
        $teamArray = fractal_item_array(
            $team,
            new TeamTransformer($team),
            'admins,members'
        );

        return view('teams.show', compact('team', 'teamArray'));
    }

    public function get($id)
    {
        $team = Team::lookup($id);
        if ($team === null) {
            abort(404);
        }
        $teamArray = fractal_item_array(
            $team,
            new TeamTransformer($team),
            Request::input('includes')
        );
        return $teamArray;
    }
    public function addMember($id)
    {
        $team = Team::lookup($id);
        $admin = Auth::user();
        $user = User::lookup(Request::input('user'));
        if ($team === null || $user === null) {
            abort(404);
        }


        if ($team->teamMembers()->wherePivot('is_admin', 1)->get()->contains($admin)) { 
            // we are allowed to add users.
            if ($team->teamMembers()->get()->contains($user)) {
                // the user already exists, but we are updating admin rights.
                $team->teamMembers()->updateExistingPivot($user->user_id, ['is_admin' => Request::input('admin', 0)]);
            } else {
                // the user doesn't exist so we are adding it.
                $team->teamMembers()->attach($user->user_id, ['is_admin' => Request::input('admin', 0)]);
            }
        }

        return $team->teamMembers()->get()->all();
    }
    public function updateProfile($id)
    {
        $team = Team::lookup($id);
        if ($team === null) {
            abort(404);
        }
        if (Request::hasFile('cover_file') || Request::has('cover_id')) {
            try {
                $team
                    ->profileCustomization()
                    ->firstOrCreate([])
                    ->setCover(Request::input('cover_id'), Request::file('cover_file'));
            } catch (ImageProcessorException $e) {
                return error_popup($e->getMessage());
            }
        }

        if (Request::has('order')) {
            $order = Request::input('order');

            $error = 'errors.account.profile-order.generic';

            // Checking whether the input has the same amount of elements
            // as the master sections array.
            if (count($order) !== count(TeamProfileCustomization::$sections)) {
                return error_popup(trans($error));
            }

            // Checking if any section that was sent in input
            // also appears in the master sections arrray.
            foreach ($order as $i) {
                if (!in_array($i, TeamProfileCustomization::$sections, true)) {
                    return error_popup(trans($error));
                }
            }

            // Checking whether the elements sent in input do not repeat.
            $occurences = array_count_values($order);

            foreach ($occurences as $i) {
                if ($i > 1) {
                    return error_popup(trans($error));
                }
            }

            $team
                ->profileCustomization()
                ->firstOrCreate([])
                ->setExtrasOrder($order);
        }

        return fractal_item_array(
            $team,
            new TeamTransformer()
        );
    }
}
