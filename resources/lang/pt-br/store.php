<?php
/**
 *    Copyright 2015-2016 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed in the hopes of
 *    attracting more community contributions to the core ecosystem of osu!
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
        'warehouse' => 'Depósito'
    ],
    'checkout' => [
        'pay' => 'Pague com Paypal',
        'delayed_shipping' => 'Nós estamos com muitos pedidos! Você pode fazer o seu pedido, mas espere um **atraso adicional de 1-2 semanas** enquanto processamos os pedidos já existentes.'
    ],
    'order' => [
        'item' => [
            'quantity' => 'Quantidade'
        ]
    ],
    'product' => [
        'name' => 'Nome',
        'stock' => [
            'out' => 'Atualmente fora de estoque :(. Volte em breve.',
            'out_with_alternative' => 'Esta variação está fora de estoque :(. Tente outra ou volte em breve.'
        ],
        'add_to_cart' => 'Adicionar ao carrinho',
        'notify' => 'Avise-me quando estiver disponível!',
        'notification_success' => 'você será avisado quando tivermos estoque. clique :link para cancelar',
        'notification_remove_text' => 'aqui',
        'notification_in_stock' => 'Este produto já está em estoque!',
        'notification_exists' => 'Você já pediu um aviso para este produto!',
        'notification_doesnt_exist' => 'Você ainda não pediu um aviso para este produto!'
    ]
];
