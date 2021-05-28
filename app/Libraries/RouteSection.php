<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries;

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
            'sessions_controller' => [
                '_' => 'user',
            ],
            'spotlights_controller' => [
                '_' => 'rankings',
            ],
            'store_controller' => [
                '_' => 'store',
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
        'store' => [
            '_' => 'store',
        ],
        'users' => [
            '_' => 'user',
        ],
    ];

    public function getCurrent($key = null)
    {
        $data = request()->attributes->get('route_section_error') ?? $this->getOriginal();

        if ($key === null) {
            return $data;
        }

        return $data[$key];
    }

    public function getOriginal()
    {
        $default = request()->attributes->get('route_section');

        if ($default === null) {
            $currentRoute = request()->route();
            $currentController = optional($currentRoute)->controller;

            if (isset($currentRoute) && isset($currentController)) {
                $className = get_class($currentController);

                $namespace = get_class_namespace($className);
                $namespace = str_replace('App\\Http\\Controllers', '', $namespace);
                $namespace = snake_case(str_replace('\\', '', $namespace));
                $namespace = presence($namespace) ?? 'main';

                $controller = snake_case(get_class_basename($className));
                $action = snake_case($currentRoute->getActionMethod());

                $section = static::SECTIONS[$namespace][$controller][$action]
                    ?? static::SECTIONS[$namespace][$controller]['_']
                    ?? static::SECTIONS[$namespace]['_']
                    ?? static::SECTIONS['_'];
            }

            $default = [
                'action' => $action ?? 'unknown',
                'controller' => $controller ?? 'unknown',
                'namespace' => $namespace ?? 'unknown',
                'section' => $section ?? 'unknown',
            ];
            request()->attributes->set('route_section', $default);
        }

        return $default;
    }

    public function setError($statusCode)
    {
        request()->attributes->set('route_section_error', [
            'action' => $statusCode,
            'controller' => 'error',
            'namespace' => 'error',
            'section' => 'error',
        ]);
    }
}
