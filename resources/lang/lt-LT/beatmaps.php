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
            'error' => 'Nepavyko išsaugoti įrašo',
        ],
    ],

    'discussion-votes' => [
        'update' => [
            'error' => 'Balsavimo nepavyko atnaujinti',
        ],
    ],

    'discussions' => [
        'allow_kudosu' => 'leisti „kudosu“',
        'beatmap_information' => '„Beatmap“ puslapis',
        'delete' => 'ištrinti',
        'deleted' => 'Panaikino :editor :delete_time.',
        'deny_kudosu' => 'atmesti kudosu',
        'edit' => 'redaguoti',
        'edited' => 'Paskutinį kartą redagavo :editor :update_time.',
        'kudosu_denied' => 'Uždrausta gauti kudosu.',
        'message_placeholder_deleted_beatmap' => 'Šis sudėtingumas buvo ištrintas, todėl jo diskusijos nebegalimos.',
        'message_placeholder_locked' => 'Šio „Beatmap“ diskusijos, buvo išjungtos',
        'message_type_select' => 'Pasirink Komentaro Tipą',
        'reply_notice' => 'Spausk Enter norint atsakyti.',
        'reply_placeholder' => 'Rrašykite savo atsakymą čia',
        'require-login' => 'Atsakymui reikia prisijungti',
        'resolved' => 'Išspręsta',
        'restore' => 'atkurti',
        'show_deleted' => 'Peržiūrėti ištrintus',
        'title' => 'Diskusijos',

        'collapse' => [
            'all-collapse' => 'Sutraukti visus',
            'all-expand' => 'Išskleisti visus',
        ],

        'empty' => [
            'empty' => 'Diskusiju kol kas nėra!',
            'hidden' => 'Nėra diskusijų atitinkančių filtrą.',
        ],

        'lock' => [
            'button' => [
                'lock' => '',
                'unlock' => '',
            ],

            'prompt' => [
                'lock' => '',
                'unlock' => '',
            ],
        ],

        'message_hint' => [
            'in_general' => 'Ši žinutė bus perkeltą į bendrą beatmapo rinkinio diskusiją. Beatmapo kritikavimui, pradėk žinutę su laiko nuoroda (pvz.: 00:12:345).',
            'in_timeline' => 'Kad kritikuoti kelis laikus, siųsk žinutę kelis kartus (vieną per laiko žymę).',
        ],

        'message_placeholder' => [
            'general' => 'Rašyk čia kad siųsti į Bendrą (:version)',
            'generalAll' => 'Rašyk čia kad siųsti į Bendrą (Visiem sudėtingumams)',
            'timeline' => 'Rašyk čia kad siųsti į Laiko juostą (:version)',
        ],

        'message_type' => [
            'disqualify' => 'Diskvalifikuoti',
            'hype' => 'Iškelti!',
            'mapper_note' => 'Pastaba',
            'nomination_reset' => 'Ištrinti Nominaciją',
            'praise' => 'Pagirti',
            'problem' => 'Problema',
            'review' => '',
            'suggestion' => 'Pasiūlymas',
        ],

        'mode' => [
            'events' => 'Istorija',
            'general' => 'Bendra :scope',
            'reviews' => '',
            'timeline' => 'Laiko juosta',
            'scopes' => [
                'general' => 'Šis sudėtingumas',
                'generalAll' => 'Visi sudėtingumai',
            ],
        ],

        'new' => [
            'pin' => 'Prisegti',
            'timestamp' => 'Laiko žymė',
            'timestamp_missing' => 'ctrl+c redagavimo lange ir įklijuok į savo žinutę tam kad pridėti laiko žymę!',
            'title' => 'Nauja Diskusija',
            'unpin' => 'Atsegti',
        ],

        'show' => [
            'title' => ':title sukūrė :mapper',
        ],

        'sort' => [
            'created_at' => 'Sukūrimo laikas',
            'timeline' => 'Veikla',
            'updated_at' => 'Paskutinis atnaujinimas',
        ],

        'stats' => [
            'deleted' => 'Ištrinta',
            'mapper_notes' => 'Pastabos',
            'mine' => 'Mano',
            'pending' => 'Laukiami',
            'praises' => 'Pagyrimai',
            'resolved' => 'Išspręsta',
            'total' => 'Visi',
        ],

        'status-messages' => [
            'approved' => 'Šis beatmapas buvo patvirtintas :date!',
            'graveyard' => "Šis beatmapas jau nebeatnaujinamas nuo :date ir greičiausiai buvo apleistas kūrėjo...",
            'loved' => 'Šis beatmapas buvo pridėtas kaip pamėgtas nuo :date!',
            'ranked' => 'Šis beatmapas buvo patvirtintas nuo :date!',
            'wip' => 'Pastaba: Šis beatmapas yra kūrėjo pažymėtas kaip vis dar kuriamas.',
        ],

        'votes' => [
            'none' => [
                'down' => 'Dar nėra neigiamų balsų',
                'up' => 'Dar nėra teigiamų balsų',
            ],
            'latest' => [
                'down' => 'Pastarieji neigiami balsavimai',
                'up' => 'Pastarieji teigiami balsavimai',
            ],
        ],
    ],

    'hype' => [
        'button' => 'Iškelti Beatmapą!',
        'button_done' => 'Jau Iškeltas!',
        'confirm' => "Ar tikrai? Tai išnaudos vieną iš tavo likusių :n iškėlimų, ir šio veiksmo nebus galima grąžinti.",
        'explanation' => 'Iškelti šį beatmapą kad jis būtų labiau matomas nominacijai ir patvirtinimui!',
        'explanation_guest' => '',
        'new_time' => "",
        'remaining' => '',
        'required_text' => 'Sušukimai: :current/:required',
        'section_title' => 'Hype traukinys',
        'title' => 'Sušukimas',
    ],

    'feedback' => [
        'button' => 'Palikti Atsiliepimą',
    ],

    'nominations' => [
        'delete' => 'Ištrinti',
        'delete_own_confirm' => 'At tu tikras? „beatmap“ bus pašalintas ir būsi nukreiptas į savo profilį.',
        'delete_other_confirm' => 'At tu tikras? „beatmap“ bus pašalintas ir būsi nukreiptas į žaidėjo profilį.',
        'disqualification_prompt' => 'Kodėl diskvalifikuoji?',
        'disqualified_at' => 'Diskvalifikuotas prieš :time_ago (:reason).',
        'disqualified_no_reason' => 'nėra nurodytos priežasties',
        'disqualify' => 'Diskvalifikuoti',
        'incorrect_state' => 'Įvyko klaida atliekant šį veiksmą, pamėgink atnaujinti puslapį.',
        'love' => 'Patikę',
        'love_confirm' => 'Mylėti ši „beatmap“?',
        'nominate' => 'Nominuoti',
        'nominate_confirm' => 'Nominuoti šį beatmapą?',
        'nominated_by' => 'nominavo :users',
        'not_enough_hype' => "",
        'qualified' => 'Jei neatsiras problemų, numatoma patvirtinimo data :date.',
        'qualified_soon' => 'Jei neatsiras problemų, bus patvirtintas greitu metu.',
        'required_text' => 'Nominacijos: :current/:required',
        'reset_message_deleted' => 'ištrinta',
        'title' => 'Nominacijos statusas',
        'unresolved_issues' => '',

        'reset_at' => [
            'nomination_reset' => '',
            'disqualify' => '',
        ],

        'reset_confirm' => [
            'nomination_reset' => '',
            'disqualify' => '',
        ],
    ],

    'listing' => [
        'search' => [
            'prompt' => 'rašykite klavišais...',
            'login_required' => '',
            'options' => 'Daugiau paieškos nustatymų',
            'supporter_filter' => 'Rūšiavimas pagal :filters reikalauja aktyvios „osu!supporter“ žymos',
            'not-found' => 'nėra rezultatų',
            'not-found-quote' => '... ne, nieko nerasta.',
            'filters' => [
                'general' => 'Bendra',
                'mode' => 'Režimas',
                'status' => 'Kategorijos',
                'genre' => 'Žanras',
                'language' => 'Kalba',
                'extra' => 'papildoma',
                'rank' => 'Pasiektas reitingas',
                'played' => 'Grojo',
            ],
            'sorting' => [
                'title' => 'Pavadinimas',
                'artist' => 'Atlikėjas',
                'difficulty' => 'Sudėtingumas',
                'favourites' => 'Mėgstamiausi',
                'updated' => 'Atnaujintas',
                'ranked' => 'Patvirtintas',
                'rating' => 'Įvertinimas',
                'plays' => '',
                'relevance' => 'Aktualumas',
                'nominations' => 'Nominacijos',
            ],
            'supporter_filter_quote' => [
                '_' => 'Rūšiavimas pagal :filters reikalauja aktyvaus :link',
                'link_text' => '„osu!supporter“ žyma',
            ],
        ],
    ],
    'general' => [
        'recommended' => 'Rekomenduojamas sudėtingumas',
        'converts' => 'Įtraukite konvertuotus „Beatmaps“',
    ],
    'mode' => [
        'any' => 'Bet kas',
        'osu' => '',
        'taiko' => '',
        'fruits' => '',
        'mania' => '',
    ],
    'status' => [
        'any' => 'Bet kas',
        'approved' => 'Patvirtintas',
        'favourites' => 'Mėgstamiausi',
        'graveyard' => 'Kapinės',
        'leaderboard' => 'Turi pirmaujančiųjų sarašą',
        'loved' => 'Patikę',
        'mine' => '',
        'pending' => '',
        'qualified' => 'Kvalifikuotas',
        'ranked' => 'Patvirtintas',
    ],
    'genre' => [
        'any' => 'Bet koks',
        'unspecified' => 'Nenurodyta',
        'video-game' => 'Kompiuterinis žaidimas',
        'anime' => 'Anime',
        'rock' => 'Rokas',
        'pop' => 'Pop',
        'other' => 'Kiti',
        'novelty' => '',
        'hip-hop' => 'Hip Hop',
        'electronic' => 'Elektronika',
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
        'MR' => 'Veidrodžio atspindys',
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
        'english' => 'Anglų',
        'chinese' => 'Kinų',
        'french' => 'Prancūzų',
        'german' => 'Vokiečių',
        'italian' => 'Italų',
        'japanese' => 'Japonų',
        'korean' => 'Korėjiečių',
        'spanish' => 'Ispanų',
        'swedish' => 'Švedų',
        'instrumental' => 'Instrumentinė',
        'other' => 'Kiti',
    ],
    'played' => [
        'any' => 'Bet kas',
        'played' => 'Grojo',
        'unplayed' => 'Negroti',
    ],
    'extra' => [
        'video' => 'Turi Video',
        'storyboard' => 'Turi Istoriją',
    ],
    'rank' => [
        'any' => 'Bet koks',
        'XH' => 'Sidabrinis SS',
        'X' => '',
        'SH' => 'Sidabrinis S',
        'S' => '',
        'A' => '',
        'B' => '',
        'C' => '',
        'D' => '',
    ],
    'panel' => [
        'playcount' => 'Žaidimų skaičius :count',
        'favourites' => 'Mėgstamiausi :count',
    ],
];
