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
    'deleted' => '[usuario eliminado]',

    'beatmapset_activities' => [
        'title' => "Historial de Modding de :usuario",

        'discussions' => [
            'title_recent' => 'Discusiones recientemente empezadas',
        ],

        'events' => [
            'title_recent' => 'Eventos recientes',
        ],

        'posts' => [
            'title_recent' => 'Pubicaciones recientes',
        ],

        'votes_received' => [
            'title_most' => 'Más votados por (últimos 3 meses)',
        ],

        'votes_made' => [
            'title_most' => 'Más votados (últimos 3 meses)',
        ],
    ],

    'blocks' => [
        'banner_text' => 'Has bloqueado a este usuario.',
        'blocked_count' => 'usuarios bloqueados (:count)',
        'hide_profile' => 'ocultar perfil',
        'not_blocked' => 'Ese usuario no está bloqueado.',
        'show_profile' => 'mostrar perfil',
        'too_many' => 'Límite de bloqueos alcanzado.',
        'button' => [
            'block' => 'bloquear',
            'unblock' => 'desbloquear',
        ],
    ],

    'card' => [
        'loading' => 'Cargando...',
        'send_message' => 'enviar mensaje',
    ],

    'login' => [
        '_' => 'Iniciar sesión',
        'locked_ip' => 'Tu dirección IP está bloqueada. Espera unos minutos.',
        'username' => 'Nombre de usuario',
        'password' => 'Contraseña',
        'button' => 'Iniciar sesión',
        'button_posting' => 'Iniciando sesión...',
        'remember' => 'Recordar este computador',
        'title' => 'Inicia sesión para continuar',
        'failed' => 'Inicio de sesión incorrecto',
        'register' => "¿No tienes una cuenta de osu!? Crea una nueva",
        'forgot' => '¿Olvidaste tu contraseña?',
        'beta' => [
            'main' => 'El acceso a la beta está actualmente restringido a usuarios privilegiados.',
            'small' => '(los osu!supporters tendrán acceso pronto)',
        ],

        'here' => 'aquí', // this is substituted in when generating a link above. change it to suit the language.
    ],

    'posts' => [
        'title' => 'Publicaciones de :username',
    ],

    'signup' => [
        '_' => 'Registrarse',
    ],
    'anonymous' => [
        'login_link' => 'haz clic aquí para iniciar sesión',
        'login_text' => 'iniciar sesión',
        'username' => 'Invitado',
        'error' => 'Necesitas haber iniciado sesión para hacer esto.',
    ],
    'logout_confirm' => '¿Estás seguro de que quieres cerrar la sesión? :(',
    'report' => [
        'button_text' => 'reportar',
        'comments' => 'Comentarios Adicionales',
        'placeholder' => 'Por favor proporcione cualquier información que usted cree que podría ser útil.',
        'reason' => 'Razón',
        'thanks' => '¡Gracias por tu informe!',
        'title' => '¿Reportar :username?',

        'actions' => [
            'send' => 'Enviar Reporte',
            'cancel' => 'Cancelar',
        ],

        'options' => [
            'cheating' => '',
            'insults' => 'Insulta a mí / otros',
            'spam' => 'Spam',
            'unwanted_content' => 'Enlazando a contenido inapropiado',
            'nonsense' => 'Incomprensible',
            'other' => 'Otros (indicar abajo)',
        ],
    ],
    'restricted_banner' => [
        'title' => '¡Tu cuenta ha sido restringida!',
        'message' => 'Mientras estás restringido, no podrás interactuar con otros jugadores y tus puntuaciones solo las podrás ver tú. Esto es, normalmente, el resultado de un proceso automatizado, y se levanta normalmente dentro de 24 horas. Si deseas apelar a tu restricción, por favor <a href="mailto:accounts@ppy.sh">contacta con el soporte</a>.',
    ],
    'show' => [
        'age' => ':age años',
        'change_avatar' => '¡cambia tu avatar!',
        'first_members' => 'Aquí desde el comienzo',
        'is_developer' => 'osu!developer',
        'is_supporter' => 'osu!supporter',
        'joined_at' => 'Se unió en :date',
        'lastvisit' => 'Visto por última vez :date',
        'missingtext' => '¡Es posible que hayas cometido un error tipográfico! (o el usuario puede haber sido baneado)',
        'origin_country' => 'De :country',
        'page_description' => 'osu! - ¡Todo lo que siempre quisiste saber acerca de :username!',
        'previous_usernames' => 'Antes conocido como',
        'plays_with' => 'Juega con :devices',
        'title' => "Perfil de :username",

        'edit' => [
            'cover' => [
                'button' => 'Cambiar Portada de Perfil',
                'defaults_info' => 'Más opciones de portadas estarán disponibles en el futuro',
                'upload' => [
                    'broken_file' => 'Error al procesar la imagen. Verifica la imagen subida e intenta de nuevo.',
                    'button' => 'Subir imagen',
                    'dropzone' => 'Suelta aquí para subir',
                    'dropzone_info' => 'También puedes soltar tu imagen aquí para subirla',
                    'restriction_info' => "Subida solo disponible para <a href='".route('store.products.show', 'supporter-tag')."' target='_blank'>osu!supporters</a>",
                    'size_info' => 'El tamaño de la portada debe ser de 2000x700',
                    'too_large' => 'El archivo subido es demasiado grande.',
                    'unsupported_format' => 'Formato no soportado.',
                ],
            ],

            'default_playmode' => [
                'is_default_tooltip' => 'modo de juego predeterminado',
                'set' => 'establecer :mode como el modo de juego predeterminado del perfil',
            ],
        ],

        'extra' => [
            'followers' => '1 seguidor|:count seguidores',
            'unranked' => 'No hay partidas recientes',

            'achievements' => [
                'title' => 'Logros',
                'achieved-on' => 'Obtenido el :date',
            ],
            'beatmaps' => [
                'none' => 'Ninguno... aún.',
                'title' => 'Beatmaps',

                'favourite' => [
                    'title' => 'Beatmaps Favoritos (:count)',
                ],
                'graveyard' => [
                    'title' => 'Beatmaps Abandonados (:count)',
                ],
                'loved' => [
                    'title' => 'Beatmaps Amados (:count)',
                ],
                'ranked_and_approved' => [
                    'title' => 'Beatmaps Rankeados y Aprobados (:count)',
                ],
                'unranked' => [
                    'title' => 'Beatmaps Pendientes (:count)',
                ],
            ],
            'historical' => [
                'empty' => 'Sin récords de rendimiento. :(',
                'title' => 'Histórico',

                'monthly_playcounts' => [
                    'title' => 'Historial de juego',
                ],
                'most_played' => [
                    'count' => 'veces jugadas',
                    'title' => 'Beatmaps Más Jugados',
                ],
                'recent_plays' => [
                    'accuracy' => 'precisión: :percentage',
                    'title' => 'Jugadas Recientes (24h)',
                ],
                'replays_watched_counts' => [
                    'title' => 'Historial de repeticiones vistas',
                ],
            ],
            'kudosu' => [
                'available' => 'Kudosu disponible',
                'available_info' => "Los kudosu se puede cambiar por estrellas kudosu, lo que ayudará a que tu beatmap reciba más atención. Este es el número de kudosus que aún has intercambiado.",
                'recent_entries' => 'Historial de Kudosu Reciente',
                'title' => 'Kudosu!',
                'total' => 'Kudosu Total Obtenido',
                'total_info' => 'Basado en qué tanto ha colaborado el usuario a la moderación de beatmaps. Mira <a href="'.osu_url('user.kudosu').'">esta página</a> para más información.',

                'entry' => [
                    'amount' => ':amount kudosu',
                    'empty' => "¡Este usuario no ha recibido ningún kudosu!",

                    'beatmap_discussion' => [
                        'allow_kudosu' => [
                            'give' => 'Recibido :amount de revocación de negación de kudosu de la publicación de modding de :post',
                        ],

                        'deny_kudosu' => [
                            'reset' => 'Denegado :amount de la publicación de modding de :post',
                        ],

                        'delete' => [
                            'reset' => 'Perdido :amount por eliminación de la publicación de modding de :post',
                        ],

                        'restore' => [
                            'give' => 'Recibido :amount por la restauración de la publicación de modding de :post',
                        ],

                        'vote' => [
                            'give' => 'Recibido :amount por obtención de votos en la publicación de modding de :post',
                            'reset' => 'Perdido :amount por perder votos en la publicación de modding de :post',
                        ],

                        'recalculate' => [
                            'give' => 'Recibido :amount por recálculo de votos en la publicación de modding de :post',
                            'reset' => 'Perdido :amount por recálculo de votos en la publicación de modding de :post',
                        ],
                    ],

                    'forum_post' => [
                        'give' => 'Recibido :amount de :giver por una publicación en :post',
                        'reset' => 'Kudosu reiniciado por :giver por la publicación :post',
                        'revoke' => 'Kudosu denegado por :giver por la publicación :post',
                    ],
                ],
            ],
            'me' => [
                'title' => '¡yo!',
            ],
            'medals' => [
                'empty' => "Este usuario aún no ha conseguido ninguna. ;_;",
                'title' => 'Medallas',
            ],
            'recent_activity' => [
                'title' => 'Reciente',
            ],
            'top_ranks' => [
                'empty' => 'No hay records de rendimiento impresionantes aún. :(',
                'not_ranked' => 'Sólo los mapas rankeados dan pp.',
                'pp' => ':amountpp',
                'title' => 'Rangos',
                'weighted_pp' => 'valorado en: :pp (:percentage)',

                'best' => [
                    'title' => 'Mejores Rendimientos',
                ],
                'first' => [
                    'title' => 'Primeros Lugares',
                ],
            ],
            'account_standing' => [
                'title' => 'Estado de la cuenta',
                'bad_standing' => "La cuenta de <strong>:username</strong> no está en buen estado :(",
                'remaining_silence' => '<strong>:username</strong> podrá hablar otra vez dentro de :duration.',

                'recent_infringements' => [
                    'title' => 'Infracciones recientes',
                    'date' => 'fecha',
                    'action' => 'acción',
                    'length' => 'duración',
                    'length_permanent' => 'Permanente',
                    'description' => 'descripción',
                    'actor' => 'por :username',

                    'actions' => [
                        'restriction' => 'Restringir',
                        'silence' => 'Silenciado',
                        'note' => 'Nota',
                    ],
                ],
            ],
        ],
        'info' => [
            'discord' => 'Discord',
            'interests' => 'Intereses',
            'lastfm' => 'Last.fm',
            'location' => 'Ubicación actual',
            'occupation' => 'Ocupación',
            'skype' => 'Skype',
            'twitter' => 'Twitter',
            'website' => 'Sitio web',
        ],
        'not_found' => [
            'reason_1' => 'Pudo haber cambiado de nombre de usuario.',
            'reason_2' => 'La cuenta puede estar temporalmente no disponible debido a problemas de seguridad o abuso.',
            'reason_3' => '¡Es posible que hayas cometido un error tipográfico!',
            'reason_header' => 'Hay algunas posibles razones para esto:',
            'title' => '¡Usuario no encontrado! ;_;',
        ],
        'page' => [
            'description' => '<strong>¡yo!</strong> es una área personal y personalizable en tu perfil.',
            'edit_big' => 'Editar ¡yo!',
            'placeholder' => 'Escribe el contenido de la pagina aquí',
            'restriction_info' => "Necesitas ser un <a href='".route('store.products.show', 'supporter-tag')."' target='_blank'>osu!supporter</a> para desbloquear esta función.",
        ],
        'post_count' => [
            '_' => 'Contribuyó en :link',
            'count' => ':count publicación en el foro|:count publicaciones en el foro',
        ],
        'rank' => [
            'country' => 'Rank nacional para :mode',
            'global' => 'Rank global para :mode',
        ],
        'stats' => [
            'hit_accuracy' => 'Precisión',
            'level' => 'Nivel :level',
            'maximum_combo' => 'Combo máximo',
            'play_count' => 'Conteo de jugadas',
            'play_time' => 'Tiempo de juego total',
            'ranked_score' => 'Puntuación rankeada',
            'replays_watched_by_others' => 'Repeticiones vistas por otros',
            'score_ranks' => 'Clasificación de las puntuaciones',
            'total_hits' => 'Golpes totales',
            'total_score' => 'Puntuación total',
        ],
    ],
    'status' => [
        'online' => 'Conectados',
        'offline' => 'Desconectados',
    ],
    'store' => [
        'saved' => 'Usuario creado',
    ],
    'verify' => [
        'title' => 'Verificación de la cuenta',
    ],
];
