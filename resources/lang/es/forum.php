<?php
/**
 *    Copyright 2015 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed in the hopes of
 *    attracting more community contributions to the core ecosystem of osu!
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
    'covers' => [
        'create' => [
            '_' => 'Definir imagen de portada',
            'button' => 'Subir imagen',
            'info' => 'El tamaño debe ser :dimensions. También puedes soltar tu imagen aquí para subirla.',
        ],
        'destroy' => [
            '_' => 'Remover imagen de portada',
            'confirm' => '¿Estás seguro de que quieres remover la imagen de portada?',
        ],
    ],
    'pinned_topics' => 'Temas Fijos,
    'post' => [
        'confirm_delete' => '¿Eliminar post?',
        'edited' => 'Última edición por :user el :when, editado :count veces en total.',
        'posted_at' => 'posteado :when',
        'actions' => [
            'delete' => 'Eliminar post',
            'edit' => 'Editar post',
        ],
    ],
    'search' => [
        'go_to_post' => 'Ir al post',
        'post_number_input' => 'ingresar número de post',
        'total_posts' => ':posts_count posts totales',
    ],
    'subforums' => 'Subforos',
    'title' => 'osu!community',
    'topic' => [
        'create' => [
            'placeholder' => [
                'body' => 'Escribe el contenido aquí',
                'title' => 'Clic aquí para definir el título',
            ],
            'preview' => 'Vista Previa',
            'submit' => 'Enviar',
        ],
        'go_to_latest' => 'ver último post',
        'jump' => [
            'enter' => 'clic para ingresar un número de post específico',
            'first' => 'ir al primer post',
            'last' => 'ir al último post',
            'next' => 'saltarse los siguientes 10 posts',
            'previous' => 'regresar 10 posts',
        ],
        'latest_post' => ':when por :user',
        'latest_reply_by' => 'última respuesta por :user',
        'move' => 'Moverse a otro foro',
        'new_topic' => 'Escribir nuevo tema',
        'post_edit' => [
            'cancel' => 'Cancelar',
            'post' => 'Guardar',
            'zoom' => [
                'start' => 'Pantalla Completa',
                'end' => 'Salir de Pantalla Completa',
            ],
        ],
        'post_reply' => 'Responder',
        'reply_box_placeholder' => 'Escribe aquí para responder',
        'started_by' => 'por :user',
    ],
    'topics' => [
        '_' => 'Topics',
        'actions' => [
            'reply' => 'Mostrar caja de respuesta',
            'reply_with_quote' => 'Cita el post para responder',
        ],
        'index' => [
            'views' => 'vistas',
            'replies' => 'respuestas',
        ],
        'lock' => [
            'locked-0' => 'El tema ha sido desbloqueado',
            'locked-1' => 'El tema ha sido bloqueado',
            'is_locked' => 'Este tema está bloqueado y no se puede responder',
        ],
        'show' => [
            'feature_vote' => [
                'current' => 'Prioridad Actual: +:count',
                'do' => 'Promover esta solicitud',
                'user' => [
                    'current' => 'Tienes :votes restantes.',
                    'count' => '{0} sin votos|{1} :count voto|[2,Inf] :count votos',
                    'not_enough' => "No te quedan más votos",
                ],
            ],
        ],
    ],
];
