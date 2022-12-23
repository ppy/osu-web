<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'availability' => [
        'disabled' => 'Aquest beatmap no està actualment disponible per a baixar.',
        'parts-removed' => 'S\'han eliminat parts d\'aquest beatmap a petició del creador o d\'un tercer titular dels drets.',
        'more-info' => 'Fes clic aquí per a més informació.',
        'rule_violation' => 'Alguns continguts d\'aquest mapa han estat eliminats després de ser considerats no aptes pel seu ús a l\'osu!.',
    ],

    'cover' => [
        'deleted' => 'Beatmap eliminat',
    ],

    'download' => [
        'limit_exceeded' => 'A poc a poc, juga més.',
    ],

    'featured_artist_badge' => [
        'label' => 'Artista destacat',
    ],

    'index' => [
        'title' => 'Llista de beatmaps',
        'guest_title' => 'Beatmaps',
    ],

    'panel' => [
        'empty' => 'sense beatmaps',

        'download' => [
            'all' => 'descarregar',
            'video' => 'descarregar amb vídeo',
            'no_video' => 'descarregar sense vídeo',
            'direct' => 'obrir en osu!direct',
        ],
    ],

    'nominate' => [
        'hybrid_requires_modes' => 'Un beatmap híbrid requereix que seleccioneu almenys un mode de joc per nominar.',
        'incorrect_mode' => 'No tens permís per nominar per al mode :mode',
        'full_bn_required' => 'Has de ser un Nominador de Beatmaps confirmat per a efectuar aquesta nominació.',
        'too_many' => 'Requisit de nominació ja complert.',

        'dialog' => [
            'confirmation' => 'Esteu segur que voleu nominar aquest beatmap?',
            'header' => 'Nominar beatmap',
            'hybrid_warning' => 'nota: només pot nominar una vegada, així que assegureu-vos que està nominant per a totes els modes de joc que desitgi',
            'which_modes' => 'Nominar per a quins modes?',
        ],
    ],

    'nsfw_badge' => [
        'label' => 'Explícit',
    ],

    'show' => [
        'discussion' => 'Discussió',

        'details' => [
            'by_artist' => 'per :artist',
            'favourite' => 'Marcar com a favorit',
            'favourite_login' => 'Inicia sessió per a guardar el beatmap a favorits',
            'logged-out' => 'Necessites iniciar sessió abans de descarregar qualsevol beatmap!',
            'mapped_by' => 'mapejat per :mapper',
            'unfavourite' => 'Desmarcar com a favorit',
            'updated_timeago' => 'actualitzat per últim cop :timeago',

            'download' => [
                '_' => 'Descarregar',
                'direct' => '',
                'no-video' => 'sense vídeo',
                'video' => 'amb vídeo',
            ],

            'login_required' => [
                'bottom' => 'per accedir a més característiques',
                'top' => 'Inicia sessió',
            ],
        ],

        'details_date' => [
            'approved' => 'aprovat :timeago',
            'loved' => 'estimat :timeago',
            'qualified' => 'qualificat :timeago',
            'ranked' => 'classificat :timeago',
            'submitted' => 'enviat: :timeago',
            'updated' => 'darrera actualització: :timeago',
        ],

        'favourites' => [
            'limit_reached' => 'Has guardat massa beatmaps a favorits! Sisplau, esborra\'n alguns abans de tornar-ho a intentar.',
        ],

        'hype' => [
            'action' => 'Hypeja aquest mapa per ajudar al seu progrés a l\'estat <strong>Classificatori</strong>.',

            'current' => [
                '_' => 'Aquest mapa està actualment :status.',

                'status' => [
                    'pending' => 'pendent',
                    'qualified' => 'qualificat',
                    'wip' => 'treball en curs',
                ],
            ],

            'disqualify' => [
                '_' => 'Si trobeu algun problema amb aquest beatmap, sisplau desqualifiqueu-lo :link.',
            ],

            'report' => [
                '_' => 'Si trobeu un problema amb aquest beatmap, sisplau reporteu-lo :link per alertar l\'equip.',
                'button' => 'Informar un problema',
                'link' => 'aquí',
            ],
        ],

        'info' => [
            'description' => 'Descripció',
            'genre' => 'Gènere',
            'language' => 'Idioma',
            'no_scores' => 'Les dades encara s\'estan calculant...',
            'nominators' => 'Nominadors',
            'nsfw' => 'Contingut explícit',
            'offset' => 'Compensació en línia',
            'points-of-failure' => 'Punts de fracàs',
            'source' => 'Font',
            'storyboard' => 'Aquest beatmap conté una storyboard',
            'success-rate' => 'Percentatge d\'èxit',
            'tags' => 'Etiquetes',
            'video' => 'Aquest beatmap conté vídeo',
        ],

        'nsfw_warning' => [
            'details' => 'Aquest beatmap conté llenguatge explícit o ofensiu. Tot i això voleu veure\'l?',
            'title' => 'Contingut explícit',

            'buttons' => [
                'disable' => 'Deshabilitar l\'advertència',
                'listing' => 'Llistat de beatmaps',
                'show' => 'Mostrar',
            ],
        ],

        'scoreboard' => [
            'achieved' => 'assolit :when',
            'country' => 'Classificació nacional',
            'error' => 'Error en carregar les classificacions',
            'friend' => 'Classificació entre amics',
            'global' => 'Classificació Global',
            'supporter-link' => 'Feu clic <a href=":link">aquí</a> per veure totes les funcions de luxe que teniu!',
            'supporter-only' => 'Has de ser un osu!supporter per accedir a les classificacions per amics, països o mods!',
            'title' => 'Tauler de puntuació',

            'headers' => [
                'accuracy' => 'Precisió',
                'combo' => 'Max Combo',
                'miss' => 'Miss',
                'mods' => 'Mods',
                'pin' => 'Fixar',
                'player' => 'Jugador',
                'pp' => '',
                'rank' => 'Lloc',
                'score' => 'Puntuació',
                'score_total' => 'Puntuació total',
                'time' => 'Temps',
            ],

            'no_scores' => [
                'country' => 'Ningú del teu país ha establert una puntuació en aquest beatmap encara!',
                'friend' => 'Cap dels teus amics ha marcat cap puntuació en aquest beatmap encara!',
                'global' => 'Sense puntuacions encara. Potser hauries d\'intentar-ne establir alguna?',
                'loading' => 'Carregant puntuacions...',
                'unranked' => 'Beatmap no classificat.',
            ],
            'score' => [
                'first' => 'Liderant',
                'own' => 'El teu millor',
            ],
            'supporter_link' => [
                '_' => 'Feu clic a :here per veure totes les funcions de luxe que teniu!',
                'here' => 'aquí',
            ],
        ],

        'stats' => [
            'cs' => 'Mida del cercle',
            'cs-mania' => 'Quantitat de tecles',
            'drain' => 'Drenat d\'HP',
            'accuracy' => 'Precisió',
            'ar' => 'Velocitat d\'aproximació',
            'stars' => 'Estrelles de dificultat',
            'total_length' => 'Durada (Duració del drenatge: :hit_length)',
            'bpm' => 'BPM',
            'count_circles' => 'Nombre de cercles',
            'count_sliders' => 'Nombre de sliders',
            'offset' => 'Compensació en línia: :offset',
            'user-rating' => 'Valoració dels usuaris',
            'rating-spread' => 'Desglossament de valoracions',
            'nominations' => 'Nominacions',
            'playcount' => 'Vegades jugat',
        ],

        'status' => [
            'ranked' => 'Classificat',
            'approved' => 'Aprovat',
            'loved' => 'Estimat',
            'qualified' => 'Qualificat',
            'wip' => 'WIP',
            'pending' => 'Pendent',
            'graveyard' => 'Abandonat',
        ],
    ],

    'spotlight_badge' => [
        'label' => 'Destacat',
    ],
];
