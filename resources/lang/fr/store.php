<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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
        'old_cart' => 'Votre panier semble être obsolète et il a été actualisé, merci de réesayer.',
        'pay' => 'Payer avec PayPal',
        'pending_checkout' => [
            'line_1' => 'Une commande précédente a été commencée mais non finalisée.',
            'line_2' => 'Reprenez votre commande en sélectionnant un mode de paiement, ou :link pour annuler la commande.',
            'link_text' => 'cliquez ici',
        ],
        'delayed_shipping' => 'Nous sommes surchargés de commandes, si vous commandez, merci de patienter **une à deux semaines** le temps que nous traitons toutes ces commandes.',
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
            'out' => 'Pas de stock en ce moment :(. Vérifiez plus tard.',
            'out_with_alternative' => 'Pas de stock de ce type en ce moment :(. Essayez un autre type ou revérifiez plus tard.',
        ],

        'add_to_cart' => 'Ajouter au panier',
        'notify' => 'Notifiez-moi quand c\'est disponible !',

        'notification_success' => 'vous serez notifié quand nous aurons du stock. cliquez :link pour annuler',
        'notification_remove_text' => 'ici',

        'notification_in_stock' => 'Ce produit est déjà en stock !',
    ],

    'supporter_tag' => [
        'gift' => 'offrir à un joueur',
        'require_login' => [
            '_' => 'Vous devez être un :link pour obtenir a tag supporter !',
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
