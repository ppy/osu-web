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
            'big_description' => 'Máš rád osu!? <br/>
                                Podporte vývojárov osu! :D',
            'small_description' => '',
            'support_button' => 'Chcem podporiť osu!',
        ],

        'dev_quote' => 'osu! je úplne free-to-play hra, ale jej prevádzka rozhodne nie je zadarmo. 
        Medzi náklady na prevádzku serveru a udržovánie vysokej kvality mezinárodného spojenia, časom stráveným udržováním systému a komunity, 
        poskytováním cien pre súťaže, odpovedaním na otázky z podpory a zvyčajne udržováním ľudí šťastných, osu! konzumuje mohutnú sumu penazí!
        Oh, a nezabudnite, že to všetko robíme bez nejakých reklam alebo partnerstva s hlúpymi toolbarmi a podobne!
            <br/><br/>osu! je nakoniec z velkej časti riadene mnou. Pravdepodobne ma poznáte pod prezývkou "peppy".
            Musel som skončiť svoju pôvodnú prácu aby som s osu! udržal krok,
            a aj tak sa mi nie vždy podarí udržať štandardy o ktoré sa snažím.
            Rád by som ponúkol svoje srdečné ďakujem tým všetkým, ktorí doteraz osu! podporovali,
            a aj všetkým ktorí sa rozhodnú naďalej pokračovať v podpore tejto úžasnej hry a komunity do budúcna :).',

        'supporter_status' => [
            'contribution' => 'Ďakujeme za tvoju podporu! Zatiaľ si prispel celkovo :dollars cez :tags zakúpených supporter tagov!',
            'gifted' => ':giftedTags z vaších nákupov bolo darovaných (celkovo :giftedDollars darovaných), jak štedré!',
            'not_yet' => "Zatiaľ nemáš supporter tag :(",
            'title' => 'Aktuálny status podporovateľa',
            'valid_until' => 'Tvoj momentálny supporter tag je platný do :date!',
            'was_valid_until' => 'Tvoj supporter tag bol platný do :date.',
        ],

        'why_support' => [
            'title' => 'Prečo by som mal podporiť osu!?',
            'blocks' => [
                'dev' => 'Vytvorené a udržované prevažne jedným týpkom v Austrálií',
                'time' => 'Zaberá to toľko veľa času pre funkciu, že sa to už nedá nazvať "koníčkom".',
                'ads' => 'Nikde nie sú reklamy. <br/><br/>
                        Narozdiel od 99.95% internetových stránok, my nemáme zisk z dávaní vecí pred tvojou tvárou.',
                'goodies' => 'Dostaneš ďalšie extra výhody!',
            ],
        ],

        'perks' => [
            'title' => 'Oh? Čo dostanem?!',
            'osu_direct' => [
                'title' => 'osu!direct',
                'description' => 'rýchly a jednoduchý prístup k vyhľadaniu beatmap bez opúšťania hry.',
            ],

            'auto_downloads' => [
                'title' => 'Automatické sťahovanie',
                'description' => 'Automatické sťahovanie pri hraní multiplayeru, sledovanie ostatných, alebo pri klikaniach v chate!',
            ],

            'upload_more' => [
                'title' => 'Nahraj viac',
                'description' => 'Ďalšie nevyriadené beatmapové sloty (za každú hodnotenú beatmapu), max 10.',
            ],

            'early_access' => [
                'title' => 'Predbežný prístup',
                'description' => 'Prístup pri predbežných vydaní, kde si môžeš skúsiť novinky pred tým než budú verejné!',
            ],

            'customisation' => [
                'title' => 'Prispôsobenie',
                'description' => 'Prispôsobte si svôj profil pridaním plne upraviteľnéj uživatelskej stránky.',
            ],

            'beatmap_filters' => [
                'title' => 'Beatmapové Filtry',
                'description' => 'Filtruj vyhľadávanie beatmap podľa zahraných a nehraných a podľa hodnotenia (ak nejaké je).',
            ],

            'yellow_fellow' => [
                'title' => 'Žltý Chlapík',
                'description' => 'Buďte odlišní v hre so vaším novým svetložltým menom v chate.',
            ],

            'speedy_downloads' => [
                'title' => 'Rýchle sťahovanie',
                'description' => 'Menej obmedzené sťahovanie, obzvlášť keď používate osu!direct.',
            ],

            'change_username' => [
                'title' => 'Zmeniť užívateľské meno',
                'description' => 'Schopnosť si zmeniť vaše uživatelské meno zadarmo. (iba raz)',
            ],

            'skinnables' => [
                'title' => 'Viac možností skinu',
                'description' => 'Viac prispôsobiteľných elementov skinu v hre, napríklad pozadie hlavného menu.',
            ],

            'feature_votes' => [
                'title' => 'Hlasovanie o funkciách',
                'description' => 'Hlasy pre požiadavky na nové funkcie. (2 za mesiac)',
            ],

            'sort_options' => [
                'title' => 'Možnosti triedenia',
                'description' => 'Schopnosť vidieť hodnotenie mapy podľa štátu / priateľov / módov.',
            ],

            'feel_special' => [
                'title' => 'Cíť sa špecialne',
                'description' => 'Hrejivý pocit z toho, že ste pomohli zaistiť hladký chod osu!!',
            ],

            'more_to_come' => [
                'title' => 'A oveľa viac ešte pribudne',
                'description' => '',
            ],
        ],

        'convinced' => [
            'title' => 'Presvedčili ste ma! :D',
            'support' => 'podpor osu!',
            'gift' => 'alebo daruj supporter tag iným hráčom',
            'instructions' => 'klikni na srdiečko pre presunutie do osu!store',
        ],
    ],
];
