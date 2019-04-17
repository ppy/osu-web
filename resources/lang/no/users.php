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
            'title_most' => 'Mest stemt på (siste 3 måneder)',
        ],

        'votes_made' => [
            'title_most' => 'Mest oppstemt (siste 3 måneder)',
        ],
    ],

    'blocks' => [
        'banner_text' => 'Du har blokkerte denne brukeren.',
        'blocked_count' => 'blokkerte brukere (:count)',
        'hide_profile' => 'skjul profil',
        'not_blocked' => 'Den brukeren er ikke blokkert.',
        'show_profile' => 'vis profil',
        'too_many' => 'Maks antall blokkerte personer nådd.',
        'button' => [
            'block' => 'blokker',
            'unblock' => 'fjern blokkering',
        ],
    ],

    'card' => [
        'loading' => 'Laster...',
        'send_message' => 'send melding',
    ],

    'login' => [
        '_' => 'Logg på',
        'locked_ip' => 'IP-adressen din er blokkert. Vennligst vent et par minutter.',
        'username' => 'Brukernavn',
        'password' => 'Passord',
        'button' => 'Logg på',
        'button_posting' => 'Logger inn...',
        'remember' => 'Husk denne datamaskinen',
        'title' => 'Vennligst logg inn for å fortsette',
        'failed' => 'Feil innlogging',
        'register' => "Har du ikke en osu!-konto? Lag en ny en",
        'forgot' => 'Glemt passordet ditt?',
        'beta' => [
            'main' => 'Tilgang til beta er for øyeblikket begrenset til privilegerte brukere.',
            'small' => '(osu!supportere vil komme inn snart)',
        ],

        'here' => 'her', // this is substituted in when generating a link above. change it to suit the language.
    ],

    'posts' => [
        'title' => 'Innleggene til :username',
    ],

    'signup' => [
        '_' => 'Registrer deg',
    ],
    'anonymous' => [
        'login_link' => 'klikk for å logge inn',
        'login_text' => 'logg inn',
        'username' => 'Gjest',
        'error' => 'Du må være innlogget for å gjøre dette.',
    ],
    'logout_confirm' => 'Er du sikker på at du vil logge ut? :(',
    'report' => [
        'button_text' => 'anmeld',
        'comments' => 'Ytterlige Kommentarer',
        'placeholder' => 'Vennligst angi hva som helst informasjon som du tror kan være nyttig.',
        'reason' => 'Årsak',
        'thanks' => 'Takk for din anmelding!',
        'title' => 'Anmeld :username?',

        'actions' => [
            'send' => 'Send Anmelding',
            'cancel' => 'Avbryt',
        ],

        'options' => [
            'cheating' => 'Lureri / Juks',
            'insults' => 'Fornærmer meg / andre',
            'spam' => 'Spamming',
            'unwanted_content' => 'Deling av upassende innhold',
            'nonsense' => 'Tull',
            'other' => 'Annet (skriv under)',
        ],
    ],
    'restricted_banner' => [
        'title' => 'Kontoen din har blitt begrenset!',
        'message' => 'Mens du er begrenset vil du ikke være i stand til å samhandle med andre spillere, og poengresultatene dine vil kun være synlige for deg selv. Dette er vanligvis resultatet av en automatisert prosess og vil normalt bli hevet innen 24 timer. Hvis du ønsker å appellere begrensningen, vennligst <a href="mailto:accounts@ppy.sh">kontakt støtteteamet</a>.',
    ],
    'show' => [
        'age' => ':age år gammel',
        'change_avatar' => 'endre profilbildet ditt!',
        'first_members' => 'Her siden begynnelsen',
        'is_developer' => 'osu!utvikler',
        'is_supporter' => 'osu!supporter',
        'joined_at' => 'Ble med :date',
        'lastvisit' => 'Sist sett :date',
        'missingtext' => 'Du begikk muligens en skrivefeil! (eller så kan brukeren ha blitt utestengt)',
        'origin_country' => 'Fra :country',
        'page_description' => 'osu! - Alt du noensinne måtte ønske å vite om :username!',
        'previous_usernames' => 'tidligere kjent som',
        'plays_with' => 'Spiller med :devices',
        'title' => "Profilen til :username",

        'edit' => [
            'cover' => [
                'button' => 'Endre profilbanner',
                'defaults_info' => 'Flere banneralternativer vil være tilgjengelige i framtiden',
                'upload' => [
                    'broken_file' => 'Kunne ikke prosessere bildet. Verifiser opplastet bilde og prøv igjen.',
                    'button' => 'Last opp bilde',
                    'dropzone' => 'Slipp her for å laste opp',
                    'dropzone_info' => 'Du kan også slippe bildet ditt her for å laste det opp',
                    'restriction_info' => "Opplasting er kun tilgjengelig for <a href='".route('store.products.show', 'supporter-tag')."' target='_blank'>osu!supportere</a>",
                    'size_info' => 'Størrelsen på banneret bør være 2800x620',
                    'too_large' => 'Den opplastede filen er for stor.',
                    'unsupported_format' => 'Formatet støttes ikke.',
                ],
            ],

            'default_playmode' => [
                'is_default_tooltip' => 'standard spillmodus',
                'set' => 'angi ::mode som standard spillmodus',
            ],
        ],

        'extra' => [
            'followers' => '1 følger|:count følgere',
            'unranked' => 'Ingen nylige spill',

            'achievements' => [
                'achieved-on' => 'Oppnådd :date',
                'locked' => 'Låst',
                'title' => 'Prestasjoner',
            ],
            'beatmaps' => [
                'by_artist' => 'av :artist',
                'none' => 'Ingen... ennå.',
                'title' => 'Beatmaps',

                'favourite' => [
                    'title' => 'Favorittbeatmaps',
                ],
                'graveyard' => [
                    'title' => 'Gravlagte Beatmaps',
                ],
                'loved' => [
                    'title' => 'Elskede Beatmaps',
                ],
                'ranked_and_approved' => [
                    'title' => 'Rangerte & Godkjente Beatmaps',
                ],
                'unranked' => [
                    'title' => 'Ventende Beatmaps',
                ],
            ],
            'historical' => [
                'empty' => 'Ingen prestasjoner :(',
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
                    'title' => 'Repriser Sett Historikk',
                    'count_label' => 'Repriser Sett',
                ],
            ],
            'kudosu' => [
                'available' => 'Kudosu Tilgjengelig',
                'available_info' => "Kudosu kan byttes for kudosustjerner, som kan hjelpe beatmappet ditt å få mer oppmerksomhet. Dette er antall kudosu som du ikke har byttet enda.",
                'recent_entries' => 'Nylig Kudosu Historie',
                'title' => 'Kudosu!',
                'total' => 'Total Kudosu Opptjent',
                'total_info' => 'Basert på hvor mange bidrag en bruker har gjort til beatmapmoderasjon. Se <a href="'.osu_url('user.kudosu').'">denne siden</a> for mer informasjon.',

                'entry' => [
                    'amount' => ':amount kudosu',
                    'empty' => "Denne brukeren har ikke mottatt noen kudosu!",

                    'beatmap_discussion' => [
                        'allow_kudosu' => [
                            'give' => 'Mottok :amount fra kudosu nekte opphevelse i modding innlegget :post',
                        ],

                        'deny_kudosu' => [
                            'reset' => 'Nektet :amount for moddinginnlegget :post',
                        ],

                        'delete' => [
                            'reset' => 'Tapte :amount fra sletting av moddinginnlegg i :post',
                        ],

                        'restore' => [
                            'give' => 'Mottok :amount fra gjenopprettelsen av moddinginnlegg i :post',
                        ],

                        'vote' => [
                            'give' => 'Mottok :amount fra å få stemmer på moddinginnlegget i :post',
                            'reset' => 'Tapte :amount fra å miste stemmer på moddinginnlegget i :post',
                        ],

                        'recalculate' => [
                            'give' => 'Mottok :amount fra stemmeomberegningen på modding innlegget i :post',
                            'reset' => 'Tapte :amount fra stemmeomberegningen på modding innlegget i :post',
                        ],
                    ],

                    'forum_post' => [
                        'give' => 'Mottok :amount fra :giver for et innlegg i :post',
                        'reset' => 'Kudosu tilbakestilt av :giver for innlegget i :post',
                        'revoke' => 'Nektet kudosu fra :giver for innlegget :post',
                    ],
                ],
            ],
            'me' => [
                'title' => 'me!',
            ],
            'medals' => [
                'empty' => "Denne brukeren har ikke fått noen ennå. ;_;",
                'recent' => 'Nyeste',
                'title' => 'Medaljer',
            ],
            'recent_activity' => [
                'title' => 'Nylige',
            ],
            'top_ranks' => [
                'download_replay' => 'Last ned Reprise',
                'empty' => 'Ingen fantastiske prestasjoner på rekordlisten enda. :(',
                'not_ranked' => 'Bare rangerte beatmaps gir pp.',
                'pp_weight' => 'veid :percentage',
                'title' => 'Rangeringer',

                'best' => [
                    'title' => 'Beste Prestasjoner',
                ],
                'first' => [
                    'title' => 'Førsteplasser',
                ],
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
                    'length_permanent' => 'Permanent',
                    'description' => 'beskrivelse',
                    'actor' => 'av :username',

                    'actions' => [
                        'restriction' => 'Utestengelse',
                        'silence' => 'Forstummet',
                        'note' => 'Merknad',
                    ],
                ],
            ],
        ],

        'header_title' => [
            '_' => 'Spiller :info',
            'info' => 'Informasjon',
        ],

        'info' => [
            'discord' => 'Discord',
            'interests' => 'Interesser',
            'lastfm' => 'Last.fm',
            'location' => 'Nåværende Plassering',
            'occupation' => 'Yrke',
            'skype' => 'Skype',
            'twitter' => 'Twitter',
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
            'edit_big' => 'Rediger me!',
            'placeholder' => 'Skriv sideinnhold her',
            'restriction_info' => "Du må være en <a href='".route('store.products.show', 'supporter-tag')."' target='_blank'>osu!supporter</a> for å låse opp denne funksjonen.",
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
        ],
        'stats' => [
            'hit_accuracy' => 'Presisjon',
            'level' => 'Nivå :level',
            'level_progress' => 'Fremgang til neste nivå',
            'maximum_combo' => 'Maksimal Kombo',
            'medals' => 'Medaljer',
            'play_count' => 'Antall Spillforsøk',
            'play_time' => 'Total Spilletid',
            'ranked_score' => 'Rangert Poengsum',
            'replays_watched_by_others' => 'Pepriser Sett av Andre',
            'score_ranks' => 'Poengsum Rangering',
            'total_hits' => 'Totale Treff',
            'total_score' => 'Samlet Poengsum',
        ],
    ],
    'status' => [
        'online' => 'Påkoblet',
        'offline' => 'Frakoblet',
    ],
    'store' => [
        'saved' => 'Bruker opprettet',
    ],
    'verify' => [
        'title' => 'Kontobekreftelse',
    ],
];
