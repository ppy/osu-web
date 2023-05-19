<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'discussion-votes' => [
        'update' => [
            'error' => 'Nastala chyba během hlasování',
        ],
    ],

    'discussions' => [
        'allow_kudosu' => 'povolit kudosu',
        'beatmap_information' => 'Stránka Beatmapy',
        'delete' => 'odstranit',
        'deleted' => 'Smazal uživatel :editor v :delete_time.',
        'deny_kudosu' => 'odepřít kudosu',
        'edit' => 'upravit',
        'edited' => 'Naposledy upravil :editor v :update_time.',
        'guest' => 'Obtížnost hosta od :user',
        'kudosu_denied' => 'Odepřen od získávání kudosu.',
        'message_placeholder_deleted_beatmap' => 'Tato obtížnost byla smazána, takže už nemůže být probírána.',
        'message_placeholder_locked' => 'Diskuze o této mapě byly vypnuty.',
        'message_placeholder_silenced' => "Nelze odeslat diskuzi když jste ztišeni.",
        'message_type_select' => 'Vybrat typ komentáře',
        'reply_notice' => 'Stiskni enter pro odpověď.',
        'reply_placeholder' => 'Napiš svou odpověď sem',
        'require-login' => 'Pro psaní odpovědí nebo přidávání příspěvků se prosím přihlas',
        'resolved' => 'Vyřešeno',
        'restore' => 'obnovit',
        'show_deleted' => 'Zobrazit smazané',
        'title' => 'Diskuze',

        'collapse' => [
            'all-collapse' => 'Skrýt vše',
            'all-expand' => 'Rozbalit vše',
        ],

        'empty' => [
            'empty' => 'Zatím žádné diskuze!',
            'hidden' => 'Žádná diskuze neodpovídá zvolenému filtru.',
        ],

        'lock' => [
            'button' => [
                'lock' => 'Zamknout diskuze',
                'unlock' => 'Odemknout diskuze',
            ],

            'prompt' => [
                'lock' => 'Důvod k uzamknutí',
                'unlock' => 'Jste si jistý o uzamknutí?',
            ],
        ],

        'message_hint' => [
            'in_general' => 'Tento příspěvek bude zveřejněn na generální diskuzi beatmapy. Pokud chcete beatmapu módovat, začněte zprávu časovou sekvencí (např. 00:12:345).',
            'in_timeline' => 'Pro módování více časových sekvencí přidejte více příspěvků (jeden příspěvek na každou sekvenci).',
        ],

        'message_placeholder' => [
            'general' => 'Piště zde pro odeslání příspěvku do Obecné (:version)',
            'generalAll' => 'Piště zde pro odeslání příspěvku do Obecné (Všechny obtížnosti)',
            'review' => 'Piště sem k přidání recenze',
            'timeline' => 'Piště zde pro zařazení příspěvku do Časové osy (:version)',
        ],

        'message_type' => [
            'disqualify' => 'Vyřadit',
            'hype' => 'Podpořit!',
            'mapper_note' => 'Poznámka',
            'nomination_reset' => 'Resetování nominace',
            'praise' => 'Pochvala',
            'problem' => 'Problém',
            'problem_warning' => 'Nahlásit problém',
            'review' => 'Recenze',
            'suggestion' => 'Návrh',
        ],

        'mode' => [
            'events' => 'Historie',
            'general' => 'Obecné :scope',
            'reviews' => 'Recenze',
            'timeline' => 'Časová osa',
            'scopes' => [
                'general' => 'Tato obtížnost',
                'generalAll' => 'Všechny obtížnosti',
            ],
        ],

        'new' => [
            'pin' => 'Připnout',
            'timestamp' => 'Časová značka',
            'timestamp_missing' => 'ctrl-c v režimu úprav a vložte do vaší zprávy pro přidání časové značky!',
            'title' => 'Nová diskuze',
            'unpin' => 'Odepnout',
        ],

        'review' => [
            'new' => 'Nová recenze',
            'embed' => [
                'delete' => 'Smazat',
                'missing' => '[DISKUZE SMAZÁNA]',
                'unlink' => 'Odpojit',
                'unsaved' => 'Neuloženo',
                'timestamp' => [
                    'all-diff' => 'Příspěvky na "Všechny obtížnosti" nemohou být časovány.',
                    'diff' => 'Pokud tento :type začíná časovou značkou, zobrazí se v Časové ose.',
                ],
            ],
            'insert-block' => [
                'paragraph' => 'vložit odstavec',
                'praise' => 'vložit pochvalu',
                'problem' => 'vložit problém',
                'suggestion' => 'vložit návrh',
            ],
        ],

        'show' => [
            'title' => ':title zmapovaná hráčem :mapper',
        ],

        'sort' => [
            'created_at' => 'Čas vytvoření',
            'timeline' => 'Časová osa',
            'updated_at' => 'Poslední aktualizace',
        ],

        'stats' => [
            'deleted' => 'Odstraněno',
            'mapper_notes' => 'Poznámky',
            'mine' => 'Mé',
            'pending' => 'Nevyřízené',
            'praises' => 'Pochvaly',
            'resolved' => 'Vyřešené',
            'total' => 'Vše',
        ],

        'status-messages' => [
            'approved' => 'Tato mapa byla schválena dne :date!',
            'graveyard' => "Tato beatmapa nebyla aktualizována od :date a pravděpodobně ji tvůrce odbyl...",
            'loved' => 'Tato beatmapa byla přidána do kategorie Oblíbené dne :date!',
            'ranked' => 'Tato beatmapa byla schválena :date!',
            'wip' => 'Tato beatmapa byla označena jako Rozpracovaná jejím autorem.',
        ],

        'votes' => [
            'none' => [
                'down' => 'Zatím žádné downvoty',
                'up' => 'Zatím žádné upvoty',
            ],
            'latest' => [
                'down' => 'Nejnovější downvoty',
                'up' => 'Nejnovější upvoty',
            ],
        ],
    ],

    'hype' => [
        'button' => 'Podpořit beatmapu!',
        'button_done' => 'Již jsi tuto mapu nadchnul!',
        'confirm' => "Jsi si jist? Tato akce použije jeden z tvých :n zbývajících bodů podpory a nelze vrátit zpět.",
        'explanation' => 'Podpoř tuto beatmapu, aby byla více viditelná pro nominaci a schválení!',
        'explanation_guest' => 'Přihlas se a podpoř tuto beatmapu - udělej ji více viditelnou pro nominaci a schválení!',
        'new_time' => "Další body podpory dostaneš až :new_time.",
        'remaining' => 'Zbývá ti ještě :remaining bodů podpory.',
        'required_text' => 'Bodů podpory: :current/:required',
        'section_title' => 'Míra natěšení',
        'title' => 'Podpoření',
    ],

    'feedback' => [
        'button' => 'Zanechat zpětnou vazbu',
    ],

    'nominations' => [
        'delete' => 'Vymazat',
        'delete_own_confirm' => 'Jste si jistý? Tahle beatmapa bude smazána a pošleme vás zpátky na váš profil.',
        'delete_other_confirm' => 'Jste si jistý? Tahle beatmapa bude smazána a pošleme vás zpátky na profil uživatele.',
        'disqualification_prompt' => 'Důvod pro diskvalifikaci?',
        'disqualified_at' => 'Diskvalifikována před :time_ago (:reason).',
        'disqualified_no_reason' => 'žádný důvod nebyl určen',
        'disqualify' => 'Diskvalifikovat',
        'incorrect_state' => 'Chyba při vykonávání akce. Prosím načtete stránku znovu.',
        'love' => 'Láska',
        'love_choose' => 'Zvolte obtížnost pro loved',
        'love_confirm' => 'Miluješ tuto beatmapu?',
        'nominate' => 'Nominovat',
        'nominate_confirm' => 'Nominovat tuto beatmapu?',
        'nominated_by' => 'nominoval/a :users',
        'not_enough_hype' => "Není dostatečný hype.",
        'remove_from_loved' => 'Odstranit z Loved',
        'remove_from_loved_prompt' => 'Důvod pro odebrání z Loved:',
        'required_text' => 'Nominace: :current/:required',
        'reset_message_deleted' => 'odstraněno',
        'title' => 'Stav nominace',
        'unresolved_issues' => 'Existují stále nevyřešené problémy, které musí být řešeny jako první.',

        'rank_estimate' => [
            '_' => 'Odhaduje se, že tato mapa bude schválena :date, pokud nejsou nalezeny žádné problémy. Aktuálně je #:position ve :queue.',
            'on' => 'dne :date',
            'queue' => 'frontě schválení',
            'soon' => 'brzy',
        ],

        'reset_at' => [
            'nomination_reset' => 'Proces nominace byl resetován před :time_ago nominátorem :user, kvůli nalezení nového problému :discussion (:message).',
            'disqualify' => 'Diskvalifikováno před :time_ago uživatelem :user kvůli nalezení nového problému :discussion (:message).',
        ],

        'reset_confirm' => [
            'disqualify' => 'Jste si jistý? Tohle odstraní beatmapu z kvalifikování a vyresetuje nominační proces.',
            'nomination_reset' => 'Jsi si jist? Vytvořením nové připomínky se nominační proces resetuje.',
            'problem_warning' => 'Opravdu chcete nahlásit problém na této beatmapě? Tato akce upozorní nominátory Beatmapy.',
        ],
    ],

    'listing' => [
        'search' => [
            'prompt' => 'zadej klíčová slova...',
            'login_required' => 'Pro hledání se přihlaste.',
            'options' => 'Další možnosti hledání',
            'supporter_filter' => 'Filtrování podle :filters vyžaduje štítek podporovatele',
            'not-found' => 'bez výsledků',
            'not-found-quote' => '... ups, nic nebylo nalezeno.',
            'filters' => [
                'extra' => 'Extra',
                'general' => 'Obecné',
                'genre' => 'Žánr',
                'language' => 'Jazyk',
                'mode' => 'Mód',
                'nsfw' => 'Explicitní mapy',
                'played' => 'Již hrané',
                'rank' => 'Dle získaného hodnocení',
                'status' => 'Kategorie',
            ],
            'sorting' => [
                'title' => 'Název',
                'artist' => 'Umělec',
                'difficulty' => 'Obtížnost',
                'favourites' => 'Oblíbené',
                'updated' => 'Aktualizováno',
                'ranked' => 'Schválení',
                'rating' => 'Hodnocení',
                'plays' => 'Zahrání',
                'relevance' => 'Relevance',
                'nominations' => 'Nominace',
            ],
            'supporter_filter_quote' => [
                '_' => 'Filtrování podle :filters vyžaduje aktivní :link',
                'link_text' => 'stítek podporovatele',
            ],
        ],
    ],
    'general' => [
        'converts' => 'Zahrň překonvertované beatmapy',
        'featured_artists' => 'Featured artists',
        'follows' => 'Odebíraní autoři map',
        'recommended' => 'Doporučená obtížnost',
        'spotlights' => 'Zvýrazněné beatmapy',
    ],
    'mode' => [
        'all' => 'Všechny',
        'any' => 'Jakýkoliv',
        'osu' => '',
        'taiko' => '',
        'fruits' => '',
        'mania' => '',
    ],
    'status' => [
        'any' => 'Jakákoliv',
        'approved' => 'Schválené',
        'favourites' => 'Tvoje oblíbené',
        'graveyard' => 'Hřbitov',
        'leaderboard' => 'Má žebříček',
        'loved' => 'Oblíbené komunitou',
        'mine' => 'Moje mapy',
        'pending' => 'Čekající',
        'wip' => 'Rozpracované',
        'qualified' => 'Kvalifikované',
        'ranked' => 'Schválené',
    ],
    'genre' => [
        'any' => 'Jakýkoliv',
        'unspecified' => 'Nespecifikováno',
        'video-game' => 'Videohry',
        'anime' => 'Anime',
        'rock' => 'Rock',
        'pop' => 'Pop',
        'other' => 'Jiné',
        'novelty' => 'Novinka',
        'hip-hop' => 'Hip Hop',
        'electronic' => 'Elektronická',
        'metal' => 'Metál',
        'classical' => 'Klasická Hudba',
        'folk' => 'Folk',
        'jazz' => 'Jazz',
    ],
    'language' => [
        'any' => 'Jakýkoliv',
        'english' => 'Anglické',
        'chinese' => 'Čínské',
        'french' => 'Francouzské',
        'german' => 'Německé',
        'italian' => 'Italské',
        'japanese' => 'Japonské',
        'korean' => 'Korejské',
        'spanish' => 'Španělské',
        'swedish' => 'Švédské',
        'russian' => 'Ruština',
        'polish' => 'Polština',
        'instrumental' => 'Instrumentální',
        'other' => 'Jiné',
        'unspecified' => 'Nespecifikováno',
    ],

    'nsfw' => [
        'exclude' => 'Skrýt',
        'include' => 'Zobrazit',
    ],

    'played' => [
        'any' => 'Jakékoliv',
        'played' => 'Hrané',
        'unplayed' => 'Nehrané',
    ],
    'extra' => [
        'video' => 'S videem',
        'storyboard' => 'Se storyboardem',
    ],
    'rank' => [
        'any' => 'Jakékoliv',
        'XH' => 'Stříbrné SS',
        'X' => '',
        'SH' => 'Stříbrné S',
        'S' => '',
        'A' => '',
        'B' => '',
        'C' => '',
        'D' => '',
    ],
    'panel' => [
        'playcount' => 'Počet zahrání: :count',
        'favourites' => 'V oblíbených: :count',
    ],
    'variant' => [
        'mania' => [
            '4k' => '4K',
            '7k' => '7K',
            'all' => 'Vše',
        ],
    ],
];
