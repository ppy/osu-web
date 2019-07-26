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
    'discussion-posts' => [
        'store' => [
            'error' => 'Nastala chyba pri ukladaní',
        ],
    ],

    'discussion-votes' => [
        'update' => [
            'error' => 'Potvrdenie hlasu zlyhalo',
        ],
    ],

    'discussions' => [
        'allow_kudosu' => 'povoliť kudosu',
        'delete' => 'odstrániť',
        'deleted' => 'Odstránene uživateľom :editor :delete_time.',
        'deny_kudosu' => 'odmietnuť kudosu',
        'edit' => 'upraviť',
        'edited' => 'Naposledy upravené uživateľom :editor :update_time.',
        'kudosu_denied' => 'Odopretý od získania kudosu.',
        'message_placeholder_deleted_beatmap' => 'Táto obtiažnosť bola vymazaná, takže už nemôže byť diskutovaná.',
        'message_type_select' => 'Vybrať typ komentára',
        'reply_notice' => 'Stlačením Enter odpovedaj.',
        'reply_placeholder' => 'Sem napíš tvoju odpoveď',
        'require-login' => 'Na písanie príspevkov alebo odpovedanie sa prosím prihlas',
        'resolved' => 'Vyriešený',
        'restore' => 'obnoviť',
        'title' => 'Diskusie',

        'collapse' => [
            'all-collapse' => 'Zbaliť všetko',
            'all-expand' => 'Rozbaliť všetko',
        ],

        'empty' => [
            'empty' => 'Zatiaľ žiadne diskusie!',
            'hidden' => 'Žiadna diskusia nezodpovedá zvolenému filtru.',
        ],

        'message_hint' => [
            'in_general' => 'Tento príspevok bude zverejnený na generálnej diskusii beatmapy. Pokial chcete beatmapu módovať, začnite správu časovou sekvenciou (napr. 00:12:345).',
            'in_timeline' => 'Pre módovanie viacero časových sekvencii, pridajte viac príspevkov (1 príspevok na každú sekvenciu).',
        ],

        'message_placeholder' => [
            'general' => 'Píšte sem pre odoslanie príspevku do General (:version)',
            'generalAll' => 'Píšte sem pre odoslanie príspevku do General (Všetky obtiažnosti)',
            'timeline' => 'Píšte sem pre zaradenie príspevku do časovej osy (:version)',
        ],

        'message_type' => [
            'disqualify' => 'Diskvalifikácia',
            'hype' => 'Hype!',
            'mapper_note' => 'Poznámka',
            'nomination_reset' => 'Obnoviť Nomináciu',
            'praise' => 'Pochvala',
            'problem' => 'Problém',
            'suggestion' => 'Návrh',
        ],

        'mode' => [
            'events' => 'História',
            'general' => 'Všeobecný :scope',
            'timeline' => 'Časová os',
            'scopes' => [
                'general' => 'Táto obtiažnosť',
                'generalAll' => 'Všetky obtiažnosti',
            ],
        ],

        'new' => [
            'timestamp' => 'Časová značka',
            'timestamp_missing' => 'ctrl-c v režime editovania a vložte správu pre pridanie časovej sekvencie!',
            'title' => 'Nová diskusia',
        ],

        'show' => [
            'title' => ':title zmapovaná hráčom :mapper',
        ],

        'sort' => [
            '_' => 'Zoradené podľa:',
            'created_at' => '',
            'timeline' => '',
            'updated_at' => '',
        ],

        'stats' => [
            'deleted' => 'Vymazané',
            'mapper_notes' => 'Poznámky',
            'mine' => 'Moje',
            'pending' => 'Čakajúce',
            'praises' => 'Pochvaly',
            'resolved' => 'Vyriešené',
            'total' => 'Všetko',
        ],

        'status-messages' => [
            'approved' => 'Táto beatmapa bola schválená dňa :date!',
            'graveyard' => "Táto beatmapa nebola aktualizovaná od :date a pravdepodobne bola opustená tvorcom...",
            'loved' => 'Táto beatmapa bola pridaná do kategórie obľúbených dňa :date!',
            'ranked' => 'Táto beatmapa sa stala hodnotenou dňa :date!',
            'wip' => 'Táto beatmapa bola označená ako rozpracovaná jeho autorom.',
        ],

    ],

    'hype' => [
        'button' => 'Hype Beatmap!',
        'button_done' => 'Už hypenutá!',
        'confirm' => "Si si istý? Toto ti odoberie jednu z tvojich zvyšných :n nadšení a nedá sa to vrátiť.",
        'explanation' => 'Nadchni tuto beatmapu a sprav ju viac viditelnú pre nominátorov a hodnotenie!',
        'explanation_guest' => 'Prihlás sa a nadchni túto beatmapu a urob ju viac viditelnú pre nominátorov a hodnotenie!',
        'new_time' => "Ďalšie nadšenie získaš za :new_time.",
        'remaining' => 'Zostáva ti zvyšných :remaining nadšeni.',
        'required_text' => 'Nadšenie: :current/:required',
        'section_title' => 'Natešenie',
        'title' => 'Nadšenie',
    ],

    'feedback' => [
        'button' => 'Zanechaj Spätnú Väzbu',
    ],

    'nominations' => [
        'delete' => 'Odstrániť',
        'delete_own_confirm' => 'Ste si istý? Beatmapa bude odstránená a budete presmerovaný späť na svoj profil.',
        'delete_other_confirm' => 'Ste si istý? Beatmapa bude odstránená a budete presmerovaný späť na profil používateľa.',
        'disqualification_prompt' => 'Dôvod pre diskvalifikáciu?',
        'disqualified_at' => 'Diskvalifikovaný pred :time_ago (:reason).',
        'disqualified_no_reason' => 'nebol uvedený dôvod',
        'disqualify' => 'Diskvalifikovať',
        'incorrect_state' => 'Chyba pri vykonávaní akcie, skúste obnoviť stránku.',
        'love' => 'Obľuba',
        'love_confirm' => 'Obľúbil si si túto beatmapu?',
        'nominate' => 'Nominovať',
        'nominate_confirm' => 'Nominovať túto beatmapu?',
        'nominated_by' => 'nominované od :users',
        'qualified' => 'Predpokladaný dátum zhodnotenia mapy je :date, ak sa nenájdu žiadne chyby.',
        'qualified_soon' => 'Táto mapa bude hodnotená už čoskoro, pokial sa nenájdu žiadne chyby.',
        'required_text' => 'Nominácie :current/:required',
        'reset_message_deleted' => 'vymazané',
        'title' => 'Stav Nominácie',
        'unresolved_issues' => 'Sú tu stále nevyriešené problémy, ktoré musia byť riešené ako prvé.',

        'reset_at' => [
            'nomination_reset' => 'Proces nominácie bol resetnutý pred :time_ago nominátorom :user kvôli novému problému :discussion (:message).',
            'disqualify' => 'Diskvalifikované pred :time_ago uživatelom :user kvôli novému problému :discussion (:message).',
        ],

        'reset_confirm' => [
            'nomination_reset' => 'Si si istý? Vytvorením novej pripomienky sa proces nominácie resetne.',
            'disqualify' => 'Ste si istý? Toto odstráni beatmapu z kvalifikácie a resetuje nominačný proces.',
        ],
    ],

    'listing' => [
        'search' => [
            'prompt' => 'zadaj kľúčové slova...',
            'login_required' => 'Prihláste sa, ak chcete hľadať.',
            'options' => 'Viac možností hladania',
            'supporter_filter' => 'Filtrovanie podľa :filters vyžaduje aktívny osu!supporter tag',
            'not-found' => 'bez výsledkov',
            'not-found-quote' => '... nič sa nenašlo.',
            'filters' => [
                'general' => 'Všeobecné',
                'mode' => 'Mód',
                'status' => 'Kategórie',
                'genre' => 'Žáner',
                'language' => 'Jazyk',
                'extra' => 'extra',
                'rank' => 'Dosiahnuté Hodnotenie',
                'played' => 'Hrané',
            ],
            'sorting' => [
                'title' => '',
                'artist' => '',
                'difficulty' => '',
                'updated' => '',
                'ranked' => '',
                'rating' => '',
                'plays' => '',
                'relevance' => '',
                'nominations' => '',
            ],
            'supporter_filter_quote' => [
                '_' => 'Filtrovanie podľa :filters vyžaduje aktívny :link',
                'link_text' => 'osu!supporter tag',
            ],
        ],
    ],
    'general' => [
        'recommended' => 'Odporúčaná obtiažnosť',
        'converts' => 'Zahrnúť konvertované beatmapy',
    ],
    'mode' => [
        'any' => 'Akékoľvek',
        'osu' => '',
        'taiko' => '',
        'fruits' => '',
        'mania' => '',
    ],
    'status' => [
        'any' => 'Akékoľvek',
        'ranked-approved' => 'Hodnotené & Schválené',
        'approved' => 'Schválené',
        'qualified' => 'Kvalifikované',
        'loved' => 'Obľúbené',
        'faves' => 'Obľúbené',
        'pending' => 'Nerozhodnutý & prebiehajúci',
        'graveyard' => 'Cintorín',
        'my-maps' => 'Moje mapy',
    ],
    'genre' => [
        'any' => 'Akékoľvek',
        'unspecified' => 'Nešpecifikované',
        'video-game' => 'Videohry',
        'anime' => 'Anime',
        'rock' => 'Rock',
        'pop' => 'Pop',
        'other' => 'Ostatné',
        'novelty' => 'Novinky',
        'hip-hop' => 'Hip Hop',
        'electronic' => 'Elektronické',
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
        'chinese' => 'Čínske',
        'french' => 'Francúzske',
        'german' => 'Nemecké',
        'italian' => 'Talianské',
        'japanese' => 'Japonské',
        'korean' => 'Kórejské',
        'spanish' => 'Španielske',
        'swedish' => 'Švédske',
        'instrumental' => 'Inštrumentálne',
        'other' => 'Ostatné',
    ],
    'played' => [
        'any' => 'Akékoľvek',
        'played' => 'Hrané',
        'unplayed' => 'Nehrané',
    ],
    'extra' => [
        'video' => 'S Videom',
        'storyboard' => 'So Storyboardmi',
    ],
    'rank' => [
        'any' => 'Akékoľvek',
        'XH' => 'Strieborné SS',
        'X' => '',
        'SH' => 'Strieborné S',
        'S' => '',
        'A' => '',
        'B' => '',
        'C' => '',
        'D' => '',
    ],
    'panel' => [
        'playcount' => '',
        'favourites' => '',
    ],
];
