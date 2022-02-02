<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'play_more' => 'Wie wäre es, stattdessen ein bisschen osu! zu spielen?',
    'require_login' => 'Zum Fortfahren bitte einloggen.',
    'require_verification' => 'Bitte verifiziere Dich, um fortzufahren.',
    'restricted' => "Nicht möglich, während man restricted ist.",
    'silenced' => "Nicht möglich, während man stummgeschaltet ist.",
    'unauthorized' => 'Zugang verwehrt.',

    'beatmap_discussion' => [
        'destroy' => [
            'is_hype' => 'Hype kann nicht rückgängig gemacht werden.',
            'has_reply' => 'Eine Diskussion mit Antworten kann nicht gelöscht werden',
        ],
        'nominate' => [
            'exhausted' => 'Dein Nominierungslimit für heute wurde erreicht, bitte versuche es morgen erneut.',
            'incorrect_state' => 'Beim Ausführen dieser Aktion ist ein Fehler aufgetreten. Bitte Seite neu laden.',
            'owner' => "Eigene Beatmaps können nicht nominiert werden.",
            'set_metadata' => 'Vor der Nominierung müssen Genre und Sprache festgelegt werden.',
        ],
        'resolve' => [
            'not_owner' => 'Nur der Thread- oder Beatmapersteller kann die Diskussion beilegen.',
        ],

        'store' => [
            'mapper_note_wrong_user' => 'Nur der Beatmapersteller oder ein Nominator/QAT Mitglied kann Notizen erstellen.',
        ],

        'vote' => [
            'bot' => "Kann nicht über vom Bot gestartete Diskussion abstimmen",
            'limit_exceeded' => 'Bitte warte eine Weile, bevor du mehr Stimmen abgibst',
            'owner' => "Man kann nicht in der eigenen Diskussion abstimmen!",
            'wrong_beatmapset_state' => 'Abstimmung nur in Diskussion von Pending Beatmaps möglich.',
        ],
    ],

    'beatmap_discussion_post' => [
        'destroy' => [
            'not_owner' => 'Du kannst nur deine eigenen Beiträge löschen.',
            'resolved' => 'Du kannst keinen Beitrag einer gelösten Diskussion löschen.',
            'system_generated' => 'Automatisch generierter Beitrag kann nicht gelöscht werden.',
        ],

        'edit' => [
            'not_owner' => 'Nur der Autor des Beitrages kann den Beitrag bearbeiten.',
            'resolved' => 'Du kannst keinen Beitrag einer gelösten Diskussion bearbeiten.',
            'system_generated' => 'Automatisch erzeugte Beiträge können nicht bearbeitet werden.',
        ],

        'store' => [
            'beatmapset_locked' => 'Diese Beatmap Diskussion ist gesperrt.',
        ],
    ],

    'beatmapset' => [
        'metadata' => [
            'nominated' => 'Du kannst die Metadaten einer nominierten Map nicht ändern. Wenn du glaubst, dass sie falsch sind, wende dich an ein BN- oder NAT-Mitglied.',
        ],
    ],

    'chat' => [
        'annnonce_only' => '',
        'blocked' => 'Du kannst keine Nachrichten an einen Benutzer senden, der dich oder den du blockiert hast.',
        'friends_only' => 'Der Benutzer blockiert alle Nachrichten von Personen, die nicht auf seiner Freundesliste sind.',
        'moderated' => 'Dieser Kanal wird derzeit moderiert.',
        'no_access' => 'Du hast kein Zugriff auf diesen Kanal.',
        'receive_friends_only' => '',
        'restricted' => 'Du kannst keine Nachrichten senden, während du stummgeschaltet, eingeschränkt oder gebannt bist.',
        'silenced' => 'Du kannst keine Nachrichten senden, während du stummgeschaltet, eingeschränkt oder gebannt bist.',
    ],

    'comment' => [
        'update' => [
            'deleted' => "Der gelöschte Beitrag kann nicht bearbeitet werden.",
        ],
    ],

    'contest' => [
        'voting_over' => 'Stimmen können nach dem Abstimmungsende nicht mehr geändert werden.',

        'entry' => [
            'limit_reached' => 'Du hast das Einsendelimit für diesen Wettbewerb erreicht',
            'over' => 'Vielen Dank für eure Einsendungen! Der Einsendezeitraum ist vorbei, die Abstimmungen werden bald beginnen.',
        ],
    ],

    'forum' => [
        'moderate' => [
            'no_permission' => 'Keine Berechtigung, dieses Forum zu moderieren.',
        ],

        'post' => [
            'delete' => [
                'only_last_post' => 'Nur der letzte Beitrag kann gelöscht werden.',
                'locked' => 'Beiträge in gesperrten Threads können nicht gelöscht werden.',
                'no_forum_access' => 'Zugang zum angeforderten Forum wurde verwehrt.',
                'not_owner' => 'Nur der Autor kann den Beitrag löschen.',
            ],

            'edit' => [
                'deleted' => 'Gelöschte Beiträge können nicht bearbeitet werden.',
                'locked' => 'Dieser Beitrag ist gesperrt und kann nicht bearbeitet werden.',
                'no_forum_access' => 'Zugang zum angeforderten Forum wurde verwehrt.',
                'not_owner' => 'Nur der Autor kann den Beitrag bearbeiten.',
                'topic_locked' => 'Beiträge in gesperrten Threads können nicht bearbeitet werden.',
            ],

            'store' => [
                'play_more' => 'Versuche dich erst einmal am Spiel, bevor du einen Beitrag erstellst! Falls du Probleme mit dem Spiel hast, frage in dem Hilfe- und Support-Forum.',
                'too_many_help_posts' => "Du musst das Spiel gespielt haben, bevor du weitere Beiträge erstellen kannst. Falls du immer noch Probleme mit dem Spiel hast, schreibe eine E-Mail an support@ppy.sh", // FIXME: unhardcode email address.
            ],
        ],

        'topic' => [
            'reply' => [
                'double_post' => 'Bitte bearbeite deinen letzten Beitrag, anstatt ihn erneut zu posten.',
                'locked' => 'Auf gesperrte Threads kann nicht geantwortet werden.',
                'no_forum_access' => 'Zugang zum angeforderten Forum wurde verwehrt.',
                'no_permission' => 'Keine Berechtigung zum Antworten.',

                'user' => [
                    'require_login' => 'Zum Antworten bitte einloggen.',
                    'restricted' => "Man kann nicht antworten, während man restricted ist.",
                    'silenced' => "Antworten nicht möglich, während du stummgeschaltet bist.",
                ],
            ],

            'store' => [
                'no_forum_access' => 'Zugang zum angeforderten Forum wurde verwehrt.',
                'no_permission' => 'Keine Berechtigung, einen neuen Thread zu erstellen.',
                'forum_closed' => 'Das Forum ist geschlossen. Man kann keine Beiträge mehr posten.',
            ],

            'vote' => [
                'no_forum_access' => 'Zugang zum angeforderten Forum wurde verwehrt.',
                'over' => 'Die Abstimmung ist vorbei. Es kann nicht mehr abgestimmt werden.',
                'play_more' => 'Du musst mehr spielen bevor du im Forum abstimmen kannst.',
                'voted' => 'Es ist nicht erlaubt, die Stimme zu ändern.',

                'user' => [
                    'require_login' => 'Zum Abstimmen bitte einloggen.',
                    'restricted' => "Man kann nicht abstimmen, während man restricted ist.",
                    'silenced' => "Abstimmen nicht möglich, während du stummgeschaltet bist.",
                ],
            ],

            'watch' => [
                'no_forum_access' => 'Zugang zum angeforderten Forum wurde verwehrt.',
            ],
        ],

        'topic_cover' => [
            'edit' => [
                'uneditable' => 'Ungültiges Banner ausgewählt.',
                'not_owner' => 'Nur der Besitzer kann das Banner bearbeiten.',
            ],
            'store' => [
                'forum_not_allowed' => 'Dieses Forum akzeptiert keine Titelbilder.',
            ],
        ],

        'view' => [
            'admin_only' => 'Nur Administratoren können dieses Forum sehen.',
        ],
    ],

    'score' => [
        'pin' => [
            'not_owner' => '',
            'too_many' => '',
        ],
    ],

    'user' => [
        'page' => [
            'edit' => [
                'locked' => 'Dieses Profil ist gesperrt.',
                'not_owner' => 'Nur das eigene Profil kann bearbeitet werden.',
                'require_supporter_tag' => 'Ein osu!supporter-Tag ist erforderlich.',
            ],
        ],
    ],
];
