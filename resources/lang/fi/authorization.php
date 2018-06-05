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
            'is_hype' => 'Hypetystä ei voi peruuttaa.',
            'has_reply' => 'Keskustelua, jossa on vastauksia, ei voi poistaa',
        ],
        'nominate' => [
            'exhausted' => 'Olet saavuttanut päivän ehdollepanorajan, yritä uudelleen huomenna.',
            'incorrect_state' => 'Virhe toiminnan suorittamisessa, yritä päivittää sivu.',
            'owner' => "Omaa rytmikarttaa ei voi ehdottaa.",
        ],
        'resolve' => [
            'not_owner' => 'Vain langan aloittaja ja rytmikartan omistaja voivat ratkaista keskustelun.',
        ],

        'vote' => [
            'limit_exceeded' => 'Odota hetki ennen kuin äänestät lisää',
            'owner' => "Omia keskusteluja ei voi äänestää.",
            'wrong_beatmapset_state' => 'Vain vireillä olevien rytmikarttojen keskusteluja voi äänestää.',
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
                'no_access' => 'Pääsy pyydetylle kanavalle ei ole sallittu.',
            ],
        ],
        'message' => [
            'send' => [
                'channel' => [
                    'no_access' => 'Ei lupaa päästä kohde kanavaan.',
                    'moderated' => 'Kanava on moderoitu tällä hetkellä.',
                    'not_lazer' => 'Tällä hetkellä voit puhua vain kanavalla #lazer.',
                ],

                'not_allowed' => 'Ei voi lähettää viestiä porttikiellon/rajoituksen/vaiennuksen aikana.',
            ],
        ],
    ],

    'contest' => [
        'voting_over' => 'Et voi vaihtaa ääntäsi sen jälkeen, kun tämän kilpailun äänestysaika on loppunut.',
    ],

    'forum' => [
        'post' => [
            'delete' => [
                'only_last_post' => 'Vain viimeinen viesti voidaan poistaa.',
                'locked' => 'Lukitun aiheen viestiä ei voi poistaa.',
                'no_forum_access' => 'Ei lupaa päästä pyydetylle foorumille.',
                'not_owner' => 'Vain lähettäjä voi poistaa viestin.',
            ],

            'edit' => [
                'deleted' => 'Poistettua viestiä ei voi muokata.',
                'locked' => 'Viesti on lukittu muokkaamiselta.',
                'no_forum_access' => 'Ei lupaa päästä pyydetylle foorumille.',
                'not_owner' => 'Vain lähettäjä voi muokata viestiä.',
                'topic_locked' => 'Lukitun aiheen viestiä ei voi muokata.',
            ],

            'store' => [
                'play_more' => 'Kokeile pelin pelaamista ennen viestin lähettämistä foorumeille! Jos sinulla on ongelma pelaamisen kanssa, ole ystävällinen ja luo viesti Apu ja Tuki-foorumille.',
                'too_many_help_posts' => "Sinun on pelattava peliä enemmän, ennen kuin voit luoda useampia viestejä. Jos sinulla on edelleen ongelmia pelin kanssa, lähetä sähköposti osoitteeseen support@ppy.sh", // FIXME: unhardcode email address.
            ],
        ],

        'topic' => [
            'reply' => [
                'double_post' => 'Lähetit juuri viestin. Odota hetki tai muokkaa edellistä viestiäsi.',
                'locked' => 'Et voi vastata lukittuun keskusteluun.',
                'no_forum_access' => 'Ei lupaa päästä pyydetylle foorumille.',
                'no_permission' => 'Ei oikeutta vastata.',

                'user' => [
                    'require_login' => 'Kirjaudu sisään vastataksesi.',
                    'restricted' => "Et voi vastata rajoitettuna.",
                    'silenced' => "Et voi vastata hiljennettynä.",
                ],
            ],

            'store' => [
                'no_forum_access' => 'Ei lupaa päästä pyydetylle foorumille.',
                'no_permission' => 'Uuden aiheen luontiin ei ole oikeuksia.',
                'forum_closed' => 'Foorumi on suljettu, eikä siihen voi lähettää viestejä.',
            ],

            'vote' => [
                'no_forum_access' => 'Ei lupaa päästä pyydetylle foorumille.',
                'over' => 'Äänestys on ohi eikä siinä voi enää äänestää.',
                'voted' => 'Äänen muuttamista ei ole sallittu.',

                'user' => [
                    'require_login' => 'Kirjaudu sisään äänestääksesi.',
                    'restricted' => "Et voi äänestää rajoitettuna.",
                    'silenced' => "Et voi äänestää hiljennettynä.",
                ],
            ],

            'watch' => [
                'no_forum_access' => 'Ei lupaa päästä pyydetylle foorumille.',
            ],
        ],

        'topic_cover' => [
            'edit' => [
                'uneditable' => 'Virheellinen kansi valittu.',
                'not_owner' => 'Vain omistaja voi muuttaa kantta.',
            ],
        ],

        'view' => [
            'admin_only' => 'Vain ylläpitäjä voi nähdä tämän foorumin.',
        ],
    ],

    'require_login' => 'Kirjaudu sisään jatkaaksesi.',

    'unauthorized' => 'Pääsy evätty.',

    'silenced' => "Et voi tehdä tätä vaiennettuna.",

    'restricted' => "Et voi tehdä tätä rajoitettuna.",

    'user' => [
        'page' => [
            'edit' => [
                'locked' => 'Käyttäjäsivu on lukittu.',
                'not_owner' => 'Voit muokata vain omaa käyttäjäsivuasi.',
                'require_supporter_tag' => 'Tukijatagi vaaditaan.',
            ],
        ],
    ],
];
