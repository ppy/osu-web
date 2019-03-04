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
        'header' => [
            // size in font-size
            'big_description' => 'Elsker du osu!?<br/>
                                Støtt utviklerne av osu! :D',
            'small_description' => '',
            'support_button' => 'Jeg vil støtte osu!',
        ],

        'dev_quote' => 'osu! er et helt gratis spill å spille, men driften av spillet er definitivt ikke så gratis.
        Mellom kostnadene å idriftsette serverne og det internasjonale høykvalitets-bredbåndet, tiden brukt for å opprettholde systemet og felleskapet,
        utgivelse av premier for konkurranser, besvaring på problemstillinger som krever støtte og generelt sett det å gjøre folk glade, osu! forbruker en ganske heftig sum med penger!
        Åh, og ikke glem faktumet at vi gjør dette uten annonser og uten partnerskap med tullete verktøylinjer og lignende!
            <br/><br/>osu! er på slutten av dagen i stor grad drevet av meg selv, som du kanskje kjenner best som "peppy".
            jeg måtte slutte på dagsjobben min for å holde tritt med osu!,
            og sliter til tider med å opprettholde standardene jeg strever for.
            Jeg vil gjerne takke personlig til de som har støttet osu! til nå,
            dette gjelder også like mye til de som fortsetter å støtte dette fantastiske spillet og felleskapet i fremtiden :).',

        'supporter_status' => [
            'contribution' => 'Takk for støtten sin så langt! Du har bidratt med en total på :dollars over :tags tag kjøp!',
            'gifted' => ':giftedTags av dine supporter tags ble gitt bort i gave (for en sum av :giftedDollars), hvor sjenerøs!',
            'not_yet' => "Du har ikke en osu!supporter tag ennå :(",
            'title' => 'Gjeldende osu!supporter status',
            'valid_until' => 'Din gjeldende osu!supporter tag gjelder inntil :date!',
            'was_valid_until' => 'Din osu!supporter tag gjaldt inntil :date.',
        ],

        'why_support' => [
            'title' => 'Hvorfor burde jeg støtte osu!?',
            'blocks' => [
                'dev' => 'Hovedsakelig ttviklet og vedlikeholdt av en fyr i Australia',
                'time' => 'Det tar så mye tid å holde det kjørende at det ikke lenger er mulig å kalle det en "hobby".',
                'ads' => 'Ingen annonser noen steder. <br/><br/>
                        I motsetning til 99.95% av websider, tjener vi ikke på å skyve ting i ansiktet ditt.',
                'goodies' => 'Du får noen ekstra godbiter!',
            ],
        ],

        'perks' => [
            'title' => 'Å? Hva får jeg?!',
            'osu_direct' => [
                'title' => 'osu!direct',
                'description' => 'rask og enkel tilgang til beatmaps uten å forlate spillet.',
            ],

            'auto_downloads' => [
                'title' => 'Automatiske nedlastinger',
                'description' => 'Automatisk nedlasting mens du er i flerspiller spill, tilskuer andre, eller klikker på hyperkoblinger i chatten!',
            ],

            'upload_more' => [
                'title' => 'Last opp mer',
                'description' => 'Ytterlige plasser for ventende beatmaps (pr. rangert beatmap) opp til en maks av 10.',
            ],

            'early_access' => [
                'title' => 'Tidlig tilgang',
                'description' => 'Tilgang til tidlig utgivelser, hvor du kan prøve nye funksjoner før de går offentlige!',
            ],

            'customisation' => [
                'title' => 'Tilpasning',
                'description' => 'Tilpass profilen din ved å legge til en fullt tilpassbar brukerside.',
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
                'description' => 'Evnen til å se landsrangering / vennerangering / modifikasjons-spesifikke rangeringer på beatmaps i spillet.',
            ],

            'feel_special' => [
                'title' => 'Føl deg spesiell',
                'description' => 'Den varme og gode følelsen av å gjøre din del slik at osu! kan fortsette å kjøre jevnt, uten problemer!',
            ],

            'more_to_come' => [
                'title' => 'Mer kommer',
                'description' => '',
            ],
        ],

        'convinced' => [
            'title' => 'Jeg er overbevist! :D',
            'support' => 'støtt osu!',
            'gift' => 'eller gi support i gave til andre spillere',
            'instructions' => 'klikk på hjerteknappen for å fortsette til osu!store',
        ],
    ],
];
