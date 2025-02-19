<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'pinned_topics' => 'Temas anclados',
    'slogan' => "es peligroso jugar solo.",
    'subforums' => 'Subforos',
    'title' => 'Foros',

    'covers' => [
        'edit' => 'Editar portada',

        'create' => [
            '_' => 'Establecer imagen de portada',
            'button' => 'Subir portada',
            'info' => 'El tamaño de la portada debe ser de :dimensions. También puedes soltar tu imagen aquí para subirla.',
        ],

        'destroy' => [
            '_' => 'Eliminar portada',
            'confirm' => '¿Seguro que quieres eliminar la imagen de portada?',
        ],
    ],

    'forums' => [
        'forums' => 'Foros',
        'latest_post' => 'Último mensaje',

        'index' => [
            'title' => 'Índice del foro',
        ],

        'topics' => [
            'empty' => '¡No hay temas!',
        ],
    ],

    'mark_as_read' => [
        'forum' => 'Marcar foro como leído',
        'forums' => 'Marcar foros como leídos',
        'busy' => 'Marcando como leído...',
    ],

    'post' => [
        'confirm_destroy' => '¿Realmente deseas eliminar la publicación?',
        'confirm_restore' => '¿Realmente desea restaurar la publicación?',
        'edited' => 'Última edición por :user :when, editado :count_delimited vez en total.|Última edición por :user :when, editado :count_delimited veces en total.',
        'posted_at' => 'publicado :when',
        'posted_by_in' => 'publicado por :username en :forum',

        'actions' => [
            'destroy' => 'Eliminar publicación',
            'edit' => 'Editar publicación',
            'report' => 'Reportar publicación',
            'restore' => 'Restaurar publicación',
        ],

        'create' => [
            'title' => [
                'reply' => 'Nueva respuesta',
            ],
        ],

        'info' => [
            'post_count' => ':count_delimited publicación|:count_delimited publicaciones',
            'topic_starter' => 'Creador del tema',
        ],
    ],

    'search' => [
        'go_to_post' => 'Ir a la publicación',
        'post_number_input' => 'introducir número de publicación',
        'total_posts' => ':posts_count publicaciones totales',
    ],

    'topic' => [
        'confirm_destroy' => '¿Realmente desea eliminar el tema?',
        'confirm_restore' => '¿Realmente desea restaurar el tema?',
        'deleted' => 'tema eliminado',
        'go_to_latest' => 'ver la última publicación',
        'go_to_unread' => 'ver la primera publicación no leída',
        'has_replied' => 'Has respondido a este tema',
        'in_forum' => 'en :forum',
        'latest_post' => ':when por :user',
        'latest_reply_by' => 'última respuesta por :user',
        'new_topic' => 'Nuevo tema',
        'new_topic_login' => 'Inicia sesión para publicar un nuevo tema',
        'post_reply' => 'Publicar',
        'reply_box_placeholder' => 'Escribe aquí para responder',
        'reply_title_prefix' => 'Re',
        'started_by' => 'por :user',
        'started_by_verbose' => 'iniciado por :user',

        'actions' => [
            'destroy' => 'Eliminar tema',
            'restore' => 'Restaurar tema',
        ],

        'create' => [
            'close' => 'Cerrar',
            'preview' => 'Previsualizar',
            // TL note: this is used in the topic reply preview, when
            // the user goes back from previewing to editing the reply
            'preview_hide' => 'Editar',
            'submit' => 'Publicar',

            'necropost' => [
                'default' => 'Este tema ha estado inactivo durante mucho tiempo. Solo publique aquí si tiene una razón específica para hacerlo.',

                'new_topic' => [
                    '_' => "Este tema ha estado inactivo durante mucho tiempo. Si no tienes una razón específica para publicar aquí, por favor :create en su lugar.",
                    'create' => 'crea un nuevo tema',
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

        'logs' => [
            '_' => 'Registros de temas',
            'button' => 'Buscar registros de temas',

            'columns' => [
                'action' => 'Acción',
                'date' => 'Fecha',
                'user' => 'Usuario',
            ],

            'data' => [
                'add_tag' => 'etiqueta «:tag» añadida',
                'announcement' => 'tema anclado y marcado como anuncio',
                'edit_topic' => 'a :title',
                'fork' => 'de :topic',
                'pin' => 'tema anclado',
                'post_operation' => 'publicado por :username',
                'remove_tag' => 'etiqueta «:tag» eliminada',
                'source_forum_operation' => 'de :forum',
                'unpin' => 'tema sin fijar',
            ],

            'no_results' => 'no se encontraron registros...',

            'operations' => [
                'delete_post' => 'Publicación eliminada',
                'delete_topic' => 'Tema eliminado',
                'edit_topic' => 'Título del tema cambiado',
                'edit_poll' => 'Encuesta del tema editada',
                'fork' => 'Tema copiado',
                'issue_tag' => 'Etiqueta emitida',
                'lock' => 'Tema bloqueado',
                'merge' => 'Publicaciones unidas dentro de este tema',
                'move' => 'Tema movido',
                'pin' => 'Tema anclado',
                'post_edited' => 'Publicación editada',
                'restore_post' => 'Publicación restaurada',
                'restore_topic' => 'Tema restaurado',
                'split_destination' => 'Publicaciones separadas movidas',
                'split_source' => 'Separar publicaciones',
                'topic_type' => 'Establecer el tipo de tema',
                'topic_type_changed' => 'Tipo de tema cambiado',
                'unlock' => 'Tema desbloqueado',
                'unpin' => 'Tema sin anclar',
                'user_lock' => 'Tema propio bloqueado',
                'user_unlock' => 'Tema propio desbloqueado',
            ],
        ],

        'post_edit' => [
            'cancel' => 'Cancelar',
            'post' => 'Guardar',
        ],
    ],

    'topic_watches' => [
        'index' => [
            'title_compact' => 'lista de seguimiento de temas del foro',

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
                'confirmation' => '¿Cancelar suscripción al tema?',
                'title' => 'Cancelar suscripción',
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
            'create_poll' => 'Creación de encuesta',

            'preview' => 'Vista previa',

            'create_poll_button' => [
                'add' => 'Crear una encuesta',
                'remove' => 'Cancelar creación de encuesta',
            ],

            'poll' => [
                'hide_results' => 'Ocultar los resultados de la encuesta.',
                'hide_results_info' => 'Solo se mostrarán después de que finalice la encuesta.',
                'length' => 'Duración de la encuesta',
                'length_days_suffix' => 'días',
                'length_info' => 'Dejar en blanco para una encuesta sin fecha límite',
                'max_options' => 'Opciones por usuario',
                'max_options_info' => 'Este es el número de opciones que un usuario puede seleccionar al votar.',
                'options' => 'Opciones',
                'options_info' => 'Escribe cada opción en una nueva línea. Puedes introducir hasta 10 opciones.',
                'title' => 'Pregunta',
                'vote_change' => 'Permitir volver a votar.',
                'vote_change_info' => 'Si está activado, los usuarios podrán cambiar su voto.',
            ],
        ],

        'edit_title' => [
            'start' => 'Editar título',
        ],

        'index' => [
            'feature_votes' => 'prioridad de estrella',
            'replies' => 'respuestas',
            'views' => 'vistas',
        ],

        'issue_tag_added' => [
            'to_0' => 'Eliminar etiqueta «added»',
            'to_0_done' => 'Etiqueta «added» eliminada',
            'to_1' => 'Añadir etiqueta «added»',
            'to_1_done' => 'Etiqueta «added» añadida',
        ],

        'issue_tag_assigned' => [
            'to_0' => 'Eliminar etiqueta «assigned»',
            'to_0_done' => 'Etiqueta «assigned» eliminada',
            'to_1' => 'Añadir etiqueta «assigned»',
            'to_1_done' => 'Etiqueta «assigned» añadida',
        ],

        'issue_tag_confirmed' => [
            'to_0' => 'Eliminar etiqueta «confirmed»',
            'to_0_done' => 'Etiqueta «confirmed» eliminada',
            'to_1' => 'Añadir etiqueta «confirmed»',
            'to_1_done' => 'Etiqueta «confirmed» añadida',
        ],

        'issue_tag_duplicate' => [
            'to_0' => 'Eliminar etiqueta «duplicate»',
            'to_0_done' => 'Etiqueta «duplicate» eliminada',
            'to_1' => 'Añadir etiqueta «duplicate»',
            'to_1_done' => 'Etiqueta «duplicate» añadida',
        ],

        'issue_tag_invalid' => [
            'to_0' => 'Eliminar etiqueta «invalid»',
            'to_0_done' => 'Etiqueta «invalid» eliminada',
            'to_1' => 'Añadir etiqueta «invalid»',
            'to_1_done' => 'Etiqueta «invalid» añadida',
        ],

        'issue_tag_resolved' => [
            'to_0' => 'Eliminar etiqueta «resolved»',
            'to_0_done' => 'Etiqueta «resolved» eliminada',
            'to_1' => 'Añadir etiqueta «resolved»',
            'to_1_done' => 'Etiqueta «resolved» añadida',
        ],

        'issue_tag_osulazer' => [
            'to_0' => '',
            'to_0_done' => '',
            'to_1' => '',
            'to_1_done' => '',
        ],

        'issue_tag_osustable' => [
            'to_0' => '',
            'to_0_done' => '',
            'to_1' => '',
            'to_1_done' => '',
        ],

        'issue_tag_osuweb' => [
            'to_0' => '',
            'to_0_done' => '',
            'to_1' => '',
            'to_1_done' => '',
        ],

        'lock' => [
            'is_locked' => 'Este tema está cerrado y no se puede responder',
            'to_0' => 'Abrir tema',
            'to_0_confirm' => '¿Abrir tema?',
            'to_0_done' => 'El tema ha sido abierto',
            'to_1' => 'Cerrar tema',
            'to_1_confirm' => '¿Cerrar tema?',
            'to_1_done' => 'El tema ha sido cerrado',
        ],

        'moderate_move' => [
            'title' => 'Mover a otro foro',
        ],

        'moderate_pin' => [
            'to_0' => 'Desanclar tema',
            'to_0_confirm' => '¿Desanclar tema?',
            'to_0_done' => 'El tema ya no está anclado',
            'to_1' => 'Anclar tema',
            'to_1_confirm' => '¿Anclar tema?',
            'to_1_done' => 'El tema ha sido anclado',
            'to_2' => 'Anclar tema y marcar como anuncio',
            'to_2_confirm' => '¿Anclar tema y marcar como anuncio?',
            'to_2_done' => 'El tema ha sido anclado y marcado como anuncio',
        ],

        'moderate_toggle_deleted' => [
            'show' => 'Mostrar publicaciones eliminadas',
            'hide' => 'Ocultar publicaciones eliminadas',
        ],

        'show' => [
            'deleted-posts' => 'Publicaciones eliminadas',
            'total_posts' => 'Publicaciones totales',

            'feature_vote' => [
                'current' => 'Prioridad actual: +:count',
                'do' => 'Apoyar esta solicitud',

                'info' => [
                    '_' => 'Esta es una :feature_request. Las solicitudes de características pueden ser votadas por :supporters.',
                    'feature_request' => 'solicitud de característica',
                    'supporters' => 'supporters',
                ],

                'user' => [
                    'count' => '{0} cero votos|{1} :count_delimited voto|[2,*] :count_delimited votos',
                    'current' => 'Tienes :votes restantes.',
                    'not_enough' => "No tienes más votos restantes",
                ],
            ],

            'poll' => [
                'edit' => 'Editar encuesta',
                'edit_warning' => '¡Editar una encuesta eliminará los resultados actuales!',
                'vote' => 'Votar',

                'button' => [
                    'change_vote' => 'Cambiar voto',
                    'edit' => 'Editar encuesta',
                    'view_results' => 'Saltar a resultados',
                    'vote' => 'Votar',
                ],

                'detail' => [
                    'end_time' => 'La encuesta terminará el :time',
                    'ended' => 'Encuesta terminada el :time',
                    'results_hidden' => 'Los resultados se mostrarán después de que finalice la encuesta.',
                    'total' => 'Votos totales: :count',
                ],
            ],
        ],

        'watch' => [
            'to_not_watching' => 'No marcado',
            'to_watching' => 'Marcado',
            'to_watching_mail' => 'Marcado con aviso de notificaciones',
            'tooltip_mail_disable' => 'Las notificaciones están activadas. Haz clic para desactivarlas',
            'tooltip_mail_enable' => 'Las notificaciones están desactivadas. Haz clic para activarlas',
        ],
    ],
];
