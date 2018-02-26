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
    'deleted' => '[gelöschter benutzer]',

    'beatmapset_activities' => [
        'discussions' => [
            'title_recent' => 'Letztens gestartete Diskussionen',
        ],

        'events' => [
            'title_recent' => 'Neuste Events',
        ],

        'posts' => [
            'title_recent' => 'Neuste Posts',
        ],

        'votes_received' => [
            'title_most' => 'Meiste Stimmen von (3 Monate)',
        ],

        'votes_made' => [
            'title_most' => 'Meiste Stimmen (3 Monate)',
        ],
    ],

    'login' => [
        '_' => 'Login',
        'locked_ip' => 'Deine IP-Adresse ist gesperrt. Bitte warte ein paar Minuten.',
        'username' => 'Benutzername',
        'password' => 'Passwort',
        'button' => 'Einloggen',
        'button_posting' => 'Einloggen...',
        'remember' => 'Diesen Computer merken',
        'title' => 'Zum Fortfahren bitte einloggen',
        'failed' => 'Falscher Login',
        'register' => 'Noch keinen osu!-Account? Erstell\' einen',
        'forgot' => 'Passwort vergessen?',
        'beta' => [
            'main' => 'Beta-Zugang ist momentan privilegierten Benutzern vorbehalten.',
            'small' => '(Supporter kommen bald dazu)',
        ],

        'here' => 'hier', // this is substituted in when generating a link above. change it to suit the language.
    ],
    'signup' => [
        '_' => 'Registrieren',
    ],
    'anonymous' => [
        'login_link' => 'zum einloggen klicken',
        'login_text' => 'einloggen',
        'username' => 'Gast',
        'error' => 'Dafür musst du eingeloggt sein.',
    ],
    'logout_confirm' => 'Sicher, dass du dich ausloggen willst? :(',
    'restricted_banner' => [
        'title' => 'Dein Account wurde <restricted>!',
        'message' => 'Während du <restricted> bist, kannst du nicht mit anderen Spielern interagieren und deine Ranglisten<scores> sind nur für dich sichtbar. Dies passiert normalerweise durch einen automatischen Prozess und wird üblicherweise innerhalb von 24 Stunden aufgehoben. Wenn du Einspruch gegen deine <Restriction> erheben möchtest, wende dich bitte an <a href="mailto:accounts@ppy.sh">den Support</a>.',
    ],
    'show' => [
        '404' => 'Benutzer nicht gefunden! ;_;',
        'age' => ':age Jahre alt',
        'current_location' => 'Aktuell in :location',
        'first_members' => 'Seit dem Anfang hier',
        'is_developer' => 'osu!-Entwickler',
        'is_supporter' => 'osu!-Supporter',
        'joined_at' => 'Beigetreten am :date',
        'lastvisit' => 'Zuletzt gesehen am :date',
        'missingtext' => 'Vielleicht hast du dich verschrieben (oder der Benutzer wurde gebannt)!',
        'origin_age' => ':age',
        'origin_country' => 'Aus :country',
        'origin_country_age' => ':age aus :country',
        'page_description' => 'osu! - Alles, was du jemals über :username wissen wolltest!',
        'plays_with' => 'Spielt mit :devices',
        'title' => ":usernames Profil",

        'edit' => [
            'cover' => [
                'button' => 'Profilbanner ändern',
                'defaults_info' => 'In der Zukunft wird es mehr Optionen für das Banner geben',
                'upload' => [
                    'broken_file' => 'Verarbeitung des Bildes fehlgeschlagen. Überprüfe das hochgeladene Bild und versuch es erneut.',
                    'button' => 'Bild hochladen',
                    'dropzone' => 'Zum Hochladen hier ablegen',
                    'dropzone_info' => 'Du kannst das Bild auch hier ablegen, um es hochzuladen',
                    'restriction_info' => "Nur <a href='".route('store.products.show', 'supporter-tag')."' target='_blank'>osu!-Supporter</a> können hochladen",
                    'size_info' => 'Banner sollte 2000x700 groß sein',
                    'too_large' => 'Datei ist zu groß.',
                    'unsupported_format' => 'Format wird nicht unterstützt.',
                ],
            ],
        ],
        'extra' => [
            'followers' => '1 Follower|:count Follower',
            'unranked' => 'Keine <Plays> in letzter Zeit',

            'achievements' => [
                'title' => 'Erfolge',
                'achieved-on' => 'Erreicht am :date',
            ],
            'beatmaps' => [
                'none' => '(Noch) keine.',
                'title' => 'Beatmaps',

                'favourite' => [
                    'title' => 'Lieblings-Beatmaps (:count)',
                ],
                'graveyard' => [
                    'title' => 'Begrabene Beatmaps (:count)',
                ],
                'ranked_and_approved' => [
                    'title' => '<Ranked> & <Approved> Beatmaps (:count)',
                ],
                'unranked' => [
                    'title' => '<Pending> Beatmaps (:count)',
                ],
            ],
            'historical' => [
                'empty' => 'Keine Performance-Einträge. :(',
                'most_played' => [
                    'count' => 'mal gespielt',
                    'title' => 'Meist gespielte Beatmaps',
                ],
                'recent_plays' => [
                    'accuracy' => 'genauigkeit: :percentage',
                    'title' => 'Neuliche <Plays> (24h)',
                ],
                'title' => 'Historisch',
            ],
            'kudosu' => [
                'available' => 'Verfügbares Kudosu',
                'available_info' => "Kudosu kann gegen Kudosu-Sterne eingetauscht werden, die deiner Beatmap mehr Aufmerksamkeit bringen. Dies ist die Menge an Kudosu, die du noch nicht eingetauscht hast.",
                'recent_entries' => 'Kudosu-Geschichte',
                'title' => 'Kudosu!',
                'total' => 'Kudosu insgesamt',
                'total_info' => 'Basierend auf dem Beitrag zur Beatmapmoderation. Siehe <a href="'.osu_url('user.kudosu').'">diese Seite</a> für weitere Informationen.',

                'entry' => [
                    'amount' => ':amount kudosu',
                    'empty' => "Dieser Benutzer hat kein Kudosu erhalten!",

                    'beatmap_discussion' => [
                        'allow_kudosu' => [
                            'give' => ':amount durch das Zurückziehen des Kudosu-Verwehrens von :post erhalten',
                        ],

                        'deny_kudosu' => [
                            'reset' => ':amount vom Post :post verwehrt',
                        ],

                        'delete' => [
                            'reset' => ':amount durch das Löschen des Modding-Posts :post verloren',
                        ],

                        'restore' => [
                            'give' => ':amount durch die Wiederherstellung des Modding-Posts :post erhalten',
                        ],

                        'vote' => [
                            'give' => ':amount durch erhaltene Stimmen im Post :post erhalten',
                            'reset' => ':amount durch verlorene Stimmen im Post :post verloren',
                        ],

                        'recalculate' => [
                            'give' => ':amount durch Neuberechnung der Stimmen in :post erhalten',
                            'reset' => ':amount durch Neuberechnung der Stimmen in :post verloren',
                        ],
                    ],

                    'forum_post' => [
                        'give' => ':amount von :giver für einen Post in :post erhalten',
                        'reset' => 'Kudosu von :giver im Post :post zurückgesetzt',
                        'revoke' => 'Kudosu von :giver im Post :post verwehrt',
                    ],
                ],
            ],
            'me' => [
                'title' => 'ich!',
            ],
            'medals' => [
                'empty' => 'Dieser Nutzer hat noch keine erhalten. ;_;',
                'title' => 'Medaillen',
            ],
            'recent_activities' => [
                'title' => 'Neulich',
            ],
            'top_ranks' => [
                'best' => [
                    'title' => 'Beste Performance',
                ],
                'empty' => 'No awesome performance records yet. :(',
                'first' => [
                    'title' => 'First Place Ranks',
                ],
                'pp' => ':amountpp',
                'title' => 'Ranks',
                'weighted_pp' => 'weighted: :pp (:percentage)',
            ],
        ],
        'page' => [
            'description' => '<strong>me!</strong> is a personal customisable area in your profile page.',
            'edit_big' => 'Edit me!',
            'placeholder' => 'Type page content here',
            'restriction_info' => "You need to be an <a href='".route('store.products.show', 'supporter-tag')."' target='_blank'>osu!supporter</a> to unlock this feature.",
        ],
        'rank' => [
            'country' => 'Country rank for :mode',
            'global' => 'Global rank for :mode',
        ],
        'stats' => [
            'hit_accuracy' => 'Hit Accuracy',
            'level' => 'Level :level',
            'maximum_combo' => 'Maximum Combo',
            'play_count' => 'Play Count',
            'ranked_score' => 'Ranked Score',
            'replays_watched_by_others' => 'Replays Watched by Others',
            'score_ranks' => 'Score Ranks',
            'total_hits' => 'Total Hits',
            'total_score' => 'Total Score',
        ],
    ],
    'status' => [
        'online' => 'Online',
        'offline' => 'Offline',
    ],
    'store' => [
        'saved' => 'User created',
    ],
    'verify' => [
        'title' => 'Account Verification',
    ],
];
