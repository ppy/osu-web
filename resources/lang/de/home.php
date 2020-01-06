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
    'landing' => [
        'download' => 'Jetzt herunterladen',
        'online' => 'aktuell <strong>:players</strong> online in <strong>:games</strong> Spielen',
        'peak' => 'Maximum, :count Benutzer online',
        'players' => '<strong>:count</strong> registrierte Spieler',
        'title' => 'Willkommen',
        'see_more_news' => 'mehr Neuigkeiten anzeigen',

        'slogan' => [
            'main' => 'das besteste free-to-play rhythmusspiel',
            'sub' => 'der rhythmus ist nur einen klick entfernt',
        ],
    ],

    'search' => [
        'advanced_link' => 'Erweiterte Suche',
        'button' => 'Suchen',
        'empty_result' => 'Nichts gefunden!',
        'keyword_required' => 'Ein Suchbegriff ist erforderlich',
        'placeholder' => 'Zum Suchen Text eingeben',
        'title' => 'Suchergebnisse',

        'beatmapset' => [
            'more' => ':count weitere gefundene Beatmaps',
            'more_simple' => 'Mehr gefundene Beatmaps anzeigen',
            'title' => 'Beatmaps',
        ],

        'forum_post' => [
            'all' => 'Alle Foren',
            'link' => 'Das Forum durchsuchen',
            'more_simple' => 'Mehr gefundene Forenbeiträge anzeigen',
            'title' => 'Forum',

            'label' => [
                'forum' => 'in Foren suchen',
                'forum_children' => 'Subforen einbeziehen',
                'topic_id' => 'Thread #',
                'username' => 'autor',
            ],
        ],

        'mode' => [
            'all' => 'alle',
            'beatmapset' => 'Beatmap',
            'forum_post' => 'forum',
            'user' => 'spieler',
            'wiki_page' => 'wiki',
        ],

        'user' => [
            'more' => ':count weitere gefundene Spieler',
            'more_simple' => 'Mehr gefundene Spieler anzeigen',
            'more_hidden' => 'Die Spielersuche ist auf :max Spieler limitiert. Verfeinere bitte deine Suchanfrage.',
            'title' => 'Spieler',
        ],

        'wiki_page' => [
            'link' => 'Das Wiki durchsuchen',
            'more_simple' => 'Mehr gefundene Wikieinträge anzeigen',
            'title' => 'Wiki',
        ],
    ],

    'download' => [
        'tagline' => "lass uns<br>loslegen!",
        'action' => 'osu! herunterladen',
        'os' => [
            'windows' => 'für Windows',
            'macos' => 'für macOS',
            'linux' => 'für Linux',
        ],
        'mirror' => 'mirror',
        'macos-fallback' => 'macOS benutzer',
        'steps' => [
            'register' => [
                'title' => 'erstell einen account',
                'description' => 'folge den aufforderungen beim spielstart, um dich einzuloggen oder einen account zu erstellen',
            ],
            'download' => [
                'title' => 'lade das spiel herunter',
                'description' => 'klick den knopf da oben zum herunterladen und führ die installationsdatei aus!',
            ],
            'beatmaps' => [
                'title' => 'hol\' dir Beatmaps',
                'description' => [
                    '_' => ':browse durch die enorme Bibliothek an von Nutzern erstellten Beatmaps und fang an zu spielen!',
                    'browse' => 'stöbern',
                ],
            ],
        ],
        'video-guide' => 'Videoanleitung (Englisch)',
    ],

    'user' => [
        'title' => 'Dashboard',
        'news' => [
            'title' => 'News',
            'error' => 'News konnten nicht geladen werden. Versuche, die Seite neu zu laden...?',
        ],
        'header' => [
            'stats' => [
                'friends' => 'Freunde online',
                'games' => 'Mehrspielerräume',
                'online' => 'Benutzer online',
            ],
        ],
        'beatmaps' => [
            'new' => 'Neue Ranked Beatmaps',
            'popular' => 'Beliebte Beatmaps',
            'by_user' => 'von :user',
        ],
        'buttons' => [
            'download' => 'osu! herunterladen',
            'support' => 'osu! unterstützen',
            'store' => 'osu!store',
        ],
    ],

    'support-osu' => [
        'title' => 'Wow!',
        'subtitle' => 'Dir scheint es ja richtig Spaß zu machen! :D',
        'body' => [
            'part-1' => 'Wusstest du, dass osu! ohne Werbung läuft und sich für seine Entwicklungs- und andere laufende Kosten auf die Unterstützung durch seine Spieler verlässt?',
            'part-2' => 'Wusstest du auch, dass du fürs Unterstützen eine Menge nützlicher Features wie <strong>Beatmapdownloads innerhalb des Spiels</strong> (die im Mehrspieler oder beim Zuschauen automatisch starten) erhältst?',
        ],
        'find-out-more' => 'Hier klicken, um mehr herauszufinden!',
        'download-starting' => "Oh, und keine Sorge - dein Download wurde schon für dich gestartet ;)",
    ],
];
