<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'deleted' => '[usuario eliminado]',

    'beatmapset_activities' => [
        'title' => "Historial de modding de :user",
        'title_compact' => 'Modding',

        'discussions' => [
            'title_recent' => 'Discusiones recientemente empezadas',
        ],

        'events' => [
            'title_recent' => 'Eventos recientes',
        ],

        'posts' => [
            'title_recent' => 'Publicaciones recientes',
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
        'hide_profile' => 'Ocultar perfil',
        'not_blocked' => 'Ese usuario no está bloqueado.',
        'show_profile' => 'Mostrar perfil',
        'too_many' => 'Límite de bloqueos alcanzado.',
        'button' => [
            'block' => 'Bloquear',
            'unblock' => 'Desbloquear',
        ],
    ],

    'card' => [
        'loading' => 'Cargando...',
        'send_message' => 'Enviar mensaje',
    ],

    'disabled' => [
        'title' => '¡Oh, oh! Parece que su cuenta ha sido desactivada.',
        'warning' => "En el caso de que haya roto una regla, tenga en cuenta que generalmente hay un período de espera de un mes durante el cual no consideraremos ninguna solicitud de amnistía. Después de este período, puede contactar con nosotros si lo considera necesario. Tenga en cuenta que la creación de nuevas cuentas después de haber tenido una desactivada resultará en una <strong>extensión de este período de espera de un mes</strong>. Por favor, también tenga en cuenta que por <strong>cada cuenta que cree, estará violando más reglas</strong>. ¡Le sugerimos que no siga este camino!",

        'if_mistake' => [
            '_' => 'Si cree que se trata de un error, puede ponerse en contacto con nosotros (por :email o haciendo clic en el "?" en la esquina inferior derecha de esta página). Tenga en cuenta que siempre confiamos plenamente en nuestras acciones, ya que se basan en datos muy sólidos. Nos reservamos el derecho de ignorar su petición si consideramos que está siendo intencionadamente deshonesto.',
            'email' => 'correo electrónico',
        ],

        'reasons' => [
            'compromised' => 'Su cuenta se ha considerado comprometida. Puede ser desactivada temporalmente mientras se confirma su identidad.',
            'opening' => 'Hay un serie de razones que pueden resultar en la desactivación de su cuenta:',

            'tos' => [
                '_' => 'Ha roto una o más de nuestras :community_rules o :tos.',
                'community_rules' => 'reglas de la comunidad',
                'tos' => 'términos de servicio',
            ],
        ],
    ],

    'filtering' => [
        'by_game_mode' => 'Miembros por modo de juego',
    ],

    'force_reactivation' => [
        'reason' => [
            'inactive_different_country' => "Su cuenta no ha sido utilizada en mucho tiempo.",
        ],
    ],

    'login' => [
        '_' => 'Iniciar sesión',
        'button' => 'Iniciar sesión',
        'button_posting' => 'Iniciando sesión...',
        'email_login_disabled' => 'El inicio de sesión con correo electrónico está actualmente desactivado. Por favor, utilice el nombre de usuario en su lugar.',
        'failed' => 'Inicio de sesión incorrecto',
        'forgot' => '¿Olvidaste tu contraseña?',
        'info' => 'Por favor, inicie sesión para continuar',
        'invalid_captcha' => 'Demasiados intentos fallidos de inicio de sesión, complete el captcha e inténtelo de nuevo. (Actualice la página si el captcha no está visible)',
        'locked_ip' => 'Tu dirección IP está bloqueada. Espera unos minutos.',
        'password' => 'Contraseña',
        'register' => "¿No tienes una cuenta de osu!? Crea una nueva",
        'remember' => 'Recordar este computador',
        'title' => 'Inicie sesión para continuar',
        'username' => 'Nombre de usuario',

        'beta' => [
            'main' => 'El acceso a la beta está actualmente restringido a usuarios privilegiados.',
            'small' => '(los osu!supporters tendrán acceso pronto)',
        ],
    ],

    'posts' => [
        'title' => 'Publicaciones de :username',
    ],

    'anonymous' => [
        'login_link' => 'haga clic para iniciar sesión',
        'login_text' => 'iniciar sesión',
        'username' => 'Invitado',
        'error' => 'Necesitas haber iniciado sesión para hacer esto.',
    ],
    'logout_confirm' => '¿Seguro que desea cerrar la sesión? :(',
    'report' => [
        'button_text' => 'Denunciar',
        'comments' => 'Comentarios adicionales',
        'placeholder' => 'Por favor, proporcione cualquier información que crea que pueda ser útil.',
        'reason' => 'Motivo',
        'thanks' => '¡Gracias por su informe!',
        'title' => '¿Denunciar a :username?',

        'actions' => [
            'send' => 'Enviar denuncia',
            'cancel' => 'Cancelar',
        ],

        'options' => [
            'cheating' => 'Juega sucio o hace trampa',
            'multiple_accounts' => 'Utiliza múltiples cuentas',
            'insults' => 'Insulta a mí o a otros',
            'spam' => 'Envía mensajes spam',
            'unwanted_content' => 'Enlaza contenido inapropiado',
            'nonsense' => 'Sin sentido',
            'other' => 'Otros (indicar abajo)',
        ],
    ],
    'restricted_banner' => [
        'title' => '¡Su cuenta ha sido restringida!',
        'message' => 'Mientras estás restringido, no podrás interactuar con otros jugadores y tus puntuaciones solo las podrás ver tú. Esto es, normalmente, el resultado de un proceso automatizado, y se levanta normalmente dentro de 24 horas. Si deseas apelar a tu restricción, por favor <a href="mailto:accounts@ppy.sh">contacta con el soporte</a>.',
    ],
    'show' => [
        'age' => ':age años',
        'change_avatar' => '¡cambia tu avatar!',
        'first_members' => 'Aquí desde el comienzo',
        'is_developer' => 'osu!developer',
        'is_supporter' => 'osu!supporter',
        'joined_at' => 'Se unió en :date',
        'lastvisit' => 'Visto :date',
        'lastvisit_online' => 'Actualmente en línea',
        'missingtext' => '¡Es posible que hayas cometido un error tipográfico! (o el usuario puede haber sido baneado)',
        'origin_country' => 'De :country',
        'previous_usernames' => 'antes conocido como',
        'plays_with' => 'Juega con :devices',
        'title' => "Perfil de :username",

        'comments_count' => [
            '_' => 'Publicó :link',
            'count' => 'un comentario|:count_delimited comentarios',
        ],
        'edit' => [
            'cover' => [
                'button' => 'Cambiar portada de perfil',
                'defaults_info' => 'Más opciones de portadas estarán disponibles en el futuro',
                'upload' => [
                    'broken_file' => 'Error al procesar la imagen. Verifica la imagen subida e intenta de nuevo.',
                    'button' => 'Subir imagen',
                    'dropzone' => 'Suelta aquí para subir',
                    'dropzone_info' => 'También puedes soltar tu imagen aquí para subirla',
                    'size_info' => 'El tamaño de la portada debe ser de 2400x640',
                    'too_large' => 'El archivo subido es demasiado grande.',
                    'unsupported_format' => 'Formato no soportado.',

                    'restriction_info' => [
                        '_' => 'Carga disponible sólo para :link',
                        'link' => 'osu!supporters',
                    ],
                ],
            ],

            'default_playmode' => [
                'is_default_tooltip' => 'modo de juego predeterminado',
                'set' => 'establecer :mode como el modo de juego predeterminado del perfil',
            ],
        ],

        'extra' => [
            'none' => 'ninguno',
            'unranked' => 'No hay partidas recientes',

            'achievements' => [
                'achieved-on' => 'Obtenido el :date',
                'locked' => 'Bloqueado',
                'title' => 'Logros',
            ],
            'beatmaps' => [
                'by_artist' => 'por :artist',
                'title' => 'Mapas',

                'favourite' => [
                    'title' => 'Mapas Favoritos',
                ],
                'graveyard' => [
                    'title' => 'Mapas Abandonados',
                ],
                'loved' => [
                    'title' => 'Mapas Amados',
                ],
                'pending' => [
                    'title' => 'Mapas Pendientes',
                ],
                'ranked' => [
                    'title' => 'Mapas Clasificados y Aprobados',
                ],
            ],
            'discussions' => [
                'title' => 'Discusiones',
                'title_longer' => 'Discusiones recientes',
                'show_more' => 'ver más discusiones',
            ],
            'events' => [
                'title' => 'Eventos',
                'title_longer' => 'Eventos Recientes',
                'show_more' => 'ver más eventos',
            ],
            'historical' => [
                'title' => 'Histórico',

                'monthly_playcounts' => [
                    'title' => 'Historial de juego',
                    'count_label' => 'Veces jugado',
                ],
                'most_played' => [
                    'count' => 'veces jugadas',
                    'title' => 'Mapas más jugados',
                ],
                'recent_plays' => [
                    'accuracy' => 'precisión: :percentage',
                    'title' => 'Jugadas recientes (24 h)',
                ],
                'replays_watched_counts' => [
                    'title' => 'Historial de repeticiones vistas',
                    'count_label' => 'Repeticiones vistas',
                ],
            ],
            'kudosu' => [
                'recent_entries' => 'Historial de Kudosu Reciente',
                'title' => 'Kudosu!',
                'total' => 'Total de Kudosu obtenido',

                'entry' => [
                    'amount' => ':amount kudosu',
                    'empty' => "¡Este usuario no ha recibido ningún kudosu!",

                    'beatmap_discussion' => [
                        'allow_kudosu' => [
                            'give' => 'Recibió :amount de revocación de negación de kudosu por la publicación de modding :post',
                        ],

                        'deny_kudosu' => [
                            'reset' => 'Se le negó :amount por la publicación de modding :post',
                        ],

                        'delete' => [
                            'reset' => 'Perdió :amount por la eliminación de la publicación de modding de :post',
                        ],

                        'restore' => [
                            'give' => 'Recibió :amount por la restauración de la publicación de modding de :post',
                        ],

                        'vote' => [
                            'give' => 'Recibió :amount por obtención de votos en la publicación de modding de :post',
                            'reset' => 'Perdió :amount por perder votos en la publicación de modding de :post',
                        ],

                        'recalculate' => [
                            'give' => 'Recibió :amount por recálculo de votos en la publicación de modding de :post',
                            'reset' => 'Perdió :amount por recálculo de votos en la publicación de modding de :post',
                        ],
                    ],

                    'forum_post' => [
                        'give' => 'Recibió :amount de :giver por una publicación en :post',
                        'reset' => 'Kudosu reiniciado por :giver por la publicación :post',
                        'revoke' => 'Se le negó kudosu por :giver por la publicación :post',
                    ],
                ],

                'total_info' => [
                    '_' => 'Según la contribución que el usuario ha hecho al modding de mapas. Vea :link para más información.',
                    'link' => 'esta página',
                ],
            ],
            'me' => [
                'title' => '¡yo!',
            ],
            'medals' => [
                'empty' => "Este usuario aún no ha conseguido ninguna. ;_;",
                'recent' => 'Más reciente',
                'title' => 'Medallas',
            ],
            'multiplayer' => [
                'title' => 'Partidas multijugador',
            ],
            'posts' => [
                'title' => 'Publicaciones',
                'title_longer' => 'Publicaciones recientes',
                'show_more' => 'ver más publicaciones',
            ],
            'recent_activity' => [
                'title' => 'Reciente',
            ],
            'top_ranks' => [
                'download_replay' => 'Descargar repetición',
                'not_ranked' => 'Sólo los mapas clasificados dan pp.',
                'pp_weight' => 'valorado :percentage',
                'view_details' => 'Ver detalles',
                'title' => 'Rangos',

                'best' => [
                    'title' => 'Mejor rendimiento',
                ],
                'first' => [
                    'title' => 'Primeros lugares',
                ],
            ],
            'votes' => [
                'given' => 'Votos dados (últimos 3 meses)',
                'received' => 'Votos recibidos (últimos 3 meses)',
                'title' => 'Votos',
                'title_longer' => 'Votos recientes',
                'vote_count' => ':count_delimited voto|:count_delimited votos',
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
            'discord' => '',
            'interests' => 'Intereses',
            'location' => 'Ubicación actual',
            'occupation' => 'Ocupación',
            'twitter' => '',
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
            'button' => 'Editar página de perfil',
            'description' => '<strong>¡yo!</strong> es una área personal y personalizable en tu perfil.',
            'edit_big' => 'Editar ¡yo!',
            'placeholder' => 'Escriba el contenido de la página aquí',

            'restriction_info' => [
                '_' => 'Debes ser un :link para desbloquear esta función.',
                'link' => 'osu!supporter',
            ],
        ],
        'post_count' => [
            '_' => 'Contribuyó con :link',
            'count' => ':count_delimited publicación en el foro|:count_delimited publicaciones en el foro',
        ],
        'rank' => [
            'country' => 'Rank nacional para :mode',
            'country_simple' => 'Clasificación Nacional',
            'global' => 'Rank global para :mode',
            'global_simple' => 'Clasificación Global',
        ],
        'stats' => [
            'hit_accuracy' => 'Precisión',
            'level' => 'Nivel :level',
            'level_progress' => 'Progreso al siguiente nivel',
            'maximum_combo' => 'Combo máximo',
            'medals' => 'Medallas',
            'play_count' => 'Conteo de jugadas',
            'play_time' => 'Tiempo de juego total',
            'ranked_score' => 'Puntuación clasificada',
            'replays_watched_by_others' => 'Repeticiones vistas por otros',
            'score_ranks' => 'Clasificación de las puntuaciones',
            'total_hits' => 'Golpes totales',
            'total_score' => 'Puntuación total',
            // modding stats
            'graveyard_beatmapset_count' => 'Mapas Abandonados',
            'loved_beatmapset_count' => 'Mapas Amados',
            'pending_beatmapset_count' => 'Mapas Pendientes',
            'ranked_beatmapset_count' => 'Mapas Clasificados y Aprobados',
        ],
    ],

    'silenced_banner' => [
        'title' => 'Actualmente está silenciado.',
        'message' => 'Es posible que algunas acciones no estén disponibles.',
    ],

    'status' => [
        'all' => 'Todos',
        'online' => 'En línea',
        'offline' => 'Sin conexión',
    ],
    'store' => [
        'saved' => 'Usuario creado',
    ],
    'verify' => [
        'title' => 'Verificación de la cuenta',
    ],

    'view_mode' => [
        'brick' => 'Vista de bloque',
        'card' => 'Vista de tarjeta',
        'list' => 'Vista de lista',
    ],
];
