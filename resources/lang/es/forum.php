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
    'slogan' => "es peligroso jugar solo.",
    'subforums' => 'Subforos',
    'title' => 'foros de osu!',

    'covers' => [
        'create' => [
            '_' => 'Establecer imagen de portada',
            'button' => 'Subir imagen',
            'info' => 'El tamaño de la portada debe ser de: dimensions. También puedes soltar tu imagen aquí para subirla.',
        ],

        'destroy' => [
            '_' => 'Eliminar imagen de portada',
            'confirm' => '¿Estás seguro de que quieres eliminar la imagen de portada?',
        ],
    ],

    'email' => [
        'new_reply' => '[osu!] Nueva respuesta para el tema ":title"',
    ],

    'forums' => [
        'topics' => [
            'empty' => '¡No hay temas!',
        ],
    ],

    'post' => [
        'confirm_destroy' => '¿Realmente quieres eliminar la publicación?',
        'confirm_restore' => '¿Realmente quieres restaurar la publicación?',
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
        'new_topic_login' => 'Inicia sesión para publicar un nuevo tema',
        'post_reply' => 'Publicar',
        'reply_box_placeholder' => 'Escribe aquí para responder',
        'reply_title_prefix' => '',
        'started_by' => 'por :user',
        'started_by_verbose' => 'iniciado por :user',

        'create' => [
            'preview' => 'Previsualizar',
            // TL note: this is used in the topic reply preview, when
            // the user goes back from previewing to editing the reply
            'preview_hide' => 'Escribir',
            'submit' => 'Publicar',

            'necropost' => [
                'default' => 'Este tema ha estado inactivo por un tiempo. Solo publica aquí si tienes una razón específica para hacerlo.',

                'new_topic' => [
                    '_' => "Este tema ha estado inactivo por un tiempo. Si no tienes una razón específica para publicar aquí, :create un tema.",
                    'create' => 'crear un nuevo tema',
                ],
            ],

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
            'title_compact' => 'suscripciones a foros',
            'title_main' => '<strong>Suscripciones</strong> de foros',

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
            'login_reply' => 'Inicia sesión para responder',
            'reply' => 'Responder',
            'reply_with_quote' => 'Citar publicación y responder',
            'search' => 'Buscar',
        ],

        'create' => [
            'create_poll' => 'Creación de encuestas',

            'create_poll_button' => [
                'add' => 'Crear una encuesta',
                'remove' => 'Cancelar creación de encuesta',
            ],

            'poll' => [
                'length' => 'Duración de la encuesta',
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
            'to_0' => 'Eliminar etiqueta "agregado"',
            'to_0_done' => 'Etiqueta "agregado" eliminada',
            'to_1' => 'Agregar etiqueta "agregado"',
            'to_1_done' => 'Etiqueta "agregado" agregada',
        ],

        'issue_tag_assigned' => [
            'to_0' => 'Eliminar etiqueta "asignado"',
            'to_0_done' => 'Etiqueta "asignado" eliminada',
            'to_1' => 'Agregar etiqueta "asignado"',
            'to_1_done' => 'Etiqueta "asignado" agregada',
        ],

        'issue_tag_confirmed' => [
            'to_0' => 'Eliminar etiqueta "confirmado"',
            'to_0_done' => 'Etiqueta "confirmado" eliminada',
            'to_1' => 'Agregar etiqueta "confirmado"',
            'to_1_done' => 'Etiqueta "confirmado" agregada',
        ],

        'issue_tag_duplicate' => [
            'to_0' => 'Eliminar etiqueta "duplicado"',
            'to_0_done' => 'Etiqueta "duplicado" eliminada',
            'to_1' => 'Agregar etiqueta "duplicado"',
            'to_1_done' => 'Etiqueta "duplicado" agregada',
        ],

        'issue_tag_invalid' => [
            'to_0' => 'Eliminar etiqueta "inválido"',
            'to_0_done' => 'Etiqueta "inválido" eliminada',
            'to_1' => 'Agregar etiqueta "inválido"',
            'to_1_done' => 'Etiqueta "inválido" agregada',
        ],

        'issue_tag_resolved' => [
            'to_0' => 'Eliminar etiqueta "resuelto"',
            'to_0_done' => 'Etiqueta "resuelto" eliminada',
            'to_1' => 'Agregar etiqueta "resuelto"',
            'to_1_done' => 'Etiqueta "resuelto" agregada',
        ],

        'lock' => [
            'is_locked' => 'Este tema está cerrado y no se puede responder',
            'to_0' => 'Abrir tema',
            'to_0_done' => 'El tema ha sido abierto',
            'to_1' => 'Cerrar tema',
            'to_1_done' => 'El tema ha sido cerrado',
        ],

        'moderate_move' => [
            'title' => 'Mover a otro foro',
        ],

        'moderate_pin' => [
            'to_0' => 'Desfijar tema',
            'to_0_done' => 'El tema ya no está fijado',
            'to_1' => 'Fijar tema',
            'to_1_done' => 'El tema ya ha sido fijado',
            'to_2' => 'Fijar tema y marcar como anuncio',
            'to_2_done' => 'El tema ya ha sido fijado y marcado como anuncio',
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
                    'not_enough' => "No tienes más votos restantes",
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
            'to_not_watching' => 'No marcado',
            'to_watching' => 'Marcado',
            'to_watching_mail' => 'Marcado con aviso de notificaciones',
            'mail_disable' => 'Deshabilitar aviso de notificaciones',
        ],
    ],
];
