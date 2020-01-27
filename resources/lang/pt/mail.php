<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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
    'beatmapset_update_notice' => [
        'new' => 'Só para te avisar que houve uma nova atualização no beatmap ":title" desde a tua última visita.',
        'subject' => 'Há uma nova atualização para o beatmap ":title"',
        'unwatch' => 'Se não desejares seguir mais este beatmap, podes clicar no link "Deixar de seguir" localizado na página acima ou a partir da página da lista de observação de modding:',
        'visit' => 'Visita a página de discussão aqui:',
    ],

    'common' => [
        'closing' => 'Cumprimentos,',
        'hello' => 'Olá :user,',
        'report' => 'Por favor responde a este email IMEDIATAMENTE se não pediste esta alteração.',
    ],

    'forum_new_reply' => [
        'new' => 'Só para te avisar que houve uma nova resposta em ":title" desde a tua última visita.',
        'subject' => '[osu!] Há uma nova resposta ao tópico ":title"',
        'unwatch' => 'Se não desejares seguir mais este tópico, podes clicar no link "Anular subscrição do tópico" localizado no fundo do tópico acima ou a partir da página de gestão de subscrições a tópicos:',
        'visit' => 'Salta diretamente para a última resposta usando o seguinte link:',
    ],

    'password_reset' => [
        'code' => 'O teu código de verificação é:',
        'requested' => 'Tu ou alguém a fingir que és tu solicitou um reinício da palavra-passe na tua conta osu!.',
        'subject' => 'Recuperação da conta osu!',
    ],

    'store_payment_completed' => [
        'prepare_shipping' => 'Recebemos o teu pagamento e estamos a processar o teu pedido para ser enviado. Poderá demorar alguns dias da nossa parte para o enviá-lo, dependendo da quantidade de pedidos. Podes seguir o progresso do teu pedido aqui, incluindo os detalhes de seguimento onde disponível:',
        'processing' => 'Recebemos o teu pagamento e estamos a processar o teu pedido para ser enviado. Podes seguir o progresso da tua encomenda aqui:',
        'questions' => "Se tiveres alguma questão, não hesites em responder a este email.",
        'shipping' => 'Envio',
        'subject' => 'Recebemos o teu pedido da osu!store!',
        'thank_you' => 'Obrigado pelo teu pedido da osu!store!',
        'total' => 'Total',
    ],

    'supporter_gift' => [
        'anonymous_gift' => 'A pessoa que te ofereceu esta etiqueta poderá optar em permanecer anónima, por isso é que ela não foi mencionada nesta notificação.',
        'anonymous_gift_maybe_not' => 'Mas tu já deves saber quem é ;)',
        'duration' => 'Graças a essa pessoa, tens acesso ao osu!direct e a outros benefícios de osu!supporter por :duration.',
        'features' => 'Poderás encontrar mais detalhes nestas funcionalidades aqui:',
        'gifted' => 'Alguém acabou de te oferecer uma etiqueta osu!supporter!',
        'subject' => 'Ofereceram-te uma etiqueta osu!supporter!',
    ],

    'user_email_updated' => [
        'changed_to' => 'Isto é um email de confirmação para te informar que o teu endereço de email do osu! foi alterado para: ":email".',
        'check' => 'Por favor assegura-te de que recebeste este email no teu novo endereço para prevenir a perda de acesso à tua conta osu! no futuro.',
        'sent' => 'Por motivos de segurança, este email foi enviado para o teu endereço de email novo e antigo.',
        'subject' => 'Confirmação da alteração de email da tua conta osu!',
    ],

    'user_force_reactivation' => [
        'main' => 'A tua conta está suspeita de ter sido comprometida, possui uma atividade recente suspeita ou uma palavra-passe MUITO fraca. Como resultado, precisamos que definas uma nova passe. Assegura-te de escolher uma palavra-passe SEGURA por favor.',
        'perform_reset' => 'Podes efetuar o reinício a partir de :url',
        'reason' => 'Motivo:',
        'subject' => 'Uma reativação da conta osu! é necessária',
    ],

    'user_password_updated' => [
        'confirmation' => 'Isto é apenas uma confirmação de que a tua palavra-passe do osu! foi alterada.',
        'subject' => 'Confirmação da alteração da passe da tua conta osu!',
    ],

    'user_verification' => [
        'code' => 'O teu código de verificação é:',
        'code_hint' => 'Podes inserir o código com ou sem espaços.',
        'link' => 'Como alternativa, também podes visitar este link abaixo para concluir a verificação:',
        'report' => 'Se não pediste isto, por favor RESPONDE IMEDIATAMENTE porque a tua conta pode estar em perigo.',
        'subject' => 'verificação da tua conta osu!',

        'action_from' => [
            '_' => 'Uma ação desempenhada na tua conta de :country requer verificação.',
            'unknown_country' => 'país desconhecido',
        ],
    ],
];
