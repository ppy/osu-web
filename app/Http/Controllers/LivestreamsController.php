<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

namespace App\Http\Controllers;

use App\Models\LivestreamCollection;
use Request;

class LivestreamsController extends Controller
{
    protected $section = 'community';

    public function index()
    {
        view()->share('currentAction', 'getLive');

        $livestream = new LivestreamCollection();
        $streams = $livestream->all();
        $featuredStream = $livestream->featured();

        return view('livestreams.index', compact('streams', 'featuredStream'));
    }

    public function promote()
    {
        priv_check('LivestreamPromote')->ensureCan();

        LivestreamCollection::promote(Request::input('id'));

        return js_view('layout.ujs-reload');
    }
}
