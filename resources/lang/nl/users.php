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
    'deleted' => '[verwijderde gebruiker]',

    'beatmapset_activities' => [
        'title' => ":user's modding geschiedenis",

        'discussions' => [
            'title_recent' => 'Recent gestarte discussies',
        ],

        'events' => [
            'title_recent' => 'Recente gebeurtenissen',
        ],

        'posts' => [
            'title_recent' => 'Recente berichten',
        ],

        'votes_received' => [
            'title_most' => 'Meest geupvote door (laatste 3 maanden)',
        ],

        'votes_made' => [
            'title_most' => 'Meest geupvote (laatste 3 maanden)',
        ],
    ],

    'blocks' => [
        'banner_text' => 'U hebt deze gebruiker geblokkeerd.',
        'blocked_count' => 'geblokkeerde gebruikers (:count)',
        'hide_profile' => 'profiel verbergen',
        'not_blocked' => 'Deze gebruiker is niet geblokkeerd.',
        'show_profile' => 'profiel weergeven',
        'too_many' => 'Blok limiet bereikt.',
        'button' => [
            'block' => 'blokkeren',
            'unblock' => 'deblokkeren',
        ],
    ],

    'card' => [
        'loading' => 'Bezig met laden...',
        'send_message' => 'stuur bericht',
    ],

    'login' => [
        '_' => 'Inloggen',
        'locked_ip' => 'je IP adres is vergrendeld. Wacht enkele minuten.',
        'username' => 'Gebruikernaam',
        'password' => 'Wachtwoord',
        'button' => 'Inloggen',
        'button_posting' => 'Inloggen...',
        'remember' => 'Onthoud deze computer',
        'title' => 'Log in om verder te gaan',
        'failed' => 'Verkeerde login',
        'register' => "Heb je geen osu! account? Maak een nieuwe",
        'forgot' => 'Wachtwoord vergeten?',
        'beta' => [
            'main' => 'Beta toegang is alleen voor bepaalde gebruikers.',
            'small' => '(osu!supporters krijgen binnenkort in)',
        ],

        'here' => 'hier', // this is substituted in when generating a link above. change it to suit the language.
    ],

    'posts' => [
        'title' => ':username\'s berichten',
    ],

    'signup' => [
        '_' => 'Registreer',
    ],
    'anonymous' => [
        'login_link' => 'klik om in te loggen',
        'login_text' => 'log in',
        'username' => 'Gast',
        'error' => 'Je moet ingelogd zijn om dit te doen.',
    ],
    'logout_confirm' => 'Weet je zeker dat je wilt uitloggen? :(',
    'report' => [
        'button_text' => '',
        'comments' => '',
        'placeholder' => '',
        'reason' => '',
        'thanks' => '',
        'title' => '',

        'actions' => [
            'send' => '',
            'cancel' => '',
        ],

        'options' => [
            'cheating' => '',
            'insults' => '',
            'spam' => '',
            'unwanted_content' => '',
            'nonsense' => '',
            'other' => '',
        ],
    ],
    'restricted_banner' => [
        'title' => 'Je account is gerestricteerd!',
        'message' => 'Zolang je gerestricteerd bent, kan je niet communiceren met andere spelers en kan enkel jij je scores zien. Meestal is dit het resultaat van een geautomatiseerd proces en wordt het binnen 24 uur verwijderd. Als je in beroep wil gaan, <a href="mailto:accounts@ppy.sh">contacteer dan support</a>.',
    ],
    'show' => [
        'age' => ':age jaar oud',
        'change_avatar' => 'verander je avatar!',
        'first_members' => 'Hier sinds het begin',
        'is_developer' => 'osu!developer',
        'is_supporter' => 'osu!supporter',
        'joined_at' => 'Werd lid op :date',
        'lastvisit' => 'Laatst gezien op :date',
        'missingtext' => 'Je hebt misschien een typfout gemaakt! (of de gebruiker is verbannen)',
        'origin_country' => 'Uit :country',
        'page_description' => 'osu! - Alles wat je ooit over :username wilde weten!',
        'previous_usernames' => 'vroeger bekend als',
        'plays_with' => 'Speelt met :devices',
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
                'is_default_tooltip' => 'standaard spelmode',
                'set' => 'zet :mode als standaard profiel spelmode',
            ],
        ],

        'extra' => [
            'followers' => '1 volger|:count volgers',
            'unranked' => 'Geen recente plays',

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
                    'title' => 'Beatmaps in het kerkhof (:count)',
                ],
                'loved' => [
                    'title' => 'Geliefde Beatmappen (:count)',
                ],
                'ranked_and_approved' => [
                    'title' => 'Gerankte & Goedgekeurde Beatmaps (:count)',
                ],
                'unranked' => [
                    'title' => 'Afwachtende Beatmaps (:count)',
                ],
            ],
            'historical' => [
                'empty' => 'Geen prestatiegegevens. :(',
                'title' => 'Historisch',

                'monthly_playcounts' => [
                    'title' => 'Speelgeschiedenis',
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
                    'title' => 'Replays Gekeken Geschiedenis',
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
                            'give' => 'Kreeg :amount kudosu voor in beroep gaan van afwijzing in modding post :post',
                        ],

                        'deny_kudosu' => [
                            'reset' => ':amount ontkend voor modding bericht :post',
                        ],

                        'delete' => [
                            'reset' => ':amount verloren vanwege verwijdering modding post :post',
                        ],

                        'restore' => [
                            'give' => 'Kreeg :amount voor modding post :post the herstellen',
                        ],

                        'vote' => [
                            'give' => 'Kreeg :amount via stemmen in modding post :post',
                            'reset' => 'Verloor :amount uit verliezende stemmen van post :post',
                        ],

                        'recalculate' => [
                            'give' => 'Kreeg :post uit stemming hertelling in modding post van :post',
                            'reset' => 'Verloor :post uit stemming hertelling in modding post van :post',
                        ],
                    ],

                    'forum_post' => [
                        'give' => ':amount ontvangen van :giver voor :post',
                        'reset' => 'Kudosu reset door :giver voor de post :post',
                        'revoke' => 'Kudosu geweigerd door :giver voor :post',
                    ],
                ],
            ],
            'me' => [
                'title' => 'ik!',
            ],
            'medals' => [
                'empty' => "Deze gebruiker heeft er nog geen ;_;",
                'title' => 'Medailles',
            ],
            'recent_activity' => [
                'title' => 'Recent',
            ],
            'top_ranks' => [
                'empty' => 'Nog geen geweldige prestatiegegevens. :(',
                'not_ranked' => 'Enkel gerankte beatmaps geven pp.',
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
                'title' => 'Account Reputatie',
                'bad_standing' => "<strong>:username's</strong> account heeft geen goede reputatie :(",
                'remaining_silence' => '<strong>:username</strong> kan terug spreken in :duration.',

                'recent_infringements' => [
                    'title' => 'Recente Overtredingen',
                    'date' => 'datum',
                    'action' => 'actie',
                    'length' => 'lengte',
                    'length_permanent' => 'Permanent',
                    'description' => 'omschrijving',
                    'actor' => 'door :username',

                    'actions' => [
                        'restriction' => 'Ban',
                        'silence' => 'Silence',
                        'note' => 'Opmerking',
                    ],
                ],
            ],
        ],
        'info' => [
            'discord' => '',
            'interests' => 'Interesses',
            'lastfm' => 'Last.fm',
            'location' => 'Huidige Locatie',
            'occupation' => 'Beroep',
            'skype' => '',
            'twitter' => '',
            'website' => 'Website',
        ],
        'not_found' => [
            'reason_1' => 'Misschien is hun gebruikersnaam veranderd.',
            'reason_2' => 'Het account kan tijdelijk onbeschikbaar zijn vanwege beveiligingsredenen of misbruik.',
            'reason_3' => 'Misschien heb je een typefout gemaakt!',
            'reason_header' => 'Er enkele mogelijke redenen hiervoor:',
            'title' => 'Gebruiker niet gevonden! ;_;',
        ],
        'page' => [
            'description' => '<strong>ik!</strong> is een persoonlijk bewerkbaar gedeelte van je profiel.',
            'edit_big' => 'Bewerk me!',
            'placeholder' => 'Typ pagina inhoud hier',
            'restriction_info' => "Je moet een <a href='".route('store.products.show', 'supporter-tag')."' target='_blank'>osu!supporter</a> zijn om dit te gebruiken.",
        ],
        'post_count' => [
            '_' => 'Plaatste :link',
            'count' => ':count forum bericht|:count forum berichten',
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
            'play_time' => 'Totale Speeltijd',
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
        'saved' => 'Door gebruiker gemaakt',
    ],
    'verify' => [
        'title' => 'Accountverificatie',
    ],
];
