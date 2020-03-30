<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'signature' => [
        'not_match' => 'Les signatures ne correspondent pas',
    ],
    'notification_type' => 'Le notification_type n\'est pas valide :type',
    'order' => [
        'invalid' => 'La commande n\'est pas valide',
        'items' => [
            'virtual_only' => 'Le paiement par `:provider` n\'est pas disponible pour les produits physiques.',
        ],
        'status' => [
            'not_checkout' => 'Vous essayez d\'accepter le paiement d\'une commande dans un état incorrect `:state`.',
            'not_paid' => 'Tentative de remboursement du paiement pour une commande dans un état invalide `:state`.',
        ],
    ],
    'param' => [
        'invalid' => 'Le paramètre `:param` ne correspond pas',
    ],
    'paypal' => [
        'not_echeck' => 'Le paiement en attente n\'est pas un e-chèque. (:actual)',
    ],
    'purchase' => [
        'checkout' => [
            'amount' => 'Le montant payé ne correspond pas au montant attendu: :actual != :expected',
            'currency' => 'Le paiement n\'est pas en USD. (:type)',
        ],
    ],
    'order_number' => [
        'malformed' => 'L\'identifiant de transaction de commande reçu est mal-formé',
        'user_id_mismatch' => 'external_id contient le mauvais id utilisateur',
    ],
];
