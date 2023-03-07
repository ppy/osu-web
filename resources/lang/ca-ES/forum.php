<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'pinned_topics' => 'Temes Fixats',
    'slogan' => "és perillós jugar sol.",
    'subforums' => 'Subfòrums',
    'title' => 'Fòrums',

    'covers' => [
        'edit' => 'Edita la portada',

        'create' => [
            '_' => 'Estableix la imatge de portada',
            'button' => 'Pujar portada',
            'info' => 'La portada ha de ser :dimensions. També pots deixar anar la imatge aquí per penjar-la.',
        ],

        'destroy' => [
            '_' => 'Elimina la portada',
            'confirm' => 'Segur que vols eliminar la imatge de portada?',
        ],
    ],

    'forums' => [
        'latest_post' => 'Última publicació',

        'index' => [
            'title' => 'Índex del fòrum',
        ],

        'topics' => [
            'empty' => 'No hi ha temes!',
        ],
    ],

    'mark_as_read' => [
        'forum' => 'Marca el fòrum com a llegit',
        'forums' => 'Marca els fòrums com a llegits',
        'busy' => 'Marcant com a llegit...',
    ],

    'post' => [
        'confirm_destroy' => 'Realment voleu eliminar la publicació?',
        'confirm_restore' => 'Realment voleu restaurar la publicació?',
        'edited' => 'Editat per últim cop per :user :when, editat :count_delimited vegada en total.|Editat per últim cop per :user :when, editat :count_delimited vegades en total.',
        'posted_at' => 'publicat :when',
        'posted_by' => 'publicat per :username',

        'actions' => [
            'destroy' => 'Eliminar publicació',
            'edit' => 'Edita la publicació',
            'report' => 'Denunciar publicació',
            'restore' => 'Recuperar publicació',
        ],

        'create' => [
            'title' => [
                'reply' => 'Nova resposta',
            ],
        ],

        'info' => [
            'post_count' => ':count_delimited publicació|:count_delimited publicacions',
            'topic_starter' => 'Creador de Temes',
        ],
    ],

    'search' => [
        'go_to_post' => 'Ves a la publicació',
        'post_number_input' => 'entra el número de publicació',
        'total_posts' => ':posts_count publicacions en total',
    ],

    'topic' => [
        'confirm_destroy' => 'Realment voleu eliminar el tema?',
        'confirm_restore' => 'Realment voleu restaurar el tema?',
        'deleted' => 'tema eliminat',
        'go_to_latest' => 'veure l\'última publicació',
        'has_replied' => 'Has respost a aquest tema',
        'in_forum' => 'en :forum',
        'latest_post' => ':when per :user',
        'latest_reply_by' => 'última resposta de :user',
        'new_topic' => 'Nou tema',
        'new_topic_login' => 'Inicia sessió per publicar un nou tema',
        'post_reply' => 'Publicar',
        'reply_box_placeholder' => 'Escriu aquí per respondre',
        'reply_title_prefix' => 'Re',
        'started_by' => 'per :user',
        'started_by_verbose' => 'començat per :user',

        'actions' => [
            'destroy' => 'Eliminar tema',
            'restore' => 'Restaura el tema',
        ],

        'create' => [
            'close' => 'Tanca',
            'preview' => 'Vista prèvia',
            // TL note: this is used in the topic reply preview, when
            // the user goes back from previewing to editing the reply
            'preview_hide' => 'Escriure',
            'submit' => 'Publicar',

            'necropost' => [
                'default' => 'Aquest tema ha estat inactiu durant un temps. Fes una publicació aquí només si tens un bon motiu.',

                'new_topic' => [
                    '_' => "Aquest tema ha estat inactiu per un temps. Si no tens un motiu concret per publicar aquí, si us plau :create.",
                    'create' => 'crea un nou tema',
                ],
            ],

            'placeholder' => [
                'body' => 'Escriu els continguts aquí',
                'title' => 'Fes clic aquí per establir el títol',
            ],
        ],

        'jump' => [
            'enter' => 'fes clic per entrar un número de publicació',
            'first' => 'ves a la primera publicació',
            'last' => 'ves a l\'última publicació',
            'next' => 'saltar les 10 publicacions següents',
            'previous' => 'ves 10 publicacions enrere',
        ],

        'logs' => [
            '_' => 'Registre dels temes',
            'button' => 'Navega el registre de temes',

            'columns' => [
                'action' => 'Acció',
                'date' => 'Data',
                'user' => 'Usuari',
            ],

            'data' => [
                'add_tag' => 'etiqueta ":tag" agregada',
                'announcement' => 'tema fixat i marcat com a anunci',
                'edit_topic' => 'a :title',
                'fork' => 'de :topic',
                'pin' => 'tema fixat',
                'post_operation' => 'publicat per :username',
                'remove_tag' => 's\'ha eliminat l\'etiqueta ":tag"',
                'source_forum_operation' => 'de :forum',
                'unpin' => 'tema sense fixar',
            ],

            'no_results' => 'no s\'ha trobat registres...',

            'operations' => [
                'delete_post' => 'Publicació eliminada',
                'delete_topic' => 'Tema eliminat',
                'edit_topic' => 'Has canviat el títol del tema',
                'edit_poll' => 'Has editat l\'enquesta del tema',
                'fork' => 'S\'ha copiat el tema',
                'issue_tag' => 'Etiqueta atribuïda',
                'lock' => 'Tema tancat',
                'merge' => 'S\'han unit publicacions en aquest tema',
                'move' => 'Tema mogut',
                'pin' => 'Tema fixat',
                'post_edited' => 'Publicació editada',
                'restore_post' => 'Publicació restaurada',
                'restore_topic' => 'Tema restaurat',
                'split_destination' => 'Publicacions separades mogudes',
                'split_source' => 'Separar publicacions',
                'topic_type' => 'Estableix el tipus de tema',
                'topic_type_changed' => 'Tipus de tema canviat',
                'unlock' => 'Tema obert',
                'unpin' => 'Tema no fixat',
                'user_lock' => 'Has tancat el teu tema',
                'user_unlock' => 'Has obert el teu tema',
            ],
        ],

        'post_edit' => [
            'cancel' => 'Cancel·la',
            'post' => 'Guarda',
        ],
    ],

    'topic_watches' => [
        'index' => [
            'title_compact' => 'llista de seguiment de temes al fòrum',

            'box' => [
                'total' => 'Temes subscrits',
                'unread' => 'Temes amb noves respostes',
            ],

            'info' => [
                'total' => 'T\'has subscrit a :total temes.',
                'unread' => 'Tenes :unread respostes no llegides als temes subscrits.',
            ],
        ],

        'topic_buttons' => [
            'remove' => [
                'confirmation' => 'Eliminar la subscripció a aquest tema?',
                'title' => 'Cancel·la la subscripció',
            ],
        ],
    ],

    'topics' => [
        '_' => 'Temes',

        'actions' => [
            'login_reply' => 'Inicia sessió per a respondre',
            'reply' => 'Respondre',
            'reply_with_quote' => 'Citar la publicació amb una resposta',
            'search' => 'Cerca',
        ],

        'create' => [
            'create_poll' => 'Creació de l\'enquesta',

            'preview' => 'Vista prèvia de l\'enquesta',

            'create_poll_button' => [
                'add' => 'Crea una enquesta',
                'remove' => 'Cancel·la la creació de l\'enquesta',
            ],

            'poll' => [
                'hide_results' => 'Amaga els resultats de l\'enquesta.',
                'hide_results_info' => 'Només es mostraran després que finalitzi l\'enquesta.',
                'length' => 'Executar l\'enquesta per',
                'length_days_suffix' => 'dies',
                'length_info' => 'Deixa-ho buit per fer una enquesta sense durada límit',
                'max_options' => 'Opcions per usuari',
                'max_options_info' => 'Aquest és el nombre d\'opcions que cada usuari pot seleccionar en votar.',
                'options' => 'Opcions',
                'options_info' => 'Escriu cada opció en una nova línia. Pots entrar fins a 10 opcions.',
                'title' => 'Pregunta',
                'vote_change' => 'Permetre tornar a votar.',
                'vote_change_info' => 'Si ho actives, els usuaris podran canviar el seu vot.',
            ],
        ],

        'edit_title' => [
            'start' => 'Edita el títol',
        ],

        'index' => [
            'feature_votes' => 'prioritat estrella',
            'replies' => 'respostes',
            'views' => 'vistes',
        ],

        'issue_tag_added' => [
            'to_0' => 'Elimina l\'etiqueta "afegit"',
            'to_0_done' => 'S\'ha eliminat l\'etiqueta "afegit"',
            'to_1' => 'Afegeix l\'etiqueta "afegit"',
            'to_1_done' => 'S\'ha afegit l\'etiqueta "afegit"',
        ],

        'issue_tag_assigned' => [
            'to_0' => 'Elimina l\'etiqueta "assignat"',
            'to_0_done' => 'S\'ha eliminat l\'etiqueta "assignat"',
            'to_1' => 'Afegeix l\'etiqueta "assignat"',
            'to_1_done' => 'S\'ha afegit l\'etiqueta "assignat"',
        ],

        'issue_tag_confirmed' => [
            'to_0' => 'Elimina l\'etiqueta "confirmat"',
            'to_0_done' => 'S\'ha eliminat l\'etiqueta "confirmat"',
            'to_1' => 'Afegeix l\'etiqueta "confirmat"',
            'to_1_done' => 'S\'ha afegit l\'etiqueta "confirmat"',
        ],

        'issue_tag_duplicate' => [
            'to_0' => 'Elimina l\'etiqueta "duplicat"',
            'to_0_done' => 'S\'ha eliminat l\'etiqueta "duplicat"',
            'to_1' => 'Afegeix l\'etiqueta "duplicat"',
            'to_1_done' => 'S\'ha afegit l\'etiqueta "duplicat"',
        ],

        'issue_tag_invalid' => [
            'to_0' => 'Elimina l\'etiqueta "invàlid"',
            'to_0_done' => 'S\'ha eliminat l\'etiqueta "invàlid"',
            'to_1' => 'Afegeix l\'etiqueta "invàlid"',
            'to_1_done' => 'S\'ha afegit l\'etiqueta "invàlid"',
        ],

        'issue_tag_resolved' => [
            'to_0' => 'Elimina l\'etiqueta "resolt"',
            'to_0_done' => 'S\'ha eliminat l\'etiqueta "resolt"',
            'to_1' => 'Afegeix l\'etiqueta "resolt"',
            'to_1_done' => 'S\'ha afegit l\'etiqueta "resolt"',
        ],

        'lock' => [
            'is_locked' => 'Aquest tema està tancat i no pots respondre-hi',
            'to_0' => 'Obre el tema',
            'to_0_confirm' => 'Obrir el tema?',
            'to_0_done' => 'S\'ha obert el tema',
            'to_1' => 'Tanca el tema',
            'to_1_confirm' => 'Tancar el tema?',
            'to_1_done' => 'Aquest tema s\'ha tancat',
        ],

        'moderate_move' => [
            'title' => 'Moure a un altre fòrum',
        ],

        'moderate_pin' => [
            'to_0' => 'Desfixa el tema',
            'to_0_confirm' => 'Vols desfixar el tema?',
            'to_0_done' => 'El tema s\'ha desfixat',
            'to_1' => 'Fixa el tema',
            'to_1_confirm' => 'Vols fixar el tema?',
            'to_1_done' => 'El tema s\'ha fixat',
            'to_2' => 'Fixa el tema i marca\'l com un anunci',
            'to_2_confirm' => 'Vols fixar el tema i marcar-lo com un anunci?',
            'to_2_done' => 'El tema s\'ha fixat i marcat com un anunci',
        ],

        'moderate_toggle_deleted' => [
            'show' => 'Mostra publicacions eliminades',
            'hide' => 'Amagar publicacions eliminades',
        ],

        'show' => [
            'deleted-posts' => 'Publicacions eliminades',
            'total_posts' => 'Publicacions totals',

            'feature_vote' => [
                'current' => 'Prioritat actual: +:count',
                'do' => 'Promou aquesta sol·licitud',

                'info' => [
                    '_' => 'Això és una :feature_request. Els :supporters poden votar les sol·licituds de funcions.',
                    'feature_request' => 'sol·licitud de funcionalitats',
                    'supporters' => 'osu!supporters',
                ],

                'user' => [
                    'count' => '{0} sense vots|{1} :count_delimited vot|[2,*] :count_delimited vots',
                    'current' => 'Tens :votes restants.',
                    'not_enough' => "No tens més vots",
                ],
            ],

            'poll' => [
                'edit' => 'Edita l\'enquesta',
                'edit_warning' => 'Si edites una enquesta, s\'eliminaran els resultats actuals!',
                'vote' => 'Vota',

                'button' => [
                    'change_vote' => 'Canvia el vot',
                    'edit' => 'Edita l\'enquesta',
                    'view_results' => 'Saltar als resultats',
                    'vote' => 'Vota',
                ],

                'detail' => [
                    'end_time' => 'L\'enquesta finalitzarà a :time',
                    'ended' => 'L\'enquesta va finalitzar :time',
                    'results_hidden' => 'Els resultats es mostraran quan acabi l\'enquesta.',
                    'total' => 'Vots totals: :count',
                ],
            ],
        ],

        'watch' => [
            'to_not_watching' => 'No marcat',
            'to_watching' => 'Marcar',
            'to_watching_mail' => 'Marcar amb notificació',
            'tooltip_mail_disable' => 'Notificació activa. Clica per desactivar-la',
            'tooltip_mail_enable' => 'Notificació desactivada. Clica per activar-la',
        ],
    ],
];
