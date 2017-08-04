<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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

return [
    'beatmap_discussion' => [
        'destroy' => [
            'has_reply' => 'Nie można zamknąć dyskusji z odpowiedziami',
        ],
        'nominate' => [
            'exhausted' => 'Dzienny limit nominacji został osiągnięty, spróbuj ponownie jutro.',
        ],
        'resolve' => [
            'general_discussion' => 'Nie można zamknąć generalnej dyskusji.',
            'not_owner' => 'Tylko autor wątku i autor beatmapy mogą zamknąć tę dyskusję.',
        ],

        'vote' => [
            'limit_exceeded' => 'Zaczekaj, zanim zagłosujesz ponownie',
            'owner' => 'Nie można głosować we własnej dyskusji!',
        ],
    ],

    'beatmap_discussion_post' => [
        'edit' => [
            'system_generated' => 'Automatycznie wygenerowany wątek nie może być edytowany.',
            'not_owner' => 'Tylko autor wątku może go edytować.',
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
                    'no_access' => 'Dostęp do tego kanału jest wymagany.',
                    'moderated' => 'Kanał jest obecnie w trybie tylko dla moderatorów.',
                    'not_lazer' => 'Obecnie możesz pisać tylko na kanale #lazer.',
                ],

                'not_allowed' => 'Nie możesz wysyłać wiadomości podczas uciszenia bądź blokady konta',
            ],
        ],
    ],

    'contest' => [
        'voting_over' => 'Nie możesz zmienić swojego głosu po zakończeniu głosowania dla tego konkursu.',
    ],

    'forum' => [
        'post' => [
            'delete' => [
                'only_last_post' => 'Tylko ostatnia odpowiedź może zostać usunięta.',
                'locked' => 'Nie możesz odpowiadać w zablokowanym wątku.',
                'no_forum_access' => 'Dostęp do tego forum jest wymagany.',
                'not_owner' => 'Tylko autor może edytować wątek.',
            ],

            'edit' => [
                'locked' => 'Ten wątek jest chroniony przed edycją.',
                'no_forum_access' => 'Dostęp do tego forum jest wymagany.',
                'not_owner' => 'Tylko autor może edytować wątek.',
                'topic_locked' => 'Nie możesz odpowiadać w zablokowanym wątku.',
            ],
        ],

        'topic' => [
            'reply' => [
                'double_post' => 'Odpowiedź została już stworzony. Poczekaj chwilę albo edytuj swoją poprzednią odpowiedź.',
                'locked' => 'Nie możesz odpowiedzieć w zablokowanym wątku.',
                'no_forum_access' => 'Dostęp do tego forum jest wymagany.',
                'no_permission' => 'Nie posiadasz uprawnień do odpowiadania.',

                'user' => [
                    'require_login' => 'Zaloguj się, aby odpowiedzieć.',
                    'restricted' => 'Nie można odpowiadać podczas blokady konta.',
                    'silenced' => 'Nie można odpowiadać podczas uciszenia.',
                ],
            ],

            'store' => [
                'no_forum_access' => 'Dostęp do tego forum jest wymagany.',
                'no_permission' => 'Nie posiadasz uprawnień do stworzenia nowego wątku.',
                'forum_closed' => 'Forum jest zamknięte i nie można w nim odpowiadać.',
            ],

            'vote' => [
                'no_forum_access' => 'Dostęp do tego forum jest wymagany.',
                'over' => 'Ankieta została zakończona i nie można już w niej głosować.',
                'voted' => 'Zmiana głosów jest niemożliwa.',

                'user' => [
                    'require_login' => 'Zaloguj się, aby zagłosować.',
                    'restricted' => 'Nie można głosować podczas blokady konta.',
                    'silenced' => 'Nie można głosować podczas uciszenia.',
                ],
            ],

            'watch' => [
                'no_forum_access' => 'Dostęp do tego forum jest wymagany.',
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

    'silenced' => 'Nie możesz tego zrobić podczas uciszenia.',

    'restricted' => 'Nie możesz tego zrobić podczas blokady konta.',

    'user' => [
        'page' => [
            'edit' => [
                'locked' => 'Strona użytkownika jest zablokowana.',
                'not_owner' => 'Można edytować tylko własną stronę użytkownika.',
                'require_supporter_tag' => 'Status donatora jest wymagany.',
            ],
        ],
    ],
];
