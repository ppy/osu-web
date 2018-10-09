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
    'support' => [
        'header' => [
            // size in font-size
            'big_description' => '',
            'small_description' => '',
            'support_button' => 'Quiero ayudar a osu!',
        ],

        'dev_quote' => 'osu! es un juego completamente gratuito, pero mantenerlo definitivamente no es tan gratis.
        Entre el costo de alquilar servidores y el ancho de banda internacional de alta calidad, el tiempo dedicado al mantenimiento del sistema y la comunidad,
        proporcionando premios para competencias, responder preguntas de soporte y, en general, mantener a la gente contenta, osu! ¡consume una cantidad considerable de dinero!
        ¡Ah, y no olvides el hecho de que lo hacemos sin publicidad ni asociación con barras de herramientas tontas y cosas por el estilo!
            <br/><br/>osu! es, al final del día, en gran parte administrado por mí, al que pueden conocer mejor como "peppy".
            Tuve que dejar mi trabajo con el fin de manternerme al dia con osu!,
            y en ocasiones lucho para mantener los estándares por los que me esfuerzo.
            Me gustaría ofrecer mi agradecimiento personal a aquellos que han apoyado a osu! hasta ahora,
            y tanto como para aquellos que continúan apoyando este increíble juego y comunidad en el futuro :).',

        'supporter_status' => [
            'contribution' => '¡Gracias por tu apoyo hasta ahora! ¡Has contribuido un total de :dollars con la compra de :tags tags!',
            'gifted' => ':giftedTags de tus compras de tags han sido regaladas (un total de :giftedDollars regalados), ¡qué generoso!',
            'not_yet' => "Todavía no tienes un tag de supporter aún :(",
            'title' => 'Estado de supporter actual',
            'valid_until' => 'Tu tag de supporter actual es válida hasta el :date!',
            'was_valid_until' => 'Tu tag de supporter fue válida hasta :date.',
        ],

        'why_support' => [
            'title' => '¿Por qué deberia apoyar a osu!?',
            'blocks' => [
                'dev' => 'Desarollado y mantenido principalmente por un hombre en Australia',
                'time' => 'Toma demasiado tiempo para mantenerlo funcionando, llegando al punto de que ya no es posible llamarlo un "pasatiempo".',
                'ads' => 'Sin anuncios en ningún lado. <br/><br/>
                        Al contrario que el 99.95% de la web, no obtenemos ingresos poniéndote cosas en tu cara.',
                'goodies' => '¡Obtienes algunos beneficios extra!',
            ],
        ],

        'perks' => [
            'title' => '¿Oh? ¡¿Qué obtengo?!',
            'osu_direct' => [
                'title' => 'osu!direct',
                'description' => 'acceso rápido y sencillo para buscar Beatmaps sin salir del juego.',
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
                'description' => 'Personaliza tu perfil añadiendo una página de usuario totalmente personalizable.',
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

            'feel_special' => [
                'title' => 'Siéntete Especial',
                'description' => 'La calidez y el sentimiento de hacer tu parte para mantener osu! funcionando sin problemas.',
            ],

            'more_to_come' => [
                'title' => 'Más por venir',
                'description' => '',
            ],
        ],

        'convinced' => [
            'title' => '¡Estoy convencido! :D',
            'support' => 'apoyar a osu!',
            'gift' => 'o regalar supporter a otros jugadores',
            'instructions' => 'clic al botón del corazón para proceder a la osu!store',
        ],
    ],
];
