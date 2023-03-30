<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'discussion-votes' => [
        'update' => [
            'error' => 'Ažuriranje glasanja nije uspjelo',
        ],
    ],

    'discussions' => [
        'allow_kudosu' => 'dopusti kudosu',
        'beatmap_information' => 'Stranica beatmape',
        'delete' => 'izbriši',
        'deleted' => 'Izbrisano od :editor :delete_time.',
        'deny_kudosu' => 'zabrani kudosu',
        'edit' => 'uredi',
        'edited' => 'Zadnje uređeno od :editor :update_time.',
        'guest' => 'Gostova težina od :user',
        'kudosu_denied' => 'Zabranjeno dobivanje kudosua.',
        'message_placeholder_deleted_beatmap' => 'Ova težina je izbrisana pa se o njoj više ne može raspravljati.',
        'message_placeholder_locked' => 'Rasprava za ovu beatmapu je isključena.',
        'message_placeholder_silenced' => "Ne možeš objavljivati raspravu dok si utišan/a.",
        'message_type_select' => 'Odaberi vrstu komentara',
        'reply_notice' => 'Pritisni enter za odgovor.',
        'reply_placeholder' => 'Upiši svoj odgovor ovdje',
        'require-login' => 'Molimo da se prijaviš kako bi objavljivao ili odgovorio/la',
        'resolved' => 'Riješeno',
        'restore' => 'obnovi',
        'show_deleted' => 'Prikaži izbrisano',
        'title' => 'Rasprave',

        'collapse' => [
            'all-collapse' => 'Sažmi sve',
            'all-expand' => 'Proširi sve',
        ],

        'empty' => [
            'empty' => 'Još nema rasprava!',
            'hidden' => 'Nijedna rasprava ne odgovara odabranom filtru.',
        ],

        'lock' => [
            'button' => [
                'lock' => 'Zaključaj raspravu',
                'unlock' => 'Otključaj raspravu',
            ],

            'prompt' => [
                'lock' => 'Razlog zaključavanja',
                'unlock' => 'Jesi li siguran/na da želiš otključati?',
            ],
        ],

        'message_hint' => [
            'in_general' => 'Ovaj će post ići na opću beatmap raspravu. Da bi modificirao/la težinu, započni poruku s vremenskom oznakom (npr. 00:12:345).',
            'in_timeline' => 'Da bi modificirao/la više vremenskih oznaka, objavi više puta (jedna objava po vremenskoj oznaci).',
        ],

        'message_placeholder' => [
            'general' => 'Upiši ovdje kako bi objavio u Općenito (:version)',
            'generalAll' => 'Upiši ovdje kako bi objavio/la u Općenito (Sve težine)',
            'review' => 'Upiši ovdje kako bi objavio/la recenziju',
            'timeline' => 'Upiši ovdje kako bi objavio u Vremensku crtu (:version)',
        ],

        'message_type' => [
            'disqualify' => 'Diskvalificiraj',
            'hype' => 'Hype!',
            'mapper_note' => 'Bilješka',
            'nomination_reset' => 'Resetiraj nominaciju',
            'praise' => 'Pohvali',
            'problem' => 'Problem',
            'problem_warning' => 'Prijava problema',
            'review' => 'Recenzija',
            'suggestion' => 'Prijedlog',
        ],

        'mode' => [
            'events' => 'Povijest',
            'general' => 'Općenito :scope',
            'reviews' => 'Recenzije',
            'timeline' => 'Vremenska crta',
            'scopes' => [
                'general' => 'Ova težina',
                'generalAll' => 'Sve težine',
            ],
        ],

        'new' => [
            'pin' => 'Prikvači',
            'timestamp' => 'Vremenska oznaka',
            'timestamp_missing' => 'ctrl-c u načinu uređivanja i zalijepi svoju poruku da dodaš vremensku oznaku!',
            'title' => 'Nova rasprava ',
            'unpin' => 'Otkači',
        ],

        'review' => [
            'new' => 'Nova Recenzija',
            'embed' => [
                'delete' => 'Izbriši',
                'missing' => '[RASPRAVA IZBRISANA]',
                'unlink' => 'Ukloni poveznicu',
                'unsaved' => 'Nespremljeno',
                'timestamp' => [
                    'all-diff' => 'Objave na "Sve težine" ne mogu biti vremenski obilježene.',
                    'diff' => 'Ako ovaj :type počinje s vremenskom oznakom, bit će prikazan pod Vremenska crta.',
                ],
            ],
            'insert-block' => [
                'paragraph' => 'umetni odlomak',
                'praise' => 'umetni pohvalu',
                'problem' => 'umetni problem',
                'suggestion' => 'umetni prijedlog',
            ],
        ],

        'show' => [
            'title' => ':title napravljen od :mapper',
        ],

        'sort' => [
            'created_at' => 'Vrijeme stvaranja',
            'timeline' => 'Vremenska crta',
            'updated_at' => 'Posljednje ažuriranje',
        ],

        'stats' => [
            'deleted' => 'Izbrisano',
            'mapper_notes' => 'Bilješke',
            'mine' => 'Moje',
            'pending' => 'Na čekanju',
            'praises' => 'Pohvale',
            'resolved' => 'Riješeno',
            'total' => 'Sve',
        ],

        'status-messages' => [
            'approved' => 'Ova beatmapa je odobrena na :date!',
            'graveyard' => "Ova beatmapa nije ažurirana od :date pa je stavljena na Groblje...",
            'loved' => 'Ova beatmapa je dodana na Voljeno na :date!',
            'ranked' => 'Ova beatmapa je rangirana na :date!',
            'wip' => 'Napomena: Vlasnik je ovu beatmapu označio kao radnju u tijeku.',
        ],

        'votes' => [
            'none' => [
                'down' => 'Još nema glasova protiv',
                'up' => 'Još nema glasanja za',
            ],
            'latest' => [
                'down' => 'Najnoviji glasovi protiv',
                'up' => 'Najnoviji glasovi za',
            ],
        ],
    ],

    'hype' => [
        'button' => 'Hypeaj beatmapu!',
        'button_done' => 'Već hypeano!',
        'confirm' => "Jesi li siguran? Ovo će iskoristiti jedan od tvojih preostalih :n hypeova i ne može se poništiti.",
        'explanation' => 'Hypeaj ovu beatmapu kako bi bila vidljivija za nominaciju i rangiranje!',
        'explanation_guest' => 'Prijavi se i hypeaj ovu beatmapu kako bi bila vidljivija za nominaciju i rangiranje!',
        'new_time' => "Dobit ćeš još jedan hype :new_time.",
        'remaining' => 'Preostalo ti je :remaining hypeova.',
        'required_text' => 'Hype: :current/:required',
        'section_title' => 'Hype vlak',
        'title' => 'Hype',
    ],

    'feedback' => [
        'button' => 'Ostavi povratnu informaciju',
    ],

    'nominations' => [
        'delete' => 'Izbriši',
        'delete_own_confirm' => 'Jesi li siguran? Beatmapa će se izbrisati i bit ćeš preusmjeren natrag na svoj profil.',
        'delete_other_confirm' => 'Jesi li siguran? Beatmapa će se izbrisati i bit ćeš preusmjeren natrag na korisnikov profil.',
        'disqualification_prompt' => 'Razlog za diskvalifikaciju?',
        'disqualified_at' => 'Diskvalificirano :time_ago (:reason).',
        'disqualified_no_reason' => 'nema navedenog razloga',
        'disqualify' => 'Diskvalificiraj',
        'incorrect_state' => 'Greška u izvođenju tog zadatka, pokušajte osvježiti stranicu.',
        'love' => 'Voli',
        'love_choose' => 'Odaberi težinu za voljeno',
        'love_confirm' => 'Voliš ovu beatmapu?',
        'nominate' => 'Nominiraj',
        'nominate_confirm' => 'Nominiraj ovu beatmapu?',
        'nominated_by' => 'nominirano od :users',
        'not_enough_hype' => "Nema dovoljno hypea.",
        'remove_from_loved' => 'Ukloni iz Voljeno',
        'remove_from_loved_prompt' => 'Razlog uklanjanja iz Voljeno:',
        'required_text' => 'Nominacije: :current/:required',
        'reset_message_deleted' => 'izbrisano',
        'title' => 'Status nominacije',
        'unresolved_issues' => 'Još uvijek postoje neriješeni problemi koji se prvo moraju riješiti.',

        'rank_estimate' => [
            '_' => 'Procjenjuje se da će ova beatmapa biti rangirana :date ako nema problema. To je :position. u :queue.',
            'on' => '',
            'queue' => 'red čekanja na rangiranje',
            'soon' => 'uskoro',
        ],

        'reset_at' => [
            'nomination_reset' => 'Proces nominacije resetiran :time_ago od :user s novim problemom :discussion (:message).',
            'disqualify' => 'Diskvalificirana :time_ago od :user s novim problemom :discussion (:message).',
        ],

        'reset_confirm' => [
            'disqualify' => 'Jesi li siguran? Ovo će ukloniti beatmapu iz kvalifikacije i resetirati proces nominacije.',
            'nomination_reset' => 'Jesi li siguran? Objavljivanje novog problema poništit će proces nominacije.',
            'problem_warning' => 'Jesi li siguran/na da želiš prijaviti problem na ovoj beatmapi? Ovo će upozoriti Nominatore beatmapa.',
        ],
    ],

    'listing' => [
        'search' => [
            'prompt' => 'upiši ključne riječi...',
            'login_required' => 'Prijavi se za pretraživanje.',
            'options' => 'Još opcija pretraživanja',
            'supporter_filter' => 'Filtriranje prema :filters zahtijeva aktivnu osu!supporter oznaku',
            'not-found' => 'nema rezultata',
            'not-found-quote' => '... ne, ništa nije pronađeno.',
            'filters' => [
                'extra' => 'Dodatno',
                'general' => 'Općenito',
                'genre' => 'Žanr',
                'language' => 'Jezik',
                'mode' => 'Mod',
                'nsfw' => 'Eksplicitni sadržaj',
                'played' => 'Igrano',
                'rank' => 'Postignuti rang',
                'status' => 'Kategorije',
            ],
            'sorting' => [
                'title' => 'Naslov',
                'artist' => 'Umjetnik',
                'difficulty' => 'Težina',
                'favourites' => 'Omiljeni',
                'updated' => 'Ažurirano',
                'ranked' => 'Rangiran',
                'rating' => 'Ocjena',
                'plays' => 'Igranja',
                'relevance' => 'Relevantnost',
                'nominations' => 'Nominacije ',
            ],
            'supporter_filter_quote' => [
                '_' => 'Filtriranje prema :filters zahtijeva aktivnu :link',
                'link_text' => 'osu!supporter oznaku',
            ],
        ],
    ],
    'general' => [
        'converts' => 'Uključi pretvorene beatmape',
        'featured_artists' => 'Istaknuti umjetnici',
        'follows' => 'Pretplaćeni mapperi',
        'recommended' => 'Preporučena težina ',
        'spotlights' => 'Spotlightirane beatmape',
    ],
    'mode' => [
        'all' => 'Svi',
        'any' => 'Bilo koji',
        'osu' => '',
        'taiko' => '',
        'fruits' => '',
        'mania' => '',
    ],
    'status' => [
        'any' => 'Bilo koji',
        'approved' => 'Odobreno',
        'favourites' => 'Omiljeni',
        'graveyard' => 'Groblje',
        'leaderboard' => 'Ima ljestvicu',
        'loved' => 'Voljeno',
        'mine' => 'Moje mape',
        'pending' => 'Na čekanju',
        'wip' => 'Rad u tijeku',
        'qualified' => 'Kvalificiran',
        'ranked' => 'Rangiran',
    ],
    'genre' => [
        'any' => 'Bilo koji',
        'unspecified' => 'Nespecificiran',
        'video-game' => 'Video igra',
        'anime' => 'Anime',
        'rock' => 'Rock',
        'pop' => 'Pop',
        'other' => 'Ostalo',
        'novelty' => 'Novela',
        'hip-hop' => 'Hip-hop',
        'electronic' => 'Elektronička',
        'metal' => 'Metal',
        'classical' => 'Klasična',
        'folk' => 'Narodna',
        'jazz' => 'Jazz',
    ],
    'language' => [
        'any' => 'Bilo koji',
        'english' => 'Engleski',
        'chinese' => 'Kineski',
        'french' => 'Francuski',
        'german' => 'Njemački',
        'italian' => 'Italijanski',
        'japanese' => 'Japanski',
        'korean' => 'Korejski',
        'spanish' => 'Španjolski',
        'swedish' => 'Švedski',
        'russian' => 'Ruski',
        'polish' => 'Poljski',
        'instrumental' => 'Instrumental',
        'other' => 'Ostalo',
        'unspecified' => 'Nespecificiran',
    ],

    'nsfw' => [
        'exclude' => 'Sakrij',
        'include' => 'Prikaži
',
    ],

    'played' => [
        'any' => 'Bilo koji',
        'played' => 'Igrano',
        'unplayed' => 'Neodigrana',
    ],
    'extra' => [
        'video' => 'Ima video',
        'storyboard' => 'Ima storyboard',
    ],
    'rank' => [
        'any' => 'Bilo koji',
        'XH' => 'Srebreni SS',
        'X' => '',
        'SH' => 'Srebreni S',
        'S' => '',
        'A' => '',
        'B' => '',
        'C' => '',
        'D' => '',
    ],
    'panel' => [
        'playcount' => 'Broj igranja: :count',
        'favourites' => 'Omiljeni: :count',
    ],
    'variant' => [
        'mania' => [
            '4k' => '4K',
            '7k' => '7K',
            'all' => 'Svi',
        ],
    ],
];
