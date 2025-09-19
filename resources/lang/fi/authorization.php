<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'play_more' => 'Mitä jos pelaisit vähän osu!a sen sijaan?',
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
            'exhausted' => 'Olet saavuttanut päivän ehdollepanorajan, yritä uudelleen huomenna.',
            'incorrect_state' => 'Virhe toiminnon suorittamisessa, kokeile päivittää sivu.',
            'owner' => "Omaa beatmappia ei voi asettaa ehdolle.",
            'set_metadata' => 'Sinun täytyy määrittää tyylilaji ja kieli ennen ehdolle asettamista.',
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
            'not_owner' => 'Voit poistaa ainoastaan omia viestejäsi.',
            'resolved' => 'Et voi poistaa ratkaistun keskustelun viestiä.',
            'system_generated' => 'Automaattisesti luotua viestiä ei voi poistaa.',
        ],

        'edit' => [
            'not_owner' => 'Vain lähettäjä voi muokata postausta.',
            'resolved' => 'Et voi muokata ratkaistun keskustelun viestiä.',
            'system_generated' => 'Automaattisesti luotua viestiä ei voi muokata.',
        ],
    ],

    'beatmapset' => [
        'discussion_locked' => 'Tämän rytmikartan keskustelu on lukittu.',

        'metadata' => [
            'nominated' => 'Et voi muuttaa ehdolle asetetun kartan metatietoja. Ota yhteyttä BN- tai NAT-jäseneen, jos ajattelet niiden olevan virheellisiä.',
        ],
    ],

    'beatmap_tag' => [
        'store' => [
            'no_score' => 'Sinun täytyy asettaa tulos rytmikarttaan lisätäksesi tunnisteen.',
        ],
    ],

    'chat' => [
        'blocked' => 'Et voi lähettää viestejä käyttäjälle, joka on estänyt sinut tai jonka olet estänyt.',
        'friends_only' => 'Käyttäjä on estänyt viestit henkilöiltä, jotka eivät ole heidän kaverilistallaan.',
        'moderated' => 'Tätä kanavaa moderoidaan.',
        'no_access' => 'Sinulla ei ole oikeuksia tälle kanavalle.',
        'no_announce' => 'Sinulla ei ole oikeutta ilmoitusten postaamiseen.',
        'receive_friends_only' => 'Käyttäjä ei välttämättä pysty vastaamaan, koska hyväksyt viestejä vain kaverilistallasi olevilta henkilöiltä.',
        'restricted' => 'Et voi lähettää viestejä mykistettynä, rajoitettuna tai estettynä.',
        'silenced' => 'Et voi lähettää viestejä mykistettynä, rajoitettuna tai estettynä.',
    ],

    'comment' => [
        'store' => [
            'disabled' => 'Kommentit ovat poistettu käytöstä',
        ],
        'update' => [
            'deleted' => "Poistettuja postauksia ei voi muokata.",
        ],
    ],

    'contest' => [
        'judging_not_active' => 'Tuomarointi tälle kilpailulle ei ole aktiivinen.',
        'voting_over' => 'Et voi muuttaa ääntäsi tälle kilpailulle äänestysajan loppumisen jälkeen.',

        'entry' => [
            'limit_reached' => 'Olet saavuttanut kilpailuun lähetettävien töiden rajan',
            'over' => 'Kiitos lähettämistänne töistä! Töiden lähettäminen on suljettu ja äänestys avataan pian.',
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
                'not_owner' => 'Vain lähettäjä voi poistaa postauksen.',
            ],

            'edit' => [
                'deleted' => 'Poistettua postausta ei voi muokata.',
                'locked' => 'Viestin muokkaaminen on estetty.',
                'no_forum_access' => 'Tarvitset pääsyn tälle foorumille.',
                'no_permission' => 'Ei muokkausoikeuksia.',
                'not_owner' => 'Vain lähettäjä voi muokata postausta.',
                'topic_locked' => 'Lukitun aiheen viestiä ei voi muokata.',
            ],

            'store' => [
                'play_more' => 'Pyydämme, että kokeilet peliä ennen viestin lähettämistä foorumeille! Jos kohtaat ongelmia pelatessasi, lähetä viesti foorumin apu- ja tukialueelle.',
                'too_many_help_posts' => "Sinun on pelattava peliä enemmän, ennen kuin voit luoda enemmän postauksia. Jos sinulla on edelleen ongelmia pelin pelaamisen kanssa, lähetä sähköpostia osoitteeseen support@ppy.sh", // FIXME: unhardcode email address.
            ],
        ],

        'topic' => [
            'reply' => [
                'double_post' => 'Muokkaa edellistä postaustasi uuden lähettämisen sijaan.',
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
                'no_forum_access' => 'Tarvitset pääsyn tälle foorumille.',
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
                'forum_not_allowed' => 'Tämä foorumi ei hyväksy aiheen kansikuvia.',
            ],
        ],

        'view' => [
            'admin_only' => 'Vain ylläpitäjä voi nähdä tämän foorumin.',
        ],
    ],

    'room' => [
        'destroy' => [
            'not_owner' => 'Vain huoneen omistaja voi sulkea sen.',
        ],
    ],

    'score' => [
        'pin' => [
            'disabled_type' => "Ei voida kiinnittää tämäntyyppistä pisteytystä",
            'failed' => "Ei läpäistyä suoritusta ei voida kiinnittää.",
            'not_owner' => 'Vain tuloksen omistaja voi kiinnittää tuloksen.',
            'too_many' => 'Kiinnitit liian monta tulosta.',
        ],
    ],

    'team' => [
        'application' => [
            'store' => [
                'already_member' => "Olet jo osa joukkuetta.",
                'already_other_member' => "Kuulut jo toiseen joukkueseen.",
                'currently_applying' => 'Sinulla on vierillä oleva tiimiin liittymis pyyntö.',
                'team_closed' => 'Tiimi ei hyväksy tällä hetkellä liittymispyyntöjä.',
                'team_full' => "Tiimi on täynnä eikä voi hyväksyä enempää jäseniä.",
            ],
        ],
        'part' => [
            'is_leader' => "Tiimin johtaja ei pysty lähtemään tiimistä.",
            'not_member' => 'Ei ole tiimin jäsen.',
        ],
        'store' => [
            'require_supporter_tag' => 'osu!supporter tagia tarvitaan tiimin luomiseen.',
        ],
    ],

    'user' => [
        'page' => [
            'edit' => [
                'locked' => 'Käyttäjäsivu on lukittu.',
                'not_owner' => 'Voit muokata vain omaa käyttäjäsivuasi.',
                'require_supporter_tag' => 'osu!tukijamerkki vaaditaan.',
            ],
        ],
        'update_email' => [
            'locked' => 'sähköpostiosoite on lukittu',
        ],
    ],
];
