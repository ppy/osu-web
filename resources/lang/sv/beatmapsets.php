<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'availability' => [
        'disabled' => 'Denna beatmap är för närvarande inte tillgänglig för nedladdning.',
        'parts-removed' => 'Delar av denna beatmap har tagits bort på begäran av skaparen eller en innehavare av tredjeparts-rättigheter.',
        'more-info' => 'Klicka här för mer information.',
        'rule_violation' => 'Vissa delar av denna map har tagits bort då de anses vara olämpliga i osu!.',
    ],

    'download' => [
        'limit_exceeded' => 'Sakta ner, spela mer.',
    ],

    'featured_artist_badge' => [
        'label' => 'Utvald artist',
    ],

    'index' => [
        'title' => 'Beatmaps Listning',
        'guest_title' => 'Beatmaps',
    ],

    'panel' => [
        'empty' => 'inga beatmaps',

        'download' => [
            'all' => 'ladda ner',
            'video' => 'ladda ner med video',
            'no_video' => 'ladda ner utan video',
            'direct' => 'öppna i osu!direct',
        ],
    ],

    'nominate' => [
        'hybrid_requires_modes' => 'En hybrid beatmap kräver att du väljer minst ett spelläge att nominera för.',
        'incorrect_mode' => 'Du har inte behörighet att nominera för läge: :mode',
        'full_bn_required' => 'Du måste vara en fullständig nominerare för att utföra denna kvalificerande nominering.',
        'too_many' => 'Nomineringskravet är redan uppfyllt.',

        'dialog' => [
            'confirmation' => 'Är du säker på att du vill nominera denna beatmap?',
            'header' => 'Nominera beatmap',
            'hybrid_warning' => 'notera: du kan bara nominera en gång, så se till att du nominerar för alla spellägen som du tänker nominera för',
            'which_modes' => 'Nominera för vilka spellägen?',
        ],
    ],

    'nsfw_badge' => [
        'label' => 'Explicit',
    ],

    'show' => [
        'discussion' => 'Diskussion',

        'details' => [
            'by_artist' => 'av :artist',
            'favourite' => 'Favoritmarkera detta beatmapset',
            'favourite_login' => 'Logga in för att favoritmarkera denna beatmap',
            'logged-out' => 'Du behöver logga in innan du laddar ner beatmaps!',
            'mapped_by' => 'skapad av :mapper',
            'unfavourite' => 'Ta bort favoritmarkering på detta beatmapset',
            'updated_timeago' => 'senast ändrad :timeago',

            'download' => [
                '_' => 'Ladda ner',
                'direct' => '',
                'no-video' => 'utan video',
                'video' => 'med video',
            ],

            'login_required' => [
                'bottom' => 'för att komma åt fler funktioner',
                'top' => 'Logga in',
            ],
        ],

        'details_date' => [
            'approved' => 'godkänd :timeago',
            'loved' => 'älskad :timeago',
            'qualified' => 'kvalificerad :timeago',
            'ranked' => 'rankad :timeago',
            'submitted' => 'skickad :timeago',
            'updated' => 'senast uppdaterat :timeago',
        ],

        'favourites' => [
            'limit_reached' => 'Du har för många favoritmarkerade beatmaps! Var vänlig ta bort en favorit innan du fortsätter.',
        ],

        'hype' => [
            'action' => 'Hype denna map om du gillade att spela den för att hjälpa den på vägen till <strong>rankad</strong> status.',

            'current' => [
                '_' => 'Denna map är för närvarande :status.',

                'status' => [
                    'pending' => 'väntande',
                    'qualified' => 'kvalificerad',
                    'wip' => 'under utveckling',
                ],
            ],

            'disqualify' => [
                '_' => 'Om du hittar ett problem med denna beatmap, vänligen diskvalificera den :link.',
            ],

            'report' => [
                '_' => 'Om du hittar ett problem med denna beatmap, vänligen rapportera det :link för att varna teamet.',
                'button' => 'Rapportera problem',
                'link' => 'här',
            ],
        ],

        'info' => [
            'description' => 'Beskrivning',
            'genre' => 'Genre',
            'language' => 'Språk',
            'no_scores' => 'Data beräknas...',
            'nsfw' => 'Explicit innehåll',
            'points-of-failure' => 'Punkter av Misslyckande',
            'source' => 'Källa',
            'storyboard' => 'Denna beatmap innehåller storyboard',
            'success-rate' => 'Genomsnittig Succe',
            'tags' => 'Taggar',
            'video' => 'Denna beatmap innehåller video',
        ],

        'nsfw_warning' => [
            'details' => 'Denna beatmap innehåller explicit, kränkande eller störande innehåll. Vill du se den ändå?',
            'title' => 'Explicit innehåll',

            'buttons' => [
                'disable' => 'Inaktivera varning',
                'listing' => 'Beatmaplistningar',
                'show' => 'Visa',
            ],
        ],

        'scoreboard' => [
            'achieved' => 'uppnått :when',
            'country' => 'Nationell rankning',
            'friend' => 'Rankning bland vänner',
            'global' => 'Global rankning',
            'supporter-link' => 'Klicka <a href=":link">här</a> för att se alla fina funktioner du kommer få!',
            'supporter-only' => 'Du behöver vara en supporter för att komma åt vän-, land-, och modspecifika rankningar!',
            'title' => 'Poängtavla',

            'headers' => [
                'accuracy' => 'Precision',
                'combo' => 'Högsta kombo',
                'miss' => 'Missar',
                'mods' => 'Tillägg',
                'pin' => '',
                'player' => 'Spelare',
                'pp' => '',
                'rank' => 'Rank',
                'score' => 'Poäng',
                'score_total' => 'Total poäng',
                'time' => 'Tid',
            ],

            'no_scores' => [
                'country' => 'Ingen från ditt land har satt ett poäng på denna map än!',
                'friend' => 'Ingen av dina vänner har satt ett poäng på denna map än!',
                'global' => 'Inga poäng än. Du kanske ska försöka sätta några?',
                'loading' => 'Laddar poäng...',
                'unranked' => 'Ej rankad beatmap.',
            ],
            'score' => [
                'first' => 'Leder',
                'own' => 'Ditt bästa',
            ],
            'supporter_link' => [
                '_' => '',
                'here' => '',
            ],
        ],

        'stats' => [
            'cs' => 'Cirkelstorlek',
            'cs-mania' => 'Antal tangenter',
            'drain' => 'HP-tömning',
            'accuracy' => 'Precision',
            'ar' => 'Närmningshastighet',
            'stars' => 'Stjärn-svårighetsgrad',
            'total_length' => 'Längd (tömningslängd: :hit_length)',
            'bpm' => 'BPM',
            'count_circles' => 'Cirkelantal',
            'count_sliders' => 'Sliderantal',
            'user-rating' => 'Användarbetyg',
            'rating-spread' => 'Betygsspridning',
            'nominations' => 'Nomineringar',
            'playcount' => 'Antal gånger spelad',
        ],

        'status' => [
            'ranked' => 'Rankad',
            'approved' => 'Godkänd',
            'loved' => 'Älskad',
            'qualified' => 'Kvalificerad',
            'wip' => 'Arbete pågår',
            'pending' => 'Väntande',
            'graveyard' => 'Kyrkogård',
        ],
    ],
];
