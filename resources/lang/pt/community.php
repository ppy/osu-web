<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'support' => [
        'convinced' => [
            'title' => 'Convencido! :D',
            'support' => 'apoie o osu!',
            'gift' => 'ou ofereça o "supporter" a outros jogadores',
            'instructions' => 'clique no botão do coração para proceder à osu!store',
        ],
        'why-support' => [
            'title' => 'Porque é que deveria apoiar o osu!? Para onde vai o dinheiro?',

            'team' => [
                'title' => 'Apoiar a equipa',
                'description' => 'Uma pequena equipa desenvolve e mantém o osu!. O seu apoio ajuda-os a, sabe... viver.',
            ],
            'infra' => [
                'title' => 'Infraestrutura do servidor',
                'description' => 'As contribuições vão para os servidores que executam a página, serviços multijogadores, classificações online, etc.',
            ],
            'featured-artists' => [
                'title' => 'Artistas destacados',
                'description' => 'Com o seu apoio, podemos contactar ainda mais artistas incríveis e licenciar mais músicas fantásticas para usar no osu!!',
                'link_text' => 'Ver a equipa atual &raquo;',
            ],
            'ads' => [
                'title' => 'Mantenha o osu! autossustentável',
                'description' => 'As suas contribuições ajudam a manter o jogo independente e totalmente livre de anúncios e patrocinadores externos.',
            ],
            'tournaments' => [
                'title' => 'Torneios oficiais',
                'description' => 'Ajude a financiar a realização (e os prémios) dos torneios oficiais do Campeonato do Mundo de osu!.',
                'link_text' => 'Explorar torneios &raquo;',
            ],
            'bounty-program' => [
                'title' => 'Programa de reputação de código aberto',
                'description' => 'Apoie os contribuidores da comunidade que dedicaram o seu tempo e esforço para ajudar a tornar o osu! melhor.',
                'link_text' => 'Descubra mais &raquo;',
            ],
        ],
        'perks' => [
            'title' => 'Fixe! Que benefícios é que recebo?',
            'osu_direct' => [
                'title' => 'osu!direct',
                'description' => 'Ganhe acesso rápido e fácil ao procurar e descarregar mapas sem ter de sair do jogo.',
            ],

            'friend_ranking' => [
                'title' => 'Classificação de amigos',
                'description' => "Veja como se compara contra os seus amigos numa tabela de classificações do mapa, no jogo como também na página.",
            ],

            'country_ranking' => [
                'title' => 'Classificação nacional',
                'description' => 'Conquiste o seu país antes de conquistar o mundo.',
            ],

            'mod_filtering' => [
                'title' => 'Filtrar por modificações',
                'description' => 'Associar‑se apenas a pessoas que jogam com HDHR? Sem problema!',
            ],

            'auto_downloads' => [
                'title' => 'Transferências automáticas',
                'description' => 'Os mapas serão transferidos automaticamente em jogos multijogador, ao assistir outros jogadores ou ao clicar em ligações relevantes na conversa!',
            ],

            'upload_more' => [
                'title' => 'Carregar mais',
                'description' => 'Espaços adicionais de mapas pendentes (por mapa classificado), até um máximo de 10.',
            ],

            'early_access' => [
                'title' => 'Acesso antecipado',
                'description' => 'Obtenha acesso antecipado a novas versões com funcionalidades inéditas antes de serem públicas!<br/><br/>Isto inclui também acesso antecipado a novas funcionalidades na página!',
            ],

            'customisation' => [
                'title' => 'Personalização',
                'description' => "Destaque‑se o carregar uma imagem de capa personalizada, criar uma secção “sobre mim” totalmente personalizável ou até alterar a cor do seu perfil para a que preferir.",
            ],

            'beatmap_filters' => [
                'title' => 'Filtros de mapa',
                'description' => 'Filtra as pesquisas de mapas por mapas jogados e não jogados, ou pela classificação alcançada.',
            ],

            'yellow_fellow' => [
                'title' => 'Companheiro amarelo',
                'description' => 'Seja reconhecido no jogo com a sua nova cor amarela brilhante no nome de utilizador na conversa.',
            ],

            'speedy_downloads' => [
                'title' => 'Transferências Velozes',
                'description' => 'Restrições de transferência mais permissivas, especialmente ao utilizar o osu!direct.',
            ],

            'change_username' => [
                'title' => 'Mudar o nome de utilizador',
                'description' => 'Uma alteração de nome gratuita está incluída na sua primeira compra de apoiante.',
            ],

            'skinnables' => [
                'title' => 'Elementos adicionais de visuais',
                'description' => 'Visuais adicionais no jogo, como o fundo do menu principal.',
            ],

            'feature_votes' => [
                'title' => 'Votos de funcionalidades',
                'description' => 'Votos para solicitações de funcionalidades. (2 por mês)',
            ],

            'sort_options' => [
                'title' => 'Ordenar Opções',
                'description' => 'A possibilidade de ver classificações específicas por país, amigos ou modificações diretamente no jogo.',
            ],

            'more_favourites' => [
                'title' => 'Mais favoritos',
                'description' => 'O número máximo de mapas que pode adicionar aos favoritos aumentou de :normally &rarr; :supporter',
            ],
            'more_friends' => [
                'title' => 'Mais amigos',
                'description' => 'O número máximo de amigos que pode ter aumentou de :normally &rarr; :supporter',
            ],
            'more_beatmaps' => [
                'title' => 'Carregar mais mapas',
                'description' => 'O número de mapas pendentes que pode ter ao mesmo tempo é calculado a partir de um valor base, mais um bónus adicional por cada mapa classificado que tenha (até um limite).<br/><br/>Normalmente, este valor é :base mais :bonus por mapa classificado (até :bonus_max). Com o supporter, aumenta para :supporter_base mais :supporter_bonus por mapa classificado (até :supporter_bonus_max).',
            ],
            'friend_filtering' => [
                'title' => 'Classificações de amigos',
                'description' => 'Compita com os seus amigos e veja como se classifica contra eles!',
            ],

        ],
        'supporter_status' => [
            'contribution_with_duration' => 'Obrigado pelo seu apoio contínuo! Até agora, contribuiu um total de :dollars, o que lhe garantiu a etiqueta de "Apoiador" por :duration.',
            'not_yet' => "Nunca teve uma etiqueta de osu!supporter :(",
            'valid_until' => 'A sua etiqueta de osu!supporter é válida até :date!',
            'was_valid_until' => 'A sua etiqueta de osu!supporter foi válida até :date.',

            'gifted' => [
                '_' => 'Das suas contribuições totais, ofereceu etiquetas no valor de :dollars a :users, cobrindo :duration. Isso é incrivelmente generoso!',
                'users' => ':count_delimited outro utilizador|:count_delimited outros utilizadores',
            ],
        ],
    ],
];
