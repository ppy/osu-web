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
    'beatmap_discussion' => [
        'destroy' => [
            'is_hype' => 'Hype nejde vziať späť.',
            'has_reply' => 'Nemôžete vymazávať diskusie s odpoveďami',
        ],
        'nominate' => [
            'exhausted' => 'Dosiahli ste limit nominácii pre tento deň, prosím, skúste to znovu zajtra.',
            'incorrect_state' => 'Nastala chyba pri vykonávaní tejto činnosti, skús obnoviť túto stránku.',
            'owner' => "Nemôžete nominovať vlastnú beatmapu.",
        ],
        'resolve' => [
            'not_owner' => 'Iba tvorca diskusie a majiteľ beatmapy môže označiť diskusiu za vyriešenú.',
        ],

        'store' => [
            'mapper_note_wrong_user' => 'Iba vlastník mapy alebo nominátor/člen skupiny QAT môžu písať poznámky mappera.',
        ],

        'vote' => [
            'limit_exceeded' => 'Počkaj chvíľku pred ďalším hlasovaním',
            'owner' => "Nemôžete hlasovať vo vlastnej diskusii.",
            'wrong_beatmapset_state' => 'Hlasovať môžete iba v diskusii očakávaných beatmáp.',
        ],
    ],

    'beatmap_discussion_post' => [
        'edit' => [
            'system_generated' => 'Automaticky generovaný príspevok nie je možné upravovať.',
            'not_owner' => 'Príspevok môže upravovať iba autor.',
        ],
    ],

    'chat' => [
        'blocked' => 'Nie je možné poslať správu používateľovi, ktorý blokuje teba, alebo ty blokuješ jeho.',
        'friends_only' => 'Používateľ blokuje správy od ľudí, ktorí nie sú na ich ich liste priateľstva.',
        'moderated' => 'Kanál je momentálne moderovaný.',
        'no_access' => 'Nemáte prístup k tomuto kanálu.',
        'restricted' => 'Nemôžete posielať správy, keď ste umlčaný, obmedzený alebo zabanovaný.',
    ],

    'comment' => [
        'update' => [
            'deleted' => "Nemôžeš upraviť zmazaný príspevok.",
        ],
    ],

    'contest' => [
        'voting_over' => 'Po tom, čo sa hlasovacie obdobie pre túto súťaž ukončilo, svoj hlas nemôžete zmeniť.',
    ],

    'forum' => [
        'moderate' => [
            'no_permission' => 'Žiadne oprávnenie na úpravu tohto fóra.',
        ],

        'post' => [
            'delete' => [
                'only_last_post' => 'Iba posledný príspevok môže byť odstránený.',
                'locked' => 'Nie je možné odstrániť príspevok zamknutej témy.',
                'no_forum_access' => 'Nemáš prístup k danému fóru.',
                'not_owner' => 'Vymazať príspevok môže iba autor príspevku.',
            ],

            'edit' => [
                'deleted' => 'Nemôžete upraviť odstránený príspevok.',
                'locked' => 'Príspevok je uzamknutý od upravovania.',
                'no_forum_access' => 'Nemáš prístup k danému fóru.',
                'not_owner' => 'Upravovať môže iba autor príspevku.',
                'topic_locked' => 'Nie je možné editovať príspevok zamknutej témy.',
            ],

            'store' => [
                'play_more' => 'Prosím skús si zahrať hru pred písaním na fórum! Ak máš problém s hraním, prosím spýtaj sa na Help and Support fóre.',
                'too_many_help_posts' => "Musíš hrať viac pred ďalšími príspevkami. Ak tvoj problém s hraním hry pretrváva, napíš na support@ppy.sh", // FIXME: unhardcode email address.
            ],
        ],

        'topic' => [
            'reply' => [
                'double_post' => 'Prosím uprav svoj posledný príspevok namiesto písania ďalšieho.',
                'locked' => 'Nemôžeš odpovedať na uzamknutom vlákne.',
                'no_forum_access' => 'K danému fóru je požadovaný prístup.',
                'no_permission' => 'Nemáte povolenie odpovedať.',

                'user' => [
                    'require_login' => 'Prosím, prihláste sa, ak chcete odpovedať.',
                    'restricted' => "Nemôžete odpovedať s obmedzeným účtom.",
                    'silenced' => "Nemôžete odpovedať, keď ste umlčaný.",
                ],
            ],

            'store' => [
                'no_forum_access' => 'K danému fóru je požadovaný prístup.',
                'no_permission' => 'Nemáš právo vytvoriť novú tému.',
                'forum_closed' => 'Fórum je zatvorené, ďalšie príspevky už nie je možné pridať.',
            ],

            'vote' => [
                'no_forum_access' => 'K danému fóru je požadovaný prístup.',
                'over' => 'Hlasovanie bolo ukončené, hlasovať nie je naďalej možné.',
                'voted' => 'Zmena hlasu nie je povolená.',

                'user' => [
                    'require_login' => 'Prosím, prihláste sa, ak chcete hlasovať.',
                    'restricted' => "Nemôžete hlasovať s obmedzeným účtom.",
                    'silenced' => "Nemôžete hlasovať, keď ste umlčaný.",
                ],
            ],

            'watch' => [
                'no_forum_access' => 'K danému fóru je požadovaný prístup.',
            ],
        ],

        'topic_cover' => [
            'edit' => [
                'uneditable' => 'Neplatné pozadie.',
                'not_owner' => 'Iba autor môže upravovať pozadie.',
            ],
        ],

        'view' => [
            'admin_only' => 'Iba administrátor môže vidieť toto fórum.',
        ],
    ],

    'require_login' => 'Prosím, prihláste sa, aby ste mohli pokračovať.',

    'unauthorized' => 'Prístup zamietnutý.',

    'silenced' => "Toto nemôžete robiť, kým ste umlčaný.",

    'restricted' => "Toto nemôžete robiť, kým ste umlčaný.",

    'user' => [
        'page' => [
            'edit' => [
                'locked' => 'Uživateľská stránka je uzamknutá.',
                'not_owner' => 'Môžete upravovať iba vlastnú uživateľskú stránku.',
                'require_supporter_tag' => 'osu!supporter tag je vyžadovaný.',
            ],
        ],
    ],
];
