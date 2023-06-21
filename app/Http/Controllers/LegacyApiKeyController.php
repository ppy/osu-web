<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Exceptions\ModelNotSavedException;
use App\Transformers\LegacyApiKeyTransformer;
use Auth;
use Request;

class LegacyApiKeyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verify-user');
    }

    public function destroy()
    {
        Auth::user()->apiKeys()->available()->update(['revoked' => true]);

        return response(null, 204);
    }

    public function store()
    {
        priv_check('LegacyApiKeyStore')->ensureCan();

        $params = get_params(Request::all(), 'legacy_api_key', [
            'app_name',
            'app_url',
        ]);
        $apiKey = Auth::user()->apiKeys()->make([
            ...$params,
            'api_key' => bin2hex(random_bytes(20)),
        ]);

        try {
            $apiKey->saveOrExplode();
        } catch (ModelNotSavedException $e) {
            return ModelNotSavedException::makeResponse($e, ['legacy_api_key' => $apiKey]);
        }

        return json_item($apiKey, new LegacyApiKeyTransformer());
    }
}
