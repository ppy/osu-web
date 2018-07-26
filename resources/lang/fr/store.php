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
    'admin' => [
        'warehouse' => 'Magasin',
    ],

    'cart' => [
        'checkout' => 'Paiement',
        'more_goodies' => 'Je souhaite regarder d\'autres goodies avant de passer commande',
        'shipping_fees' => 'frais de livraison',
        'title' => 'Panier',
        'total' => 'total',

        'errors_no_checkout' => [
            'line_1' => 'Uh oh, des problèmes avec votre panier empêchent le paiement!',
            'line_2' => 'Supprimez ou mettez à jour les articles ci-dessus pour continuer.',
        ],

        'empty' => [
            'text' => 'Votre panier est vide.',
            'return_link' => [
                '_' => 'Retourner à :link pour trouver quelques goodies!',
                'link_text' => 'articles',
            ],
        ],
    ],

    'checkout' => [
        'cart_problems' => 'Oh oh, il y a quelques problèmes avec votre panier !',
        'cart_problems_edit' => 'Cliquez ici pour l\'éditer.',
        'declined' => 'Le paiement a été annulé.',
        'old_cart' => 'Votre panier semble être obsolète et a donc été actualisé, merci de réessayer.',
        'pay' => 'Payer avec PayPal',
        'pending_checkout' => [
            'line_1' => 'Une commande précédente a été commencée mais non finalisée.',
            'line_2' => 'Reprenez votre commande en sélectionnant un mode de paiement, ou :link pour annuler la commande.',
            'link_text' => 'cliquez ici',
        ],
        'delayed_shipping' => 'Nous sommes actuellement submergés de commandes ! Vous pouvez tout de même commander, mais attendez-vous à **une à deux semaines de délai supplémentaire** le temps que nous puissions traiter toutes ces commandes.',
    ],

    'discount' => 'économisez :percent%',

    'mail' => [
        'payment_completed' => [
            'subject' => 'Nous avons bien reçu votre commande osu!store !',
        ],
    ],

    'order' => [
        'item' => [
            'display_name' => [
                'supporter_tag' => ':name pour :username (:duration)',
            ],
            'quantity' => 'Quantité',
        ],

        'not_modifiable_exception' => [
            'cancelled' => 'Vous ne pouvez pas modifier votre commande, puisqu\'elle a été annulée.',
            'checkout' => 'Vous ne pouvez pas modifier votre commande puisqu\'elle est en préparation.', // checkout and processing should have the same message.
            'default' => 'La commande n\'est pas modifiable',
            'delivered' => 'Vous ne pouvez pas modifier votre commande puisqu\'elle a été expédiée.',
            'paid' => 'Vous ne pouvez pas modifier votre commande puisqu\'elle a déjà été payée.',
            'processing' => 'Vous ne pouvez pas modifier votre commande puisqu\'elle est en préparation.',
            'shipped' => 'Vous ne pouvez pas modifier votre commande puisqu\'elle a été expédiée.',
        ],
    ],

    'product' => [
        'name' => 'Nom',

        'stock' => [
            'out' => 'Cet article est en rupture de stock pour le moment. Revenez plus tard !',
            'out_with_alternative' => 'Malheureusement cet article est en rupture de stock. Sélectionnez-en un autre à l\'aide du menu déroulant ou revenez plus tard !',
        ],

        'add_to_cart' => 'Ajouter au panier',
        'notify' => 'Prévenez-moi quand cet article sera disponible !',

        'notification_success' => 'vous serez prévenu quand cet article sera de nouveau en stock. cliquez :link pour annuler',
        'notification_remove_text' => 'ici',

        'notification_in_stock' => 'Ce produit est déjà en stock !',
    ],

    'supporter_tag' => [
        'gift' => 'offrir à un joueur',
        'require_login' => [
            '_' => 'Vous devez être :link pour obtenir un tag supporter !',
            'link_text' => 'connecté',
        ],
    ],

    'username_change' => [
        'check' => 'Entrez un nom d\'utilisateur pour vérifier sa disponibilité !',
        'checking' => 'Vérification de la disponibilité de :username...',
        'require_login' => [
            '_' => 'Vous devez être :link pour changer de nom !',
            'link_text' => 'connecté',
        ],
    ],
];
