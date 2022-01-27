<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'play_more' => 'Mitä jos pelaisit vähän osu! sen sijaan?',
    'require_login' => 'Kirjaudu sisään jatkaaksesi.',
    'require_verification' => 'Vahvista jatkaaksesi.',
    'restricted' => "Et voi tehdä tätä rajoitettuna.",
    'silenced' => "Et voi tehdä tätä mykistettynä.",
    'unauthorized' => 'Pääsy evätty.',

    'beatmap_discussion' => [
        'destroy' => [
            'is_hype' => 'Hurrausta ei voi peruuttaa.',
            'has_reply' => 'Keskustelua, jossa on vastauksia, ei voi poistaa',
        ],
        'nominate' => [
            'exhausted' => 'Olet saavuttanut suosittelurajan tälle päivälle, yritä huomenna uudelleen.',
            'incorrect_state' => 'Virhe toimintoa suorittaessa, kokeile sivun päivittämistä.',
            'owner' => "Omaa beatmappia ei voi suositella.",
            'set_metadata' => '',
        ],
        'resolve' => [
            'not_owner' => 'Vain aiheen aloittaja sekä beatmapin omistaja voivat ratkaista keskustelun.',
        ],

        'store' => [
            'mapper_note_wrong_user' => 'Ainoastaan beatmapin omistaja, suosittelija tai QAT-ryhmän jäsen voi lisätä muistiinpanoja.',
        ],

        'vote' => [
            'bot' => "Et voi äänestää botin tekemässä keskustelussa",
            'limit_exceeded' => 'Odota hetki ennen uusien äänien antamista',
            'owner' => "Omia keskusteluja ei voi äänestää.",
            'wrong_beatmapset_state' => 'Voit äänestää vain vireillä olevien beatmappien keskusteluissa.',
        ],
    ],

    'beatmap_discussion_post' => [
        'destroy' => [
            'not_owner' => 'Voit poistaa vaan omia viestejä.',
            'resolved' => '',
            'system_generated' => '',
        ],

        'edit' => [
            'not_owner' => 'Vain lähettäjä voi muokata viestiä.',
            'resolved' => '',
            'system_generated' => 'Automaattisesti luotua viestiä ei voi muokata.',
        ],

        'store' => [
            'beatmapset_locked' => 'Tämä beatmap on lukittu keskustelulta.',
        ],
    ],

    'beatmapset' => [
        'metadata' => [
            'nominated' => '',
        ],
    ],

    'chat' => [
        'blocked' => 'Et voi lähettää viestejä käyttäjälle, joka on estänyt sinut tai jonka olet estänyt.',
        'friends_only' => 'Käyttäjä on estänyt viestit henkilöiltä, jotka eivät ole hänen kaverilistassaan.',
        'moderated' => 'Tätä kanavaa moderoidaan.',
        'no_access' => 'Sinulla ei ole oikeuksia tälle kanavalle.',
        'receive_friends_only' => '',
        'restricted' => 'Et voi lähettää viestejä mykistettynä, rajoitettuna tai bännättynä.',
        'silenced' => '',
    ],

    'comment' => [
        'update' => [
            'deleted' => "Poistettuja viestejä ei voi mukata.",
        ],
    ],

    'contest' => [
        'voting_over' => 'Et voi muuttaa ääntäsi tälle kilpailulle äänestysajan loppumisen jälkeen.',

        'entry' => [
            'limit_reached' => 'Olet saavuttanut kilpailuun lähetettävien töiden rajan',
            'over' => 'Kiitos lähettämistänne töistä! Kilpailuun ei oteta enää ehdokkaita ja äänestys avataan pian.',
        ],
    ],

    'forum' => [
        'moderate' => [
            'no_permission' => 'Sinulla ei ole oikeutta moderoida tätä foorumia.',
        ],

        'post' => [
            'delete' => [
                'only_last_post' => 'Vain viimeisin viesti voidaan poistaa.',
                'locked' => 'Lukitun aiheen viestejä ei voi poistaa.',
                'no_forum_access' => 'Tarvitset pääsyn tälle foorumille.',
                'not_owner' => 'Vain lähettäjä voi poistaa viestin.',
            ],

            'edit' => [
                'deleted' => 'Poistettuja viestejä ei voi muokata.',
                'locked' => 'Viestin muokkaaminen on estetty.',
                'no_forum_access' => 'Tarvitset pääsyn tälle foorumille.',
                'not_owner' => 'Vain lähettäjä voi muokata viestiä.',
                'topic_locked' => 'Lukitun aiheen viestiä ei voi muokata.',
            ],

            'store' => [
                'play_more' => 'Pyydämme, että kokeilet peliä ennen viestin lähettämistä foorumeille! Jos kohtaat ongelmia pelatessasi, lähetä viesti foorumin apu- ja tukialueelle.',
                'too_many_help_posts' => "Sinun on pelattava peliä enemmän, ennen kuin voit luoda useampia viestejä. Jos sinulla on edelleen ongelmia pelin kanssa, lähetä sähköpostia osoitteeseen support@ppy.sh", // FIXME: unhardcode email address.
            ],
        ],

        'topic' => [
            'reply' => [
                'double_post' => 'Muokkaa edellistä viestiä uuden lähettämisen sijaan.',
                'locked' => 'Et voi vastata lukittuun aiheeseen.',
                'no_forum_access' => 'Pääsy kyseiselle foorumille vaaditaan.',
                'no_permission' => 'Ei vastausoikeutta.',

                'user' => [
                    'require_login' => 'Kirjaudu sisään vastataksesi.',
                    'restricted' => "Et voi vastata rajoitettuna.",
                    'silenced' => "Et voi vastata mykistettynä.",
                ],
            ],

            'store' => [
                'no_forum_access' => 'Pääsy kyseiselle foorumille vaaditaan.',
                'no_permission' => 'Oikeudet uuden aiheen luomiseen puuttuvat.',
                'forum_closed' => 'Foorumi on suljettu, eikä siihen voi lähettää viestejä.',
            ],

            'vote' => [
                'no_forum_access' => 'Tarvitset pääsyn tälle foorumille.',
                'over' => 'Äänestys on loppunut eikä uusia ääniä voida antaa.',
                'play_more' => 'Sinun pitää pelata enemmän jotta voit äänestää foorumilla.',
                'voted' => 'Äänen vaihtaminen ei ole sallittua.',

                'user' => [
                    'require_login' => 'Kirjaudu sisään äänestääksesi.',
                    'restricted' => "Et voi äänestää rajoitettuna.",
                    'silenced' => "Et voi äänestää mykistettynä.",
                ],
            ],

            'watch' => [
                'no_forum_access' => 'Tarvitset pääsyn tälle foorumille.',
            ],
        ],

        'topic_cover' => [
            'edit' => [
                'uneditable' => 'Virheellinen kansikuva valittu.',
                'not_owner' => 'Vain omistaja voi muuttaa kansikuvaa.',
            ],
            'store' => [
                'forum_not_allowed' => '',
            ],
        ],

        'view' => [
            'admin_only' => 'Vain ylläpitäjä voi nähdä tämän foorumin.',
        ],
    ],

    'score' => [
        'pin' => [
            'not_owner' => '',
            'too_many' => '',
        ],
    ],

    'user' => [
        'page' => [
            'edit' => [
                'locked' => 'Käyttäjäsivu on lukittu.',
                'not_owner' => 'Voit muokata vain omaa käyttäjäsivuasi.',
                'require_supporter_tag' => 'Sinun on oltava Tukija.',
            ],
        ],
    ],
];
