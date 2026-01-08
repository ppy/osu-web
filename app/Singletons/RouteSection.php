<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Singletons;

use Illuminate\Http\Request as HttpRequest;

class RouteSection
{
    const SECTIONS = [
        '_' => 'community',
        'admin' => [
            '_' => 'admin',
        ],
        'admin_forum' => [
            '_' => 'admin',
        ],
        'error' => [
            '_' => 'error',
        ],
        'forum' => [
            'topic_watches_controller' => [
                'index' => 'home',
            ],
        ],
        'main' => [
            'account_controller' => [
                '_' => 'home',
            ],
            'artist_tracks_controller' => [
                '_' => 'beatmaps',
            ],
            'artists_controller' => [
                '_' => 'beatmaps',
            ],
            'beatmap_discussion_posts_controller' => [
                '_' => 'beatmaps',
            ],
            'beatmap_discussions_controller' => [
                '_' => 'beatmaps',
            ],
            'beatmap_packs_controller' => [
                '_' => 'beatmaps',
            ],
            'beatmaps_controller' => [
                '_' => 'beatmaps',
            ],
            'beatmapset_discussion_votes_controller' => [
                '_' => 'beatmaps',
            ],
            'beatmapset_events_controller' => [
                '_' => 'beatmaps',
            ],
            'beatmapset_watches_controller' => [
                '_' => 'beatmaps',
                'index' => 'home',
            ],
            'beatmapsets_controller' => [
                '_' => 'beatmaps',
            ],
            'changelog_controller' => [
                '_' => 'home',
            ],
            'client_verifications_controller' => [
                '_' => 'home',
            ],
            'follows_controller' => [
                '_' => 'home',
            ],
            'friends_controller' => [
                '_' => 'home',
            ],
            'group_history_controller' => [
                '_' => 'home',
            ],
            'groups_controller' => [
                '_' => 'home',
            ],
            'home_controller' => [
                '_' => 'home',
            ],
            'legal_controller' => [
                '_' => 'home',
            ],
            'matches_controller' => [
                '_' => 'multiplayer',
            ],
            'news_controller' => [
                '_' => 'home',
            ],
            'notifications_controller' => [
                '_' => 'user',
            ],
            'password_reset_controller' => [
                '_' => 'home',
            ],
            'ranking_controller' => [
                '_' => 'rankings',
            ],
            'scores_controller' => [
                '_' => 'beatmaps',
            ],
            'seasons_controller' => [
                '_' => 'rankings',
            ],
            'sessions_controller' => [
                '_' => 'user',
            ],
            'spotlights_controller' => [
                '_' => 'rankings',
            ],
            'store_controller' => [
                '_' => 'store',
            ],
            'user_totp_controller' => [
                '_' => 'home',
            ],
            'users_controller' => [
                '_' => 'user',
            ],
            'wiki_controller' => [
                '_' => 'help',
            ],
        ],
        'multiplayer' => [
            '_' => 'multiplayer',

            'rooms_controller' => [
                '_' => 'rankings',
            ],
        ],
        'multiplayer_rooms_playlist' => [
            '_' => 'multiplayer',
        ],
        'o_auth' => [
            '_' => 'user',
        ],
        'passport' => [
            '_' => 'user',
        ],
        'ranking' => [
            '_' => 'rankings',
        ],
        'store' => [
            '_' => 'store',
        ],
        'users' => [
            '_' => 'user',
        ],
    ];

    public function getCurrent(): array
    {
        return \Request::instance()->attributes->get('route_section_error')
            ?? $this->getOriginal();
    }

    public function getOriginal(): array
    {
        return request_attribute_remember('route_section', function (HttpRequest $request): array {
            $currentRoute = $request->route();
            $currentController = $currentRoute?->controller;

            if (isset($currentController)) {
                $className = $currentController::class;

                $namespace = get_class_namespace($className);
                $namespace = strtr($namespace, ['\\' => '', 'App\\Http\\Controllers' => '']);
                $namespace = presence(snake_case($namespace)) ?? 'main';

                $controller = snake_case(get_class_basename($className));
                $action = snake_case($currentRoute->getActionMethod());

                $section = static::SECTIONS[$namespace][$controller][$action]
                    ?? static::SECTIONS[$namespace][$controller]['_']
                    ?? static::SECTIONS[$namespace]['_']
                    ?? static::SECTIONS['_'];
            }

            return [
                'action' => $action ?? 'unknown',
                'controller' => $controller ?? 'unknown',
                'namespace' => $namespace ?? 'unknown',
                'section' => $section ?? 'unknown',
            ];
        });
    }

    public function setError($statusCode)
    {
        \Request::instance()->attributes->set('route_section_error', [
            'action' => $statusCode,
            'controller' => 'error',
            'namespace' => 'error',
            'section' => 'error',
        ]);
    }
}
