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
    'landing' => [
        'download' => 'Download nu',
        'online' => '<strong>:players</strong> momenteel online in <strong>:games</strong> games',
        'peak' => 'Piek, :count online gebruikers',
        'players' => '<strong>:count</strong> geregistreerde spelers',

        'slogan' => [
            'main' => 'de beste free-to-win rhythm game',
            'sub' => 'Ritme is slechts een *klik* verwijderd!',
        ],
    ],

    'search' => [
        'advanced_link' => 'Geavanceerd zoeken',
        'button' => 'Zoeken',
        'empty_result' => 'Niets gevonden!',
        'missing_query' => 'Zoekwoord van minimum :n tekens is vereist',
        'placeholder' => 'type om te zoeken',
        'title' => 'Zoek',

        'beatmapset' => [
            'more' => ':count andere beatmap zoekresultaten',
            'more_simple' => 'Zie meer beatmap zoekresultaten',
            'title' => 'Beatmaps',
        ],

        'forum_post' => [
            'all' => 'Alle forums',
            'link' => 'Doorzoek het forum',
            'more_simple' => 'Zie meer forum zoekresultaten',
            'title' => 'Forum',

            'label' => [
                'forum' => 'zoek in forums',
                'forum_children' => 'tel subforums mee',
                'topic_id' => 'onderwerp #',
                'username' => 'auteur',
            ],
        ],

        'mode' => [
            'all' => 'alle',
            'beatmapset' => 'beatmap',
            'forum_post' => 'forum',
            'user' => 'speler',
            'wiki_page' => 'wiki',
        ],

        'user' => [
            'more' => ':count meer speler zoekresultaten',
            'more_simple' => 'Zie meer speler zoekresultaten',
            'more_hidden' => 'Speler zoekopdracht is beperkt tot :max spelers. Probeer je zoekopdracht te verfijnen.',
            'title' => 'Spelers',
        ],

        'wiki_page' => [
            'link' => 'Doorzoek de wiki',
            'more_simple' => 'Zie meer wiki zoekresultaten',
            'title' => 'Wiki',
        ],
    ],

    'download' => [
        'tagline' => "laten we<br>beginnen!",
        'action' => 'Download osu!',
        'os' => [
            'windows' => 'voor Windows',
            'macos' => 'voor macOS',
            'linux' => 'voor Linux',
        ],
        'mirror' => 'mirror',
        'macos-fallback' => 'macOS gebruikers',
        'steps' => [
            'register' => [
                'title' => 'maak een account',
                'description' => 'volg de aanwijzingen bij het starten van het spel om in te loggen of een nieuw account te maken',
            ],
            'download' => [
                'title' => 'download de game',
                'description' => 'klik de knop hierboven om de installer te downloaden, en voer het dan uit!',
            ],
            'beatmaps' => [
                'title' => 'download beatmaps',
                'description' => [
                    '_' => ':browse de enorme bibliotheek van door gebruikers-gemaakte beatmaps en begin the spelen!',
                    'browse' => 'doorblader',
                ],
            ],
        ],
        'video-guide' => 'video gids',
    ],

    'user' => [
        'title' => 'dashboard',
        'news' => [
            'title' => 'Nieuws',
            'error' => 'Fout tijdens laden van nieuws, probeer de pagina te verversen?...',
        ],
        'header' => [
            'welcome' => 'Hallo, <strong>:username</strong>!',
            'messages' => 'Je hebt :count nieuw bericht|Je hebt :count nieuwe berichten',
            'stats' => [
                'friends' => 'Online Vrienden',
                'games' => 'Games',
                'online' => 'Online Gebruikers',
            ],
        ],
        'beatmaps' => [
            'new' => 'Nieuwe Gerankte Beatmappen',
            'popular' => 'Populaire Beatmaps',
            'by' => 'door',
            'plays' => ':count keren gespeeld',
        ],
        'buttons' => [
            'download' => 'Download osu!',
            'support' => 'Support osu!',
            'store' => 'osu!store',
        ],
    ],

    'support-osu' => [
        'title' => 'Wow!',
        'subtitle' => 'Jij lijkt plezier te hebben! :D',
        'body' => [
            'part-1' => 'Wist je dat osu! geen advertenties toont, en afhangt van spelers voor de ontwikkelings- en onderhoudskosten?',
            'part-2' => 'Wist je dat je door osu! te helpen ook een hoop handige features krijgt, waaronder <strong>in-game downloads</strong> die automatisch starten tijdens spectator en multiplayer games?',
        ],
        'find-out-more' => 'Klik hier voor meer!',
        'download-starting' => "Oh, en maak je geen zorgen - je download is al gestart :)",
    ],
];
