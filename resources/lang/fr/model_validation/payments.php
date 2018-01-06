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
    'signature' => [
        'not_match' => 'Les signatures ne correspondent pas',
    ],
    'notification_type' => "notification_type n'est pas valid :type",
    'order' => [
        'invalid' => "La commande n'est pas valde",
        'items' => [
            'virtual_only' => "Le payement via `:provider` n'est pas valide pour les objets physiques.",
        ],
        'status' => [
            'not_checkout' => "Tentative d'accepter un payement pour une commande dans un état invalide `:state`.",
            'not_paid' => 'Tentative de rembourser un payement pour une commande dans un état invalide `:state`.',
        ],
    ],
    'param' => [
        'invalid' => 'Le paramètre `:param` ne correspond pas',
    ],
    'paypal' => [
        'not_echeck' => "Le payement en attente n'est pas un echeck. (:actual)",
    ],
    'purchase' => [
        'checkout' => [
            'amount' => 'Le montant du payement ne correspond pas: :actual != :expected',
            'currency' => "Le payement n'est pas en USD. (:type)",
        ],
    ],
    'order_number' => [
        'malformed' => "l'ID de la transaction de la commande est marlformé",
        'user_id_mismatch' => "external_id contient un ID d'utilisateur invalide",
    ],
];
