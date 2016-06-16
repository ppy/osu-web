<?php

/**
 *    Copyright 2015 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed in the hopes of
 *    attracting more community contributions to the core ecosystem of osu!
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

return [
    'beatmap_discussion' => [
        'resolve' => [
            'general_discussion' => 'Nie można zamknąć generalnej dyskusji.',
            'not_owner' => 'Tylko autor posta i autor beatmapy mogą zamknąć tę dyskusję.',
        ],
    ],

    'beatmap_discussion_post' => [
        'edit' => [
            'system_generated' => 'Automatycznie wygenerowany post nie może być edytowany.',
            'not_owner' => 'Tylko autor posta może go edytować.',
        ],
    ],

    'chat' => [
        'channel' => [
            'read' => [
                'no_access' => 'Nie posiadasz dostępu do tego kanału.',
            ],
        ],
        'message' => [
            'send' => [
                'channel' => [
                    'no_access' => 'Nie posiadasz dostępu do tego kanału.',
                    'moderated' => 'Kanał jest obecnie w trybie tylko dla moderatorów.',
                ],

                'not_allowed' => 'Jeżeli jesteś uciszony/zbanowany, nie możesz wysyłać wiadomości.',
            ],
        ],
    ],

    'forum' => [
        'post' => [
            'delete' => [
                // how to english
                // Returned when TopicReply check fails.
                'can_not_post' => 'Nie możesz usunąć posta w temacie, w którym nie możesz odpowiadać.',
                'can_only_delete_last_post' => 'Tylko ostatni post może być usunięty.',
                'not_owner' => 'Tylko autor tematu może usunąć post.',
            ],

            'edit' => [
                'can_not_post' => 'Nie możesz edytować posta w temacie, w którym nie możesz odpowiadać.',
                'locked' => 'Ten post jest chroniony przed edycją.',
                'not_owner' => 'Tylko autor może edytować post.',
            ],
        ],

        'topic' => [
            'reply' => [
                'can_not_post' => 'Nie masz dostępu do tego forum.',
                'locked' => 'Nie możesz odpowiedzieć na zablokowany temat.',
            ],

            'store' => [
                'can_not_view_forum' => 'Nie masz dostępu do tego forum.',
                'can_not_post' => 'Nie możesz postować.',
                'forum_closed' => 'Forum jest zamknięte i nie można w nim postować.',
                'user' => [
                    'silenced' => 'Nie możesz postować, kiedy jesteś uciszony.',
                    'restricted' => 'Nie możesz postować, jeżeli jesteś zbanowany.',
                ],
            ],
        ],

        'topic_cover' => [
            'edit' => [
                'uneditable' => 'Wybrano nieprawidłowy nagłówek.',
                'not_owner' => 'Tylko autor może edytować nagłówek.',
            ],
        ],

        'view' => [
            'admin_only' => 'Tylko administrator ma dostęp do tego forum.',
        ],
    ],

    'require_login' => 'Zaloguj się, aby kontynuować.',

    'unauthorized' => 'Odmowa dostępu.',

    'silenced' => "Nie możesz tego zrobić, kiedy jesteś uciszony.",

    'restricted' => "Nie możesz tego zrobić, jeśli jesteś zbanowany.",

    'user' => [
        'page' => [
            'edit' => [
                'locked' => 'Strona użytkownika jest zablokowana.',
                'require_support_to_create' => 'Nie jesteś supporterem.',

                'user' => [
                    'silenced' => 'Nie możesz edytować strony, kiedy jesteś uciszony.',
                    'restricted' => 'Nie możesz edytować strony, jeśli jesteś zbanowany.',
                ],
            ],
        ],
    ],
];
