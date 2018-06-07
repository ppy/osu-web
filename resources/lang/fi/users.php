<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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
    'deleted' => '[poistettu käyttäjä]',

    'beatmapset_activities' => [
        'title' => "Käyttäjän :user modaushistoria",

        'discussions' => [
            'title_recent' => 'Uusimmat keskustelut',
        ],

        'events' => [
            'title_recent' => 'Viimeaikaiset tapahtumat',
        ],

        'posts' => [
            'title_recent' => 'Viimeaikaiset viestit',
        ],

        'votes_received' => [
            'title_most' => '',
        ],

        'votes_made' => [
            'title_most' => '',
        ],
    ],

    'card' => [
        'loading' => 'Ladataan...',
        'send_message' => 'lähetä viesti',
    ],

    'login' => [
        '_' => 'Kirjaudu',
        'locked_ip' => 'IP-osoitteesi on lukittu. Ole hyvä ja odota muutama minuutti.',
        'username' => 'Käyttäjänimi',
        'password' => 'Salasana',
        'button' => 'Kirjaudu',
        'button_posting' => 'Kirjaudutaan...',
        'remember' => 'Muista tämä laite',
        'title' => 'Kirjaudu sisään jatkaaksesi',
        'failed' => 'Väärät kirjautumistiedot',
        'register' => "Eikö sinulla ole osu!-tiliä? Tee yksi",
        'forgot' => 'Unohditko salasanasi?',
        'beta' => [
            'main' => '',
            'small' => '',
        ],

        'here' => 'täällä', // this is substituted in when generating a link above. change it to suit the language.
    ],

    'posts' => [
        'title' => 'käyttäjän :username viestit',
    ],

    'signup' => [
        '_' => 'Rekisteröidy',
    ],
    'anonymous' => [
        'login_link' => 'kirjaudu sisään napsauttamalla',
        'login_text' => 'kirjaudu sisään',
        'username' => 'Vieras',
        'error' => '',
    ],
    'logout_confirm' => 'Oletko varma, että haluat kirjautua ulos? :(',
    'restricted_banner' => [
        'title' => 'Tilisi on rajoitettu!',
        'message' => '',
    ],
    'show' => [
        'age' => ':age vuotta vanha',
        'change_avatar' => 'vaihda profiilikuvasi!',
        'first_members' => 'Täällä alusta lähtien',
        'is_developer' => '',
        'is_supporter' => '',
        'joined_at' => 'Liittyi :date',
        'lastvisit' => 'Viimeksi nähty :date',
        'missingtext' => '',
        'origin_age' => ':age',
        'origin_country_age' => ':age, maa: :country',
        'origin_country' => 'Maa: :country',
        'page_description' => 'osu! - Kaikki mitä olet halunnut tietää :username!',
        'previous_usernames' => 'tunnettiin aiemmin nimellä',
        'plays_with' => 'Pelaa käyttäen :devices',
        'title' => "käyttäjän :username profiili",

        'edit' => [
            'cover' => [
                'button' => 'Muuta profiilin kansikuvaa',
                'defaults_info' => 'Lisää kansikuvavaihtoehtoja tulee olemaan saatavilla tulevaisuudessa',
                'upload' => [
                    'broken_file' => '',
                    'button' => 'Lataa kuva',
                    'dropzone' => 'Pudota tiedosto tähän ladataksesi',
                    'dropzone_info' => '',
                    'restriction_info' => "".route('store.products.show', 'supporter-tag')."",
                    'size_info' => 'Kansikuvan koko pitäisi olla 2000 x 700',
                    'too_large' => 'Lähetetty tiedosto on liian iso.',
                    'unsupported_format' => 'Tiedostomuotoa ei tueta.',
                ],
            ],

            'default_playmode' => [
                'is_default_tooltip' => 'oletus pelimuoto',
                'set' => 'laita :mode oletus pelimuodoksi',
            ],
        ],

        'extra' => [
            'followers' => '',
            'unranked' => '',

            'achievements' => [
                'title' => 'Saavutukset',
                'achieved-on' => '',
            ],
            'beatmaps' => [
                'none' => 'Ei yhtään... vielä.',
                'title' => 'Rytmikartat',

                'favourite' => [
                    'title' => 'Rytmikarttasuosikit (:count)',
                ],
                'graveyard' => [
                    'title' => '',
                ],
                'loved' => [
                    'title' => '',
                ],
                'ranked_and_approved' => [
                    'title' => '',
                ],
                'unranked' => [
                    'title' => '',
                ],
            ],
            'historical' => [
                'empty' => '',
                'title' => 'Historiatiedot',

                'monthly_playcounts' => [
                    'title' => '',
                ],
                'most_played' => [
                    'count' => '',
                    'title' => '',
                ],
                'recent_plays' => [
                    'accuracy' => '',
                    'title' => '',
                ],
                'replays_watched_counts' => [
                    'title' => '',
                ],
            ],
            'kudosu' => [
                'available' => 'Kudosu:a saatavilla',
                'available_info' => "Kudosu:a voi vaihtaa kudosu tähtiin, mitkä auttavat rytmikarttaasi saamaan lisää huomiota. Tämän verran kudosua et ole vielä vaihtanut.",
                'recent_entries' => '',
                'title' => 'Kudosu!',
                'total' => 'Yhteensä Kudosu:a ansaittu',
                'total_info' => ''.osu_url('user.kudosu').'',

                'entry' => [
                    'amount' => ':amount kudosu',
                    'empty' => "Tämä käyttäjä ei ole saanut yhtään kudosu:a!",

                    'beatmap_discussion' => [
                        'allow_kudosu' => [
                            'give' => '',
                        ],

                        'deny_kudosu' => [
                            'reset' => '',
                        ],

                        'delete' => [
                            'reset' => '',
                        ],

                        'restore' => [
                            'give' => '',
                        ],

                        'vote' => [
                            'give' => '',
                            'reset' => '',
                        ],

                        'recalculate' => [
                            'give' => '',
                            'reset' => '',
                        ],
                    ],

                    'forum_post' => [
                        'give' => '',
                        'reset' => '',
                        'revoke' => '',
                    ],
                ],
            ],
            'me' => [
                'title' => 'minä!',
            ],
            'medals' => [
                'empty' => "",
                'title' => 'Mitalit',
            ],
            'recent_activity' => [
                'title' => 'Viimeaikaiset tapahtumat',
            ],
            'top_ranks' => [
                'empty' => '',
                'not_ranked' => 'Vain rankatut mapit antavat pp:tä.',
                'pp' => '',
                'title' => 'Sijoitukset',
                'weighted_pp' => '',

                'best' => [
                    'title' => 'Paras suorituskyky',
                ],
                'first' => [
                    'title' => '',
                ],
            ],
            'account_standing' => [
                'title' => 'Tilin tila',
                'bad_standing' => "",
                'remaining_silence' => '',

                'recent_infringements' => [
                    'title' => '',
                    'date' => 'päivämäärä',
                    'action' => 'toiminto',
                    'length' => 'pituus',
                    'length_permanent' => 'Ikuinen',
                    'description' => 'kuvaus',
                    'actor' => '',

                    'actions' => [
                        'restriction' => 'Porttikielto',
                        'silence' => 'Mykistys',
                        'note' => '',
                    ],
                ],
            ],
        ],
        'info' => [
            'discord' => '',
            'interests' => 'Kiinnostuksen kohteet',
            'lastfm' => 'Last.fm',
            'location' => 'Tämänhetkinen sijainti',
            'occupation' => 'Ammatti',
            'skype' => '',
            'twitter' => '',
            'website' => 'Verkkosivu',
        ],
        'not_found' => [
            'reason_1' => '',
            'reason_2' => 'Tili voi olla tilapäisesti poissa käytöstä tietoturvasyistä tai väärinkäytösten kysymyksiä.',
            'reason_3' => '',
            'reason_header' => '',
            'title' => 'Käyttäjää ei löytynyt! ;_;',
        ],
        'page' => [
            'description' => '',
            'edit_big' => 'Muokkaa minua!',
            'placeholder' => 'Kirjoita sivun sisältö tähän',
            'restriction_info' => "Sinun pitää olla <a href='".route('store.products.show', 'supporter-tag')."",
        ],
        'post_count' => [
            '_' => '',
            'count' => '',
        ],
        'rank' => [
            'country' => '',
            'global' => '',
        ],
        'stats' => [
            'hit_accuracy' => 'Osuma tarkkuus',
            'level' => 'Taso :level',
            'maximum_combo' => 'Suurin combo',
            'play_count' => 'Pelausten määrä',
            'play_time' => '',
            'ranked_score' => '',
            'replays_watched_by_others' => '',
            'score_ranks' => '',
            'total_hits' => 'Kokonaisosumat',
            'total_score' => 'Kokonaispisteet',
        ],
    ],
    'status' => [
        'online' => 'Paikalla',
        'offline' => 'Ei paikalla',
    ],
    'store' => [
        'saved' => 'Käyttäjä luotu',
    ],
    'verify' => [
        'title' => 'Tilin vahvistaminen',
    ],
];
