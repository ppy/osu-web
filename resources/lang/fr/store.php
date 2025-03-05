<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'cart' => [
        'checkout' => 'Paiement',
        'empty_cart' => 'Supprimer tous les articles du panier',
        'info' => ':count_delimited article dans le panier ($:subtotal)|:count_delimited articles dans le panier ($:subtotal)',
        'more_goodies' => 'Je souhaite chercher d\'autres articles avant de passer commande',
        'shipping_fees' => 'frais de livraison',
        'title' => 'Panier',
        'total' => 'total',

        'errors_no_checkout' => [
            'line_1' => 'Il semblerait que des problèmes avec votre panier empêchent le paiement !',
            'line_2' => 'Supprimez ou mettez à jour les articles ci-dessus pour continuer.',
        ],

        'empty' => [
            'text' => 'Votre panier est vide.',
            'return_link' => [
                '_' => 'Retournez à la page :link pour trouver quelques articles !',
                'link_text' => 'articles',
            ],
        ],
    ],

    'checkout' => [
        'cart_problems' => 'On dirait qu\'il y a quelques problèmes avec votre panier !',
        'cart_problems_edit' => 'Cliquez ici pour l\'éditer.',
        'declined' => 'Le paiement a été annulé.',
        'delayed_shipping' => 'Nous sommes actuellement submergés de commandes ! Vous pouvez tout de même commander, mais attendez-vous à **une à deux semaines de délai supplémentaire** le temps que nous puissions traiter toutes ces commandes.',
        'hide_from_activity' => 'Masquer tous les tags osu!supporter de mon activité dans cette commande',
        'old_cart' => 'Votre panier semble être obsolète et a donc été actualisé, merci de réessayer.',
        'pay' => 'Payer avec PayPal',
        'title_compact' => 'commander',

        'has_pending' => [
            '_' => 'Vous avez des paiements en attente, cliquez sur :link pour y accéder.',
            'link_text' => 'ici',
        ],

        'pending_checkout' => [
            'line_1' => 'Une commande précédente a été commencée mais non finalisée.',
            'line_2' => 'Reprenez votre commande en sélectionnant un moyen de paiement.',
        ],
    ],

    'discount' => 'économisez :percent%',
    'free' => 'gratuit !',

    'invoice' => [
        'contact' => 'Contact :',
        'date' => 'Date :',
        'echeck_delay' => 'Votre paiement était en eCheck, veuillez alors prévoir jusqu\'à 10 jours supplémentaires pour que le paiement soit effectué via PayPal !',
        'echeck_denied' => 'Le paiement eCheck a été rejeté par PayPal.',
        'hide_from_activity' => 'Les tags osu!supporter achetés dans cette commande ne sont pas affichés dans vos activités récentes.',
        'sent_via' => 'Envoyé via :',
        'shipping_to' => 'Expédition à :',
        'title' => 'Facture',
        'title_compact' => 'facture',

        'status' => [
            'cancelled' => [
                'title' => 'Votre commande a été annulée',
                'line_1' => [
                    '_' => "Si vous n'avez pas demandé d'annulation, veuillez contacter le :link en citant votre numéro de commande (#:order_number).",
                    'link_text' => 'support de l\'osu!store',
                ],
            ],
            'delivered' => [
                'title' => 'Votre commande a été livrée ! Nous espérons que vous l\'appréciez !',
                'line_1' => [
                    '_' => 'Si vous avez un problème avec votre achat, veuillez contacter le :link.',
                    'link_text' => 'support de l\'osu!store',
                ],
            ],
            'prepared' => [
                'title' => 'Votre commande est en cours de préparation !',
                'line_1' => 'Veuillez patienter un peu plus longtemps avant que la commande ne soit expédiée. Les informations de suivi apparaîtront ici une fois que la commande aura été traitée et envoyée. Cela peut prendre jusqu\'à 5 jours (mais généralement moins !) en fonction de nos disponibilités.',
                'line_2' => 'Nous envoyons toutes les commandes depuis le Japon en utilisant divers services d\'expédition en fonction du poids et de la valeur. Cette section sera mise à jour une fois que nous aurons expédié la commande.',
            ],
            'processing' => [
                'title' => 'Votre paiement n\'a pas encore été confirmé !',
                'line_1' => 'Si vous avez déjà payé, il se pourrait que nous attendions toujours de recevoir une confirmation de votre paiement. Veuillez rafraîchir cette page dans une minute ou deux !',
                'line_2' => [
                    '_' => 'Si vous avez rencontré un problème lors de votre commande, :link',
                    'link_text' => 'cliquez ici pour reprendre votre commande',
                ],
            ],
            'shipped' => [
                'title' => 'Votre commande a été expédiée !',
                'tracking_details' => 'Détails de suivi :',
                'no_tracking_details' => [
                    '_' => "Nous n'avons pas d'informations de suivi puisque nous avons envoyé votre colis par Air Mail, mais vous pouvez vous attendre à le recevoir dans un délai de 1 à 3 semaines. En Europe, les douanes peuvent parfois retarder la commande. Si vous avez des inquiétudes, veuillez répondre à l'e-mail de confirmation de commande que vous avez reçu (sinon, :link).",
                    'link_text' => 'envoyez-nous un e-mail',
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
        'paid_on' => 'Commande passée :date',
        'resume' => 'Reprendre la commande',
        'shipping_and_handling' => 'Expédition et traitement',
        'shopify_expired' => 'Le lien pour cette commande a expiré.',
        'subtotal' => 'Sous-total',
        'total' => 'Total',

        'details' => [
            'order_number' => 'Commande #',
            'payment_terms' => 'Conditions de paiement',
            'salesperson' => 'Vendeur',
            'shipping_method' => 'Mode de livraison',
            'shipping_terms' => 'Conditions d\'expédition',
            'title' => 'Détails de la commande',
        ],

        'item' => [
            'quantity' => 'quantité',

            'display_name' => [
                'supporter_tag' => ':name pour :username (:duration)',
            ],

            'subtext' => [
                'supporter_tag' => 'Message : :message',
            ],
        ],

        'not_modifiable_exception' => [
            'cancelled' => 'Vous ne pouvez pas modifier votre commande : elle a été annulée.',
            'checkout' => 'Vous ne pouvez pas modifier votre commande lorsqu\'elle est en préparation.', // checkout and processing should have the same message.
            'default' => 'Cette commande n\'est pas modifiable',
            'delivered' => 'Vous ne pouvez pas modifier votre commande : elle a déjà été expédiée.',
            'paid' => 'Vous ne pouvez pas modifier votre commande : elle a déjà été payée.',
            'processing' => 'Vous ne pouvez pas modifier votre commande lorsqu\'elle est en préparation.',
            'shipped' => 'Vous ne pouvez pas modifier votre commande : elle a déjà été expédiée. ',
        ],

        'status' => [
            'cancelled' => 'Annulée',
            'checkout' => 'Préparation',
            'delivered' => 'Expédiée',
            'paid' => 'Payée',
            'processing' => 'En attente de confirmation',
            'shipped' => 'Expédié',
            'title' => 'État de votre commande',
        ],

        'thanks' => [
            'title' => 'Merci pour votre commande !',
            'line_1' => [
                '_' => 'Vous recevrez bientôt un e-mail de confirmation. Si vous avez des questions, veuillez :link !',
                'link_text' => 'nous contacter',
            ],
        ],
    ],

    'product' => [
        'name' => 'Nom',

        'stock' => [
            'out' => 'Cet article est en rupture de stock pour le moment. Revenez plus tard !',
            'out_with_alternative' => 'Malheureusement, cet article est en rupture de stock. Sélectionnez-en un autre à l\'aide du menu déroulant ou revenez plus tard !',
        ],

        'add_to_cart' => 'Ajouter au panier',
        'notify' => 'Prévenez-moi quand cet article sera disponible !',

        'notification_success' => 'vous serez prévenu quand cet article sera de nouveau en stock. cliquez :link pour annuler',
        'notification_remove_text' => 'ici',

        'notification_in_stock' => 'Ce produit est déjà en stock !',
    ],

    'supporter_tag' => [
        'gift' => 'offrir à un joueur',
        'gift_message' => 'ajoutez un message optionnel à votre cadeau ! (jusqu\'à :length caractères)',

        'require_login' => [
            '_' => 'Vous devez être :link pour obtenir un tag osu!supporter !',
            'link_text' => 'connecté',
        ],
    ],

    'username_change' => [
        'check' => 'Entrez un nom d\'utilisateur pour vérifier sa disponibilité !',
        'checking' => 'Vérification de la disponibilité de :username...',
        'placeholder' => 'Nom d\'utilisateur demandé',
        'label' => 'Nouveau nom d\'utilisateur',
        'current' => 'Votre nom d\'utilisateur actuel est «:username».',

        'require_login' => [
            '_' => 'Vous devez être :link pour changer de nom !',
            'link_text' => 'connecté',
        ],
    ],

    'xsolla' => [
        'distributor' => '',
    ],
];
