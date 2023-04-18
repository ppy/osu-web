<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Transformers\LegacyIrcKeyTransformer;
use Auth;
use Exception;

class LegacyIrcKeyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verify-user');
    }

    public function destroy()
    {
        Auth::user()->legacyIrcKey?->delete();

        return response(null, 204);
    }

    public function store()
    {
        $user = Auth::user();

        priv_check('LegacyIrcKeyStore')->ensureCan();

        $key = $user->legacyIrcKey;

        if ($key === null) {
            for ($i = 0; $i < 10; $i++) {
                try {
                    $key = $user->legacyIrcKey()->make([
                        'token' => bin2hex(random_bytes(4)),
                    ]);
                    $key->saveOrExplode();
                    break;
                } catch (Exception $e) {
                    if (!is_sql_unique_exception($e)) {
                        throw $e;
                    }
                }
            }
        }

        return json_item($key, new LegacyIrcKeyTransformer());
    }
}
