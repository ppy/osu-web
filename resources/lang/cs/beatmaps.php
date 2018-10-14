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
    'discussion-posts' => [
        'store' => [
            'error' => 'Nastala chyba během ukládání příspěvku',
        ],
    ],

    'discussion-votes' => [
        'update' => [
            'error' => 'Nastala chyba během hlasování',
        ],
    ],

    'discussions' => [
        'allow_kudosu' => 'povolit kudosu',
        'delete' => 'odstranit',
        'deleted' => 'Smazal uživatel :editor v :delete_time.',
        'deny_kudosu' => 'odepřít kudosu',
        'edit' => 'upravit',
        'edited' => 'Naposledy upravil :editor v :update_time.',
        'kudosu_denied' => 'Odepřen od získávání kudosu.',
        'message_placeholder_deleted_beatmap' => 'Tato obtížnost byla smazána, takže už nemůže být probírána.',
        'message_type_select' => 'Vybrat typ komentáře',
        'reply_notice' => 'Stiskni enter pro odpověď.',
        'reply_placeholder' => 'Napiš svou odpověď sem',
        'require-login' => 'Pro psaní odpovědí nebo přidávání příspěvků se prosím přihlaš',
        'resolved' => 'Vyřešeno',
        'restore' => 'obnovit',
        'title' => 'Diskuze',

        'collapse' => [
            'all-collapse' => 'Skrýt vše',
            'all-expand' => 'Rozbalit vše',
        ],

        'empty' => [
            'empty' => 'Zatím žádné diskuse!',
            'hidden' => 'Žádná diskuze neodpovídá zvolenému filtru.',
        ],

        'message_hint' => [
            'in_general' => 'Tento příspěvek bude zveřejněn na generální diskuzi beatmapy. Pokud chcete beatmapu módovat, začněte zprávu časovou sekvencí (např. 00:12:345).',
            'in_timeline' => 'Pro módování více časových sekvencí přidejte více příspěvků (jeden příspěvek na každou sekvenci).',
        ],

        'message_placeholder' => [
            'general' => 'Piště zde pro odeslání příspěvku do Obecné (:version)',
            'generalAll' => 'Piště zde pro odeslání příspěvku do Obecné (Všechny obtížnosti)',
            'timeline' => 'Piště zde pro zařazení příspěvku do Časové osy (:version)',
        ],

        'message_type' => [
            'disqualify' => 'Vyřadit',
            'hype' => 'Nadchnout!',
            'mapper_note' => 'Poznámka',
            'nomination_reset' => 'Obnovit nominace',
            'praise' => 'Chválit',
            'problem' => 'Problém',
            'suggestion' => 'Návrh',
        ],

        'mode' => [
            'events' => 'Historie',
            'general' => 'Obecný :scope',
            'timeline' => 'Časová osa',
            'scopes' => [
                'general' => 'Tato obtížnost',
                'generalAll' => 'Všechny obtížnosti',
            ],
        ],

        'new' => [
            'timestamp' => 'Časová sekvence',
            'timestamp_missing' => 'ctrl-c v režimu úprav a vložte do zprávy pro přidání časové sekvence!',
            'title' => 'Nová diskuze',
        ],

        'show' => [
            'title' => ':title zmapovaná hráčem :mapper',
        ],

        'sort' => [
            '_' => 'Seřazeno podle:',
            'created_at' => 'čas vytvoření',
            'timeline' => 'časová osa',
            'updated_at' => 'poslední aktualizace',
        ],

        'stats' => [
            'deleted' => 'Odstraněno',
            'mapper_notes' => 'Poznámky',
            'mine' => 'Mé',
            'pending' => 'Nevyřízené',
            'praises' => 'Chvály',
            'resolved' => 'Vyřešeno',
            'total' => 'Vše',
        ],

        'status-messages' => [
            'approved' => 'Tato mapa byla schválena dne :date!',
            'graveyard' => "Tato beatmapa nebyla aktualizována od :date a pravděpodobně ji tvůrce odbyl...",
            'loved' => 'Tato beatmapa byla přidána do kategorie Oblíbené dne :date!',
            'ranked' => 'Tato beatmapa začala být hodnocena dne :date!',
            'wip' => 'Tato beatmapa byla označena jako Rozpracovaná jejím autorem.',
        ],

    ],

    'hype' => [
        'button' => 'Nadchnout beatmapu!',
        'button_done' => 'Již jsi tuto mapu nadchnul!',
        'confirm' => "Jsi si jist? Toto ti odebere jeden z tvých :n nadšení a nedá se to vrátit.",
        'explanation' => 'Nadchni tuto beatmapu a udělej ji více viditelnou pro nominátory a hodnocení!',
        'explanation_guest' => 'Přihlaš se a nadchni tuto beatmapu - udělej ji více viditelnou pro nominátory a hodnocení!',
        'new_time' => "Další nadšení získáš až :new_time.",
        'remaining' => 'Již ti zbývá :remaining nadšení.',
        'required_text' => 'Nadšení: :current/:required',
        'section_title' => 'Natěšení',
        'title' => 'Nadšení',
    ],

    'feedback' => [
        'button' => 'Zanechat zpětnou vazbu',
    ],

    'nominations' => [
        'disqualification_prompt' => 'Důvod pro diskvalifikaci?',
        'disqualified_at' => 'Diskvalifikována před :time_ago (:reason).',
        'disqualified_no_reason' => 'žádný důvod nebyl určen',
        'disqualify' => 'Diskvalifikovat',
        'incorrect_state' => 'Chyba při vykonávání akce. Prosím načtete stránku znovu.',
        'love' => 'Láska',
        'love_confirm' => 'Miluješ tuto beatmapu?',
        'nominate' => 'Nominovat',
        'nominate_confirm' => 'Nominovat tuto beatmapu?',
        'nominated_by' => 'nominováno od :users',
        'qualified' => 'Předpokládané datum zhodnocení této mapy je :date, pokud se nenaleznou žádné chyby.',
        'qualified_soon' => 'Již brzy bude tato mapa hodnocená, pokud se nenaleznou žádné chyby.',
        'required_text' => 'Nominace: :current/:required',
        'reset_message_deleted' => 'odstraněno',
        'title' => 'Stav nominace',
        'unresolved_issues' => 'Existují stále nevyřešené problémy, které musí být řešeny jako první.',

        'reset_at' => [
            'nomination_reset' => 'Proces nominace byl resetován před :time_ago nominátorem :user, kvůli nalezení nového problému :discussion (:message).',
            'disqualify' => 'Diskvalifikováno před :time_ago uživatelem :user kvůli nalezení nového problému :discussion (:message).',
        ],

        'reset_confirm' => [
            'nomination_reset' => 'Jsi si jist? Vytvořením nové připomínky se nominační proces resetuje.',
        ],
    ],

    'listing' => [
        'search' => [
            'prompt' => 'zadej klíčová slova...',
            'login_required' => 'Přihlaste se k hledání.',
            'options' => 'Další možnosti hledání',
            'supporter_filter' => 'Filtrování podle :filters vyžaduje štítek podporovatele',
            'not-found' => 'bez výsledků',
            'not-found-quote' => '... ups, nic nebylo nalezeno.',
            'filters' => [
                'general' => 'Obecné',
                'mode' => 'Mód',
                'status' => 'Kategorie',
                'genre' => 'Žánr',
                'language' => 'Jazyk',
                'extra' => 'extra',
                'rank' => 'Dle získaného písmene',
                'played' => 'Již hrané',
            ],
            'sorting' => [
                'title' => 'název',
                'artist' => 'interpret',
                'difficulty' => 'obtížnost',
                'updated' => 'aktualizováno',
                'ranked' => 'ohodnocené',
                'rating' => 'hodnocení',
                'plays' => 'hráno',
                'relevance' => 'relevance',
                'nominations' => 'nominace',
            ],
            'supporter_filter_quote' => [
                '_' => 'Filtrování podle :filters vyžaduje aktivní :link',
                'link_text' => 'stítek podporovatele',
            ],
        ],
    ],
    'general' => [
        'recommended' => 'Doporučená obtížnost',
        'converts' => 'Zahrň konvertované beatmapy',
    ],
    'mode' => [
        'any' => 'Jakékoliv',
        'osu' => '',
        'taiko' => '',
        'fruits' => '',
        'mania' => '',
    ],
    'status' => [
        'any' => 'Jakékoliv',
        'ranked-approved' => 'Hodnocené & Schválené',
        'approved' => 'Schválené',
        'qualified' => 'Kvalifikované',
        'loved' => 'Oblíbené',
        'faves' => 'Mé oblíbené',
        'pending' => 'Čekající & Rozpracované',
        'graveyard' => 'Hřbitov',
        'my-maps' => 'Mé mapy',
    ],
    'genre' => [
        'any' => 'Jakékoliv',
        'unspecified' => 'Nespecifikováno',
        'video-game' => 'Videohry',
        'anime' => 'Anime',
        'rock' => 'Rock',
        'pop' => 'Pop',
        'other' => 'Jiné',
        'novelty' => 'Novinka',
        'hip-hop' => 'Hip Hop',
        'electronic' => 'Elektronická',
    ],
    'mods' => [
        '4K' => '',
        '5K' => '',
        '6K' => '',
        '7K' => '',
        '8K' => '',
        '9K' => '',
        'AP' => '',
        'DT' => '',
        'EZ' => '',
        'FI' => '',
        'FL' => '',
        'HD' => '',
        'HR' => '',
        'HT' => '',
        'NC' => '',
        'NF' => '',
        'NM' => '',
        'PF' => '',
        'Relax' => '',
        'SD' => '',
        'SO' => '',
        'TD' => '',
    ],
    'language' => [
        'any' => '',
        'english' => 'Anglické',
        'chinese' => 'Čínské',
        'french' => 'Francouzské',
        'german' => 'Německé',
        'italian' => 'Italské',
        'japanese' => 'Japonské',
        'korean' => 'Korejské',
        'spanish' => 'Španělské',
        'swedish' => 'Švédské',
        'instrumental' => 'Instrumentální',
        'other' => 'Jiné',
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
];
