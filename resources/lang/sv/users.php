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
    'deleted' => '[raderad användare]',

    'beatmapset_activities' => [
        'title' => ":user's Modding Historik",
        'title_compact' => '',

        'discussions' => [
            'title_recent' => 'Nyligen startade diskussioner',
        ],

        'events' => [
            'title_recent' => 'Senaste händelser',
        ],

        'posts' => [
            'title_recent' => 'Senaste inläggen',
        ],

        'votes_received' => [
            'title_most' => 'Mest uppröstad av (senaste 3 månaderna)',
        ],

        'votes_made' => [
            'title_most' => 'Mest uppröstad (senaste 3 månaderna)',
        ],
    ],

    'blocks' => [
        'banner_text' => 'Du har blockerat denna användare.',
        'blocked_count' => 'blockerade användare (:count)',
        'hide_profile' => 'dölj profil',
        'not_blocked' => 'Användaren är inte blockerad.',
        'show_profile' => 'visa profil',
        'too_many' => 'Du har nått gränsen för blockeringar.',
        'button' => [
            'block' => 'blockera',
            'unblock' => 'avblockera',
        ],
    ],

    'card' => [
        'loading' => 'Laddar...',
        'send_message' => 'skicka meddelande',
    ],

    'disabled' => [
        'title' => '',
        'warning' => "",

        'if_mistake' => [
            '_' => '',
            'email' => '',
        ],

        'reasons' => [
            'compromised' => '',
            'opening' => '',

            'tos' => [
                '_' => '',
                'community_rules' => '',
                'tos' => '',
            ],
        ],
    ],

    'force_reactivation' => [
        'reason' => [
            'inactive_different_country' => "",
        ],
    ],

    'login' => [
        '_' => 'Logga in',
        'button' => 'Logga in',
        'button_posting' => 'Loggar in...',
        'email_login_disabled' => '',
        'failed' => 'Felaktig inloggning',
        'forgot' => 'Glömt ditt lösenord?',
        'info' => '',
        'locked_ip' => 'din IP adress är låst. Var vänlig vänta några minuter.',
        'password' => 'Lösenord',
        'register' => "Har du inget osu! konto? Skapa ett nytt",
        'remember' => 'Kom ihåg denna dator',
        'title' => 'Var vänlig logga in för att fortsätta',
        'username' => 'Användarnamn',

        'beta' => [
            'main' => 'Beta åtkomst är för nuvarande begränsad till privilegierade användare.',
            'small' => '(osu!supportrar kommer att komma in snart)',
        ],
    ],

    'posts' => [
        'title' => ':username\'s inlägg',
    ],

    'anonymous' => [
        'login_link' => 'klicka för att logga in',
        'login_text' => 'logga in',
        'username' => 'Gäst',
        'error' => 'Du behöver vara inloggad för att göra detta.',
    ],
    'logout_confirm' => 'Är du säker på att du vill logga ut? :(',
    'report' => [
        'button_text' => 'rapportera',
        'comments' => 'Ytterligare kommentarer',
        'placeholder' => 'Var snäll och lämna någon information som du tror kan vara användbar.',
        'reason' => 'Orsak',
        'thanks' => 'Tack för din rapport!',
        'title' => 'Rapportera :username?',

        'actions' => [
            'send' => 'Skicka Rapport',
            'cancel' => 'Avbryt',
        ],

        'options' => [
            'cheating' => 'Fult spel / Fusk',
            'insults' => 'Förolämpar mig / andra',
            'spam' => 'Spammning',
            'unwanted_content' => 'Länkar olämpligt innehåll',
            'nonsense' => 'Dumheter',
            'other' => 'Andra (skriv nedan)',
        ],
    ],
    'restricted_banner' => [
        'title' => 'Ditt konto har blivit begränsat!',
        'message' => 'När du är begränsad, kommer du inte kunna interagera med andra spelare och dina poäng kommer endast vara synliga för dig. Detta är oftast ett resultat av en automatiserad process och kommer troligen lyftas inom 24 timmar. Om du vill överklaga din begränsning, var vänlig <a href="mailto:accounts@ppy.sh">kontakta support</a>.',
    ],
    'show' => [
        'age' => ':age år gammal',
        'change_avatar' => 'byt din profilbild!',
        'first_members' => 'Här sedan början',
        'is_developer' => 'osu!developer',
        'is_supporter' => 'osu!supporter',
        'joined_at' => 'Gick med :date',
        'lastvisit' => 'Senast sedd :date',
        'lastvisit_online' => '',
        'missingtext' => 'Du kanske har stavat fel! (eller så är användaren bannad)',
        'origin_country' => 'Från :country',
        'page_description' => 'osu! - Allting du någonsin hade velat veta om :username!',
        'previous_usernames' => 'tidigare känd som',
        'plays_with' => 'Spelar med :devices',
        'title' => ":username's profil",

        'edit' => [
            'cover' => [
                'button' => 'Ändra Profilomslag',
                'defaults_info' => 'Fler omslagsalternativ kommer finnas i framtiden',
                'upload' => [
                    'broken_file' => 'Misslyckades med att processa bilden. Verifiera uppladdad bild och försök igen.',
                    'button' => 'Ladda upp bild',
                    'dropzone' => 'Släpp här för att ladda upp',
                    'dropzone_info' => 'Du kan också släppa din bild här för att ladda upp',
                    'size_info' => 'Omslagets storlek bör vara 2800x620',
                    'too_large' => 'Uppladdad bild är för stor.',
                    'unsupported_format' => 'Formatet stöds ej.',

                    'restriction_info' => [
                        '_' => '',
                        'link' => '',
                    ],
                ],
            ],

            'default_playmode' => [
                'is_default_tooltip' => 'standard spelläge',
                'set' => 'sätt :mode som profilens förvalda spelläge',
            ],
        ],

        'extra' => [
            'none' => '',
            'unranked' => 'Inga senaste spel',

            'achievements' => [
                'achieved-on' => 'Uppnått :date',
                'locked' => '',
                'title' => 'Prestationer',
            ],
            'beatmaps' => [
                'by_artist' => '',
                'none' => 'Inga... än.',
                'title' => 'Beatmaps',

                'favourite' => [
                    'title' => 'Favoriserade Beatmaps',
                ],
                'graveyard' => [
                    'title' => 'Begravda Beatmaps',
                ],
                'loved' => [
                    'title' => 'Älskade Beatmaps',
                ],
                'ranked_and_approved' => [
                    'title' => 'Rankade & Godkända Beatmaps',
                ],
                'unranked' => [
                    'title' => 'Väntade Beatmaps',
                ],
            ],
            'discussions' => [
                'title' => '',
                'title_longer' => '',
                'show_more' => '',
            ],
            'events' => [
                'title' => '',
                'title_longer' => '',
                'show_more' => '',
            ],
            'historical' => [
                'empty' => 'Inga prestanda uppgifter. :(',
                'title' => 'Historisk',

                'monthly_playcounts' => [
                    'title' => 'Spelhistorik',
                    'count_label' => '',
                ],
                'most_played' => [
                    'count' => 'gånger spelade',
                    'title' => 'Mest Spelade Beatmaps',
                ],
                'recent_plays' => [
                    'accuracy' => 'precision: :percentage',
                    'title' => 'Senaste spel (24h)',
                ],
                'replays_watched_counts' => [
                    'title' => 'Repriser kollade',
                    'count_label' => '',
                ],
            ],
            'kudosu' => [
                'available' => 'Kudosu Tillängligt',
                'available_info' => "Kudosu kan bli bytade mot kudosu stjärnor, vilket kommer hjälpa din beatmap att få mer uppmärksamhet. Detta är antalet kudosu du inte har bytt in än.",
                'recent_entries' => 'Nyligen Kudosu Historia',
                'title' => 'Kudosu!',
                'total' => 'Total Kudosu Intjänad',

                'entry' => [
                    'amount' => ':amount kudosu',
                    'empty' => "Denna användare har inte fått någon kudosu!",

                    'beatmap_discussion' => [
                        'allow_kudosu' => [
                            'give' => 'Tog emot :amount från kudosu nekning upphävning av modding inlägg :post',
                        ],

                        'deny_kudosu' => [
                            'reset' => 'Nekad :amount från modding inlägg :post',
                        ],

                        'delete' => [
                            'reset' => 'Förlorade :amount från modding inlägg radering av :post',
                        ],

                        'restore' => [
                            'give' => 'Tog emot :amount från modding inlägg återställning av :post',
                        ],

                        'vote' => [
                            'give' => 'Tog emot :amount från införskaffande röster i modding inlägg av :post',
                            'reset' => 'Förlorade :amount från förlorade röster i modding inlägg av :post',
                        ],

                        'recalculate' => [
                            'give' => 'Tog emot :amount från röst omkalkylering i modding inlägg av :post',
                            'reset' => 'Förlorade :amount från röst omkalkylering i modding inlägg av :post',
                        ],
                    ],

                    'forum_post' => [
                        'give' => 'Tog emot :amount från :giver för ett inlägg på :post',
                        'reset' => 'Kudosu återställning av :giver för inlägget :post',
                        'revoke' => 'Nekad kudosu av :giver för inlägget :post',
                    ],
                ],

                'total_info' => [
                    '_' => '',
                    'link' => '',
                ],
            ],
            'me' => [
                'title' => 'jag!',
            ],
            'medals' => [
                'empty' => "Denna användare har inte fått några än. ;_;",
                'recent' => '',
                'title' => 'Medaljer',
            ],
            'posts' => [
                'title' => '',
                'title_longer' => '',
                'show_more' => '',
            ],
            'recent_activity' => [
                'title' => 'Senaste',
            ],
            'top_ranks' => [
                'download_replay' => '',
                'empty' => 'Inga fantastiska prestationsrekord än. :(',
                'not_ranked' => 'Endast rankade beatmaps ger pp.',
                'pp_weight' => '',
                'title' => 'Ranker',

                'best' => [
                    'title' => 'Bästa Prestation',
                ],
                'first' => [
                    'title' => 'Förstaplats-ranker',
                ],
            ],
            'votes' => [
                'given' => '',
                'received' => '',
                'title' => '',
                'title_longer' => '',
                'vote_count' => '',
            ],
            'account_standing' => [
                'title' => 'Kontoställning',
                'bad_standing' => "<strong>:username's</strong> konto är inte i en bra ställning :(",
                'remaining_silence' => '<strong>:username</strong> kan prata igen om :duration.',

                'recent_infringements' => [
                    'title' => 'Senaste Överträdelser',
                    'date' => 'datum',
                    'action' => 'åtgärd',
                    'length' => 'längd',
                    'length_permanent' => 'Permanent',
                    'description' => 'beskrivning',
                    'actor' => 'efter :användarnamn',

                    'actions' => [
                        'restriction' => 'Bannlys',
                        'silence' => 'Tystnad',
                        'note' => 'Anteckning',
                    ],
                ],
            ],
        ],

        'info' => [
            'discord' => 'Discord',
            'interests' => 'Intressen',
            'lastfm' => 'Last.fm',
            'location' => 'Nuvarande plats',
            'occupation' => 'Sysselsättning',
            'skype' => 'Skype',
            'twitter' => 'Twitter',
            'website' => 'Hemsida',
        ],
        'not_found' => [
            'reason_1' => 'De kan ha ändrat sitt användarnamn.',
            'reason_2' => 'Kontot kan vara otillgängligt på grund av säkerhet eller missbruksproblem.',
            'reason_3' => 'Du kan ha gjort ett stavfel!',
            'reason_header' => 'Det finns några möjliga orsaker till detta:',
            'title' => 'Användare hittades inte! ;_;',
        ],
        'page' => [
            'button' => '',
            'description' => '<strong>jag!</strong> är en personlig anpassningsbar del på din profil sida.',
            'edit_big' => 'Redigera mig!',
            'placeholder' => 'Skriv sidoinnehåll här',

            'restriction_info' => [
                '_' => '',
                'link' => '',
            ],
        ],
        'post_count' => [
            '_' => 'Bidragit med :link',
            'count' => ':count foruminlägg|:count foruminlägg',
        ],
        'rank' => [
            'country' => 'Landsrank för :mode',
            'country_simple' => '',
            'global' => 'Global rank för :mode',
            'global_simple' => '',
        ],
        'stats' => [
            'hit_accuracy' => 'Träffsäkerhet',
            'level' => 'Nivå :level',
            'level_progress' => '',
            'maximum_combo' => 'Maximal Kombo',
            'medals' => '',
            'play_count' => 'Antal Gånger Spelat',
            'play_time' => 'Total speltid',
            'ranked_score' => 'Rankad Poäng',
            'replays_watched_by_others' => 'Repriser Sedda av Andra',
            'score_ranks' => 'Poäng Ranker',
            'total_hits' => 'Totala Träffar',
            'total_score' => 'Total Poäng',
            // modding stats
            'ranked_and_approved_beatmapset_count' => '',
            'loved_beatmapset_count' => '',
            'unranked_beatmapset_count' => '',
            'graveyard_beatmapset_count' => '',
        ],
    ],

    'status' => [
        'all' => '',
        'online' => 'Online',
        'offline' => 'Offline',
    ],
    'store' => [
        'saved' => 'Användare skapad',
    ],
    'verify' => [
        'title' => 'Kontoverifiering',
    ],

    'view_mode' => [
        'card' => '',
        'list' => '',
    ],
];
