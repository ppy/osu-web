<?php

/**
 *    Copyright 2016 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed in the hopes of
 *    attracting more community contributions to the core ecosystem of osu!
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
            'error' => 'Opslaan van post mislukt',
        ],
    ],

    'discussion-votes' => [
        'update' => [
            'error' => 'Stem bijwerking mislukt',
        ],
    ],

    'discussions' => [
        'collapse' => [
            'all-collapse' => 'Sluit alles',
            'all-expand' => 'Open alles',
        ],

        'edit' => 'bewerk',
        'edited' => 'Laatst bewerkt door :editor :update_time',
        'empty' => [
            'empty' => 'Nog geen discussie!',
            'filtered' => 'Geen discussies passen bij de geselecteerde filter.',
        ],

        'message_hint' => [
            'in_general' => 'Deze post gaat naar de algemene beatmapset discussie. Om deze map te modden moet je beginning met een tijdstip (bijv. 00:12:345).',
            'in_timeline' => 'Om meerdere tijden te modden moet je meerdere keren posten (een post per tijdstip).',
        ],

        'message_placeholder' => 'Typ hier om te posten',

        'message_type' => [
            'praise' => 'Prijs',
            'problem' => 'Probleem',
            'suggestion' => 'Suggestie',
        ],

        'message_type_select' => 'Selecteer Commentaar Type',

        'mode' => [
            'general' => 'Algemeen',
            'timeline' => 'Tijdlijn',
        ],

        'require-login' => 'Log alsjeblieft in om de posten of om te beantwoorden',
        'resolved' => 'Opgelost',

        'show' => [
            'title' => 'Beatmap Discussie',
        ],

        'stats' => [
            'mine' => 'Van Mij',
            'pending' => 'Afwachtend',
            'praises' => 'Geprezen',
            'resolved' => 'Opgelost',
            'total' => 'Totaal',
        ],
    ],

    'listing' => [
        'search' => [
            'prompt' => 'typ sleutelwoorden...',
            'options' => 'Meer Zoek Opties',
            'not-found' => 'geen resultaten',
            'not-found-quote' => '... nope, niks gevonden.',
        ],
        'mode' => 'Modus',
        'status' => 'Rank Status',
        'mapped-by' => 'gemapt door :mapper',
        'source' => 'van :source',
        'load-more' => 'Laad meer...',
    ],
    'beatmapset' => [
        'show' => [
            'details' => [
                'made-by' => 'gemaakt door :user',
                'submitted' => 'ingestuurd op ',
                'ranked' => 'gerankt op ',
                'logged-out' => 'Je moet inlogged voordat je beatmaps kan downloaden!',
                'download' => [
                    'normal' => 'downloaden',
                    'direct' => 'osu!direct',
                    'no-video' => 'versie zonder video',
                ],
            ],
            'stats' => [
                'cs' => 'Circel Grootte',
                'hp' => 'HP Drain',
                'od' => 'Precisie',
                'ar' => 'Benaderingssnelheid',
                'stars' => 'Sterrenmoeilijkheid',
                'length' => 'Lengte',
                'bpm' => 'BPM',

                'chart' => [
                    'cs' => 'CS',
                    'hp' => 'HP',
                    'od' => 'OD',
                    'ar' => 'AR',
                    'sd' => 'SD',
                ],

                'source' => 'Bron',
                'tags' => 'Labels',
            ],
            'extra' => [
                'description' => [
                    'title' => 'Bescrijving',
                ],
                'success-rate' => [
                    'title' => 'Slagingspercentage',
                    'rate' => 'Slagingspercentage: :percentage%',
                    'points' => 'Faalpunten',
                    'retry' => 'Opnieuw',
                    'fail' => 'Faal',
                ],
                'scoreboard' => [
                    'title' => 'Scorebord',
                    'no-scores' => [
                        'global' => 'Nog geen scores. Miscchien moet je proberen er een paar te halen?',
                        'loading' => 'Scoren aan het laden...',
                        'country' => 'Niemand uit jouw land heeft nog een score behaald op deze map!',
                        'friend' => 'Niemand van jouw vrienden heeft nog een score behaald op deze map!',
                    ],
                    'supporter-only' => 'Je moet supporter zijn om land en vrienden rankings te zien!',
                    'supporter-link' => 'Klik <a href=":link">hier</a> om alle chique functies die je krijgt te zien!',
                    'global' => 'Globale Ranking',
                    'country' => 'Land Ranking',
                    'friend' => 'Vrienden Ranking',
                    'first' => [
                        'accuracy' => 'Precisie',
                        'score' => 'Score',
                        'count300' => '300',
                        'count100' => '100',
                        'count50' => '50',
                    ],
                    'list' => [
                        'rank-header' => 'Positie',
                        'player-header' => 'Speler',
                        'score' => 'Score',
                        'accuracy' => 'Precisie',
                    ],
                ],
            ],
        ],
    ],
    'mode' => [
        'any' => 'Alles',
        'osu' => 'osu!',
        'taiko' => 'osu!taiko',
        'fruits' => 'osu!catch',
        'mania' => 'osu!mania',
    ],
    'status' => [
        'any' => 'Alles',
        'ranked-approved' => 'Gerankt & Goedgekeurd',
        'approved' => 'Goedgekeurd',
        'faves' => 'Favorieten',
        'modreqs' => 'Mod Verzoeken',
        'pending' => 'Afwachtend',
        'graveyard' => 'Begraafplaats',
        'my-maps' => 'Mijn Mappen',
    ],
    'genre' => [
        'any' => 'Alles',
        'unspecified' => 'Niet Gespecificeerd',
        'video-game' => 'Video Game',
        'anime' => 'Anime',
        'rock' => 'Rock',
        'pop' => 'Pop',
        'other' => 'Anders',
        'novelty' => 'Novelty',
        'hip-hop' => 'Hip Hop',
        'electronic' => 'Electronic',
    ],
    'language' => [
        'any' => 'Alles',
        'english' => 'Engels',
        'chinese' => 'Chinees',
        'french' => 'Frans',
        'german' => 'Duits',
        'italian' => 'Italiaans',
        'japanese' => 'Japans',
        'korean' => 'Koreaans',
        'spanish' => 'Spaans',
        'swedish' => 'Zweeds',
        'instrumental' => 'Instrumentaal',
        'other' => 'Anders',
    ],
    'extra' => [
        'video' => 'Heeft Video',
        'storyboard' => 'Heeft Storyboard',
    ],
    'rank' => [
        'any' => 'Alles',
        'XH' => 'Zilvere SS',
        'X' => 'SS',
        'SH' => 'Zilvere S',
        'S' => 'S',
        'A' => 'A',
        'B' => 'B',
        'C' => 'C',
        'D' => 'D',
    ],
];
