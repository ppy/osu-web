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
    'beatmap_discussion' => [
        'destroy' => [
            'is_hype' => 'Hurrausta ei voi peruuttaa.',
            'has_reply' => 'Keskustelua, jossa on vastauksia, ei voi poistaa',
        ],
        'nominate' => [
            'exhausted' => 'Olet saavuttanut suosittelurajan tälle päivälle, yritä huomenna uudelleen.',
            'incorrect_state' => 'Virhe toiminnon suorittamisessa, kokeile päivittää sivu.',
            'owner' => "Omaa beatmappia ei voi suositella.",
        ],
        'resolve' => [
            'not_owner' => 'Vain aiheen aloittaja sekä beatmapin omistaja voivat ratkaista keskustelun.',
        ],

        'store' => [
            'mapper_note_wrong_user' => '',
        ],

        'vote' => [
            'limit_exceeded' => 'Odota hetki ennen uusien äänien antamista',
            'owner' => "Omia keskusteluja ei voi äänestää.",
            'wrong_beatmapset_state' => 'Voit äänestää vain vireillä olevien beatmappien keskusteluissa.',
        ],
    ],

    'beatmap_discussion_post' => [
        'edit' => [
            'system_generated' => 'Automaattisesti luotua viestiä ei voi muokata.',
            'not_owner' => 'Vain lähettäjä voi muokata viestiä.',
        ],
    ],

    'chat' => [
        'channel' => [
            'read' => [
                'no_access' => 'Pääsy kohdekanavalle ei ole sallittu.',
            ],
        ],
        'message' => [
            'send' => [
                'channel' => [
                    'no_access' => 'Pääsy kohdekanavaan vaaditaan.',
                    'moderated' => 'Kanava on tällä hetkellä valvotussa tilassa.',
                    'not_lazer' => 'Voit puhua toistaiseksi vain #lazer kanavalla.',
                ],

                'not_allowed' => 'Viestiä ei voi lähettää porttikiellossa, rajoitetussa tilassa tai mykistettynä.',
            ],
        ],
    ],

    'contest' => [
        'voting_over' => 'Et voi muuttaa ääntäsi tälle kilpailulle äänestysajan loppumisen jälkeen.',
    ],

    'forum' => [
        'post' => [
            'delete' => [
                'only_last_post' => 'Vain viimeinen viesti voidaan poistaa.',
                'locked' => 'Lukitun aiheen viestejä ei voi poistaa.',
                'no_forum_access' => 'Pääsy kyseiselle foorumille vaaditaan.',
                'not_owner' => 'Vain lähettäjä voi poistaa viestin.',
            ],

            'edit' => [
                'deleted' => 'Poistettua viestiä ei voi muokata.',
                'locked' => 'Viestin muokkaaminen on estetty.',
                'no_forum_access' => 'Pääsy kyseiselle foorumille vaaditaan.',
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
                'double_post' => 'Muokkaa entistä postaustasi sen sijaan kun postaat uuden.',
                'locked' => 'Et voi vastata lukittuun aiheeseen.',
                'no_forum_access' => 'Pääsy kyseiselle foorumille vaaditaan.',
                'no_permission' => 'Ei oikeutta vastata.',

                'user' => [
                    'require_login' => 'Kirjaudu sisään vastataksesi.',
                    'restricted' => "Et voi vastata rajoitettuna.",
                    'silenced' => "Et voi vastata mykistettynä.",
                ],
            ],

            'store' => [
                'no_forum_access' => 'Pääsy kyseiselle foorumille vaaditaan.',
                'no_permission' => 'Uuden aiheen luontiin ei ole oikeuksia.',
                'forum_closed' => 'Foorumi on suljettu, eikä siihen voi lähettää viestejä.',
            ],

            'vote' => [
                'no_forum_access' => 'Pääsy kyseiselle foorumille vaaditaan.',
                'over' => 'Äänestys on ohi eikä siinä voi enää äänestää.',
                'voted' => 'Äänen muuttamista ei ole sallittu.',

                'user' => [
                    'require_login' => 'Kirjaudu sisään äänestääksesi.',
                    'restricted' => "Et voi äänestää rajoitettuna.",
                    'silenced' => "Et voi äänestää mykistettynä.",
                ],
            ],

            'watch' => [
                'no_forum_access' => 'Pääsy kyseiselle foorumille vaaditaan.',
            ],
        ],

        'topic_cover' => [
            'edit' => [
                'uneditable' => 'Virheellinen kansikuva valittu.',
                'not_owner' => 'Vain omistaja voi muuttaa kansikuvaa.',
            ],
        ],

        'view' => [
            'admin_only' => 'Vain ylläpitäjä voi nähdä tämän foorumin.',
        ],
    ],

    'require_login' => 'Kirjaudu sisään jatkaaksesi.',

    'unauthorized' => 'Pääsy evätty.',

    'silenced' => "Et voi tehdä tätä mykistettynä.",

    'restricted' => "Et voi tehdä tätä rajoitettuna.",

    'user' => [
        'page' => [
            'edit' => [
                'locked' => 'Käyttäjäsivu on lukittu.',
                'not_owner' => 'Voit muokata vain omaa käyttäjäsivuasi.',
                'require_supporter_tag' => 'osu!tukija tägi tarvitaan.',
            ],
        ],
    ],
];
