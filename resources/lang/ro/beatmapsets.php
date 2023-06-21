<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'availability' => [
        'disabled' => 'Acest beatmap nu poate fi descărcat momentan.',
        'parts-removed' => 'Unele porțiuni din acest beatmap au fost eliminate la cererea creatorului sau al unui deținător de drepturi de autor.',
        'more-info' => 'Vezi aici pentru mai multe informații.',
        'rule_violation' => 'Unele elemente din această hartă au fost șterse după ce au fost considerate ca fiind improprii pentru a fi utilizate în osu!.',
    ],

    'cover' => [
        'deleted' => 'Beatmap șters',
    ],

    'download' => [
        'limit_exceeded' => 'Descarcă mai puțin, joacă mai mult.',
    ],

    'featured_artist_badge' => [
        'label' => 'Artist oficial',
    ],

    'index' => [
        'title' => 'Lista Beatmap-uri',
        'guest_title' => 'Beatmap-uri',
    ],

    'panel' => [
        'empty' => 'niciun beatmap',

        'download' => [
            'all' => 'descarcă',
            'video' => 'descarcă cu video',
            'no_video' => 'descarcă fără video',
            'direct' => 'deschide în osu!direct',
        ],
    ],

    'nominate' => [
        'hybrid_requires_modes' => 'Un beatmap hibrid îți cere să selectezi cel puțin un mod de joc pentru care să nominalizezi.',
        'incorrect_mode' => 'Nu ai permisiunea de a nominaliza pentru modul :mode',
        'full_bn_required' => 'Trebuie să fii un nominalizator complet pentru a nominaliza spre calificare.',
        'too_many' => 'Cerința de nominalizare este deja îndeplinită.',

        'dialog' => [
            'confirmation' => 'Ești sigur că vrei să nominalizezi acest Beatmap?',
            'header' => 'Nominalizează acest Beatmap',
            'hybrid_warning' => 'observație: poți nominaliza o singură dată, așa că te rugăm să te asiguri că nominalizezi pentru toate modurile de joc pentru care intenționezi să nominalizezi',
            'which_modes' => 'Nominalizare pentru care moduri?',
        ],
    ],

    'nsfw_badge' => [
        'label' => 'Obscen',
    ],

    'show' => [
        'discussion' => 'Discuție',

        'deleted_banner' => [
            'title' => 'Acest beatmap a fost șters.',
            'message' => '(doar moderatorii pot vedea asta)',
        ],

        'details' => [
            'by_artist' => 'de :artist',
            'favourite' => 'Adaugă acest beatmap la favorite',
            'favourite_login' => 'Autentifică-te pentru a adăuga acest beatmap la preferate',
            'logged-out' => 'Trebuie să te autentifici înainte de a descărca vreun beatmap!',
            'mapped_by' => 'creat de :mapper',
            'mapped_by_guest' => 'dificultate cu participare ca oaspete de :mapper',
            'unfavourite' => 'Elimină acest beatmapset de la favorite',
            'updated_timeago' => 'ultima actualizare :timeago',

            'download' => [
                '_' => 'Descarcă',
                'direct' => '',
                'no-video' => 'fără video',
                'video' => 'cu video',
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
            'updated' => 'ultima actualizare :timeago',
        ],

        'favourites' => [
            'limit_reached' => 'Ai prea multe beatmap-uri favorite! Te rugăm să mai elimini câteva înainte de a încerca din nou.',
        ],

        'hype' => [
            'action' => 'Hype această mapă dacă ți-a plăcut să o joci, astfel încât să progreseze la stadiul de <strong>Clasat</strong>.',

            'current' => [
                '_' => 'Această mapă este în prezent :status.',

                'status' => [
                    'pending' => 'în așteptare',
                    'qualified' => 'calificată',
                    'wip' => 'în lucru',
                ],
            ],

            'disqualify' => [
                '_' => 'Dacă găsiți o problemă cu acest beatmap, vă rugăm descalificați-l :link.',
            ],

            'report' => [
                '_' => 'Dacă găsiți o problemă cu acest beatmap, vă rugăm raportați-o :link ca să alertați echipa.',
                'button' => 'Raportează Problemă',
                'link' => 'aici',
            ],
        ],

        'info' => [
            'description' => 'Descriere',
            'genre' => 'Gen',
            'language' => 'Limbă',
            'no_scores' => 'Încă se calculează datele...',
            'nominators' => 'Nominalizatori',
            'nsfw' => 'Conținut obscen',
            'offset' => 'Offset online',
            'points-of-failure' => 'Puncte de eșec',
            'source' => 'Sursă',
            'storyboard' => 'Acest beatmap conține un storyboard',
            'success-rate' => 'Rată de succes',
            'tags' => 'Etichete',
            'video' => 'Acest beatmap conține un video',
        ],

        'nsfw_warning' => [
            'details' => 'Acest beatmap conține conținut obscen, ofensiv sau deranjant. Doriți să-l vedeți oricum?',
            'title' => 'Conținut obscen',

            'buttons' => [
                'disable' => 'Dezactivează avertisment',
                'listing' => 'Lista beatmap-uri',
                'show' => 'Arată',
            ],
        ],

        'scoreboard' => [
            'achieved' => 'realizat :when',
            'country' => 'Clasament Țară',
            'error' => 'Încărcarea clasamentului a eșuat',
            'friend' => 'Clasament Prieteni',
            'global' => 'Clasament Global',
            'supporter-link' => 'Faceți clic <a href=":link">aici</a> pentru a vedea toate avantajele pe care le poți obține!',
            'supporter-only' => 'Trebuie să fii un suporter pentru a accesa clasamentul prietenilor și pe țară!',
            'title' => 'Tabela de scor',

            'headers' => [
                'accuracy' => 'Precizie',
                'combo' => 'Combo Maxim',
                'miss' => 'Ratări',
                'mods' => 'Moduri',
                'pin' => 'Fixează',
                'player' => 'Jucător',
                'pp' => '',
                'rank' => 'Clasament',
                'score' => 'Scor',
                'score_total' => 'Scor Total',
                'time' => 'Timp',
            ],

            'no_scores' => [
                'country' => 'Nimeni din țara ta nu a stabilit un scor pe acest beatmap încă!',
                'friend' => 'Nimeni din prietenii tăi nu a stabilit un scor pe acest beatmap încă!',
                'global' => 'Niciun scor încă. Poate ar trebui să încerci să obții câteva?',
                'loading' => 'Se încarcă scorurile...',
                'unranked' => 'Beatmap neclasificat.',
            ],
            'score' => [
                'first' => 'În top',
                'own' => 'Cel mai bun',
            ],
            'supporter_link' => [
                '_' => 'Apasă :here pentru a vedea toate avantajele pe care le poți obține!',
                'here' => 'aici',
            ],
        ],

        'stats' => [
            'cs' => 'Mărime Cerc',
            'cs-mania' => 'Număr Taste',
            'drain' => '
Viață',
            'accuracy' => 'Precizie',
            'ar' => 'Viteză Apropiere',
            'stars' => 'Dificultate (★)',
            'total_length' => 'Durată (Durată efectivă: :hit_length)',
            'bpm' => 'BPM',
            'count_circles' => 'Număr Cercuri',
            'count_sliders' => 'Număr Slidere',
            'offset' => 'Offset online: :offset',
            'user-rating' => 'Rating Utilizatori',
            'rating-spread' => 'Grafic Rating-uri',
            'nominations' => 'Nominalizări',
            'playcount' => 'Număr încercări',
        ],

        'status' => [
            'ranked' => 'Clasat',
            'approved' => 'Aprobat',
            'loved' => 'Iubit',
            'qualified' => 'Calificat',
            'wip' => 'În lucru',
            'pending' => 'În Așteptare',
            'graveyard' => 'Inactiv',
        ],
    ],

    'spotlight_badge' => [
        'label' => 'Promovat',
    ],
];
