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
    'discussion-posts' => [
        'store' => [
            'error' => 'Hiba poszt mentése közben',
        ],
    ],

    'discussion-votes' => [
        'update' => [
            'error' => 'Hiba szavazat frissítése közben',
        ],
    ],

    'discussions' => [
        'allow_kudosu' => 'kudosu engedélyezése',
        'delete' => 'törlés',
        'deleted' => 'Eltávolítva :editor által, :delete_time-kor.',
        'deny_kudosu' => 'kudosu megtagadása',
        'edit' => 'szerkesztés',
        'edited' => 'Utoljára frissítve :editor által, :update_time-kor.',
        'kudosu_denied' => 'Kudosu szerzéstől megtagadva.',
        'message_placeholder_deleted_beatmap' => 'Ez a nehézség törölve lett, így már nem lehet vitatni.',
        'message_type_select' => 'Komment típusának választása',
        'reply_notice' => 'Nyomj entert a válaszoláshoz.',
        'reply_placeholder' => 'Ide írd a válaszod',
        'require-login' => 'Kérlek jelentkezz be posztoláshoz illetve válaszoláshoz',
        'resolved' => 'Megoldva',
        'restore' => 'visszaállítás',
        'title' => 'Megbeszélések',

        'collapse' => [
            'all-collapse' => 'Az összes becsukása',
            'all-expand' => 'Az összes kinyitása',
        ],

        'empty' => [
            'empty' => 'Egyetlen megbeszélés sincs még!',
            'hidden' => 'Egyetlen megbeszélés sem egyezik a kijelölt szűrővel.',
        ],

        'message_hint' => [
            'in_general' => 'Ez a poszt bekerül az általános beatmapszet megbeszélésbe.A beatmap modolásához kezdj egy üzenetet időbélyeggel (pl.: 00:12:345).',
            'in_timeline' => 'Több időbélyeg modolásához, posztolj több időt (egy poszt időbélyegenként).',
        ],

        'message_placeholder' => [
            'general' => 'Írj ide az Általános (:version) részleghez való posztoláshoz',
            'generalAll' => '',
            'timeline' => 'Írj ide az Idővonalra való posztoláshoz (:version)',
        ],

        'message_type' => [
            'disqualify' => 'Diszkvalifikált',
            'hype' => 'Hype!',
            'mapper_note' => 'Megjegyzés',
            'nomination_reset' => 'Megjelölés újrakezdése',
            'praise' => 'Dicséret',
            'problem' => 'Probléma',
            'suggestion' => 'Javaslat',
        ],

        'mode' => [
            'events' => 'Előzmények',
            'general' => 'Általános :scope',
            'timeline' => 'Idővonal',
            'scopes' => [
                'general' => 'Ez a nehézség',
                'generalAll' => 'Minden nehézség',
            ],
        ],

        'new' => [
            'timestamp' => 'Időbélyeg',
            'timestamp_missing' => 'ctrl-c szerkesztő módban és másold be az üzenetedbe időbélyeg hozzáadásához!',
            'title' => 'Új vita indítása',
        ],

        'show' => [
            'title' => ':title készítette :mapper',
        ],

        'sort' => [
            '_' => 'Listázva:',
            'created_at' => 'elkészítési idő',
            'timeline' => 'idővonal',
            'updated_at' => 'utolsó frissítés',
        ],

        'stats' => [
            'deleted' => 'Törölve',
            'mapper_notes' => 'Jegyzetek',
            'mine' => 'Saját',
            'pending' => 'Függő',
            'praises' => 'Dicséretek',
            'resolved' => 'Megoldva',
            'total' => 'Mind',
        ],

        'status-messages' => [
            'approved' => 'Ezt a beatmapot ekkor hagyták jóvá : :date!',
            'graveyard' => "Ezt a beatmap-et nem frissítették :date óta, és a készítő valszószínú elhagyatott állapotba hozta...",
            'loved' => 'Ezt a beatmap ekkor lett kedvelt: :date!',
            'ranked' => 'Ez a beatmap ekkor lett rangsorolt : :date!',
            'wip' => 'Megjegyzés: Ez a beatmap még készítés alatt áll.',
        ],

    ],

    'hype' => [
        'button' => 'Hype Beatmap!',
        'button_done' => 'Már felhypeolt!',
        'confirm' => "Biztos vagy benne? Ezzel elhasználsz egyet az :n hype-odból, és nem lehet visszavonni.",
        'explanation' => 'Hypeold a beatmapet, hogy még láthatóbbá tedd kijelöléshez és rankoláshoz!',
        'explanation_guest' => 'Jelentkezz be és hypeold a beatmapet, hogy még láthatóbbá tedd kijelöléshez és rankoláshoz!',
        'new_time' => "Kapsz még egy hypeot :new_time-kor.",
        'remaining' => ':remaining hypeod maradt hátra.',
        'required_text' => 'Hype: :current/:required',
        'section_title' => 'Hype vonat',
        'title' => 'Hype',
    ],

    'feedback' => [
        'button' => 'Visszajelzés Küldése',
    ],

    'nominations' => [
        'disqualification_prompt' => 'Diszkvalifikáció oka?',
        'disqualified_at' => 'Diszkvalifikálva :time_ago (:reason).',
        'disqualified_no_reason' => 'nincs ok meghatározva',
        'disqualify' => 'Diszkvalifikálás',
        'incorrect_state' => 'Hiba a művelet végrehajtásában, próbáld meg újratölteni az oldalt.',
        'nominate' => 'Kijelölni',
        'nominate_confirm' => 'Kijelölöd ezt a beatmapet?',
        'nominated_by' => 'kijelölve :users által',
        'qualified' => 'Előreláthatóan rankolva lesz :date-án/én , ha semmi probléma nem lesz találva.',
        'qualified_soon' => 'Előreláthatóan rankolva lesz hamarosan, ha semmi probléma nem lesz találva.',
        'required_text' => 'Kijelölések: :current/:required',
        'reset_message_deleted' => 'törölve',
        'title' => 'Kijelöltségi állapot',
        'unresolved_issues' => 'Még mindig vannak problémák amelyeket először meg kellene oldani.',

        'reset_at' => [
            'nomination_reset' => 'A kijelölési folyamat újaindításra került :time_ago :user által: :discussion (:message).',
            'disqualify' => 'Kizárva :time_ago -ja :user által e miatt a probléma miatt: :discussion (:message).',
        ],

        'reset_confirm' => [
            'nomination_reset' => 'Biztos vagy ebben? Egy új probléma posztolása nullázza a jelölési folyamatot.',
        ],
    ],

    'listing' => [
        'search' => [
            'prompt' => 'írj kulcsszavakkal...',
            'options' => 'További Keresési Beállítások',
            'supporter_filter' => ':filters által alvó szűrés támogatói tagot igényel',
            'not-found' => 'nincs találat',
            'not-found-quote' => '... semmit, semmit nem találtam.',
            'filters' => [
                'general' => 'Általános',
                'mode' => 'Mód',
                'status' => 'Rank Státusz',
                'genre' => 'Műfaj',
                'language' => 'Nyelv',
                'extra' => 'extra',
                'rank' => 'Rank elérve',
                'played' => 'Játszott',
            ],
            'sorting' => [
                'title' => 'cím',
                'artist' => 'előadó',
                'difficulty' => 'nehézség',
                'updated' => 'frissítve',
                'ranked' => 'rankolt',
                'rating' => 'értékelés',
                'plays' => 'játszottság',
                'relevance' => 'relevancia',
                'nominations' => 'kijelölések',
            ],
            'supporter_filter_quote' => [
                '_' => ':filters által alvó szűrés aktiv :linket igényel',
                'link_text' => 'támogatói cím',
            ],
        ],
        'mode' => 'Mód',
        'status' => 'Rank Státusz',
        'source' => ':source -bol/-ból',
        'load-more' => 'Továbbiak betöltése...',
    ],
    'general' => [
        'recommended' => 'Ajánlott nehézség',
        'converts' => 'Konvertált beatmap-ek tartalmazása',
    ],
    'mode' => [
        'any' => 'Bármelyik',
        'osu' => '',
        'taiko' => '',
        'fruits' => '',
        'mania' => '',
    ],
    'status' => [
        'any' => 'Bármelyik',
        'ranked-approved' => 'Ranked & Elfogadott',
        'approved' => 'Elfogadott',
        'qualified' => 'Kvalifikált',
        'loved' => 'Kedvelt',
        'faves' => 'Kedvencek',
        'pending' => 'Függő',
        'graveyard' => 'Temető',
        'my-maps' => 'Saját pályáim',
    ],
    'genre' => [
        'any' => 'Bármelyik',
        'unspecified' => 'Nem meghatározott',
        'video-game' => 'Videójáték',
        'anime' => 'Anime',
        'rock' => 'Rock',
        'pop' => 'Pop',
        'other' => 'Egyéb',
        'novelty' => 'Újdonság',
        'hip-hop' => 'Hip Hop',
        'electronic' => 'Elektronikus',
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
        'english' => 'Angol',
        'chinese' => 'Kínai',
        'french' => 'Francia',
        'german' => 'Német',
        'italian' => 'Olasz',
        'japanese' => 'Japán',
        'korean' => 'Koreai',
        'spanish' => 'Spanyol',
        'swedish' => 'Svéd',
        'instrumental' => 'Hangszeres',
        'other' => 'Egyéb',
    ],
    'played' => [
        'any' => 'Bármelyik',
        'played' => 'Játszott',
        'unplayed' => 'Nem játszott',
    ],
    'extra' => [
        'video' => 'Van Videó',
        'storyboard' => 'Van Storyboard',
    ],
    'rank' => [
        'any' => 'Bármelyik',
        'XH' => 'Ezüst SS',
        'X' => '',
        'SH' => 'Ezüst S',
        'S' => '',
        'A' => '',
        'B' => '',
        'C' => '',
        'D' => '',
    ],
];
