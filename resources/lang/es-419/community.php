<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'support' => [
        'convinced' => [
            'title' => '¡Me has convencido! :D',
            'support' => 'apoya a osu!',
            'gift' => 'o regálale un soporte a otro jugador',
            'instructions' => 'haz clic en el botón del corazón para ir a la osu!store',
        ],
        'why-support' => [
            'title' => '¿Por qué debería apoyar a osu!? ¿A dónde va el dinero?',

            'team' => [
                'title' => 'Apoyar al equipo',
                'description' => 'Un pequeño equipo desarrolla y mantiene osu! Tu apoyo les ayuda a, ya sabes... vivir.',
            ],
            'infra' => [
                'title' => 'Infraestructura del servidor',
                'description' => 'Las contribuciones se destinan a los servidores para el funcionamiento del sitio web, los servicios multijugador, las tablas de clasificación en línea, etc.',
            ],
            'featured-artists' => [
                'title' => 'Artistas destacados',
                'description' => 'Con tu apoyo, podremos acercarnos a más artistas increíbles y obtener más licencias de música para osu!',
                'link_text' => 'Ver la lista actual &raquo;',
            ],
            'ads' => [
                'title' => 'Mantener osu! autosuficiente',
                'description' => 'Tus contribuciones ayudan a mantener el juego independiente y completamente libre de anuncios y patrocinadores externos.',
            ],
            'tournaments' => [
                'title' => 'Torneos oficiales',
                'description' => 'Ayuda a financiar el funcionamiento (y los premios) de las osu! World Cups oficiales.',
                'link_text' => 'Explorar torneos &raquo;',
            ],
            'bounty-program' => [
                'title' => 'Programa de recompensas de colaboración abierta',
                'description' => 'Apoya a los contribuidores de la comunidad que han dado su tiempo y esfuerzo para ayudar a hacer que osu! sea mejor.',
                'link_text' => 'Descubre más &raquo;',
            ],
        ],
        'perks' => [
            'title' => '¡Genial! ¿Qué beneficios obtengo?',
            'osu_direct' => [
                'title' => 'osu!direct',
                'description' => 'Obtén acceso rápido y sencillo para buscar y descargar mapas sin tener que salir del juego.',
            ],

            'friend_ranking' => [
                'title' => 'Clasificación entre amigos',
                'description' => "Compara tus resultados con los de tus amigos en la tabla de clasificación de un mapa, tanto en el juego como en el sitio web.",
            ],

            'country_ranking' => [
                'title' => 'Clasificación nacional',
                'description' => 'Conquista tu país antes de conquistar el mundo.',
            ],

            'mod_filtering' => [
                'title' => 'Filtrado por mods',
                'description' => '¿Asociarte solo con personas que juegan con HDHR? ¡No hay problema!',
            ],

            'auto_downloads' => [
                'title' => 'Descargas automáticas',
                'description' => '¡Los mapas se descargarán automáticamente en las partidas multijugador, cuando estés viendo a otros jugadores, o cuando hagas clic en los enlaces correspondientes en el chat!',
            ],

            'upload_more' => [
                'title' => 'Sube más',
                'description' => 'Espacios para mapas pendientes adicionales (por mapa clasificado) hasta un máximo de 10.',
            ],

            'early_access' => [
                'title' => 'Acceso anticipado',
                'description' => '¡Obtén acceso anticipado a nuevas versiones con nuevas funciones antes de que se hagan públicas!<br/><br/>¡Esto también incluye el acceso anticipado a las nuevas funciones del sitio web!',
            ],

            'customisation' => [
                'title' => 'Personalización',
                'description' => "Destaca subiendo una imagen de portada personalizada o creando una sección '¡yo!' totalmente personalizable dentro de tu perfil de usuario.",
            ],

            'beatmap_filters' => [
                'title' => 'Filtros en la búsqueda de mapas',
                'description' => 'Filtra las búsquedas de mapas por mapas jugados y no jugados, o por grado conseguido.',
            ],

            'yellow_fellow' => [
                'title' => 'Color amarillo en el chat',
                'description' => 'Resalta dentro del chat del juego con un amarillo brillante en tu nombre de usuario.',
            ],

            'speedy_downloads' => [
                'title' => 'Descargas rápidas',
                'description' => 'Restricciones de descarga más permisivas, especialmente al utilizar osu!direct.',
            ],

            'change_username' => [
                'title' => 'Cambiar nombre de usuario',
                'description' => 'Un cambio de nombre gratuito se incluye con tu primera compra de supporter.',
            ],

            'skinnables' => [
                'title' => 'Más elementos de personalización',
                'description' => 'Más elementos personalizables en el juego, como el fondo del menú principal.',
            ],

            'feature_votes' => [
                'title' => 'Votos para nuevas funciones',
                'description' => 'Votos para solicitudes de funciones. (2 al mes)',
            ],

            'sort_options' => [
                'title' => 'Opciones de orden',
                'description' => 'La posibilidad de ver las clasificaciones de tu país, amigos o mods en el juego.',
            ],

            'more_favourites' => [
                'title' => 'Más favoritos',
                'description' => 'El número máximo de mapas que puedes marcar como favorito aumenta de :normally &rarr; :supporter',
            ],
            'more_friends' => [
                'title' => 'Más amigos',
                'description' => 'El número máximo de amigos que puedes tener aumenta de :normally &rarr; :supporter',
            ],
            'more_beatmaps' => [
                'title' => 'Subir más mapas',
                'description' => 'El número de mapas pendientes que puedes tener a la vez se calcula a partir de un valor base más una bonificación adicional por cada mapa clasificado que tengas actualmente (hasta un límite).<br/><br/>Normalmente esto es :base más :bonus por mapa clasificado (hasta :bonus_max). Con supporter, esto aumenta a :supporter_base más :supporter_bonus por cada mapa clasificado (hasta :supporter_bonus_max).',
            ],
            'friend_filtering' => [
                'title' => 'Tablas de clasificación entre amigos',
                'description' => '¡Compite con tus amigos y compara tus puntuaciones con las de ellos!',
            ],

        ],
        'supporter_status' => [
            'contribution_with_duration' => '',
            'not_yet' => "Nunca has tenido una etiqueta de osu!supporter :(",
            'valid_until' => '¡Tu etiqueta de osu!supporter actual es válida hasta el :date!',
            'was_valid_until' => 'Tu etiqueta de osu!supporter fue válida hasta el :date.',

            'gifted' => [
                '_' => '',
                'users' => '',
            ],
        ],
    ],
];
