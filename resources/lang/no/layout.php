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
    'defaults' => [
        'page_description' => 'osu! - Rytmen er bare et *klikk* unna! Med Ouendan/EBA, Taiko og originale spillmoduser, samt en fullt funskjonell nivåredigerer.',
    ],

    'menu' => [
        'home' => [
            '_' => 'hjem',
            'account-edit' => 'instillinger',
            'friends-index' => 'venner',
            'changelog-index' => 'endringslogg',
            'changelog-build' => 'versjon',
            'getDownload' => 'last ned',
            'getIcons' => 'ikoner',
            'groups-show' => 'grupper',
            'index' => 'dashbord',
            'legal-show' => 'informasjon',
            'messages-index' => 'meldinger',
            'news-index' => 'nyheter',
            'news-show' => 'nyheter',
            'password-reset-index' => 'nullstill passord',
            'search' => 'søk',
            'supportTheGame' => 'støtt spillet',
            'team' => 'lag',
        ],
        'help' => [
            '_' => 'hjelp',
            'getFaq' => 'faq',
            'getRules' => 'regler',
            'getSupport' => 'nei, virkelig, jeg trenger hjelp!',
            'getWiki' => 'wiki',
            'wiki-show' => 'wiki',
        ],
        'beatmaps' => [
            '_' => 'beatmaps',
            'artists' => 'fremhevede artister',
            'beatmap_discussion_posts-index' => 'beatmap diskusjonsinnlegg',
            'beatmap_discussions-index' => 'beatmapdiskusjoner',
            'beatmapset-watches-index' => 'modding overvåkningsliste',
            'beatmapset_discussion_votes-index' => 'beatmap diskusjons-stemmer',
            'beatmapset_events-index' => 'beatmapset hendelser',
            'index' => 'liste',
            'packs' => 'pakker',
            'show' => 'info',
        ],
        'beatmapsets' => [
            '_' => 'beatmaps',
            'discussion' => 'modding',
        ],
        'rankings' => [
            '_' => 'rangering',
            'index' => 'prestasjon',
            'performance' => 'prestasjon',
            'charts' => 'rampelyset',
            'score' => 'poengsum',
            'country' => 'land',
            'kudosu' => 'kudosu',
        ],
        'community' => [
            '_' => 'samfunnet',
            'chat' => 'chat',
            'chat-index' => 'chat',
            'dev' => 'utvikling',
            'getForum' => 'forum',
            'getLive' => 'live',
            'comments-index' => 'kommentarer',
            'comments-show' => 'kommentar',
            'contests' => 'konkurranser',
            'profile' => 'profil',
            'tournaments' => 'turneringer',
            'tournaments-index' => 'turneringer',
            'tournaments-show' => 'turneringsinfo',
            'forum-topic-watches-index' => 'abonnementer',
            'forum-topics-create' => 'forum',
            'forum-topics-show' => 'forum',
            'forum-forums-index' => 'forum',
            'forum-forums-show' => 'forum',
        ],
        'multiplayer' => [
            '_' => 'flerspiller',
            'show' => 'kamp',
        ],
        'error' => [
            '_' => 'feil',
            '404' => 'mangler',
            '403' => 'forbudt',
            '401' => 'uautorisert',
            '405' => 'mangler',
            '500' => 'noe gikk i stykker',
            '503' => 'vedlikehold',
        ],
        'user' => [
            '_' => 'bruker',
            'getLogin' => 'logg inn',
            'disabled' => 'deaktivert',

            'register' => 'registrer',
            'reset' => 'gjenopprett',
            'new' => 'ny',

            'messages' => 'Meldinger',
            'settings' => 'Innstillinger',
            'logout' => 'Logg ut',
            'help' => 'Hjelp',
            'modding-history-discussions' => 'brukermoddings-diskusjoner',
            'modding-history-events' => 'brukermoddings-hendelser',
            'modding-history-index' => 'brukermoddings-historikk',
            'modding-history-posts' => 'brukermoddings-innlegg',
            'modding-history-votesGiven' => 'brukermoddingsstemmer gitt',
            'modding-history-votesReceived' => 'brukermoddingsstemmer mottatt',
        ],
        'store' => [
            '_' => 'butikk',
            'checkout-show' => 'utsjekking',
            'getListing' => 'katalog',
            'cart-show' => 'handlekurv',

            'getCheckout' => 'utsjekking',
            'getInvoice' => 'faktura',
            'orders-index' => 'bestillingshistorikk',
            'products-show' => 'produkt',

            'new' => 'ny',
            'home' => 'hjem',
            'index' => 'hjem',
            'thanks' => 'takk',
        ],
        'admin-forum' => [
            '_' => '',
            'forum-covers-index' => '',
        ],
        'admin-store' => [
            '_' => '',
            'orders-index' => '',
            'orders-show' => '',
        ],
        'admin' => [
            '_' => '',
            'beatmapsets-covers' => '',
            'logs-index' => '',
            'root' => '',

            'beatmapsets' => [
                '_' => '',
                'show' => '',
            ],
        ],
    ],

    'footer' => [
        'general' => [
            '_' => 'Generelt',
            'home' => 'Hjem',
            'changelog-index' => 'Endringslogg',
            'beatmaps' => 'Beatmap Liste',
            'download' => 'Last ned osu!',
            'wiki' => 'Wiki',
        ],
        'help' => [
            '_' => 'Hjelp & Felleskap',
            'faq' => 'Ofte Stilte Spørsmål',
            'forum' => 'Brukerforum',
            'livestreams' => 'Direktesendinger',
            'report' => 'Rapportér en feil',
        ],
        'legal' => [
            '_' => 'Juridisk & Status',
            'copyright' => 'Opphavsrett (DMCA)',
            'privacy' => 'Personvern',
            'server_status' => 'Serverstatus',
            'source_code' => 'Kildekode',
            'terms' => 'Vilkår for bruk',
        ],
    ],

    'errors' => [
        '404' => [
            'error' => 'Siden mangler',
            'description' => "Beklager, men siden du forespurte er ikke her!",
        ],
        '403' => [
            'error' => "Du burde ikke være her.",
            'description' => 'Du kan derimot forsøke å gå tilbake.',
        ],
        '401' => [
            'error' => "Du burde ikke være her.",
            'description' => 'Du kan derimot forsøke å gå tilbake. Eller kanskje logge inn.',
        ],
        '405' => [
            'error' => 'Siden mangler',
            'description' => "Beklager, men siden du forespurte er ikke her!",
        ],
        '500' => [
            'error' => 'Åh nei! Noe gikk i stykker! ;_;',
            'description' => "Vi blir automatisk informert om hver feilstilling.",
        ],
        'fatal' => [
            'error' => 'Åh nei! noe gikk virkelig i stykker! ;_;',
            'description' => "Vi blir automatisk informert om hver feilstilling.",
        ],
        '503' => [
            'error' => 'Nede for vedlikehold!',
            'description' => "Vedlikehold tar vanligvis noen steder mellom 5 sekunder til 10 minutter. Hvis vi er nede lengre enn dette, se :link for mer informasjon.",
            'link' => [
                'text' => '',
                'href' => '',
            ],
        ],
        // used by sentry if it returns an error
        'reference' => "Bare i tilfelle, her er en kode du kan gi til brukerstøtte!",
    ],

    'popup_login' => [
        'login' => [
            'email' => 'e-postadresse',
            'forgot' => "Jeg har glemt kontoinformasjonen min",
            'password' => 'passord',
            'title' => 'Logg på for å fortsette',

            'error' => [
                'email' => "Brukernavn eller e-postadresse eksisterer ikke",
                'password' => 'Ugyldig passord',
            ],
        ],

        'register' => [
            'info' => "Du trenger en konto, min gode mann. Hvorfor har du ikke en allerede?",
            'title' => "Har du ikke en konto?",
        ],
    ],

    'popup_user' => [
        'links' => [
            'account-edit' => 'Innstillinger',
            'friends' => 'Venner',
            'logout' => 'Logg Ut',
            'profile' => 'Min Profil',
        ],
    ],

    'popup_search' => [
        'initial' => 'Skriv for å søke!',
        'retry' => 'Søk mislykket. Klikk for å prøve på nytt.',
    ],
];
