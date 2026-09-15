<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Libraries\Search\UserSearch;
use App\Libraries\Search\UserSearchParams;
use App\Libraries\Search\WikiSuggestions;
use App\Libraries\Search\WikiSuggestionsRequestParams;
use App\Transformers\WikiSuggestionsHitTransformer;

class SuggestionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['wiki']]);
    }

    public function user()
    {
        $queryString = presence(mb_trim(get_string(request('query')) ?? ''));
        if ($queryString === null) {
            return [];
        }

        $params = new UserSearchParams();
        $params->queryString = $queryString;
        $params->size = 10;
        $search = new UserSearch($params);

        return array_map(fn ($user) => [
            'avatar_url' => $user->user_avatar,
            'id' => $user->getKey(),
            'username' => $user->username,
        ], $search->response()->records()->get()->all());
    }

    public function wiki()
    {
        $search = new WikiSuggestions(new WikiSuggestionsRequestParams(\Request::all()));

        if (is_api_request()) {
            $search->useMarkdownHighlightTags();
        }

        return json_collection([...$search->response()], new WikiSuggestionsHitTransformer());
    }
}
