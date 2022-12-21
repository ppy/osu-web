<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'availability' => [
        'disabled' => 'Deze beatmap kan momenteel niet gedownload worden.',
        'parts-removed' => 'Delen van deze beatmap zijn verwijderd op verzoek van de maker of een derde rechthouder.',
        'more-info' => 'Klik hier voor meer informatie.',
        'rule_violation' => 'Sommige activa in deze map zijn verwijderd nadat ze zijn beschouwd als niet geschikt voor gebruik in osu!.',
    ],

    'cover' => [
        'deleted' => 'Beatmap verwijderd',
    ],

    'download' => [
        'limit_exceeded' => 'Niet zo snel, speel meer.',
    ],

    'featured_artist_badge' => [
        'label' => 'Uitgelichte artiest',
    ],

    'index' => [
        'title' => 'Beatmap-catalogus',
        'guest_title' => 'Beatmaps',
    ],

    'panel' => [
        'empty' => 'geen beatmaps',

        'download' => [
            'all' => 'download',
            'video' => 'download met video',
            'no_video' => 'download zonder video',
            'direct' => 'open in osu!direct',
        ],
    ],

    'nominate' => [
        'hybrid_requires_modes' => 'Een hybride beatmapset vereist dat je minimaal één speelmodus selecteert om voor te nomineren.',
        'incorrect_mode' => 'Je hebt geen toestemming om te nomineren voor modus: :mode',
        'full_bn_required' => 'Je moet een volledige nominator zijn om deze kwalificerende nominatie uit te voeren.',
        'too_many' => 'Nominatievereising is al vervuld.',

        'dialog' => [
            'confirmation' => 'Weet je zeker dat je deze Beatmap wilt nomineren?',
            'header' => 'Nomineer Beatmap',
            'hybrid_warning' => 'opmerking: je mag maar één keer nomineren, dus zorg er alsjeblieft voor dat je nomineert voor alle spelmodi die je van plan bent te nomineren',
            'which_modes' => 'Welke modi nomineren?',
        ],
    ],

    'nsfw_badge' => [
        'label' => 'Expliciet',
    ],

    'show' => [
        'discussion' => 'Discussie',

        'details' => [
            'by_artist' => 'door :artist',
            'favourite' => 'Markeer deze beatmapset als favoriet',
            'favourite_login' => 'Log in om deze beatmap als favoriet te markeren',
            'logged-out' => 'Je moet ingelogd zijn voordat je beatmaps kan downloaden!',
            'mapped_by' => 'gemapped door :mapper',
            'unfavourite' => 'Verwijder markering als favoriet',
            'updated_timeago' => 'laatst bijgewerkt :timeago',

            'download' => [
                '_' => 'Downloaden',
                'direct' => '',
                'no-video' => 'zonder Video',
                'video' => 'met Video',
            ],

            'login_required' => [
                'bottom' => 'voor toegang tot meer functies',
                'top' => 'Inloggen',
            ],
        ],

        'details_date' => [
            'approved' => 'goedgekeurd :timeago',
            'loved' => 'geliefd :timeago',
            'qualified' => 'gekwalificeerd :timeago',
            'ranked' => 'geranked :timeago',
            'submitted' => 'ingediend :timeago',
            'updated' => 'laatst bijgewerkt :timeago',
        ],

        'favourites' => [
            'limit_reached' => 'Je hebt te veel favoriete beatmaps! Verwijder er een paar voor je het opnieuw probeert.',
        ],

        'hype' => [
            'action' => 'Hype deze map als je hem leuk vond om te spelen en om hem te helpen de <strong>ranked</strong> status te bereiken.',

            'current' => [
                '_' => 'Deze map is momenteel :status.',

                'status' => [
                    'pending' => 'in behandeling',
                    'qualified' => 'gekwalificeerd',
                    'wip' => 'werk in uitvoering',
                ],
            ],

            'disqualify' => [
                '_' => 'Als je een probleem vindt met deze beatmap, diskwalificeer hem alsjeblieft :link.',
            ],

            'report' => [
                '_' => 'Als je een probleem vindt met deze beatmap, rapporteer deze dan :link om het team te waarschuwen.',
                'button' => 'Rapporteer Probleem',
                'link' => 'hier',
            ],
        ],

        'info' => [
            'description' => 'Beschrijving',
            'genre' => 'Genre',
            'language' => 'Taal',
            'no_scores' => 'Data nog aan het berekenen...',
            'nominators' => '',
            'nsfw' => 'Expliciete inhoud',
            'offset' => 'Online offset',
            'points-of-failure' => 'Faalpunten',
            'source' => 'Bron',
            'storyboard' => 'Deze beatmap bevat verhaalborden',
            'success-rate' => 'Slagingspercentage',
            'tags' => 'Tags',
            'video' => 'Deze beatmap bevat een video',
        ],

        'nsfw_warning' => [
            'details' => 'Deze beatmap bevat expliciet, beledigende of verontrustende inhoud. Wilt je het toch bekijken?',
            'title' => 'Expliciete inhoud',

            'buttons' => [
                'disable' => 'Waarschuwing uitschakelen',
                'listing' => 'Beatmap Lijst',
                'show' => 'Weergeven',
            ],
        ],

        'scoreboard' => [
            'achieved' => 'bereikt op :when',
            'country' => 'Landranking',
            'error' => 'Ranglijst laden is mislukt',
            'friend' => 'Vriendenranking',
            'global' => 'Globale Ranking',
            'supporter-link' => 'Klik <a href=":link">hier</a> om alle chique functies die je krijgt te zien!',
            'supporter-only' => 'Je moet een osu!supporter zijn om toegang te krijgen tot land- en vriendenrankings, net als mod-specifieke ranglijsten!',
            'title' => 'Scorebord',

            'headers' => [
                'accuracy' => 'Nauwkeurigheid',
                'combo' => 'Max. Combo',
                'miss' => 'Mis',
                'mods' => 'Mods',
                'pin' => 'Vastzetten',
                'player' => 'Speler',
                'pp' => '',
                'rank' => 'Rank',
                'score' => 'Score',
                'score_total' => 'Totale Score',
                'time' => 'Datum',
            ],

            'no_scores' => [
                'country' => 'Er heeft nog niemand uit jouw land een score behaald op deze map!',
                'friend' => 'Niemand van jouw vrienden heeft nog een score behaald op deze map!',
                'global' => 'Nog geen scores. Probeer er een paar te halen?',
                'loading' => 'Scoren aan het laden...',
                'unranked' => 'Ongerankte beatmap.',
            ],
            'score' => [
                'first' => 'Aan de Leiding',
                'own' => 'Jouw beste Rang',
            ],
            'supporter_link' => [
                '_' => 'Benieuwd naar de functies de je krijgt? Klik :here!',
                'here' => 'hier',
            ],
        ],

        'stats' => [
            'cs' => 'Cirkelgrootte',
            'cs-mania' => 'Aantal toetsen',
            'drain' => 'HP Drain',
            'accuracy' => 'Nauwkeurigheidsgraad',
            'ar' => 'Approach Rate',
            'stars' => 'Sterrenmoeilijkheid',
            'total_length' => 'Lengte',
            'bpm' => 'BPM',
            'count_circles' => 'Aantal Cirkels',
            'count_sliders' => 'Aantal Sliders',
            'offset' => 'Online offset: :offset',
            'user-rating' => 'Gebruikersbeoordelingen',
            'rating-spread' => 'Rating Verspreiding',
            'nominations' => 'Nominaties',
            'playcount' => 'Playcount',
        ],

        'status' => [
            'ranked' => 'Ranked',
            'approved' => 'Approved',
            'loved' => 'Loved',
            'qualified' => 'Gekwalificeerd',
            'wip' => 'WIP',
            'pending' => 'In behandelIng',
            'graveyard' => 'Begraafplaats',
        ],
    ],

    'spotlight_badge' => [
        'label' => 'Uitgelicht',
    ],
];
