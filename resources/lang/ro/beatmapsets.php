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
    'availability' => [
        'disabled' => 'Acest beatmap nu poate fi descărcat momentan.',
        'parts-removed' => 'Unele porțiuni din acest beatmap au fost eliminate la cererea creatorului sau al unui deținător de drepturi de autor.',
        'more-info' => 'Vezi aici pentru mai multe informații.',
    ],

    'index' => [
        'title' => 'Listarea beatmapurilor',
        'guest_title' => 'Beatmaps',
    ],

    'show' => [
        'discussion' => 'Discuție',

        'details' => [
            'approved' => 'aprobat pe ',
            'favourite' => 'Adaugă acest beatmapset la favorite',
            'favourited_count' => '+ 1 alta!|+ :count alte!',
            'logged-out' => 'Trebuie să te autentifici înainte de a descărca vreun beatmap!',
            'loved' => 'loved pe ',
            'mapped_by' => 'mapat de :mapper',
            'qualified' => 'calificat pe ',
            'ranked' => 'clasat pe ',
            'submitted' => 'trimis pe ',
            'unfavourite' => 'Elimină acest beatmapset de la favorite',
            'updated' => 'ultima dată actualizat ',
            'updated_timeago' => 'ultima dată actualizat :timeago',

            'download' => [
                '_' => 'Descarcă',
                'direct' => '',
                'no-video' => 'fără videoclip',
                'video' => 'cu videoclip',
            ],

            'login_required' => [
                'bottom' => '',
                'top' => '',
            ],
        ],

        'favourites' => [
            'limit_reached' => '',
        ],

        'hype' => [
            'action' => 'Hype această mapă dacă ți-a plăcut să o joci, astfel încât să progreseze la stadiul de <strong>Clasat</strong>.',

            'current' => [
                '_' => 'Această mapă este în prezent :status.',

                'status' => [
                    'pending' => 'în așteptare',
                    'qualified' => 'calificată',
                    'wip' => 'muncă în desfășurare',
                ],
            ],
        ],

        'info' => [
            'description' => 'Descriere',
            'genre' => 'Gen',
            'language' => 'Limbă',
            'no_scores' => 'Încă se calculează datele...',
            'points-of-failure' => 'Puncte de eșec',
            'source' => 'Sursă',
            'success-rate' => 'Rata de succes',
            'tags' => 'Tag-uri',
            'unranked' => 'Beatmap neclasificat',
        ],

        'scoreboard' => [
            'achieved' => 'realizat :when',
            'country' => 'Clasament pe țară',
            'friend' => 'Clasamentul prietenilor',
            'global' => 'Clasament global',
            'supporter-link' => 'Click <a href=":link">aici</a> pentru a vedea toate avantajele pe care le poți obține!',
            'supporter-only' => 'Trebuie să fii un suporter pentru a accesa clasamentul prietenilor și pe țară!',
            'title' => 'Tabela de scor',

            'headers' => [
                'accuracy' => 'Precizie',
                'combo' => 'Combo maxim',
                'miss' => 'Ratări',
                'mods' => 'Moduri',
                'player' => 'Jucător',
                'pp' => '',
                'rank' => 'Rang',
                'score_total' => 'Scor total',
                'score' => 'Scor',
            ],

            'no_scores' => [
                'country' => 'Nimeni din țara ta nu a stabilit un scor pe această mapă încă!',
                'friend' => 'Nimeni din prietenii tăi nu a stabilit un scor pe această mapă încă!',
                'global' => 'Niciun scor încă. Poate ar trebui să încerci să obții câteva?',
                'loading' => 'Se încarcă scorurile...',
                'unranked' => 'Beatmap neclasificat.',
            ],
            'score' => [
                'first' => 'În top',
                'own' => 'Cel mai bun',
            ],
        ],

        'stats' => [
            'cs' => 'Dimensiunea cercului',
            'cs-mania' => 'Numărul de taste',
            'drain' => 'Scurgere HP',
            'accuracy' => 'Precizie',
            'ar' => 'Viteza de apropiere',
            'stars' => 'Dificultatea de stele',
            'total_length' => 'Durată',
            'bpm' => 'BPM',
            'count_circles' => 'Numărul de cercuri',
            'count_sliders' => 'Numărul de glisări',
            'user-rating' => 'Evaluarea jucătorului',
            'rating-spread' => 'Clasament grafic',
            'nominations' => 'Nominalizări',
            'playcount' => 'Numărul de jucări',
        ],
    ],
];
