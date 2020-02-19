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
            'error' => 'Opslaan van post mislukt',
        ],
    ],

    'discussion-votes' => [
        'update' => [
            'error' => 'Stem bijwerken mislukt',
        ],
    ],

    'discussions' => [
        'allow_kudosu' => 'kudosu toestaan',
        'beatmap_information' => 'Beatmap pagina',
        'delete' => 'verwijder',
        'deleted' => 'Verwijderd door :editor :delete_time.',
        'deny_kudosu' => 'kudosu ontzeggen',
        'edit' => 'bewerk',
        'edited' => 'Laatst bewerkt door :editor :update_time',
        'kudosu_denied' => 'Verkrijgen van kudosu ontkend.',
        'message_placeholder_deleted_beatmap' => 'Deze moeilijkheidsgraad is verwijderd en mag niet meer besproken worden.',
        'message_placeholder_locked' => 'Discussie voor deze beatmap is uitgeschakeld.',
        'message_type_select' => 'Selecteer Commentaartype',
        'reply_notice' => 'Druk op enter om te antwoorden.',
        'reply_placeholder' => 'Type hier je reactie',
        'require-login' => 'Log in om te posten of te antwoorden',
        'resolved' => 'Opgelost',
        'restore' => 'herstel',
        'show_deleted' => 'Toon verwijderde discussies',
        'title' => 'Discussies',

        'collapse' => [
            'all-collapse' => 'Sluit alles',
            'all-expand' => 'Open alles',
        ],

        'empty' => [
            'empty' => 'Nog geen bestaande discussie!',
            'hidden' => 'Geen discussies komen overeen met de geselecteerde filter.',
        ],

        'lock' => [
            'button' => [
                'lock' => 'Vergrendel discussie',
                'unlock' => 'Ontgrendel discussie',
            ],

            'prompt' => [
                'lock' => 'Reden voor vergrendelen',
                'unlock' => 'Weet je zeker dat je het wilt ontgrendelen?',
            ],
        ],

        'message_hint' => [
            'in_general' => 'Deze post gaat naar de algemene beatmapset discussie. Om deze map te modden moet je beginnen met een tijdstip (bijv. 00:12:345).',
            'in_timeline' => 'Om meerdere tijdstippen te modden moet je meerdere keren posten (een post per tijdstip).',
        ],

        'message_placeholder' => [
            'general' => 'Typ hier om in General te posten (:version)',
            'generalAll' => 'Typ hier om in General te posten (Alle moeilijkheden)',
            'timeline' => 'Typ hier om naar de tijdlijn te posten (:version)',
        ],

        'message_type' => [
            'disqualify' => 'Diskwalificeer',
            'hype' => 'Hype!',
            'mapper_note' => 'Opmerking',
            'nomination_reset' => 'Reset Nominatie',
            'praise' => 'Prijs',
            'problem' => 'Probleem',
            'review' => 'Recensie',
            'suggestion' => 'Suggestie',
        ],

        'mode' => [
            'events' => 'Geschiedenis',
            'general' => 'Algemeen :scope',
            'reviews' => 'Recensies',
            'timeline' => 'Tijdlijn',
            'scopes' => [
                'general' => 'Deze moeilijkheidsgraad',
                'generalAll' => 'Alle moeilijkheidsgraden',
            ],
        ],

        'new' => [
            'pin' => 'Vastzetten',
            'timestamp' => 'Tijdstip',
            'timestamp_missing' => 'ctrl+c in de bewerkmodus en plak in je bericht om een tijdstip toe te voegen!',
            'title' => 'Nieuwe Discussie',
            'unpin' => 'Losmaken',
        ],

        'show' => [
            'title' => 'Beatmapdiscussie',
        ],

        'sort' => [
            'created_at' => 'Gemaakt op',
            'timeline' => 'Tijdlijn',
            'updated_at' => 'Laatst bijgewerkt',
        ],

        'stats' => [
            'deleted' => 'Verwijderd',
            'mapper_notes' => 'Opmerkingen',
            'mine' => 'Van Mij',
            'pending' => 'Afwachtend',
            'praises' => 'Aangeprezen',
            'resolved' => 'Opgelost',
            'total' => 'Alle',
        ],

        'status-messages' => [
            'approved' => 'Deze beatmap werd goedgekeurd op :datum!',
            'graveyard' => "Deze beatmap is niet meer bijgewerkt sinds :date en is waarschijnlijk opgegeven door de maker...",
            'loved' => 'Deze map was bij de geliefde categorie toegevoegd op: datum!',
            'ranked' => 'Deze beatmap werd ranked op :date!',
            'wip' => 'Deze beatmap is gemarkeerd als work-in-progress door de maker.',
        ],

        'votes' => [
            'none' => [
                'down' => 'Nog geen downvotes',
                'up' => 'Nog geen upvotes',
            ],
            'latest' => [
                'down' => 'Laatste downvotes',
                'up' => 'Laatste upvotes',
            ],
        ],
    ],

    'hype' => [
        'button' => 'Hype Beatmap!',
        'button_done' => 'Al Gehyped!',
        'confirm' => "Weet je dat zeker? Dit zal een van je :n hypes gebruiken en kan niet ongedaan gemaakt worden.",
        'explanation' => 'Hype deze beatmap om ze zichtbaarder te maken voor nominatie en ranking!',
        'explanation_guest' => 'Log in en hype deze beatmap om ze zichtbaarder te maken voor nominatie en ranking!',
        'new_time' => "Je krijgt nog een hype :new_time.",
        'remaining' => 'Je hebt nog :remaining hype over.',
        'required_text' => 'Hype: :current/:required',
        'section_title' => 'Hype Train',
        'title' => 'Hype',
    ],

    'feedback' => [
        'button' => 'Geef Feedback',
    ],

    'nominations' => [
        'delete' => 'Verwijder',
        'delete_own_confirm' => 'Weet je het zeker? De beatmap zal worden verwijderd en je zult worden terug gestuurd naar je profiel.',
        'delete_other_confirm' => 'Weet je het zeker? De beatmap zal worden verwijderd en je zult worden terug gestuurd naar het profiel van de gebruiker.',
        'disqualification_prompt' => 'Reden voor diskwalificatie?',
        'disqualified_at' => 'Gediskwalificeerd :time_ago (:reason).',
        'disqualified_no_reason' => 'geen reden opgegeven',
        'disqualify' => 'Diskwalificeer',
        'incorrect_state' => 'Fout tijdens het uitvoeren van deze bewerking, probeer de pagina te herladen.',
        'love' => 'Love',
        'love_confirm' => 'Love deze beatmap?',
        'nominate' => 'Nomineer',
        'nominate_confirm' => 'Nomineer deze beatmap?',
        'nominated_by' => 'genomineerd door :gebruikers',
        'not_enough_hype' => "Er is niet genoeg hype.",
        'qualified' => 'Naar schatting gerankt op :date, als er geen problemen optreden.',
        'qualified_soon' => 'Naar schatting binnenkort gerankt, als er geen problemen optreden.',
        'required_text' => 'Nimonaties: :current/:required',
        'reset_message_deleted' => 'verwijderd',
        'title' => 'Nominatiestatus',
        'unresolved_issues' => 'Er zijn nog steeds onopgeloste problemen die eerst moeten worden aangepakt.',

        'reset_at' => [
            'nomination_reset' => 'Nominatieprocess :time_ago gereset door :user met nieuw probleem :discussion (:message).',
            'disqualify' => 'Gediskwalificeerd :time_ago door :user met nieuw probleem :discussion (:message).',
        ],

        'reset_confirm' => [
            'nomination_reset' => 'Weet je dat zeker? Een nieuw probleem posten zal het nominatieproces resetten.',
            'disqualify' => 'Weet je het zeker? Hierdoor zal de beatmap worden verwijderd van kwalificatie en wordt het nominatie proces gereset.',
        ],
    ],

    'listing' => [
        'search' => [
            'prompt' => 'typ sleutelwoorden in...',
            'login_required' => 'Log in om te zoeken.',
            'options' => 'Meer Zoekopties',
            'supporter_filter' => 'Filteren met :filters vereist een actieve osu!supporter tag',
            'not-found' => 'geen resultaten',
            'not-found-quote' => '... nope, niets gevonden.',
            'filters' => [
                'general' => 'Algemeen',
                'mode' => 'Mode',
                'status' => 'Categorieën',
                'genre' => 'Genre',
                'language' => 'Taal',
                'extra' => 'extra',
                'rank' => 'Rank Behaald',
                'played' => 'Gespeeld',
            ],
            'sorting' => [
                'title' => 'Titel',
                'artist' => 'Artiest',
                'difficulty' => 'Moeilijkheidsgraad',
                'favourites' => 'Favorieten',
                'updated' => 'Bijgewerkt',
                'ranked' => 'Ranked',
                'rating' => 'Beoordeling',
                'plays' => 'Keren gespeeld',
                'relevance' => 'Relevantie',
                'nominations' => 'Nominaties',
            ],
            'supporter_filter_quote' => [
                '_' => 'Filteren met :filters vereist een :link',
                'link_text' => 'osu!supporter tag',
            ],
        ],
    ],
    'general' => [
        'recommended' => 'Aanbevolen moeilijkheid',
        'converts' => 'Tel geconverteerde beatmaps mee',
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
        'approved' => 'Goedgekeurd',
        'favourites' => 'Favorieten',
        'graveyard' => 'Begraafplaats',
        'leaderboard' => 'Heeft Ranglijst',
        'loved' => 'Loved',
        'mine' => 'Mijn Mappen',
        'pending' => 'Pending & WIP',
        'qualified' => 'Gekwalificeerd',
        'ranked' => 'Ranked',
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
        'MR' => 'Mirror',
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
    'played' => [
        'any' => 'Alles',
        'played' => 'Gespeeld',
        'unplayed' => 'Ongespeeld',
    ],
    'extra' => [
        'video' => 'Heeft Video',
        'storyboard' => 'Heeft Storyboard',
    ],
    'rank' => [
        'any' => 'Alles',
        'XH' => 'Zilveren SS',
        'X' => 'SS',
        'SH' => 'Zilveren S',
        'S' => 'S',
        'A' => 'A',
        'B' => 'B',
        'C' => 'C',
        'D' => 'D',
    ],
    'panel' => [
        'playcount' => 'Speelaantal :count',
        'favourites' => 'Favorieten: :count',
    ],
];
