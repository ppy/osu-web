<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'admin' => [
        'warehouse' => 'Magasin',
    ],

    'cart' => [
        'checkout' => 'Acheter',
        'info' => ':count_delimited produit dans le panier ($:subtotal)|:count_delimited produits dans le panier ($:subtotal)',
        'more_goodies' => 'Je souhaite regarder d\'autres goodies avant de passer commande',
        'shipping_fees' => 'frais de livraison',
        'title' => 'Panier',
        'total' => 'total',

        'errors_no_checkout' => [
            'line_1' => 'Uh oh, des problèmes avec votre panier empêchent le paiement !',
            'line_2' => 'Supprimez ou mettez à jour les articles ci-dessus pour continuer.',
        ],

        'empty' => [
            'text' => 'Votre panier est vide.',
            'return_link' => [
                '_' => 'Retourner à :link pour trouver quelques goodies !',
                'link_text' => 'articles',
            ],
        ],
    ],

    'checkout' => [
        'cart_problems' => 'Oh oh, il y a quelques problèmes avec votre panier !',
        'cart_problems_edit' => 'Cliquez ici pour l\'éditer.',
        'declined' => 'Le paiement a été annulé.',
        'delayed_shipping' => 'Nous sommes actuellement submergés de commandes ! Vous pouvez tout de même commander, mais attendez-vous à **une à deux semaines de délai supplémentaire** le temps que nous puissions traiter toutes ces commandes.',
        'old_cart' => 'Votre panier semble être obsolète et a donc été actualisé, merci de réessayer.',
        'pay' => 'Payer avec PayPal',
        'title_compact' => 'commander',

        'has_pending' => [
            '_' => 'Vous avez un paiement en attente, cliquez sur :link pour y accéder.',
            'link_text' => 'ici',
        ],

        'pending_checkout' => [
            'line_1' => 'Une commande précédente a été commencée mais non finalisée.',
            'line_2' => 'Reprenez votre commande en sélectionnant un moyen de paiement.',
        ],
    ],

    'discount' => 'économisez :percent%',

    'invoice' => [
        'echeck_delay' => 'Si votre paiement est en eCheck, comptez jusqu\'à 10 jours supplémentaires pour le paiement via PayPal !',
        'title_compact' => 'facture',

        'status' => [
            'processing' => [
                'title' => 'Votre paiement n\'a pas encore été confirmé !',
                'line_1' => 'Si vous avez déjà payé, nous attendons toujours de recevoir une confirmation de votre paiement. Veuillez rafraîchir cette page dans une minute ou deux !',
                'line_2' => [
                    '_' => 'Si vous avez rencontré un problème lors de votre commande, :link',
                    'link_text' => 'cliquez ici pour reprendre votre commande',
                ],
            ],
        ],
    ],

    'order' => [
        'cancel' => 'Annuler la commande',
        'cancel_confirm' => 'Cette commande sera annulée et le paiement ne sera pas accepté. Le fournisseur de paiement peut ne pas libérer immédiatement les fonds réservés. Êtes-vous sûr ?',
        'cancel_not_allowed' => 'Cette commande ne peut pas être annulée pour le moment.',
        'invoice' => 'Afficher la facture',
        'no_orders' => 'Aucune commande à voir.',
        'paid_on' => 'Commande passée le :date',
        'resume' => 'Reprendre la commande',
        'shopify_expired' => 'Le lien de commande pour cette commande a expiré.',

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

        'status' => [
            'cancelled' => 'Annulée',
            'checkout' => 'Préparation',
            'delivered' => 'Livrée',
            'paid' => 'Payée',
            'processing' => 'En attente de confirmation',
            'shipped' => 'Expédié',
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
            '_' => 'Vous devez être :link pour obtenir un tag osu!supporter !',
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

    'xsolla' => [
        'distributor' => '',
    ],
];
