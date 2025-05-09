<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'cart' => [
        'checkout' => 'Pagar',
        'empty_cart' => 'Eliminar todos los elementos del carrito',
        'info' => ':count_delimited elemento en el carrito ($:subtotal)|:count_delimited elementos en el carrito ($:subtotal)',
        'more_goodies' => 'Deseo revisar más productos antes de completar la orden',
        'shipping_fees' => 'gastos de envío',
        'title' => 'Carrito de compras',
        'total' => 'total',

        'errors_no_checkout' => [
            'line_1' => 'Oh, oh, ¡hay problemas con tu carrito que están impidiendo el pago!',
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
        'hide_from_activity' => 'Ocultar todas las etiquetas de osu!supporter en esta orden de mi actividad',
        'old_cart' => 'Tu carrito parecía estar desactualizado y fue reiniciado, por favor intenta de nuevo.',
        'pay' => 'Pagar con PayPal',
        'title_compact' => 'caja',

        'has_pending' => [
            '_' => 'Tienes pedidos incompletos, haz clic :link para verlos.',
            'link_text' => 'aquí',
        ],

        'pending_checkout' => [
            'line_1' => 'Un anterior pago ha sido iniciado pero no fue completado.',
            'line_2' => 'Reanuda tu pago seleccionando un método de pago.',
        ],
    ],

    'discount' => 'ahorra un :percent%',
    'free' => '¡gratis!',

    'invoice' => [
        'contact' => 'Contacto:',
        'date' => 'Fecha:',
        'echeck_delay' => 'Como tu pago fue un eCheck, ¡por favor permite hasta 10 días adicionales para que el pago se realice a través de PayPal!',
        'echeck_denied' => 'PayPal ha rechazado el pago con eCheck.',
        'hide_from_activity' => 'las etiquetas de osu!supporter en esta orden no se muestran en tus actividades recientes.',
        'sent_via' => 'Enviado vía:',
        'shipping_to' => 'Envío a:',
        'title' => 'Factura',
        'title_compact' => 'factura',

        'status' => [
            'cancelled' => [
                'title' => 'Tu pedido ha sido cancelado',
                'line_1' => [
                    '_' => "Si no has solicitado una cancelación, ponte en contacto con el :link indicando tu número de pedido (n.º :order_number).",
                    'link_text' => 'soporte de la osu!store',
                ],
            ],
            'delivered' => [
                'title' => '¡Tu pedido ha sido entregado! ¡Esperamos que lo estés disfrutando!',
                'line_1' => [
                    '_' => 'Si tienes algún problema con tu compra, ponte en contacto con el :link.',
                    'link_text' => 'soporte de la osu!store',
                ],
            ],
            'prepared' => [
                'title' => '¡Tu pedido está siendo preparado!',
                'line_1' => 'Por favor, espera un poco más para que se envíe. La información de seguimiento aparecerá aquí una vez que el pedido haya sido procesado y enviado. Esto puede tardar hasta 5 días (¡pero normalmente menos!) dependiendo de lo ocupados que estemos.',
                'line_2' => 'Enviamos todos los pedidos desde Japón usando una variedad de servicios de envío dependiendo del peso y el valor. Esta área se actualizará con detalles una vez que hayamos enviado el pedido.',
            ],
            'processing' => [
                'title' => '¡Aún no se ha confirmado tu pago!',
                'line_1' => 'Si ya has pagado, puede que aún estemos esperando la confirmación de tu pago. ¡Por favor, actualiza esta página en un minuto o dos!',
                'line_2' => [
                    '_' => 'Si has encontrado un problema durante la compra, :link',
                    'link_text' => 'haz clic aquí para reanudar tu pago',
                ],
            ],
            'shipped' => [
                'title' => '¡Tu pedido ha sido enviado!',
                'tracking_details' => 'Detalles de seguimiento:',
                'no_tracking_details' => [
                    '_' => "No tenemos detalles de seguimiento, ya que enviamos tu paquete a través de Air Mail, pero puedes esperar recibirlo en un plazo de 1-3 semanas. Para Europa, a veces las aduanas pueden retrasar el pedido fuera de nuestro control. Si tienes alguna duda, por favor responde al correo electrónico de confirmación del pedido que recibiste o :link.",
                    'link_text' => 'envíanos un correo electrónico',
                ],
            ],
        ],
    ],

    'order' => [
        'cancel' => 'Cancelar la orden',
        'cancel_confirm' => 'Esta orden será cancelada y no se aceptará el pago por ella. El proveedor de pagos podría no liberar inmediatamente los fondos reservados. ¿Estás seguro?',
        'cancel_not_allowed' => 'Esta orden no puede ser cancelada en este momento.',
        'invoice' => 'Ver factura',
        'no_orders' => 'No hay órdenes para ver.',
        'paid_on' => 'Orden realizada :date',
        'resume' => 'Reanudar pago',
        'shipping_and_handling' => 'Envío y manipulación',
        'shopify_expired' => 'El enlace de pago de esta orden ha expirado.',
        'subtotal' => 'Subtotal',
        'total' => 'Total',

        'details' => [
            'order_number' => 'Pedido n.º',
            'payment_terms' => 'Términos de pago',
            'salesperson' => 'Vendedor',
            'shipping_method' => 'Método de envío',
            'shipping_terms' => 'Términos de envío',
            'title' => 'Detalles del pedido',
        ],

        'item' => [
            'quantity' => 'Cantidad',

            'display_name' => [
                'supporter_tag' => ':name para :username (:duration)',
            ],

            'subtext' => [
                'supporter_tag' => 'Mensaje: :message',
            ],
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
            'title' => 'Estado del pedido',
        ],

        'thanks' => [
            'title' => '¡Muchas gracias por tu pedido!',
            'line_1' => [
                '_' => 'Recibirás un correo electrónico de confirmación pronto. ¡Si tienes alguna pregunta, por favor :link!',
                'link_text' => 'contáctanos',
            ],
        ],
    ],

    'product' => [
        'name' => 'Nombre',

        'stock' => [
            'out' => 'Este elemento está actualmente agotado. ¡Vuelve más tarde!',
            'out_with_alternative' => 'Desafortunadamente, este elemento está agotado. ¡Usa el menú desplegable para elegir un tipo diferente o vuelve más tarde!',
        ],

        'add_to_cart' => 'Agregar al carrito',
        'notify' => '¡Notificarme cuando esté disponible!',

        'notification_success' => 'recibirás una notificación cuando tengamos nuevas unidades. Haz clic :link para cancelar',
        'notification_remove_text' => 'aquí',

        'notification_in_stock' => '¡Este producto ya se encuentra disponible!',
    ],

    'supporter_tag' => [
        'gift' => 'regalar al jugador',
        'gift_message' => '¡añade un mensaje opcional a tu regalo! (hasta :length caracteres)',

        'require_login' => [
            '_' => '¡Tienes que tener la :link para obtener una etiqueta de osu!supporter!',
            'link_text' => 'sesión iniciada',
        ],
    ],

    'username_change' => [
        'check' => '¡Escribe un nombre de usuario para revisar su disponibilidad!',
        'checking' => 'Revisando la disponibilidad de :username...',
        'placeholder' => 'Nombre de usuario solicitado',
        'label' => 'Nuevo nombre de usuario',
        'current' => 'Tu nombre de usuario actual es «:username».',

        'require_login' => [
            '_' => '¡Tienes que tener la :link para cambiar tu nombre de usuario!',
            'link_text' => 'sesión iniciada',
        ],
    ],

    'xsolla' => [
        'distributor' => '',
    ],
];
