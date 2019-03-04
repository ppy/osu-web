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
    'discussion-posts' => [
        'store' => [
            'error' => 'Kunne ikke lagre innlegg',
        ],
    ],

    'discussion-votes' => [
        'update' => [
            'error' => 'Kunne ikke oppdatere stemme',
        ],
    ],

    'discussions' => [
        'allow_kudosu' => 'tillat kudosu',
        'delete' => 'slett',
        'deleted' => 'Slettet av :editor :delete_time.',
        'deny_kudosu' => 'avvis kudosu',
        'edit' => 'rediger',
        'edited' => 'Sist endret av :editor :update_time.',
        'kudosu_denied' => 'Avvist fra å få kudosu.',
        'message_placeholder_deleted_beatmap' => 'Denne vanskelighetsgraden har blitt slettet så den kan ikke bli diskutert lenger.',
        'message_type_select' => 'Velg kommentartype',
        'reply_notice' => 'Trykk enter for å svare.',
        'reply_placeholder' => 'Skriv din respons her',
        'require-login' => 'Vennligst logg på for å skrive et innlegg eller svare',
        'resolved' => 'Løst',
        'restore' => 'gjenopprett',
        'title' => 'Diskusjoner',

        'collapse' => [
            'all-collapse' => 'Skjul alle',
            'all-expand' => 'Vis alle',
        ],

        'empty' => [
            'empty' => 'Ingen diskusjoner ennå!',
            'hidden' => 'Ingen diskusjon stemmer overens med valgte filter.',
        ],

        'message_hint' => [
            'in_general' => 'Dette innlegget vil gå til den generelle diskusjonen for beatmapsettet. For å modifisere dette beatmappet, start meldingen med et tidsstempel (f.eks. 00:12:345).',
            'in_timeline' => 'For å modde flere tidsstempler, må du skrive flere ganger (et innlegg per tidsstempel).',
        ],

        'message_placeholder' => [
            'general' => 'Skriv her for å legge til på Generelt (:version)',
            'generalAll' => 'Skriv her for å legge til på Generelt (Alle vanskelighetsgrader)',
            'timeline' => 'Skriv her for å legg til på tidslinjen (:version)',
        ],

        'message_type' => [
            'disqualify' => 'Diskvalifiser',
            'hype' => 'Hype!',
            'mapper_note' => 'Merknad',
            'nomination_reset' => 'Tilbakestill Nominasjon',
            'praise' => 'Ros',
            'problem' => 'Problem',
            'suggestion' => 'Forslag',
        ],

        'mode' => [
            'events' => 'Historie',
            'general' => 'Generell :scope',
            'timeline' => 'Tidslinje',
            'scopes' => [
                'general' => 'Denne vanskelighetsgraden',
                'generalAll' => 'Alle vanskelighetsgrader',
            ],
        ],

        'new' => [
            'timestamp' => 'Tidsstempel',
            'timestamp_missing' => 'trykk Ctrl+C i redigeringsmodus og lim inn for å legge til et tidsstempel!',
            'title' => 'Ny Diskusjon',
        ],

        'show' => [
            'title' => ':title mappet av :mapper',
        ],

        'sort' => [
            '_' => 'Sortert etter:',
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
        'love_confirm' => 'Elsk dette beatmappet?',
        'nominate' => 'Nominer',
        'nominate_confirm' => 'Nominer dette beatmappet?',
        'nominated_by' => 'nominert av :users',
        'qualified' => 'Beregnes for å bli rangert :date, hvis ingen problemer blir funnet.',
        'qualified_soon' => 'Beregnet for å bli rangert snart, hvis ingen problemer blir funnet.',
        'required_text' => 'Nominasjoner :current/:required',
        'reset_message_deleted' => 'slettet',
        'title' => 'Nominasjon Status',
        'unresolved_issues' => 'Det er fortsatt uløste problemer som må tas opp først.',

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
            'login_required' => 'Logg på for å søke.',
            'options' => 'Flere søkemuligheter',
            'supporter_filter' => 'Filtrering ved bruk av :filters krever en aktiv osu!supporter tag',
            'not-found' => 'ingen treff',
            'not-found-quote' => '... nei, ingenting ble funnet.',
            'filters' => [
                'general' => 'Generelt',
                'mode' => 'Modus',
                'status' => 'Kategorier',
                'genre' => 'Sjanger',
                'language' => 'Språk',
                'extra' => 'ekstra',
                'rank' => 'Rangering Oppnådd',
                'played' => 'Spilt',
            ],
            'sorting' => [
                'title' => 'Tittel',
                'artist' => 'Artist',
                'difficulty' => 'Vanskelighetsgrad',
                'updated' => 'Oppdatert',
                'ranked' => 'Rangert',
                'rating' => 'Vurdering',
                'plays' => 'Spillforsøk',
                'relevance' => 'Relevanse',
                'nominations' => 'Nominasjoner',
            ],
            'supporter_filter_quote' => [
                '_' => 'Filtrering av :filters krever en aktiv :link',
                'link_text' => 'osu!supporter tag',
            ],
        ],
    ],
    'general' => [
        'recommended' => 'Anbefalt vanskelighetsgrad',
        'converts' => 'Inkluder konverterte beatmaps',
    ],
    'mode' => [
        'any' => 'Alle',
        'osu' => '',
        'taiko' => '',
        'fruits' => '',
        'mania' => '',
    ],
    'status' => [
        'any' => 'Alle',
        'ranked-approved' => 'Rangert & Godkjent',
        'approved' => 'Godkjent',
        'qualified' => 'Kvalifisert',
        'loved' => 'Elsket',
        'faves' => 'Favoritter',
        'pending' => 'Ventende & WIP',
        'graveyard' => 'Gravplassert',
        'my-maps' => 'Mine Maps',
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
        'NC' => '',
        'NF' => '',
        'NM' => '',
        'PF' => '',
        'Relax' => '',
        'SD' => '',
        'SO' => '',
        'TD' => '',
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
        'instrumental' => 'Instrumental',
        'other' => 'Andre',
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
];
