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
            'is_hype' => 'Nadšení nelze vrátit zpět.',
            'has_reply' => 'Nelze odstranit diskusi s odpověďmi',
        ],
        'nominate' => [
            'exhausted' => 'Dosáhl jsi dnešního limitu nominací, zkus to prosím zítra.',
            'incorrect_state' => 'Nastala chyba při provádění akce, zkuste stránku obnovit.',
            'owner' => "Nelze nominovat vlastní beatmapu.",
        ],
        'resolve' => [
            'not_owner' => 'Pouze zakladatel tématu a vlastník beatmapy může označit diskusi za vyřešenou.',
        ],

        'vote' => [
            'limit_exceeded' => 'Chvíli počkej, než budeš zasílat další hlasy',
            'owner' => "Ve vlastní diskusi nemůžeš hlasovat.",
            'wrong_beatmapset_state' => 'Hlasovat lze pouze v diskusích čekajících beatmap.',
        ],
    ],

    'beatmap_discussion_post' => [
        'edit' => [
            'system_generated' => 'Automaticky generovaný příspěvek nelze upravovat.',
            'not_owner' => 'Pouze odesílatel může příspěvek spravovat.',
        ],
    ],

    'chat' => [
        'channel' => [
            'read' => [
                'no_access' => 'Přístup k požadovanému kanálu není povolen.',
            ],
        ],
        'message' => [
            'send' => [
                'channel' => [
                    'no_access' => 'Je požadován přístup k vybranému kanálu.',
                    'moderated' => 'Kanál je v současné době moderován.',
                    'not_lazer' => 'V tuto chvíli můžete mluvit pouze v #lazer.',
                ],

                'not_allowed' => 'Nelze odesílat zprávy při banu/omezení/umlčení.',
            ],
        ],
    ],

    'contest' => [
        'voting_over' => 'Po skončení doby hlasování pro tuto soutěž, již nemůžeš změnit svůj hlas.',
    ],

    'forum' => [
        'post' => [
            'delete' => [
                'only_last_post' => 'Lze odstranit pouze poslední příspěvek.',
                'locked' => 'Nelze odstranit příspěvek pro uzamčené téma.',
                'no_forum_access' => 'K vybranému fóru je požadován přístup.',
                'not_owner' => 'Pouze odesílatel může odstranit příspěvek.',
            ],

            'edit' => [
                'deleted' => 'Odstraněný příspěvek nelze upravovat.',
                'locked' => 'Příspěvek je uzamčen od upravování.',
                'no_forum_access' => 'K vybranému fóru je požadován přístup.',
                'not_owner' => 'Pouze odesílatel může příspěvek upravit.',
                'topic_locked' => 'Nelze upravit příspěvek pro uzamčené téma.',
            ],

            'store' => [
                'play_more' => 'Předtím než přidáte příspěvek na fórech zkuste si hru zahrát prosím! Pokud máte problém s hraním, prosím zeptejte se na fóru nápověda a podpora.',
                'too_many_help_posts' => "Aby jsi mohl psát další příspěvky, musíš víc hrát hru. Jestli stále máš potíže při hraní, napiš na email support@ppy.sh", // FIXME: unhardcode email address.
            ],
        ],

        'topic' => [
            'reply' => [
                'double_post' => 'Právě jste napsali příspěvek. Chvíli počkejte nebo upravte poslední příspěvek.',
                'locked' => 'Na uzamčené vlákno nelze odpovědět.',
                'no_forum_access' => 'K vybranému fóru je požadován přístup.',
                'no_permission' => 'Nemáte oprávnění odpovědět.',

                'user' => [
                    'require_login' => 'Prosím přihlaste se, abyste mohl odpovědět.',
                    'restricted' => "Nelze odpovědět když jste omezeni.",
                    'silenced' => "Nelze odpovědět když jste umlčeni.",
                ],
            ],

            'store' => [
                'no_forum_access' => 'K vybranému fóru je požadován přístup.',
                'no_permission' => 'Bez oprávnění k vytvoření nového téma.',
                'forum_closed' => 'Fórum je uzavřen a další příspěvky se už nesmí přidávat.',
            ],

            'vote' => [
                'no_forum_access' => 'K vybranému fóru je požadován přístup.',
                'over' => 'Hlasování je ukončeno a už nelze hlasovat.',
                'voted' => 'Změnit hlas není povoleno.',

                'user' => [
                    'require_login' => 'Pro hlasování se prosím přihlašte.',
                    'restricted' => "Nelze hlasovat když jste omezeni.",
                    'silenced' => "Nelze hlasovat když jste umlčeni.",
                ],
            ],

            'watch' => [
                'no_forum_access' => 'K vybranému fóru je požadován přístup.',
            ],
        ],

        'topic_cover' => [
            'edit' => [
                'uneditable' => 'Neplatný obal.',
                'not_owner' => 'Pouze majitel může upravovat obal.',
            ],
        ],

        'view' => [
            'admin_only' => 'Pouze admin může zobrazit tohle fórum.',
        ],
    ],

    'require_login' => 'Pro pokračování se prosím přihlašte.',

    'unauthorized' => 'Přístup odepřen.',

    'silenced' => "Nelze provést když jste umlčeni.",

    'restricted' => "Nelze provést když jste omezeni.",

    'user' => [
        'page' => [
            'edit' => [
                'locked' => 'Uživatelská stránka je uzamčena.',
                'not_owner' => 'Můžete upravit pouze svou vlastní uživatelskou stránku.',
                'require_supporter_tag' => 'Supporter tag je vyžadován.',
            ],
        ],
    ],
];
