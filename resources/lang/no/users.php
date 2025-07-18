<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'deleted' => '[slettet bruker]',

    'beatmapset_activities' => [
        'title' => ":user's Moddinghistorikk",
        'title_compact' => 'Modding',

        'discussions' => [
            'title_recent' => 'Nylige startede diskusjoner',
        ],

        'events' => [
            'title_recent' => 'Nylige hendelser',
        ],

        'posts' => [
            'title_recent' => 'Nylige innlegg',
        ],

        'votes_received' => [
            'title_most' => 'Mest oppstemt på (de siste 3 månedene)',
        ],

        'votes_made' => [
            'title_most' => 'Mest oppstemt (siste 3 måneder)',
        ],
    ],

    'blocks' => [
        'banner_text' => 'Du har blokkerte denne brukeren.',
        'comment_text' => 'Denne kommentaren er skjult.',
        'blocked_count' => 'blokkerte brukere (:count)',
        'hide_profile' => 'Skjul profil',
        'hide_comment' => 'skjul',
        'forum_post_text' => 'Dette innlegget er skjult.',
        'not_blocked' => 'Den brukeren er ikke blokkert.',
        'show_profile' => 'Vis profil',
        'show_comment' => 'vis',
        'too_many' => 'Maks antall blokkerte personer nådd.',
        'button' => [
            'block' => 'Blokker',
            'unblock' => 'Fjern blokkering',
        ],
    ],

    'card' => [
        'gift_supporter' => 'Gi osu!supporter i gave',
        'loading' => 'Laster...',
        'send_message' => 'send melding',
    ],

    'create' => [
        'form' => [
            'password' => 'passord',
            'password_confirmation' => 'passord bekreftelse',
            'submit' => 'opprett konto',
            'user_email' => 'epost',
            'user_email_confirmation' => 'epostbekreftelse',
            'username' => 'brukernavn',

            'tos_notice' => [
                '_' => 'ved å opprette konto samtykker du til :link',
                'link' => 'vilkår for bruk',
            ],
        ],
    ],

    'disabled' => [
        'title' => 'Oops! Det ser ut som kontoen din er deaktivert.',
        'warning' => "I tilfelle du har brutt en regel, vær oppmerksom på at det vanligvis er en nedkjølingsperiode på en måned hvor vi ikke kommer til å vurdere noen amnestiforespørsler. Etter denne periodenm kan du fritt kontakte oss dersom du mener det er nødvendig. Vær oppmerksom på at å opprette nye kontoer etter du har hatt en allerede deaktivert vil resultere i enn <strong>utvidelse av denne en måneders nedkjølingsperioden</strong>. <strong>Du må også huske at med hver bruker du lager, bryter du reglene enda mer</strong>. Vi anbefaler på det sterkeste at du ikke gjør dette!",

        'if_mistake' => [
            '_' => 'Hvis du mener dette er en feil, er du velkommer til å kontakte oss (via :email eller med å klikke på "?" i nedre-høyre hjørne av denne siden). Vær oppmerksom på at vi alltid er helt sikre på hva vi gjør, fordi de er basert på svært solide data. Vi forbeholder oss retten til å ignorere din forespørsel bor vi føle at du er bevisst uærlig.',
            'email' => 'epost',
        ],

        'reasons' => [
            'compromised' => 'Kontoen din anses å være kompromittert. Den kan være midlertidig deaktivert mens identiteten er bekreftet.',
            'opening' => 'Det er flere grunner som kan resultere i at kontoen din er deaktivert:',

            'tos' => [
                '_' => 'Du har brutt en eller flere av våre :community_rules or :tos.',
                'community_rules' => 'samfunnsregler',
                'tos' => 'brukervilkår',
            ],
        ],
    ],

    'filtering' => [
        'by_game_mode' => 'Medlemmer etter spillmodus',
    ],

    'force_reactivation' => [
        'reason' => [
            'inactive' => "Kontoen din har ikke blitt brukt på lang tid.",
            'inactive_different_country' => "Kontoen din har ikke blitt brukt på lang tid.",
        ],
    ],

    'login' => [
        '_' => 'Logg inn',
        'button' => 'Logg inn',
        'button_posting' => 'Logger inn...',
        'email_login_disabled' => 'Innlogging med email er for tiden deaktivert. Vennligst bruk brukernavn i stedet.',
        'failed' => 'Feil innlogging',
        'forgot' => 'Glemt passordet ditt?',
        'info' => 'Vennligst logg inn for å fortsette',
        'invalid_captcha' => 'For mange mislykkede innloggingsforsøk, fullfør captcha og prøv på nytt. (Oppdater siden hvis captcha ikke er synlig)',
        'locked_ip' => 'IP-adressen din er blokkert. Vennligst vent et par minutter.',
        'password' => 'Passord',
        'register' => "Har du ikke en osu!-konto? Lag en ny en",
        'remember' => 'Husk denne datamaskinen',
        'title' => 'Vennligst logg inn for å fortsette',
        'username' => 'Brukernavn',

        'beta' => [
            'main' => 'Tilgang til beta er for øyeblikket begrenset til privilegerte brukere.',
            'small' => '(osu!supportere vil komme inn snart)',
        ],
    ],

    'ogp' => [
        'modding_description' => 'Beatmaps: :counts',
        'modding_description_empty' => 'Brukeren har ikke noen beatmaps...',

        'description' => [
            '_' => 'Rang (:ruleset): :global | :country',
            'country' => 'Landsrangering :rank',
            'global' => 'Global :rank',
        ],
    ],

    'posts' => [
        'title' => 'Innleggene til :username',
    ],

    'anonymous' => [
        'login_link' => 'klikk for å logge inn',
        'login_text' => 'logg inn',
        'username' => 'Gjest',
        'error' => 'Du må være innlogget for å gjøre dette.',
    ],
    'logout_confirm' => 'Er du sikker på at du vil logge ut? :(',
    'report' => [
        'button_text' => 'Rapporter',
        'comments' => 'Ytterlige Kommentarer',
        'placeholder' => 'Vennligst angi hva som helst av informasjon som du tror kan være nyttig.',
        'reason' => 'Årsak',
        'thanks' => 'Takk for din anmeldelse!',
        'title' => 'Rapporter :username?',

        'actions' => [
            'send' => 'Send Anmeldelse',
            'cancel' => 'Avbryt',
        ],

        'options' => [
            'cheating' => 'Juksing',
            'inappropriate_chat' => 'Upassende chat atferd',
            'insults' => 'Fornærmer meg / andre',
            'multiple_accounts' => 'Bruker flere kontoer',
            'nonsense' => 'Tull',
            'other' => 'Annet (skriv under)',
            'spam' => 'Spamming',
            'unwanted_content' => 'Deling av upassende innhold',
        ],
    ],
    'restricted_banner' => [
        'title' => 'Kontoen din har blitt begrenset!',
        'message' => 'Mens du er begrenset vil du ikke være i stand til å samhandle med andre spillere, og poengresultatene dine vil kun være synlige for deg selv. Dette er vanligvis resultatet av en automatisert prosess og vil normalt bli hevet innen 24 timer. Hvis du ønsker å appellere begrensningen, vennligst <a href="mailto:accounts@ppy.sh">kontakt støtteteamet</a>.',
        'message_link' => 'Sjekk denne siden for å lære mer.',
    ],
    'show' => [
        'age' => ':age år gammel',
        'change_avatar' => 'endre profilbildet ditt!',
        'first_members' => 'Her siden begynnelsen',
        'is_developer' => 'osu!utvikler',
        'is_supporter' => 'osu!supporter',
        'joined_at' => 'Ble med :date',
        'lastvisit' => 'Sist sett :date',
        'lastvisit_online' => 'Pålogget for øyeblikket',
        'missingtext' => 'Du begikk muligens en skrivefeil! (eller så kan brukeren ha blitt utestengt)',
        'origin_country' => 'Fra :country',
        'previous_usernames' => 'tidligere kjent som',
        'plays_with' => 'Spiller med :devices',

        'comments_count' => [
            '_' => 'La ut :link',
            'count' => ':count_delimited kommentar|:count_delimited kommentarer',
        ],
        'cover' => [
            'to_0' => 'Skjul banner',
            'to_1' => 'Vis banner',
        ],
        'daily_challenge' => [
            'daily' => '',
            'daily_streak_best' => '',
            'daily_streak_current' => '',
            'playcount' => '',
            'title' => '',
            'top_10p_placements' => '',
            'top_50p_placements' => '',
            'weekly' => '',
            'weekly_streak_best' => '',
            'weekly_streak_current' => '',

            'unit' => [
                'day' => '',
                'week' => '',
            ],
        ],
        'edit' => [
            'cover' => [
                'button' => 'Endre profilbanner',
                'defaults_info' => 'Flere banneralternativer vil være tilgjengelige i framtiden',
                'holdover_remove_confirm' => "",
                'title' => '',

                'upload' => [
                    'broken_file' => 'Kunne ikke prosessere bildet. Verifiser opplastet bilde og prøv igjen.',
                    'button' => 'Last opp bilde',
                    'dropzone' => 'Slipp her for å laste opp',
                    'dropzone_info' => 'Du kan også slippe bildet ditt her for å laste det opp',
                    'size_info' => 'Størrelsen på banneret bør være 2400x620',
                    'too_large' => 'Den opplastede filen er for stor.',
                    'unsupported_format' => 'Formatet støttes ikke.',

                    'restriction_info' => [
                        '_' => 'Oppdatering er bare tilgjengelig for :link',
                        'link' => 'osu!supportere',
                    ],
                ],
            ],

            'default_playmode' => [
                'is_default_tooltip' => 'standard spillmodus',
                'set' => 'angi ::mode som standard spillmodus',
            ],

            'hue' => [
                'reset_no_supporter' => '',
                'title' => '',

                'supporter' => [
                    '_' => '',
                    'link' => '',
                ],
            ],
        ],

        'extra' => [
            'none' => 'ingen',
            'unranked' => 'Ingen nylige spill',

            'achievements' => [
                'achieved-on' => 'Oppnådd :date',
                'locked' => 'Låst',
                'title' => 'Prestasjoner',
            ],
            'beatmaps' => [
                'by_artist' => 'av :artist',
                'title' => 'Beatmaps',

                'favourite' => [
                    'title' => 'Favorittbeatmaps',
                ],
                'graveyard' => [
                    'title' => 'Gravlagte Beatmaps',
                ],
                'guest' => [
                    'title' => 'Gjestebidrag Beatmaps',
                ],
                'loved' => [
                    'title' => 'Elskede Beatmaps',
                ],
                'nominated' => [
                    'title' => 'Nominerte Rangerte Beatmaps',
                ],
                'pending' => [
                    'title' => 'Ventende Beatmaps',
                ],
                'ranked' => [
                    'title' => 'Rangerte & Godkjente Beatmaps',
                ],
            ],
            'discussions' => [
                'title' => 'Diskusjoner',
                'title_longer' => 'Nylige diskusjoner',
                'show_more' => 'se flere diskusjoner',
            ],
            'events' => [
                'title' => 'Hendelser',
                'title_longer' => 'Nylige Hendelser',
                'show_more' => 'se flere hendelser',
            ],
            'historical' => [
                'title' => 'Historikk',

                'monthly_playcounts' => [
                    'title' => 'Spillhistorikk',
                    'count_label' => 'Spillforsøk',
                ],
                'most_played' => [
                    'count' => 'antall forsøk',
                    'title' => 'Mest Spilte Beatmaps',
                ],
                'recent_plays' => [
                    'accuracy' => 'presisjon :percentage',
                    'title' => 'Nylige spillforsøk (24t)',
                ],
                'replays_watched_counts' => [
                    'title' => 'Historikk For Repriser',
                    'count_label' => 'Repriser Sett',
                ],
            ],
            'kudosu' => [
                'recent_entries' => 'Nylig Kudosu Historie',
                'title' => 'Kudosu!',
                'total' => 'Total Kudosu Opptjent',

                'entry' => [
                    'amount' => ':amount kudosu',
                    'empty' => "Denne brukeren har ikke mottatt noen kudosu!",

                    'beatmap_discussion' => [
                        'allow_kudosu' => [
                            'give' => 'Mottok :amount fra opphevelse av nektet kudosu i modding innlegget :post',
                        ],

                        'deny_kudosu' => [
                            'reset' => 'Nektet :amount fra modding innlegget i :post',
                        ],

                        'delete' => [
                            'reset' => 'Tapte :amount fra sletting av modding innlegget i :post',
                        ],

                        'restore' => [
                            'give' => 'Mottok :amount fra gjenopprettelse av modding innlegget i :post',
                        ],

                        'vote' => [
                            'give' => 'Mottok :amount fra å få stemmer på modding innlegget i :post',
                            'reset' => 'Tapte :amount fra å miste stemmer på modding innlegget i :post',
                        ],

                        'recalculate' => [
                            'give' => 'Mottok :amount fra omberegning av stemmer i modding innlegget :post',
                            'reset' => 'Tapte :amount fra omberegning av stemmer i modding innlegget :post',
                        ],
                    ],

                    'forum_post' => [
                        'give' => 'Mottok :amount fra :giver for et innlegg i :post',
                        'reset' => 'Kudosu tilbakestilt av :giver for innlegget i :post',
                        'revoke' => 'Nektet kudosu fra :giver for innlegget :post',
                    ],
                ],

                'total_info' => [
                    '_' => 'Basert på hvor mye en bidro en bruker har gjort til beatmapmoderasjon. Se :link for mer informasjon.',
                    'link' => 'denne siden',
                ],
            ],
            'me' => [
                'title' => 'om meg!',
            ],
            'medals' => [
                'empty' => "Denne brukeren har ikke fått noen ennå. ;_;",
                'recent' => 'Nyeste',
                'title' => 'Medaljer',
            ],
            'playlists' => [
                'title' => 'Spilleliste runder',
            ],
            'posts' => [
                'title' => 'Innlegg',
                'title_longer' => 'Nylige Innlegg',
                'show_more' => 'se flere innlegg',
            ],
            'recent_activity' => [
                'title' => 'Nylige',
            ],
            'realtime' => [
                'title' => 'Flerspiller runder',
            ],
            'top_ranks' => [
                'download_replay' => 'Last ned Reprise',
                'not_ranked' => 'Bare rangerte beatmaps gir pp.',
                'pp_weight' => 'veid :percentage',
                'view_details' => 'Vis detaljer',
                'title' => 'Rangeringer',

                'best' => [
                    'title' => 'Beste Prestasjoner',
                ],
                'first' => [
                    'title' => 'Førsteplasser',
                ],
                'pin' => [
                    'to_0' => 'Løsne',
                    'to_0_done' => 'Løsnet score',
                    'to_1' => 'Fest',
                    'to_1_done' => 'Festet score',
                ],
                'pinned' => [
                    'title' => 'Festet Scores',
                ],
            ],
            'votes' => [
                'given' => 'Stemmer Gitt (siste 3 måneder)',
                'received' => 'Stemmer Mottatt (siste 3 måneder)',
                'title' => 'Stemmer',
                'title_longer' => 'Nylige stemmer',
                'vote_count' => ':count_delimited stemme|:count_delimited stemmer',
            ],
            'account_standing' => [
                'title' => 'Kontostatus',
                'bad_standing' => "<strong>:username</strong> sin konto er ikke i god stand :(",
                'remaining_silence' => '<strong>:username</strong> vil kunne snakke igjen om :duration.',

                'recent_infringements' => [
                    'title' => 'Nylige overtredelser',
                    'date' => 'dato',
                    'action' => 'handling',
                    'length' => 'lengde',
                    'length_indefinite' => 'Ubestemt',
                    'description' => 'beskrivelse',
                    'actor' => 'av :username',

                    'actions' => [
                        'restriction' => 'Utestengelse',
                        'silence' => 'Forstummet',
                        'tournament_ban' => 'Turneringshenvisning',
                        'note' => 'Merknad',
                    ],
                ],
            ],
        ],

        'info' => [
            'discord' => '',
            'interests' => 'Interesser',
            'location' => 'Nåværende Plassering',
            'occupation' => 'Yrke',
            'twitter' => '',
            'website' => 'Nettside',
        ],
        'not_found' => [
            'reason_1' => 'De kan ha endret brukernavnet sitt.',
            'reason_2' => 'Kontoen kan være midlertidig utilgjengelig på grunn av sikkerhetsproblemer eller misbruk.',
            'reason_3' => 'Du kan ha gjort en skrivefeil!',
            'reason_header' => 'Det er noen få mulige grunner til dette:',
            'title' => 'Bruker ble ikke funnet! ;_;',
        ],
        'page' => [
            'button' => 'Rediger profil',
            'description' => '<strong>me!</strong> er et personlig egendefinerbart område på profilsiden din.',
            'edit_big' => 'Rediger "om meg!"',
            'placeholder' => 'Skriv sideinnhold her',

            'restriction_info' => [
                '_' => 'Du må være en :link for å låse opp denne funksjonen.',
                'link' => 'osu!supporter',
            ],
        ],
        'post_count' => [
            '_' => 'Bidratt med :link',
            'count' => ':count foruminnlegg|:count foruminnlegg',
        ],
        'rank' => [
            'country' => 'Landsrangering for :mode',
            'country_simple' => 'Landsrangering',
            'global' => 'Global rangering for :mode',
            'global_simple' => 'Global Rangering',
            'highest' => 'Høyeste rangering: :rank den :date',
        ],
        'season_stats' => [
            'division_top_percentage' => '',
            'total_score' => '',
        ],
        'stats' => [
            'hit_accuracy' => 'Presisjon',
            'hits_per_play' => '',
            'level' => 'Nivå :level',
            'level_progress' => 'Fremgang til neste nivå',
            'maximum_combo' => 'Maks kombo nådd',
            'medals' => 'Medaljer',
            'play_count' => 'Antall Spillforsøk',
            'play_time' => 'Total Spilletid',
            'ranked_score' => 'Rangert Poengsum',
            'replays_watched_by_others' => 'Repriser Sett av Andre',
            'score_ranks' => 'Poengsum Rangering',
            'total_hits' => 'Totale Treff',
            'total_score' => 'Samlet Poengsum',
            // modding stats
            'graveyard_beatmapset_count' => 'Gravlagte Beatmaps',
            'loved_beatmapset_count' => 'Elskede Beatmaps',
            'pending_beatmapset_count' => 'Ventende Beatmaps',
            'ranked_beatmapset_count' => 'Rangerte & Godkjente Beatmaps',
        ],
    ],

    'silenced_banner' => [
        'title' => 'Du er øyeblikkelig forstummet.',
        'message' => 'Noen handlinger kan være utilgjengelige.',
    ],

    'status' => [
        'all' => 'Alle',
        'online' => 'Tilkoblet',
        'offline' => 'Frakoblet',
    ],
    'store' => [
        'from_client' => 'vennligst registrer deg via spillklienten i stedet!',
        'from_web' => 'vennligst fullfør registrering på osu!-nettsiden',
        'saved' => 'Bruker opprettet',
    ],
    'verify' => [
        'title' => 'Kontobekreftelse',
    ],

    'view_mode' => [
        'brick' => 'Blokk-visning',
        'card' => 'Bilde-visning',
        'list' => 'Listevisning',
    ],
];
