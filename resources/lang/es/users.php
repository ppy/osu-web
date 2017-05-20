<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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

    'login' => [
        '_' => 'Iniciar sesión',
        'locked_ip' => 'tu dirección IP está bloqueada. Espera unos minutos.',
        'username' => 'Nombre de usuario',
        'password' => 'Contraseña',
        'button' => 'Iniciar sesión',
        'remember' => 'Recordarme',
        'title' => 'Inicia sesión para continuar',
        'failed' => 'Nombre de usuario o contraseña incorrectos',
        'register' => '¿No tienes una cuenta de osu!? Crea una',
        'forgot' => '¿Olvidaste tu contraseña?',
        'beta' => [
            'main' => 'Acceso a la beta es actualmente restringido a usuarios privilegiados.',
            'small' => '(supporters tendrán acceso pronto)',
        ],

        'here' => 'aquí', // this is substituted in when generating a link above. change it to suit the language.
    ],
    'signup' => [
        '_' => 'Registrarse',
    ],
    'anonymous' => [
        'login_link' => 'clic para iniciar sesión',
        'username' => 'Invitado',
        'error' => 'Necesitas haber iniciado sesión para hacer esto.',
    ],
    'logout_confirm' => '¿Seguro que deseas salir? :(',
    'show' => [
        '404' => '¡Usuario no encontrado! ;_;',
        'age' => ':age años',
        'current_location' => 'Actualmente en :location',
        'first_members' => 'Desde el comienzo',
        'is_developer' => 'osu!developer',
        'is_supporter' => 'osu!supporter',
        'joined_at' => 'Se unió el :date',
        'lastvisit' => 'Visto por última vez :date',
        'missingtext' => '¡Has cometido un error! (o el usuario pudo haber sido baneado)',
        'origin_age' => ':age',
        'origin_country' => 'De :country',
        'origin_country_age' => ':age de :country',
        'page_description' => 'osu! - Todo lo que siempre quisiste saber acerca de :username!',
        'plays_with' => 'Juega con :devices',
        'title' => 'perfil / :username',

        'edit' => [
            'cover' => [
                'button' => 'Cambiar portada de perfil',
                'defaults_info' => 'Más portadas estarán disponibles en el futuro',
                'upload' => [
                    'broken_file' => 'No se pudo procesar. Verifica la imagen e intenta de nuevo.',
                    'button' => 'Subir imagen',
                    'dropzone' => 'Suelta aquí para subir',
                    'dropzone_info' => 'También puedes soltar la imagen aquí para subirla',
                    'restriction_info' => "Subida solo disponible para <a href='".osu_url('support-the-game')."' target='_blank'>osu!supporters</a>",
                    'size_info' => 'El tamaño de la portada debe ser de 2000x700',
                    'too_large' => 'El archivo es demasiado grande.',
                    'unsupported_format' => 'Formato no soportado.',
                ],
            ],
        ],
        'extra' => [
            'achievements' => [
                'title' => 'Logros',
                'achieved-on' => 'Obtenido el :date',
            ],
            'beatmaps' => [
                'title' => 'Beatmaps',
            ],
            'historical' => [
                'empty' => 'Sin récords de rendimiento. :(',
                'most_played' => [
                    'count' => 'veces jugado',
                    'title' => 'Beatmaps Más Jugados',
                ],
                'recent_plays' => [
                    'accuracy' => 'precisión: :percentage',
                    'title' => 'Jugadas Recientes',
                ],
                'title' => 'Historial',
            ],
            'kudosu' => [
                'available' => 'Kudosu disponible',
                'available_info' => 'Kudosu puede ser intercambiado por estrellas kudosu, que ayudarán a tu beatmap a obtener más atención. Este es el número de kudosu que no has intercambiado aún.',
                'recent_entries' => 'Historial de Kudosu Reciente',
                'title' => 'Kudosu!',
                'total' => 'Kudosu Total Obtenido',
                'total_info' => 'Basado en qué tanto ha colaborado el usuario a la moderación del beatmap. Ve <a href="'.osu_url('user.kudosu').'">esta página</a> para más información.',

                'entry' => [
                    'amount' => ':amount kudosu',
                    'empty' => '¡Este usuario no ha recibido ningún kudosu!',

                    'beatmap_discussion' => [
                        'allow_kudosu' => [
                            'give' => 'Recibido :amount de revocación de negación de kudosu de la publicación de modding :post',
                        ],

                        'deny_kudosu' => [
                            'reset' => 'Denegado :amount de la publicación de modding :post',
                        ],

                        'delete' => [
                            'reset' => 'Perdido :amount por eliminación de la publicación de modding :post',
                        ],

                        'restore' => [
                            'give' => 'Recibido :amount por la restauración de la publicación de modding de :post',
                        ],

                        'vote' => [
                            'give' => 'Recibido :amount por obtención de votos en la publicación de modding de :post',
                            'reset' => 'Perdido :amount por perder votos en la publicación de modding de :post',
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
                'title' => 'sobre mi!',
            ],
            'medals' => [
                'empty' => 'Este usuario aún no ha conseguido ninguna. ;_;',
                'title' => 'Medallas',
            ],
            'recent_activities' => [
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
            'beatmaps' => [
                'title' => 'Beatmaps',
                'favourite' => [
                    'title' => 'Beatmaps Favoritos (:count)',
                ],
                'ranked_and_approved' => [
                    'title' => 'Beatmaps Rankeados & Aprobados (:count)',
                ],
                'none' => 'Ninguno... aún.',
            ],
        ],
        'page' => [
            'description' => '<strong>sobre mi!</strong> es una área personalizable en tu perfil.',
            'edit_big' => 'Editar sobre mi!',
            'placeholder' => 'Escribe el contenido aquí',
            'restriction_info' => "Necesitas ser un <a href='".osu_url('support-the-game')."' target='_blank'>osu!supporter</a> para desbloquear esta característica.",
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
            'ranked_score' => 'Puntuación rankeada',
            'replays_watched_by_others' => 'Replays observadas por otros',
            'score_ranks' => 'Score Ranks', //?
            'total_hits' => 'Aciertos totales',
            'total_score' => 'Puntuación total',
        ],
    ],
     'verify' => [
        'title' => 'Verificación de la Cuenta',
    ],
];
