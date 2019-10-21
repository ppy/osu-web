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
    'support' => [
        'convinced' => [
            'title' => 'Jeg er overbevist! :D',
            'support' => 'støtt osu!',
            'gift' => 'eller gi support i gave til andre spillere',
            'instructions' => 'klikk på hjerteknappen for å fortsette til osu!store',
        ],
        'why-support' => [
            'title' => 'Hvorfor bør jeg støtte osu!? Hvor går pengene hen?',

            'team' => [
                'title' => 'Støtt skaperene',
                'description' => 'En liten gruppe mennesker utvikler osu! Din støtte hjelper dem med å, du vet.... overleve.',
            ],
            'infra' => [
                'title' => 'Infrastruktur til servere',
                'description' => 'Alle pengebidrag går mot å finansiere servere for å kjøre nettsiden, flerspillerfunksjoner, rangeringslister osv.',
            ],
            'featured-artists' => [
                'title' => '',
                'description' => '',
                'link_text' => '',
            ],
            'ads' => [
                'title' => '',
                'description' => '',
            ],
            'tournaments' => [
                'title' => 'Offisielle Turneringer',
                'description' => 'Hjelp til med å finansiere arrangeringen (og premienepotten) til de offisielle verdensmesterskapsturneringene i osu!',
                'link_text' => 'Se turneringer &raquo;',
            ],
            'bounty-program' => [
                'title' => '',
                'description' => '',
                'link_text' => 'Les mer &raquo;',
            ],
        ],
        'perks' => [
            'title' => 'Å? Hva får jeg?!',
            'osu_direct' => [
                'title' => 'osu!direct',
                'description' => 'rask og enkel tilgang til beatmaps uten å forlate spillet.',
            ],

            'friend_ranking' => [
                'title' => 'Vennerangering',
                'description' => "Sjekk hvordan du ligger an i forhold til vennene dine på beatmappets rangerinsliste gjennom både spiller og på nettsiden vår.",
            ],

            'country_ranking' => [
                'title' => 'Landsrangering',
                'description' => '',
            ],

            'mod_filtering' => [
                'title' => 'Filterer etter modifiikasjoner',
                'description' => '',
            ],

            'auto_downloads' => [
                'title' => 'Automatiske nedlastinger',
                'description' => 'Automatiske nedlastinger når du deltar i flerspiller spill, mens du ser på andre, eller hvis du klikker på hyperkoblinger i chatten!',
            ],

            'upload_more' => [
                'title' => 'Last opp mer',
                'description' => 'Ytterlige plasser for ventende beatmaps (pr. rangert beatmap) opp til en maks av 10.',
            ],

            'early_access' => [
                'title' => 'Tidlig tilgang',
                'description' => 'Tilgang til tidlig utgivelser, hvor du kan prøve nye funksjoner før de blir offentlige!',
            ],

            'customisation' => [
                'title' => 'Tilpasning',
                'description' => "Tilpass profilen din ved å legge til en fullt tilpassbar brukerside.",
            ],

            'beatmap_filters' => [
                'title' => 'Beatmapfiltre',
                'description' => 'Filtrer beatmapsøk basert på spilt og uspilt, samt hvilken rangering du har oppnåd (om du har noen).',
            ],

            'yellow_fellow' => [
                'title' => 'Gul kar',
                'description' => 'Bli anerkjent i spillet med din nye chat farge, som vises i lyse gult på brukernavnet ditt.',
            ],

            'speedy_downloads' => [
                'title' => 'Raske nedlastinger',
                'description' => 'Mildere restriksjoner på nedlastinger, særlig når du benytter deg av osu!direct.',
            ],

            'change_username' => [
                'title' => 'Bytt brukernavn',
                'description' => 'Muligheten til å bytte brukernavnet ditt uten ekstra kostnader (maks 1 gang)',
            ],

            'skinnables' => [
                'title' => 'Skinbarhet',
                'description' => 'Ekstra skinbare elementer i spillet, som for eksempel bakgrunnen til hovedmenyen.',
            ],

            'feature_votes' => [
                'title' => 'Stem på Funksjoner',
                'description' => 'Stemmer for funksjonsforespørsler. (2 pr. måned)',
            ],

            'sort_options' => [
                'title' => 'Sorteringsalternativer',
                'description' => 'Evnen til å se landsrangering / vennerangering / modifikasjons-spesifikke rangeringer i spillet.',
            ],

            'more_favourites' => [
                'title' => 'Flere favoritter',
                'description' => 'Det makimalt antallet beatmaps som du kan legge til å favorittene dine har blitt hevet fra :normally &rarr; :supporter',
            ],
            'more_friends' => [
                'title' => 'Flere venner',
                'description' => '',
            ],
            'more_beatmaps' => [
                'title' => 'Last opp flere beatmaps',
                'description' => 'Antallet ikke-rangerte beatmaps som du kan ha på en gang er beregnet ut ifra en grunnverdi, pluss en tilleggsbonus for hvert rangerte map du har (opp til en satt maksgrense).<br/><br/>Vanligvis vil dette si at du har en grunnverdi på 4 poeng, pluss 1 poeng per rangerte beatmap (maks 2 maps). Med supporter, økes disse verdiene slik at du har en grunnverdi på 8. Deretter vil du få 1 poeng per rangerte beatmap (maks 12 maps).',
            ],
            'friend_filtering' => [
                'title' => '',
                'description' => '',
            ],

        ],
        'supporter_status' => [
            'contribution' => 'Takk for støtten sin så langt! Du har bidratt med en total på :dollars over :tags tag kjøp!',
            'gifted' => ":giftedTags av dine supporter tags ble gitt bort i gave (for en sum av :giftedDollars), hvor sjenerøs!",
            'not_yet' => "Du har ikke en osu!supporter tag ennå :(",
            'valid_until' => 'Din gjeldende osu!supporter tag gjelder inntil :date!',
            'was_valid_until' => 'Din osu!supporter tag gjaldt inntil :date.',
        ],
    ],
];
