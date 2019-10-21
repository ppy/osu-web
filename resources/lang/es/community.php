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
                'description' => '¡Con tu soporte podemos acercarnos a mas artistas increíbles y licenciar mas músicas geniales para usar en osu!',
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
                'description' => 'Apoyar a los colaboradores de la comunidad que han dado su tiempo y esfuerzo para ayudar a hacer osu!.',
                'link_text' => 'Descubre más &raquo;',
            ],
        ],
        'perks' => [
            'title' => '¿Oh? ¡¿Qué obtengo?!',
            'osu_direct' => [
                'title' => 'osu!direct',
                'description' => 'acceso rápido y sencillo para buscar Beatmaps sin salir del juego.',
            ],

            'friend_ranking' => [
                'title' => 'Ranking de Amigos',
                'description' => "Vea como lo haces contra tus amigos en un ranking de beatmap, tanto dentro del juego como en la web.",
            ],

            'country_ranking' => [
                'title' => 'Ranking Nacional',
                'description' => 'Conquista tu país antes de conquistar el mundo.',
            ],

            'mod_filtering' => [
                'title' => 'Filtrar por Mods',
                'description' => '¿Asociar sólo a las personas que juegan HDHR? ¡No hay problema!',
            ],

            'auto_downloads' => [
                'title' => 'Descargas Automáticas',
                'description' => '¡Descargas automáticas cuando juegas multijugador, espectas a otros, o al dar clic a enlaces en el chat!',
            ],

            'upload_more' => [
                'title' => 'Sube más',
                'description' => 'Ranuras de Beatmaps pendientes adicionales (por beatmap rankeado) hasta un máximo de 10.',
            ],

            'early_access' => [
                'title' => 'Acceso anticipado',
                'description' => '¡Acceso a lanzamientos anticipados, donde puedes probar nuevas características antes de que sean públicas!',
            ],

            'customisation' => [
                'title' => 'Personalización',
                'description' => "Personaliza tu perfil añadiendo una página de usuario totalmente personalizable.",
            ],

            'beatmap_filters' => [
                'title' => 'Filtros de Beatmap',
                'description' => 'Filtra búsquedas de beatmaps por mapas jugados, no jugados y por puntuación obtenida. (Sí la hay).',
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
                'description' => 'La habilidad de cambiar tu nombre de usuario sin costes adicionales. (máximo una vez)',
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
                'description' => 'La habilidad de ver rankings nacionales / amigos / por mod de un beatmap dentro del juego.',
            ],

            'more_favourites' => [
                'title' => 'Más favoritos',
                'description' => 'El número máximo de mapas de beatmaps que puedes preferir se incrementa desde :normally &rarr; :supporter',
            ],
            'more_friends' => [
                'title' => 'Más Amigos',
                'description' => 'El número máximo de amigos que puedes tener es aumentado de :normally &rarr; :supporter',
            ],
            'more_beatmaps' => [
                'title' => 'Subir más Beatmaps',
                'description' => 'Se calcula cuántos mapas sin calificar puedes tener a la vez, a partir de un valor base más un bono adicional por cada mapa clasificado que tenga actualmente (hasta un límite).<br/><br/>Normalmente esto es 4 más 1 por mapa clasificado (hasta 2). Con soporte, esto aumenta a 8 más 1 por mapa clasificado (hasta 12).',
            ],
            'friend_filtering' => [
                'title' => 'Ranking de Amigos',
                'description' => 'Compite con tus amigos y vea cómo se clasifica contra ellos!*<br/><br/><small>* aun no disponible en la nueva pagina, pronto(tm)</small>',
            ],

        ],
        'supporter_status' => [
            'contribution' => '¡Gracias por tu apoyo hasta ahora! ¡Has contribuido un total de :dollars con la compra de :tags tags!',
            'gifted' => ":giftedTags de tus compras de tags han sido regaladas (un total de :giftedDollars regalados), ¡qué generoso!",
            'not_yet' => "Todavía no tienes un tag de supporter aún :(",
            'valid_until' => 'Tu tag de supporter actual es válida hasta el :date!',
            'was_valid_until' => 'Tu tag de supporter fue válida hasta :date.',
        ],
    ],
];
