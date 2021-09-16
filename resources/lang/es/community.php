<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'support' => [
        'convinced' => [
            'title' => '¡Estoy convencido! :D',
            'support' => 'apoyar a osu!',
            'gift' => 'o regalar supporter a otros jugadores',
            'instructions' => 'clic al botón del corazón para proceder a la osu!store',
        ],
        'why-support' => [
            'title' => '¿Por qué debería apoyar osu!? ¿A dónde va el dinero?',

            'team' => [
                'title' => 'Apoyar al equipo',
                'description' => 'Un pequeño equipo desarrolla y mantiene osu!. Su apoyo les ayuda a, ya sabe... vivir.',
            ],
            'infra' => [
                'title' => 'Infraestructura del servidor',
                'description' => 'Las contribuciones se destinan a los servidores para el funcionamiento del sitio web, los servicios multijugador, las tablas de clasificación en línea, etc.',
            ],
            'featured-artists' => [
                'title' => 'Artistas Destacados',
                'description' => 'Con su apoyo, podemos acercarnos a artistas aún más impresionantes y licenciar más música para su uso en osu!',
                'link_text' => 'Ver la lista actual &raquo;',
            ],
            'ads' => [
                'title' => 'Mantener osu! autosuficiente',
                'description' => 'Sus contribuciones ayudan a mantener el juego independiente y completamente libre de anuncios y patrocinadores externos.',
            ],
            'tournaments' => [
                'title' => 'Torneos oficiales',
                'description' => 'Ayuda a financiar el funcionamiento de (y los premios para) los torneos oficiales de la Copa Mundial.',
                'link_text' => 'Explorar torneos &raquo;',
            ],
            'bounty-program' => [
                'title' => 'Programa de Bounty de Código Abierto',
                'description' => 'Apoye a los contribuyentes de la comunidad que han dado su tiempo y esfuerzo para ayudar a hacer que osu! sea mejor.',
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
                'title' => 'Clasificación entre Amigos',
                'description' => "Vea cómo se compara con sus amigos en la tabla de clasificación de un mapa, tanto dentro del juego como en el sitio web.",
            ],

            'country_ranking' => [
                'title' => 'Clasificación Nacional',
                'description' => 'Conquiste su país antes de conquistar el mundo.',
            ],

            'mod_filtering' => [
                'title' => 'Filtrar por Mods',
                'description' => '¿Asociarse sólo con personas que juegan con mods HDHR? ¡No hay problema!',
            ],

            'auto_downloads' => [
                'title' => 'Descargas Automáticas',
                'description' => '¡Los mapas se descargarán automáticamente en partidas multijugador, mientras espectas a otros, o al hacer clic en enlaces relevantes en el chat!',
            ],

            'upload_more' => [
                'title' => 'Sube más',
                'description' => 'Espacios para mapas pendientes adicionales (por mapa clasificado) hasta un máximo de 10.',
            ],

            'early_access' => [
                'title' => 'Acceso anticipado',
                'description' => '¡Obtén acceso anticipado a nuevos lanzamientos con nuevas características antes de que se hagan públicas!<br/><br/>¡Esto incluye el acceso anticipado a nuevas características en el sitio web también!',
            ],

            'customisation' => [
                'title' => 'Personalización',
                'description' => "Destaca subiendo una imagen de portada personalizada o creando una sección '¡yo!' totalmente personalizable dentro de tu perfil de usuario.",
            ],

            'beatmap_filters' => [
                'title' => 'Filtros de Mapas',
                'description' => 'Filtre las búsquedas de mapas por mapas jugados y no jugados, o por rango obtenido.',
            ],

            'yellow_fellow' => [
                'title' => 'Amigo Amarillo',
                'description' => 'Sé reconocido dentro del juego con tu nuevo color de usuario amarillo brillante en el chat.',
            ],

            'speedy_downloads' => [
                'title' => 'Descargas Rápidas',
                'description' => 'Restricciones de descarga más permisivas, especialmente al usar osu!direct.',
            ],

            'change_username' => [
                'title' => 'Cambiar Nombre de usuario',
                'description' => 'Un cambio de nombre gratuito se incluye con su primera compra de supporter.',
            ],

            'skinnables' => [
                'title' => 'Skinnables',
                'description' => 'Más posibilidades para las skins, como cambiar el fondo del menú.',
            ],

            'feature_votes' => [
                'title' => 'Votos de Características',
                'description' => 'Votos para solicitudes de características. (2 por mes)',
            ],

            'sort_options' => [
                'title' => 'Opciones de Orden',
                'description' => 'La habilidad de ver las clasificaciones nacionales / amigos / por mod de un mapa dentro del juego.',
            ],

            'more_favourites' => [
                'title' => 'Más favoritos',
                'description' => 'El número máximo de mapas que puede marcar como favorito aumenta de :normally &rarr; :supporter',
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
                'title' => 'Amigos en la tabla de clasificación',
                'description' => '¡Compita con sus amigos y vea cómo se clasifica contra ellos!',
            ],

        ],
        'supporter_status' => [
            'contribution' => '¡Gracias por su apoyo hasta ahora! ¡Ha contribuido con :dollars con la compra de :tags tag(s)!',
            'gifted' => "Ha regalado :giftedTags de sus compras (por valor de :giftedDollars), ¡qué generoso!",
            'not_yet' => "Nunca has tenido un tag de osu!supporter :(",
            'valid_until' => '¡Su tag de osu!supporter actual es válido hasta el :date!',
            'was_valid_until' => 'Su tag de osu!supporter fue válido hasta el :date.',
        ],
    ],
];
