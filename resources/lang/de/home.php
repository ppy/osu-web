<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'landing' => [
        'download' => 'Jetzt herunterladen',
        'online' => 'aktuell <strong>:players</strong> online in <strong>:games</strong> Spielen',
        'peak' => 'Maximum, :count Benutzer online',
        'players' => '<strong>:count</strong> registrierte Spieler',
        'title' => 'willkommen',
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
            'login_required' => 'Melde Dich an, um Beatmaps zu sehen',
            'more' => ':count weitere gefundene Beatmaps',
            'more_simple' => 'Mehr gefundene Beatmaps anzeigen',
            'title' => 'Beatmaps',
        ],

        'forum_post' => [
            'all' => 'Alle Foren',
            'link' => 'Das Forum durchsuchen',
            'login_required' => 'Melde Dich an, um das Forum zu durchsuchen',
            'more_simple' => 'Mehr gefundene Forenbeiträge anzeigen',
            'title' => 'Forum',

            'label' => [
                'forum' => 'in foren suchen',
                'forum_children' => 'subforen einbeziehen',
                'topic_id' => 'Thread #',
                'username' => 'autor',
            ],
        ],

        'mode' => [
            'all' => 'alle',
            'beatmapset' => 'beatmap',
            'forum_post' => 'forum',
            'user' => 'spieler',
            'wiki_page' => 'wiki',
        ],

        'user' => [
            'login_required' => 'Melde Dich an, um Benutzer zu suchen',
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

        'help' => [
            '_' => 'wenn du probleme mit dem starten des spiels oder der registrierung deines accounts hast, :help_forum_link oder :support_button.',
            'help_forum_link' => 'schau im hilfeforum nach',
            'support_button' => 'kontaktiere den support',
        ],

        'os' => [
            'windows' => 'für Windows',
            'macos' => 'für macOS',
            'linux' => 'für Linux',
        ],
        'mirror' => 'mirror',
        'macos-fallback' => 'macOS-benutzer',
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
                'title' => 'hol\' dir beatmaps',
                'description' => [
                    '_' => ':browse durch die enorme bibliothek an von nutzern erstellten beatmaps und fang an zu spielen!',
                    'browse' => 'stöbere',
                ],
            ],
        ],
        'video-guide' => 'Videoanleitung (Englisch)',
    ],

    'user' => [
        'title' => 'dashboard',
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
