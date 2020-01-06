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
            'error' => 'Hiba a poszt mentése közben',
        ],
    ],

    'discussion-votes' => [
        'update' => [
            'error' => 'Hiba a szavazat frissítése közben',
        ],
    ],

    'discussions' => [
        'allow_kudosu' => 'kudosu engedélyezése',
        'beatmap_information' => 'Beatmap Oldal',
        'delete' => 'törlés',
        'deleted' => 'Eltávolítva :editor által, :delete_time-kor.',
        'deny_kudosu' => 'kudosu megtagadása',
        'edit' => 'szerkesztés',
        'edited' => 'Utoljára frissítve :editor által, :update_time-kor.',
        'kudosu_denied' => 'Kudosu szerzéstől megtagadva.',
        'message_placeholder_deleted_beatmap' => 'Ez a nehézség törölve lett, ezért a beszélgetés nem lehetséges.',
        'message_placeholder_locked' => 'A beatmap megbeszélése meg lett tiltva.',
        'message_type_select' => 'Komment-típus választása',
        'reply_notice' => 'Nyomj entert a válaszoláshoz.',
        'reply_placeholder' => 'Ide írd a válaszod',
        'require-login' => 'Kérlek jelentkezz be posztoláshoz illetve válaszoláshoz',
        'resolved' => 'Megoldott',
        'restore' => 'visszaállítás',
        'show_deleted' => 'Töröltek megjelenítése',
        'title' => 'Megbeszélések',

        'collapse' => [
            'all-collapse' => 'Az összes becsukása',
            'all-expand' => 'Az összes kinyitása',
        ],

        'empty' => [
            'empty' => 'Egyetlen megbeszélés sincs még!',
            'hidden' => 'Egyetlen megbeszélés sem egyezik a kijelölt szűrővel.',
        ],

        'lock' => [
            'button' => [
                'lock' => 'Megbeszélés zárolása',
                'unlock' => 'Megbeszélés megnyitása',
            ],

            'prompt' => [
                'lock' => 'Zárolás oka',
                'unlock' => 'Biztos ki akarod nyitni?',
            ],
        ],

        'message_hint' => [
            'in_general' => 'Ez a poszt be fog kerülni az általános beatmap szett megbeszélésébe. A beatmap modolásához időbélyeggel kezdd az üzenetet (pl.: 00:12:345).',
            'in_timeline' => 'Több időbélyeg modolásához több poszt szükséges (egy poszt egy időbélyeghez).',
        ],

        'message_placeholder' => [
            'general' => 'Írj ide az Általános (:version) részlegbe való posztoláshoz',
            'generalAll' => 'Ide írj az Általánosba posztoláshoz (Összes nehézség)',
            'timeline' => 'Írj ide az Idővonalra (:version) való posztoláshoz',
        ],

        'message_type' => [
            'disqualify' => 'Diszkvalifikálás',
            'hype' => 'Hype!',
            'mapper_note' => 'Megjegyzés',
            'nomination_reset' => 'Nominálás Visszaállítása',
            'praise' => 'Dicséret',
            'problem' => 'Probléma',
            'review' => '',
            'suggestion' => 'Javaslat',
        ],

        'mode' => [
            'events' => 'Előzmények',
            'general' => 'Általános :scope',
            'reviews' => '',
            'timeline' => 'Idővonal',
            'scopes' => [
                'general' => 'Ez a nehézség',
                'generalAll' => 'Minden nehézség',
            ],
        ],

        'new' => [
            'pin' => 'Rögzítés',
            'timestamp' => 'Időbélyeg',
            'timestamp_missing' => 'Időbélyeg hozzáadásához nyomj ctrl-c billentyűkombinációt szerkesztő módban, majd illeszd be az üzenetedbe!',
            'title' => 'Új beszélgetés indítása',
            'unpin' => 'Rögzítés feloldása',
        ],

        'show' => [
            'title' => ':title készítette :mapper',
        ],

        'sort' => [
            'created_at' => 'Létrehozás ideje',
            'timeline' => 'Idővonal',
            'updated_at' => 'Utolsó frissítés',
        ],

        'stats' => [
            'deleted' => 'Törölve',
            'mapper_notes' => 'Megjegyzések',
            'mine' => 'Saját',
            'pending' => 'Függő',
            'praises' => 'Dicséretek',
            'resolved' => 'Megoldott',
            'total' => 'Mind',
        ],

        'status-messages' => [
            'approved' => 'Beatmap jóváhagyásának ideje: :date!',
            'graveyard' => "A beatmap :date óta nem kapott frissítést, valószínűleg el lett hanyagolva a készítő által...",
            'loved' => 'Ez a beatmap :date-kor lett loved!',
            'ranked' => 'Ez a beatmap :date-kor lett rangsorolt!',
            'wip' => 'Megjegyzés: Ez a beatmap még készítés alatt áll.',
        ],

        'votes' => [
            'none' => [
                'down' => '',
                'up' => '',
            ],
            'latest' => [
                'down' => '',
                'up' => '',
            ],
        ],
    ],

    'hype' => [
        'button' => 'Beatmap Hype-olása!',
        'button_done' => 'Már Hype-olt!',
        'confirm' => "Biztos vagy benne? Ezzel elhasználsz egyet a(z) :n darab hype-odból, ami visszavonhatatlan.",
        'explanation' => 'Hype-old a beatmap-et, hogy láthatóbbá tedd a jelöléshez és a rangsoroláshoz!',
        'explanation_guest' => 'Jelentkezz be és hype-old a beatmap-et, hogy láthatóbbá tedd a jelöléshez és a rangsoroláshoz!',
        'new_time' => "Kapsz még egy hype-ot :new_time-kor.",
        'remaining' => 'Még :remaining darab hype-od maradt.',
        'required_text' => 'Hype: :current/:required',
        'section_title' => 'Hype Vonat',
        'title' => 'Hype',
    ],

    'feedback' => [
        'button' => 'Visszajelzés Küldése',
    ],

    'nominations' => [
        'delete' => 'Törlés',
        'delete_own_confirm' => 'Biztos vagy benne? A beatmap törlésre kerül és vissza leszel irányítva a profilodra.',
        'delete_other_confirm' => 'Biztos vagy benne? A beatmap törlésre kerül és vissza leszel irányítva a felhasználó profiljára.',
        'disqualification_prompt' => 'Diszkvalifikáció oka?',
        'disqualified_at' => 'Diszkvalifikálva :time_ago (:reason).',
        'disqualified_no_reason' => 'nincs indok meghatározva',
        'disqualify' => 'Diszkvalifikálás',
        'incorrect_state' => 'Hiba a művelet végrehajtása közben, próbáld meg újratölteni az oldalt.',
        'love' => 'Love',
        'love_confirm' => 'Love-olod ezt a beatmap-et?',
        'nominate' => 'Nominálás',
        'nominate_confirm' => 'Nominálod ezt a beatmapot?',
        'nominated_by' => 'nominálva :users által',
        'not_enough_hype' => "",
        'qualified' => 'Előreláthatólag :date-kor lesz rangsorolva, ha nem találnak benne problémát.',
        'qualified_soon' => 'Hamarosan rangsorolva lesz, ha nem találnak benne problémát.',
        'required_text' => 'Nominálások: :current/:required',
        'reset_message_deleted' => 'törölve',
        'title' => 'Nominálási Állapot',
        'unresolved_issues' => 'Még mindig vannak megoldatlan problémák amelyeket először kezelni kell.',

        'reset_at' => [
            'nomination_reset' => 'A nominálási folyamat újraindításra került :time_ago-kor :user által: :discussion (:message).',
            'disqualify' => ':time_ago óta diszkvalifikálva :user által egy új probléma miatt :discussion (:message).',
        ],

        'reset_confirm' => [
            'nomination_reset' => 'Biztos vagy ebben? Egy új probléma posztolása alaphelyzetbe állítja a nominálási folyamatot.',
            'disqualify' => 'Biztos vagy benne? Ezzel kizárod a beatmap-et a kvalifikálásból és alaphelyzetbe áll a nominálás.',
        ],
    ],

    'listing' => [
        'search' => [
            'prompt' => 'írj kulcsszavakat...',
            'login_required' => 'Jelentkezz be a kereséshez.',
            'options' => 'További Keresési Beállítások',
            'supporter_filter' => 'A :filters általi szűrés egy aktív osu!supporter címet igényel',
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
                'played' => 'Lejátszott',
            ],
            'sorting' => [
                'title' => 'Cím',
                'artist' => 'Előadó',
                'difficulty' => 'Nehézség',
                'favourites' => 'Kedvencek',
                'updated' => 'Frissítve',
                'ranked' => 'Rangsorolt',
                'rating' => 'Értékelés',
                'plays' => 'Játszások',
                'relevance' => 'Relevancia',
                'nominations' => 'Nominációk',
            ],
            'supporter_filter_quote' => [
                '_' => ':filters általi szűrés aktív :link-et igényel',
                'link_text' => 'osu!supporter cím',
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
        'approved' => 'Jóváhagyott',
        'favourites' => 'Kedvencek',
        'graveyard' => 'Temető',
        'leaderboard' => 'Van Ranglistája',
        'loved' => 'Loved',
        'mine' => 'Saját mapjaim',
        'pending' => 'Függőben lévő & WIP',
        'qualified' => 'Kvalifikált',
        'ranked' => 'Rangsorolt',
    ],
    'genre' => [
        'any' => 'Bármelyik',
        'unspecified' => 'Nem meghatározott',
        'video-game' => 'Videojáték',
        'anime' => 'Anime',
        'rock' => 'Rock',
        'pop' => 'Pop',
        'other' => 'Egyéb',
        'novelty' => 'Kortárs',
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
        'MR' => 'Mirror',
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
        'instrumental' => 'Instrumentális',
        'other' => 'Egyéb',
    ],
    'played' => [
        'any' => 'Bármelyik',
        'played' => 'LeJátszott',
        'unplayed' => 'Nem játszott',
    ],
    'extra' => [
        'video' => 'Videót Tartalmaz',
        'storyboard' => 'Storyboard-ot Tartalmaz',
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
    'panel' => [
        'playcount' => 'Játékszám: :count',
        'favourites' => 'Kedvencek: :count',
    ],
];
