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
    'support' => [
        'convinced' => [
            'title' => 'Estou convencido! :D',
            'support' => 'ajuda o osu!',
            'gift' => 'ou dá apoio a outros jogadores',
            'instructions' => 'clica no botão do coração para proceder à osu!store',
        ],
        'why-support' => [
            'title' => 'Porque é que deveria apoiar o osu!? Para onde vai o dinheiro?',

            'team' => [
                'title' => 'Apoiar a Equipa',
                'description' => 'Uma pequena equipa desenvolve e executa o osu!. O teu apoio ajuda-os a, tu sabes... viver.',
            ],
            'infra' => [
                'title' => 'Infraestrutura do Servidor',
                'description' => 'As contribuições vão para os servidores que correm o sítio web, serviços multijogador, tabelas de líderes online, etc.',
            ],
            'featured-artists' => [
                'title' => 'Artistas Destacados',
                'description' => 'Com o teu apoio, podemos reunir ainda mais artistas incríveis e licenciar mais músicas fixes para usar no osu!',
                'link_text' => 'Ver a lista atual &raquo;',
            ],
            'ads' => [
                'title' => 'Mantém o osu! autossustentável',
                'description' => 'As tuas contribuições ajudam a manter o jogo independente e totalmente livre de anúncios e patrocinadores externos.',
            ],
            'tournaments' => [
                'title' => 'Torneios Oficiais',
                'description' => 'Ajuda a financiar o funcionamento dos (e os prémios para os) torneios oficiais do Campeonato do Mundo osu!.',
                'link_text' => 'Explorar torneios &raquo;',
            ],
            'bounty-program' => [
                'title' => 'Programa de Reputação de Código-aberto',
                'description' => 'Apoia os colaboradores da comunidade que deram o seu tempo e esforço para ajudar a fazer o osu! melhor.',
                'link_text' => 'Descobre mais &raquo;',
            ],
        ],
        'perks' => [
            'title' => 'Quê? O que é que eu recebo?!',
            'osu_direct' => [
                'title' => 'osu!direct',
                'description' => 'acesso rápido e fácil para procurar beatmaps sem sair do jogo.',
            ],

            'friend_ranking' => [
                'title' => 'Classificação de Amigos',
                'description' => "Vê como te comparas contra os teus amigos numa tabela de classificações dum beatmap, dentro do jogo como também no sítio web.",
            ],

            'country_ranking' => [
                'title' => 'Classificação Nacional',
                'description' => 'Conquista o teu país antes de conquistar o mundo.',
            ],

            'mod_filtering' => [
                'title' => 'Filtrar por Mods',
                'description' => 'Associar apenas com pessoas que joguem HDHR? Não há problema!',
            ],

            'auto_downloads' => [
                'title' => 'Downloads Automáticos',
                'description' => 'Downloads automáticos ao jogar em multijogador, observar outros, ou clicar em links no chat!',
            ],

            'upload_more' => [
                'title' => 'Carregar Mais',
                'description' => 'Ranhuras de beatmaps pendentes adicionais (por beatmap classificado) até um máximo de 10.',
            ],

            'early_access' => [
                'title' => 'Acesso Antecipado',
                'description' => 'Ganha acesso a lançamentos antecipados, onde podes experimentar novas funcionalidades antes de elas saírem ao público!<br/><br/>Isto inclui também acesso antecipado a novas funcionalidades no sítio web!',
            ],

            'customisation' => [
                'title' => 'Personalização',
                'description' => "Personaliza o teu perfil ao adicionar uma página de utilizador totalmente personalizável.",
            ],

            'beatmap_filters' => [
                'title' => 'Filtros de Beatmap',
                'description' => 'Filtrar pesquisas de beatmaps por mapas jogados e não jogados e classificação obtida (se houver alguma).',
            ],

            'yellow_fellow' => [
                'title' => 'Companheiro Amarelo',
                'description' => 'Sê reconhecido dentro do jogo com a tua nova cor de utilizador amarela brilhante no chat.',
            ],

            'speedy_downloads' => [
                'title' => 'Downloads Velozes',
                'description' => 'Mais restrições de downloads brandos, especialmente ao usar o osu!direct.',
            ],

            'change_username' => [
                'title' => 'Mudar o Nome de Utilizador',
                'description' => 'A possibilidade de mudar o teu nome de utilizador sem custos adicionais. (só por uma vez)',
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
                'description' => 'A habilidade de ver as classificações nacional / amigo / mod-específico dum beatmap dentro do jogo.',
            ],

            'more_favourites' => [
                'title' => 'Mais Favoritos',
                'description' => 'O número máximo de beatmaps que podes pôr nos favoritos é aumentado de :normally &rarr; :supporter',
            ],
            'more_friends' => [
                'title' => 'Mais Amigos',
                'description' => 'O número máximo de amigos que podes ter é aumentado de :normally &rarr; :supporter',
            ],
            'more_beatmaps' => [
                'title' => 'Carregar Mais Beatmaps',
                'description' => 'O número máximo de beatmaps não classificados que podes possuir é calculado dum valor base mais um bónus adicional para cada beatmap classificado que atualmente possuas (até a um certo limite).<br/><br/>Normalmente é 4 mais 1 por cada beatmap classificado (até 2). Com a osu!supporter, isto aumenta para 8 mais 1 por cada beatmap classificado (até 12).',
            ],
            'friend_filtering' => [
                'title' => 'Tabela de Classificações de Amigos',
                'description' => 'Compete com os teus amigos e vê como te classificas contra eles!*<br/><br/><small>* ainda não está disponível no novo site, embreve(tm)</small>',
            ],

        ],
        'supporter_status' => [
            'contribution' => 'Obrigado pelo teu apoio até agora! Contribuíste para um total de :dollars sobre compras de :tags etiquetas!',
            'gifted' => ":giftedTags das tuas compras de etiquetas foram oferecidas (por um total de :giftedDollars oferecidos), que generoso!",
            'not_yet' => "Ainda não tens uma etiqueta de apoiante :(",
            'valid_until' => 'A tua etiqueta atual de apoiante é válida até :date!',
            'was_valid_until' => 'A tua etiqueta de apoiante é válida até :date.',
        ],
    ],
];
