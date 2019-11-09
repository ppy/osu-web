<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

return [
    'admin' => [
        'warehouse' => 'Almacén',
    ],

    'cart' => [
        'checkout' => 'Pagar',
        'more_goodies' => 'Quiero ver más productos antes de completar el pedido',
        'shipping_fees' => 'gastos de envío',
        'title' => 'Carrito de compras',
        'total' => 'total',

        'errors_no_checkout' => [
            'line_1' => 'Oh oh, ¡hay problema con tu carrito que esta impidiendo el pago!',
            'line_2' => 'Elimina o actualiza los elementos de arriba para continuar.',
        ],

        'empty' => [
            'text' => 'Tu carrito está vacío.',
            'return_link' => [
                '_' => '¡Regresa a la :link para encontrar algunos manjares!',
                'link_text' => 'lista de la tienda',
            ],
        ],
    ],

    'checkout' => [
        'cart_problems' => '¡Oh oh, hay problemas con tu carrito!',
        'cart_problems_edit' => 'Haz clic aquí para editarlo.',
        'declined' => 'El pago ha sido cancelado.',
        'delayed_shipping' => '¡Ahora mismo estamos sobresaturados de pedidos! Eres bienvenido en solicitar tu orden, pero porfavor considera que hay un **retraso adicional de 1-2 semanas** mientras nos ponemos al día con órdenes ya existentes.',
        'old_cart' => 'Tu carrito parecía estar desactualizado y fue reiniciado, por favor intenta de nuevo.',
        'pay' => 'Pagar con PayPal',

        'has_pending' => [
            '_' => 'Tienes pedidos incompletos, haga clic :link para verlos.',
            'link_text' => 'aquí',
        ],

        'pending_checkout' => [
            'line_1' => 'Un anterior pago ha sido iniciado pero no fue completado.',
            'line_2' => 'Reanuda tu pago seleccionando un método de pago.',
        ],
    ],

    'discount' => 'ahorra un :percent%',

    'invoice' => [
        'echeck_delay' => 'Como su pago fue un \'eCheck\', por favor, permita hasta 10 días extra para que el pago se reciba a través de PayPal!',
        'status' => [
            'processing' => [
                'title' => '¡Aún no se ha confirmado tu pago!',
                'line_1' => 'Si ya ha pagado, puede que nosotros aún estemos esperando para la confirmación de tu compra. ¡Por favor recarga la pagina dentro de unos minutos!',
                'line_2' => [
                    '_' => 'Si ha encontrado un problema durante la compra, :link',
                    'link_text' => 'haz clic aquí para reanudar tu pago',
                ],
            ],
        ],
    ],

    'mail' => [
        'payment_completed' => [
            'subject' => '¡Hemos recibido tu orden de la osu!store!',
        ],
    ],

    'order' => [
        'paid_on' => 'Pedido :date',

        'invoice' => 'Ver factura',
        'no_orders' => 'No hay ordenes para ver.',
        'resume' => 'Reanudar pago',

        'item' => [
            'display_name' => [
                'supporter_tag' => ':name para :username (:duration)',
            ],
            'quantity' => 'Cantidad',
        ],

        'not_modifiable_exception' => [
            'cancelled' => 'No puedes modificar tu orden porque ha sido cancelada.',
            'checkout' => 'No puedes modificar tu orden mientras está siendo procesada.', // checkout and processing should have the same message.
            'default' => 'La orden no es modificable',
            'delivered' => 'No puedes modificar tu orden porque ya ha sido entregada.',
            'paid' => 'No puedes modificar tu orden porque ya ha sido pagada.',
            'processing' => 'No puedes modificar tu orden mientras está siendo procesada.',
            'shipped' => 'No puedes modificar tu orden porque ya ha sido enviada.',
        ],

        'status' => [
            'cancelled' => 'Cancelado',
            'checkout' => 'Preparando',
            'delivered' => 'Enviado',
            'paid' => 'Pagado',
            'processing' => 'Confirmación pendiente',
            'shipped' => 'En tránsito',
        ],
    ],

    'product' => [
        'name' => 'Nombre',

        'stock' => [
            'out' => 'Este producto está actualmente agotado. ¡Vuelva más tarde!',
            'out_with_alternative' => 'Lamentablemente, este artículo esta agotado. ¡Usa el menú desplegable para elegir un tipo diferente o vuelve más tarde!',
        ],

        'add_to_cart' => 'Añadir al carrito',
        'notify' => '¡Notificarme cuando esté disponible!',

        'notification_success' => 'serás notificado cuando tengamos más existencias. Haz clic :link para cancelar',
        'notification_remove_text' => 'aquí',

        'notification_in_stock' => '¡Este producto ya tiene existencias!',
    ],

    'supporter_tag' => [
        'gift' => 'regalar al jugador',
        'require_login' => [
            '_' => '¡Necesitas ser :link para tener un osu!supporter!',
            'link_text' => 'sesión iniciada',
        ],
    ],

    'username_change' => [
        'check' => '¡Escribe un nombre de usuario para revisar disponibilidad!',
        'checking' => 'Revisando la disponibilidad de :username...',
        'require_login' => [
            '_' => '¡Tienes que :link para cambiar tu nombre de usuario!',
            'link_text' => 'seción iniciada',
        ],
    ],
];
