<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'availability' => [
        'disabled' => 'Acest beatmap nu poate fi descărcat momentan.',
        'parts-removed' => 'Unele porțiuni din acest beatmap au fost eliminate la cererea creatorului sau al unui deținător de drepturi de autor.',
        'more-info' => 'Vezi aici pentru mai multe informații.',
        'rule_violation' => '',
    ],

    'download' => [
        'limit_exceeded' => '',
    ],

    'featured_artist_badge' => [
        'label' => '',
    ],

    'index' => [
        'title' => 'Listarea beatmapurilor',
        'guest_title' => 'Beatmaps',
    ],

    'panel' => [
        'empty' => '',

        'download' => [
            'all' => 'descarcă',
            'video' => 'descarcă cu video',
            'no_video' => 'descarcă fără video',
            'direct' => 'deschide în osu!direct',
        ],
    ],

    'nominate' => [
        'hybrid_requires_modes' => '',
        'incorrect_mode' => '',
        'full_bn_required' => 'Trebuie să fi un nominator să participi în această nominare calificată.',
        'too_many' => '',

        'dialog' => [
            'confirmation' => 'Ești sigur că vrei să nominalizezi acest Beatmap?',
            'header' => '',
            'hybrid_warning' => '',
            'which_modes' => '',
        ],
    ],

    'nsfw_badge' => [
        'label' => 'Explicit',
    ],

    'show' => [
        'discussion' => 'Discuție',

        'details' => [
            'by_artist' => '',
            'favourite' => 'Adaugă acest beatmapset la favorite',
            'favourite_login' => '',
            'logged-out' => 'Trebuie să te autentifici înainte de a descărca vreun beatmap!',
            'mapped_by' => 'mapat de :mapper',
            'unfavourite' => 'Elimină acest beatmapset de la favorite',
            'updated_timeago' => 'ultima dată actualizat :timeago',

            'download' => [
                '_' => 'Descarcă',
                'direct' => '',
                'no-video' => 'fără videoclip',
                'video' => 'cu videoclip',
            ],

            'login_required' => [
                'bottom' => 'pentru a accesa mai multe avantaje',
                'top' => 'Autentificare',
            ],
        ],

        'details_date' => [
            'approved' => 'aprobat :timeago',
            'loved' => 'iubit :timeago',
            'qualified' => 'calificat :timeago',
            'ranked' => 'clasat :timeago',
            'submitted' => 'postat :timeago',
            'updated' => 'ultima dată actualizat :timeago',
        ],

        'favourites' => [
            'limit_reached' => 'Ai prea multe beatmaps favorite! Te rugăm să mai elimini câteva înainte de a încerca din nou.',
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

            'disqualify' => [
                '_' => 'Dacă găsești o problemă cu acest beatmap, vă rugăm descalificați-o :link.',
            ],

            'report' => [
                '_' => 'Dacă găsești o problemă cu acest beatmap, vă rugăm raportați-o :link ca să alertați echipa.',
                'button' => 'Raportează problemă',
                'link' => 'aici',
            ],
        ],

        'info' => [
            'description' => 'Descriere',
            'genre' => 'Gen',
            'language' => 'Limbă',
            'no_scores' => 'Încă se calculează datele...',
            'nsfw' => 'Conținut explicit',
            'points-of-failure' => 'Puncte de eșec',
            'source' => 'Sursă',
            'storyboard' => '',
            'success-rate' => 'Rata de succes',
            'tags' => 'Tag-uri',
            'video' => '',
        ],

        'nsfw_warning' => [
            'details' => 'Acest beatmap conține conținut explicit, ofensiv sau deranjant. Doriți să-l vedeți oricum?',
            'title' => 'Conținut explicit',

            'buttons' => [
                'disable' => 'Dezactivează avertisment',
                'listing' => '',
                'show' => 'Arată',
            ],
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
                'time' => 'Timp',
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
            'playcount' => 'Numărul de jocuri',
        ],

        'status' => [
            'ranked' => 'Clasat',
            'approved' => 'Aprobat',
            'loved' => 'Iubit',
            'qualified' => 'Calificat',
            'wip' => 'WIP',
            'pending' => 'În Așteptare',
            'graveyard' => 'Cimitir',
        ],
    ],
];
