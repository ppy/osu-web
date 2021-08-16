<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'discussion-votes' => [
        'update' => [
            'error' => 'Kunne ikke oppdatere stemme',
        ],
    ],

    'discussions' => [
        'allow_kudosu' => 'tillat kudosu',
        'beatmap_information' => 'Beatmapside',
        'delete' => 'slett',
        'deleted' => 'Slettet av :editor :delete_time.',
        'deny_kudosu' => 'avvis kudosu',
        'edit' => 'rediger',
        'edited' => 'Sist endret av :editor :update_time.',
        'guest' => '',
        'kudosu_denied' => 'Avvist fra å få kudosu.',
        'message_placeholder_deleted_beatmap' => 'Denne vanskelighetsgraden har blitt slettet så den kan ikke bli diskutert lenger.',
        'message_placeholder_locked' => 'Diskusjon for dette beatmappet har blitt deaktivert.',
        'message_placeholder_silenced' => "Kan ikke publisere diskusjonen mens du er dempet.",
        'message_type_select' => 'Velg kommentartype',
        'reply_notice' => 'Trykk enter for å svare.',
        'reply_placeholder' => 'Skriv din respons her',
        'require-login' => 'Vennligst logg inn for å skrive et innlegg eller svare',
        'resolved' => 'Løst',
        'restore' => 'gjenopprett',
        'show_deleted' => 'Vis slettede',
        'title' => 'Diskusjoner',

        'collapse' => [
            'all-collapse' => 'Skjul alle',
            'all-expand' => 'Vis alle',
        ],

        'empty' => [
            'empty' => 'Ingen diskusjoner ennå!',
            'hidden' => 'Ingen diskusjon stemmer overens med valgte filter.',
        ],

        'lock' => [
            'button' => [
                'lock' => 'Lås diskusjon',
                'unlock' => 'Lås opp diskusjon',
            ],

            'prompt' => [
                'lock' => 'Grunn for låsing',
                'unlock' => 'Er du sikker på å låse opp?',
            ],
        ],

        'message_hint' => [
            'in_general' => 'Dette innlegget vil gå til den generelle diskusjonen for beatmapsettet. For å modifisere dette beatmappet, start meldingen med et tidsstempel (f.eks. 00:12:345).',
            'in_timeline' => 'For å modde flere tidsstempler, må du skrive flere ganger (et innlegg per tidsstempel).',
        ],

        'message_placeholder' => [
            'general' => 'Skriv her for å legge til på Generelt (:version)',
            'generalAll' => 'Skriv her for å legge til på Generelt (Alle vanskelighetsgrader)',
            'review' => 'Skriv her for å legge til en anmeldelse',
            'timeline' => 'Skriv her for å legg til på tidslinjen (:version)',
        ],

        'message_type' => [
            'disqualify' => 'Diskvalifiser',
            'hype' => 'Hype!',
            'mapper_note' => 'Merknad',
            'nomination_reset' => 'Tilbakestill Nominasjon',
            'praise' => 'Ros',
            'problem' => 'Problem',
            'review' => 'Anmeldelse',
            'suggestion' => 'Forslag',
        ],

        'mode' => [
            'events' => 'Historie',
            'general' => 'Generell :scope',
            'reviews' => 'Anmeldelser',
            'timeline' => 'Tidslinje',
            'scopes' => [
                'general' => 'Denne vanskelighetsgraden',
                'generalAll' => 'Alle vanskelighetsgrader',
            ],
        ],

        'new' => [
            'pin' => 'Fest',
            'timestamp' => 'Tidsstempel',
            'timestamp_missing' => 'trykk Ctrl+C i redigeringsmodus og lim inn for å legge til et tidsstempel!',
            'title' => 'Ny Diskusjon',
            'unpin' => 'Løsne',
        ],

        'review' => [
            'new' => 'Ny anmeldelse',
            'embed' => [
                'delete' => 'Slett',
                'missing' => '[DISKUSJON SLETTE]',
                'unlink' => 'Koble fra',
                'unsaved' => 'Ulagret',
                'timestamp' => [
                    'all-diff' => 'Innlegg på "Alle vanskeligheter" kan ikke bli tidsstemplet.',
                    'diff' => 'Hvis denne :type starter med en tidsstempel, skal den bli vist under Timeline.',
                ],
            ],
            'insert-block' => [
                'paragraph' => 'sett inn avsnitt',
                'praise' => 'sett inn ros',
                'problem' => 'sett inn problem',
                'suggestion' => 'sett inn forslag',
            ],
        ],

        'show' => [
            'title' => ':title mappet av :mapper',
        ],

        'sort' => [
            'created_at' => 'Opprettingstidspunkt',
            'timeline' => 'Tidslinje',
            'updated_at' => 'Siste oppdatering',
        ],

        'stats' => [
            'deleted' => 'Slettet',
            'mapper_notes' => 'Merknader',
            'mine' => 'Mine',
            'pending' => 'Ventende',
            'praises' => 'Roser',
            'resolved' => 'Løst',
            'total' => 'Alle',
        ],

        'status-messages' => [
            'approved' => 'Dette beatmappet ble godkjent den :date!',
            'graveyard' => "Dette beatmappet har ikke blitt oppdatert siden :date og har mest sannsynlig blitt forlatt av skaperen...",
            'loved' => 'Dette beatmappet ble lagt til i elsket den :date!',
            'ranked' => 'Dette beatmappet ble rangert den :date!',
            'wip' => 'Merk: Dette beatmappet er markert som "under konstruksjon" av skaperen.',
        ],

        'votes' => [
            'none' => [
                'down' => 'Ingen negative stemmer enda',
                'up' => 'Ingen positive stemmer enda',
            ],
            'latest' => [
                'down' => 'Seneste negative stemmer',
                'up' => 'Seneste positive stemmer',
            ],
        ],
    ],

    'hype' => [
        'button' => 'Hype Beatmap!',
        'button_done' => 'Allerede Hypet!',
        'confirm' => "Er du sikker? Dette vil bruke en av dine gjenstående :n hype og kan ikke angres.",
        'explanation' => 'Hype dette beatmappet for å gjøre den mer synlig for nominasjon og rangering!',
        'explanation_guest' => 'Logg inn for å hype dette beatmappet slik at den blir mer synlig for nominering og rangering!',
        'new_time' => "Du vil få en ny hype :new_time.",
        'remaining' => 'Du har :remaining hype igjen.',
        'required_text' => 'Hype: :current/:required',
        'section_title' => 'Hype Tog',
        'title' => 'Hype',
    ],

    'feedback' => [
        'button' => 'Legg igjen tilbakemelding',
    ],

    'nominations' => [
        'delete' => 'Slett',
        'delete_own_confirm' => 'Er du sikker? Beatmappet vil bli slettet og du vil bli omdirigert tilbake til profilen din.',
        'delete_other_confirm' => 'Er du sikker? Beatmappet vil bli slettet og du vil bli omdirigert tilbake til brukeren sin profil.',
        'disqualification_prompt' => 'Årsak til diskvalifikasjon?',
        'disqualified_at' => 'Diskvalifisert :time_ago (:reason).',
        'disqualified_no_reason' => 'ingen grunn spesifisert',
        'disqualify' => 'Diskvalifiser',
        'incorrect_state' => 'Feil under utføringen av denne handlingen, prøv å oppdatere siden.',
        'love' => 'Elsker',
        'love_choose' => '',
        'love_confirm' => 'Elsk dette beatmappet?',
        'nominate' => 'Nominer',
        'nominate_confirm' => 'Nominer dette beatmappet?',
        'nominated_by' => 'nominert av :users',
        'not_enough_hype' => "Det er ikke nok hype.",
        'remove_from_loved' => '',
        'remove_from_loved_prompt' => '',
        'required_text' => 'Nominasjoner :current/:required',
        'reset_message_deleted' => 'slettet',
        'title' => 'Nominasjon Status',
        'unresolved_issues' => 'Det er fortsatt uløste problemer som må løses først.',

        'rank_estimate' => [
            '_' => '',
            'queue' => '',
            'soon' => 'snart',
        ],

        'reset_at' => [
            'nomination_reset' => 'Nominasjonsprosessen ble tilbakestilt :time_ago av :user med et nytt problem :discussion (:message).',
            'disqualify' => 'Diskvalifisert :time_ago av :user med et nytt problem :discussion (:message).',
        ],

        'reset_confirm' => [
            'nomination_reset' => 'Er du sikker? Hvis du legger inn et nytt problem, vil nominasjonsprosessen bli tilbakestilt.',
            'disqualify' => 'Er du sikker? Dette vil fjerne beatmappets kvalifisert-status og tilbakestille nomineringsprosessen.',
        ],
    ],

    'listing' => [
        'search' => [
            'prompt' => 'skriv inn nøkkelord...',
            'login_required' => 'Logg inn for å søke.',
            'options' => 'Flere søkemuligheter',
            'supporter_filter' => 'Filtrering ved bruk av :filters krever en aktiv osu!supporter tag',
            'not-found' => 'ingen treff',
            'not-found-quote' => '... nei, ingenting ble funnet.',
            'filters' => [
                'extra' => 'ekstra',
                'general' => 'Generelt',
                'genre' => 'Sjanger',
                'language' => 'Språk',
                'mode' => 'Modus',
                'nsfw' => 'Eksplisitt innhold',
                'played' => 'Spilt',
                'rank' => 'Rangering Oppnådd',
                'status' => 'Kategorier',
            ],
            'sorting' => [
                'title' => 'Tittel',
                'artist' => 'Artist',
                'difficulty' => 'Vanskelighetsgrad',
                'favourites' => 'Favoritter',
                'updated' => 'Oppdatert',
                'ranked' => 'Rangert',
                'rating' => 'Vurdering',
                'plays' => 'Spillforsøk',
                'relevance' => 'Relevanse',
                'nominations' => 'Nominasjoner',
            ],
            'supporter_filter_quote' => [
                '_' => 'Filtrering ved bruk av :filters krever en aktiv :link',
                'link_text' => 'osu!supporter tag',
            ],
        ],
    ],
    'general' => [
        'converts' => 'Inkluder konverterte beatmaps',
        'follows' => '',
        'recommended' => 'Anbefalt vanskelighetsgrad',
    ],
    'mode' => [
        'all' => 'Alle',
        'any' => 'Alle',
        'osu' => '',
        'taiko' => '',
        'fruits' => '',
        'mania' => '',
    ],
    'status' => [
        'any' => 'Alle',
        'approved' => 'Godkjent',
        'favourites' => 'Favoritter',
        'graveyard' => 'Gravplassert',
        'leaderboard' => 'Har Resultatliste',
        'loved' => 'Elsket',
        'mine' => 'Mine Maps',
        'pending' => 'Ventende & WIP',
        'qualified' => 'Kvalifisert',
        'ranked' => 'Rangert',
    ],
    'genre' => [
        'any' => 'Alle',
        'unspecified' => 'Uspesifisert',
        'video-game' => 'Dataspill',
        'anime' => 'Anime',
        'rock' => 'Rock',
        'pop' => 'Pop',
        'other' => 'Andre',
        'novelty' => 'Novelty',
        'hip-hop' => 'Hip Hop',
        'electronic' => 'Elektronisk',
        'metal' => 'Metall',
        'classical' => 'Klassisk',
        'folk' => 'Folkemusikk',
        'jazz' => 'Jazz',
    ],
    'mods' => [
        '4K' => '',
        '5K' => '',
        '6K' => '',
        '7K' => '',
        '8K' => '',
        '9K' => '',
        'AP' => '',
        'DT' => '',
        'EZ' => '',
        'FI' => '',
        'FL' => '',
        'HD' => '',
        'HR' => '',
        'HT' => '',
        'MR' => '',
        'NC' => '',
        'NF' => '',
        'NM' => '',
        'PF' => '',
        'RX' => '',
        'SD' => '',
        'SO' => '',
        'TD' => '',
        'V2' => '',
    ],
    'language' => [
        'any' => '',
        'english' => 'Engelsk',
        'chinese' => 'Kinesisk',
        'french' => 'Fransk',
        'german' => 'Tysk',
        'italian' => 'Italiensk',
        'japanese' => 'Japansk',
        'korean' => 'Koreansk',
        'spanish' => 'Spansk',
        'swedish' => 'Svensk',
        'russian' => 'Russisk',
        'polish' => 'Polsk',
        'instrumental' => 'Instrumental',
        'other' => 'Andre',
        'unspecified' => 'Uspesifisert',
    ],

    'nsfw' => [
        'exclude' => 'Skjul',
        'include' => 'Vis',
    ],

    'played' => [
        'any' => 'Alle',
        'played' => 'Spilt',
        'unplayed' => 'Uspilt',
    ],
    'extra' => [
        'video' => 'Har Video',
        'storyboard' => 'Har Storyboard',
    ],
    'rank' => [
        'any' => 'Alle',
        'XH' => 'Sølv SS',
        'X' => '',
        'SH' => 'Sølv S',
        'S' => '',
        'A' => '',
        'B' => '',
        'C' => '',
        'D' => '',
    ],
    'panel' => [
        'playcount' => 'Spillforsøk: :count',
        'favourites' => 'Favoritter: :count',
    ],
    'variant' => [
        'mania' => [
            '4k' => '4K',
            '7k' => '7K',
            'all' => 'All',
        ],
    ],
];
