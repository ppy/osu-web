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
        'comment_text' => 'Tämä kommentti on piilotettu.',
        'blocked_count' => 'Estetyt käyttäjät (:count)',
        'hide_profile' => 'piilota profiili',
        'hide_comment' => 'piilota',
        'forum_post_text' => 'Tämä viesti on piilotettu.',
        'not_blocked' => 'Tämä käyttäjä ei ole estetty.',
        'show_profile' => 'näytä profiili',
        'show_comment' => 'näytä',
        'too_many' => 'Estoraja saavutettu.',
        'button' => [
            'block' => 'Estä',
            'unblock' => 'poista esto',
        ],
    ],

    'card' => [
        'gift_supporter' => 'Anna tukijamerkki lahjaksi',
        'loading' => 'Ladataan...',
        'send_message' => 'Lähetä viesti',
    ],

    'create' => [
        'form' => [
            'password' => 'salasana',
            'password_confirmation' => 'salasanan vahvistus',
            'submit' => 'luo tili',
            'user_email' => 'sähköposti',
            'user_email_confirmation' => 'sähköpostivahvistus',
            'username' => 'käyttäjänimi',

            'tos_notice' => [
                '_' => 'luomalla tilin hyäksyt :link',
                'link' => 'käyttöehdot',
            ],
        ],
    ],

    'disabled' => [
        'title' => 'Jaahas. Käyttäjätilisi taitaa olla lukittu.',
        'warning' => "Jos olet rikkonut sääntöä huomaa, että yleensä on yksi kuukausi, jolloin emme ota huomioon armahduspyyntöjä. Tämän ajanjakson jälkeen voit ottaa meihin yhteyttä, jos pidät sitä tarpeellisena. Huomaa, että uusien tilien luominen sen jälkeen, kun yksi on poistettu käytöstä, johtaa <strong>  tämän kuukauden jäähdytyksen jatkamiseen </strong>. Huomaa myös, että <strong> jokaisella luomallasi tilillä rikot edelleen sääntöjä </strong>. Suosittelemme, ettet mene tätä polkua!",

        'if_mistake' => [
            '_' => 'Jos koet, että tämä on virhe, olet tervetullut ottamaan meihin yhteyttä (sähköpostilla :email tai klikkaamalla "?" tämän sivun oikeassa alareunan kulmassa). Huomioithan, että olemme aina täysin varmoja toiminnastamme, koska ne perustuvat erittäin tukeviin tietoihin. Pidätämme oikeuden jättää pyyntönne huomiotta, jos tunnemme, että olette tahallisesti epärehellisiä.',
            'email' => 'sähköposti',
        ],

        'reasons' => [
            'compromised' => 'Tilisi on katsottu vaarannetuksi. Se voidaan poistaa käytöstä väliaikaisesti, siihen asti kunnes käyttäjän henkilöllisyys on vahvistettu.',
            'opening' => 'Tässä pari mahdollista syytä tilisi lukitsemiseen:',

            'tos' => [
                '_' => 'Olet rikkonut yhtä tai useampaa :community_rules tai :tos.',
                'community_rules' => 'yhteisön sääntöä',
                'tos' => 'käyttöehtoa',
            ],
        ],
    ],

    'filtering' => [
        'by_game_mode' => 'Jäsenet pelimuodon mukaan',
    ],

    'force_reactivation' => [
        'reason' => [
            'inactive' => "Käyttäjätiliäsi ei ole käytetty pitkään aikaan.",
            'inactive_different_country' => "Käyttäjätiliäsi ei ole käytetty pitkään aikaan.",
        ],
    ],

    'login' => [
        '_' => 'Kirjaudu',
        'button' => 'Kirjaudu',
        'button_posting' => 'Kirjaudutaan...',
        'email_login_disabled' => 'Sähköpostilla kirjautuminen ei ole tällä hetkellä käytössä. Käytä sen sijaan käyttäjänimeä.',
        'failed' => 'Väärät kirjautumistiedot',
        'forgot' => 'Unohditko salasanasi?',
        'info' => 'Kirjaudu sisään jatkaaksesi',
        'invalid_captcha' => 'Liian monta epäonnistunutta kirjautumisyritystä, täytä captcha ja yritä uudelleen. (Päivitä sivu jos captcha ei ole näkyvissä)',
        'locked_ip' => 'IP-osoitteesi on lukittu. Ole hyvä ja odota muutama minuutti.',
        'password' => 'Salasana',
        'register' => "Eikö sinulla ole osu!-tiliä? Tee uusi",
        'remember' => 'Muista tämä laite',
        'title' => 'Kirjaudu sisään jatkaaksesi',
        'username' => 'Käyttäjänimi',

        'beta' => [
            'main' => 'Beta on tällä hetkellä käytössä vain siihen oikeutetuilla käyttäjillä.',
            'small' => '(osu!n tukijat tulevat kohta)',
        ],
    ],

    'ogp' => [
        'modding_description' => 'Rytmikarttoja: :counts',
        'modding_description_empty' => 'Käyttäjällä ei ole rytmikarttoja...',

        'description' => [
            '_' => 'Sijoitus (:ruleset): :global | :country',
            'country' => 'Maakohtainen :rank',
            'global' => 'Maailmanlaajuinen :rank',
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
            'cheating' => 'Huijaaminen',
            'inappropriate_chat' => '',
            'insults' => 'Loukkaa minua / muita',
            'multiple_accounts' => 'Käyttää useita tilejä',
            'nonsense' => 'Hölynpölyä',
            'other' => 'Muu (kirjoita alle)',
            'spam' => 'Spämmii',
            'unwanted_content' => 'Sopimattoman sisällön jakaminen',
        ],
    ],
    'restricted_banner' => [
        'title' => 'Tilisi on rajoitettu!',
        'message' => 'Rajoitettuna et voi olla vuorovaikutuksessa muiden pelaajien kanssa ja tuloksesi näkyvät vain itsellesi. Tämä johtuu yleensä automaattisesta prosessista ja poistuu useimmiten 24 tunnin aikana. :link',
        'message_link' => 'Katso tämä sivu saadaksesi lisätietoja.',
    ],
    'show' => [
        'age' => ':age vuotta vanha',
        'change_avatar' => 'vaihda profiilikuvasi!',
        'first_members' => 'Täällä alusta alkaen',
        'is_developer' => 'osu!n kehittäjä',
        'is_supporter' => 'osu!n tukija',
        'joined_at' => 'Liittyi: :date',
        'lastvisit' => 'Nähty viimeksi :date',
        'lastvisit_online' => 'Tällä hetkellä paikalla',
        'missingtext' => 'Taisit tehdä kirjoitusvirheen! (tai käyttäjällä on porttikielto)',
        'origin_country' => 'Maasta :country',
        'previous_usernames' => 'tunnettiin aiemmin nimellä',
        'plays_with' => 'Pelityyli: :devices',

        'comments_count' => [
            '_' => 'Julkaissut :link',
            'count' => ':count_delimited kommentin|:count_delimited kommenttia',
        ],
        'cover' => [
            'to_0' => 'Piilota kansikuva',
            'to_1' => 'Näytä kansikuva',
        ],
        'daily_challenge' => [
            'daily' => 'Päivittäinen Putki',
            'daily_streak_best' => 'Paras Päivittäinen Putki',
            'daily_streak_current' => 'Nykyinen Päivittäinen Putki',
            'playcount' => 'Osallistuminen Yhteensä',
            'title' => 'Päivittäinen\nHaaste',
            'top_10p_placements' => 'Top 10% -Sijoitukset',
            'top_50p_placements' => 'Top 50% -Sijoitukset',
            'weekly' => 'Viikoittainen putki',
            'weekly_streak_best' => 'Paras Viikoittainen Putki',
            'weekly_streak_current' => 'Nykyinen Viikoittainen Putki',

            'unit' => [
                'day' => ':valued',
                'week' => ':valuew',
            ],
        ],
        'edit' => [
            'cover' => [
                'button' => 'Muuta profiilin kansikuvaa',
                'defaults_info' => 'Lisää kansikuvavaihtoehtoja tulee olemaan saatavilla tulevaisuudessa',
                'holdover_remove_confirm' => "Edellinen valitsemasi kansikuva ei ole enää käytettävissä. Et voi valita sitä uudelleen, jos vaihdat toiseen kansikuvaan. Jatketaanko?",
                'title' => 'Kansi',

                'upload' => [
                    'broken_file' => 'Kuvan käsittely epäonnistui. Varmista lähetetty kuva ja kokeile uudestaan.',
                    'button' => 'Lataa kuva',
                    'dropzone' => 'Pudota tiedosto tähän ladataksesi',
                    'dropzone_info' => 'Voit myös lähettää kuvan pudottamalla sen tähän',
                    'size_info' => 'Kansikuvan kuuluisi olla 2400x620 pikseliä',
                    'too_large' => 'Lähetetty tiedosto on liian iso.',
                    'unsupported_format' => 'Tiedostomuotoa ei tueta.',

                    'restriction_info' => [
                        '_' => 'Kuvien lähetys käytettävissä vain :link',
                        'link' => 'osu!tukijoille',
                    ],
                ],
            ],

            'default_playmode' => [
                'is_default_tooltip' => 'oletuspelimuoto',
                'set' => 'aseta :mode: profiilin oletetuksi pelimuodoksi',
            ],

            'hue' => [
                'reset_no_supporter' => 'Palauta oletusväri? Tukijamerkki vaaditaan värin vaihtamiseen.',
                'title' => 'Väri',

                'supporter' => [
                    '_' => 'Muokatut väriteemat saatavilla vain :link',
                    'link' => 'osu!tukijat',
                ],
            ],
        ],

        'extra' => [
            'none' => 'ei mitään',
            'unranked' => 'Ei viimeaikaisia pelauksia',

            'achievements' => [
                'achieved-on' => 'Saavutuspäivä :date',
                'locked' => 'Lukittu',
                'title' => 'Saavutukset',
            ],
            'beatmaps' => [
                'by_artist' => 'artisti: :artist',
                'title' => 'Rytmikartat',

                'favourite' => [
                    'title' => 'Suosikit',
                ],
                'graveyard' => [
                    'title' => 'Haudatut rytmikartat',
                ],
                'guest' => [
                    'title' => 'Vierasyhteisön rytmikartat',
                ],
                'loved' => [
                    'title' => 'Rakastetut rytmikartat',
                ],
                'nominated' => [
                    'title' => 'Ehdollepannut rankatut rytmikartat',
                ],
                'pending' => [
                    'title' => 'Vireillä olevat rytmikartat',
                ],
                'ranked' => [
                    'title' => 'Rankatut rytmikartat',
                ],
            ],
            'discussions' => [
                'title' => 'Keskustelut',
                'title_longer' => 'Viimeaikaiset keskustelut',
                'show_more' => 'katso lisää keskusteluja',
            ],
            'events' => [
                'title' => 'Tapahtumat',
                'title_longer' => 'Viimeaikaiset tapahtumat',
                'show_more' => 'katso lisää tapahtumia',
            ],
            'historical' => [
                'title' => 'Historialliset',

                'monthly_playcounts' => [
                    'title' => 'Pelaushistoria',
                    'count_label' => 'Pelikerrat',
                ],
                'most_played' => [
                    'count' => 'pelikertoja: ',
                    'title' => 'Pelatuimmat rytmikartat',
                ],
                'recent_plays' => [
                    'accuracy' => 'tarkkuus: :percentage',
                    'title' => 'Viimeaikaiset pelaukset (24t)',
                ],
                'replays_watched_counts' => [
                    'title' => 'Uusintojen katsomishistoria',
                    'count_label' => 'Uusintoja katsottu',
                ],
            ],
            'kudosu' => [
                'recent_entries' => 'Viimeaikainen kudosuhistoria',
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
                    '_' => 'Perustuu käyttäjän tekemään vaikutukseen rytmikarttojen modauksessa. Lisätietoja :link.',
                    'link' => 'tällä sivulla',
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
            'playlists' => [
                'title' => 'Soittolistapelit',
            ],
            'posts' => [
                'title' => 'Julkaisut',
                'title_longer' => 'Viimeaikaiset julkaisut',
                'show_more' => 'katso lisää julkaisuja',
            ],
            'recent_activity' => [
                'title' => 'Viimeisimmät',
            ],
            'realtime' => [
                'title' => 'Moninpelit',
            ],
            'top_ranks' => [
                'download_replay' => 'Lataa uusinta',
                'not_ranked' => 'Vain rankatut rytmikartat myöntävät pp:tä',
                'pp_weight' => 'painotettu :percentage',
                'view_details' => 'Tarkemmat tiedot',
                'title' => 'Suoritukset',

                'best' => [
                    'title' => 'Paras suorituskyky',
                ],
                'first' => [
                    'title' => 'Kärkisijat',
                ],
                'pin' => [
                    'to_0' => 'Poista kiinnitys',
                    'to_0_done' => 'Poistettiin kiinnitetyistä',
                    'to_1' => 'Kiinnitä',
                    'to_1_done' => 'Kiinnitetty tulos',
                ],
                'pinned' => [
                    'title' => 'Kiinnitetyt tulokset',
                ],
            ],
            'votes' => [
                'given' => 'Annetut äänet (viimeiset 3 kuukautta)',
                'received' => 'Saadut äänet (viimeiset 3 kuukautta)',
                'title' => 'Äänet',
                'title_longer' => 'Viimeaikaiset äänet',
                'vote_count' => ':count_delimited ääni|:count_delimited ääntä',
            ],
            'account_standing' => [
                'title' => 'Käyttäjän tilanne',
                'bad_standing' => "<strong>:username</strong> ei ole käyttäytynyt hyvin :(",
                'remaining_silence' => '<strong>:username</strong> pystyy puhumaan seuraavan kerran :duration.',

                'recent_infringements' => [
                    'title' => 'Viimeaikaiset rikkomukset',
                    'date' => 'päivä',
                    'action' => 'toiminto',
                    'length' => 'pituus',
                    'length_indefinite' => 'Toistaiseksi',
                    'description' => 'kuvaus',
                    'actor' => 'käyttäjältä :username',

                    'actions' => [
                        'restriction' => 'Porttikielto',
                        'silence' => 'Mykistys',
                        'tournament_ban' => 'Turnauskielto',
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
            'reason_1' => 'Hän on saattanut vaihtaa käyttäjänimensä.',
            'reason_2' => 'Käyttäjätunnus voi olla tilapäisesti poissa käytöstä turvallisuussyistä tai väärinkäytön seurauksena.',
            'reason_3' => 'Teit mahdollisesti kirjoitusvirheen!',
            'reason_header' => 'Tähän on muutama mahdollinen syy:',
            'title' => 'Käyttäjää ei löytynyt! ;_;',
        ],
        'page' => [
            'button' => 'muokkaa profiilisivua',
            'description' => '<strong>minä!</strong> on henkilökohtainen alue profiilisivullasi, jota voit muokata.',
            'edit_big' => 'Muokkaa minua!',
            'placeholder' => 'Kirjoita sivun sisältö tähän',

            'restriction_info' => [
                '_' => 'Sinun täytyy olla :link avataksesi tämän ominaisuuden.',
                'link' => 'osu!n tukija',
            ],
        ],
        'post_count' => [
            '_' => 'Mukana toiminnassa :link',
            'count' => ':count_delimited foorumiviestillä|:count_delimited foorumiviestillä',
        ],
        'rank' => [
            'country' => 'Maakohtainen sijoitus pelimuodossa :mode',
            'country_simple' => 'Maakohtainen sijoitus',
            'global' => 'Maailmanlaajuinen sijoitus pelimuodossa :mode',
            'global_simple' => 'Maailmanlaajuinen sijoitus',
            'highest' => 'Korkein sija :rank oli :date',
        ],
        'season_stats' => [
            'division_top_percentage' => '',
            'total_score' => '',
        ],
        'stats' => [
            'hit_accuracy' => 'Iskutarkkuus',
            'level' => 'Taso :level',
            'level_progress' => 'edistyminen seuraavalle tasolle',
            'maximum_combo' => 'Suurin iskuputki',
            'medals' => 'Mitalit',
            'play_count' => 'Pelikertoja',
            'play_time' => 'Peliaikaa yhteensä',
            'ranked_score' => 'Tilastoidut pisteet',
            'replays_watched_by_others' => 'Muiden katsomat uusinnat',
            'score_ranks' => 'Luokitukset',
            'total_hits' => 'Osumia yhteensä',
            'total_score' => 'Pisteitä yhteensä',
            // modding stats
            'graveyard_beatmapset_count' => 'Haudatut rytmikartat',
            'loved_beatmapset_count' => 'Rakastetut rytmikartat',
            'pending_beatmapset_count' => 'Vireillä olevat rytmikartat',
            'ranked_beatmapset_count' => 'Rankatut rytmikartat',
        ],
    ],

    'silenced_banner' => [
        'title' => 'Olet hiljennetty.',
        'message' => 'Jotkin toiminnot eivät ehkä ole käytettävissä.',
    ],

    'status' => [
        'all' => 'Kaikki',
        'online' => 'Paikalla',
        'offline' => 'Ei paikalla',
    ],
    'store' => [
        'from_client' => 'rekisteröidy pelin kautta!',
        'from_web' => 'suorita rekisteröinti käyttämällä osu! nettisivua',
        'saved' => 'Käyttäjä luotu',
    ],
    'verify' => [
        'title' => 'Tilin vahvistaminen',
    ],

    'view_mode' => [
        'brick' => 'Tiilinäkymä',
        'card' => 'Korttinäkymä',
        'list' => 'Luettelonäkymä',
    ],
];
