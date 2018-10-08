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
            'is_hype' => 'Hype kann nicht rückgängig gemacht werden.',
            'has_reply' => 'Eine Diskussion mit Antworten kann nicht gelöscht werden',
        ],
        'nominate' => [
            'exhausted' => 'Dein Nominierungslimit für heute wurde erreicht, bitte versuche es morgen erneut.',
            'incorrect_state' => 'Beim Ausführen dieser Aktion ist ein Fehler aufgetreten. Bitte Seite neu laden.',
            'owner' => "Eigene Beatmaps können nicht nominiert werden.",
        ],
        'resolve' => [
            'not_owner' => 'Nur der Thread- oder Beatmapersteller kann die Diskussion für gelöst erklären.',
        ],

        'store' => [
            'mapper_note_wrong_user' => 'Nur der Beatmap Urheber oder ein Nominator/QAT Mitglied kann Mapper Notizen posten.',
        ],

        'vote' => [
            'limit_exceeded' => 'Bitte warte eine Weile, bevor du mehr Stimmen abgibst',
            'owner' => "Man kann nicht in der eigenen Diskussion abstimmen!",
            'wrong_beatmapset_state' => 'Abstimmung nur in Diskussion von Pending Beatmaps möglich.',
        ],
    ],

    'beatmap_discussion_post' => [
        'edit' => [
            'system_generated' => 'Automatisch erzeugte Beiträge können nicht bearbeitet werden.',
            'not_owner' => 'Nur der Autor des Beitrages kann den Beitrag bearbeiten.',
        ],
    ],

    'chat' => [
        'channel' => [
            'read' => [
                'no_access' => 'Zugang zum angeforderten Kanal wurde verwehrt.',
            ],
        ],
        'message' => [
            'send' => [
                'channel' => [
                    'no_access' => 'Zugang zum Kanal wurde verwehrt.',
                    'moderated' => 'Der Kanal wird momentan moderiert.',
                    'not_lazer' => 'Momentan kannst du nur in #lazer sprechen.',
                ],

                'not_allowed' => 'Gebannt, restricted oder stummgeschaltet kann man keine Nachrichten senden.',
            ],
        ],
    ],

    'contest' => [
        'voting_over' => 'Stimmen können nach dem Abstimmungsende nicht mehr geändert werden.',
    ],

    'forum' => [
        'post' => [
            'delete' => [
                'only_last_post' => 'Nur der letzte Beitrag kann gelöscht werden.',
                'locked' => 'Beiträge in gesperrten Threads können nicht gelöscht werden.',
                'no_forum_access' => 'Zugang zum angeforderten Forum wurde verwehrt.',
                'not_owner' => 'Nur der Autor des Beitrages kann den Beitrag löschen',
            ],

            'edit' => [
                'deleted' => 'Gelöschte Beiträge können nicht bearbeitet werden.',
                'locked' => 'Dieser Beitrag ist gesperrt und kann nicht bearbeitet werden.',
                'no_forum_access' => 'Zugang zum angeforderten Forum wurde verwehrt.',
                'not_owner' => 'Nur der Autor des Beitrages kann den Beitrag bearbeiten.',
                'topic_locked' => 'Beiträge in gesperrten Threads können nicht bearbeitet werden.',
            ],

            'store' => [
                'play_more' => 'Versuche dich erst einmal am Spiel, bevor du einen Beitrag erstellst! Falls du Probleme mit dem Spiel hast, frage in dem Hilfe- und Support-Forum.',
                'too_many_help_posts' => "Du musst das Spiel gespielt haben, bevor du weitere Beiträge erstellen kannst. Falls du immer noch Probleme mit dem Spiel hast, schreibe eine E-Mail an support@ppy.sh", // FIXME: unhardcode email address.
            ],
        ],

        'topic' => [
            'reply' => [
                'double_post' => 'Bitte bearbeite deinen letzten Post, statt erneut zu posten.',
                'locked' => 'Auf gesperrte Threads kann nicht geantwortet werden.',
                'no_forum_access' => 'Zugang zum angeforderten Forum wurde verwehrt.',
                'no_permission' => 'Keine Berechtigung zum Antworten.',

                'user' => [
                    'require_login' => 'Zum Antworten bitte einloggen.',
                    'restricted' => "Man kann nicht antworten, während man restricted ist.",
                    'silenced' => "Man kann nicht antworten, während man stummgeschaltet ist.",
                ],
            ],

            'store' => [
                'no_forum_access' => 'Zugang zum angeforderten Forum wurde verwehrt.',
                'no_permission' => 'Keine Berechtigung, einen neuen Thread zu erstellen.',
                'forum_closed' => 'Das Forum ist geschlossen. Man kann keine Posts mehr senden.',
            ],

            'vote' => [
                'no_forum_access' => 'Zugang zum angeforderten Forum wurde verwehrt.',
                'over' => 'Die Abstimmung ist vorbei. Es kann nicht mehr abgestimmt werden.',
                'voted' => 'Es ist nicht erlaubt, die Stimme zu ändern.',

                'user' => [
                    'require_login' => 'Zum Abstimmen bitte einloggen.',
                    'restricted' => "Man kann nicht abstimmen, während man restricted ist.",
                    'silenced' => "Man kann nicht abstimmen, während man stummgeschaltet ist.",
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
        ],

        'view' => [
            'admin_only' => 'Nur Administratoren können dieses Forum sehen.',
        ],
    ],

    'require_login' => 'Zum Fortfahren bitte einloggen.',

    'unauthorized' => 'Zugang verwehrt.',

    'silenced' => "Nicht möglich, während man stummgeschaltet ist.",

    'restricted' => "Nicht möglich, während man restricted ist.",

    'user' => [
        'page' => [
            'edit' => [
                'locked' => 'Dieses Profil ist gesperrt.',
                'not_owner' => 'Nur das eigene Profil kann bearbeitet werden.',
                'require_supporter_tag' => 'Ein osu!supporter Tag ist erforderlich.',
            ],
        ],
    ],
];
