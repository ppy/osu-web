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
    'pinned_topics' => 'Temas Fijados',
    'slogan' => 'es peligroso jugar solo.',
    'subforums' => 'Subforos',
    'title' => 'osu!community',

    'covers' => [
        'create' => [
            '_' => 'Definir imagen de portada',
            'button' => 'Subir imagen',
            'info' => 'El tamaño debe ser :dimensions. También puedes soltar tu imagen aquí para subirla.',
        ],

        'destroy' => [
            '_' => 'Eliminar imagen de portada',
            'confirm' => '¿Estás seguro de que quieres eliminar la imagen de portada?',
        ],
    ],

    'email' => [
        'new_reply' => '[osu!] Nueva respuesta en ":title"',
    ],

    'forums' => [
        'topics' => [
            'empty' => '¡No hay temas!',
        ],
    ],

    'post' => [
        'confirm_destroy' => '¿Eliminar publicación?',
        'confirm_restore' => '¿Restaurar publicación?',
        'edited' => 'Última edición por :user el :when, editado :count veces en total.',
        'posted_at' => 'publicado :when',

        'actions' => [
            'destroy' => 'Eliminar publicación',
            'restore' => 'Restaurar publicación',
            'edit' => 'Editar publicación',
        ],
    ],

    'search' => [
        'go_to_post' => 'Ir a la publicación',
        'post_number_input' => 'introducir número de publicación',
        'total_posts' => ':posts_count publicaciones totales',
    ],

    'topic' => [
        'deleted' => 'tema eliminado',
        'go_to_latest' => 'ver la última publicación',
        'latest_post' => ':when por :user',
        'latest_reply_by' => 'última respuesta por :user',
        'new_topic' => 'Escribir nuevo tema',
        'post_reply' => 'Publicar',
        'reply_box_placeholder' => 'Escribe aquí para responder',
        'started_by' => 'por :user',

        'create' => [
            'preview' => 'Previsualizar',
            // TL note: this is used in the topic reply preview, when
            // the user goes back from previewing to editing the reply
            'preview_hide' => 'Escribir',
            'submit' => 'Publicar',

            'placeholder' => [
                'body' => 'Escribe el contenido de la publicación aquí',
                'title' => 'Clic aquí para definir un título',
            ],
        ],

        'jump' => [
            'enter' => 'clic para introducir un número de publicación',
            'first' => 'ir a la primera publicación',
            'last' => 'ir a la última publicación',
            'next' => 'saltarse las siguientes 10 publicaciones',
            'previous' => 'ir 10 publicaciones atrás',
        ],

        'post_edit' => [
            'cancel' => 'Cancelar',
            'post' => 'Guardar',
        ],
    ],

    'topic_watches' => [
        'index' => [
            'title' => 'Suscripciones a Temas',
            'title_compact' => 'suscripciones',
            'title_main' => '<strong>Suscripciones</strong> de temas',

            'box' => [
                'total' => 'Temas suscritos',
                'unread' => 'Temas con nuevas respuestas',
            ],

            'info' => [
                'total' => 'Te has suscrito a :total temas.',
                'unread' => 'Tienes :unread respuestas sin leer a temas suscritos.',
            ],
        ],

        'topic_buttons' => [
            'remove' => [
                'confirmation' => '¿Desuscribirte de este tema??',
                'title' => 'Desuscribirse',
            ],
        ],
    ],

    'topics' => [
        '_' => 'Temas',

        'actions' => [
            'reply' => 'Responder',
            'reply_with_quote' => 'Citar y responder',
            'search' => 'Buscar',
        ],

        'create' => [
            'create_poll' => 'Crear una encuesta',

            'create_poll_button' => [
                'add' => 'Crear una encuesta',
                'remove' => 'Cancelar creación de encuesta',
            ],

            'poll' => [
                'length' => 'Duración de la encuesta',
                'length_days_prefix' => '',
                'length_days_suffix' => 'días',
                'length_info' => 'Deja en blanco para una encuesta sin fin',
                'max_options' => 'Opciones por usuario',
                'max_options_info' => 'Este es el número de opciones que un usuario puede seleccionar al votar.',
                'options' => 'Opciones',
                'options_info' => 'Escribe cada opción en una nueva línea. Puedes añadir hasta 10 opciones.',
                'title' => 'Pregunta',
                'vote_change' => 'Permitir volver a votar.',
                'vote_change_info' => 'Si está activado, los usuarios podrán cambiar su voto.',
            ],
        ],

        'edit_title' => [
            'start' => 'Editar título',
        ],

        'index' => [
            'views' => 'vistas',
            'replies' => 'respuestas',
        ],

        'issue_tag_added' => [
            'action-0' => 'Eliminar etiqueta "agregado"',
            'action-1' => 'Agregar etiqueta "agregado"',
            'state-0' => 'Etiqueta "agregado" eliminada',
            'state-1' => 'Etiqueta "agregado" agregada',
        ],

        'issue_tag_assigned' => [
            'action-0' => 'Eliminar etiqueta "asignado"',
            'action-1' => 'Agregar etiqueta "asignado"',
            'state-0' => 'Etiqueta "asignado" eliminada',
            'state-1' => 'Etiqueta "asignado" agregada',
        ],

        'issue_tag_confirmed' => [
            'action-0' => 'Eliminar etiqueta "confirmado"',
            'action-1' => 'Agregar etiqueta "confirmado"',
            'state-0' => 'Etiqueta "confirmado" eliminada',
            'state-1' => 'Etiqueta "confirmado" agregada',
        ],

        'issue_tag_duplicate' => [
            'action-0' => 'Eliminar etiqueta "duplicado"',
            'action-1' => 'Agregar etiqueta "duplicado"',
            'state-0' => 'Etiqueta "duplicado" eliminada',
            'state-1' => 'Etiqueta "duplicado" agregada',
        ],

        'issue_tag_invalid' => [
            'action-0' => 'Eliminar etiqueta "inválido"',
            'action-1' => 'Agregar etiqueta "inválido"',
            'state-0' => 'Etiqueta "inválido" eliminada',
            'state-1' => 'Etiqueta "inválido" agregada',
        ],

        'issue_tag_resolved' => [
            'action-0' => 'Eliminar etiqueta "resuelto"',
            'action-1' => 'Agregar etiqueta "resuelto"',
            'state-0' => 'Etiqueta "resuelto" eliminada',
            'state-1' => 'Etiqueta "resuelto" agregada',
        ],

        'lock' => [
            'is_locked' => 'Este tema está bloqueado y no se puede responder',
            'lock-0' => 'Abrir tema',
            'lock-1' => 'Cerrar tema',
            'state-0' => 'El tema ha sido abierto',
            'state-1' => 'El tema ha sido cerrado',
        ],

        'moderate_move' => [
            'title' => 'Mover a otro foro',
        ],

        'moderate_pin' => [
            'pin-0' => 'No fijar tema', // Spanish doesn't have a word that works as un- for "pin", so I'm using this for now
            'pin-1' => 'Fijar tema',
            'pin-2' => 'Fijar tema y marcar como anuncio',
            'state-0' => 'El tema ya no está fijado',
            'state-1' => 'El tema ya ha sido fijado',
            'state-2' => 'El tema ya ha sido fijado y marcado como anuncio',
        ],

        'show' => [
            'deleted-posts' => 'Publicaciones eliminadas',
            'total_posts' => 'Publicaciones totales',

            'feature_vote' => [
                'current' => 'Prioridad actual: +:count',
                'do' => 'Apoyar esta solicitud',

                'user' => [
                    'count' => '{0} cero votos|{1} :count voto|[2,*] :count votos',
                    'current' => 'Tienes :votes restantes.',
                    'not_enough' => 'No te quedan más votos',
                ],
            ],

            'poll' => [
                'vote' => 'Votar',

                'detail' => [
                    'end_time' => 'La encuesta terminará el :time',
                    'ended' => 'Encuesta terminada el :time',
                    'total' => 'Votos totales: :count',
                ],
            ],
        ],

        'watch' => [
            'state-0' => 'Desuscrito del tema',
            'state-1' => 'Suscrito al tema',
            'watch-0' => 'Desuscribirse del tema',
            'watch-1' => 'Suscribirse al tema',
        ],
    ],
];
