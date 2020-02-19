<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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
        'title_compact' => 'Modding',

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

    'disabled' => [
        'title' => 'Uh-oh! Het lijkt erop dat je account is uitgeschakeld.',
        'warning' => "In het geval dat je een regel hebt overtreden, houd er rekening mee dat er over het algemeen een afkoelperiode van één maand is waarin we geen amnestieverzoeken in behandeling nemen. Na deze periode kunt u contact met ons opnemen als je dit nodig vind. Houd er rekening mee dat het maken van nieuwe accounts nadat uw account is uitgeschakeld, resulteert in een <strong> verlenging van deze cool-down van een maand </strong>. Houd er ook rekening mee dat voor <strong> elk account dat je maakt, je de regels verder overtreedt </strong>. We raden je ten zeerste aan om dit niet te doen!",

        'if_mistake' => [
            '_' => 'Als je denkt dat dit een vergissing is, ben je welkom om ons te contacteren (via :email of door te klikken op "? in de rechter onderhoek van deze pagina). Houd er rekening mee dat we altijd volledig vertrouwen hebben in onze acties, aangezien deze gebaseerd zijn op zeer solide gegevens. We behouden ons het recht voor om je verzoek te negeren als we het gevoel hebben dat je opzettelijk oneerlijk bent.',
            'email' => 'e-mail',
        ],

        'reasons' => [
            'compromised' => 'Uw account is beschadigd. Het kan tijdelijk worden uitgeschakeld terwijl de identiteit wordt bevestigd.',
            'opening' => 'Er zijn een aantal redenen die ertoe kunnen leiden dat uw account wordt uitgeschakeld:',

            'tos' => [
                '_' => 'Je hebt een of meer van onze :community_rules of :tos overtreden.',
                'community_rules' => 'community regels',
                'tos' => 'algemene voorwaarden',
            ],
        ],
    ],

    'force_reactivation' => [
        'reason' => [
            'inactive_different_country' => "Je account is lange tijd niet gebruikt.",
        ],
    ],

    'login' => [
        '_' => 'Inloggen',
        'button' => 'Inloggen',
        'button_posting' => 'Inloggen...',
        'email_login_disabled' => 'Inloggen met e-mail is momenteel uitgeschakeld. Gebruik in plaats daarvan de gebruikersnaam.',
        'failed' => 'Verkeerde login',
        'forgot' => 'Wachtwoord vergeten?',
        'info' => 'Log in om verder te gaan',
        'locked_ip' => 'je IP adres is vergrendeld. Wacht enkele minuten.',
        'password' => 'Wachtwoord',
        'register' => "Heb je geen osu! account? Maak een nieuwe",
        'remember' => 'Onthoud deze computer',
        'title' => 'Log in om verder te gaan',
        'username' => 'Gebruikersnaam',

        'beta' => [
            'main' => 'Beta toegang is momenteel beperkt voor bepaalde gebruikers.',
            'small' => '(osu!supporters krijgen binnenkort in)',
        ],
    ],

    'posts' => [
        'title' => ':username\'s berichten',
    ],

    'anonymous' => [
        'login_link' => 'klik om in te loggen',
        'login_text' => 'log in',
        'username' => 'Gast',
        'error' => 'Je moet ingelogd zijn om dit te doen.',
    ],
    'logout_confirm' => 'Weet je zeker dat je wilt uitloggen? :(',
    'report' => [
        'button_text' => 'rapporteer',
        'comments' => 'Aanvullende opmerkingen',
        'placeholder' => 'Geef alstublieft informatie die je denkt te kunnen gebruiken.',
        'reason' => 'Reden',
        'thanks' => 'Bedankt voor je melding!',
        'title' => 'Rapporteer :username?',

        'actions' => [
            'send' => 'Stuur rapport',
            'cancel' => 'Annuleren',
        ],

        'options' => [
            'cheating' => 'Valsspelen',
            'insults' => 'Beledigen van mij / anderen',
            'spam' => 'Spammen',
            'unwanted_content' => 'Linken van ongepaste inhoud',
            'nonsense' => 'Nonsense',
            'other' => 'Anders (type hieronder)',
        ],
    ],
    'restricted_banner' => [
        'title' => 'Je account is gerestrict!',
        'message' => 'Zolang je gerestrict bent, kan je niet communiceren met andere spelers en kan enkel jij je scores zien. Meestal is dit het resultaat van een geautomatiseerd proces en wordt het binnen 24 uur verwijderd. Als je in beroep wil gaan, <a href="mailto:accounts@ppy.sh">contacteer dan support</a>.',
    ],
    'show' => [
        'age' => ':age jaar oud',
        'change_avatar' => 'verander je avatar!',
        'first_members' => 'Hier sinds het begin',
        'is_developer' => 'osu!developer',
        'is_supporter' => 'osu!supporter',
        'joined_at' => 'Werd lid op :date',
        'lastvisit' => 'Laatst gezien op :date',
        'lastvisit_online' => 'Momenteel online',
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
                    'size_info' => 'Cover grootte moet 2800x620 zijn',
                    'too_large' => 'Het geüploade bestand is te groot.',
                    'unsupported_format' => 'Niet ondersteund formaat.',

                    'restriction_info' => [
                        '_' => 'Upload beschikbaar alleen voor :link',
                        'link' => 'osu!supporters',
                    ],
                ],
            ],

            'default_playmode' => [
                'is_default_tooltip' => 'standaard spelmode',
                'set' => 'zet :mode als standaard profiel spelmode',
            ],
        ],

        'extra' => [
            'none' => 'geen',
            'unranked' => 'Geen recente plays',

            'achievements' => [
                'achieved-on' => 'Behaald op :date',
                'locked' => 'Vergrendeld',
                'title' => 'Prestaties',
            ],
            'beatmaps' => [
                'by_artist' => 'door :artist',
                'none' => 'Nog geen...',
                'title' => 'Beatmaps',

                'favourite' => [
                    'title' => 'Favoriete Beatmaps',
                ],
                'graveyard' => [
                    'title' => 'Beatmaps in het kerkhof',
                ],
                'loved' => [
                    'title' => 'Loved Beatmaps',
                ],
                'ranked_and_approved' => [
                    'title' => 'Gerankte & Goedgekeurde Beatmaps',
                ],
                'unranked' => [
                    'title' => 'Afwachtende Beatmaps',
                ],
            ],
            'discussions' => [
                'title' => 'Discussies',
                'title_longer' => 'Recente discussies',
                'show_more' => 'zie meer discussies',
            ],
            'events' => [
                'title' => 'Gebeurtenissen',
                'title_longer' => 'Recente gebeurtenissen',
                'show_more' => 'meer gebeurtenissen zien',
            ],
            'historical' => [
                'empty' => 'Geen prestatiegegevens. :(',
                'title' => 'Historisch',

                'monthly_playcounts' => [
                    'title' => 'Speelgeschiedenis',
                    'count_label' => 'Aantal keer gespeeld',
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
                    'count_label' => 'Replays Bekeken',
                ],
            ],
            'kudosu' => [
                'available' => 'Kudosu Beschikbaar',
                'available_info' => "Kudosu kunnen omgeruild worden voor kudosu sterren, deze zorgen ervoor dat je beatmap meer aandacht krijgt. Dit is het aantal kudosu dat je nog niet omgeruild hebt.",
                'recent_entries' => 'Recente Kudosu Geschiedenis',
                'title' => 'Kudosu!',
                'total' => 'Totaal Aantal Kudosu Verdiend',

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

                'total_info' => [
                    '_' => 'Op basis van hoeveel bijdrage de gebruiker heeft geleverd aan beatmap moderatie. Zie :link voor meer informatie.',
                    'link' => 'deze pagina',
                ],
            ],
            'me' => [
                'title' => 'ik!',
            ],
            'medals' => [
                'empty' => "Deze gebruiker heeft er nog geen ;_;",
                'recent' => 'Recent',
                'title' => 'Medailles',
            ],
            'posts' => [
                'title' => 'Berichten',
                'title_longer' => 'Recente berichten',
                'show_more' => 'bekijk meer berichten',
            ],
            'recent_activity' => [
                'title' => 'Recent',
            ],
            'top_ranks' => [
                'download_replay' => 'Download Replay',
                'empty' => 'Nog geen geweldige prestatiegegevens. :(',
                'not_ranked' => 'Enkel gerankte beatmaps geven pp.',
                'pp_weight' => 'gewogen :percentage',
                'title' => 'Ranks',

                'best' => [
                    'title' => 'Beste Prestatie',
                ],
                'first' => [
                    'title' => 'Eerste Ranks',
                ],
            ],
            'votes' => [
                'given' => 'Gegeven stemmen (de afgelopen 3 maanden)',
                'received' => 'Ontvangen stemmen (laatste 3 maanden)',
                'title' => 'Stemmen',
                'title_longer' => 'Recente stemmen',
                'vote_count' => ':count_delimited stemmen|:count_delimited stemmen',
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
            'button' => 'Profielpagina bewerken',
            'description' => '<strong>ik!</strong> is een persoonlijk bewerkbaar gedeelte van je profiel.',
            'edit_big' => 'Bewerk me!',
            'placeholder' => 'Typ pagina inhoud hier',

            'restriction_info' => [
                '_' => 'U moet een :link zijn om deze functie te ontgrendelen.',
                'link' => 'osu!supporter',
            ],
        ],
        'post_count' => [
            '_' => 'Plaatste :link',
            'count' => ':count forum bericht|:count forum berichten',
        ],
        'rank' => [
            'country' => 'Landelijke rank voor :mode',
            'country_simple' => 'Land Ranking',
            'global' => 'Globale rank voor :mode',
            'global_simple' => 'Globale Ranking',
        ],
        'stats' => [
            'hit_accuracy' => 'Hit Precisie',
            'level' => 'Level :level',
            'level_progress' => 'Voortgang naar volgend level',
            'maximum_combo' => 'Maximum Combo',
            'medals' => 'Medailles',
            'play_count' => 'Play Count',
            'play_time' => 'Totale Speeltijd',
            'ranked_score' => 'Gerankte Score',
            'replays_watched_by_others' => 'Replays Gekeken door Anderen',
            'score_ranks' => 'Score Ranks',
            'total_hits' => 'Totaal Aantal Hits',
            'total_score' => 'Totaal Aantal Score',
            // modding stats
            'ranked_and_approved_beatmapset_count' => 'Gerankte & Goedgekeurde Beatmaps',
            'loved_beatmapset_count' => 'Loved Beatmaps',
            'unranked_beatmapset_count' => 'Afwachtende Beatmaps',
            'graveyard_beatmapset_count' => 'Graveyarded Beatmaps',
        ],
    ],

    'status' => [
        'all' => 'Alle',
        'online' => 'Online',
        'offline' => 'Offline',
    ],
    'store' => [
        'saved' => 'Door gebruiker gemaakt',
    ],
    'verify' => [
        'title' => 'Accountverificatie',
    ],

    'view_mode' => [
        'card' => 'Kaartweergave',
        'list' => 'Lijst weergave',
    ],
];
