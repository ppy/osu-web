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
        'unwatch' => 'Si ya no quieres ver este beatmap, puedes hacer clic en en enlace "Dejar de ver" que se encuentra en la página de arriba, o desde la página de lista de seguimiento de modificaciones:',
        'visit' => 'Visita la página de debate aquí:',
    ],

    'common' => [
        'closing' => 'Atentamente,',
        'hello' => 'Hola :user,',
        'report' => 'Por favor responde a este correo INMEDIATAMENTE si no solicitaste este cambio.',
    ],

    'donation_thanks' => [
        'benefit_more' => '¡Además, con el tiempo aparecerán nuevos beneficios para supporter!',
        'feedback' => "Si tienes alguna pregunta o comentarios, no dudes en responder a este correo; ¡Te responderé lo antes posible!",
        'keep_free' => 'Es gracias a gente como tú que osu! es capaz de mantener el juego y la comunidad corriendo bien sin ningún anuncio ni pago forzado.',
        'keep_running' => '¡Tu apoyo mantiene a osu! corriendo por alrededor de :minutes! Puede que no parezca mucho, pero todo suma :).',
        'subject' => 'Gracias, osu! te <3',

        'benefit' => [
            'gift' => '',
            'self' => '',
        ],

        'support' => [
            '_' => 'Gracias por tu :support a osu!.',
            'first' => 'soporte',
            'repeat' => 'soporte continuo',
        ],
    ],

    'forum_new_reply' => [
        'new' => '',
        'subject' => '[osu!] Nueva respuesta para el tema ":title"',
        'unwatch' => '',
        'visit' => '',
    ],

    'password_reset' => [
        'code' => 'Tu código de verificación es:',
        'requested' => '',
        'subject' => 'Recuperación de tu cuenta de osu!',
    ],

    'store_payment_completed' => [
        'prepare_shipping' => '',
        'processing' => '',
        'questions' => "",
        'shipping' => 'Envío',
        'subject' => '¡Hemos recibido tu orden de la osu!store!',
        'thank_you' => 'Gracias por tu pediedo de osu!store!',
        'total' => 'Total',
    ],

    'supporter_gift' => [
        'anonymous_gift' => '',
        'anonymous_gift_maybe_not' => '',
        'duration' => '',
        'features' => 'Puedes hallar más detalles acerca de estas características aquí:',
        'gifted' => 'Alguien te acaba de regalar una osu!supporter tag!',
        'subject' => '¡Te han regalado osu!supporter!',
    ],

    'user_email_updated' => [
        'changed_to' => 'Este correo de confirmación es para informarte que tu cuenta de correo electrónico ha sido cambiada a: ":email".',
        'check' => '',
        'sent' => '',
        'subject' => 'Confirmación de cambio de correo electrónico de osu!',
    ],

    'user_force_reactivation' => [
        'main' => 'Tenemos razones para creer que tu cuenta ha sido comprometida, se ha visto envuelta en activdades sospechosa, o posee una contraseña MUY débil. Es por esto que requerimos que establezcas una nueva contraseña. Por favor asegurate de elegir una contraseña SEGURA.',
        'perform_reset' => 'Puedes realizar un reinicio desde este enlace: :url',
        'reason' => 'Razón:',
        'subject' => 'Reactivación de cuenta osu! requerida',
    ],

    'user_password_updated' => [
        'confirmation' => 'Esta es una confirmación de que tu clave de osu! ha sido cambiada.',
        'subject' => 'Confirmación de cambio de contraseña de osu!',
    ],

    'user_verification' => [
        'code' => 'Tu código de verifiación es:',
        'code_hint' => 'Puedes ingresar el código con o sin espacios.',
        'link' => 'Alternativamente, también puedes visitar el enlace adjunto para finalizar la verificación:',
        'report' => 'Si no solicitaste esto, por favor RESPONDE INMEDIATAMENTE. Tu cuenta podría estar en peligro!',
        'subject' => 'Verificación de la cuenta de osu!',

        'action_from' => [
            '_' => 'Actividad en tu cuenta detectada desde :country requiere verificación.',
            'unknown_country' => 'país desconocido',
        ],
    ],
];
