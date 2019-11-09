<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

namespace App\Http\Controllers;

use App\Models\Wiki;

class LegalController extends Controller
{
    protected $section = 'home';
    protected $actionPrefix = 'legal-';

    public function show($page)
    {
        switch ($page) {
            case 'copyright':
                $path = 'Legal/Copyright';
                break;
            case 'privacy':
                $path = 'Legal/Privacy';
                break;
            case 'terms':
                $path = 'Legal/Terms';
                break;
            default:
                abort(404);
        }

        return view('wiki.show', [
            'page' => new Wiki\Page($path, $this->locale()),
        ]);
    }
}
