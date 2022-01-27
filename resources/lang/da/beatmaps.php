<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'discussion-votes' => [
        'update' => [
            'error' => 'Kunne ikke afgive stemme',
        ],
    ],

    'discussions' => [
        'allow_kudosu' => 'giv kudosu',
        'beatmap_information' => 'Beatmap Side',
        'delete' => 'slet',
        'deleted' => 'Slettet af :editor :delete_time.',
        'deny_kudosu' => 'nægt kudosu',
        'edit' => 'rediger',
        'edited' => 'Sidst redigeret af :editor :update_time.',
        'guest' => '',
        'kudosu_denied' => 'Nægtet fra at kunne modtage kudosu.',
        'message_placeholder_deleted_beatmap' => 'Denne sværhedsgrad er blevet slettet så den kan ikke blive diskuteret længere.',
        'message_placeholder_locked' => 'Diskussion for dette beatmap er blevet deaktiveret.',
        'message_placeholder_silenced' => "Kan ikke skrive diskussion, mens du er tavs.",
        'message_type_select' => 'Vælg kommentar-type',
        'reply_notice' => 'Tryk enter for at svare.',
        'reply_placeholder' => 'Skriv dit svar her',
        'require-login' => 'Log ind for at lave et opslag eller svare',
        'resolved' => 'Løst',
        'restore' => 'gendan',
        'show_deleted' => 'Vis slettede',
        'title' => 'Diskussioner',

        'collapse' => [
            'all-collapse' => 'Sammenfold alle',
            'all-expand' => 'Udvid alle',
        ],

        'empty' => [
            'empty' => 'Endnu ingen diskussioner!',
            'hidden' => 'Ingen diskussioner matchede det valgte filter.',
        ],

        'lock' => [
            'button' => [
                'lock' => 'Lås diskussion',
                'unlock' => 'Lås op for diskussion',
            ],

            'prompt' => [
                'lock' => 'Årsag for låsning',
                'unlock' => 'Er du sikker på at du vil låse op?',
            ],
        ],

        'message_hint' => [
            'in_general' => 'Dette opslag vil ende i general beatmapset diskussionen. Start beskeden med et tidsstempel (f.eks. 00:12:345) for at modde dette beatmap.',
            'in_timeline' => 'For at modde flere tidsstempler, skal der laves flere opslag (kun et opslag pr. tidsstempel).',
        ],

        'message_placeholder' => [
            'general' => 'Skriv her for at lave et opslag til General (:version)',
            'generalAll' => 'Skriv her for at lave et opslag til General (All difficulties)',
            'review' => 'Skriv her for at sende en anmeldelse',
            'timeline' => 'Skriv her for at lave et opslag til Tidslinjen (:version)',
        ],

        'message_type' => [
            'disqualify' => 'Diskvalificer',
            'hype' => 'Hype!',
            'mapper_note' => 'Notat',
            'nomination_reset' => 'Nulstil Nominering',
            'praise' => 'Ros',
            'problem' => 'Problem',
            'review' => 'Anmeld',
            'suggestion' => 'Forslag',
        ],

        'mode' => [
            'events' => 'Historie',
            'general' => 'Generalt :scope',
            'reviews' => 'Anmeldelser',
            'timeline' => 'Tidslinje',
            'scopes' => [
                'general' => 'Denne sværhedgrad',
                'generalAll' => 'Alle sværhedgrader',
            ],
        ],

        'new' => [
            'pin' => 'Fastgør',
            'timestamp' => 'Tidsstempel',
            'timestamp_missing' => 'Tryk ctrl-c i edit mode og indsæt i din besked for at tilføje tidsstempel!',
            'title' => 'Ny diskussion',
            'unpin' => 'Frigør',
        ],

        'review' => [
            'new' => 'Ny anmeldelse',
            'embed' => [
                'delete' => 'Fjern',
                'missing' => '[DISCUSSION SLETTET]',
                'unlink' => 'Fjern link',
                'unsaved' => 'Ikke gemt',
                'timestamp' => [
                    'all-diff' => '',
                    'diff' => '',
                ],
            ],
            'insert-block' => [
                'paragraph' => 'indsæt afsnit',
                'praise' => '',
                'problem' => 'indsæt problem',
                'suggestion' => 'indsæt forslag',
            ],
        ],

        'show' => [
            'title' => ':title mappet af :mapper',
        ],

        'sort' => [
            'created_at' => 'Oprettelsestidspunkt',
            'timeline' => 'Tidslinje',
            'updated_at' => 'Sidst opdateret',
        ],

        'stats' => [
            'deleted' => 'Slettet',
            'mapper_notes' => 'Notater',
            'mine' => 'Mine',
            'pending' => 'Afventende',
            'praises' => 'Hyldester',
            'resolved' => 'Løste',
            'total' => 'Alle',
        ],

        'status-messages' => [
            'approved' => 'Dette beatmap blev godkendt på :date!',
            'graveyard' => "Dette beatmap er ikke blevet opdateret siden :date og er højst sandsynligt blevet efterladt af skaberen...",
            'loved' => 'Dette beatmap blev tilføjet til "Loved" på :date!',
            'ranked' => 'Dette beatmap blev ranked på :date!',
            'wip' => 'Notat: Dette beatmap er blevet markeret som "Under konstruktion" af skaberen.',
        ],

        'votes' => [
            'none' => [
                'down' => 'Endnu ingen downvotes',
                'up' => 'Endnu ingen upvotes',
            ],
            'latest' => [
                'down' => 'Seneste downvotes',
                'up' => 'Seneste upvotes',
            ],
        ],
    ],

    'hype' => [
        'button' => 'Hype Beatmap!',
        'button_done' => 'Allerede Hypet!',
        'confirm' => "Er du sikker? Dette vil bruge en af dine resterende :n hypes og kan ikke fortrydes.",
        'explanation' => 'Hype dette beatmap for at gøre det mere synligt for nominering og ranking!',
        'explanation_guest' => 'Log ind og hype dette beatmap for at gøre det mere synligt for nominering og ranking!',
        'new_time' => "Du får en ny hype :new_time.",
        'remaining' => 'Du har :remaining hypes tilbage.',
        'required_text' => 'Hype: :current/:required',
        'section_title' => 'Hype Train',
        'title' => 'Hype',
    ],

    'feedback' => [
        'button' => 'Giv Feedback',
    ],

    'nominations' => [
        'delete' => 'Fjern',
        'delete_own_confirm' => 'Er du sikker? Dette beatmap vil blive slettet og du vil blive ledt tilbage til din profil.',
        'delete_other_confirm' => 'Er du sikker? Dette beatmap vil blive slettet og du vil blive ledt tilbage til brugerens profil.',
        'disqualification_prompt' => 'Diskvalifikations-årsag?',
        'disqualified_at' => 'Diskvalificeret :time_ago (:reason).',
        'disqualified_no_reason' => 'ingen årsag specificeret',
        'disqualify' => 'Diskvalificér',
        'incorrect_state' => 'Der opstod en fejl da vi prøvede at udføre handlingen, prøv at genindlæse siden.',
        'love' => 'Elsk',
        'love_choose' => '',
        'love_confirm' => 'Elsk dette beatmap?',
        'nominate' => 'Nominér',
        'nominate_confirm' => 'Nominér dette beatmap?',
        'nominated_by' => 'nomineret af :users',
        'not_enough_hype' => "Der er ikke nok hype.",
        'remove_from_loved' => 'Fjern fra Elsket',
        'remove_from_loved_prompt' => 'Årsag til fjernelse fra Elsket:',
        'required_text' => 'Nomineringer: :current/:required',
        'reset_message_deleted' => 'slettet',
        'title' => 'Nomineringstatus',
        'unresolved_issues' => 'Der er stadig uløste problemer der skal tages fat på først.',

        'rank_estimate' => [
            '_' => '',
            'queue' => '',
            'soon' => 'snart',
        ],

        'reset_at' => [
            'nomination_reset' => 'Nominerings processen nulstillet :time_ago af :user med et nyt problem :discussion (:message).',
            'disqualify' => 'Diskvalificeret :time_ago af :user med et nyt problem :discussion (:message).',
        ],

        'reset_confirm' => [
            'nomination_reset' => 'Er du sikker? At slå et nyt problem op nulstiller nominations-processen.',
            'disqualify' => 'Er du sikker? Dette vil fjerne beatmappet fra de kvalificerede beatmaps og vil nulstille nominations-processen.',
        ],
    ],

    'listing' => [
        'search' => [
            'prompt' => 'skriv nøgleord...',
            'login_required' => 'Log ind for at kunne søge.',
            'options' => 'Flere Søgefunktioner',
            'supporter_filter' => 'Filtrering af :filters kræver et aktivt osu! supporter tag',
            'not-found' => 'ingen resultater',
            'not-found-quote' => '... desværre, intet fundet.',
            'filters' => [
                'extra' => 'extra',
                'general' => 'Generelt',
                'genre' => 'Genre',
                'language' => 'Sprog',
                'mode' => 'Mode',
                'nsfw' => '',
                'played' => 'Allerede spillet',
                'rank' => 'Rank Opnået',
                'status' => 'Kategorier',
            ],
            'sorting' => [
                'title' => 'Titel',
                'artist' => 'Kunstner',
                'difficulty' => 'Sværhedsgrad',
                'favourites' => 'Favoritter',
                'updated' => 'Opdateret',
                'ranked' => 'Rangeret',
                'rating' => 'Vurdering',
                'plays' => 'Afspilninger',
                'relevance' => 'Relevans',
                'nominations' => 'Nomineringer',
            ],
            'supporter_filter_quote' => [
                '_' => 'Filtrering af :filters kræver et aktivt :link',
                'link_text' => 'osu!supporter tag',
            ],
        ],
    ],
    'general' => [
        'converts' => 'Inkluder konvertert beatmeaps',
        'featured_artists' => '',
        'follows' => 'Subscribed mappers
',
        'recommended' => 'Rekommenderat sværhedsgrad',
    ],
    'mode' => [
        'all' => 'Alle',
        'any' => 'Alle',
        'osu' => '',
        'taiko' => '',
        'fruits' => '',
        'mania' => '',
    ],
    'status' => [
        'any' => 'Vilkårlig',
        'approved' => 'Godkendt',
        'favourites' => 'Favoritter',
        'graveyard' => 'Kirkegården',
        'leaderboard' => 'Har Rangliste',
        'loved' => 'Elsket',
        'mine' => 'Mine Maps',
        'pending' => 'Afventende & WIP',
        'qualified' => 'Kvalificeret',
        'ranked' => 'Ranked',
    ],
    'genre' => [
        'any' => 'Vilkårlig',
        'unspecified' => 'Uspecificeret',
        'video-game' => 'Computerspil',
        'anime' => 'Anime',
        'rock' => 'Rock',
        'pop' => 'Pop',
        'other' => 'Andre',
        'novelty' => 'Novelty',
        'hip-hop' => 'Hip Hop',
        'electronic' => 'Elektronisk',
        'metal' => 'Metal',
        'classical' => 'Klassisk
',
        'folk' => 'Folkemusik',
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
        'any' => '',
        'english' => 'Engelsk',
        'chinese' => 'Kinesisk',
        'french' => 'Fransk',
        'german' => 'Tysk',
        'italian' => 'Italiensk',
        'japanese' => 'Japansk',
        'korean' => 'Koreansk',
        'spanish' => 'Spansk',
        'swedish' => 'Svensk',
        'russian' => 'Russisk',
        'polish' => 'Polsk',
        'instrumental' => 'Instrumentalt',
        'other' => 'Andet',
        'unspecified' => 'Uspecificeret',
    ],

    'nsfw' => [
        'exclude' => '',
        'include' => '',
    ],

    'played' => [
        'any' => 'Vilkårlig',
        'played' => 'Spillet',
        'unplayed' => 'Ikke Spillet',
    ],
    'extra' => [
        'video' => 'Har Video',
        'storyboard' => 'Har Storyboard',
    ],
    'rank' => [
        'any' => 'Vilkårlig',
        'XH' => 'Sølv SS',
        'X' => '',
        'SH' => 'Sølv S',
        'S' => '',
        'A' => '',
        'B' => '',
        'C' => '',
        'D' => '',
    ],
    'panel' => [
        'playcount' => 'Antal Forsøg :count',
        'favourites' => 'Favoritter :count',
    ],
    'variant' => [
        'mania' => [
            '4k' => '4K',
            '7k' => '7K',
            'all' => 'Alle',
        ],
    ],
];
