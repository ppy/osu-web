<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'deleted' => '[raderad användare]',

    'beatmapset_activities' => [
        'title' => ":users moddinghistorik",
        'title_compact' => 'Modding',

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
            'block' => 'Blockera',
            'unblock' => 'Avblockera',
        ],
    ],

    'card' => [
        'loading' => 'Laddar...',
        'send_message' => 'skicka meddelande',
    ],

    'disabled' => [
        'title' => 'Hoppsan! Det verkar som att ditt konto har inaktiverats.',
        'warning' => "Om du har brutit mot en regel, vänligen notera att det generellt finns en cool-down-period á en månad under vilken vi inte kommer att överväga några amnestiförfrågningar. Efter denna period är du välkommen att kontakta oss om du anser det nödvändigt. Vänligen notera att skapandet av nya konton efter att du haft ett inaktiverat kommer att resultera i en <strong>förlängning av denna en månads cool-down</strong>. Vänligen notera även att för <strong>varje konto du skapar, bryter du mot reglerna ytterligare</strong>. Vi rekommenderar starkt att du inte tar denna vägen!",

        'if_mistake' => [
            '_' => 'Om du upplever att detta är ett misstag, är du välkommen att kontakta oss (via :email eller genom att klicka "?" i det nedre högra hörnet av denna sida). Vänligen notera att vi alltid är helt säkra i våra ageranden, då de är baserade på mycket pålitlig data. Vi förbehåller oss rätten att bortse från din förfrågan om vi upplever att du avsiktligen är oärlig. ',
            'email' => 'email',
        ],

        'reasons' => [
            'compromised' => 'Ditt konto har bedömts vara infiltrerat. Det kan inaktiveras tillfälligt medan dess identitet bekräftas. ',
            'opening' => 'Det finns ett antal skäl som kan leda till att ditt konto inaktiveras:',

            'tos' => [
                '_' => 'Du har brutit mot en eller flera av våra :community_rules eller :tos. ',
                'community_rules' => 'gemenskapsregler',
                'tos' => 'användarvillkor',
            ],
        ],
    ],

    'filtering' => [
        'by_game_mode' => 'Medlemmar efter spelläge',
    ],

    'force_reactivation' => [
        'reason' => [
            'inactive_different_country' => "Ditt konto har inte använts på länge.",
        ],
    ],

    'login' => [
        '_' => 'Logga in',
        'button' => 'Logga in',
        'button_posting' => 'Loggar in...',
        'email_login_disabled' => 'Inloggning med email är för närvarande inaktiverat. Vänligen använd användarnamn istället. ',
        'failed' => 'Felaktig inloggning',
        'forgot' => 'Glömt ditt lösenord?',
        'info' => 'Vänligen logga in för att fortsätta',
        'invalid_captcha' => 'För många misslyckade inloggningsförsök, var vänlig fyll i captcha och försök igen. (Uppdatera sidan om captcha inte är synlig)',
        'locked_ip' => 'din IP-adress är låst. Var vänlig vänta några minuter.',
        'password' => 'Lösenord',
        'register' => "Har du inget osu! konto? Skapa ett nytt",
        'remember' => 'Kom ihåg denna dator',
        'title' => 'Var vänlig logga in för att fortsätta',
        'username' => 'Användarnamn',

        'beta' => [
            'main' => 'Beta-åtkomst är för nuvarande begränsad till privilegierade användare.',
            'small' => '(osu!supportrar kommer att komma in snart)',
        ],
    ],

    'posts' => [
        'title' => ':usernames inlägg',
    ],

    'anonymous' => [
        'login_link' => 'klicka för att logga in',
        'login_text' => 'logga in',
        'username' => 'Gäst',
        'error' => 'Du behöver vara inloggad för att göra detta.',
    ],
    'logout_confirm' => 'Är du säker på att du vill logga ut? :(',
    'report' => [
        'button_text' => 'Anmäl',
        'comments' => 'Ytterligare kommentarer',
        'placeholder' => 'Var snäll och lämna all information som du tror kan vara användbar.',
        'reason' => 'Orsak',
        'thanks' => 'Tack för din anmälan!',
        'title' => 'Anmäl :username?',

        'actions' => [
            'send' => 'Skicka anmälan',
            'cancel' => 'Avbryt',
        ],

        'options' => [
            'cheating' => 'Fusk',
            'multiple_accounts' => 'Använder flera konton',
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
        'change_avatar' => 'byt din avatar!',
        'first_members' => 'Här sedan början',
        'is_developer' => 'osu!developer',
        'is_supporter' => 'osu!supporter',
        'joined_at' => 'Gick med :date',
        'lastvisit' => 'Senast sedd :date',
        'lastvisit_online' => 'Online just nu',
        'missingtext' => 'Du kanske har stavat fel! (eller så är användaren bannlyst)',
        'origin_country' => 'Från :country',
        'previous_usernames' => 'tidigare känd som',
        'plays_with' => 'Spelar med :devices',
        'title' => ":usernames profil",

        'comments_count' => [
            '_' => 'Upplagd :link',
            'count' => ':count_delimited kommentar|:count_delimited kommentarer',
        ],
        'edit' => [
            'cover' => [
                'button' => 'Ändra Profilomslag',
                'defaults_info' => 'Fler omslagsalternativ kommer finnas i framtiden',
                'upload' => [
                    'broken_file' => 'Misslyckades med att processa bilden. Verifiera uppladdad bild och försök igen.',
                    'button' => 'Ladda upp bild',
                    'dropzone' => 'Släpp här för att ladda upp den',
                    'dropzone_info' => 'Du kan också släppa din bild här för att ladda upp den',
                    'size_info' => 'Omslagets storlek bör vara 2400x620',
                    'too_large' => 'Den uppladdade filen är för stor.',
                    'unsupported_format' => 'Formatet stöds ej.',

                    'restriction_info' => [
                        '_' => 'Uppladdning tillgänglig för :link enbart',
                        'link' => 'osu!supportrar',
                    ],
                ],
            ],

            'default_playmode' => [
                'is_default_tooltip' => 'standardspelläge',
                'set' => 'sätt :mode som profilens förvalda spelläge',
            ],
        ],

        'extra' => [
            'none' => 'ingen',
            'unranked' => 'Inga senaste spel',

            'achievements' => [
                'achieved-on' => 'Uppnått :date',
                'locked' => 'Låst',
                'title' => 'Prestationer',
            ],
            'beatmaps' => [
                'by_artist' => 'av :artist',
                'title' => 'Beatmaps',

                'favourite' => [
                    'title' => 'Favoritmarkerade beatmaps',
                ],
                'graveyard' => [
                    'title' => 'Beatmaps på kyrkogården',
                ],
                'loved' => [
                    'title' => 'Älskade beatmaps',
                ],
                'pending' => [
                    'title' => 'Väntande beatmaps',
                ],
                'ranked' => [
                    'title' => 'Rankade & godkända beatmaps',
                ],
            ],
            'discussions' => [
                'title' => 'Diskussioner',
                'title_longer' => 'Senaste diskussionerna',
                'show_more' => 'se fler diskussioner',
            ],
            'events' => [
                'title' => 'Händelser',
                'title_longer' => 'Senaste händelser',
                'show_more' => 'se fler händelser',
            ],
            'historical' => [
                'title' => 'Historiskt',

                'monthly_playcounts' => [
                    'title' => 'Spelhistorik',
                    'count_label' => 'Spelningar',
                ],
                'most_played' => [
                    'count' => 'gånger spelade',
                    'title' => 'Mest spelade beatmaps',
                ],
                'recent_plays' => [
                    'accuracy' => 'träffsäkerhet: :percentage',
                    'title' => 'Senaste spel (24t)',
                ],
                'replays_watched_counts' => [
                    'title' => 'Repriser sedda av andra',
                    'count_label' => 'Repriser sedda',
                ],
            ],
            'kudosu' => [
                'recent_entries' => 'Senaste Kudosu-historik',
                'title' => 'Kudosu!',
                'total' => 'Total Kudosu intjänad',

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
                    '_' => 'Baserat på hur mycket användaren har bidragit till beatmapmodding. Se :link för mer information. ',
                    'link' => 'denna sida',
                ],
            ],
            'me' => [
                'title' => 'jag!',
            ],
            'medals' => [
                'empty' => "Denna användare har inte fått några än. ;_;",
                'recent' => 'Senaste',
                'title' => 'Medaljer',
            ],
            'multiplayer' => [
                'title' => 'Flerspelarspel',
            ],
            'posts' => [
                'title' => 'Inlägg',
                'title_longer' => 'Senaste Inläggen',
                'show_more' => 'se fler inlägg',
            ],
            'recent_activity' => [
                'title' => 'Senaste',
            ],
            'top_ranks' => [
                'download_replay' => 'Ladda ner Repris',
                'not_ranked' => 'Endast rankade beatmaps ger pp.',
                'pp_weight' => 'vägd :percentage',
                'view_details' => 'Se Detaljer',
                'title' => 'Ranker',

                'best' => [
                    'title' => 'Bästa Prestation',
                ],
                'first' => [
                    'title' => 'Förstaplats-ranker',
                ],
            ],
            'votes' => [
                'given' => 'Röster Givna (senaste 3 månaderna)',
                'received' => 'Röster Erhållna (senaste 3 månaderna)',
                'title' => 'Röster',
                'title_longer' => 'Senaste röster',
                'vote_count' => ':count_delimited röst|:count_delimited röster ',
            ],
            'account_standing' => [
                'title' => 'Kontoställning',
                'bad_standing' => "<strong>:username's</strong> konto är inte i en bra ställning :(",
                'remaining_silence' => '<strong>:username</strong> kan prata igen om :duration.',

                'recent_infringements' => [
                    'title' => 'Senaste överträdelser',
                    'date' => 'datum',
                    'action' => 'åtgärd',
                    'length' => 'längd',
                    'length_permanent' => 'Permanent',
                    'description' => 'beskrivning',
                    'actor' => 'efter :användarnamn',

                    'actions' => [
                        'restriction' => 'Bannlys',
                        'silence' => 'Tystad',
                        'note' => 'Anteckning',
                    ],
                ],
            ],
        ],

        'info' => [
            'discord' => '',
            'interests' => 'Intressen',
            'location' => 'Nuvarande plats',
            'occupation' => 'Sysselsättning',
            'twitter' => '',
            'website' => 'Hemsida',
        ],
        'not_found' => [
            'reason_1' => 'De kan ha ändrat sitt användarnamn.',
            'reason_2' => 'Kontot kan för tillfället vara otillgängligt på grund av säkerhets- eller missbruksproblem.',
            'reason_3' => 'Du kan ha gjort ett stavfel!',
            'reason_header' => 'Det finns några möjliga orsaker till detta:',
            'title' => 'Användaren hittades inte! ;_;',
        ],
        'page' => [
            'button' => 'Redigera profilsida',
            'description' => '<strong>jag!</strong> är en personlig anpassningsbar del på din profil sida.',
            'edit_big' => 'Redigera jag!',
            'placeholder' => 'Skriv sidoinnehåll här',

            'restriction_info' => [
                '_' => 'Du måste vara en :link för att låsa upp den här funktionen.',
                'link' => 'osu!supporter',
            ],
        ],
        'post_count' => [
            '_' => 'Bidragit med :link',
            'count' => ':count foruminlägg|:count foruminlägg',
        ],
        'rank' => [
            'country' => 'Nationell rankning för :mode',
            'country_simple' => 'Nationell rankning',
            'global' => 'Global rank för :mode',
            'global_simple' => 'Global rankning',
        ],
        'stats' => [
            'hit_accuracy' => 'Träffsäkerhet',
            'level' => 'Nivå :level',
            'level_progress' => 'Framsteg till nästa nivå',
            'maximum_combo' => 'Maximal Kombo',
            'medals' => 'Medaljer',
            'play_count' => 'Antal gånger spelat',
            'play_time' => 'Total speltid',
            'ranked_score' => 'Rankad Poäng',
            'replays_watched_by_others' => 'Repriser sedda av andra',
            'score_ranks' => 'Poängranker',
            'total_hits' => 'Totala träffar',
            'total_score' => 'Total poäng',
            // modding stats
            'graveyard_beatmapset_count' => 'Beatmaps på kyrkogården',
            'loved_beatmapset_count' => 'Älskade beatmaps',
            'pending_beatmapset_count' => 'Väntande beatmaps',
            'ranked_beatmapset_count' => 'Rankade & godkända beatmaps',
        ],
    ],

    'silenced_banner' => [
        'title' => 'Du är för närvarande tystad.',
        'message' => 'Vissa åtgärder kan vara otillgängliga.',
    ],

    'status' => [
        'all' => 'Alla',
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
        'brick' => 'Tegelvy',
        'card' => 'Kortvy',
        'list' => 'Listvy',
    ],
];
