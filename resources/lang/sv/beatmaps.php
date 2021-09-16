<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'discussion-votes' => [
        'update' => [
            'error' => 'Kunde ej uppdatera röst',
        ],
    ],

    'discussions' => [
        'allow_kudosu' => 'tillåt kudosu',
        'beatmap_information' => 'Beatmap-sida',
        'delete' => 'radera',
        'deleted' => 'Raderad av :editor :delete_time.',
        'deny_kudosu' => 'neka kudosu',
        'edit' => 'redigera',
        'edited' => 'Senast redigerad av :editor :update_time.',
        'guest' => 'Gästsvårighetsgrad av :user',
        'kudosu_denied' => 'Nekad från att skaffa kudosu.',
        'message_placeholder_deleted_beatmap' => 'Denna svårighetsgrad har tagits bort så den kan inte längre diskuteras.',
        'message_placeholder_locked' => 'Diskussioner för denna beatmap har inaktiverats.',
        'message_placeholder_silenced' => "Kan inte lägga upp diskussionen medan du är tystad.",
        'message_type_select' => 'Välj kommentarstyp',
        'reply_notice' => 'Tryck enter för att svara.',
        'reply_placeholder' => 'Skriv ditt svar här',
        'require-login' => 'Var vänlig logga in för att skicka inlägg eller svara',
        'resolved' => 'Löst',
        'restore' => 'återställ',
        'show_deleted' => 'Visa borttagna',
        'title' => 'Diskussioner',

        'collapse' => [
            'all-collapse' => 'Kollapsa allt',
            'all-expand' => 'Expandera allt',
        ],

        'empty' => [
            'empty' => 'Inga diskussioner ännu!',
            'hidden' => 'Inga diskussioner matchar valt filter.',
        ],

        'lock' => [
            'button' => [
                'lock' => 'Lås diskussionen',
                'unlock' => 'Lås upp diskussionen',
            ],

            'prompt' => [
                'lock' => 'Orsak till låsning',
                'unlock' => 'Är du säker på att du vill låsa upp diskussionen?',
            ],
        ],

        'message_hint' => [
            'in_general' => 'Detta inlägg kommer att gå till allmän beatmapset diskussion. För att modifiera denna beatmap, starta meddelande med tidsstämpel (t.ex. 00:12:345).',
            'in_timeline' => 'För att modda flera tidsstämplar, lägg upp flera inlägg (ett inlägg för varje tidsstämpel).',
        ],

        'message_placeholder' => [
            'general' => 'Skriv här för att posta till General (:version)',
            'generalAll' => 'Skriv här för att posta till General (Alla svårighetsgrader)',
            'review' => 'Skriv här för att posta en recension',
            'timeline' => 'Skriv här för att posta till Tidslinjen (:version)',
        ],

        'message_type' => [
            'disqualify' => 'Diskvalificera',
            'hype' => 'Hype!',
            'mapper_note' => 'Anteckning',
            'nomination_reset' => 'Återställ Nominering',
            'praise' => 'Beröm',
            'problem' => 'Problem',
            'review' => 'Recension',
            'suggestion' => 'Förslag',
        ],

        'mode' => [
            'events' => 'Historik',
            'general' => 'Allmänt :scope',
            'reviews' => 'Recensioner',
            'timeline' => 'Tidslinje',
            'scopes' => [
                'general' => 'Denna svårighetsgrad',
                'generalAll' => 'Alla svårighetsgrader',
            ],
        ],

        'new' => [
            'pin' => 'Fäst',
            'timestamp' => 'Tidsstämpel',
            'timestamp_missing' => 'Tryck ctrl-c i redigeringsläget och klistra in ditt meddelande för att lägga till en tidsstämpel!',
            'title' => 'Ny diskussion',
            'unpin' => 'Lossa',
        ],

        'review' => [
            'new' => 'Ny recension',
            'embed' => [
                'delete' => 'Radera',
                'missing' => '[DISKUSSION RADERAD]',
                'unlink' => 'Ta bort länk',
                'unsaved' => 'Ej sparad',
                'timestamp' => [
                    'all-diff' => 'Inlägg med "Alla svårighetsgrader" kan inte tidsstämplas.',
                    'diff' => 'Om denna :type börjar med en tidsstämpel, visas den under Tidslinje.',
                ],
            ],
            'insert-block' => [
                'paragraph' => 'infoga paragraf',
                'praise' => 'infoga beröm',
                'problem' => 'infoga problem',
                'suggestion' => 'infoga förslag',
            ],
        ],

        'show' => [
            'title' => ':title mappad av :mapper',
        ],

        'sort' => [
            'created_at' => 'Skapelsedatum',
            'timeline' => 'Tidslinje',
            'updated_at' => 'Senaste uppdatering',
        ],

        'stats' => [
            'deleted' => 'Raderad',
            'mapper_notes' => 'Anteckningar',
            'mine' => 'Min',
            'pending' => 'Avvaktar',
            'praises' => 'Beröm',
            'resolved' => 'Löst',
            'total' => 'Alla',
        ],

        'status-messages' => [
            'approved' => 'Denna beatmap blev godkänd :date!',
            'graveyard' => "Denna beatmap har inte blivit uppdaterad sen :date och har mest troligast blivit övergiven av skaparen...",
            'loved' => 'Denna beatmap blev tillagd i älskad :date!',
            'ranked' => 'Denna beatmap blev rankad :date!',
            'wip' => 'Notera: Denna beatmap är markerad som pågående arbete av skaparen.',
        ],

        'votes' => [
            'none' => [
                'down' => 'Inga nedröster ännu',
                'up' => 'Inga uppröster ännu',
            ],
            'latest' => [
                'down' => 'Senaste nedröster',
                'up' => 'Senaste uppröster',
            ],
        ],
    ],

    'hype' => [
        'button' => 'Hype Beatmap!',
        'button_done' => 'Redan hypad!',
        'confirm' => "Är du säker? Detta kommer att använda en av dina återstående :n hypes och kan inte tas tillbaka.",
        'explanation' => 'Hypa denna beatmap för att göra den mer synlig för nominering och rankning!',
        'explanation_guest' => 'Logga in och hypa denna beatmap för att göra den mer synlig för nomineringar och rankning!',
        'new_time' => "Du kommer att få en till hype :new_time.",
        'remaining' => 'Du har :remaining hypes kvar.',
        'required_text' => 'Hype: :current/:required',
        'section_title' => 'Hype-tåg',
        'title' => 'Hype',
    ],

    'feedback' => [
        'button' => 'Lämna Feedback',
    ],

    'nominations' => [
        'delete' => 'Radera',
        'delete_own_confirm' => 'Är du säker? Beatmapen kommer att raderas och du kommer att omdirigeras tillbaka till din profil.',
        'delete_other_confirm' => 'Är du säker? Beatmapen kommer att raderas och du kommer att omdirigeras tillbaka till användarens profil.',
        'disqualification_prompt' => 'Anledning för diskvalificering?',
        'disqualified_at' => 'Diskvalificerad :time_ago (:reason).',
        'disqualified_no_reason' => 'ingen anledning specificerad',
        'disqualify' => 'Diskvalificera',
        'incorrect_state' => 'Ett fel uppstod, pröva att uppdatera sidan.',
        'love' => 'Kärlek',
        'love_choose' => 'Välj svårighetsgrad för älskad',
        'love_confirm' => 'Älskar du denna beatmap?',
        'nominate' => 'Nominera',
        'nominate_confirm' => 'Nominera denna beatmap?',
        'nominated_by' => 'nominerad av :users',
        'not_enough_hype' => "Det finns inte tillräckligt med hype.",
        'remove_from_loved' => 'Ta bort från Älskad',
        'remove_from_loved_prompt' => 'Anledning till borttagandet från Älskad:',
        'required_text' => 'Nomineringar: :current/:required',
        'reset_message_deleted' => 'raderad',
        'title' => 'Nominering Status',
        'unresolved_issues' => 'Det finns fortfarande olösta problem som måste tas hand om först.',

        'rank_estimate' => [
            '_' => 'Denna map uppskattas vara rankad den :date, så länge inga fel uppstår. Den är #:position i kön :queue.',
            'queue' => 'rankkö',
            'soon' => 'snart',
        ],

        'reset_at' => [
            'nomination_reset' => 'Nomineringsprocessen återställdes :time_ago av :user med ett nytt problem :discussion (:message).',
            'disqualify' => 'Diskvalificerad :time_ago av :user med ett nytt problem :discussion (:message).',
        ],

        'reset_confirm' => [
            'nomination_reset' => 'Är du säker? Lägga upp ett nytt problem kommer återställa nomineringar.',
            'disqualify' => 'Är du säker? Detta kommer att ta bort beatmap från kvalificering och återställa nomineringsprocessen.',
        ],
    ],

    'listing' => [
        'search' => [
            'prompt' => 'skriv in nyckelord...',
            'login_required' => 'Logga in för att söka.',
            'options' => 'Mer Sök Alternativ',
            'supporter_filter' => 'Filtrering av :filters kräver en aktiv osu!supporter tagg',
            'not-found' => 'inga resultat',
            'not-found-quote' => '... nope, ingenting hittades.',
            'filters' => [
                'extra' => 'extra',
                'general' => 'Allmänt',
                'genre' => 'Genre',
                'language' => 'Språk',
                'mode' => 'Läge',
                'nsfw' => 'Explicit innehåll',
                'played' => 'Spelade',
                'rank' => 'Rank Uppnådd',
                'status' => 'Kategorier',
            ],
            'sorting' => [
                'title' => 'Titel',
                'artist' => 'Artist',
                'difficulty' => 'Svårighetsgrad',
                'favourites' => 'Favoriter',
                'updated' => 'Uppdaterad',
                'ranked' => 'Rankad',
                'rating' => 'Omdöme',
                'plays' => 'Spelningar',
                'relevance' => 'Relevans',
                'nominations' => 'Nomineringar',
            ],
            'supporter_filter_quote' => [
                '_' => 'Filtrering av :filters kräver en aktiv :link',
                'link_text' => 'osu!supporter tagg',
            ],
        ],
    ],
    'general' => [
        'converts' => 'Inkludera konverterade beatmaps',
        'featured_artists' => '',
        'follows' => 'Prenumererade mappare',
        'recommended' => 'Rekommenderad svårighetsgrad',
    ],
    'mode' => [
        'all' => 'Alla',
        'any' => 'Alla',
        'osu' => '',
        'taiko' => '',
        'fruits' => '',
        'mania' => '',
    ],
    'status' => [
        'any' => 'Alla',
        'approved' => 'Godkänd',
        'favourites' => 'Favoriter',
        'graveyard' => 'Kyrkogård',
        'leaderboard' => 'Har topplista',
        'loved' => 'Älskad',
        'mine' => 'Mina Maps',
        'pending' => 'Pågående & WIP',
        'qualified' => 'Kvalificerad',
        'ranked' => 'Rankad',
    ],
    'genre' => [
        'any' => 'Alla',
        'unspecified' => 'Ospecificerad',
        'video-game' => 'Spel',
        'anime' => 'Anime',
        'rock' => 'Rock',
        'pop' => 'Pop',
        'other' => 'Annan',
        'novelty' => 'Novelty',
        'hip-hop' => 'Hiphop',
        'electronic' => 'Elektroniskt',
        'metal' => 'Metal',
        'classical' => 'Klassiskt',
        'folk' => 'Folk',
        'jazz' => 'Jazz',
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
        'MR' => '',
        'NC' => '',
        'NF' => '',
        'NM' => '',
        'PF' => '',
        'RX' => '',
        'SD' => '',
        'SO' => '',
        'TD' => '',
        'V2' => '',
    ],
    'language' => [
        'any' => 'Alla',
        'english' => 'Engelska',
        'chinese' => 'Kinesiska',
        'french' => 'Franska',
        'german' => 'Tyska',
        'italian' => 'Italienska',
        'japanese' => 'Japanska',
        'korean' => 'Koreanska',
        'spanish' => 'Spanska',
        'swedish' => 'Svenska',
        'russian' => 'Ryska',
        'polish' => 'Polska',
        'instrumental' => 'Instrumental',
        'other' => 'Annat',
        'unspecified' => 'Ospecificerat',
    ],

    'nsfw' => [
        'exclude' => 'Dölj',
        'include' => 'Visa',
    ],

    'played' => [
        'any' => 'Alla',
        'played' => 'Spelade',
        'unplayed' => 'Ej spelade',
    ],
    'extra' => [
        'video' => 'Har video',
        'storyboard' => 'Har storyboard',
    ],
    'rank' => [
        'any' => 'Alla',
        'XH' => 'Silver SS',
        'X' => '',
        'SH' => 'Silver S',
        'S' => '',
        'A' => '',
        'B' => '',
        'C' => '',
        'D' => '',
    ],
    'panel' => [
        'playcount' => 'Antal spelade: :count',
        'favourites' => 'Favoriter: :count',
    ],
    'variant' => [
        'mania' => [
            '4k' => '4K',
            '7k' => '7K',
            'all' => 'Alla',
        ],
    ],
];
