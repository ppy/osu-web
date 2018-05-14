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
    'deleted' => '',

    'beatmapset_activities' => [
        'title' => "",

        'discussions' => [
            'title_recent' => '',
        ],

        'events' => [
            'title_recent' => '',
        ],

        'posts' => [
            'title_recent' => '',
        ],

        'votes_received' => [
            'title_most' => '',
        ],

        'votes_made' => [
            'title_most' => '',
        ],
    ],

    'card' => [
        'loading' => '',
        'send_message' => '',
    ],

    'login' => [
        '_' => 'Inloggen',
        'locked_ip' => '',
        'username' => 'Gebruikernaam',
        'password' => 'Wachtwoord',
        'button' => 'Inloggen',
        'button_posting' => '',
        'remember' => 'Onthoud deze computer',
        'title' => 'Log in om verder te gaan',
        'failed' => 'Verkeerde login',
        'register' => "Heb je geen osu! account? Maak een nieuwe",
        'forgot' => 'Wachtwoord vergeten?',
        'beta' => [
            'main' => 'Beta toegang is alleen voor bepaalde gebruikers.',
            'small' => '(supporters krijgen binnenkort toegang)',
        ],

        'here' => 'hier', // this is substituted in when generating a link above. change it to suit the language.
    ],

    'posts' => [
        'title' => '',
    ],

    'signup' => [
        '_' => '',
    ],
    'anonymous' => [
        'login_link' => 'klik om in te loggen',
        'login_text' => '',
        'username' => 'Gast',
        'error' => 'Je moet ingelogd zijn om dit te doen.',
    ],
    'logout_confirm' => 'Weet je zeker dat je wilt uitloggen? :(',
    'restricted_banner' => [
        'title' => '',
        'message' => '',
    ],
    'show' => [
        'age' => ':age jaar oud',
        'change_avatar' => '',
        'first_members' => 'Hier sinds het begin',
        'is_developer' => '',
        'is_supporter' => '',
        'joined_at' => 'Werd lid op :date',
        'lastvisit' => 'Laatst gezien op :date',
        'missingtext' => 'Je hebt misschien een typfout gemaakt! (of de gebruiker is verbannen)',
        'origin_age' => '',
        'origin_country_age' => ':age uit :country',
        'origin_country' => 'Uit :country',
        'page_description' => 'osu! - Alles wat je ooit over :username wilde weten!',
        'previous_usernames' => '',
        'plays_with' => '',
        'title' => "Profiel van :username",

        'edit' => [
            'cover' => [
                'button' => 'Verander Profiel Cover',
                'defaults_info' => 'In de toekomst zullen er meer cover opties beschikbaar zijn',
                'upload' => [
                    'broken_file' => 'Afbeelding verwerken mislukt. Controleer de geüploade afbeelding en probeer opnieuw.',
                    'button' => 'Upload afbeelding',
                    'dropzone' => 'Drop hier om te uploaden',
                    'dropzone_info' => 'Je kunt je afbeelding ook hier droppen om te uploaden',
                    'restriction_info' => "Uploaden alleen beschikbaar voor <a href='".route('store.products.show', 'supporter-tag')."' target='_blank'>osu!supporters</a>",
                    'size_info' => 'Cover grootte moet 2000x700 zijn',
                    'too_large' => 'Het geüploade bestand is te groot.',
                    'unsupported_format' => 'Niet ondersteund formaat.',
                ],
            ],

            'default_playmode' => [
                'is_default_tooltip' => '',
                'set' => '',
            ],
        ],

        'extra' => [
            'followers' => '',
            'unranked' => '',

            'achievements' => [
                'title' => 'Prestaties',
                'achieved-on' => 'Behaald op :date',
            ],
            'beatmaps' => [
                'none' => 'Nog geen...',
                'title' => '',

                'favourite' => [
                    'title' => 'Favoriete Beatmaps (:count)',
                ],
                'graveyard' => [
                    'title' => '',
                ],
                'ranked_and_approved' => [
                    'title' => 'Gerankte & Goedgekeurde Beatmaps (:count)',
                ],
                'unranked' => [
                    'title' => '',
                ],
            ],
            'historical' => [
                'empty' => 'Geen prestatiegegevens. :(',
                'title' => 'Historisch',

                'monthly_playcounts' => [
                    'title' => '',
                ],
                'most_played' => [
                    'count' => 'keer gespeeld',
                    'title' => 'Meest Gespeelde Beatmaps',
                ],
                'recent_plays' => [
                    'accuracy' => 'precisie: :percentage',
                    'title' => 'Recent gespeeld',
                ],
                'replays_watched_counts' => [
                    'title' => '',
                ],
            ],
            'kudosu' => [
                'available' => 'Kudosu Beschikbaar',
                'available_info' => "Kudosu kunnen omgeruild worden voor kudosu sterren, deze zorgen ervoor dat je beatmap meer aandacht krijgt. Dit is het aantal kudosu dat je nog niet omgeruild hebt.",
                'recent_entries' => 'Recente Kudosu Geschiedenis',
                'title' => '',
                'total' => 'Totaal Aantal Kudosu Verdiend',
                'total_info' => 'Gebaseerd op hoeveel contributie de gebruiker heeft geleverd aan beatmap moderatie. Zie <a href="'.osu_url('user.kudosu').'">deze pagina</a> voor meer informatie.',

                'entry' => [
                    'amount' => '',
                    'empty' => "Deze gebruiker heeft nog geen kudosu ontvangen!",

                    'beatmap_discussion' => [
                        'allow_kudosu' => [
                            'give' => '',
                        ],

                        'deny_kudosu' => [
                            'reset' => '',
                        ],

                        'delete' => [
                            'reset' => '',
                        ],

                        'restore' => [
                            'give' => '',
                        ],

                        'vote' => [
                            'give' => '',
                            'reset' => '',
                        ],

                        'recalculate' => [
                            'give' => '',
                            'reset' => '',
                        ],
                    ],

                    'forum_post' => [
                        'give' => ':amount ontvangen van :giver voor :post',
                        'reset' => '',
                        'revoke' => 'Kudosu geweigerd door :giver voor :post',
                    ],
                ],
            ],
            'me' => [
                'title' => 'ik!',
            ],
            'medals' => [
                'empty' => "",
                'title' => 'Medailles',
            ],
            'recent_activity' => [
                'title' => '',
            ],
            'top_ranks' => [
                'empty' => 'Nog geen geweldige prestatiegegevens. :(',
                'not_ranked' => '',
                'pp' => '',
                'title' => '',
                'weighted_pp' => 'gewogen: :pp (:percentage)',

                'best' => [
                    'title' => 'Beste Prestatie',
                ],
                'first' => [
                    'title' => 'Eerste Ranks',
                ],
            ],
            'account_standing' => [
                'title' => '',
                'bad_standing' => "",
                'remaining_silence' => '',

                'recent_infringements' => [
                    'title' => '',
                    'date' => '',
                    'action' => '',
                    'length' => '',
                    'length_permanent' => '',
                    'description' => '',
                    'actor' => '',

                    'actions' => [
                        'restriction' => '',
                        'silence' => '',
                        'note' => '',
                    ],
                ],
            ],
        ],
        'info' => [
            'discord' => '',
            'interests' => '',
            'lastfm' => '',
            'location' => '',
            'occupation' => '',
            'skype' => '',
            'twitter' => '',
            'website' => '',
        ],
        'not_found' => [
            'reason_1' => '',
            'reason_2' => '',
            'reason_3' => '',
            'reason_header' => '',
            'title' => 'Gebruiker niet gevonden! ;_;',
        ],
        'page' => [
            'description' => '<strong>ik!</strong> is een persoonlijk bewerkbaar gedeelte van je profiel.',
            'edit_big' => 'Bewerk me!',
            'placeholder' => 'Typ pagina inhoud hier',
            'restriction_info' => "Je moet een <a href='".route('store.products.show', 'supporter-tag')."' target='_blank'>osu!supporter</a> zijn om dit te gebruiken.",
        ],
        'post_count' => [
            '_' => '',
            'count' => '',
        ],
        'rank' => [
            'country' => 'Landelijke rank voor :mode',
            'global' => 'Globale rank voor :mode',
        ],
        'stats' => [
            'hit_accuracy' => 'Hit Precisie',
            'level' => '',
            'maximum_combo' => '',
            'play_count' => '',
            'play_time' => '',
            'ranked_score' => 'Gerankte Score',
            'replays_watched_by_others' => 'Replays Gekeken door Anderen',
            'score_ranks' => '',
            'total_hits' => 'Totaal Aantal Hits',
            'total_score' => 'Totaal Aantal Score',
        ],
    ],
    'status' => [
        'online' => '',
        'offline' => '',
    ],
    'store' => [
        'saved' => '',
    ],
    'verify' => [
        'title' => '',
    ],
];
