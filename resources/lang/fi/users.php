<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'deleted' => '[poistettu käyttäjä]',

    'beatmapset_activities' => [
        'title' => "Käyttäjän :user modaushistoria",
        'title_compact' => 'Modaaminen',

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

    'disabled' => [
        'title' => 'Jaahas. Käyttäjätilisi taitaa olla lukittu.',
        'warning' => "",

        'if_mistake' => [
            '_' => '',
            'email' => 'sähköposti',
        ],

        'reasons' => [
            'compromised' => '',
            'opening' => 'Tässä pari mahdollista syytä tilisi lukitsemiseen',

            'tos' => [
                '_' => 'Olet rikkonut yhtä tai useampaa :community_rules tai :tos.',
                'community_rules' => 'yhteisön sääntöä',
                'tos' => 'käyttöehtoa',
            ],
        ],
    ],

    'filtering' => [
        'by_game_mode' => '',
    ],

    'force_reactivation' => [
        'reason' => [
            'inactive_different_country' => "Käyttäjätiliäsi ei ole käytetty pitkään aikaan.",
        ],
    ],

    'login' => [
        '_' => 'Kirjaudu',
        'button' => 'Kirjaudu',
        'button_posting' => 'Kirjaudutaan...',
        'email_login_disabled' => '',
        'failed' => 'Väärät kirjautumistiedot',
        'forgot' => 'Unohditko salasanasi?',
        'info' => 'Kirjaudu sisään jatkaaksesi',
        'invalid_captcha' => '',
        'locked_ip' => 'IP-osoitteesi on lukittu. Ole hyvä ja odota muutama minuutti.',
        'password' => 'Salasana',
        'register' => "Eikö sinulla ole osu!-tiliä? Tee yksi",
        'remember' => 'Muista tämä laite',
        'title' => 'Kirjaudu sisään jatkaaksesi',
        'username' => 'Käyttäjänimi',

        'beta' => [
            'main' => 'Beta on tällä hetkellä käytössä vain siihen oikeutetuilla käyttäjillä.',
            'small' => '(osu!tukijat tulevat kohta)',
        ],
    ],

    'posts' => [
        'title' => 'käyttäjän :username viestit',
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
        'title' => 'Ilmianna :username?',

        'actions' => [
            'send' => 'Lähetä raportti',
            'cancel' => 'Peruuta',
        ],

        'options' => [
            'cheating' => 'Väärin pelaaminen / Huijaaminen',
            'insults' => 'Haukkuu minua / muita',
            'spam' => 'Spämmii',
            'unwanted_content' => 'Sopimattoman sisällön jakaminen',
            'nonsense' => 'Hölynpölyä',
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
        'lastvisit_online' => 'Tällä hetkellä paikalla',
        'missingtext' => 'Taisit tehdä kirjoitusvirheen! (tai käyttäjällä on porttikielto)',
        'origin_country' => 'Maasta :country',
        'previous_usernames' => 'tunnettiin aiemmin nimellä',
        'plays_with' => 'Pelityylinä :devices',
        'title' => ":username:n profiili",

        'comments_count' => [
            '_' => '',
            'count' => '',
        ],
        'edit' => [
            'cover' => [
                'button' => 'Muuta profiilin kansikuvaa',
                'defaults_info' => 'Lisää kansikuvavaihtoehtoja tulee olemaan saatavilla tulevaisuudessa',
                'upload' => [
                    'broken_file' => 'Kuvan käsittely epäonnistui. Varmista lähetetty kuva ja kokeile uudestaan.',
                    'button' => 'Lataa kuva',
                    'dropzone' => 'Pudota tiedosto tähän ladataksesi',
                    'dropzone_info' => 'Voit myös lähettää kuvan pudottamalla sen tähän',
                    'size_info' => 'Kansikuvan kuuluisi olla 2400x620 pikseliä',
                    'too_large' => 'Lähetetty tiedosto on liian iso.',
                    'unsupported_format' => 'Tiedostomuotoa ei tueta.',

                    'restriction_info' => [
                        '_' => '',
                        'link' => '',
                    ],
                ],
            ],

            'default_playmode' => [
                'is_default_tooltip' => 'oletus pelimuoto',
                'set' => 'aseta :mode: profiilin oletetuksi pelimuodoksi',
            ],
        ],

        'extra' => [
            'none' => '',
            'unranked' => 'Ei viimeaikaisia pelejä',

            'achievements' => [
                'achieved-on' => 'Saavutuspäivä :date',
                'locked' => 'Lukittu',
                'title' => 'Saavutukset',
            ],
            'beatmaps' => [
                'by_artist' => 'artistilta :artist',
                'title' => 'Beatmapit',

                'favourite' => [
                    'title' => 'Suosikit',
                ],
                'graveyard' => [
                    'title' => 'Kuopatut',
                ],
                'loved' => [
                    'title' => 'Rakastetut beatmapit',
                ],
                'ranked_and_approved' => [
                    'title' => 'Hyväksytyt & Vahvistetut Beatmapit',
                ],
                'unranked' => [
                    'title' => 'Vireillä olevat Beatmapit',
                ],
            ],
            'discussions' => [
                'title' => 'Keskustelut',
                'title_longer' => '',
                'show_more' => '',
            ],
            'events' => [
                'title' => '',
                'title_longer' => '',
                'show_more' => '',
            ],
            'historical' => [
                'title' => 'Historialliset',

                'monthly_playcounts' => [
                    'title' => 'Pelaushistoria',
                    'count_label' => 'Pelikerrat',
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
                    'count_label' => 'Uusintoja katsottu',
                ],
            ],
            'kudosu' => [
                'recent_entries' => 'Viimeisimmät Kudosut',
                'title' => 'Kudosu!',
                'total' => 'Ansaittu Kudosu',

                'entry' => [
                    'amount' => ':amount kudosun',
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

                'total_info' => [
                    '_' => '',
                    'link' => 'tämä sivu',
                ],
            ],
            'me' => [
                'title' => 'minä!',
            ],
            'medals' => [
                'empty' => "Tämä käyttäjä ei ole saanut vielä yhtäkään. ;_;",
                'recent' => 'Viimeisin',
                'title' => 'Mitalit',
            ],
            'posts' => [
                'title' => '',
                'title_longer' => '',
                'show_more' => '',
            ],
            'recent_activity' => [
                'title' => 'Viimeisimmät',
            ],
            'top_ranks' => [
                'download_replay' => 'Lataa Replay',
                'not_ranked' => 'Vain hyväksytyt beatmapit antavat pp:tä.',
                'pp_weight' => 'painotettu :percentage',
                'view_details' => '',
                'title' => 'Suoritukset',

                'best' => [
                    'title' => 'Parhaat Suoritukset',
                ],
                'first' => [
                    'title' => 'Kärkisijat',
                ],
            ],
            'votes' => [
                'given' => '',
                'received' => '',
                'title' => '',
                'title_longer' => '',
                'vote_count' => '',
            ],
            'account_standing' => [
                'title' => 'Tilin tila',
                'bad_standing' => "<strong>:username</strong> ei ole käyttäytynyt hyvin :(",
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
            'location' => 'Tämänhetkinen sijainti',
            'occupation' => 'Ammatti',
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
            'button' => 'Muokkaa profiilisivua',
            'description' => '<strong>Minä!</strong> on henkilökohtainen alue profiilisivullasi, jota voit muokata.',
            'edit_big' => 'Muokkaa minua!',
            'placeholder' => 'Kirjoita sivun sisältö tähän',

            'restriction_info' => [
                '_' => '',
                'link' => '',
            ],
        ],
        'post_count' => [
            '_' => 'Mukana toiminnassa :link',
            'count' => ':count foorumiviestillä|:count foorumiviestillä',
        ],
        'rank' => [
            'country' => 'Maakohtainen sijoitus pelimuodossa :mode',
            'country_simple' => 'Maakohtainen sijoitus',
            'global' => 'Maailmanlaajuinen sijoitus pelimuodossa :mode',
            'global_simple' => 'Maailmanlaajuinen sijoitus',
        ],
        'stats' => [
            'hit_accuracy' => 'Tarkkuus',
            'level' => 'Taso :level',
            'level_progress' => 'Eteneminen seuraavalle tasolle',
            'maximum_combo' => 'Suurin combo',
            'medals' => 'Mitalit',
            'play_count' => 'Pelikertoja',
            'play_time' => 'Pelattu aika',
            'ranked_score' => 'Tilastoidut pisteet',
            'replays_watched_by_others' => 'Muiden Katsomat Uusinnat',
            'score_ranks' => 'Luokitukset',
            'total_hits' => 'Osumat',
            'total_score' => 'Kokonaispisteet',
            // modding stats
            'ranked_and_approved_beatmapset_count' => '',
            'loved_beatmapset_count' => '',
            'unranked_beatmapset_count' => '',
            'graveyard_beatmapset_count' => '',
        ],
    ],

    'silenced_banner' => [
        'title' => '',
        'message' => '',
    ],

    'status' => [
        'all' => 'Kaikki',
        'online' => 'Paikalla',
        'offline' => 'Poissa',
    ],
    'store' => [
        'saved' => 'Käyttäjä luotu',
    ],
    'verify' => [
        'title' => 'Tilin vahvistaminen',
    ],

    'view_mode' => [
        'brick' => '',
        'card' => '',
        'list' => '',
    ],
];
