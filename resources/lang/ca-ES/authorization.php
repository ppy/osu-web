<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'play_more' => 'Què et sembla jugar a l\'osu! en comptes d\'això?',
    'require_login' => 'Inicieu la sessió per continuar.',
    'require_verification' => 'Verifiqueu per a continuar.',
    'restricted' => "No es pot fer mentre estigui restringit.",
    'silenced' => "No es pot fer mentre estigui silenciat.",
    'unauthorized' => 'Accés denegat.',

    'beatmap_discussion' => [
        'destroy' => [
            'is_hype' => 'No es pot desfer el hyping.',
            'has_reply' => 'No es pot eliminar una discussió amb respostes',
        ],
        'nominate' => [
            'exhausted' => 'Has assolit el teu límit de nominacions diàries, si us plau torna-ho a intentar demà.',
            'incorrect_state' => 'Error en realitzar aquesta acció, intenteu actualitzar la pàgina.',
            'owner' => "No pots nominar el teu propi beatmap.",
            'set_metadata' => 'Heu d\'establir el gènere i l\'idioma abans de nominar.',
        ],
        'resolve' => [
            'not_owner' => 'Només el creador del tema i el propietari del beatmap poden resoldre una discussió.',
        ],

        'store' => [
            'mapper_note_wrong_user' => 'Només el propietari del beatmap o el nominador/membre del grup NAT pot publicar notes de mapatge.',
        ],

        'vote' => [
            'bot' => "No podeu votar en una discussió feta per un bot",
            'limit_exceeded' => 'Espera una mica abans de continuar votant',
            'owner' => "No pots votar les teves discussions.",
            'wrong_beatmapset_state' => 'Només podeu votar en discussions de beatmaps pendents.',
        ],
    ],

    'beatmap_discussion_post' => [
        'destroy' => [
            'not_owner' => 'Només podeu eliminar les vostres publicacions.',
            'resolved' => 'No podeu suprimir una publicació d\'una discussió resolta.',
            'system_generated' => 'La publicació generada automàticament no es pot eliminar.',
        ],

        'edit' => [
            'not_owner' => 'Només el creador pot editar la publicació.',
            'resolved' => 'No podeu editar una publicació d\'una discussió resolta.',
            'system_generated' => 'No es pot editar una publicació generada automàticament.',
        ],
    ],

    'beatmapset' => [
        'discussion_locked' => '',

        'metadata' => [
            'nominated' => 'No podeu canviar les metadades d\'un beatmap nominat. Contacta amb un membre dels BN o NAT si creus que estan establerts incorrectament.',
        ],
    ],

    'chat' => [
        'annnonce_only' => 'Aquest canal només és per a anuncis.',
        'blocked' => 'No es pot enviar un missatge a un usuari que us està bloquejant o que heu bloquejat.',
        'friends_only' => 'L\'usuari està bloquejant missatges de persones que no estan a la seva llista d\'amics.',
        'moderated' => 'Aquest canal està actualment moderat.',
        'no_access' => 'No tens accés a aquest canal.',
        'receive_friends_only' => 'És possible que l\'usuari no pugui respondre perquè només accepta missatges de persones de la llista d\'amics.',
        'restricted' => 'No podeu enviar missatges mentre estigui silenciat, restringit o banejat.',
        'silenced' => 'No podeu enviar missatges mentre estigui silenciat, restringit o banejat.',
    ],

    'comment' => [
        'store' => [
            'disabled' => 'Els comentaris estan desactivats',
        ],
        'update' => [
            'deleted' => "No es pot editar la publicació suprimida.",
        ],
    ],

    'contest' => [
        'voting_over' => 'No pots canviar el teu vot després d\'haver acabat el període de votació.',

        'entry' => [
            'limit_reached' => 'Heu assolit el límit d\'entrades per a aquest concurs',
            'over' => 'Gràcies per la vostra participació! Els enviaments han estat tancats per a aquest concurs i la votació s\'obrirà aviat.',
        ],
    ],

    'forum' => [
        'moderate' => [
            'no_permission' => 'Sense permisos per moderar aquest fòrum.',
        ],

        'post' => [
            'delete' => [
                'only_last_post' => 'Només es pot eliminar l\'última publicació.',
                'locked' => 'No es pot eliminar la publicació d\'un tema bloquejat.',
                'no_forum_access' => 'Es requereix l\'accés al fòrum sol·licitat.',
                'not_owner' => 'Només el creador pot eliminar la publicació.',
            ],

            'edit' => [
                'deleted' => 'No es pot editar la publicació eliminada.',
                'locked' => 'L\'edició de la publicació està bloquejada.',
                'no_forum_access' => 'Cal accés al fòrum sol·licitat.',
                'not_owner' => 'Només el creador pot suprimir la publicació.',
                'topic_locked' => 'No es pot editar la publicació d\'un tema bloquejat.',
            ],

            'store' => [
                'play_more' => 'Intenta jugar abans de publicar als fòrums, si us plau! Si teniu un problema jugant, publica\'l al fòrum d\'Ajuda i Suport.',
                'too_many_help_posts' => "Necessites jugar més el joc abans de fer publicacions addicionals. Si encara teniu problemes per jugar, envieu un correu electrònic a support@ppy.sh", // FIXME: unhardcode email address.
            ],
        ],

        'topic' => [
            'reply' => [
                'double_post' => 'Si us plau edita la teva darrera publicació en comptes de publicar una altra vegada.',
                'locked' => 'No podeu respondre a un fil tancat.',
                'no_forum_access' => 'Cal accés al fòrum sol·licitat.',
                'no_permission' => 'No tens permisos per respondre.',

                'user' => [
                    'require_login' => 'Si us plau, inicia sessió per respondre.',
                    'restricted' => "No podeu respondre mentre estigui restringit.",
                    'silenced' => "No podeu respondre mentre estigui silenciat.",
                ],
            ],

            'store' => [
                'no_forum_access' => 'Cal accés al fòrum sol·licitat.',
                'no_permission' => 'No tens permís per crear un tema.',
                'forum_closed' => 'Aquest fòrum està tancat i no hi pots publicar.',
            ],

            'vote' => [
                'no_forum_access' => 'Cal accés al fòrum sol·licitat.',
                'over' => 'L\'enquesta va acabar i ja no es pot votar.',
                'play_more' => 'Necessites jugar més abans de votar al fòrum.',
                'voted' => 'Canviar el vot no és permès.',

                'user' => [
                    'require_login' => 'Si us plau, inicieu la sessió per votar.',
                    'restricted' => "No podeu votar mentre estigui restringit.",
                    'silenced' => "No podeu votar mentre estigui silenciat.",
                ],
            ],

            'watch' => [
                'no_forum_access' => 'Cal accés al fòrum sol·licitat.',
            ],
        ],

        'topic_cover' => [
            'edit' => [
                'uneditable' => 'Portada especificada no vàlida.',
                'not_owner' => 'Només el propietari pot editar la portada.',
            ],
            'store' => [
                'forum_not_allowed' => 'Aquest fòrum no accepta portades de temes.',
            ],
        ],

        'view' => [
            'admin_only' => 'Només els administradors poden veure aquest fòrum.',
        ],
    ],

    'score' => [
        'pin' => [
            'not_owner' => 'Només el propietari de la puntuació pot fixar la puntuació.',
            'too_many' => 'Has fixat massa puntuacions.',
        ],
    ],

    'user' => [
        'page' => [
            'edit' => [
                'locked' => 'La pàgina d\'usuari està bloquejada.',
                'not_owner' => 'Només podeu editar la vostra pàgina d\'usuari.',
                'require_supporter_tag' => 'Es requereix osu!supporter.',
            ],
        ],
    ],
];
