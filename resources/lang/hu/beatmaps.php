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
            'error' => 'Sikertelen poszt mentés',
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
            'in_general' => 'Ez a poszt az általános beatmapszett megbeszélésbe kerül. A beatmap modolásához időbélyeggel kezdd az üzenetet (pl.: 00:12:345).',
            'in_timeline' => 'Több időbélyeg modolásához több poszt szükséges (egy poszt egy időbélyeghez).',
        ],

        'message_placeholder' => [
            'general' => 'Írj ide az Általános (:version) részlegbe való posztoláshoz',
            'generalAll' => 'Ide írj az Általános-ba posztoláshoz (Összes nehézség)',
            'timeline' => 'Írj ide az Idővonalra való posztoláshoz (:version)',
        ],

        'message_type' => [
            'disqualify' => 'Diszkvalifikált',
            'hype' => 'Hype!',
            'mapper_note' => 'Megjegyzés',
            'nomination_reset' => 'Nomináció Visszaállítása',
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
                'generalAll' => 'Összes nehézség',
            ],
        ],

        'new' => [
            'timestamp' => 'Időbélyeg',
            'timestamp_missing' => 'ctrl-c szerkesztő módban és másold be az üzenetedbe időbélyeg hozzáadásához!',
            'title' => 'Új megbeszélés indítása',
        ],

        'show' => [
            'title' => ':title készítette :mapper',
        ],

        'sort' => [
            '_' => 'Rendezve:',
            'created_at' => 'létrehozás ideje',
            'timeline' => 'idővonal',
            'updated_at' => 'utolsó frissítés',
        ],

        'stats' => [
            'deleted' => 'Törölve',
            'mapper_notes' => 'Megjegyzések',
            'mine' => 'Saját',
            'pending' => 'Függő',
            'praises' => 'Dicséretek',
            'resolved' => 'Megoldva',
            'total' => 'Mind',
        ],

        'status-messages' => [
            'approved' => 'Ezt a beatmapot ekkor hagyták jóvá : :date!',
            'graveyard' => "Ezt a beatmap :date óta nem kapott frissítést és valószínűleg hátrahagyta a készítője...",
            'loved' => 'Ez a beatmap ekkor lett kedvelt: :date!',
            'ranked' => 'Ez a beatmap ekkor lett rangsorolva: :date!',
            'wip' => 'Megjegyzés: Ezen a beatmapen még munkálatok folynak.',
        ],

    ],

    'hype' => [
        'button' => 'Beatmap Hype-olása!',
        'button_done' => 'Már Hype-olt!',
        'confirm' => "Biztos vagy benne? Ezzel elhasználsz egyet az :n hype-odból, és nem lehet visszavonni.",
        'explanation' => 'Hype-old a beatmapet, hogy még láthatóbbá tedd nomináláshoz és rangoláshoz!',
        'explanation_guest' => 'Jelentkezz be és Hype-old a beatmapet, hogy még láthatóbbá tedd nomináláshoz és rangoláshoz!',
        'new_time' => "Kapsz még egy hypeot :new_time-kor.",
        'remaining' => 'Még :remaining hype-od maradt.',
        'required_text' => 'Hype: :current/:required',
        'section_title' => 'Hype Vonat',
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
        'love' => 'Kedvelés',
        'love_confirm' => 'Kedveled ezt a beatmapot?',
        'nominate' => 'Nominálás',
        'nominate_confirm' => 'Nominálod ezt a beatmapot?',
        'nominated_by' => 'nominálva :users által',
        'qualified' => 'Előreláthatóan :date-kor lesz rangsorolva, ha nem találnak vele problémát.',
        'qualified_soon' => 'Hamarosan rangsorolva lesz, ha nem találnak vele problémát.',
        'required_text' => 'Nominálások: :current/:required',
        'reset_message_deleted' => 'törölve',
        'title' => 'Nominálási Állapot',
        'unresolved_issues' => 'Még mindig vannak problémák amelyeket először meg kellene oldani.',

        'reset_at' => [
            'nomination_reset' => 'A nominálási folyamat újraindításra került :time_ago :user által: :discussion (:message).',
            'disqualify' => ':time_ago óta diszkvalifikálva :user által egy új probléma miatt :discussion (:message).',
        ],

        'reset_confirm' => [
            'nomination_reset' => 'Biztos vagy ebben? Egy új probléma posztolása alaphelyzetbe állítja a nominálási folyamatot.',
        ],
    ],

    'listing' => [
        'search' => [
            'prompt' => 'írj kulcsszavakat...',
            'login_required' => 'Jelentkezz be a kereséshez.',
            'options' => 'További Keresési Beállítások',
            'supporter_filter' => 'A :filters általi szűrés egy aktív osu!támogatói címet igényel',
            'not-found' => 'nincs találat',
            'not-found-quote' => '... nope, semmit sem találtam.',
            'filters' => [
                'general' => 'Általános',
                'mode' => 'Mód',
                'status' => 'Kategóriák',
                'genre' => 'Műfaj',
                'language' => 'Nyelv',
                'extra' => 'extra',
                'rank' => 'Elért Rang',
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
                'nominations' => 'nominációk',
            ],
            'supporter_filter_quote' => [
                '_' => ':filters általi szűrés aktiv :link-et igényel',
                'link_text' => 'osu!támogatói cím',
            ],
        ],
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
        'ranked-approved' => 'Rangsorolt & Elfogadott',
        'approved' => 'Elfogadott',
        'qualified' => 'Kvalifikált',
        'loved' => 'Kedvelt',
        'faves' => 'Kedvencek',
        'pending' => 'Függőben lévő & WIP',
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
        'video' => 'Tartalmaz Videót',
        'storyboard' => 'Storyboardot Tartalmaz',
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
