<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'play_more' => 'Čo si tak namiesto toho zahrať osu!?',
    'require_login' => 'Prosím, prihláste sa pre pokračovanie.',
    'require_verification' => 'Prosím overte pre pokračovanie.',
    'restricted' => "Nemôžete to robiť s obmedzeným účtom.",
    'silenced' => "Toto nemôžete robiť, kým ste umlčaný.",
    'unauthorized' => 'Prístup zamietnutý.',

    'beatmap_discussion' => [
        'destroy' => [
            'is_hype' => 'Hype nejde vziať späť.',
            'has_reply' => 'Nemôžete vymazávať diskusie s odpoveďami',
        ],
        'nominate' => [
            'exhausted' => 'Dosiahli ste limit nominácii pre tento deň, prosím, skúste to znovu zajtra.',
            'incorrect_state' => 'Nastala chyba pri vykonávaní tejto činnosti, skús obnoviť túto stránku.',
            'owner' => "Nemôžete nominovať vlastnú beatmapu.",
            'set_metadata' => 'Musíš nastaviť žáner a jazyk pred nominovaním.',
        ],
        'resolve' => [
            'not_owner' => 'Iba tvorca diskusie a majiteľ beatmapy môže označiť diskusiu za vyriešenú.',
        ],

        'store' => [
            'mapper_note_wrong_user' => 'Iba vlastník mapy alebo nominátor/členu tímu zaručujúceho kvalitu môže pridať autorove pripomienky.',
        ],

        'vote' => [
            'bot' => "Nemožno hlasovať pre diskusiu vytvorenú botom",
            'limit_exceeded' => 'Počkaj chvíľku pred ďalším hlasovaním',
            'owner' => "Nemôžete hlasovať vo vlastnej diskusii.",
            'wrong_beatmapset_state' => 'Hlasovať môžete iba v diskusii očakávaných beatmáp.',
        ],
    ],

    'beatmap_discussion_post' => [
        'destroy' => [
            'not_owner' => 'Môžete odstrániť iba vaše vlastné príspevky.',
            'resolved' => 'Nemôžete vymazať príspevky vyriešenej diskusie.',
            'system_generated' => 'Automaticky generovaný príspevok nie je možné odstrániť.',
        ],

        'edit' => [
            'not_owner' => 'Príspevok môže upravovať iba autor.',
            'resolved' => 'Nemôžete upravovať príspevky vyriešenej diskusie.',
            'system_generated' => 'Automaticky generovaný príspevok nie je možné upravovať.',
        ],
    ],

    'beatmapset' => [
        'discussion_locked' => 'Táto beatmapa je k diskusii zamknutá.',

        'metadata' => [
            'nominated' => 'Nemôžete zmeniť metadáta nominovanej mapy. Kontaktujte člena BN alebo NAT, ak si myslíte, že to je nastavené nesprávne.',
        ],
    ],

    'beatmap_tag' => [
        'store' => [
            'no_score' => '',
        ],
    ],

    'chat' => [
        'blocked' => 'Nie je možné poslať správu používateľovi, ktorý blokuje teba, alebo ty blokuješ jeho.',
        'friends_only' => 'Používateľ blokuje správy od ľudí, ktorí nie sú na ich ich liste priateľstva.',
        'moderated' => 'Kanál je momentálne moderovaný.',
        'no_access' => 'Nemáte prístup k tomuto kanálu.',
        'no_announce' => '',
        'receive_friends_only' => 'Používateľ nemusí byť schopný odpovedať, keďže prijímate iba správy od ľudí vo Vašom zozname priateľov.',
        'restricted' => 'Nemôžete posielať správy, keď ste umlčaný, obmedzený alebo zabanovaný.',
        'silenced' => 'Nemôžete posielať správy, keď ste umlčaný, obmedzený alebo zabanovaný.',
    ],

    'comment' => [
        'store' => [
            'disabled' => 'Komentáre sú vypnuté',
        ],
        'update' => [
            'deleted' => "Nemôžeš upraviť zmazaný príspevok.",
        ],
    ],

    'contest' => [
        'judging_not_active' => 'Hodnotenie tejto súťaže nie je aktívne.',
        'voting_over' => 'Po tom, čo sa hlasovacie obdobie pre túto súťaž ukončilo, svoj hlas nemôžete zmeniť.',

        'entry' => [
            'limit_reached' => 'Dosiahol si limit vstupov pre túto súťaž',
            'over' => 'Ďakujeme za vaše vstupy! Podania pre túto súťaž  boli uzavreté a hlasovanie sa čoskoro otvorí.',
        ],
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
                'locked' => 'Príspevok je uzamknutý pre upravovanie.',
                'no_forum_access' => 'Nemáš prístup k danému fóru.',
                'no_permission' => '',
                'not_owner' => 'Upravovať môže iba autor príspevku.',
                'topic_locked' => 'Nie je možné upraviť príspevok zamknutej témy.',
            ],

            'store' => [
                'play_more' => 'Predtým, ako pridáte príspevok na fórach, skúste si zahrať, prosím! Ak máte problém s hraním, prosím opýtajte sa na fóre Pomoc a Podpora.',
                'too_many_help_posts' => "Musíš hrať viac, aby si mohol vytvárať ďalšie príspevky. Ak tvoj problém s hraním hry pretrváva, napíš na email support@ppy.sh", // FIXME: unhardcode email address.
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
                'play_more' => 'Musíte hrať viacej pred tým ako môžete hlasovať na fórach.',
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
            'store' => [
                'forum_not_allowed' => 'Toto fórum neakceptuje potlače na témy.',
            ],
        ],

        'view' => [
            'admin_only' => 'Iba administrátor môže vidieť toto fórum.',
        ],
    ],

    'room' => [
        'destroy' => [
            'not_owner' => '',
        ],
    ],

    'score' => [
        'pin' => [
            'disabled_type' => "Tento typ skóre sa nedá pripnúť",
            'failed' => "",
            'not_owner' => 'Skóre môže pripnúť iba pôvodný hráč.',
            'too_many' => 'Už bolo pripnuté maximum skóre.',
        ],
    ],

    'team' => [
        'application' => [
            'store' => [
                'already_member' => "",
                'already_other_member' => "",
                'currently_applying' => '',
                'team_closed' => '',
                'team_full' => "",
            ],
        ],
        'part' => [
            'is_leader' => "",
            'not_member' => '',
        ],
        'store' => [
            'require_supporter_tag' => '',
        ],
    ],

    'user' => [
        'page' => [
            'edit' => [
                'locked' => 'Uživateľská stránka je uzamknutá.',
                'not_owner' => 'Môžete upravovať iba vlastnú uživateľskú stránku.',
                'require_supporter_tag' => 'osu!supporter tag je vyžadovaný.',
            ],
        ],
        'update_email' => [
            'locked' => '',
        ],
    ],
];
