<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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
            'big_description' => 'Zbožňujete osu!?<br/>
podpořte osu! vývojáře! :D',
            'small_description' => '',
            'support_button' => 'Chci podpořit osu!',
        ],

        'dev_quote' => 'osu! je naprosto free-to-play hra, ale její provoz zdarma rozhodně není. 
        Mezi náklady na provoz serverů a udržování vysoké kvality mezinárodního spojení, časem stráveným udržováním systému a komunity, 
        poskytováním cen pro soutěže, odpovídáním na otázky z podpory a obecně udržováním lidí šťastných, osu! konzumuje nezanedbatelnou sumu peněz!
        Jo, a nezapomínejme že to všechno děláme bez nějakých reklam nebo partnerství s hloupými toolbary a podobnými pitomostmi!
            <br/><br/>osu! je koneckonců z velké části řízeno mnou. Nejspíš mě asi znáte pod přezdívkou "peppy".
            Musel jsem zkončit ve své původní práci abych s osu! dokázal udržet krok,
            a i tak se mi ne vždy podaří udržet standardy o které usiluji.
            Rád bych nabídl své srdečné díky jak všem kteří doteď osu! pdopořili,
            tak i všem kteří se se rozhodnou dál pokračovat v podpoře téhle úžasné hry a komunity do budoucna :).',

        'supporter_status' => [
            'contribution' => 'Díky za Vaši podporu! Zatím jste přispěli celkově :dollars napříč :tag nákupy supporter tagů!',
            'gifted' => ':giftedTags z vašich nákupů tagů bylo darováno (což dělá celkem :giftedDollars ), jak štědré!',
            'not_yet' => "Ještě nemáte označení podporovatele osu :(",
            'title' => 'Aktuální status podporovatele',
            'valid_until' => 'Vaše označení podporovatele je platné do :date!',
            'was_valid_until' => 'Vaše označení podporovatele bylo platné do :date.',
        ],

        'why_support' => [
            'title' => 'Proč bych měl podporovat osu!?',
            'blocks' => [
                'dev' => 'Vytvořeno a udržováno převážně jedním chlapem v Austrálii',
                'time' => 'Zabere tolik času, že se to už nedá nazívat "koníčkem".',
                'ads' => 'Nikde žádné reklamy. <br/><br/>
                        na rozdíl od 99,95 % internetu, my nemáme zisk ze strkání věcí před tvůj obličej.',
                'goodies' => 'Dostanete další víhody!',
            ],
        ],

        'perks' => [
            'title' => 'Oh? Co dostanu?!',
            'osu_direct' => [
                'title' => 'osu!direct',
                'description' => 'rychlý a snadný přístup k vyhledávání beatmap bez opuštění hry.',
            ],

            'auto_downloads' => [
                'title' => 'Automatické Stahování',
                'description' => 'Automatické stahování při hraní s více hráči, sledování ostatních, nebo klikání na odkazy v chatu!',
            ],

            'upload_more' => [
                'title' => 'Nahraj Více',
                'description' => 'Další nevyřízené beatmapové sloty (za každou kvalifikovanou beatmapu), max. 10.',
            ],

            'early_access' => [
                'title' => 'Předběžný Přístup',
                'description' => 'Přístup do předběžných vydání, kde si můžeš vyzkoušet novinky ještě než výjdou!',
            ],

            'customisation' => [
                'title' => 'Přizpůsobení',
                'description' => 'Přizpůsobte si svůj profil přidáním plně upravitelné uživatelské stránky.',
            ],

            'beatmap_filters' => [
                'title' => 'Beatmapové Filtry',
                'description' => 'Filtrujte beatmapové vyhledávání podle zahraných a ještě nehraných a podle umístění.',
            ],

            'yellow_fellow' => [
                'title' => 'Žlutý Člen',
                'description' => 'Buďte odlišní ve hrě se světle žlutým jménem v chatu.',
            ],

            'speedy_downloads' => [
                'title' => 'Rychlé Stahování',
                'description' => 'Méně omezená stahování, zejména když používáte osu!direct.',
            ],

            'change_username' => [
                'title' => 'Změna uživatelského jména',
                'description' => 'Možnost si jednou změnit zdarma své uživatelské jméno.',
            ],

            'skinnables' => [
                'title' => 'Větší přizpůsobivost',
                'description' => 'Více přizpůsobitelných elementů ve hře, například pozadí hlavního menu.',
            ],

            'feature_votes' => [
                'title' => 'Hlasování o funkcích',
                'description' => 'Hlasy pro požadavky na nové funkce. (2 za měsíc)',
            ],

            'sort_options' => [
                'title' => 'Možnosti třídění',
                'description' => 'Možnost zobrazit hodnocení na mapě podle země / přátel / modifikací.',
            ],

            'feel_special' => [
                'title' => 'Speciální Pocit',
                'description' => 'Hřejivý pocit toho, že jste pomohli zajistit hladký chod osu!',
            ],

            'more_to_come' => [
                'title' => 'Další jsou na cestě',
                'description' => '',
            ],
        ],

        'convinced' => [
            'title' => 'Přesvědčili jste mě! :D',
            'support' => 'podpořit osu! nákupem supporter tagu!',
            'gift' => 'nebo darujte supporter jiným hráčům',
            'instructions' => 'klikněte na srdíčko pro přesměrování do osu!store',
        ],
    ],
];
