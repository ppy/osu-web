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
        'new' => 'Só avisando que houve uma nova atualização no beatmap ":title" desde a sua última visita.',
        'subject' => 'Nova atualização no beatmap ":title"',
        'unwatch' => 'Se você não deseja mais ser notificado sobre este beatmap, você pode ou clicar no link "Deixar de observar" encontrado na página acima, ou na página de assinaturas de moding:',
        'visit' => 'Visite a página de discussão aqui:',
    ],

    'common' => [
        'closing' => 'Cordialmente,',
        'hello' => 'Olá, :user,',
        'report' => 'Por favor responda a este e-mail IMEDIATAMENTE se você não solicitou essa alteração.',
    ],

    'forum_new_reply' => [
        'new' => 'Só informando que houve uma nova resposta em ":title" desde a sua última visita.',
        'subject' => '[osu!] Nova resposta no tópico ":title"',
        'unwatch' => 'Se você não deseja mais ser notificado sobre este tópico, você pode clicar no link "Cancelar Inscrição" encontrado na parte inferior do tópico acima, ou da página de gerenciamento de inscrições de fórum:',
        'visit' => 'Ir direto para a resposta mais recente usando o seguinte link:',
    ],

    'password_reset' => [
        'code' => 'Seu código de verificação é:',
        'requested' => 'Você ou alguém fingindo ser você solicitou uma redefinição de senha em sua conta do osu!.',
        'subject' => 'Recuperação da conta do osu!',
    ],

    'store_payment_completed' => [
        'prepare_shipping' => 'Recebemos o seu pagamento e estamos preparando seu pedido para o envio. Podemos demorar alguns dias para enviar, dependendo da quantidade de encomendas. Você pode acompanhar o progresso do seu pedido aqui, incluindo detalhes de rastreamento quando disponível:',
        'processing' => 'Recebemos o seu pagamento e estamos atualmente processando seu pedido. Você pode acompanhar o progresso do seu pedido aqui:',
        'questions' => "Se tiver alguma dúvida, não hesite em responder a este email.",
        'shipping' => 'Envio',
        'subject' => 'Recebemos o seu pedido da osu!store!',
        'thank_you' => 'Obrigado pelo sua compra no osu!store!',
        'total' => 'Total',
    ],

    'supporter_gift' => [
        'anonymous_gift' => 'A pessoa que o presenteou com esta tag pode optar por permanecer anônima, então ela não foi mencionada nesta notificação.',
        'anonymous_gift_maybe_not' => 'Mas você provavelmente já sabe quem é ;).',
        'duration' => 'Graças a ele(a), você tem acesso ao osu!direct e outros benefícios de osu!supporter por :duration.',
        'features' => 'Você pode saber mais detalhes sobre estes recursos aqui:',
        'gifted' => 'Alguém acabou de te presentear uma tag do osu!supporter!',
        'subject' => 'Você foi presenteado com uma osu!supporter tag!',
    ],

    'user_email_updated' => [
        'changed_to' => 'Este é um email de confirmação para informar que seu endereço de e-mail foi alterado para: ":email".',
        'check' => 'Por favor certifique-se de ter recebido este email no seu novo endereço para evitar perder o acesso à sua conta do osu! futuramente.',
        'sent' => 'Por motivos de segurança, este email foi enviado para o seu endereço de email novo e antigo.',
        'subject' => 'Confirmação de mudança de email do osu!',
    ],

    'user_force_reactivation' => [
        'main' => 'A sua conta é suspeita de ter sido comprometida, tem atividade suspeita recente ou uma MUITO fraca. Como resultado, precisamos que você defina uma nova senha. Por favor, certifique-se de escolher uma senha SEGURA.',
        'perform_reset' => 'Você pode executar o reset a partir de :url',
        'reason' => 'Motivo:',
        'subject' => 'osu! Reativação de conta necessária',
    ],

    'user_password_updated' => [
        'confirmation' => 'Esta é apenas uma confirmação de que sua senha do osu! foi alterada.',
        'subject' => 'Confirmação de mudança de senha do osu!',
    ],

    'user_verification' => [
        'code' => 'Seu código de verificação é:',
        'code_hint' => 'Você pode inserir o código com ou sem espaços.',
        'link' => 'Como alternativa, você também pode visitar este link abaixo para concluir a verificação:',
        'report' => 'Se você não pediu isso, por favor RESPONDA IMMEDIATAMENTE pois sua conta pode estar em perigo.',
        'subject' => 'Verificação de Conta osu!',

        'action_from' => [
            '_' => 'Uma ação executada na sua conta de :country requer verificação.',
            'unknown_country' => 'país desconhecido',
        ],
    ],
];
