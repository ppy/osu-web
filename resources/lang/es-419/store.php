<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'cart' => [
        'checkout' => 'Pagar',
        'empty_cart' => 'Eliminar todos los elementos del carrito',
        'info' => ':count_delimited elemento en el carrito ($:subtotal)|:count_delimited elementos en el carrito ($:subtotal)',
        'more_goodies' => 'Quiero ver más cosas antes de completar el pedido',
        'shipping_fees' => 'gastos de envío',
        'title' => 'Carrito de compras',
        'total' => 'total',

        'errors_no_checkout' => [
            'line_1' => '¡Hay problemas con tu carrito que impiden el pago!',
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
        'cart_problems' => '¡Hay problemas con tu carrito!',
        'cart_problems_edit' => 'Haz clic aquí para editarlo.',
        'declined' => 'El pago ha sido cancelado.',
        'delayed_shipping' => '¡Ahora mismo estamos sobresaturados de pedidos! Puedes realizar tu pedido, pero tendrás que esperar entre **1 y 2 semanas más** mientras nos ponemos al día con los pedidos existentes.',
        'hide_from_activity' => 'Ocultar todas las etiquetas de osu!supporter en esta orden de mi actividad',
        'old_cart' => 'Tu carrito parecía estar desactualizado y ha sido recargado, inténtalo de nuevo.',
        'pay' => 'Pagar con PayPal',
        'title_compact' => 'caja',

        'has_pending' => [
            '_' => 'Tienes pedidos incompletos, haz clic :link para verlos.',
            'link_text' => 'aquí',
        ],

        'pending_checkout' => [
            'line_1' => 'Un pago anterior ha sido iniciado pero no fue completado.',
            'line_2' => 'Reanuda tu pago seleccionando un método de pago.',
        ],
    ],

    'discount' => 'ahorra un :percent%',
    'free' => '¡gratis!',

    'invoice' => [
        'contact' => 'Contacto:',
        'date' => 'Fecha:',
        'echeck_delay' => 'Como tu pago fue un eCheck, tendrás que esperar alrededor de 10 días más para que el pago sea procesado por PayPal.',
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
                'line_1' => 'Espera un poco más a que se realice el envío. La información de seguimiento aparecerá aquí una vez que el pedido haya sido procesado y enviado. Esto puede tardar hasta 5 días (¡pero normalmente menos!) dependiendo de lo ocupados que estemos.',
                'line_2' => 'Enviamos todos los pedidos desde Japón usando una variedad de servicios de envío dependiendo del peso y el valor. Esta área se actualizará con detalles una vez que hayamos enviado el pedido.',
            ],
            'processing' => [
                'title' => '¡Aún no se ha confirmado tu pago!',
                'line_1' => 'Si ya has pagado, puede que aún estemos esperando la confirmación de tu pago. ¡Actualiza esta página en un minuto o dos!',
                'line_2' => [
                    '_' => 'Si has tenido algún problema al realizar el pago, :link',
                    'link_text' => 'haz clic aquí para reanudar tu pago',
                ],
            ],
            'shipped' => [
                'title' => '¡Tu pedido ha sido enviado!',
                'tracking_details' => 'Detalles de seguimiento:',
                'no_tracking_details' => [
                    '_' => "No tenemos detalles de seguimiento, ya que enviamos el paquete por correo aéreo, pero puedes esperar recibirlo en un plazo de 1 a 3 semanas. Para Europa, a veces las aduanas pueden retrasar el pedido fuera de nuestro control. Si tienes alguna duda, responde al correo electrónico de confirmación del pedido que has recibido (o :link).",
                    'link_text' => 'envíanos un correo electrónico',
                ],
            ],
        ],
    ],

    'order' => [
        'cancel' => 'Cancelar el pedido',
        'cancel_confirm' => 'Este pedido será cancelado y no se aceptará el pago correspondiente. Es posible que el proveedor de pagos no libere inmediatamente los fondos reservados. ¿Estás seguro?',
        'cancel_not_allowed' => 'Este pedido no puede cancelarse en este momento.',
        'invoice' => 'Ver factura',
        'no_orders' => 'No hay pedidos para ver.',
        'paid_on' => 'Pedido realizado :date',
        'resume' => 'Reanudar pago',
        'shipping_and_handling' => 'Envío y manipulación',
        'shopify_expired' => 'El enlace de pago de este pedido ha expirado.',
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
            'cancelled' => 'No puedes modificar tu pedido porque ha sido cancelado.',
            'checkout' => 'No puedes modificar tu pedido mientras está siendo procesado.', // checkout and processing should have the same message.
            'default' => 'El pedido no se puede modificar',
            'delivered' => 'No puedes modificar tu pedido porque ya ha sido entregado.',
            'paid' => 'No puedes modificar tu pedido porque ya está pagado.',
            'processing' => 'No puedes modificar tu pedido mientras está siendo procesado.',
            'shipped' => 'No puedes modificar tu pedido porque ya ha sido enviado.',
        ],

        'status' => [
            'cancelled' => 'Cancelado',
            'checkout' => 'Preparando',
            'delivered' => 'Enviado',
            'paid' => 'Pagado',
            'processing' => 'Confirmación pendiente',
            'shipped' => 'Enviado',
            'title' => 'Estado del pedido',
        ],

        'thanks' => [
            'title' => '¡Gracias por tu pedido!',
            'line_1' => [
                '_' => 'Recibirás un correo electrónico de confirmación pronto. ¡Si tienes alguna pregunta, :link!',
                'link_text' => 'contáctanos',
            ],
        ],
    ],

    'product' => [
        'name' => 'Nombre',

        'stock' => [
            'out' => 'Este producto está actualmente agotado. ¡Vuelve más tarde!',
            'out_with_alternative' => 'Lamentablemente, este producto está agotado. ¡Utiliza el menú desplegable para elegir otro tipo o vuelve más tarde!',
        ],

        'add_to_cart' => 'Añadir al carrito',
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
