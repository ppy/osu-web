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
    'availability' => [
        'disabled' => 'Acest beatmap nu este disponibil pentru descărcare momentan.',
        'parts-removed' => 'Porțiuni din acest beatmap au fost eliminate la cererea creatorului sau a unui deținător de drepturi de autor.',
        'more-info' => 'Verifică aici pentru mai multe informații.',
    ],

    'index' => [
        'title' => 'Listarea beatmaps',
        'guest_title' => 'Beatmaps',
    ],

    'show' => [
        'discussion' => 'Discuție',

        'details' => [
            'mapped_by' => 'mapat de :mapper',
            'submitted' => 'trimis pe ',
            'updated' => 'ultima dată actualizat pe ',
            'updated_timeago' => 'ultima dată actualizat pe :timeago',
            'ranked' => 'clasat pe ',
            'approved' => 'aprobat pe ',
            'qualified' => 'calificat pe ',
            'loved' => 'loved pe ',
            'logged-out' => 'Trebuie să te autentifici înainte de a descărca orice beatmap!',
            'download' => [
                '_' => 'Descarcă',
                'video' => 'cu video',
                'no-video' => 'fără video',
                'direct' => '',
            ],
            'favourite' => 'Adăugați acest beatmapset la favorite',
            'unfavourite' => 'Elimnă acest beatmapset de la favorite',
            'favourited_count' => '+ 1 alta!|+ :count alte!',
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
            'supporter-link' => 'Faceți clic <a href=":link">aici</a> pentru a vedea toate avantajele extravagante pe care le obții!',
            'supporter-only' => 'Trebuie să fi un suporter pentru a accesa clasamentul prietenilor și pe țară!',
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
    ],
];
