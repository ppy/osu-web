<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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
    'support' => [
        'header' => [
            // size in font-size
            'big_description' => 'Adoras osu!?<br/>
                                Suporta o dev do osu! :D',
            'small_description' => '',
            'support_button' => 'Eu quero ajudar o osu!',
        ],

        'dev_quote' => 'osu! é um jogo completamente grátis, mas mantê-lo é definitivamente não tão grátis.
        Entre o custo de servidores de aluguer e banda-larga internacional de alta qualidade, o tempo gasto em manutenção do sistema e da comunidade,  -----
        providing prizes for competitions, answering support questions and generally keeping people happy, osu! consumes quite a hefty amount of money!
        Oh, and don\'t forget the fact that we do it without any advertising or partnering with silly toolbars and the likes!
            <br/><br/>osu! is at the end of the day largely run by myself, to which you may know best as "peppy".
            I have had to quit my day job in order to keep up with osu!,
            and do at times struggle to maintain the standards I strive for.
            I would like to offer my personal thanks to those who have supported osu! thus far,
            and just as much to those who continue to support this amazing game and community into the future :).',

        'supporter_status' => [
            'contribution' => 'Obrigado pelo teu apoio até agora! Contribuíste para um total de :dollars sobre compras de :tags etiquetas!',
            'gifted' => ':giftedTags das tuas compras de etiquetas foram oferecidas (por um total de :giftedDollars dados), que generoso!',
            'not_yet' => "Ainda não tens uma etiqueta de suporte :(",
            'title' => 'Estado actual de apoiante',
            'valid_until' => 'A tua etiqueta actual de apoiante é válida até :date!',
            'was_valid_until' => 'A tua etiqueta de apoiante é válida até :date.',
        ],

        'why_support' => [
            'title' => 'Porque é que deveria apoiar o osu!?',
            'blocks' => [
                'dev' => 'Desenvolvido e preservado predominantemente por um tipo na Austrália',
                'time' => 'Leva muito tempo para continuar a executar, que já não é possível chamá-lo um "hobby".',
                'ads' => 'Sem qualquer publicidade. <br/><br/>
                        Ao contrário dos 99.95% da web, nós não lucramos ao atirar-te cenas na tua cara.',
                'goodies' => 'Recebes umas coisinhas boas!',
            ],
        ],

        'perks' => [
            'title' => 'Quê? O que é que eu recebo?!',
            'osu_direct' => [
                'title' => 'osu!direct',
                'description' => 'acesso rápido e fácil para procurar beatmaps sem sair do jogo.',
            ],

            'auto_downloads' => [
                'title' => 'Transferências Automáticas',
                'description' => 'Transferências automáticas ao jogar em multijogador, observar outros, ou clicar em ligações em chat!',
            ],

            'upload_more' => [
                'title' => 'Carregar Mais',
                'description' => 'Ranhuras de beatmaps pendentes adicionais (por beatmap classificado) até um máximo de 10.',
            ],

            'early_access' => [
                'title' => 'Acesso Antecipado',
                'description' => 'Acede a lançamentos antecipados, onde podes experimentar novas funcionalidades antes de elas saírem em público!',
            ],

            'customisation' => [
                'title' => 'Personalização',
                'description' => 'Personaliza o teu perfil ao adicionar uma página de utilizador totalmente personalizável.',
            ],

            'beatmap_filters' => [
                'title' => 'Filtros de Beatmap',
                'description' => 'Filtrar pesquisas de beatmaps por mapas jogados e não jogados e classificação obtida (se houver alguma).',
            ],

            'yellow_fellow' => [
                'title' => 'Companheiro Amarelo',
                'description' => 'Sê reconhecido dento do jogo com a tua nova cor de utilizador amarela brilhante no chat.',
            ],

            'speedy_downloads' => [
                'title' => 'Transferências Velozes',
                'description' => 'Mais restrições de transferências brandas, especialmente ao usar o osu!direct.',
            ],

            'change_username' => [
                'title' => 'Mudar de Nome de Utilizador',
                'description' => 'A habilidade de mudar o teu nome de utilizador sem custos adicionais. (só por uma vez)',
            ],

            'skinnables' => [
                'title' => 'Skins',
                'description' => 'Skins extra dentro do jogo, tipo o fundo do menu principal.',
            ],

            'feature_votes' => [
                'title' => 'Votos de Funcionalidades',
                'description' => 'Votos para solicitações de funcionalidades. (2 por mês)',
            ],

            'sort_options' => [
                'title' => 'Ordenar Opções',
                'description' => 'A habilidade de ver classificações nacional / amigo / mod-específico dum beatmap dentro do jogo.',
            ],

            'feel_special' => [
                'title' => 'Sente-te Especial',
                'description' => 'O sentimento quente e felpudo de fazeres a tua parte para manter o osu! a correr suavemente!',
            ],

            'more_to_come' => [
                'title' => 'Mais p\'ra vir',
                'description' => '',
            ],
        ],

        'convinced' => [
            'title' => 'Estou convencido! :D',
            'support' => 'apoia o osu!',
            'gift' => 'ou dá apoio a outros jogadores',
            'instructions' => 'clica no botão do coração para proceder à osu!store',
        ],
    ],
];
