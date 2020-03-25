<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'support' => [
        'convinced' => [
            'title' => 'Estou convencido! :D',
            'support' => 'ajude o osu!',
            'gift' => 'ou envie de presente para outros jogadores',
            'instructions' => 'clique no coração para continuar para a osu!store',
        ],
        'why-support' => [
            'title' => 'Por que eu deveria apoiar osu!? Para onde vai o dinheiro?',

            'team' => [
                'title' => 'Apoie a Equipe',
                'description' => 'Um pequeno time de desenvolvedores desenvolve e mantém o osu! rodando. Seu apoio vai permitir que eles possam, você sabe... viver.',
            ],
            'infra' => [
                'title' => 'Infraestrutura do Servidor',
                'description' => 'Contribuições são diretamente utilizadas para o funcionamento do website, serviços multiplayer, tabelas de classificações, etc.',
            ],
            'featured-artists' => [
                'title' => 'Artistas em Destaque',
                'description' => 'Com sua ajuda, podemos nos aproximar de ainda mais artistas talentosos e podemos licenciar ainda mais musicas incríveis para serem utilizadas no osu!',
                'link_text' => 'Veja a lista atual &raquo;',
            ],
            'ads' => [
                'title' => 'Mantenha o osu! auto-sustentável',
                'description' => 'Suas contribuições ajudam o jogo a se manter independente e completamente livre de anúncios ou de patrocinadores externos.',
            ],
            'tournaments' => [
                'title' => 'Torneios Oficiais',
                'description' => 'Ajude a financiar os torneios oficiais do osu! e suas premiações.',
                'link_text' => 'Explore os torneios &raquo;',
            ],
            'bounty-program' => [
                'title' => 'Programa de Recompensas Open Source',
                'description' => 'Apoie os contribuidores da comunidade que dedicaram seu tempo e esforço para tornar o osu! melhor.',
                'link_text' => 'Entenda mais &raquo;',
            ],
        ],
        'perks' => [
            'title' => 'Hã? O que eu ganho?!',
            'osu_direct' => [
                'title' => 'osu!direct',
                'description' => 'Acesso fácil e rápido a beatmaps sem sair do jogo.',
            ],

            'friend_ranking' => [
                'title' => 'Ranking de Amigos',
                'description' => "Veja como você se sai contra seus amigos nas classificações dos beatmaps, tanto in-game quanto pelo website.",
            ],

            'country_ranking' => [
                'title' => 'Ranking Nacional',
                'description' => 'Conquiste seu país antes de conquistar o mundo.',
            ],

            'mod_filtering' => [
                'title' => 'Filtrar por Mods',
                'description' => 'Mostrar apenas as pessoas que jogaram de HDHR? Sem problema!',
            ],

            'auto_downloads' => [
                'title' => 'Downloads Automáticos',
                'description' => 'Downloads automáticos quando jogando no multiplayer, assistindo outros jogadores ou clicando em links no chat!',
            ],

            'upload_more' => [
                'title' => 'Envie Mais',
                'description' => 'Espaços adicionais para beatmaps pendentes (por beatmap ranqueado) até um máximo de 10.',
            ],

            'early_access' => [
                'title' => 'Acesso Antecipado',
                'description' => 'Acesso a lançamentos mais cedo, onde você pode testar novas funcionalidades antes de irem ao público!',
            ],

            'customisation' => [
                'title' => 'Personalização',
                'description' => "Personalize o seu perfil adicionando uma página de usuário totalmente editável.",
            ],

            'beatmap_filters' => [
                'title' => 'Filtros de Beatmaps',
                'description' => 'Filtre buscas de beatmaps por beatmaps jogados ou não jogados e ranques alcançados (se tiver).',
            ],

            'yellow_fellow' => [
                'title' => 'Camarada Amarelo',
                'description' => 'Seja reconhecido dentro do jogo com a sua nova cor de nome de usuário amarela.',
            ],

            'speedy_downloads' => [
                'title' => 'Downloads Mais Rápidos',
                'description' => 'Restrições de download mais leves, especialmente quando usando osu!direct.',
            ],

            'change_username' => [
                'title' => 'Alteração de Nome de Usuário',
                'description' => 'A capacidade de alterar seu nome de usuário sem custos adicionais. (uma vez)',
            ],

            'skinnables' => [
                'title' => 'Customização',
                'description' => 'Maior função para skins, como a habilidade de alterar o fundo do menu principal.',
            ],

            'feature_votes' => [
                'title' => 'Votos de Recursos',
                'description' => 'Ganhe votos todo mês para votar em novas funcionalidades. (2 por mês)',
            ],

            'sort_options' => [
                'title' => 'Opções de Organização',
                'description' => 'A capacidade de ver classificações por país / amigos / mods específicos dentro do jogo.',
            ],

            'more_favourites' => [
                'title' => 'Mais Favoritos',
                'description' => 'O número máximo de beatmaps que você pode favoritar é aumentado de :normally &rarr; :supporter',
            ],
            'more_friends' => [
                'title' => 'Mais Amigos',
                'description' => 'O número máximo de amigos que pode ter é aumentado de :normally &rarr; :supporter',
            ],
            'more_beatmaps' => [
                'title' => 'Envie Mais Beatmaps',
                'description' => 'A quantidade máxima de beatmaps não-ranqueados que você pode ter é calculado com base em um valor padrão (normalmente 4) +1 adicional para cada beatmap ranqueado que você possui (max. 2).<br/><br/> Com osu!supporter, esse limite é aumentado para 8 + 1 adicional para cada beatmap ranqueado (max. 12).',
            ],
            'friend_filtering' => [
                'title' => 'Classificação de Amigos',
                'description' => 'Dispute com seus amigos e veja como se sai contra eles!* <br/><br/><small>* ainda não disponível no novo site, embreve(tm)</small>',
            ],

        ],
        'supporter_status' => [
            'contribution' => 'Obrigado pelo o seu apoio! Você contribuiu com um total de :dollars em :tags compras de tags!',
            'gifted' => ":giftedTags de suas compras de tag foram presenteadas (um total de :giftedDollars presenteados), que generoso!",
            'not_yet' => "Você ainda não tem uma supporter tag :(",
            'valid_until' => 'Sua supporter tag atual é válida até :date!',
            'was_valid_until' => 'Sua supporter tag era válida até :date.',
        ],
    ],
];
