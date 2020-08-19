<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Middleware;

use Illuminate\Session\Middleware\StartSession as BaseStartSession;

class StartSession extends BaseStartSession
{
    protected function saveSession($request)
    {
        if ($this->shouldSaveSession()) {
            return parent::saveSession($request);
        }
    }

    protected function sessionIsPersistent(array $config = null)
    {
        return $this->shouldSaveSession() && parent::sessionIsPersistent($config);
    }

    private function shouldSaveSession()
    {
        return !request()->attributes->get('skip_session');
    }
}
