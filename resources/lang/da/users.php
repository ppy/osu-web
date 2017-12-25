<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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
    'deleted' => '[slette bruger]',

    'login' => [
        '_' => 'Log ind',
        'locked_ip' => 'din IP-adresse er låst. Vent venligst et par minutter.',
        'username' => 'Brugernavn',
        'password' => 'Adgangskode',
        'button' => 'Log Ind',
        'button_posting' => 'Logger ind...',
        'remember' => 'Husk denne computer',
        'title' => 'Log venligst ind for at fortsætte',
        'failed' => 'Ugyldigt login',
        'register' => 'Har du ikke en osu! konto? Lav en ny én!',
        'forgot' => 'Glemt din adgangskode?',
        'beta' => [
            'main' => 'Adgang til betaversionen er i øjeblikket restrikteret til priveligerede brugere.',
            'small' => '(supportere ville også kunne snart)',
        ],

        'here' => 'her', // this is substituted in when generating a link above. change it to suit the language.
    ],
    'signup' => [
        '_' => 'Registrér',
    ],
    'anonymous' => [
        'login_link' => 'klik for at logge ind',
        'login_text' => 'log ind',
        'username' => 'Gæst',
        'error' => 'Du skal være logget ind for at gøre dette.',
    ],
    'logout_confirm' => 'Er du sikker på, at du vil logge ud? :(',
    'restricted_banner' => [
        'title' => 'Du konto er blevet begrænset!',
        'message' => 'Når du er begrænset, kan du ikke interagere med andre spillere, og dine scores vil kun være synlige for dig. Dette er som regel en automatisk proces, og begrænsningen vil blive fjernet indenfor 24 timer. Hvis du ønsker at appellere din begrænsning, <a href="mailto:accounts@ppy.sh">kontakt supporten</a>.',
    ],
    'show' => [
        '404' => 'Bruger ikke fundet! ;_;',
        'age' => ':age år gammel',
        'current_location' => 'Befinder sig i :location',
        'first_members' => 'Var her fra starten',
        'is_developer' => 'osu!developer',
        'is_supporter' => 'osu!supporter',
        'joined_at' => 'Deltog på :date',
        'lastvisit' => 'Sidste set på :date',
        'missingtext' => 'Du har formentlig lavet en stavefejl! (eller også er brugeren blevet bannet)',
        'origin_age' => ':age',
        'origin_country' => 'Fra :country',
        'origin_country_age' => ':age fra :country',
        'page_description' => 'osu! - Alt hvad du har brug for at vide om :username!',
        'plays_with' => 'Spiller med :devices',
        'title' => ':username ´s profil',

        'edit' => [
            'cover' => [
                'button' => 'Skift coverbillede',
                'defaults_info' => 'Flere muligheder for coverbillede kommer snart',
                'upload' => [
                    'broken_file' => 'Kunne ikke uploade billedet. Prøv igen.',
                    'button' => 'Upload billede',
                    'dropzone' => 'Smid her for at uploade',
                    'dropzone_info' => 'Du kan også smide dit billede her for at uploade',
                    'restriction_info' => "Upload er kun tilgængelig for <a href='".route('store.products.show', 'supporter-tag')."' target='_blank'>osu!supporters</a>",
                    'size_info' => 'Coverbilledet burde være 2000x700',
                    'too_large' => 'Den uploadede fil er for stor.',
                    'unsupported_format' => 'Ikke-understøttet format.',
                ],
            ],
        ],
        'extra' => [
            'followers' => '1 følger|:count følgere',
            'unranked' => 'Ingen seneste spil',

            'achievements' => [
                'title' => 'Præstationer',
                'achieved-on' => 'Opnået på :date',
            ],
            'beatmaps' => [
                'none' => 'Ingen... endnu.',
                'title' => 'Beatmaps',

                'favourite' => [
                    'title' => 'Favorit Beatmaps (:count)',
                ],
                'graveyard' => [
                    'title' => 'Beatmaps på kirkegården (:count)',
                ],
                'ranked_and_approved' => [
                    'title' => 'Ranked & Godkendte Beatmaps (:count)',
                ],
                'unranked' => [
                    'title' => 'Afventende Beatmaps (:count)',
                ],
            ],
            'historical' => [
                'empty' => 'Ingen præstationsrekorder endnu. :(',
                'most_played' => [
                    'count' => 'gange spillet',
                    'title' => 'Mest Spillede Beatmaps',
                ],
                'recent_plays' => [
                    'accuracy' => 'præcision: :percentage',
                    'title' => 'Seneste spil (24 timer)',
                ],
                'title' => 'Historisk',
            ],
            'kudosu' => [
                'available' => 'Kudosu Tilgængelig',
                'available_info' => 'Kudosu kan blive omdannet til kudosu-stjerner, som giver dine beatmaps mere opmærksomhed. Dette er antallet af kudosu, som du ikke har omdannet endnu.',
                'recent_entries' => 'Seneste Kudosu Historie',
                'title' => 'Kudosu!',
                'total' => 'Samlet Kudosu Optjent',
                'total_info' => 'Baseret på hvor stort et bidrag brugeren har givet til beatmaps. Se <a href="'.osu_url('user.kudosu').'">denne side</a> for mere information.',

                'entry' => [
                    'amount' => ':amount kudosu',
                    'empty' => 'Denne bruger har ikke modtages nogen kudosu!',

                    'beatmap_discussion' => [
                        'allow_kudosu' => [
                            'give' => 'Modtog :amount fra kudosu benægtelsesophævelse af modding opslaget :post',
                        ],

                        'deny_kudosu' => [
                            'reset' => 'Benægtet :amount fra modding opslaget :post',
                        ],

                        'delete' => [
                            'reset' => 'Mistede :amount fra sletning af modding opslag :post',
                        ],

                        'restore' => [
                            'give' => 'Modtog :amount fra modding opslag genetablering af :post',
                        ],

                        'vote' => [
                            'give' => 'Modtog :amount fra at få stemmer på modding opslaget :post',
                            'reset' => 'Mistede :amount fra at miste stemmer på modding opslaget :post',
                        ],

                        'recalculate' => [
                            'give' => 'Modtog :amount fra genberegning af stemmer i modding opslaget :post',
                            'reset' => 'Mistede :amount fra genberegning af stemmer i modding opslaget :post',
                        ],
                    ],

                    'forum_post' => [
                        'give' => 'Modtog :amount fra :giver for opslaget :post',
                        'reset' => 'Kudosu nulstillet af :giver for opslaget :post',
                        'revoke' => 'Benægtet kudosu af :giver for opslaget :post',
                    ],
                ],
            ],
            'me' => [
                'title' => 'me!',
            ],
            'medals' => [
                'empty' => 'Denne bruger har ikke fået nogle endnu. ;_;',
                'title' => 'Medaljer',
            ],
            'recent_activities' => [
                'title' => 'Seneste',
            ],
            'top_ranks' => [
                'best' => [
                    'title' => 'Bedste Præstation',
                ],
                'empty' => 'Ingen fede præstationsrekorder endnu. :(',
                'first' => [
                    'title' => 'Førerpositioner',
                ],
                'pp' => ':amountpp',
                'title' => 'Ranks',
                'weighted_pp' => 'vejede: :pp (:percentage)',
            ],
        ],
        'page' => [
            'description' => '<strong>me!</strong> er et brugerdefinerbart felt på din profilside.',
            'edit_big' => 'Ændr mig!',
            'placeholder' => 'Skriv indhold her',
            'restriction_info' => "Du skal være <a href='".route('store.products.show', 'supporter-tag')."' target='_blank'>osu!supporter</a> for at bruge denne funktion.",
        ],
        'rank' => [
            'country' => 'Landerangering for :mode',
            'global' => 'Global rangering for :mode',
        ],
        'stats' => [
            'hit_accuracy' => 'Hit Præcision',
            'level' => 'Level :level',
            'maximum_combo' => 'Højeste Combo',
            'play_count' => 'Spilantal',
            'ranked_score' => 'Ranked Score',
            'replays_watched_by_others' => 'Replays Set af Andre',
            'score_ranks' => 'Score Ranks',
            'total_hits' => 'Hits i Alt',
            'total_score' => 'Samlet Score',
        ],
    ],
    'status' => [
        'online' => 'Online',
        'offline' => 'Offline',
    ],
    'store' => [
        'saved' => 'Bruger Oprettet',
    ],
    'verify' => [
        'title' => 'Kontobekræftelse',
    ],
];
