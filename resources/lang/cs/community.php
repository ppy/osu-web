<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'support' => [
        'convinced' => [
            'title' => 'Přesvědčili jste mě! :D',
            'support' => 'podpořit osu!',
            'gift' => 'nebo darovat supporter tag jiným hráčům',
            'instructions' => 'klikněte na srdíčko pro přesměrování do osu!store',
        ],
        'why-support' => [
            'title' => 'Proč bych měl podpořit osu!? Kam jdou peníze?',

            'team' => [
                'title' => 'Podpořit tým',
                'description' => 'Malý tým vývojářů vyvýjí a provozuje osu! Tvoje prodpora jim pomáhá... no... žít.',
            ],
            'infra' => [
                'title' => 'Infrastruktura serveru',
                'description' => 'Příspěvky jsou použity k zajištění provozu serverů, na kterých běží webové stránky, multiplayer, online žebříčky atd.',
            ],
            'featured-artists' => [
                'title' => 'Oficiální umělci',
                'description' => 'S tvojí podporou můžeme získat více úžasných tvůrců a licencovat více skvělé hudby pro použití v osu!',
                'link_text' => 'Zobrazit aktuální seznam &raquo;',
            ],
            'ads' => [
                'title' => 'Pomoz osu! zůstat soběstačným',
                'description' => 'Vaše pomoc pomáhá udržet hru nezávislou a zcela bez reklam a externích sponzorů.',
            ],
            'tournaments' => [
                'title' => 'Oficiální turnaje',
                'description' => 'Pomoz financovat provozování (a zajištění cen) oficiálních osu! World Cup turnajů.',
                'link_text' => 'Prozkoumej turnaje &raquo;',
            ],
            'bounty-program' => [
                'title' => 'Podpora komunitních vývojářů',
                'description' => 'Podpoř komunitní vývojáře, kteří věnovali svůj volný čas a úsilí, aby udělali osu! lepší.',
                'link_text' => 'Zjistit více &raquo;',
            ],
        ],
        'perks' => [
            'title' => 'Skvělé! Jaké výhody dostanu?',
            'osu_direct' => [
                'title' => 'osu!direct',
                'description' => 'Získej rychlý a snadný přístup k vyhledávání a stahování beatmap bez opuštění hry.',
            ],

            'friend_ranking' => [
                'title' => 'Žebříček přátel',
                'description' => "Podívej se, jak moc dobrý jsi ve srovnání se svými přátely na žebříčku beatmapy, a to jak ve hře, tak i na webu.",
            ],

            'country_ranking' => [
                'title' => 'Státní žebříčky',
                'description' => 'Dobij svou zemi před dobytím světa.',
            ],

            'mod_filtering' => [
                'title' => 'Filtrovat podle módů',
                'description' => 'Asociovat pouze s lidmi, kteří hrají HDHR? Žádný problém!',
            ],

            'auto_downloads' => [
                'title' => 'Automatické Stahování',
                'description' => 'Automatické stahování při hraní s více hráči, sledování ostatních, nebo při klikání na odkazy v chatu!',
            ],

            'upload_more' => [
                'title' => 'Nahraj více',
                'description' => 'Další nevyřízené beatmapové sloty (za každou hodnocenou beatmapu), max 10.',
            ],

            'early_access' => [
                'title' => 'Předběžný přístup',
                'description' => 'Získej přístup k novým verzím s novými funkcemi před tím, než vyjdou!<br/><br/>To zahrnuje i předběžný přístup k novým funkcím na webu!',
            ],

            'customisation' => [
                'title' => 'Přizpůsobení',
                'description' => "Vyčnívejte nahráním vlastního obrázku záhlaví nebo vytvořením plně přizpůsobitelné 'me!' sekce na svém uživatelském profilu.",
            ],

            'beatmap_filters' => [
                'title' => 'Beatmapové filtry',
                'description' => 'Filtrujte vyhledávání beatmap podle hraných a nehraných map, nebo podle obdržené známky.',
            ],

            'yellow_fellow' => [
                'title' => 'Žlutý chlapík',
                'description' => 'Buďte odlišní ve hrě se světle žlutým jménem v chatu.',
            ],

            'speedy_downloads' => [
                'title' => 'Rychlé stahování',
                'description' => 'Méně omezená stahování, zejména když používáte osu!direct.',
            ],

            'change_username' => [
                'title' => 'Změna uživatelského jména',
                'description' => 'Možnost si jednou změnit zdarma své uživatelské jméno.',
            ],

            'skinnables' => [
                'title' => 'Větší přizpůsobivost skinů',
                'description' => 'Více přizpůsobitelných elementů skinu ve hře, například pozadí hlavního menu.',
            ],

            'feature_votes' => [
                'title' => 'Hlasování o funkcích',
                'description' => 'Hlasy pro požadavky na nové funkce. (2 za měsíc)',
            ],

            'sort_options' => [
                'title' => 'Možnosti třídění žebříčků',
                'description' => 'Možnost zobrazit hodnocení na mapě podle země / přátel / modifikací.',
            ],

            'more_favourites' => [
                'title' => 'Více oblíbených',
                'description' => 'Maximální počet beatmap, které můžeš mít v oblíbených, je navýšen z :normally &rarr; :supporter',
            ],
            'more_friends' => [
                'title' => 'Více přátel',
                'description' => 'Maximální počet přátel, které si můžeš přidat, je navýšen z :normally &rarr; :supporter',
            ],
            'more_beatmaps' => [
                'title' => 'Nahrát více Beatmap',
                'description' => 'Kolik čekajících beatmap můžeš mít najednou je vypočítáno ze základní hodnoty plus dodatečného bonusu za každou hodnocenou beatmapu, kterou máš (do určitého maxima).<br/><br/>Normálně je to :base plus :bonus za honocenou beatmapu (až :bonus_max maximálně). Se supporterem se toto zvýší na :supporter_base plus :supporter_bonus za hodnocenou mapu (až :supporter_bonus_max maximálně).',
            ],
            'friend_filtering' => [
                'title' => 'Žebříček kamarádů',
                'description' => 'Soutěž se svými přáteli a uvidíš, jak dobrý jsi v porovnáni s nimi!',
            ],

        ],
        'supporter_status' => [
            'contribution' => 'Díky za tvou podporu! Zatím jsi přispěl/a celkově :dollars napříč :tags nákupy supporter tagů!',
            'gifted' => ":giftedTags z vašich nákupů tagů bylo darováno (což dělá celkem :giftedDollars), jak štědré!",
            'not_yet' => "Ještě nemáš supporter tag :(",
            'valid_until' => 'Tvůj supporter tag je platný do :date!',
            'was_valid_until' => 'Tvůj supporter tag byl platný do :date.',
        ],
    ],
];
