<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'deleted' => '[odstranjeni uporabnik]',

    'beatmapset_activities' => [
        'title' => "Zgodovina modding-a igralca :user",
        'title_compact' => 'Modding',

        'discussions' => [
            'title_recent' => 'Nedavno začete razprave',
        ],

        'events' => [
            'title_recent' => 'Nedavni dogodki',
        ],

        'posts' => [
            'title_recent' => 'Zadnje objave',
        ],

        'votes_received' => [
            'title_most' => 'Največ prejetih glasov za (v zadnjih 3 mesecih)',
        ],

        'votes_made' => [
            'title_most' => 'Največ oddanih glasov za (v zadnjih 3 mesecih)',
        ],
    ],

    'blocks' => [
        'banner_text' => 'Tega igralca si blokiral.',
        'comment_text' => 'Ta komentar je skrit.',
        'blocked_count' => 'blokirani uporabniki (:count)',
        'hide_profile' => 'Skrij profil',
        'hide_comment' => 'skrij',
        'not_blocked' => 'Ta igralec ni blokiran.',
        'show_profile' => 'Prikaži profil',
        'show_comment' => 'prikaži',
        'too_many' => 'Meja blokiranih igralcev je dosežena.',
        'button' => [
            'block' => 'Blokiraj',
            'unblock' => 'Odblokiraj',
        ],
    ],

    'card' => [
        'loading' => 'Nalaganje...',
        'send_message' => 'Pošlji sporočilo',
    ],

    'disabled' => [
        'title' => 'Oh ne! Tvoj račun je bil onemogočen.',
        'warning' => "V primeru, da si prekršil pravilo, upoštevaj, da na splošno obstaja enomesečno obdobje mirovanja, v tem času ne bomo upoštevali nobenih pomilostilnih zahtev. Po tem obdobju nas lahko kontaktiraš, če se ti zdi pomembno. Upoštevaj, da ustvarjanje novih računov kot izogib onemogočenemu računu, bo pomenilo <strong>podaljšanje tega enomesečnega mirovanja</strong>. Upoštevaj tudi, da <strong>z vsakim novim računom, nadaljno kršiš pravila</strong>. Zelo ti priporočamo, da ne greš po tej poti!",

        'if_mistake' => [
            '_' => 'Če misliš, da je to napaka, nas kontaktiraj (preko :email ali s klikom na "?" v spodnjem desnem kotu strani). Upoštevaj da smo vedno popolnoma prepričani o svojih ukrepih, saj temeljijo na zelo zanesljivih podatkih. Pridržujemo si pravico, da tvoje zahteve ne upoštevamo, če menimo, da si namerno nepošten.',
            'email' => 'e-pošta',
        ],

        'reasons' => [
            'compromised' => 'Tvoj račun je bil ogrožen. Račun je začasno onemogočen, dokler se ne potrdi njegova identiteta.',
            'opening' => 'Tvoj račun je lahko onemogočen iz več razlogov:',

            'tos' => [
                '_' => 'Kršil si enega ali več pravil naših :community_rules ali :tos.',
                'community_rules' => 'pravil skupnosti',
                'tos' => 'pogojev storitev',
            ],
        ],
    ],

    'filtering' => [
        'by_game_mode' => 'Igralci glede na igralni način',
    ],

    'force_reactivation' => [
        'reason' => [
            'inactive_different_country' => "Tvoj račun že dlje časa ni bil uporabljen.",
        ],
    ],

    'login' => [
        '_' => 'Vpiši se',
        'button' => 'Vpiši se',
        'button_posting' => 'Vpisovanje...',
        'email_login_disabled' => 'Vpis z e-poštnim naslovom je trenutno onemogočeno. Prosimo namesto tega uporabi svoje uporabniško ime.',
        'failed' => 'Nepravilen vpis',
        'forgot' => 'Si pozabil svoje geslo?',
        'info' => 'Za nadaljevanje se moraš vpisati',
        'invalid_captcha' => 'Preveč neuspešnih poskusov vpisa, izpolni captcha in poskusi znova. (Osveži stran, če captcha ni vidna)',
        'locked_ip' => 'Tvoj IP naslov je zaklenjen. Prosimo počakaj nekaj minut.',
        'password' => 'Geslo',
        'register' => "Nimaš še osu! računa? Ustvari novega",
        'remember' => 'Zapomni si ta računalnik',
        'title' => 'Za nadaljevanje se moraš vpisati',
        'username' => 'Uporabniško ime',

        'beta' => [
            'main' => 'Dostop do beta različice je trenutno omejen na uporabnike z določenimi pravicami.',
            'small' => '(osu!supporterji bodo kmalu imeli dostop)',
        ],
    ],

    'posts' => [
        'title' => 'objave igralca :username',
    ],

    'anonymous' => [
        'login_link' => 'klikni za vpis',
        'login_text' => 'vpiši se',
        'username' => 'Gost',
        'error' => 'Za to moraš biti vpisan.',
    ],
    'logout_confirm' => 'Ali si prepričan, da se želiš izpisati? :(',
    'report' => [
        'button_text' => 'Prijavi',
        'comments' => 'Komentarji',
        'placeholder' => 'Navedi vse informacije, za katere meniš, da bi lahko bile koristne.',
        'reason' => 'Razlog',
        'thanks' => 'Hvala za tvojo prijavo!',
        'title' => 'Prijavi :username?',

        'actions' => [
            'send' => 'Pošlji prijavo',
            'cancel' => 'Prekliči',
        ],

        'options' => [
            'cheating' => 'Goljufanje',
            'multiple_accounts' => 'Uporaba več računov',
            'insults' => 'Žaljenje mene / drugih',
            'spam' => 'Spammanje',
            'unwanted_content' => 'Pošiljanje neprimerne vsebine',
            'nonsense' => 'Nesmisel',
            'other' => 'Drugo (napiši spodaj)',
        ],
    ],
    'restricted_banner' => [
        'title' => 'Tvoj račun je omejen!',
        'message' => 'Med omejitvijo ne bo možna komunikacija z drugimi igralci, tvoji rezultati pa bodo vidni samo tebi. To je običajno rezultat samodejnega postopka in se običajno odpravi v 24 urah. Če se želiš pritožiti na omejitev, se obrni na <a href="mailto:accounts@ppy.sh">podporo</a>.',
    ],
    'show' => [
        'age' => ':age let',
        'change_avatar' => 'spremeni svoj avatar!',
        'first_members' => 'Tu že od samega začetka',
        'is_developer' => 'osu!razvijalec',
        'is_supporter' => 'osu!supporter',
        'joined_at' => 'Pridružil :date',
        'lastvisit' => 'Zadnje aktiven :date',
        'lastvisit_online' => 'Trenutno aktiven',
        'missingtext' => 'Morda si naredil tiskarsko napako! (ali pa je bil uporabnik banned)',
        'origin_country' => 'Iz :country',
        'previous_usernames' => 'prej znan kot',
        'plays_with' => 'Igra z :devices',
        'title' => "profil :username",

        'comments_count' => [
            '_' => 'Objavil :link',
            'count' => ':count_delimited komentar|:count_delimited komentarjev',
        ],
        'cover' => [
            'to_0' => 'Skrij naslovno sliko',
            'to_1' => 'Prikaži naslovno sliko',
        ],
        'edit' => [
            'cover' => [
                'button' => 'Spremeni naslovno sliko profila',
                'defaults_info' => 'Več možnosti za naslovne slike bo na voljo v prihodnosti',
                'upload' => [
                    'broken_file' => 'Neuspešna obdelava slike. Preveri naloženo sliko in poskusi znova.',
                    'button' => 'Naloži sliko',
                    'dropzone' => 'Spusti tukaj za nalaganje',
                    'dropzone_info' => 'Lahko tudi tukaj spustiš sliko za nalaganje',
                    'size_info' => 'Velikost naslovne slike mora biti 2400x640',
                    'too_large' => 'Naložena slika je prevelika.',
                    'unsupported_format' => 'Nepodprt format.',

                    'restriction_info' => [
                        '_' => 'Nalaganje možno le za :link',
                        'link' => 'osu!supporter-je',
                    ],
                ],
            ],

            'default_playmode' => [
                'is_default_tooltip' => 'privzeti način igre',
                'set' => 'izberi :mode kot privzeti način igre na profilu',
            ],
        ],

        'extra' => [
            'none' => 'brez',
            'unranked' => 'Ni zadnjih igranj',

            'achievements' => [
                'achieved-on' => 'Doseženo dne :date',
                'locked' => 'Zaklenjeno',
                'title' => 'Dosežki',
            ],
            'beatmaps' => [
                'by_artist' => 'od :artist',
                'title' => 'Beatmape',

                'favourite' => [
                    'title' => 'Priljubljene beatmape',
                ],
                'graveyard' => [
                    'title' => 'Graveyarded beatmape',
                ],
                'guest' => [
                    'title' => 'Beatmape s sodelovanjem gostov',
                ],
                'loved' => [
                    'title' => 'Loved beatmape',
                ],
                'nominated' => [
                    'title' => 'Nominirane rankirane beatmape',
                ],
                'pending' => [
                    'title' => 'Beatmape v teku',
                ],
                'ranked' => [
                    'title' => 'Rankirane beatmape',
                ],
            ],
            'discussions' => [
                'title' => 'Razprave',
                'title_longer' => 'Nedavne razprave',
                'show_more' => 'oglej si več razprav',
            ],
            'events' => [
                'title' => 'Dogodki',
                'title_longer' => 'Nedavni dogodki',
                'show_more' => 'prikaži več dogodkov',
            ],
            'historical' => [
                'title' => 'Zgodovina',

                'monthly_playcounts' => [
                    'title' => 'Zgodovina igranja',
                    'count_label' => 'Igranja',
                ],
                'most_played' => [
                    'count' => 'število igranj',
                    'title' => 'Največkrat igrane beatmape',
                ],
                'recent_plays' => [
                    'accuracy' => 'natančnost: :percentage',
                    'title' => 'Zadnja igranja (24h)',
                ],
                'replays_watched_counts' => [
                    'title' => 'Zgodovina gledanih replayev',
                    'count_label' => 'Gledanih replayev',
                ],
            ],
            'kudosu' => [
                'recent_entries' => 'Nedavna zgodovina Kudosu točk',
                'title' => 'Kudosu!',
                'total' => 'Skupno število zasluženih Kudosu točk',

                'entry' => [
                    'amount' => ':amount kudosu',
                    'empty' => "Ta igralec še ni prejel nobenega kudosu!",

                    'beatmap_discussion' => [
                        'allow_kudosu' => [
                            'give' => 'Prejeto :amount od kudosu zavrnitvene razveljavitve modding objave :post',
                        ],

                        'deny_kudosu' => [
                            'reset' => 'Zavrnjeno :amount od modding objave :post',
                        ],

                        'delete' => [
                            'reset' => 'Izgubljeno :amount od izbrisane modding objave :post',
                        ],

                        'restore' => [
                            'give' => 'Prejeto :amount od povrnitve modding objave :post',
                        ],

                        'vote' => [
                            'give' => 'Prejeto :amount od prejetja glasov v modding objavi :post',
                            'reset' => 'Izgubljeno :amount od izgube glasov v modding objavi :post',
                        ],

                        'recalculate' => [
                            'give' => 'Prejeto :amount od preračunanih glasov v modding objavi :post',
                            'reset' => 'Izgubljeno :amount od preračunanih glasov v modding objavi :post',
                        ],
                    ],

                    'forum_post' => [
                        'give' => 'Prejeto :amount od :giver za objavo na :post',
                        'reset' => 'Ponastavitev Kudosu točk od :giver za objavo :post',
                        'revoke' => 'Zavrnjen kudosu od :giver za objavo :post',
                    ],
                ],

                'total_info' => [
                    '_' => 'Kudosu je odvisen glede na to, koliko je igralec prispeval k moderiranju beatmap. Za več informacij glej :link.',
                    'link' => 'ta stran',
                ],
            ],
            'me' => [
                'title' => 'me!',
            ],
            'medals' => [
                'empty' => "Ta igralec še ni prejel nobene. ;_;",
                'recent' => 'Najnovejše',
                'title' => 'Medalje',
            ],
            'playlists' => [
                'title' => 'Igre s seznama predvajanja',
            ],
            'posts' => [
                'title' => 'Objave',
                'title_longer' => 'Nedavne objave',
                'show_more' => 'prikaži več objav',
            ],
            'recent_activity' => [
                'title' => 'Nedavno',
            ],
            'realtime' => [
                'title' => 'Večigralske igre',
            ],
            'top_ranks' => [
                'download_replay' => 'Prenesi replay',
                'not_ranked' => 'Samo rankirane beatmape se nagrajujejo s pp',
                'pp_weight' => 'preračunano :percentage',
                'view_details' => 'Poglej podrobnosti',
                'title' => 'Uvrstitve',

                'best' => [
                    'title' => 'Najboljša igranja',
                ],
                'first' => [
                    'title' => 'Uvrstitve na prvo mesto',
                ],
                'pin' => [
                    'to_0' => 'Odpni',
                    'to_0_done' => 'Odpeti rezultat',
                    'to_1' => 'Pripni',
                    'to_1_done' => 'Pripeti rezultat',
                ],
                'pinned' => [
                    'title' => 'Pripeti rezultati',
                ],
            ],
            'votes' => [
                'given' => 'Število oddanih glasov (v zadnjih 3 mesecih)',
                'received' => 'Prejeti glasovi (v zadnjih 3 mesecih)',
                'title' => 'Glasovi',
                'title_longer' => 'Nedavni glasovi',
                'vote_count' => ':count_delimited glas|:count_delimited glasov',
            ],
            'account_standing' => [
                'title' => 'Stanje računa',
                'bad_standing' => "Račun igralca :username ni v dobrem stanju :(",
                'remaining_silence' => ':username bo lahko spet spregovoril čez :duration.',

                'recent_infringements' => [
                    'title' => 'Zadnje kršitve',
                    'date' => 'datum',
                    'action' => 'dejanje',
                    'length' => 'trajanje',
                    'length_permanent' => 'Permanentno',
                    'description' => 'opis',
                    'actor' => 'od :username',

                    'actions' => [
                        'restriction' => 'Ban',
                        'silence' => 'Utišanje',
                        'tournament_ban' => 'Ban na turnirju',
                        'note' => 'Opomba',
                    ],
                ],
            ],
        ],

        'info' => [
            'discord' => '',
            'interests' => 'Interesi',
            'location' => 'Trenutna lokacija',
            'occupation' => 'Zasedenost',
            'twitter' => '',
            'website' => 'Spletna stran',
        ],
        'not_found' => [
            'reason_1' => 'Morda si je spremenil svoje uporabniško ime.',
            'reason_2' => 'Račun je lahko začasno nedostopen zaradi varnostnih težav ali težav z zlorabo.',
            'reason_3' => 'Morda si naredil tiskarsko napako!',
            'reason_header' => 'Razlogov za to je več:',
            'title' => 'Uporabnika ni bilo mogoče najti ;_;',
        ],
        'page' => [
            'button' => 'Uredi stran profila',
            'description' => '<strong>me!</strong> je osebno prilagodljivo območje na strani tvojega profila.',
            'edit_big' => 'Uredi me!',
            'placeholder' => 'Vnesi vsebino strani tukaj',

            'restriction_info' => [
                '_' => 'Za odklepanje te funkcije moraš biti :link.',
                'link' => 'osu!supporter',
            ],
        ],
        'post_count' => [
            '_' => 'Prispeval :link',
            'count' => ':count_delimited objavo na forumih|:count_delimited objav na forumih',
        ],
        'rank' => [
            'country' => 'Državna uvrstitev pri :mode',
            'country_simple' => 'Državna lestvica',
            'global' => 'Svetovna uvrstitev pri :mode',
            'global_simple' => 'Svetovna lestvica',
            'highest' => 'Najvišja uvrstitev: :rank dne :date',
        ],
        'stats' => [
            'hit_accuracy' => 'Natančnost',
            'level' => 'Raven: :level',
            'level_progress' => 'Do napredovanja na naslednjo raven',
            'maximum_combo' => 'Največji combo',
            'medals' => 'Medalje',
            'play_count' => 'Število igranj',
            'play_time' => 'Skupni čas igranja',
            'ranked_score' => 'Rangirana uvrstitev',
            'replays_watched_by_others' => 'Replayi, ki so jih drugi gledali',
            'score_ranks' => 'Razvrstitev po točkah',
            'total_hits' => 'Skupno udarcev',
            'total_score' => 'Skupaj točk',
            // modding stats
            'graveyard_beatmapset_count' => 'Graveyarded beatmape',
            'loved_beatmapset_count' => 'Loved beatmape',
            'pending_beatmapset_count' => 'Beatmape v teku',
            'ranked_beatmapset_count' => 'Rankirane beatmape',
        ],
    ],

    'silenced_banner' => [
        'title' => 'Trenutno si utišan.',
        'message' => 'Nekatere funkcije niso na voljo.',
    ],

    'status' => [
        'all' => 'Vse',
        'online' => 'Online',
        'offline' => 'Offline',
    ],
    'store' => [
        'saved' => 'Uporabnik ustvarjen',
    ],
    'verify' => [
        'title' => 'Verifikacija računa',
    ],

    'view_mode' => [
        'brick' => 'Prikaz z bloki',
        'card' => 'Pogled kartic',
        'list' => 'Prikaz seznama',
    ],
];
