<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'support' => [
        'convinced' => [
            'title' => 'Ik ben overtuigd! :D',
            'support' => 'support osu!',
            'gift' => 'of gun het iemand anders',
            'instructions' => 'klik op het hartje om naar de osu!store te gaan',
        ],
        'why-support' => [
            'title' => 'Waarom zou ik osu moeten steunen!? Waar gaat het geld naartoe?',

            'team' => [
                'title' => 'Steun het Team',
                'description' => 'Een klein team ontwikkelt en draait osu!. Uw steun helpt hen, wel... om te leven.',
            ],
            'infra' => [
                'title' => 'Server infrastructuur',
                'description' => 'Bijdrages gaan naar de servers voor het uitvoeren van de website, multiplayer services, online leaderboards, etc.',
            ],
            'featured-artists' => [
                'title' => 'Aanbevolen Artiesten',
                'description' => 'Met jouw steun kunnen we nog meer geweldige artiesten benaderen en meer geweldige muziek voor gebruik in osu! toestaan!',
                'link_text' => 'Bekijk het huidige rooster &raquo;',
            ],
            'ads' => [
                'title' => 'Hou osu! zelfvoorzienend',
                'description' => 'Jouw bijdragen helpen om het spel onafhankelijk en volledig vrij van advertenties en externe sponsors te houden.',
            ],
            'tournaments' => [
                'title' => 'Officiële toernooien',
                'description' => 'Help het beheren van (en de prijzen voor) het officiële osu! wereldkampioenschap te financieren.',
                'link_text' => 'Verken toernooien &raquo;',
            ],
            'bounty-program' => [
                'title' => 'Open Source Bounty Programma',
                'description' => 'Support de community bijdragers die hun tijd en moeite hebben gegeven om osu! te helpen beter te maken.',
                'link_text' => 'Lees meer &raquo;',
            ],
        ],
        'perks' => [
            'title' => 'Oh? Wat krijg ik dan?!',
            'osu_direct' => [
                'title' => 'osu!direct',
                'description' => 'snel en makkelijk beatmaps zoeken zonder het spel te verlaten.',
            ],

            'friend_ranking' => [
                'title' => 'Vrienden ranglijst',
                'description' => "Zie hoe je tegen je vrienden opstart op een beatmap ranglijst. zowel in het spel als op de website.",
            ],

            'country_ranking' => [
                'title' => 'Landelijke Ranking',
                'description' => 'Verover je land voordat je de wereld verovert.',
            ],

            'mod_filtering' => [
                'title' => 'Filter op Mods',
                'description' => 'Alleen bij mensen die HDHR spelen? Geen probleem!',
            ],

            'auto_downloads' => [
                'title' => 'Auto Downloads',
                'description' => 'Automatische downloads terwijl je multiplayer speelt, anderen aan het toeschouwen bent, of op links in de chat klikt!',
            ],

            'upload_more' => [
                'title' => 'Upload Meer',
                'description' => 'Meer afwachtende beatmap slots (per gerankte beatmap) tot een maximum van 10.',
            ],

            'early_access' => [
                'title' => 'Vroege Toegang',
                'description' => 'Toegang tot vervroegde releases om dingen te testen voordat ze publiekelijk zijn!',
            ],

            'customisation' => [
                'title' => 'Personalisatie',
                'description' => "Personaliseer je profiel met een volledig bewerkbare sectie.",
            ],

            'beatmap_filters' => [
                'title' => 'Beatmap Filters',
                'description' => 'Filter beatmap zoekopdrachten met gespeelde en ongespeelde maps en ranks behaald (als die er zijn).',
            ],

            'yellow_fellow' => [
                'title' => 'Gele Gabber',
                'description' => 'Word in-game herkend met een gele gebruikersnaam.',
            ],

            'speedy_downloads' => [
                'title' => 'Snellere Downloads',
                'description' => 'Mildere downloadbeperkingen, al helemaal wanneer je osu!direct gebruikt.',
            ],

            'change_username' => [
                'title' => 'Gebruikersnaam Veranderen',
                'description' => 'De mogelijkheid om je gebruikersnaam te veranderen zonder extra kosten. (maximaal één keer)',
            ],

            'skinnables' => [
                'title' => 'Skinnables',
                'description' => 'Extra in-game skinnables, zoals de achtergrond van het hoofdmenu.',
            ],

            'feature_votes' => [
                'title' => 'Feature Stemmen',
                'description' => 'Stemmen voor feature aanvragen. (2 keer per maand)',
            ],

            'sort_options' => [
                'title' => 'Sorteeropties',
                'description' => 'De mogelijkheid om beatmaps scores per land / vrienden / mod-specifiek in-game te zien.',
            ],

            'more_favourites' => [
                'title' => 'Meer favorieten',
                'description' => 'Het maximum aantal beatmaps dat je kan hebben als favoriet is verhoogd van :normally &rarr; :supporter',
            ],
            'more_friends' => [
                'title' => 'Meer vrienden',
                'description' => 'Het maximum aantal vrienden dat je kunt hebben is verhoogd van :normally &rarr; :supporter',
            ],
            'more_beatmaps' => [
                'title' => 'Upload meer beatmaps',
                'description' => 'Hoeveel niet-gerangschikte beatmaps je tegelijkertijd kunt hebben, wordt berekend op basis van een basiswaarde plus een extra bonus voor elke gerangschikte beatmap die je momenteel hebt (tot een limiet). <br/> <br/> Normaal is dit 4 plus 1 per gerangschikte beatmap (maximaal 2). Met supporter neemt dit toe tot 8 plus 1 per gerangschikte beatmap (maximaal 12).',
            ],
            'friend_filtering' => [
                'title' => 'Vrienden ranglijsten',
                'description' => 'Concurreer met je vrienden en zie hoe je tegen hen opkomt! *<br/><br/><small>* nog niet beschikbaar op de nieuwe site, binnenkort beschikbaar(tm)</small>',
            ],

        ],
        'supporter_status' => [
            'contribution' => 'Bedankt voor je hulp tot nu toe! Je hebt in totaal :dollars toegedragen in :tags supporter aankopen!',
            'gifted' => ":giftedTags van je aankopen waren een cadeau voor iemand anders (een totaal van :giftedDollars), hoe vrijgevig!",
            'not_yet' => "Je hebt nog geen supporter tag :(",
            'valid_until' => 'Je huidige supporter tag is geldig tot :date!',
            'was_valid_until' => 'Je supporter tag was geldig tot :date.',
        ],
    ],
];
