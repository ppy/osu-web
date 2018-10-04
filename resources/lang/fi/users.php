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
            'title_most' => 'Tykkäsi eniten (viimeiset 3 kuukautta)',
        ],

        'votes_made' => [
            'title_most' => 'Eniten tykkäyksiä (viimeiset 3 kuukautta)',
        ],
    ],

    'blocks' => [
        'banner_text' => 'Olet estänyt tämän käyttäjän.',
        'blocked_count' => 'Estetyt käyttäjät (:count)',
        'hide_profile' => 'piilota profiili',
        'not_blocked' => 'Tämä käyttäjä ei ole estetty.',
        'show_profile' => 'näytä profiili',
        'too_many' => 'Estoraja saavutettu.',
        'button' => [
            'block' => 'estä',
            'unblock' => 'poista esto',
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
            'main' => 'Beta on tällä hetkellä käytössä vain siihen oikeutetuilla käyttäjillä.',
            'small' => '(osu!tukijat tulevat kohta)',
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
        'error' => 'Sinun tarvitsee olla kirjautunut tätä varten.',
    ],
    'logout_confirm' => 'Oletko varma, että haluat kirjautua ulos? :(',
    'report' => [
        'button_text' => 'raportoi',
        'comments' => 'Lisä-kommentit',
        'placeholder' => 'Anna kaikki tieto joka voisi olla kätevää.',
        'reason' => 'Syy',
        'thanks' => 'Kiitos raportistasi!',
        'title' => '',

        'actions' => [
            'send' => 'Lähetä raportti',
            'cancel' => 'Peruuta',
        ],

        'options' => [
            'cheating' => 'Väärin pelaaminen / Huijaaminen',
            'insults' => 'Haukkuu minua / muita',
            'spam' => 'Spämmii',
            'unwanted_content' => 'Linkkaa aikuismateriaalia / muuta epämukavaa materiaalia',
            'nonsense' => '',
            'other' => 'Muu (kirjoita alle)',
        ],
    ],
    'restricted_banner' => [
        'title' => 'Tilisi on rajoitettu!',
        'message' => 'Kun olet rajoitetussa tilassa, et näe muita pelaajia ja tuloksesi ovat näkyvissä vain sinulle. Tämä on yleensä automatisoitu prosessi ja poistuu useimmiten 24 tunnin sisällä. Jos haluat tehdä valituksen <a href="mailto:accounts@ppy.sh">ota yhteyttä tukeen</a>.',
    ],
    'show' => [
        'age' => ':age vuotta vanha',
        'change_avatar' => 'vaihda profiilikuvasi!',
        'first_members' => 'Täällä alusta lähtien',
        'is_developer' => 'osu!kehittäjä',
        'is_supporter' => 'Tukija',
        'joined_at' => 'Liittyi :date',
        'lastvisit' => 'Nähty viimeksi :date',
        'missingtext' => 'Taisit tehdä kirjoitusvirheen! (tai käyttäjällä on porttikielto)',
        'origin_country' => 'Maasta :country',
        'page_description' => 'osu! - Kaikki mitä olet koskaan halunnut tietää käyttäjästä :username!',
        'previous_usernames' => 'tunnettiin aiemmin nimellä',
        'plays_with' => 'Pelityylinä :devices',
        'title' => "käyttäjän :username profiili",

        'edit' => [
            'cover' => [
                'button' => 'Muuta profiilin kansikuvaa',
                'defaults_info' => 'Lisää kansikuvavaihtoehtoja tulee olemaan saatavilla tulevaisuudessa',
                'upload' => [
                    'broken_file' => 'Kuvan käsittely epäonnistui. Varmista lähetetty kuva ja kokeile uudestaan.',
                    'button' => 'Lataa kuva',
                    'dropzone' => 'Pudota tiedosto tähän ladataksesi',
                    'dropzone_info' => 'Voit myös lähettää kuvan pudottamalla sen tähän',
                    'restriction_info' => "Kuvien lähetys käytössä vain <a href='".route('store.products.show', 'supporter-tag')."'target='_blank'>vain Tukijoille</a>",
                    'size_info' => 'Kansikuvan kuuluisi olla 2000x700 pikseliä',
                    'too_large' => 'Lähetetty tiedosto on liian iso.',
                    'unsupported_format' => 'Tiedostomuotoa ei tueta.',
                ],
            ],

            'default_playmode' => [
                'is_default_tooltip' => 'oletus pelimuoto',
                'set' => 'aseta :mode: profiilin oletetuksi pelimuodoksi',
            ],
        ],

        'extra' => [
            'followers' => '1 seuraaja |:count seuraajaa',
            'unranked' => 'Ei viimeaikaisia pelauksia',

            'achievements' => [
                'title' => 'Saavutukset',
                'achieved-on' => 'Saavutuspäivä :date',
            ],
            'beatmaps' => [
                'none' => 'Ei yhtään... vielä.',
                'title' => 'Beatmapit',

                'favourite' => [
                    'title' => 'Suosikit (:count)',
                ],
                'graveyard' => [
                    'title' => 'Kuopatut (:count)',
                ],
                'loved' => [
                    'title' => 'Rakastetut beatmapit (:count)',
                ],
                'ranked_and_approved' => [
                    'title' => 'Hyväksytyt & Vahvistetut Beatmapit (:count)',
                ],
                'unranked' => [
                    'title' => 'Vireillä olevat Beatmapit (:count)',
                ],
            ],
            'historical' => [
                'empty' => 'Tuloksia ei löydy. :(',
                'title' => 'Historialliset',

                'monthly_playcounts' => [
                    'title' => 'Pelaushistoria',
                ],
                'most_played' => [
                    'count' => 'pelikertoja: ',
                    'title' => 'Pelatuimmat Beatmapit',
                ],
                'recent_plays' => [
                    'accuracy' => 'tarkkuus :percentage',
                    'title' => 'Viimeisimmät pelaukset (24h)',
                ],
                'replays_watched_counts' => [
                    'title' => 'Katsotut Uusinnat',
                ],
            ],
            'kudosu' => [
                'available' => 'Kudosua Käytettävissä',
                'available_info' => "Kudosuja voit vaihtaa kudosutähtiin, jotka auttavat tuomaan lisää huomiota beatmapillesi. Näin monta kudosua et ole vielä vaihtanut.",
                'recent_entries' => 'Viimeisimmät Kudosut',
                'title' => 'Kudosu!',
                'total' => 'Ansaittuja Kudosuja Yhteensä',
                'total_info' => 'Perustuu käyttäjän tekemään vaikutukseen beatmappien moderoinnissa. Katso <a href="'.osu_url('user.kudosu').'">tämä sivu</a> saadaksesi lisätietoja.',

                'entry' => [
                    'amount' => ':amount kudosun| :amount kudosua',
                    'empty' => "Tämä käyttäjä ei ole saanut yhtään kudosua!",

                    'beatmap_discussion' => [
                        'allow_kudosu' => [
                            'give' => 'Sai :amount modausviestin kudosuhylkäyksen kumoamisesta keskustelussa :post',
                        ],

                        'deny_kudosu' => [
                            'reset' => 'Hylkäsi :amount modausviestistä keskustelussa :post',
                        ],

                        'delete' => [
                            'reset' => 'Menetti :amount modausviestin poistamisesta keskustelussa :post',
                        ],

                        'restore' => [
                            'give' => 'Sai :amount modausviestin palauttamisesta keskustelussa :post',
                        ],

                        'vote' => [
                            'give' => 'Sai :amount modausviestissä keräämistä äänistä keskustelussa :post',
                            'reset' => 'Menetti :amount modausviestissä hävityistä äänistä keskustelussa :post',
                        ],

                        'recalculate' => [
                            'give' => 'Sai :amount modausviestissä olevien äänten uudelleenlaskennasta keskustelussa :post',
                            'reset' => 'Menetti :amount modausviestissä olevien äänten uudelleenlaskennasta keskustelussa :post',
                        ],
                    ],

                    'forum_post' => [
                        'give' => 'Sai :amount käyttäjältä :giver viestistään keskustelussa :post',
                        'reset' => 'Kudosunollaus käyttäjältä :giver keskustelussa :post',
                        'revoke' => 'Kudosuhylkäys käyttäjältä :giver keskustelussa :post',
                    ],
                ],
            ],
            'me' => [
                'title' => 'minä!',
            ],
            'medals' => [
                'empty' => "Tämä käyttäjä ei ole saanut vielä yhtäkään. ;_;",
                'title' => 'Mitalit',
            ],
            'recent_activity' => [
                'title' => 'Viimeisimmät',
            ],
            'top_ranks' => [
                'empty' => 'Loistavia suorituksia ei ole vielä. :(',
                'not_ranked' => 'Vain hyväksytyt kartat antavat PP:tä.',
                'pp' => '',
                'title' => 'Suoritukset',
                'weighted_pp' => 'painotettu: :pp (:percentage)',

                'best' => [
                    'title' => 'Parhaat Suoritukset',
                ],
                'first' => [
                    'title' => 'Kärkisijat',
                ],
            ],
            'account_standing' => [
                'title' => 'Tilin tila',
                'bad_standing' => "käyttäjä <strong>:username</strong> käyttäjä ei ole hyvällä mallilla :(",
                'remaining_silence' => '<strong>:username</strong> pystyy puhumaan seuraavan kerran :duration.',

                'recent_infringements' => [
                    'title' => 'Viimeisimmät Rikkomukset',
                    'date' => 'päivä',
                    'action' => 'toiminto',
                    'length' => 'pituus',
                    'length_permanent' => 'Ikuinen',
                    'description' => 'kuvaus',
                    'actor' => 'käyttäjältä :username',

                    'actions' => [
                        'restriction' => 'Porttikielto',
                        'silence' => 'Mykistys',
                        'note' => 'Muistutus',
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
            'reason_1' => 'Käyttäjänimi saattaa olla vaihtunut.',
            'reason_2' => 'Käyttäjä voi olla tilapaisesti poissa käytöstä tietoturvasyistä tai väärinkäytön seurauksena.',
            'reason_3' => 'Teit mahdollisesti kirjoitusvirheen!',
            'reason_header' => 'Tähän on lukuisia mahdollisia syitä:',
            'title' => 'Käyttäjää ei löytynyt! ;_;',
        ],
        'page' => [
            'description' => '<strong>Minä!</strong> on henkilökohtainen alue profiilisivullasi, jota voit muokata.',
            'edit_big' => 'Muokkaa minua!',
            'placeholder' => 'Kirjoita sivun sisältö tähän',
            'restriction_info' => "Sinun pitää olla <a href='".route('store.products.show', 'supporter-tag')."' target='_blank'> Tukija</a> avataksesi tämän toiminnon.",
        ],
        'post_count' => [
            '_' => 'Lähettänyt :link',
            'count' => ':count foorumiviestillä|:count foorumiviestillä',
        ],
        'rank' => [
            'country' => 'Maakohtainen sijoitus pelimuodossa :mode',
            'global' => 'Maailmanlaajuinen sijoitus pelimuodossa :mode',
        ],
        'stats' => [
            'hit_accuracy' => 'Tarkkuus',
            'level' => 'Taso :level',
            'maximum_combo' => 'Korkein Combo',
            'play_count' => 'Pelikertoja',
            'play_time' => 'Pelaamisaika yhteensä',
            'ranked_score' => 'Tilastopisteet',
            'replays_watched_by_others' => 'Muiden Katsomat Uusinnat',
            'score_ranks' => 'Luokitukset',
            'total_hits' => 'Osumat',
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
