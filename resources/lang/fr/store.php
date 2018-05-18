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

    'checkout' => [
        'cart_problems' => 'Uh oh, il y a des problèmes avec votre panier !',
        'cart_problems_edit' => 'Cliquez ici pour l\'éditer.',
        'declined' => 'Le paiement a été annulé.',
        'error' => 'Il y a eu un problème lors de votre commande :(',
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
            'subject' => 'Nous avons reçu votre commande osu!store !',
        ],
    ],

    'order' => [
        'item' => [
            'display_name' => [
                'supporter_tag' => ':name pour :username (:duration)',
            ],
            'quantity' => 'Quantité',
        ],
    ],

    'product' => [
        'name' => 'Nom',

        'stock' => [
            'out' => 'Cet article est en rupture de stock pour le moment :(. Revenez plus tard.',
            'out_with_alternative' => 'Malheureusement cet article est en rupture de stock.. Sélectionnez-en un autre à l\'aide du menu déroulant ou revenez plus tard.',
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
            '_' => 'Vous devez être :link pour changer votre nom !',
            'link_text' => 'connecté',
        ],
    ],
];
