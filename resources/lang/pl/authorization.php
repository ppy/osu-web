<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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
            'is_hype' => 'Nie możesz cofnąć nagłośnienia.',
            'has_reply' => 'Nie możesz usunąć dyskusji z odpowiedziami',
        ],
        'nominate' => [
            'exhausted' => 'Osiągnięto dzienny limit nominacji, spróbuj ponownie jutro.',
            'incorrect_state' => 'Wystąpił błąd podczas wykonywania tej czynności, spróbuj odświeżyć stronę.',
            'owner' => "Nie możesz nominować własnej beatmapy.",
        ],
        'resolve' => [
            'not_owner' => 'Tylko autor wątku i autor beatmapy mogą zakończyć dyskusję.',
        ],

        'store' => [
            'mapper_note_wrong_user' => 'Adnotacje mogą być dodawane tylko przez twórcę mapy, nominatora lub członka QAT.',
        ],

        'vote' => [
            'limit_exceeded' => 'Zaczekaj, zanim zagłosujesz ponownie',
            'owner' => "Nie możesz głosować we własnej dyskusji!",
            'wrong_beatmapset_state' => 'Możesz głosować tylko przy oczekujących beatmapach.',
        ],
    ],

    'beatmap_discussion_post' => [
        'edit' => [
            'system_generated' => 'Nie możesz edytować automatycznie wygenerowanego posta.',
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
                    'not_lazer' => 'Obecnie możesz pisać tylko na kanale #lazer.',
                ],

                'not_allowed' => 'Nie możesz wysyłać wiadomości podczas uciszenia bądź blokady konta',
            ],
        ],
    ],

    'contest' => [
        'voting_over' => 'Nie możesz zmieniać swojego głosu po zakończeniu głosowania.',
    ],

    'forum' => [
        'post' => [
            'delete' => [
                'only_last_post' => 'Tylko ostatni post może zostać usunięty.',
                'locked' => 'Nie możesz usuwać postów w zamkniętym wątku.',
                'no_forum_access' => 'Nie posiadasz dostępu do tego forum.',
                'not_owner' => 'Tylko autor posta może go usunąć.',
            ],

            'edit' => [
                'deleted' => 'Nie możesz edytować usuniętego posta.',
                'locked' => 'Ten post jest chroniony przed edycją.',
                'no_forum_access' => 'Nie posiadasz dostępu do tego forum.',
                'not_owner' => 'Tylko autor posta może go edytować.',
                'topic_locked' => 'Nie możesz edytować postów w zamkniętym wątku.',
            ],

            'store' => [
                'play_more' => 'Zagraj w osu! przed rozpoczęciem pisania na forum! Jeżeli masz jakiś problem, utwórz post w forum Help bądź Support.',
                'too_many_help_posts' => "Musisz zagrać w osu! przed utworzeniem kolejnych postów. Jeżeli nadal doświadczasz problemów, napisz na adres e-mail support@ppy.sh", // FIXME: unhardcode email address.
            ],
        ],

        'topic' => [
            'reply' => [
                'double_post' => 'Zedytuj swój poprzedni post zamiast tworzenia nowego.',
                'locked' => 'Nie możesz odpowiadać w zamkniętym wątku.',
                'no_forum_access' => 'Nie posiadasz dostępu do tego forum.',
                'no_permission' => 'Nie posiadasz uprawnień do odpowiadania.',

                'user' => [
                    'require_login' => 'Zaloguj się, aby odpowiedzieć.',
                    'restricted' => "Nie możesz odpowiadać podczas blokady konta.",
                    'silenced' => "Nie możesz odpowiadać podczas uciszenia.",
                ],
            ],

            'store' => [
                'no_forum_access' => 'Nie posiadasz dostępu do tego forum.',
                'no_permission' => 'Nie posiadasz uprawnień do utworzenia nowego wątku.',
                'forum_closed' => 'Forum zostało zamknięte i nie możesz w nim pisać.',
            ],

            'vote' => [
                'no_forum_access' => 'Nie posiadasz dostępu do tego forum.',
                'over' => 'Ankieta została zakończona i nie możesz już w niej głosować.',
                'voted' => 'Nie możesz zmienić swojego głosu.',

                'user' => [
                    'require_login' => 'Zaloguj się, aby zagłosować.',
                    'restricted' => "Nie możesz głosować podczas blokady konta.",
                    'silenced' => "Nie możesz głosować podczas uciszenia.",
                ],
            ],

            'watch' => [
                'no_forum_access' => 'Nie posiadasz dostępu do tego forum.',
            ],
        ],

        'topic_cover' => [
            'edit' => [
                'uneditable' => 'Wybrano nieprawidłowe tło.',
                'not_owner' => 'Tylko autor może edytować tło.',
            ],
        ],

        'view' => [
            'admin_only' => 'Tylko administrator ma dostęp do tego forum.',
        ],
    ],

    'require_login' => 'Zaloguj się, aby kontynuować.',

    'unauthorized' => 'Odmowa dostępu.',

    'silenced' => "Nie możesz tego zrobić podczas uciszenia.",

    'restricted' => "Nie możesz tego zrobić podczas blokady konta.",

    'user' => [
        'page' => [
            'edit' => [
                'locked' => 'Strona użytkownika została zablokowana.',
                'not_owner' => 'Możesz edytować tylko własną stronę użytkownika.',
                'require_supporter_tag' => 'Aby to zrobić, wymagany jest status donatora osu!.',
            ],
        ],
    ],
];
