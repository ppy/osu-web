<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'all_read' => 'Wszystkie powiadomienia przeczytane!',
    'delete' => 'Usuń :type',
    'loading' => 'Ładowanie nieodczytanych powiadomień...',
    'mark_read' => 'Wyczyść :type',
    'none' => 'Brak powiadomień',
    'see_all' => 'zobacz wszystkie powiadomienia',
    'see_channel' => 'przejdź do czatu',
    'verifying' => 'Zweryfikuj sesję, by wyświetlić powiadomienia',

    'action_type' => [
        '_' => 'wszystkie',
        'beatmapset' => 'beatmapy',
        'build' => 'zmiany',
        'channel' => 'czat',
        'forum_topic' => 'forum',
        'news_post' => 'aktualności',
        'team' => 'zespół',
        'user' => 'profil',
    ],

    'filters' => [
        '_' => 'wszystkie',
        'beatmapset' => 'beatmapy',
        'build' => 'zmiany',
        'channel' => 'czat',
        'forum_topic' => 'forum',
        'news_post' => 'aktualności',
        'team' => 'zespół',
        'user' => 'profil',
    ],

    'item' => [
        'beatmapset' => [
            '_' => 'Beatmapa',

            'beatmap_owner_change' => [
                '_' => 'Gościnny poziom trudności',
                'beatmap_owner_change' => 'Od teraz jesteś twórcą poziomu trudności „:beatmap” dla beatmapy „:title”',
                'beatmap_owner_change_compact' => 'Od teraz jesteś twórcą poziomu trudności „:beatmap”',
            ],

            'beatmapset_discussion' => [
                '_' => 'Dyskusja beatmapy',
                'beatmapset_discussion_lock' => 'Tworzenie dyskusji dla beatmapy „:title” zostało zablokowane.',
                'beatmapset_discussion_lock_compact' => 'Dyskusja została zablokowana',
                'beatmapset_discussion_post_new' => 'Nowy post w dyskusji „:title” od użytkownika :username: „:content”',
                'beatmapset_discussion_post_new_empty' => 'Nowy post od użytkownika :username dla beatmapy „:title”',
                'beatmapset_discussion_post_new_compact' => 'Nowy post od użytkownika :username: „:content”',
                'beatmapset_discussion_post_new_compact_empty' => 'Nowy post od użytkownika :username',
                'beatmapset_discussion_review_new' => 'Nowa recenzja od użytkownika :username pod beatmapą „:title” zawierająca :review_counts',
                'beatmapset_discussion_review_new_compact' => 'Nowa recenzja od użytkownika :username zawierająca :review_counts',
                'beatmapset_discussion_unlock' => 'Tworzenie dyskusji dla beatmapy „:title” zostało odblokowane.',
                'beatmapset_discussion_unlock_compact' => 'Dyskusja została odblokowana',

                'review_count' => [
                    'praises' => ':count_delimited pochwała|:count_delimited pochwały|:count_delimited pochwał',
                    'problems' => ':count_delimited problem|:count_delimited problemy|:count_delimited problemów',
                    'suggestions' => ':count_delimited sugestia|:count_delimited sugestie|:count_delimited sugestii',
                ],
            ],

            'beatmapset_problem' => [
                '_' => 'Problem z zakwalifikowaną beatmapą',
                'beatmapset_discussion_qualified_problem' => 'Problem zgłoszony przez użytkownika :username dla beatmapy „:title”: „:content”',
                'beatmapset_discussion_qualified_problem_empty' => 'Problem zgłoszony przez użytkownika :username dla beatmapy „:title”',
                'beatmapset_discussion_qualified_problem_compact' => 'Problem zgłoszony przez użytkownika :username: „:content”',
                'beatmapset_discussion_qualified_problem_compact_empty' => 'Problem zgłoszony przez użytkownika :username',
            ],

            'beatmapset_state' => [
                '_' => 'Status beatmapy został zmieniony',
                'beatmapset_disqualify' => 'Beatmapa „:title” została zdyskwalifikowana',
                'beatmapset_disqualify_compact' => 'Beatmapa została zdyskwalifikowana',
                'beatmapset_love' => 'Beatmapa „:title” uzyskała status ulubionej społeczności',
                'beatmapset_love_compact' => 'Beatmapa uzyskała status ulubionej społeczności',
                'beatmapset_nominate' => 'Beatmapa „:title” została nominowana do sekcji rankingowej',
                'beatmapset_nominate_compact' => 'Beatmapa została nominowana do sekcji rankingowej',
                'beatmapset_qualify' => 'Beatmapa „:title” uzyskała wystarczającą liczbę nominacji i została zakwalifikowana.',
                'beatmapset_qualify_compact' => 'Beatmapa została zakwalifikowana',
                'beatmapset_rank' => 'Beatmapa „:title” uzyskała status rankingowy',
                'beatmapset_rank_compact' => 'Beatmapa uzyskała status rankingowy',
                'beatmapset_remove_from_loved' => 'Beatmapa „:title” została usunięta z kategorii ulubionych społeczności',
                'beatmapset_remove_from_loved_compact' => 'Beatmapa została usunięta z kategorii ulubionych społeczności',
                'beatmapset_reset_nominations' => 'Nominacja beatmapy „:title” została zresetowana',
                'beatmapset_reset_nominations_compact' => 'Nominacja została zresetowana',
            ],

            'comment' => [
                '_' => 'Nowy komentarz',

                'comment_new' => 'Nowy komentarz od użytkownika :username pod „:title”: „:content”',
                'comment_new_compact' => 'Nowy komentarz od użytkownika :username: „:content”',
                'comment_reply' => 'Nowa odpowiedź od użytkownika :username pod „:title”: „:content”',
                'comment_reply_compact' => 'Nowa odpowiedź od użytkownika :username: „:content”',
            ],
        ],

        'channel' => [
            '_' => 'Czat',

            'announcement' => [
                '_' => 'Nowe ogłoszenie',

                'announce' => [
                    'channel_announcement' => ':username pisze: „:title”',
                    'channel_announcement_compact' => ':title',
                    'channel_announcement_group' => 'Ogłoszenie od użytkownika :username',
                ],
            ],

            'channel' => [
                '_' => 'Nowa wiadomość',

                'pm' => [
                    'channel_message' => ':username pisze: „:title”',
                    'channel_message_compact' => ':title',
                    'channel_message_group' => 'od użytkownika :username',
                ],
            ],

            'channel_team' => [
                '_' => 'Nowa wiadomość na czacie zespołu',

                'team' => [
                    'channel_team' => ':username pisze „:title”',
                    'channel_team_compact' => ':username pisze „:title”',
                    'channel_team_group' => ':username pisze „:title”',
                ],
            ],
        ],

        'build' => [
            '_' => 'Zmiany',

            'comment' => [
                '_' => 'Nowy komentarz',

                'comment_new' => 'Nowy komentarz od użytkownika :username pod „:title”: „:content”',
                'comment_new_compact' => 'Nowy komentarz od użytkownika :username: „:content”',
                'comment_reply' => 'Nowa odpowiedź od użytkownika :username pod „:title”: „:content”',
                'comment_reply_compact' => 'Nowa odpowiedź od użytkownika :username: „:content”',
            ],
        ],

        'news_post' => [
            '_' => 'Aktualności',

            'comment' => [
                '_' => 'Nowy komentarz',

                'comment_new' => 'Nowy komentarz od użytkownika :username pod „:title”: „:content”',
                'comment_new_compact' => 'Nowy komentarz od użytkownika :username: „:content”',
                'comment_reply' => 'Nowa odpowiedź od użytkownika :username pod „:title”: „:content”',
                'comment_reply_compact' => 'Nowa odpowiedź od użytkownika :username: „:content”',
            ],
        ],

        'forum_topic' => [
            '_' => 'Wątek na forum',

            'forum_topic_reply' => [
                '_' => 'Nowa odpowiedź na forum',
                'forum_topic_reply' => 'Nowa odpowiedź od użytkownika :username w wątku „:title”',
                'forum_topic_reply_compact' => 'Nowa odpowiedź od użytkownika :username',
            ],
        ],

        'team' => [
            'team_application' => [
                '_' => 'Prośba o dołączenie do zespołu',

                'team_application_accept' => "Od teraz jesteś członkiem zespołu :title",
                'team_application_accept_compact' => "Od teraz jesteś członkiem zespołu :title",

                'team_application_group' => 'Nowe prośby o dołączenie do zespołu',

                'team_application_reject' => 'Twoja prośba o dołączenie do zespołu :title została odrzucona',
                'team_application_reject_compact' => 'Twoja prośba o dołączenie do zespołu :title została odrzucona',
                'team_application_store' => ':title prosi o dołączenie do twojego zespołu',
                'team_application_store_compact' => ':title prosi o dołączenie do twojego zespołu',
            ],
        ],

        'user' => [
            'user_beatmapset_new' => [
                '_' => 'Nowa beatmapa',

                'user_beatmapset_new' => 'Nowa beatmapa od użytkownika :username: „:title”',
                'user_beatmapset_new_compact' => 'Nowa beatmapa: „:title”',
                'user_beatmapset_new_group' => 'Nowe beatmapy od użytkownika :username',

                'user_beatmapset_revive' => 'Beatmapa „:title” została ożywiona przez użytkownika :username',
                'user_beatmapset_revive_compact' => 'Beatmapa „:title” została ożywiona',
            ],
        ],

        'user_achievement' => [
            '_' => 'Medale',

            'user_achievement_unlock' => [
                '_' => 'Nowy medal',
                'user_achievement_unlock' => 'Odblokowano medal „:title”!',
                'user_achievement_unlock_compact' => 'Odblokowano medal „:title”!',
                'user_achievement_unlock_group' => 'Odblokowano medale!',
            ],
        ],
    ],

    'mail' => [
        'beatmapset' => [
            'beatmap_owner_change' => [
                'beatmap_owner_change' => 'Od teraz jesteś gościem dla beatmapy „:title”',
            ],

            'beatmapset_discussion' => [
                'beatmapset_discussion_lock' => 'Dyskusja do beatmapy „:title” została zamknięta',
                'beatmapset_discussion_post_new' => 'W dyskusji do beatmapy „:title” pojawiły się nowe aktualizacje',
                'beatmapset_discussion_unlock' => 'Dyskusja do beatmapy „:title” została otwarta',
            ],

            'beatmapset_problem' => [
                'beatmapset_discussion_qualified_problem' => 'Zgłoszono nowy problem z beatmapą „:title”',
            ],

            'beatmapset_state' => [
                'beatmapset_disqualify' => 'Beatmapa „:title” została zdyskwalifikowana',
                'beatmapset_love' => 'Beatmapa „:title” uzyskała status ulubionej społeczności',
                'beatmapset_nominate' => 'Beatmapa „:title” została nominowana',
                'beatmapset_qualify' => 'Beatmapa „:title” uzyskała wystarczającą liczbę nominacji i została zakwalifikowana',
                'beatmapset_rank' => 'Beatmapa „:title” uzyskała status rankingowy',
                'beatmapset_remove_from_loved' => 'Beatmapa „:title” została usunięta z kategorii ulubionych społeczności',
                'beatmapset_reset_nominations' => 'Nominacja beatmapy „:title” została zresetowana',
            ],

            'comment' => [
                'comment_new' => 'W beatmapie „:title” pojawiły się nowe komentarze',
            ],
        ],

        'channel' => [
            'announcement' => [
                'channel_announcement' => 'Nowe ogłoszenie w pokoju „:name” ',
            ],
            'channel' => [
                'channel_message' => 'Otrzymujesz nową wiadomość od użytkownika :username',
            ],
            'channel_team' => [
                'channel_team' => 'Nowa wiadomość na czacie zespołu „:name” ',
            ],
        ],

        'build' => [
            'comment' => [
                'comment_new' => 'W liście zmian „:title” pojawiły się nowe komentarze',
            ],
        ],

        'news_post' => [
            'comment' => [
                'comment_new' => 'W wiadomości „:title” pojawiły się nowe komentarze',
            ],
        ],

        'forum_topic' => [
            'forum_topic_reply' => [
                'forum_topic_reply' => 'W wątku „:title” pojawiły się nowe odpowiedzi',
            ],
        ],

        'team' => [
            'team_application' => [
                'team_application_accept' => "Od teraz jesteś członkiem zespołu :title",
                'team_application_reject' => 'Twoja prośba o dołączenie do zespołu :title została odrzucona',
                'team_application_store' => ':title prosi o dołączenie do twojego zespołu',
            ],
        ],

        'user' => [
            'user_beatmapset_new' => [
                'user_beatmapset_new' => 'Użytkownik :username przesłał nowe beatmapy',
                'user_beatmapset_revive' => 'Użytkownik :username ożywił beatmapy',
            ],
        ],
    ],
];
