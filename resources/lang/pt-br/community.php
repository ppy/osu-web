<?php

/**
 *    Copyright 2015 ppy Pty. Ltd.
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
    'support' => [
        'header' => [
            // size in font-size
            'big_description' => 'Ama osu!?<br/>
                                Ajude o desenvolvedor do osu! :D',
            'small_description' => '',
            'support_button' => 'Quero ajudar o osu!',
        ],

        'dev_quote' => 'O osu! é um jogo totalmente free-to-play, mas mantê-lo definitivamente não é de graça. Dentre o custo de alugar servidores e banda internacional de alta qualidade, o tempo gasto mantendo o sistema e a comunidade, disponibilizar prêmios para torneios, responder perguntas no suporte e de maneira geral manter pessoas felizes, o osu! acaba custando bastante dinheiro! Ah, e não se esqueça de que fazemos tudo isso sem qualquer tipo de anúncios ou contratos com barras de ferramentas e tudo mais!
            <br/><br/>O osu! é no fim das contas principalmente desenvolvido por mim, que você pode conhecer por "peppy".
            Tive que deixar meu trabalho normal para manter o osu!,
            e às vezes é difícil manter os padrões ao qual desejo ter.
            Gostaria de agradecer pessoalmente a todos que ajudaram o osu! até agora,
            e também à aqueles que continuarem a ajudar esse jogo e comunidade maravilhosas no futuro :).',

        'why_support' => [
            'title' => 'Por que devo ajudar o osu!?',
            'blocks' => [
                'dev' => 'Desenvolvido e mantido principalmente por um cara na Austrália',
                'time' => 'Leva tanto tempo para manter que não é mais possível considerar apenas um "hobby".',
                'ads' => 'Sem anúncios em lugar algum. <br/><br/>
                        Diferente de 99.95% da internet, nós não ganhamos dinheiro jogando coisas na sua cara.',
                'goodies' => 'Você ganha algumas outras coisas!',
            ],
        ],

        'perks' => [
            'title' => 'Hã? O que eu ganho?!',
            'osu_direct' => [
                'title' => 'osu!direct',
                'description' => 'acesso fácil e rápido a beatmaps dentro do jogo.',
            ],

            'auto_downloads' => [
                'title' => 'Downloads Automáticos',
                'description' => 'Downloads automáticos quando no multiplayer, assistindo outros ou clicando em links no chat!',
            ],

            'upload_more' => [
                'title' => 'Envie Mais',
                'description' => 'Slots adicionais para beatmaps pendentes (por beatmap rankeado) até um máximo de 10.',
            ],

            'early_access' => [
                'title' => 'Acesso Anteciado',
                'description' => 'Acesso a lançamentos mais cedo, onde você pode testar novas funcionalidades antes de irem ao público!',
            ],

            'customisation' => [
                'title' => 'Customização',
                'description' => 'Customize seu perfil adicionando uma página de usuário totalmente editável.',
            ],

            'beatmap_filters' => [
                'title' => 'Filtros de Beatmaps',
                'description' => 'Filtre pesquisas de beatmaps por mapas jogados ou não jogados e ranks alcançados (se tiver).',
            ],

            'yellow_fellow' => [
                'title' => 'Camarada Amarelo',
                'description' => 'Seja reconhecido dentro do jogo com sua nova cor de username amarela.',
            ],

            'speedy_downloads' => [
                'title' => 'Downloads mais Rápidos',
                'description' => 'Restrições de download mais leves, especialmente quando usando osu!direct.',
            ],

            'change_username' => [
                'title' => 'Troque de Username',
                'description' => 'A capacidade de mudar seu username sem custos adicionais (uma vez)',
            ],

            'skinnables' => [
                'title' => 'Skinnables',
                'description' => 'Maior função para skins, como a habilidade de alterar o fundo do menu principal.',
            ],

            'feature_votes' => [
                'title' => 'Votos de Funções',
                'description' => 'Votos para pedidos de funções. (2 por mês)',
            ],

            'sort_options' => [
                'title' => 'Opções de Organização',
                'description' => 'NOVO: A capacidade de ver rankings de país / amigos / certos mods dentro do jogo.',
            ],

            'feel_special' => [
                'title' => 'Sinta-se Especial',
                'description' => 'Aquela sensação quentinha e gostosa por ter feito sua parte em manter o osu! rodando tranquilo!',
            ],

            'more_to_come' => [
                'title' => 'Mais por vir',
                'description' => '',
            ],
        ],

        'convinced' => [
            'title' => 'Estou convencido! :D',
            'support' => 'ajude o osu!',
            'gift' => 'ou mande como presente para outros jogadores',
            'instructions' => 'clique no coração para continuar para a osu!store',
        ],
    ],
    'slack' => [
        'header' => [
            'small' => 'osu!dev',
            'large' => 'Acesso ao osu!public Slack',
        ],

        'disabled' => 'The public slack community is temporarily unavailable. If you wish to reach out, please create an issue on the appropriate <a href="https://github.com/ppy">github repository</a> or contact us at <a href="mailto::mail">:mail</a>.',

        'guest-begin' => 'Você precisar estar ',
        'guest-middle' => 'logado',
        'guest-end' => ' para receber um convite do Slack!',

        'receive-invite' => 'Você pode receber um convite para o Slack público do osu! aqui.',
        'bullet-points' => 'Favor ler atentamente as condições <a href=":link">neste post.</a><br />Qualquer infração na sua conta não será tolerada.',

        'recent-issues' => 'Sua conta tem problemas recentes. <a href="mailto::mail">Fale com o suporte</a> para mais detalhes.',
        'agree-button' => 'Concordar',

        'accepted' => 'Seu pedido foi aceito. Você deve receber um email em instantes.',
        'invite-already-accepted' => 'Você já tem uma conta do Slack! Se você tiver problemas, <a href="mailto::mail">fale com o suporte.</a>',
    ],
];
