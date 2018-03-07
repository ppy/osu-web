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
        'discussions' => [
            'title_recent' => 'Discusiones recientemente empezadas',
        ],
        'events' => [
            'title_recent' => 'Eventos recientes',
        ],
        'posts' => [
            'title_recent' => 'Posts recientes',
        ],
        'votes_received' => [
            'title_most' => 'Más votados por (últimos 3 meses)',
        ],
        'votes_made' => [
            'title_most' => 'Más votados (últimos 3 meses)',
        ],
    ],
    'login' => [
        '_' => 'Iniciar sesión',
        'locked_ip' => 'Tu dirección IP está bloqueada. Espera unos minutos.',
        'username' => 'Nombre de usuario',
        'password' => 'Contraseña',
        'button' => 'Iniciar sesión',
        'button_posting' => 'Iniciando sesión...',
        'remember' => 'Recordarme',
        'title' => 'Inicia sesión para continuar',
        'failed' => 'Nombre de usuario o contraseña incorrectos',
        'register' => '¿No tienes una cuenta de osu!? Crea una',
        'forgot' => '¿Olvidaste tu contraseña?',
        'beta' => [
            'main' => 'El acceso a la beta está actualmente restringido a usuarios privilegiados.',
            'small' => '(los supporters tendrán acceso pronto)',
        ],

        'here' => 'aquí', // this is substituted in when generating a link above. change it to suit the language.
    ],
    'signup' => [
        '_' => 'Registrarse',
    ],
    'anonymous' => [
        'login_link' => 'clic para iniciar sesión',
        'login_text' => 'iniciar sesión',
        'username' => 'Invitado',
        'error' => 'Necesitas haber iniciado sesión para hacer esto.',
    ],
    'logout_confirm' => '¿Estás seguro que quieres salir? :(',
    'restricted_banner' => [
        'title' => '¡Tu cuenta ha sido restringida!',
        'message' => 'Mientras estás restringido, no podrás interactuar con otros juadores y tus puntuaciones solo las podrás ver tú. Esto es, normalmente, el resultado de un proceso automatizado y se levantará en 24 horas. Si deseas apelar tu restricción, por favor <a href="mailto:accounts@ppy.sh">contacta con el soporte</a>.',
    ],
    'show' => [
        '404' => '¡Usuario no encontrado! ;_;',
        'age' => ':age años',
        'first_members' => 'Aquí desde el comienzo',
        'is_developer' => 'osu!developer',
        'is_supporter' => 'osu!supporter',
        'joined_at' => 'Se unió en :date',
        'lastvisit' => 'Visto por última vez :date',
        'missingtext' => '¡Has cometido un error de ortografía! (o el usuario pudo haber sido baneado)',
        'origin_age' => ':age',
        'origin_country' => 'De :country',
        'origin_country_age' => ':age de :country',
        'page_description' => 'osu! - ¡Todo lo que siempre quisiste saber acerca de :username!',
        'plays_with' => 'Juega con :devices',
        'title' => 'Perfil de :username',
        'change_avatar' => '¡cambia tu avatar!',
        'edit' => [
            'cover' => [
                'button' => 'Cambiar portada de perfil',
                'defaults_info' => 'Más portadas estarán disponibles en el futuro',
                'upload' => [
                    'broken_file' => 'No se pudo procesar. Verifica la imagen e intenta de nuevo.',
                    'button' => 'Subir imagen',
                    'dropzone' => 'Suelta aquí para subir',
                    'dropzone_info' => 'También puedes soltar la imagen aquí para subirla',
                    'restriction_info' => "Subida solo disponible para <a href='".route('store.products.show', 'supporter-tag')."' target='_blank'>osu!supporters</a>",
                    'size_info' => 'El tamaño de la portada debe ser de 2000x700',
                    'too_large' => 'El archivo es demasiado grande.',
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
                    'title' => 'Beatmaps Sepultados (:count)',
                ],
                'ranked_and_approved' => [
                    'title' => 'Beatmaps Rankeados & Aprobados (:count)',
                ],
                'unranked' => [
                    'title' => 'Beatmaps Pendientes (:count)',
                ],
            ],
            'historical' => [
                'empty' => 'Sin récords de rendimiento. :(',
                'title' => 'Historial',

                'most_played' => [
                    'count' => 'veces jugado',
                    'title' => 'Beatmaps Más Jugados',
                ],
                'recent_plays' => [
                    'accuracy' => 'precisión: :percentage',
                    'title' => 'Jugadas Recientes (24h)',
                ],
            ],
            'kudosu' => [
                'available' => 'Kudosu disponible',
                'available_info' => 'Los kudosu pueden ser intercambiados por estrellas kudosu, que ayudarán a tu beatmap a obtener más atención. Este es el número de kudosu que no has intercambiado aún.',
                'recent_entries' => 'Historial de Kudosu Reciente',
                'title' => 'Kudosu!',
                'total' => 'Kudosu Total Obtenido',
                'total_info' => 'Basado en qué tanto ha colaborado el usuario a la moderación de beatmaps. Mira <a href="'.osu_url('user.kudosu').'">esta página</a> para más información.',
                'entry' => [
                    'amount' => ':amount kudosu',
                    'empty' => '¡Este usuario no ha recibido ningún kudosu!',
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
                        'revoke' => 'Kudosu denegado por :giver por una publicación en :post',
                    ],
                ],
            ],
            'me' => [
                'title' => '¡sobre mi!',
            ],
            'medals' => [
                'empty' => 'Este usuario aún no ha conseguido ninguna. ;_;',
                'title' => 'Medallas',
            ],
            'recent_activity' => [
                'title' => 'Reciente',
            ],
            'top_ranks' => [
                'best' => [
                    'title' => 'Mejor rendimiento',
                ],
                'empty' => 'No hay récords increíbles aún. :(',
                'first' => [
                    'title' => 'Primeros Lugares',
                ],
                'pp' => ':amountpp',
                'title' => 'Rangos',
                'weighted_pp' => 'valorado en: :pp (:percentage)',
            ],
        ],
        'info' => [
            'interests' => 'Intereses',
            'lastfm' => 'Last.fm',
            'location' => 'Ubicación actual',
            'occupation' => 'Ocupación',
            'skype' => 'Skype',
            'twitter' => 'Twitter',
            'website' => 'Sitio web',
        ],
        'page' => [
            'description' => '<strong>¡sobre mi!</strong> es una área personalizable en tu perfil.',
            'edit_big' => '¡Editar sobre mi!',
            'placeholder' => 'Escribe el contenido aquí',
            'restriction_info' => "Necesitas ser un <a href='".route('store.products.show', 'supporter-tag')."' target='_blank'>osu!supporter</a> para desbloquear esta función.",
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
            'total_hits' => 'Aciertos totales',
            'total_score' => 'Puntuación total',
        ],
    ],
    'status' => [
        'online' => 'En línea',
        'offline' => 'Desconectado',
    ],
    'store' => [
        'saved' => '¡Usuario creado!',
    ],
    'verify' => [
        'title' => 'Verificación de la cuenta',
    ],
];
