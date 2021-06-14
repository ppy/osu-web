<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'deleted' => '[slettet bruger]',

    'beatmapset_activities' => [
        'title' => ":user's Modding Historie",
        'title_compact' => 'Modding',

        'discussions' => [
            'title_recent' => 'Senest startede diskussioner',
        ],

        'events' => [
            'title_recent' => 'Seneste begivenheder',
        ],

        'posts' => [
            'title_recent' => 'Seneste opslag',
        ],

        'votes_received' => [
            'title_most' => '>Mest stemt på af (over de sidste 3 måneder)',
        ],

        'votes_made' => [
            'title_most' => '>Mest stemt på (over de sidste 3 måneder)',
        ],
    ],

    'blocks' => [
        'banner_text' => 'Du har blokeret denne bruger.',
        'blocked_count' => 'blokerede brugere (:count)',
        'hide_profile' => 'Skjul profil',
        'not_blocked' => 'Denne bruger er ikke blokeret.',
        'show_profile' => 'Vis profil',
        'too_many' => 'Blokeringsgrænsen er nået.',
        'button' => [
            'block' => 'Bloker',
            'unblock' => 'Fjern blokering',
        ],
    ],

    'card' => [
        'loading' => 'Indlæser...',
        'send_message' => 'Send besked',
    ],

    'disabled' => [
        'title' => 'Uh-oh! Det ser ud som om din account er blevet midlertidigt lukket.',
        'warning' => "I tilfælde af at du har brudt en regel, bør du vide at der er en cool-down periode på en måned hvori vi ikke vil overveje nogen former for forespørgsler om lempelser eller ophævninger. Efter denne periode kan du kontakte os igen hvis du føler det er nødvendigt. Bemærk, hvis du laver flere konti efter at have fået en lukket vil det resultere i en <strong>forlængelse af din ene måneds cool-down</strong>. Bemærk også at for <strong>hver account du laver, bryder du reglerne yderligere</strong>. Vi anbefaler stærkt at du ikke gør dette!",

        'if_mistake' => [
            '_' => 'Hvis du føler at dette var en fejltagelse er du velkommen til at kontakte os (via :email eller ved at klike på "?" i hjørnet nederst til højre). Bemærk venligst at vi altid har fuld tillid til vores handlinger da de er baseret på solidt data. Vi reserverer retten til at se bort fra din anmodning skulle vi føle at du handler i dårlig ånd eller er uærlig.',
            'email' => 'email',
        ],

        'reasons' => [
            'compromised' => 'Din account synes at være blevet infiltreret. Den kan muligvis være blevet midlertidigt lukket mens ejerens identitet bekræftes.',
            'opening' => 'Der er en række grunde til at din accoung can blive midlertidigt lukket:',

            'tos' => [
                '_' => 'Du har brudt en eller flere af vores :community_rules eller :tos.',
                'community_rules' => 'fællesskabs-regler',
                'tos' => 'tjenestevilkår',
            ],
        ],
    ],

    'filtering' => [
        'by_game_mode' => 'Medlemmer efter spiltilstand',
    ],

    'force_reactivation' => [
        'reason' => [
            'inactive_different_country' => "Din account har ikke været i brug i lang tid.",
        ],
    ],

    'login' => [
        '_' => 'Log ind',
        'button' => 'Log Ind',
        'button_posting' => 'Logger ind...',
        'email_login_disabled' => 'Login via email er i øjeblikket deaktiveret. Brug venligst dit brugernavn i stedet.',
        'failed' => 'Ugyldigt login',
        'forgot' => 'Glemt din adgangskode?',
        'info' => 'Log ind for at fortsætte',
        'invalid_captcha' => 'For mange mislykkede loginforsøg. Udfyld venligst captcha og prøv igen. (Opdater side, hvis captcha ikke er synlig)',
        'locked_ip' => 'din IP-adresse er låst. Vent venligst et par minutter.',
        'password' => 'Adgangskode',
        'register' => "Har du ikke en osu! konto? Opret en ny én!",
        'remember' => 'Husk denne computer',
        'title' => 'Log venligst ind for at fortsætte',
        'username' => 'Brugernavn',

        'beta' => [
            'main' => 'Adgang til betaversionen er i øjeblikket begrænset til priveligerede brugere.',
            'small' => '(osu!supportere ville kunne komme ind snart)',
        ],
    ],

    'posts' => [
        'title' => ':username\'s opslag',
    ],

    'anonymous' => [
        'login_link' => 'klik for at logge ind',
        'login_text' => 'log ind',
        'username' => 'Gæst',
        'error' => 'Du skal være logget ind for at gøre dette.',
    ],
    'logout_confirm' => 'Er du sikker på, at du vil logge ud? :(',
    'report' => [
        'button_text' => 'Anmeld',
        'comments' => 'Yderligere Kommentarer',
        'placeholder' => 'Vær venlig at tilføje alle informationer du tror vil kunne være nyttige.',
        'reason' => 'Begrundelse',
        'thanks' => 'Tak for din anmeldelse!',
        'title' => 'Anmeld :username?',

        'actions' => [
            'send' => 'Send anmeldelse',
            'cancel' => 'Annullér',
        ],

        'options' => [
            'cheating' => 'Uærligt spil / Snyd',
            'insults' => 'Fornærmede mig / andre',
            'spam' => 'Spamming',
            'unwanted_content' => 'Sender links med upassende indhold',
            'nonsense' => 'Nonsens',
            'other' => 'Andet (Skriv under)',
        ],
    ],
    'restricted_banner' => [
        'title' => 'Du konto er blevet begrænset!',
        'message' => 'Når du er begrænset, kan du ikke interagere med andre spillere, og dine scores vil kun være synlige for dig. Dette er som regel en automatisk proces, og begrænsningen vil blive fjernet indenfor 24 timer. Hvis du ønsker at appellere din begrænsning, <a href="mailto:accounts@ppy.sh">kontakt supporten</a>.',
    ],
    'show' => [
        'age' => ':age år gammel',
        'change_avatar' => 'ændre din avatar!',
        'first_members' => 'Var her fra starten',
        'is_developer' => 'osu!developer',
        'is_supporter' => 'osu!supporter',
        'joined_at' => 'Blev medlem :date',
        'lastvisit' => 'Sidst set :date',
        'lastvisit_online' => 'Online nu',
        'missingtext' => 'Du har formentlig lavet en stavefejl! (eller også er brugeren blevet bannet)',
        'origin_country' => 'Fra :country',
        'previous_usernames' => 'tidligere kendt som',
        'plays_with' => 'Spiller med :devices',
        'title' => ":username´s profil",

        'comments_count' => [
            '_' => 'Slået op :link',
            'count' => ':count_delimited kommentar|:count_delimited kommentarer',
        ],
        'edit' => [
            'cover' => [
                'button' => 'Skift Coverbillede',
                'defaults_info' => 'Flere muligheder for coverbillede kommer snart',
                'upload' => [
                    'broken_file' => 'Kunne ikke uploade billedet. Prøv igen.',
                    'button' => 'Upload billede',
                    'dropzone' => 'Smid her for at uploade',
                    'dropzone_info' => 'Du kan også smide dit billede her for at uploade',
                    'size_info' => 'Coverbilledet burde være 2400x620',
                    'too_large' => 'Den uploadede fil er for stor.',
                    'unsupported_format' => 'Ikke-understøttet format.',

                    'restriction_info' => [
                        '_' => 'Upload er kun tilgængelig for :link',
                        'link' => 'osu!supporters',
                    ],
                ],
            ],

            'default_playmode' => [
                'is_default_tooltip' => 'standardspiltilstand',
                'set' => 'sæt :mode som din default mode',
            ],
        ],

        'extra' => [
            'none' => 'ingen',
            'unranked' => 'Ingen beatmaps spillet for nyligt',

            'achievements' => [
                'achieved-on' => 'Opnået den :date',
                'locked' => 'Låst',
                'title' => 'Præstationer',
            ],
            'beatmaps' => [
                'by_artist' => 'af :artist',
                'title' => 'Beatmaps',

                'favourite' => [
                    'title' => 'Favorit Beatmaps',
                ],
                'graveyard' => [
                    'title' => 'Beatmaps på Kirkegården',
                ],
                'loved' => [
                    'title' => 'Elskede beatmaps',
                ],
                'pending' => [
                    'title' => '',
                ],
                'ranked' => [
                    'title' => '',
                ],
            ],
            'discussions' => [
                'title' => 'Diskussioner',
                'title_longer' => 'Seneste Diskussioner',
                'show_more' => 'se flere diskussioner',
            ],
            'events' => [
                'title' => 'Begivenheder',
                'title_longer' => 'Seneste Begivenheder',
                'show_more' => 'se flere begivenheder',
            ],
            'historical' => [
                'title' => 'Historik',

                'monthly_playcounts' => [
                    'title' => 'Spille-historik',
                    'count_label' => 'Plays',
                ],
                'most_played' => [
                    'count' => 'gange spillet',
                    'title' => 'Mest Spillede Beatmaps',
                ],
                'recent_plays' => [
                    'accuracy' => 'præcision: :percentage',
                    'title' => 'Senest spillet (24 timer)',
                ],
                'replays_watched_counts' => [
                    'title' => 'Replays Set Historik',
                    'count_label' => 'Replays Set',
                ],
            ],
            'kudosu' => [
                'recent_entries' => 'Seneste Kudosu Historie',
                'title' => 'Kudosu!',
                'total' => 'Total Kudosu Optjent',

                'entry' => [
                    'amount' => ':amount kudosu',
                    'empty' => "Denne bruger har ikke modtaget nogen kudosu!",

                    'beatmap_discussion' => [
                        'allow_kudosu' => [
                            'give' => 'Modtog :amount fra kudosu benægtelsesophævelse af modding opslaget :post',
                        ],

                        'deny_kudosu' => [
                            'reset' => 'Benægtet :amount fra modding opslaget :post',
                        ],

                        'delete' => [
                            'reset' => 'Mistede :amount fra sletning af modding opslag :post',
                        ],

                        'restore' => [
                            'give' => 'Modtog :amount fra modding opslag genetablering af :post',
                        ],

                        'vote' => [
                            'give' => 'Modtog :amount fra at få stemmer på modding opslaget :post',
                            'reset' => 'Mistede :amount fra at miste stemmer på modding opslaget :post',
                        ],

                        'recalculate' => [
                            'give' => 'Modtog :amount fra genberegning af stemmer i modding opslaget :post',
                            'reset' => 'Mistede :amount fra genberegning af stemmer i modding opslaget :post',
                        ],
                    ],

                    'forum_post' => [
                        'give' => 'Modtog :amount fra :giver for opslaget :post',
                        'reset' => 'Kudosu nulstillet af :giver for opslaget :post',
                        'revoke' => 'Benægtet kudosu af :giver for opslaget :post',
                    ],
                ],

                'total_info' => [
                    '_' => 'Baseret på hvor stort et bidrag brugeren har givet til moderation af beatmaps. Se :link for mere information.',
                    'link' => 'denne side',
                ],
            ],
            'me' => [
                'title' => 'me!',
            ],
            'medals' => [
                'empty' => "Denne bruger har ikke fået nogle endnu. ;_;",
                'recent' => 'Seneste',
                'title' => 'Medaljer',
            ],
            'posts' => [
                'title' => 'Opslag',
                'title_longer' => 'Seneste Opslag',
                'show_more' => 'se flere opslag',
            ],
            'recent_activity' => [
                'title' => 'Seneste',
            ],
            'top_ranks' => [
                'download_replay' => 'Download Replay',
                'not_ranked' => 'Kun rangerede beatmaps giver pp.',
                'pp_weight' => 'vejede: :percentage',
                'view_details' => 'Vis detaljer',
                'title' => 'Ranks',

                'best' => [
                    'title' => 'Bedste Præstationer',
                ],
                'first' => [
                    'title' => 'Førstepladser',
                ],
            ],
            'votes' => [
                'given' => 'Stemmer Givet (sidste 3 måneder)',
                'received' => 'Stemmer Modtaget (sidste 3 måneder)',
                'title' => 'Stemmer',
                'title_longer' => 'Seneste Stemmer',
                'vote_count' => ':count_delimited stemme|:count_delimited stemmer',
            ],
            'account_standing' => [
                'title' => 'Account Status',
                'bad_standing' => "<strong>:username's</strong> account er ikke i en god position :(",
                'remaining_silence' => '<strong>:username</strong> kan tale igen om :duration.',

                'recent_infringements' => [
                    'title' => 'Seneste Overtrædelser',
                    'date' => 'dato',
                    'action' => 'handling',
                    'length' => 'længde',
                    'length_permanent' => 'Permanent',
                    'description' => 'beskrivelse',
                    'actor' => 'af :username',

                    'actions' => [
                        'restriction' => 'Ban',
                        'silence' => 'Mute',
                        'note' => 'Noter',
                    ],
                ],
            ],
        ],

        'info' => [
            'discord' => '',
            'interests' => 'Interesser',
            'location' => 'Nuværende Position',
            'occupation' => 'Stilling',
            'twitter' => '',
            'website' => 'Hjemmeside',
        ],
        'not_found' => [
            'reason_1' => 'De kan have ændret deres brugernavn.',
            'reason_2' => 'Kontoen kan være midlertidigt utilgængelig pga. sikkerhedsproblemer eller misbrug.',
            'reason_3' => 'Du har muligvis lavet en stavefejl!',
            'reason_header' => 'Der er et par mulige årsager til dette:',
            'title' => 'Bruger ikke fundet! ;_;',
        ],
        'page' => [
            'button' => 'Rediger profil',
            'description' => '<strong>me!</strong> er et brugerdefinerbart felt på din profil.',
            'edit_big' => 'Ændr mig!',
            'placeholder' => 'Skriv indhold her',

            'restriction_info' => [
                '_' => 'Du skal være en :link for at bruge denne funktion.',
                'link' => 'osu!supporter',
            ],
        ],
        'post_count' => [
            '_' => 'Skrevet :link',
            'count' => ':count_delimited forum opslag|:count_delimited forum opslag',
        ],
        'rank' => [
            'country' => 'Lande Rang for :mode',
            'country_simple' => 'Lande Rang',
            'global' => 'Global rang for :mode',
            'global_simple' => 'Global Rang',
        ],
        'stats' => [
            'hit_accuracy' => 'Præcision',
            'level' => 'Level :level',
            'level_progress' => 'Progression til næste level',
            'maximum_combo' => 'Højeste Combo',
            'medals' => 'Medaljer',
            'play_count' => 'Antal Forsøg',
            'play_time' => 'Total Spilletid',
            'ranked_score' => 'Ranked Score',
            'replays_watched_by_others' => 'Replays Set af Andre',
            'score_ranks' => 'Score Ranks',
            'total_hits' => 'Totale Hits',
            'total_score' => 'Total Score',
            // modding stats
            'graveyard_beatmapset_count' => 'Beatmaps på Kirkegården',
            'loved_beatmapset_count' => 'Elskede Beatmaps',
            'pending_beatmapset_count' => '',
            'ranked_beatmapset_count' => '',
        ],
    ],

    'silenced_banner' => [
        'title' => 'Du er i øjeblikket gjort tavs.',
        'message' => 'Nogle handlinger kan være utilgængelige.',
    ],

    'status' => [
        'all' => 'Alle',
        'online' => 'Online',
        'offline' => 'Offline',
    ],
    'store' => [
        'saved' => 'Bruger Oprettet',
    ],
    'verify' => [
        'title' => 'Kontobekræftelse',
    ],

    'view_mode' => [
        'brick' => 'Klods visning',
        'card' => 'Kortvisning',
        'list' => 'Listevisning',
    ],
];
