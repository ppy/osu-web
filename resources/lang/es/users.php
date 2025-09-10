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
        'comment_text' => 'Este comentario está oculto.',
        'blocked_count' => 'usuarios bloqueados (:count)',
        'hide_profile' => 'Ocultar perfil',
        'hide_comment' => 'ocultar',
        'forum_post_text' => 'Esta publicación está oculta.',
        'not_blocked' => 'Ese usuario no está bloqueado.',
        'show_profile' => 'Mostrar perfil',
        'show_comment' => 'mostrar',
        'too_many' => 'Límite de bloqueos alcanzado.',
        'button' => [
            'block' => 'Bloquear',
            'unblock' => 'Desbloquear',
        ],
    ],

    'card' => [
        'gift_supporter' => 'Regalar etiqueta de supporter',
        'loading' => 'Cargando...',
        'send_message' => 'Enviar mensaje',
    ],

    'create' => [
        'form' => [
            'password' => 'contraseña',
            'password_confirmation' => 'confirmar contraseña',
            'submit' => 'crear cuenta',
            'user_email' => 'correo',
            'user_email_confirmation' => 'confirmar correo',
            'username' => 'nombre de usuario',

            'tos_notice' => [
                '_' => 'al crear una cuenta aceptas los :link',
                'link' => 'términos de servicio',
            ],
        ],
    ],

    'disabled' => [
        'title' => '¡Oh, oh! Parece que su cuenta ha sido desactivada.',
        'warning' => "En el caso de que hayas roto una regla, ten en cuenta que generalmente hay un período de espera de un mes durante el cual no consideraremos ninguna solicitud de amnistía. Después de este período, puedes contactar con nosotros si lo consideras necesario. Ten en cuenta que la creación de nuevas cuentas después de haber tenido una desactivada resultará en una <strong>extensión de este período de espera de un mes</strong>. Por favor, también ten en cuenta que por <strong>cada cuenta que crees, estarás violando más reglas</strong>. ¡Te sugerimos que no sigas este camino!",

        'if_mistake' => [
            '_' => 'Si crees que se trata de un error, puedes ponerse en contacto con nosotros (por :email o haciendo clic en el «?» de la esquina inferior derecha de esta página). Ten en cuenta que siempre confiamos plenamente en nuestras acciones, ya que se basan en datos muy sólidos. Nos reservamos el derecho de ignorar tu petición si consideramos que estás siendo intencionadamente deshonesto.',
            'email' => 'correo electrónico',
        ],

        'reasons' => [
            'compromised' => 'Tu cuenta se ha considerado comprometida. Puede ser desactivada temporalmente mientras se confirma tu identidad.',
            'opening' => 'Hay una serie de razones que pueden resultar en la desactivación de su cuenta:',

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
            'inactive' => "Tu cuenta no ha sido usada en mucho tiempo.",
            'inactive_different_country' => "Tu cuenta no ha sido usada en mucho tiempo.",
        ],
    ],

    'login' => [
        '_' => 'Iniciar sesión',
        'button' => 'Iniciar sesión',
        'button_posting' => 'Iniciando sesión...',
        'email_login_disabled' => 'El inicio de sesión con correo electrónico está actualmente desactivado. Por favor, usa el nombre de usuario en su lugar.',
        'failed' => 'Inicio de sesión incorrecto',
        'forgot' => '¿Olvidaste tu contraseña?',
        'info' => 'Por favor, inicie sesión para continuar',
        'invalid_captcha' => 'Demasiados intentos fallidos de inicio de sesión, completa el captcha e inténtalo de nuevo. (Actualiza la página si el captcha no está visible)',
        'locked_ip' => 'Tu dirección IP está bloqueada. Espera unos minutos.',
        'password' => 'Contraseña',
        'register' => "¿No tienes una cuenta de osu!? Crea una nueva",
        'remember' => 'Recordar este computador',
        'title' => 'Inicia sesión para continuar',
        'username' => 'Nombre de usuario',

        'beta' => [
            'main' => 'El acceso a la beta está actualmente restringido a usuarios privilegiados.',
            'small' => '(los osu!supporters tendrán acceso pronto)',
        ],
    ],

    'multiplayer' => [
        'index' => [
            'active' => 'Activas',
            'ended' => 'Finalizadas',
        ],
    ],

    'ogp' => [
        'modding_description' => 'Mapas: :counts',
        'modding_description_empty' => 'El usuario no tiene ningún beatmap...',

        'description' => [
            '_' => 'Clasificación (:ruleset): :global | :country',
            'country' => 'País :rank',
            'global' => 'Global :rank',
        ],
    ],

    'posts' => [
        'title' => 'Publicaciones de :username',
    ],

    'anonymous' => [
        'login_link' => 'haz clic para iniciar sesión',
        'login_text' => 'iniciar sesión',
        'username' => 'Invitado',
        'error' => 'Necesitas haber iniciado sesión para hacer esto.',
    ],
    'logout_confirm' => '¿Seguro que deseas cerrar la sesión? :(',
    'report' => [
        'button_text' => 'Reportar',
        'comments' => 'Comentarios',
        'placeholder' => 'Por favor, proporciona cualquier información que creas que pueda ser útil.',
        'reason' => 'Motivo',
        'thanks' => '¡Gracias por reportar!',
        'title' => '¿Reportar a :username?',

        'actions' => [
            'send' => 'Enviar reporte',
            'cancel' => 'Cancelar',
        ],

        'dmca' => [
            'message_1' => [
                '_' => 'Por favor, reporta la infracción de derechos de autor a través de una reclamación de DMCA a :mail según :policy.',
                'policy' => 'la política de derechos de autor de osu!',
            ],
            'message_2' => 'Esto se aplica a los casos en los que se usan pistas de audio, contenido visual o contenido de los mapas sin el permiso correcto.',
        ],

        'options' => [
            'cheating' => 'Juega sucio o hace trampa',
            'copyright_infringement' => 'Infracción de derechos de autor',
            'inappropriate_chat' => 'Conducta inapropiada en el chat',
            'insults' => 'Insultándome/insultando a otros',
            'multiple_accounts' => 'Utiliza múltiples cuentas',
            'nonsense' => 'Sin sentido',
            'other' => 'Otros (indicar abajo)',
            'spam' => 'Envía mensajes spam',
            'unwanted_content' => 'Enlaza contenido inapropiado',
        ],
    ],
    'restricted_banner' => [
        'title' => '¡Tu cuenta ha sido restringida!',
        'message' => 'Mientras estás restringido, no podrás interactuar con otros jugadores y tus puntuaciones solo las podrás ver tú. Normalmente, este es el resultado de un proceso automatizado, y se levanta normalmente dentro de 24 horas. :link',
        'message_link' => 'Consulta esta página para obtener más información.',
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
        'missingtext' => '¡Es posible que hayas cometido un error tipográfico! (o el usuario puede haber sido restringido)',
        'origin_country' => 'De :country',
        'previous_usernames' => 'antes conocido como',
        'plays_with' => 'Juega con :devices',

        'comments_count' => [
            '_' => 'Publicó :link',
            'count' => 'un comentario|:count_delimited comentarios',
        ],
        'cover' => [
            'to_0' => 'Ocultar portada',
            'to_1' => 'Mostrar portada',
        ],
        'daily_challenge' => [
            'daily' => 'Racha diaria',
            'daily_streak_best' => 'Mejor racha diaria',
            'daily_streak_current' => 'Racha diaria actual',
            'playcount' => 'Participación total',
            'title' => 'Desafío\ndiario',
            'top_10p_placements' => 'Puestos en el top 10 %',
            'top_50p_placements' => 'Puestos en el top 50 %',
            'weekly' => 'Racha semanal',
            'weekly_streak_best' => 'Mejor racha semanal',
            'weekly_streak_current' => 'Racha semanal actual',

            'unit' => [
                'day' => ':valued',
                'week' => ':valuew',
            ],
        ],
        'edit' => [
            'cover' => [
                'button' => 'Cambiar portada de perfil',
                'defaults_info' => 'Más opciones de portadas estarán disponibles en el futuro',
                'holdover_remove_confirm' => "La portada seleccionada anteriormente ya no está disponible para su selección. No puedes volver a seleccionarla después de cambiar a otra portada. ¿Deseas continuar?",
                'title' => 'Portada',

                'upload' => [
                    'broken_file' => 'Error al procesar la imagen. Verifica la imagen subida e intenta de nuevo.',
                    'button' => 'Subir imagen',
                    'dropzone' => 'Suelta aquí para subir',
                    'dropzone_info' => 'También puedes soltar tu imagen aquí para subirla',
                    'size_info' => 'El tamaño de la portada debe ser de 2400x640',
                    'too_large' => 'El archivo subido es demasiado grande.',
                    'unsupported_format' => 'Formato no soportado.',

                    'restriction_info' => [
                        '_' => 'Carga disponible solo para :link',
                        'link' => 'osu!supporters',
                    ],
                ],
            ],

            'default_playmode' => [
                'is_default_tooltip' => 'modo de juego predeterminado',
                'set' => 'establecer :mode como el modo de juego predeterminado del perfil',
            ],

            'hue' => [
                'reset_no_supporter' => '¿Restablecer al color predeterminado? Se necesitará una etiqueta de osu!supporter para cambiar el color.',
                'title' => 'Color',

                'supporter' => [
                    '_' => 'Los colores personalizados solo están disponibles para :link',
                    'link' => 'osu!supporters',
                ],
            ],
        ],

        'extra' => [
            'none' => 'ninguno',
            'unranked' => 'No hay partidas recientes',

            'achievements' => [
                'achieved-on' => 'Obtenida el :date',
                'locked' => 'Bloqueada',
                'title' => 'Logros',
            ],
            'beatmaps' => [
                'by_artist' => 'de :artist',
                'title' => 'Mapas',

                'favourite' => [
                    'title' => 'Mapas favoritos',
                ],
                'graveyard' => [
                    'title' => 'Mapas abandonados',
                ],
                'guest' => [
                    'title' => 'Mapas con participación de invitados',
                ],
                'loved' => [
                    'title' => 'Mapas amados',
                ],
                'nominated' => [
                    'title' => 'Mapas clasificados nominados',
                ],
                'pending' => [
                    'title' => 'Mapas pendientes',
                ],
                'ranked' => [
                    'title' => 'Mapas clasificados',
                ],
            ],
            'discussions' => [
                'title' => 'Discusiones',
                'title_longer' => 'Discusiones recientes',
                'show_more' => 'ver más discusiones',
            ],
            'events' => [
                'title' => 'Eventos',
                'title_longer' => 'Eventos recientes',
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
                    'title' => 'Jugadas recientes (24 h)',
                ],
                'replays_watched_counts' => [
                    'title' => 'Historial de repeticiones vistas',
                    'count_label' => 'Repeticiones vistas',
                ],
            ],
            'kudosu' => [
                'recent_entries' => 'Historial de Kudosu reciente',
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
                    '_' => 'Según la contribución que el usuario ha hecho a la moderación de mapas. Consulta :link para más información.',
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
            'playlists' => [
                'title' => 'Partidas de listas de juego',
            ],
            'posts' => [
                'title' => 'Publicaciones',
                'title_longer' => 'Publicaciones recientes',
                'show_more' => 'ver más publicaciones',
            ],
            'recent_activity' => [
                'title' => 'Reciente',
            ],
            'realtime' => [
                'title' => 'Partidas multijugador',
            ],
            'top_ranks' => [
                'download_replay' => 'Descargar repetición',
                'not_ranked' => 'Solo los mapas clasificados dan pp',
                'pp_weight' => 'valorado :percentage',
                'view_details' => 'Ver detalles',
                'title' => 'Rangos',

                'best' => [
                    'title' => 'Mejor rendimiento',
                ],
                'first' => [
                    'title' => 'Primeros lugares',
                ],
                'pin' => [
                    'to_0' => 'Desanclar',
                    'to_0_done' => 'Puntuación no anclada',
                    'to_1' => 'Anclar',
                    'to_1_done' => 'Puntuación anclada',
                ],
                'pinned' => [
                    'title' => 'Puntuaciones ancladas',
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
                'remaining_silence' => ':username podrá volver a hablar :duration.',

                'recent_infringements' => [
                    'title' => 'Infracciones recientes',
                    'date' => 'fecha',
                    'action' => 'acción',
                    'length' => 'duración',
                    'length_indefinite' => 'Indefinido',
                    'description' => 'descripción',
                    'actor' => 'por :username',

                    'actions' => [
                        'restriction' => 'Restricción',
                        'silence' => 'Silenciado',
                        'tournament_ban' => 'Restricción de torneos',
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
            'button' => 'editar página de perfil',
            'description' => '<strong>¡yo!</strong> es una área personal y personalizable en tu perfil.',
            'edit_big' => 'Editar ¡yo!',
            'placeholder' => 'Escribe el contenido de la página aquí',

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
            'country' => 'Clasificación nacional para :mode',
            'country_simple' => 'Clasificación nacional',
            'global' => 'Clasificación global para :mode',
            'global_simple' => 'Clasificación global',
            'highest' => 'Clasificación más alta: :rank el :date',
        ],
        'season_stats' => [
            'division_top_percentage' => 'Top :value',
            'total_score' => 'Puntuación total',
        ],
        'stats' => [
            'hit_accuracy' => 'Precisión',
            'hits_per_play' => 'Pulsaciones por jugada',
            'level' => 'Nivel :level',
            'level_progress' => 'progreso al siguiente nivel',
            'maximum_combo' => 'Combo máximo',
            'medals' => 'Medallas',
            'play_count' => 'Número de jugadas',
            'play_time' => 'Tiempo de juego total',
            'ranked_score' => 'Puntuación clasificada',
            'replays_watched_by_others' => 'Repeticiones vistas por otros',
            'score_ranks' => 'Clasificación de las puntuaciones',
            'total_hits' => 'Golpes totales',
            'total_score' => 'Puntuación total',
            // modding stats
            'graveyard_beatmapset_count' => 'Mapas abandonados',
            'loved_beatmapset_count' => 'Mapas amados',
            'pending_beatmapset_count' => 'Mapas pendientes',
            'ranked_beatmapset_count' => 'Mapas clasificados',
        ],
    ],

    'silenced_banner' => [
        'title' => 'Actualmente estás silenciado.',
        'message' => 'Es posible que algunas acciones no estén disponibles.',
    ],

    'status' => [
        'all' => 'Todos',
        'online' => 'En línea',
        'offline' => 'Sin conexión',
    ],
    'store' => [
        'from_client' => '¡regístrate a través del cliente del juego en su lugar!',
        'from_web' => 'por favor, completa el registro usando el sitio web de osu!',
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
