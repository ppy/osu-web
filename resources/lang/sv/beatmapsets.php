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

    'cover' => [
        'deleted' => 'Raderad beatmap',
    ],

    'download' => [
        'limit_exceeded' => 'Sakta ner, spela mer.',
        'no_mirrors' => 'Inga nerladdnings servrar tillgängliga.',
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
        'bng_limited_too_many_rulesets' => 'Probationära nominatörer kan ej nominera flera regelset.',
        'full_nomination_required' => 'Du måste vara en fullständig nominatör för att utföra den slutliga nomineringen av ett regelset.',
        'hybrid_requires_modes' => 'En hybrid beatmap kräver att du väljer minst ett spelläge att nominera för.',
        'incorrect_mode' => 'Du har inte behörighet att nominera för läge: :mode',
        'invalid_limited_nomination' => 'Denna beatmap har ogiltiga nomineringar och kan inte kvalificeras i detta tillstånd',
        'invalid_ruleset' => 'Den här nomineringen har ogiltiga regelverk.',
        'too_many' => 'Nomineringskravet är redan uppfyllt.',
        'too_many_non_main_ruleset' => 'Nomineringskrav för icke-huvudregelset har redan uppfyllts.',

        'dialog' => [
            'confirmation' => 'Är du säker på att du vill nominera denna beatmap?',
            'different_nominator_warning' => 'Att kvalificera denna beatmap med andra nominatorer kommer att återställa dess position i kvalificeringskön.',
            'header' => 'Nominera beatmap',
            'hybrid_warning' => 'notera: du kan bara nominera en gång, så se till att du nominerar för alla spellägen som du tänker nominera för',
            'current_main_ruleset' => 'Det huvudsakliga regelsettet är för närvarande :ruleset',
            'which_modes' => 'Nominera för vilka spellägen?',
        ],
    ],

    'nsfw_badge' => [
        'label' => 'Explicit',
    ],

    'show' => [
        'discussion' => 'Diskussion',

        'admin' => [
            'full_size_cover' => 'Visa omslagsbilden i full storlek',
            'page' => 'Visa administratörssida',
        ],

        'deleted_banner' => [
            'title' => 'Denna beatmap har blivit borttagen.',
            'message' => '(endast moderatorer kan se detta)',
        ],

        'details' => [
            'by_artist' => 'av :artist',
            'favourite' => 'Favoritmarkera detta beatmapset',
            'favourite_login' => 'Logga in för att favoritmarkera denna beatmap',
            'logged-out' => 'Du behöver logga in innan du laddar ner beatmaps!',
            'mapped_by' => 'skapad av :mapper',
            'mapped_by_guest' => 'gästsvårighetsgrad av :mapper',
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
            'mapper_tags' => 'Mapper-taggar',
            'no_scores' => 'Data beräknas...',
            'nominators' => 'Nominatorer',
            'nsfw' => 'Explicit innehåll',
            'offset' => 'Online-förskjutning',
            'pack_tags' => '',
            'points-of-failure' => 'Punkter av Misslyckande',
            'source' => 'Källa',
            'storyboard' => 'Denna beatmap innehåller storyboard',
            'success-rate' => 'Genomsnittig Succe',
            'success_rate_plays' => '',
            'user_tags' => 'Använartaggar',
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
            'error' => 'Det gick inte att ladda ranking',
            'friend' => 'Rankning bland vänner',
            'global' => 'Global rankning',
            'supporter-link' => 'Klicka <a href=":link">här</a> för att se alla fina funktioner du kommer få!',
            'supporter-only' => 'Du behöver vara en supporter för att komma åt vän-, land-, och modspecifika rankningar!',
            'team' => 'Lag Rangordning ',
            'title' => 'Poängtavla',

            'headers' => [
                'accuracy' => 'Precision',
                'combo' => 'Högsta kombo',
                'miss' => 'Missar',
                'mods' => 'Tillägg',
                'pin' => 'Fäst',
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
                'team' => 'Ingen från ditt lag har satt ett resultat på denna karta än!',
                'unranked' => 'Ej rankad beatmap.',
            ],
            'score' => [
                'first' => 'Leder',
                'own' => 'Ditt bästa',
            ],
            'supporter_link' => [
                '_' => 'Klicka :here för att se alla fina förmåner som du får!',
                'here' => 'här',
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
            'offset' => 'Online-förskjutning: :offset',
            'user-rating' => 'Användarbetyg',
            'rating-spread' => 'Betygsspridning',
            'nominations' => 'Nomineringar',
            'playcount' => 'Antal gånger spelad',
            'favourites' => 'Favoriter',
            'no_favourites' => 'Inga favoriter än',
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

    'spotlight_badge' => [
        'label' => 'I rampljuset',
    ],
];
