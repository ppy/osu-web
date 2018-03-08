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
    'deleted' => '[raderad användare]',

    'login' => [
        '_' => 'Logga in',
        'locked_ip' => 'din IP adress är låst. Var vänlig vänta några minuter.',
        'username' => 'Användarnamn',
        'password' => 'Lösenord',
        'button' => 'Logga in',
        'button_posting' => 'Loggar in...',
        'remember' => 'Kom ihåg denna dator',
        'title' => 'Var vänlig logga in för att fortsätta',
        'failed' => 'Felaktig inloggning',
        'register' => 'Har inget osu! konto? Skapa en ny',
        'forgot' => 'Glömt ditt lösenord?',
        'beta' => [
            'main' => 'Beta åtkomst är för nuvarande begränsad till privilegierade användare.',
            'small' => '(supportare kommer komma in snart)',
        ],

        'here' => 'här', // this is substituted in when generating a link above. change it to suit the language.
    ],
    'signup' => [
        '_' => 'Registrera',
    ],
    'anonymous' => [
        'login_link' => 'klicka för att logga in',
        'login_text' => 'logga in',
        'username' => 'Gäst',
        'error' => 'Du behöver vara inloggad för att göra detta.',
    ],
    'logout_confirm' => 'Är du säker på att du vill logga ut? :(',
    'restricted_banner' => [
        'title' => 'Ditt konto har blivit begränsat!',
        'message' => 'När du är begränsad, kommer du inte kunna interagera med andra spelare och dina poäng kommer endast vara synliga för dig. Detta är oftast ett resultat av en automatiserad process och kommer troligen lyftas inom 24 timmar. Om du vill överklaga din begränsning, var vänlig <a href="mailto:accounts@ppy.sh">kontakta support</a>.',
    ],
    'show' => [
        '404' => 'Användare hittades inte! ;_;',
        'age' => ':age år gammal',
        'first_members' => 'Här sen början',
        'is_developer' => 'osu!developer',
        'is_supporter' => 'osu!supporter',
        'joined_at' => 'Gick med :date',
        'lastvisit' => 'Senast sedd :date',
        'missingtext' => 'Du kanske har stavat fel! (eller så är användaren bannad)',
        'origin_age' => ':age',
        'origin_country' => 'Från :country',
        'origin_country_age' => ':age från :country',
        'page_description' => 'osu! - Allting du någonsin hade velat veta om :username!',
        'plays_with' => 'Spelar med :devices',
        'title' => ":username's profil",

        'edit' => [
            'cover' => [
                'button' => 'Ändra Profil Omslag',
                'defaults_info' => 'Mer omslag val kommer finnas i framtiden',
                'upload' => [
                    'broken_file' => 'Misslyckades processa bild. Verifiera uppladdad bild och försök igen.',
                    'button' => 'Ladda upp bild',
                    'dropzone' => 'Släpp här för att ladda upp',
                    'dropzone_info' => 'Du kan också släppa din bild här för att ladda upp',
                    'restriction_info' => "Uppladdning tillgängligt för <a href='".route('store.products.show', 'supporter-tag')."' target='_blank'>osu!supporters</a> endast",
                    'size_info' => 'Omslags storlek bör vara 2000x700',
                    'too_large' => 'Uppladdad bild är för stor.',
                    'unsupported_format' => 'Formatet stöds ej.',
                ],
            ],
        ],
        'extra' => [
            'followers' => '1 följare|:count följare',
            'unranked' => 'Inga senaste spel',

            'achievements' => [
                'title' => 'Prestationer',
                'achieved-on' => 'Uppnått :date',
            ],
            'beatmaps' => [
                'none' => 'Inga... än.',
                'title' => 'Beatmaps',

                'favourite' => [
                    'title' => 'Favoriserade Beatmaps (:count)',
                ],
                'graveyard' => [
                    'title' => 'Begravda Beatmaps (:count)',
                ],
                'ranked_and_approved' => [
                    'title' => 'Rankade & Godkända Beatmaps (:count)',
                ],
                'unranked' => [
                    'title' => 'Väntade Beatmaps (:count)',
                ],
            ],
            'historical' => [
                'empty' => 'Inga prestanda uppgifter. :(',
                'title' => 'Historisk',

                'most_played' => [
                    'count' => 'gånger spelade',
                    'title' => 'Mest Spelade Beatmaps',
                ],
                'recent_plays' => [
                    'accuracy' => 'precision: :percentage',
                    'title' => 'Senaste spel (24h)',
                ],
            ],
            'kudosu' => [
                'available' => 'Kudosu Tillängligt',
                'available_info' => 'Kudosu kan bli bytade mot kudosu stjärnor, vilket kommer hjälpa din beatmap att få mer uppmärksamhet. Detta är antalet kudosu du inte har bytt in än.',
                'recent_entries' => 'Nyligen Kudosu Historia',
                'title' => 'Kudosu!',
                'total' => 'Total Kudosu Intjänad',
                'total_info' => 'Baserad på hur mycket bidrag användaren har gjort till beatmap moderation. Se <a href="'.osu_url('user.kudosu').'">denna sida</a> för mer information.',

                'entry' => [
                    'amount' => ':amount kudosu',
                    'empty' => 'Denna användare har inte fått någon kudosu!',

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
            ],
            'me' => [
                'title' => 'jag!',
            ],
            'medals' => [
                'empty' => 'Denna användare har inte fått några än. ;_;',
                'title' => 'Medaljer',
            ],
            'recent_activity' => [
                'title' => 'Nyligen',
            ],
            'top_ranks' => [
                'best' => [
                    'title' => 'Bästa Prestanda',
                ],
                'empty' => 'Inga fantastiska precision uppgifter än. :(',
                'first' => [
                    'title' => 'Första Plats Ranker',
                ],
                'pp' => ':amountpp',
                'title' => 'Ranker',
                'weighted_pp' => 'vägd: :pp (:percentage)',
            ],
        ],
        'page' => [
            'description' => '<strong>jag!</strong> är en personlig anpassningsbar del på din profil sida.',
            'edit_big' => 'Redigera mig!',
            'placeholder' => 'Skriv sido innehåll här',
            'restriction_info' => "Du behöver vara en <a href='".route('store.products.show', 'supporter-tag')."' target='_blank'>osu!supporter</a> för att låsa upp denna funktion.",
        ],
        'rank' => [
            'country' => 'Land rank för :mode',
            'global' => 'Global rank för :mode',
        ],
        'stats' => [
            'hit_accuracy' => 'Träff Precision',
            'level' => 'Nivå :level',
            'maximum_combo' => 'Maximal Kombo',
            'play_count' => 'Antal Spel',
            'ranked_score' => 'Rankad Poäng',
            'replays_watched_by_others' => 'Repriser Sedda av Andra',
            'score_ranks' => 'Poäng Ranker',
            'total_hits' => 'Totala Träffar',
            'total_score' => 'Total Poäng',
        ],
    ],
    'status' => [
        'online' => 'Online',
        'offline' => 'Offline',
    ],
    'store' => [
        'saved' => 'Användare skapad',
    ],
    'verify' => [
        'title' => 'Konto Verifiering',
    ],
];
