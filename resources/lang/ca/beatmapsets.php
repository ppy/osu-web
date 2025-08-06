<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'availability' => [
        'disabled' => 'Aquest beatmap no es pot baixar actualment.',
        'parts-removed' => 'S\'han eliminat parts d\'aquest mapa a petició del creador o d\'un tercer titular dels drets.',
        'more-info' => 'Fes clic aquí per a més informació.',
        'rule_violation' => 'Alguns continguts d\'aquest mapa han estat eliminats després de ser considerats no aptes pel seu ús a osu!.',
    ],

    'cover' => [
        'deleted' => 'Mapa eliminat',
    ],

    'download' => [
        'limit_exceeded' => 'A poc a poc, juga més.',
        'no_mirrors' => 'No hi ha servidors disponibles.',
    ],

    'featured_artist_badge' => [
        'label' => 'Artista destacat',
    ],

    'index' => [
        'title' => 'Llista de Mapes',
        'guest_title' => 'Mapes',
    ],

    'panel' => [
        'empty' => 'sense mapes',

        'download' => [
            'all' => 'descarregar',
            'video' => 'descarregar amb vídeo',
            'no_video' => 'descarregar sense vídeo',
            'direct' => 'obrir en osu!direct',
        ],
    ],

    'nominate' => [
        'bng_limited_too_many_rulesets' => 'Els nominadors provisionals no poden nominar diferents modes de joc.',
        'full_nomination_required' => 'Heu de ser nominador complet per a establir la nominació final d\'un mode de joc.',
        'hybrid_requires_modes' => 'Un beatmap híbrid requereix que seleccionis almenys un mode de joc per nominar.',
        'incorrect_mode' => 'No tens permís per nominar per al mode: :mode',
        'invalid_limited_nomination' => 'Aquest beatmap té nominacions no vàlides i, en aquest estat, no es pot nominar.',
        'invalid_ruleset' => 'Aquesta nominació té regles no vàlides.',
        'too_many' => 'Requisit de nominació ja complert.',
        'too_many_non_main_ruleset' => 'El requisit de nominació per a regles no bàsiques ja s\'ha complit.',

        'dialog' => [
            'confirmation' => 'Esteu segur que voleu nominar aquest mapa?',
            'different_nominator_warning' => 'Si es qualifica aquest mapa amb nominadors diferents farà que es restableixi la seva posició a la cua de qualificacions.',
            'header' => 'Nomina el mapa',
            'hybrid_warning' => 'nota: només pot nominar una vegada, així que assegureu-vos que està nominant per a totes els modes de joc que desitgi',
            'current_main_ruleset' => 'Les regles principals actuals són :ruleset.',
            'which_modes' => 'Nominar per a quins modes?',
        ],
    ],

    'nsfw_badge' => [
        'label' => 'Explícit',
    ],

    'show' => [
        'discussion' => 'Discussió',

        'admin' => [
            'full_size_cover' => 'Veure imatge de portada a mida completa',
            'page' => '',
        ],

        'deleted_banner' => [
            'title' => 'Aquest mapa s\'ha esborrat.',
            'message' => '(només els moderadors poden veure això)',
        ],

        'details' => [
            'by_artist' => 'per :artist',
            'favourite' => 'marcar com a preferit',
            'favourite_login' => 'inicia sessió per a guardar el mapa a preferits',
            'logged-out' => 'necessites iniciar sessió abans de descarregar mapes!',
            'mapped_by' => 'mapejat per :mapper',
            'mapped_by_guest' => 'dificultat de convidat per :mapper',
            'unfavourite' => 'desmarcar com a favorit',
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
            'limit_reached' => 'Has guardat masses mapes a preferits! Esborra\'n alguns abans de tornar-ho a intentar.',
        ],

        'hype' => [
            'action' => 'Mostra eufòria a aquest mapa per ajudar al seu progrés a l\'estat <strong>classificat</strong>.',

            'current' => [
                '_' => 'Aquest mapa està actualment :status.',

                'status' => [
                    'pending' => 'pendent',
                    'qualified' => 'qualificat',
                    'wip' => 'treball en curs',
                ],
            ],

            'disqualify' => [
                '_' => 'Si trobeu algun problema amb aquest mapa, desqualifiqueu-lo :link.',
            ],

            'report' => [
                '_' => 'Si trobeu un problema amb aquest mapa, informeu a l\'enllaç :link per a alertar l\'equip.',
                'button' => 'Informar un problema',
                'link' => 'aquí',
            ],
        ],

        'info' => [
            'description' => 'Descripció',
            'genre' => 'Gènere',
            'language' => 'Idioma',
            'mapper_tags' => 'Etiquetes de mapejadors',
            'no_scores' => 'Les dades encara s\'estan calculant...',
            'nominators' => 'Nominadors',
            'nsfw' => 'Contingut explícit',
            'offset' => 'Compensació en línia',
            'points-of-failure' => 'Punts de fracàs',
            'source' => 'Font',
            'storyboard' => 'Aquest mapa conté un storyboard',
            'success-rate' => 'Percentatge d\'èxit',
            'user_tags' => 'Etiquetes d\'usuari',
            'video' => 'Aquest mapa conté vídeo',
        ],

        'nsfw_warning' => [
            'details' => 'Aquest mapa conté llenguatge explícit o ofensiu. Tot i això voleu veure\'l?',
            'title' => 'Contingut explícit',

            'buttons' => [
                'disable' => 'Deshabilitar l\'advertència',
                'listing' => 'Llistat de mapes',
                'show' => 'Mostra',
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
            'team' => 'Classificació per equips',
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
                'country' => 'Ningú del vostre país ha establert una puntuació en aquest mapa!',
                'friend' => 'Cap dels teus amics ha marcat cap puntuació en aquest mapa!',
                'global' => 'Sense puntuacions encara. Potser hauries d\'intentar-ne establir alguna?',
                'loading' => 'Carregant puntuacions...',
                'team' => 'Ningú del teu equip ha establert una puntuació en aquest beatmap!',
                'unranked' => 'Mapa sense classificar',
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
