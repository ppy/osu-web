<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'play_more' => 'Co si místo toho zahrát osu!?',
    'require_login' => 'Pro pokračování se prosím přihlašte.',
    'require_verification' => 'Prosím ověřte se pro pokračování.',
    'restricted' => "Toto nelze provést, když jste omezeni.",
    'silenced' => "Toto nelze provést, když jste umlčeni.",
    'unauthorized' => 'Přístup odepřen.',

    'beatmap_discussion' => [
        'destroy' => [
            'is_hype' => 'Hype nelze vrátit zpět.',
            'has_reply' => 'Nelze odstranit diskusi s odpověďmi',
        ],
        'nominate' => [
            'exhausted' => 'Dosáhl jsi dnešního limitu nominací, zkus to prosím zítra.',
            'incorrect_state' => 'Nastala chyba při provádění akce, zkuste stránku obnovit.',
            'owner' => "Nelze nominovat vlastní beatmapu.",
            'set_metadata' => 'Před nominováním musíte nastavit žánr a jazyk.',
        ],
        'resolve' => [
            'not_owner' => 'Pouze zakladatel vlákna a vlastník beatmapy může označit diskusi za vyřešenou.',
        ],

        'store' => [
            'mapper_note_wrong_user' => 'Pouze vlastník mapy nebo nominátor/člen týmu zajišťujícího kvalitu může přidat autorovy připomínky.',
        ],

        'vote' => [
            'bot' => "Nelze hlasovat pro diskuzi vytvořenou botem",
            'limit_exceeded' => 'Chvíli počkej, než budeš zasílat další hlasy',
            'owner' => "Ve vlastní diskusi nemůžeš hlasovat.",
            'wrong_beatmapset_state' => 'Hlasovat lze pouze v diskusích čekajících beatmap.',
        ],
    ],

    'beatmap_discussion_post' => [
        'destroy' => [
            'not_owner' => 'Můžeš odstranit pouze svoje příspěvky.',
            'resolved' => 'Nemůžete odstranit příspěvek v vyřešené diskusi.',
            'system_generated' => 'Automaticky generované příspěvky nelze odstranit.',
        ],

        'edit' => [
            'not_owner' => 'Pouze autor může příspěvek upravovat.',
            'resolved' => 'Nemůžete upravit příspěvek ve vyřešené diskusi.',
            'system_generated' => 'Nelze upravovat automaticky generovaný příspěvek.',
        ],

        'store' => [
            'beatmapset_locked' => 'Tato beatmapa je zablokována od diskuze.',
        ],
    ],

    'beatmapset' => [
        'metadata' => [
            'nominated' => 'Nemůžete změnit metadata nominované beatmapy. Pokud si myslíte, že jsou nastavena nesprávně, kontaktujte člena BN nebo NAT.',
        ],
    ],

    'chat' => [
        'blocked' => 'Nemůžete napsat uživateli, kterého máte buď zablokovaného nebo vás má v zablokovaných.',
        'friends_only' => 'Uživatel blokuje zprávy od lidí, kteří nejsou v jeho listu přátel.',
        'moderated' => 'Tento kanál je právě moderován.',
        'no_access' => 'Nemáte přístup k tomu kanálu.',
        'receive_friends_only' => '',
        'restricted' => 'Nemůžete posílat zprávy, když jste umlčen, omezen nebo zabanován.',
        'silenced' => 'Nemůžete posílat zprávy, když jste umlčen, omezen nebo zabanován.',
    ],

    'comment' => [
        'update' => [
            'deleted' => "Nemůžete editovat již odstraněný příspěvek.",
        ],
    ],

    'contest' => [
        'voting_over' => 'Po skončení hlasovací doby pro tuto soutěž již nemůžeš změnit svůj hlas.',

        'entry' => [
            'limit_reached' => 'Dosáhl jsi limitu vstupů pro tuto soutěž',
            'over' => 'Díky za vaše vstupy! Podání byla uzavřena a hlasování se brzy otevře.',
        ],
    ],

    'forum' => [
        'moderate' => [
            'no_permission' => 'Nemáte povolení k moderování tohoto fóra.',
        ],

        'post' => [
            'delete' => [
                'only_last_post' => 'Lze odstranit pouze poslední příspěvek.',
                'locked' => 'Nelze odstranit příspěvek uzamčeného tématu.',
                'no_forum_access' => 'K vybranému fóru je vyžadován přístup.',
                'not_owner' => 'Pouze autor může odstranit příspěvek.',
            ],

            'edit' => [
                'deleted' => 'Nelze upravovat odstraněný příspěvek.',
                'locked' => 'Příspěvek je uzamčen od upravování.',
                'no_forum_access' => 'K vybranému fóru je vyžadován přístup.',
                'not_owner' => 'Pouze autor může příspěvek upravit.',
                'topic_locked' => 'Nelze upravit příspěvek uzamčeného tématu.',
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
                    'require_login' => 'Pro zaslání odpovědi se prosím přihlaste.',
                    'restricted' => "Nelze odpovědět, když jste omezeni.",
                    'silenced' => "Nelze odpovědět, když jste umlčeni.",
                ],
            ],

            'store' => [
                'no_forum_access' => 'K vybranému fóru je vyžadován přístup.',
                'no_permission' => 'Nemáte oprávnění na vytvoření nového tématu.',
                'forum_closed' => 'Fórum je uzavřeno a další příspěvky se už nesmí přidávat.',
            ],

            'vote' => [
                'no_forum_access' => 'K vybranému fóru je vyžadován přístup.',
                'over' => 'Hlasování je ukončeno a už nelze hlasovat.',
                'play_more' => 'Potřebuješ hrát více před hlasováním na fóru.',
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
            'store' => [
                'forum_not_allowed' => 'Toto fórum nepřijímá náhledy témat.',
            ],
        ],

        'view' => [
            'admin_only' => 'Pouze admin může zobrazit toto fórum.',
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
                'locked' => 'Uživatelská stránka je uzamčená.',
                'not_owner' => 'Lze upravit pouze svou vlastní uživatelskou stránku.',
                'require_supporter_tag' => 'supporter tag je vyžadován.',
            ],
        ],
    ],
];
