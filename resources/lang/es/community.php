<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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
    'support' => [
        'convinced' => [
            'title' => '¡Estoy convencido! :D',
            'support' => 'apoyar a osu!',
            'gift' => 'o regalar supporter a otros jugadores',
            'instructions' => 'clic al botón del corazón para proceder a la osu!store',
        ],
        'why-support' => [
            'title' => '¿Por qué debo apoyar osu!? ¿Dónde va el dinero?',

            'team' => [
                'title' => 'Apoyar al equipo',
                'description' => 'Un pequeño equipo desarrolla y ejecuta osu!. Tu apoyo les ayuda, tú sabes... en vivo.',
            ],
            'infra' => [
                'title' => 'Infraestructura del servidor',
                'description' => 'Las contribuciones van hacia los servidores para ejecutar el sitio web, servicios multijugador, foros de clasificación online, etc.',
            ],
            'featured-artists' => [
                'title' => 'Artistas Destacados',
                'description' => 'Con su apoyo, podemos acercarnos a artistas aún más impresionantes y licenciar más música para su uso en osu!',
                'link_text' => 'Ver la lista actual &raquo;',
            ],
            'ads' => [
                'title' => 'Mantener osu! autosuficiente',
                'description' => 'Tus contribuciones ayudan a mantener el juego independiente y completamente libre de anuncios y patrocinadores externos.',
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
                'description' => "Observa cómo te enfrentas a tus amigos en la tabla de clasificación de un mapa, tanto dentro del juego como en el sitio web.",
            ],

            'country_ranking' => [
                'title' => 'Clasificación Nacional',
                'description' => 'Conquista tu país antes de conquistar el mundo.',
            ],

            'mod_filtering' => [
                'title' => 'Filtrar por Mods',
                'description' => '¿Asociarse sólo con personas que juegan con HDHR? ¡No hay problema!',
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
                'title' => 'Filtros de Beatmap',
                'description' => 'Filtra búsquedas de beatmaps por mapas jugados, no jugados y por puntuación obtenida.',
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
                'description' => 'Se calcula cuántos mapas sin calificar puedes tener a la vez, a partir de un valor base más un bono adicional por cada mapa clasificado que tenga actualmente (hasta un límite).<br/><br/>Normalmente esto es 4 más 1 por mapa clasificado (hasta 2). Con soporte, esto aumenta a 8 más 1 por mapa clasificado (hasta 12).',
            ],
            'friend_filtering' => [
                'title' => 'Amigos en la tabla de clasificación',
                'description' => '¡Compita con sus amigos y vea cómo se clasifica contra ellos!*<br/><br/><small>* aún no disponible en el nuevo sitio, pronto(tm)</small>',
            ],

        ],
        'supporter_status' => [
            'contribution' => '¡Gracias por tu apoyo hasta ahora! ¡Has contribuido con :dollars con la compra de :tags tag(s)!',
            'gifted' => "Has regalado :giftedTags de tus compras (eso es un valor de :giftedDollars), ¡qué generoso!",
            'not_yet' => "Nunca has tenido un tag de osu!supporter :(",
            'valid_until' => '¡Tu tag de osu!supporter actual es válida hasta el :date!',
            'was_valid_until' => 'Tu tag de osu!supporter fue válida hasta el :date.',
        ],
    ],
];
