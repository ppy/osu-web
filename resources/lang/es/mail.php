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
    'beatmapset_update_notice' => [
        'new' => 'Para informarte, ha habido una nueva actualización en el beatmap ":title" desde tu última visita.',
        'subject' => 'Nueva actualización para el Beatmap ":title"',
        'unwatch' => 'Si no deseas seguir viendo este mapa, puedes hacer clic en en enlace "Dejar de ver" que se encuentra en la página de arriba, o desde la página de lista de seguimiento de modding:',
        'visit' => 'Visita la página de discusión aquí:',
    ],

    'common' => [
        'closing' => 'Atentamente,',
        'hello' => 'Hola :user,',
        'report' => 'Por favor responde a este correo INMEDIATAMENTE si no solicitaste este cambio.',
    ],

    'donation_thanks' => [
        'benefit_more' => '¡Además, con el tiempo aparecerán nuevos beneficios para supporter!',
        'feedback' => "Si tienes alguna pregunta o comentarios, no dudes en responder a este correo; ¡Te responderé lo antes posible!",
        'keep_free' => 'Es gracias a gente como tú que osu! es capaz de mantener el juego y la comunidad funcionando sin problemas, sin anuncios o pagos forzados.',
        'keep_running' => '¡Tu apoyo mantiene a osu! funcionando durante :minutes! Puede que no parezca mucho, pero todo suma :).',
        'subject' => 'Gracias, osu! te <3',
        'translation' => 'Se muestra a continuación una traducción proporcionada por usuarios con fines informativos:',

        'benefit' => [
            'gift' => 'A quien(es) le regaló ahora tendrá(n) acceso a osu!direct y a muchos otros beneficios para supporter.',
            'self' => 'Ahora tendrá acceso a osu!direct y a muchos otros beneficios para supporter por :duration.',
        ],

        'support' => [
            '_' => 'Muchas gracias por tu :support a osu!.',
            'first' => 'apoyo',
            'repeat' => 'continuo apoyo',
        ],
    ],

    'forum_new_reply' => [
        'new' => 'Para informarte, ha habido una nueva respuesta en ":title" desde tu última visita.',
        'subject' => '[osu!] Nueva respuesta para el tema ":title"',
        'unwatch' => 'Si no deseas seguir viendo este tema, puedes hacer clic en el enlace "Cancelar suscripción al tema" que se encuentra en la parte inferior del tema de arriba, o desde la página de gestión de suscripciones al tema:',
        'visit' => 'Salte directamente a la última respuesta usando el siguiente enlace:',
    ],

    'password_reset' => [
        'code' => 'Su código de verificación es:',
        'requested' => 'Tú o alguien que se hace pasar por ti ha solicitado que se restablezca la contraseña de tu cuenta de osu!.',
        'subject' => 'Recuperación de tu cuenta de osu!',
    ],

    'store_payment_completed' => [
        'prepare_shipping' => 'Hemos recibido su pago y estamos preparando su orden para el envío. Puede tardar unos días en enviarse, dependiendo de la cantidad de pedidos. Puede seguir el progreso de su orden aquí, incluyendo los detalles de seguimiento cuando estén disponibles:',
        'processing' => 'Hemos recibido su pago y estamos procesando su orden. Puede seguir el progreso de su orden aquí:',
        'questions' => "Si tienes alguna pregunta, no dudes en responder a este correo electrónico.",
        'shipping' => 'Envío',
        'subject' => '¡Hemos recibido tu orden de la osu!store!',
        'thank_you' => '¡Gracias por tu orden de la osu!store!',
        'total' => 'Total',
    ],

    'supporter_gift' => [
        'anonymous_gift' => 'La persona que le regaló este tag puede optar por permanecer en el anonimato, por lo que no se ha mencionado en esta notificación.',
        'anonymous_gift_maybe_not' => 'Pero es probable que ya sepas quién es ;).',
        'duration' => 'Gracias a esa persona, usted tiene acceso a osu!direct y a otros beneficios de osu!supporter durante :duration.',
        'features' => 'Puede encontrar más detalles sobre estas características aquí:',
        'gifted' => '¡Alguien te acaba de regalar un tag de osu!supporter!',
        'subject' => '¡Te han regalado un tag de osu!supporter!',
    ],

    'user_email_updated' => [
        'changed_to' => 'Este es un correo electrónico de confirmación para informarle que su dirección de correo electrónico de osu! ha sido cambiada a: ":email".',
        'check' => 'Por favor, asegúrese de que ha recibido este correo electrónico en su nueva dirección para evitar perder el acceso a su cuenta de osu! en el futuro.',
        'sent' => 'Por razones de seguridad, este correo electrónico ha sido enviado tanto a su nueva como a su antigua dirección de correo electrónico.',
        'subject' => 'Confirmación de cambio de correo electrónico de osu!',
    ],

    'user_force_reactivation' => [
        'main' => 'Se sospecha que su cuenta ha sido comprometida, tiene actividad sospechosa reciente o una contraseña MUY débil. Como resultado, requerimos que establezca una nueva contraseña. Asegúrese de elegir una contraseña SEGURA.',
        'perform_reset' => 'Puede realizar el restablecimiento desde :url',
        'reason' => 'Razón:',
        'subject' => 'Reactivación de cuenta osu! requerida',
    ],

    'user_password_updated' => [
        'confirmation' => 'Esto es sólo una confirmación de que su contraseña de osu! ha sido cambiada.',
        'subject' => 'Confirmación de cambio de contraseña de osu!',
    ],

    'user_verification' => [
        'code' => 'Su código de verificación es:',
        'code_hint' => 'Puedes ingresar el código con o sin espacios.',
        'link' => 'Alternativamente, también puedes visitar el siguiente enlace para finalizar la verificación:',
        'report' => 'Si no ha solicitado esto, por favor RESPONDA INMEDIATAMENTE ya que su cuenta puede estar en peligro.',
        'subject' => 'Verificación de la cuenta de osu!',

        'action_from' => [
            '_' => 'Actividad en tu cuenta detectada desde :country requiere verificación.',
            'unknown_country' => 'país desconocido',
        ],
    ],
];
