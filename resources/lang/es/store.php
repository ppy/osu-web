<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'admin' => [
        'warehouse' => 'Almacén',
    ],

    'cart' => [
        'checkout' => 'Pagar',
        'info' => ':count_delimited producto en el carrito ($:subtotal)|:count_delimited productos en el carrito ($:subtotal)',
        'more_goodies' => 'Deseo revisar más productos antes de completar la orden',
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
                '_' => '¡Regresa al :link para encontrar algunos productos!',
                'link_text' => 'listado de la tienda',
            ],
        ],
    ],

    'checkout' => [
        'cart_problems' => '¡Oh oh, hay problemas con tu carrito!',
        'cart_problems_edit' => 'Haz clic aquí para editarlo.',
        'declined' => 'El pago ha sido cancelado.',
        'delayed_shipping' => '¡Ahora mismo estamos sobresaturados de pedidos! Eres bienvenido a solicitar tu orden, pero considera un **retraso adicional de 1-2 semanas** mientras nos ponemos al día con órdenes ya existentes.',
        'old_cart' => 'Tu carrito parecía estar desactualizado y fue reiniciado, por favor intenta de nuevo.',
        'pay' => 'Pagar con PayPal',
        'title_compact' => 'caja',

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
        'echeck_delay' => 'Como su pago fue un eCheck, ¡por favor permita hasta 10 días adicionales para que el pago se realice a través de PayPal!',
        'title_compact' => 'factura',

        'status' => [
            'processing' => [
                'title' => '¡Aún no se ha confirmado tu pago!',
                'line_1' => 'Si ya ha pagado, puede que aún estemos esperando la confirmación de su pago. ¡Por favor, actualice esta página en un minuto o dos!',
                'line_2' => [
                    '_' => 'Si ha encontrado un problema durante la compra, :link',
                    'link_text' => 'haz clic aquí para reanudar tu pago',
                ],
            ],
        ],
    ],

    'order' => [
        'cancel' => 'Cancelar la orden',
        'cancel_confirm' => 'Esta orden será cancelada y no se aceptará el pago por ella. El proveedor de pagos podría no liberar inmediatamente los fondos reservados. ¿Está seguro?',
        'cancel_not_allowed' => 'Esta orden no puede ser cancelada en este momento.',
        'invoice' => 'Ver factura',
        'no_orders' => 'No hay órdenes para ver.',
        'paid_on' => 'Orden realizada :date',
        'resume' => 'Reanudar pago',
        'shopify_expired' => 'El enlace de pago de esta orden ha expirado.',

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
            'cancelled' => 'Cancelada',
            'checkout' => 'Preparando',
            'delivered' => 'Enviada',
            'paid' => 'Pagada',
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
            '_' => '¡Tienes que :link para obtener un tag de osu!supporter!',
            'link_text' => 'iniciar sesión',
        ],
    ],

    'username_change' => [
        'check' => '¡Escriba un nombre de usuario para revisar su disponibilidad!',
        'checking' => 'Revisando la disponibilidad de :username...',
        'require_login' => [
            '_' => '¡Tienes que :link para cambiar tu nombre de usuario!',
            'link_text' => 'iniciar sesión',
        ],
    ],

    'xsolla' => [
        'distributor' => '',
    ],
];
