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
            'has_reply' => 'Nelze odstranit diskuzi s odpověďmi',
        ],
        'nominate' => [
            'exhausted' => 'Dosáhl jsi dnešního limitu nominací, zkus to prosím zítra.',
            'incorrect_state' => 'Nastala chyba při provádění akce, zkuste stránku obnovit.',
            'owner' => "Nelze nominovat vlastní beatmapu.",
        ],
        'resolve' => [
            'not_owner' => 'Pouze zakladatel vlákna a vlastník beatmapy může označit diskusi za vyřešenou.',
        ],

        'store' => [
            'mapper_note_wrong_user' => 'Pouze vlastník mapy nebo nominátor/člen týmu zajišťující kvalitu může napsat připomínky.',
        ],

        'vote' => [
            'limit_exceeded' => 'Chvíli počkej, než budeš zasílat další hlasy',
            'owner' => "Ve vlastní diskusi nemůžeš hlasovat.",
            'wrong_beatmapset_state' => 'Hlasovat lze pouze v diskuzích čekajících beatmap.',
        ],
    ],

    'beatmap_discussion_post' => [
        'edit' => [
            'system_generated' => 'Nelze upravovat automaticky generovaný příspěvek.',
            'not_owner' => 'Pouze autor může příspěvek spravovat.',
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
                    'no_access' => 'Přístup je vyžadován k vybranému kanálu.',
                    'moderated' => 'Kanál je v současné době moderován.',
                    'not_lazer' => 'V tuto chvíli můžete mluvit pouze v #lazer.',
                ],

                'not_allowed' => 'Nelze odesílat zprávy při banu/omezení/umlčení.',
            ],
        ],
    ],

    'contest' => [
        'voting_over' => 'Nemůžeš změnit svůj hlas po ukončení soutěže.',
    ],

    'forum' => [
        'post' => [
            'delete' => [
                'only_last_post' => 'Lze odstranit pouze poslední příspěvek.',
                'locked' => 'Nelze odstranit příspěvek pro uzamčené téma.',
                'no_forum_access' => 'K vybranému fóru je vyžadován přístup.',
                'not_owner' => 'Pouze odesílatel může odstranit příspěvek.',
            ],

            'edit' => [
                'deleted' => 'Nelze upravovat odstraněný příspěvek.',
                'locked' => 'Příspěvek je uzamčen od upravování.',
                'no_forum_access' => 'K vybranému fóru je vyžadován přístup.',
                'not_owner' => 'Pouze odesílatel může příspěvek upravit.',
                'topic_locked' => 'Nelze upravit příspěvek pro uzamčené téma.',
            ],

            'store' => [
                'play_more' => 'Předtím, než přidáte příspěvek na fórech zkuste si hru zahrát prosím! Pokud máte problém s hraním, prosím zeptejte se na fóru Pomoc a Podpora.',
                'too_many_help_posts' => "Musíš víc hrát hru, aby jsi mohl psát další příspěvky. Jestli stále máš potíže při hraní, napiš na email support@ppy.sh", // FIXME: unhardcode email address.
            ],
        ],

        'topic' => [
            'reply' => [
                'double_post' => 'Prosím upravte váš poslední příspěvek namísto psaní nového.',
                'locked' => 'Na uzamčené vlákno nelze odpovědět.',
                'no_forum_access' => 'K vybranému fóru je vyžadován přístup.',
                'no_permission' => 'Nemáte oprávnění odpovědět.',

                'user' => [
                    'require_login' => 'Prosím přihlaste se, abyste mohl odpovědět.',
                    'restricted' => "Nelze odpovědět, když jste omezeni.",
                    'silenced' => "Nelze odpovědět, když jste umlčeni.",
                ],
            ],

            'store' => [
                'no_forum_access' => 'K vybranému fóru je vyžadován přístup.',
                'no_permission' => 'Žádná oprávnění k vytvoření nového tématu.',
                'forum_closed' => 'Fórum je uzavřeno a další příspěvky se už nesmí přidávat.',
            ],

            'vote' => [
                'no_forum_access' => 'K vybranému fóru je vyžadován přístup.',
                'over' => 'Hlasování je ukončeno a už nelze hlasovat.',
                'voted' => 'Změna hlasu není povolena.',

                'user' => [
                    'require_login' => 'Pro hlasování se prosím přihlašte.',
                    'restricted' => "Nelze hlasovat, když jste omezeni.",
                    'silenced' => "Nelze hlasovat, když jste umlčeni.",
                ],
            ],

            'watch' => [
                'no_forum_access' => 'K vybranému fóru je vyžadován přístup.',
            ],
        ],

        'topic_cover' => [
            'edit' => [
                'uneditable' => 'Neplatné záhlaví.',
                'not_owner' => 'Pouze vlastník může upravit záhlaví.',
            ],
        ],

        'view' => [
            'admin_only' => 'Pouze admin může zobrazit toto fórum.',
        ],
    ],

    'require_login' => 'Pro pokračování se prosím přihlašte.',

    'unauthorized' => 'Přístup odepřen.',

    'silenced' => "Toto nelze provést, když jste umlčeni.",

    'restricted' => "Toto nelze provést, když jste omezeni.",

    'user' => [
        'page' => [
            'edit' => [
                'locked' => 'Uživatelská stránka je uzamčená.',
                'not_owner' => 'Lze upravit pouze svou vlastní uživatelskou stránku.',
                'require_supporter_tag' => 'supporter tag je vyžadován.',
            ],
        ],
    ],
];
