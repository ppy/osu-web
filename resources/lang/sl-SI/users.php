<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'deleted' => '[odstranjeni uporabnik]',

    'beatmapset_activities' => [
        'title' => "",
        'title_compact' => '',

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
        'first_members' => '',
        'is_developer' => '',
        'is_supporter' => '',
        'joined_at' => '',
        'lastvisit' => '',
        'lastvisit_online' => '',
        'missingtext' => '',
        'origin_country' => '',
        'previous_usernames' => '',
        'plays_with' => '',
        'title' => "",

        'comments_count' => [
            '_' => '',
            'count' => '',
        ],
        'cover' => [
            'to_0' => '',
            'to_1' => '',
        ],
        'edit' => [
            'cover' => [
                'button' => '',
                'defaults_info' => '',
                'upload' => [
                    'broken_file' => '',
                    'button' => '',
                    'dropzone' => '',
                    'dropzone_info' => '',
                    'size_info' => '',
                    'too_large' => '',
                    'unsupported_format' => '',

                    'restriction_info' => [
                        '_' => '',
                        'link' => '',
                    ],
                ],
            ],

            'default_playmode' => [
                'is_default_tooltip' => '',
                'set' => '',
            ],
        ],

        'extra' => [
            'none' => '',
            'unranked' => '',

            'achievements' => [
                'achieved-on' => '',
                'locked' => '',
                'title' => '',
            ],
            'beatmaps' => [
                'by_artist' => '',
                'title' => '',

                'favourite' => [
                    'title' => '',
                ],
                'graveyard' => [
                    'title' => '',
                ],
                'guest' => [
                    'title' => '',
                ],
                'loved' => [
                    'title' => '',
                ],
                'nominated' => [
                    'title' => '',
                ],
                'pending' => [
                    'title' => '',
                ],
                'ranked' => [
                    'title' => '',
                ],
            ],
            'discussions' => [
                'title' => '',
                'title_longer' => '',
                'show_more' => '',
            ],
            'events' => [
                'title' => '',
                'title_longer' => '',
                'show_more' => '',
            ],
            'historical' => [
                'title' => '',

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
                        'revoke' => '',
                    ],
                ],

                'total_info' => [
                    '_' => '',
                    'link' => '',
                ],
            ],
            'me' => [
                'title' => '',
            ],
            'medals' => [
                'empty' => "",
                'recent' => '',
                'title' => '',
            ],
            'playlists' => [
                'title' => '',
            ],
            'posts' => [
                'title' => '',
                'title_longer' => '',
                'show_more' => '',
            ],
            'recent_activity' => [
                'title' => '',
            ],
            'realtime' => [
                'title' => '',
            ],
            'top_ranks' => [
                'download_replay' => '',
                'not_ranked' => '',
                'pp_weight' => '',
                'view_details' => '',
                'title' => '',

                'best' => [
                    'title' => '',
                ],
                'first' => [
                    'title' => '',
                ],
                'pin' => [
                    'to_0' => '',
                    'to_0_done' => '',
                    'to_1' => '',
                    'to_1_done' => '',
                ],
                'pinned' => [
                    'title' => '',
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
                'title' => '',
                'bad_standing' => "",
                'remaining_silence' => '',

                'recent_infringements' => [
                    'title' => '',
                    'date' => '',
                    'action' => '',
                    'length' => '',
                    'length_permanent' => '',
                    'description' => '',
                    'actor' => '',

                    'actions' => [
                        'restriction' => '',
                        'silence' => '',
                        'tournament_ban' => '',
                        'note' => '',
                    ],
                ],
            ],
        ],

        'info' => [
            'discord' => '',
            'interests' => '',
            'location' => '',
            'occupation' => '',
            'twitter' => '',
            'website' => '',
        ],
        'not_found' => [
            'reason_1' => '',
            'reason_2' => '',
            'reason_3' => '',
            'reason_header' => '',
            'title' => '',
        ],
        'page' => [
            'button' => '',
            'description' => '',
            'edit_big' => '',
            'placeholder' => '',

            'restriction_info' => [
                '_' => '',
                'link' => '',
            ],
        ],
        'post_count' => [
            '_' => '',
            'count' => '',
        ],
        'rank' => [
            'country' => '',
            'country_simple' => '',
            'global' => '',
            'global_simple' => '',
            'highest' => '',
        ],
        'stats' => [
            'hit_accuracy' => '',
            'level' => '',
            'level_progress' => '',
            'maximum_combo' => '',
            'medals' => '',
            'play_count' => '',
            'play_time' => '',
            'ranked_score' => '',
            'replays_watched_by_others' => '',
            'score_ranks' => '',
            'total_hits' => '',
            'total_score' => '',
            // modding stats
            'graveyard_beatmapset_count' => '',
            'loved_beatmapset_count' => '',
            'pending_beatmapset_count' => '',
            'ranked_beatmapset_count' => '',
        ],
    ],

    'silenced_banner' => [
        'title' => '',
        'message' => '',
    ],

    'status' => [
        'all' => '',
        'online' => '',
        'offline' => '',
    ],
    'store' => [
        'saved' => '',
    ],
    'verify' => [
        'title' => '',
    ],

    'view_mode' => [
        'brick' => '',
        'card' => '',
        'list' => '',
    ],
];
