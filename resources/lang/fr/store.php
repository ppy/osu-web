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
        'pay' => 'Payer avec PayPal',
        'delayed_shipping' => 'Nous sommes surchargés de commandes, si vous commandez, merci de patienter **une à deux semaines** le temps que nous traitons toutes ces commandes.',
    ],

    'discount' => 'économisez :percent%',

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
        'notify' => "Notifiez-moi quand c'est disponible !",

        'notification_success' => 'vous serez notifié quand nous aurons du stock. cliquez :link pour annuler',
        'notification_remove_text' => 'ici',

        'notification_in_stock' => 'Ce produit est déjà en stock !',
    ],

    'supporter_tag' => [
        'require_login' => [
            '_' => 'Vous devez être un :link pour obtenir a tag supporter !',
            'link_text' => 'connecté',
        ],
    ],
    'username_change' => [
        'require_login' => [
            '_' => 'Vous devez être :link pour changer votre nom !',
            'link_text' => 'connecté',
        ],
    ],
];
