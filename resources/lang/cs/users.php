<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'deleted' => '[odstraněný uživatel]',

    'beatmapset_activities' => [
        'title' => ":user's modding historie",
        'title_compact' => 'Módování',

        'discussions' => [
            'title_recent' => 'Nedávno zahájené diskuze',
        ],

        'events' => [
            'title_recent' => 'Nedávné události',
        ],

        'posts' => [
            'title_recent' => 'Poslední příspěvky',
        ],

        'votes_received' => [
            'title_most' => 'Nejlépe hodnocený za (poslední 3 měsíce)',
        ],

        'votes_made' => [
            'title_most' => 'Nejlépe hodnocený (poslední 3 měsíce)',
        ],
    ],

    'blocks' => [
        'banner_text' => 'Uživatel byl zablokován.',
        'comment_text' => 'Tento komentář je skrytý.',
        'blocked_count' => 'blokovaných uživatelů (:count)',
        'hide_profile' => 'Skrýt profil',
        'hide_comment' => 'skrýt',
        'forum_post_text' => 'Tento příspěvek je skrytý.',
        'not_blocked' => 'Tento uživatel není blokován.',
        'show_profile' => 'Zobrazit profil',
        'show_comment' => 'zobrazit',
        'too_many' => 'Byl dosažen limit blockovaných uživatelů.',
        'button' => [
            'block' => 'Blokovat',
            'unblock' => 'Odblokovat',
        ],
    ],

    'card' => [
        'gift_supporter' => 'Darovat supporter tag',
        'loading' => 'Načítání...',
        'send_message' => 'Odeslat zprávu',
    ],

    'create' => [
        'form' => [
            'password' => 'heslo',
            'password_confirmation' => 'potvrzení hesla',
            'submit' => 'vytvořit účet',
            'user_email' => 'email',
            'user_email_confirmation' => 'ověření e-mailu',
            'username' => 'uživatelské jméno',

            'tos_notice' => [
                '_' => 'vytvořením účtu souhlasíte s :link',
                'link' => 'smluvní podmínky',
            ],
        ],
    ],

    'disabled' => [
        'title' => 'Ale ne! Vypadá to, že váš účet byl zablokován.',
        'warning' => "V případě porušení pravidla, Vezměte prosím na vědomí, že obecně existuje lhůta jednoho měsíce, během níž nebudeme zvažovat žádné žádosti o amnestii. Po tomto období nás můžete kontaktovat, pokud to považujete za nezbytné. Vezměte prosím v potaz, že vytvořením nových účtů poté, co budete mít jeden deaktivovaný, dojde k <strong>prodloužení jedno měsíčné lhůty</strong>. Vezměte prosím na vědomí, že pro <strong>každý účet, který vytváříte, dále porušujete pravidla</strong>. Velmi doporučujeme, abyste se touto cestou neubírali!",

        'if_mistake' => [
            '_' => 'Pokud se domníváte, že se jedná o chybu, můžete nás kontaktovat (přes :email nebo kliknutím na "?" v pravém dolním rohu této stránky). Vezměte prosím na vědomí, že jsme vždy plně přesvědčeni o našich akcích, protože jsou založeny na velmi spolehlivých údajích. Vyhrazujeme si právo ignorovat váš požadavek, pokud se domníváme, že jste úmyslně nepoctivý.',
            'email' => 'e-mail',
        ],

        'reasons' => [
            'compromised' => 'Váš účet byl považován za kompromizovaný. Může být dočasně deaktivován, dokud nebude potvrzena jeho identita.',
            'opening' => 'Je řada důvodů, které mohou vést k tomu, že váš účet bude vypnut:',

            'tos' => [
                '_' => 'Porušil jsi jeden nebo více z našich :community_rules nebo :tos.',
                'community_rules' => 'pravidla komunity',
                'tos' => 'smluvní podmínky',
            ],
        ],
    ],

    'filtering' => [
        'by_game_mode' => 'Uživatelé podle herního režimu',
    ],

    'force_reactivation' => [
        'reason' => [
            'inactive' => "Váš účet nebyl využíván dlouhou dobu.",
            'inactive_different_country' => "Váš účet nebyl využíván dlouhou dobu.",
        ],
    ],

    'login' => [
        '_' => 'Přihlásit se',
        'button' => 'Přihlásit se',
        'button_posting' => 'Probíhá přihlášení...',
        'email_login_disabled' => 'Přihlašování e-mailem je momentálně zakázáno. Použijte prosím uživatelské jméno.',
        'failed' => 'Nesprávné přihlášení',
        'forgot' => 'Zapoměl jsi heslo?',
        'info' => 'Prosím přihlaste se pro pokračování',
        'invalid_captcha' => 'Příliš mnoho neúspěšných pokusů o přihlášení, vyplňte prosím captcha a zkuste to znovu. (Obnovte stránku pokud captcha není vidět)',
        'locked_ip' => 'Vaše IP adresa je uzamčena. Počkejte prosím několik minut.',
        'password' => 'Heslo',
        'register' => "Nemáš osu! účet? Vytvoř si ho",
        'remember' => 'Pamatovat si tento počítač',
        'title' => 'Pro pokračování se prosím přihlaste',
        'username' => 'Uživatelské jméno',

        'beta' => [
            'main' => 'Beta přístup je momentálně omezen na oprávněné uživatele.',
            'small' => '(brzy pro podporovatele)',
        ],
    ],

    'ogp' => [
        'modding_description' => 'Beatmap: :counts',
        'modding_description_empty' => 'Uživatel nemá žádné beatmapy...',

        'description' => [
            '_' => 'Umístění (:ruleset): :global | :country',
            'country' => 'Stát :rank',
            'global' => 'Svět :rank',
        ],
    ],

    'posts' => [
        'title' => 'příspěvky hráče :username',
    ],

    'anonymous' => [
        'login_link' => 'klikněte pro přihlášení',
        'login_text' => 'přihlásit se',
        'username' => 'Návštěvník',
        'error' => 'Pro tuto akci musíte být přihlášeni.',
    ],
    'logout_confirm' => 'Opravdu se chceš odhlásit? :(',
    'report' => [
        'button_text' => 'Nahlásit',
        'comments' => 'Poznámky',
        'placeholder' => 'Uveďte prosím jakékoliv informace, které si myslíte, že by mohly být užitečné.',
        'reason' => 'Důvod',
        'thanks' => 'Děkujeme za vaše nahlášení!',
        'title' => 'Nahlásit :username?',

        'actions' => [
            'send' => 'Odeslat nahlášení',
            'cancel' => 'Zrušit',
        ],

        'options' => [
            'cheating' => 'Podvádění',
            'inappropriate_chat' => '',
            'insults' => 'Uráží mě / ostatní',
            'multiple_accounts' => 'Používání více účtů',
            'nonsense' => 'Nesmysl',
            'other' => 'Jiný (napište níže)',
            'spam' => 'Spamování',
            'unwanted_content' => 'Odkazování na nevhodný obsah',
        ],
    ],
    'restricted_banner' => [
        'title' => 'Tvůj účet byl omezen!',
        'message' => 'Zatímco jsi omezený, nebudeš moci komunikovat s ostatními hráči a tvá skóre budou viditelná pouze pro tebe. Toto je obvykle výsledkem automatického procesu a většinou jsou tato omezení zrušena do 24 hodin. :link',
        'message_link' => 'Na této stránce se dozvíte více.',
    ],
    'show' => [
        'age' => ':age let',
        'change_avatar' => 'změňte si avatar!',
        'first_members' => 'Zde od počátku',
        'is_developer' => 'osu!vývojář',
        'is_supporter' => 'osu!supporter',
        'joined_at' => 'Členem od :date',
        'lastvisit' => 'Naposledy spatřen :date',
        'lastvisit_online' => 'Momentálně aktivní',
        'missingtext' => 'Možná jste se přepsal! (nebo byl uživatel zabanován)',
        'origin_country' => 'Z :country',
        'previous_usernames' => 'dříve znám jako',
        'plays_with' => 'Hraje s :devices',

        'comments_count' => [
            '_' => 'Postnul :link',
            'count' => ':count_delimited komentář|:count_delimited komentáře|:count_delimited komentářů',
        ],
        'cover' => [
            'to_0' => 'Skrýt záhlaví',
            'to_1' => 'Zobrazit záhlaví',
        ],
        'daily_challenge' => [
            'daily' => 'Dnů v řadě',
            'daily_streak_best' => 'Nejvíce dnů v řadě',
            'daily_streak_current' => 'Aktuálně dnů v řadě',
            'playcount' => 'Celková účast',
            'title' => 'Denní\nvýzva',
            'top_10p_placements' => 'Umístění v Top 10%',
            'top_50p_placements' => 'Umístění v Top 50%',
            'weekly' => 'Týdnů v řadě',
            'weekly_streak_best' => 'Nejvíce týdnů v řadě',
            'weekly_streak_current' => 'Aktuálně týdnů v řadě',

            'unit' => [
                'day' => ':valued',
                'week' => ':valuet',
            ],
        ],
        'edit' => [
            'cover' => [
                'button' => 'Změnit záhlaví profilu',
                'defaults_info' => 'Více možností záhlaví bude k dispozici v budoucnu',
                'holdover_remove_confirm' => "Toto dříve vybrané záhlaví již není k dispozici k výběru. Nebude možné jej znovu vybrat po přepnutí na jiné záhlaví. Pokračovat?",
                'title' => 'Záhlaví',

                'upload' => [
                    'broken_file' => 'Zpracování obrázku selhalo. Ověř si obrázek a zkus to znovu.',
                    'button' => 'Nahrát obrázek',
                    'dropzone' => 'Přetáhni sem pro nahrání',
                    'dropzone_info' => 'Můžeš také přetánout sem pro nahrání',
                    'size_info' => 'Velikost záhlaví by měla být 2400x620',
                    'too_large' => 'Nahraný soubor je příliš velký.',
                    'unsupported_format' => 'Nepodporovaný formát.',

                    'restriction_info' => [
                        '_' => 'Nahrávání je dostupné pouze pro :link',
                        'link' => 'osu!supportery',
                    ],
                ],
            ],

            'default_playmode' => [
                'is_default_tooltip' => 'výchozí herní mód',
                'set' => 'nastavit :mode jako výchozí herní mód profilu',
            ],

            'hue' => [
                'reset_no_supporter' => 'Obnovit barvu na výchozí? Pro změnu na jinou barvu bude vyžadován supporter tag.',
                'title' => 'Barva',

                'supporter' => [
                    '_' => 'Vlastní barevné motivy dostupné pouze pro :link',
                    'link' => 'osu!supportery',
                ],
            ],
        ],

        'extra' => [
            'none' => 'nic',
            'unranked' => 'Žádné poslední údaje o hraní',

            'achievements' => [
                'achieved-on' => 'Dosaženo :date',
                'locked' => 'Uzamknuto',
                'title' => 'Úspěchy',
            ],
            'beatmaps' => [
                'by_artist' => 'od autora :artist',
                'title' => 'Beatmapy',

                'favourite' => [
                    'title' => 'Oblíbené Beatmapy',
                ],
                'graveyard' => [
                    'title' => 'Pohřbené Beatmapy',
                ],
                'guest' => [
                    'title' => 'Beatmapy účasti hosta',
                ],
                'loved' => [
                    'title' => 'Oblíbené Beatmapy',
                ],
                'nominated' => [
                    'title' => 'Nominované Hodnocené Beatmapy',
                ],
                'pending' => [
                    'title' => 'Čekající Beatmapy',
                ],
                'ranked' => [
                    'title' => 'Hodnocené Beatmapy',
                ],
            ],
            'discussions' => [
                'title' => 'Diskuze',
                'title_longer' => 'Poslední diskuze',
                'show_more' => 'zobrazit více diskuzí',
            ],
            'events' => [
                'title' => 'Události',
                'title_longer' => 'Poslední události',
                'show_more' => 'zobrazit více událostí',
            ],
            'historical' => [
                'title' => 'Historické',

                'monthly_playcounts' => [
                    'title' => 'Herní historie',
                    'count_label' => 'Her',
                ],
                'most_played' => [
                    'count' => 'počet zahrání',
                    'title' => 'Nejhranější mapy',
                ],
                'recent_plays' => [
                    'accuracy' => 'přesnost: :percentage',
                    'title' => 'Nedávno zahráno (24h)',
                ],
                'replays_watched_counts' => [
                    'title' => 'Historie zhlédnutí záznamů',
                    'count_label' => 'Záznamů přehráno',
                ],
            ],
            'kudosu' => [
                'recent_entries' => 'Nedávná Kudosu historie',
                'title' => 'Kudosu!',
                'total' => 'Celkově získané Kudosu',

                'entry' => [
                    'amount' => ':amount kudosu',
                    'empty' => "Tento uživatel zatím neobdržel žádné kudosu!",

                    'beatmap_discussion' => [
                        'allow_kudosu' => [
                            'give' => 'Obdržel jsi :amount kudosu z kudosu odmítnutí, z módding příspěvku :post',
                        ],

                        'deny_kudosu' => [
                            'reset' => 'Bylo odepřeno :amount z modding příspěvku :post',
                        ],

                        'delete' => [
                            'reset' => 'Ztraceno :amount kvůli smazání modding příspěvku :post',
                        ],

                        'restore' => [
                            'give' => 'Obdrženo :amount za obnovení modding příspěvku :post',
                        ],

                        'vote' => [
                            'give' => 'Obdrženo :amount za získání hlasů u modding příspěvku :post',
                            'reset' => 'Ztraceno :amount za ztrátu hlasů u modding příspěvku :post',
                        ],

                        'recalculate' => [
                            'give' => 'Obdrženo :amount za přepočítání hlasů u modding příspěvku :post',
                            'reset' => 'Ztraceno :amount za přepočítání hlasů u modding příspěvku :post',
                        ],
                    ],

                    'forum_post' => [
                        'give' => 'Obdrženo :amount od :giver za příspěvek u :post',
                        'reset' => 'Kudosu bylo obnoveno od :giver za příspěvek :post',
                        'revoke' => 'Odepřeno kudosu od :giver za příspěvek :post',
                    ],
                ],

                'total_info' => [
                    '_' => 'Založeno na tom, jak moc uživatel přispěl k moderaci beatmap. Další informace najdete na :link.',
                    'link' => 'této stránce',
                ],
            ],
            'me' => [
                'title' => 'já!',
            ],
            'medals' => [
                'empty' => "Tento uživatel zatím žádné neobdržel ;_;",
                'recent' => 'Nejnovější',
                'title' => 'Medaile',
            ],
            'playlists' => [
                'title' => 'Hry playlistu',
            ],
            'posts' => [
                'title' => 'Příspěvky',
                'title_longer' => 'Poslední příspěvky',
                'show_more' => 'zobrazit více příspěvků',
            ],
            'recent_activity' => [
                'title' => 'Nedávné',
            ],
            'realtime' => [
                'title' => 'Hry pro více hráčů',
            ],
            'top_ranks' => [
                'download_replay' => 'Stáhnout záznam',
                'not_ranked' => 'Pouze hodnocené mapy udělují pp',
                'pp_weight' => 'váženo na :percentage',
                'view_details' => 'Zobrazit detaily',
                'title' => 'Umístění',

                'best' => [
                    'title' => 'Nejlepší výkon',
                ],
                'first' => [
                    'title' => 'Umístění na prvním místě',
                ],
                'pin' => [
                    'to_0' => 'Odepnout',
                    'to_0_done' => 'Skóre odepnuto',
                    'to_1' => 'Připnout',
                    'to_1_done' => 'Připnuté skóre',
                ],
                'pinned' => [
                    'title' => 'Připnuté skóre',
                ],
            ],
            'votes' => [
                'given' => 'Udělených hlasů (poslední 3 měsíce)',
                'received' => 'Získaných hlasů (poslední 3 měsíce)',
                'title' => 'Hlasy',
                'title_longer' => 'Poslední hlasy',
                'vote_count' => ':count_delimited hlas|:count_delimited hlasy|:count_delimited hlasů',
            ],
            'account_standing' => [
                'title' => 'Stav účtu',
                'bad_standing' => "účet uživatele :username nemá dobrou reputaci :(",
                'remaining_silence' => ':username bude moci znovu mluvit za :duration.',

                'recent_infringements' => [
                    'title' => 'Nedávné incidenty',
                    'date' => 'datum',
                    'action' => 'trest',
                    'length' => 'délka',
                    'length_indefinite' => 'Neurčitý',
                    'description' => 'popis',
                    'actor' => 'od :username',

                    'actions' => [
                        'restriction' => 'Ban',
                        'silence' => 'Ztlumení',
                        'tournament_ban' => 'Zákaz na turnaje',
                        'note' => 'Poznámka',
                    ],
                ],
            ],
        ],

        'info' => [
            'discord' => '',
            'interests' => 'Zájmy',
            'location' => 'Současná poloha',
            'occupation' => 'Povolání',
            'twitter' => '',
            'website' => 'Webové stránky',
        ],
        'not_found' => [
            'reason_1' => 'Možná si změnil uživatelské jméno.',
            'reason_2' => 'Účet může být dočasně nedostupný z důvodu problémů s bezpečností, nebo zneužitím.',
            'reason_3' => 'Možná jsi se přepsal!',
            'reason_header' => 'Existuje několik možných důvodů:',
            'title' => 'Uživatel nebyl nalezen! ;_;',
        ],
        'page' => [
            'button' => 'upravit stránku profilu',
            'description' => '<strong>já!</strong> je osobní přizpůsobitelná plocha na vašem profilu.',
            'edit_big' => 'Uprav mě!',
            'placeholder' => 'Zde napiš obsah stánky',

            'restriction_info' => [
                '_' => 'Pro odemknutí této funkce musíte být :link.',
                'link' => 'osu!supporter',
            ],
        ],
        'post_count' => [
            '_' => 'Přispěl :link',
            'count' => ':count_delimited příspěvkem na fóru|:count_delimited příspěvky na fóru|:count_delimited příspěvky na fóru',
        ],
        'rank' => [
            'country' => 'Státní pozice pro :mode',
            'country_simple' => 'Místní hodnocení',
            'global' => 'Globální pozice pro :mode',
            'global_simple' => 'Světové hodnocení',
            'highest' => 'Nejvyšší rank :rank v :date',
        ],
        'season_stats' => [
            'division_top_percentage' => '',
            'total_score' => '',
        ],
        'stats' => [
            'hit_accuracy' => 'Přesnost zásahů',
            'level' => 'Úroveň :level',
            'level_progress' => 'postup do dalšího levelu',
            'maximum_combo' => 'Maximální Combo',
            'medals' => 'Medaile',
            'play_count' => 'Počet zahrání',
            'play_time' => 'Celkový čas hraní',
            'ranked_score' => 'Hodnocené skóre',
            'replays_watched_by_others' => 'Záznamy zhlédnuty ostatními',
            'score_ranks' => 'Umístění podle skóre',
            'total_hits' => 'Celkově zásahů',
            'total_score' => 'Celkové skóre',
            // modding stats
            'graveyard_beatmapset_count' => 'Pohřbené Beatmapy',
            'loved_beatmapset_count' => 'Oblíbené Beatmapy',
            'pending_beatmapset_count' => 'Čekající Beatmapy',
            'ranked_beatmapset_count' => 'Hodnocené Beatmapy',
        ],
    ],

    'silenced_banner' => [
        'title' => 'Momentálně jste umlčeni.',
        'message' => 'Některé akce mohou být nedostupné.',
    ],

    'status' => [
        'all' => 'Všichni',
        'online' => 'Online',
        'offline' => 'Offline',
    ],
    'store' => [
        'from_client' => 'prosím, zaregistrujte se přes herního klienta!',
        'from_web' => 'prosím dokončete registraci na webové stránce osu!',
        'saved' => 'Uživatelem vytvořen',
    ],
    'verify' => [
        'title' => 'Ověření účtu',
    ],

    'view_mode' => [
        'brick' => 'Zobrazit jako cihly',
        'card' => 'Zobrazit jako karty',
        'list' => 'Zobrazit jako seznam',
    ],
];
