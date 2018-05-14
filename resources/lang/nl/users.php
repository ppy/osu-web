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
    'deleted' => '[deleted user]',

    'beatmapset_activities' => [
        'title' => ":user's Modding History",

        'discussions' => [
            'title_recent' => 'Recently started discussions',
        ],

        'events' => [
            'title_recent' => 'Recent events',
        ],

        'posts' => [
            'title_recent' => 'Recent posts',
        ],

        'votes_received' => [
            'title_most' => 'Most upvoted by (last 3 months)',
        ],

        'votes_made' => [
            'title_most' => 'Most upvoted (last 3 months)',
        ],
    ],

    'card' => [
        'loading' => 'Loading...',
        'send_message' => 'send message',
    ],

    'login' => [
        '_' => 'Inloggen',
        'locked_ip' => 'your IP address is locked. Please wait a few minutes.',
        'username' => 'Gebruikernaam',
        'password' => 'Wachtwoord',
        'button' => 'Inloggen',
        'button_posting' => 'Signing in...',
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
        'title' => ':username\'s posts',
    ],

    'signup' => [
        '_' => 'Register',
    ],
    'anonymous' => [
        'login_link' => 'klik om in te loggen',
        'login_text' => 'sign in',
        'username' => 'Gast',
        'error' => 'Je moet ingelogd zijn om dit te doen.',
    ],
    'logout_confirm' => 'Weet je zeker dat je wilt uitloggen? :(',
    'restricted_banner' => [
        'title' => 'Your account has been restricted!',
        'message' => 'While restricted, you will be unable to interact with other players and your scores will only be visible to you. This is usually the result of an automated process and will usually be lifted within 24 hours. If you wish to appeal your restriction, please <a href="mailto:accounts@ppy.sh">contact support</a>.',
    ],
    'show' => [
        'age' => ':age jaar oud',
        'change_avatar' => 'change your avatar!',
        'first_members' => 'Hier sinds het begin',
        'is_developer' => 'osu!developer',
        'is_supporter' => 'osu!supporter',
        'joined_at' => 'Werd lid op :date',
        'lastvisit' => 'Laatst gezien op :date',
        'missingtext' => 'Je hebt misschien een typfout gemaakt! (of de gebruiker is verbannen)',
        'origin_age' => ':age',
        'origin_country_age' => ':age uit :country',
        'origin_country' => 'Uit :country',
        'page_description' => 'osu! - Alles wat je ooit over :username wilde weten!',
        'previous_usernames' => 'formerly known as',
        'plays_with' => 'Plays with :devices',
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
                'is_default_tooltip' => 'default game mode',
                'set' => 'set :mode as profile default game mode',
            ],
        ],

        'extra' => [
            'followers' => '1 follower|:count followers',
            'unranked' => 'No recent plays',

            'achievements' => [
                'title' => 'Prestaties',
                'achieved-on' => 'Behaald op :date',
            ],
            'beatmaps' => [
                'none' => 'Nog geen...',
                'title' => 'Beatmaps',

                'favourite' => [
                    'title' => 'Favoriete Beatmaps (:count)',
                ],
                'graveyard' => [
                    'title' => 'Graveyarded Beatmaps (:count)',
                ],
                'ranked_and_approved' => [
                    'title' => 'Gerankte & Goedgekeurde Beatmaps (:count)',
                ],
                'unranked' => [
                    'title' => 'Pending Beatmaps (:count)',
                ],
            ],
            'historical' => [
                'empty' => 'Geen prestatiegegevens. :(',
                'title' => 'Historisch',

                'monthly_playcounts' => [
                    'title' => 'Play History',
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
                    'title' => 'Replays Watched History',
                ],
            ],
            'kudosu' => [
                'available' => 'Kudosu Beschikbaar',
                'available_info' => "Kudosu kunnen omgeruild worden voor kudosu sterren, deze zorgen ervoor dat je beatmap meer aandacht krijgt. Dit is het aantal kudosu dat je nog niet omgeruild hebt.",
                'recent_entries' => 'Recente Kudosu Geschiedenis',
                'title' => 'Kudosu!',
                'total' => 'Totaal Aantal Kudosu Verdiend',
                'total_info' => 'Gebaseerd op hoeveel contributie de gebruiker heeft geleverd aan beatmap moderatie. Zie <a href="'.osu_url('user.kudosu').'">deze pagina</a> voor meer informatie.',

                'entry' => [
                    'amount' => ':amount kudosu',
                    'empty' => "Deze gebruiker heeft nog geen kudosu ontvangen!",

                    'beatmap_discussion' => [
                        'allow_kudosu' => [
                            'give' => 'Received :amount from kudosu deny repeal of modding post :post',
                        ],

                        'deny_kudosu' => [
                            'reset' => 'Denied :amount from modding post :post',
                        ],

                        'delete' => [
                            'reset' => 'Lost :amount from modding post deletion of :post',
                        ],

                        'restore' => [
                            'give' => 'Received :amount from modding post restoration of :post',
                        ],

                        'vote' => [
                            'give' => 'Received :amount from obtaining votes in modding post of :post',
                            'reset' => 'Lost :amount from losing votes in modding post of :post',
                        ],

                        'recalculate' => [
                            'give' => 'Received :amount from votes recalculation in modding post of :post',
                            'reset' => 'Lost :amount from votes recalculation in modding post of :post',
                        ],
                    ],

                    'forum_post' => [
                        'give' => ':amount ontvangen van :giver voor :post',
                        'reset' => 'Kudosu reset by :giver for the post :post',
                        'revoke' => 'Kudosu geweigerd door :giver voor :post',
                    ],
                ],
            ],
            'me' => [
                'title' => 'ik!',
            ],
            'medals' => [
                'empty' => "This user hasn't gotten any yet. ;_;",
                'title' => 'Medailles',
            ],
            'recent_activity' => [
                'title' => 'Recent',
            ],
            'top_ranks' => [
                'empty' => 'Nog geen geweldige prestatiegegevens. :(',
                'not_ranked' => 'Only ranked beatmaps give out pp.',
                'pp' => ':amountpp',
                'title' => 'Ranks',
                'weighted_pp' => 'gewogen: :pp (:percentage)',

                'best' => [
                    'title' => 'Beste Prestatie',
                ],
                'first' => [
                    'title' => 'Eerste Ranks',
                ],
            ],
            'account_standing' => [
                'title' => 'Account Standing',
                'bad_standing' => "<strong>:username's</strong> account is not in a good standing :(",
                'remaining_silence' => '<strong>:username</strong> will be able to speak again in :duration.',

                'recent_infringements' => [
                    'title' => 'Recent Infringements',
                    'date' => 'date',
                    'action' => 'action',
                    'length' => 'length',
                    'length_permanent' => 'Permanent',
                    'description' => 'description',
                    'actor' => 'by :username',

                    'actions' => [
                        'restriction' => 'Ban',
                        'silence' => 'Silence',
                        'note' => 'Note',
                    ],
                ],
            ],
        ],
        'info' => [
            'discord' => 'Discord',
            'interests' => 'Interests',
            'lastfm' => 'Last.fm',
            'location' => 'Current Location',
            'occupation' => 'Occupation',
            'skype' => 'Skype',
            'twitter' => 'Twitter',
            'website' => 'Website',
        ],
        'not_found' => [
            'reason_1' => 'They may have changed their username.',
            'reason_2' => 'The account may be temporarily unavailable due to security or abuse issues.',
            'reason_3' => 'You may have made a typo!',
            'reason_header' => 'There are a few possible reasons for this:',
            'title' => 'Gebruiker niet gevonden! ;_;',
        ],
        'page' => [
            'description' => '<strong>ik!</strong> is een persoonlijk bewerkbaar gedeelte van je profiel.',
            'edit_big' => 'Bewerk me!',
            'placeholder' => 'Typ pagina inhoud hier',
            'restriction_info' => "Je moet een <a href='".route('store.products.show', 'supporter-tag')."' target='_blank'>osu!supporter</a> zijn om dit te gebruiken.",
        ],
        'post_count' => [
            '_' => 'Contributed :link',
            'count' => ':count forum post|:count forum posts',
        ],
        'rank' => [
            'country' => 'Landelijke rank voor :mode',
            'global' => 'Globale rank voor :mode',
        ],
        'stats' => [
            'hit_accuracy' => 'Hit Precisie',
            'level' => 'Level :level',
            'maximum_combo' => 'Maximum Combo',
            'play_count' => 'Play Count',
            'play_time' => 'Total Play Time',
            'ranked_score' => 'Gerankte Score',
            'replays_watched_by_others' => 'Replays Gekeken door Anderen',
            'score_ranks' => 'Score Ranks',
            'total_hits' => 'Totaal Aantal Hits',
            'total_score' => 'Totaal Aantal Score',
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
