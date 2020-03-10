<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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

    private $default;
    private $override;

    public function getCurrent($key = null)
    {
        $data = $this->error ?? $this->getDefault();

        if ($key === null) {
            return $data;
        }

        return $data[$key];
    }

    public function setError($statusCode)
    {
        $this->error = [
            'action' => $statusCode,
            'controller' => 'error',
            'namespace' => 'error',
            'section' => 'error',
        ];
    }

    private function getDefault()
    {
        if ($this->default === null) {
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

            $this->default = [
                'action' => $action ?? 'unknown',
                'controller' => $controller ?? 'unknown',
                'namespace' => $namespace ?? 'unknown',
                'section' => $section ?? 'unknown',
            ];
        }

        return $this->default;
    }
}
