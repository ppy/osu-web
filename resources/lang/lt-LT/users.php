<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'deleted' => '[ištrintas vartotojas]',

    'beatmapset_activities' => [
        'title' => ":user Taisymų istorija",
        'title_compact' => '',

        'discussions' => [
            'title_recent' => 'Neseniai pradėtos diskusijos',
        ],

        'events' => [
            'title_recent' => 'Paskutiniai įvykiai',
        ],

        'posts' => [
            'title_recent' => 'Naujausios žinutės',
        ],

        'votes_received' => [
            'title_most' => 'Daugiausiai sulaukę teigiamų balsų per (paskutinius 3 mėnesius)',
        ],

        'votes_made' => [
            'title_most' => 'Daugiausiai sulaukę teigiamų balsų (paskutinius 3 mėnesius)',
        ],
    ],

    'blocks' => [
        'banner_text' => 'Jūs užblokavote šį vartotoją.',
        'blocked_count' => 'blokuoti vartotojai (:count)',
        'hide_profile' => 'slėpti profilį',
        'not_blocked' => 'Šis vartotojas nėra užblokuotas.',
        'show_profile' => 'rodyti profilį',
        'too_many' => 'Pasiektas blokavimų limitas.',
        'button' => [
            'block' => 'užblokuoti',
            'unblock' => 'atblokuoti',
        ],
    ],

    'card' => [
        'loading' => 'Įkeliama...',
        'send_message' => 'siųsti žinutę',
    ],

    'disabled' => [
        'title' => '',
        'warning' => "",

        'if_mistake' => [
            '_' => '',
            'email' => 'el. paštas',
        ],

        'reasons' => [
            'compromised' => '',
            'opening' => '',

            'tos' => [
                '_' => '',
                'community_rules' => '',
                'tos' => '',
            ],
        ],
    ],

    'filtering' => [
        'by_game_mode' => '',
    ],

    'force_reactivation' => [
        'reason' => [
            'inactive_different_country' => "",
        ],
    ],

    'login' => [
        '_' => 'Prisijungti',
        'button' => 'Prisijungti',
        'button_posting' => 'Prijungiama...',
        'email_login_disabled' => '',
        'failed' => 'Neteisingi prisijungimo duomenys',
        'forgot' => 'Pamiršai slaptažodį?',
        'info' => '',
        'invalid_captcha' => '',
        'locked_ip' => 'tavo IP adresas yra užblokuotas. Palauk porą minučių.',
        'password' => 'Slaptažodis',
        'register' => "Neturi osu! profilio? Susikurk",
        'remember' => 'Prisiminti mane šiame kompiuteryje',
        'title' => 'Norint tęsti reikia prisijungti',
        'username' => 'Vartotojo vardas',

        'beta' => [
            'main' => 'Šiuo metu beta prieiga galima tik išskirtiniams vartotojams.',
            'small' => '',
        ],
    ],

    'posts' => [
        'title' => ':username žinutės',
    ],

    'anonymous' => [
        'login_link' => 'paspauskite, jei norite prisijungti',
        'login_text' => 'prisijungti',
        'username' => 'Svečias',
        'error' => 'Turite būti prisijungęs norint tai padaryti.',
    ],
    'logout_confirm' => 'Ar tikrai nori atsijungti? :(',
    'report' => [
        'button_text' => '',
        'comments' => '',
        'placeholder' => '',
        'reason' => '',
        'thanks' => '',
        'title' => '',

        'actions' => [
            'send' => '',
            'cancel' => '',
        ],

        'options' => [
            'cheating' => '',
            'multiple_accounts' => '',
            'insults' => '',
            'spam' => '',
            'unwanted_content' => '',
            'nonsense' => '',
            'other' => '',
        ],
    ],
    'restricted_banner' => [
        'title' => 'Tavo vartotojo prieiga buvo apribota!',
        'message' => '',
    ],
    'show' => [
        'age' => ':age metų',
        'change_avatar' => 'pakeisti savo avatarą!',
        'first_members' => 'Čia nuo pat pradžių',
        'is_developer' => 'osu!programuotojas',
        'is_supporter' => 'osu!rėmėjas',
        'joined_at' => 'Prisijungė :date',
        'lastvisit' => 'Paskutinį kart matytas :date',
        'lastvisit_online' => '',
        'missingtext' => 'Turbūt padarei klaidą! (arba vartotojas buvo užblokuotas)',
        'origin_country' => 'Iš :country',
        'previous_usernames' => 'dar žinomas kaip',
        'plays_with' => 'Žaidžia su :devices',
        'title' => ":username profilis",

        'comments_count' => [
            '_' => '',
            'count' => '',
        ],
        'edit' => [
            'cover' => [
                'button' => 'Keisti profilio viršelį',
                'defaults_info' => 'Daugiau viršelio pasirinkimų pridėsime ateityje',
                'upload' => [
                    'broken_file' => 'Nepavyko apdoroti paveiksliuko. Patikrink įkeltą paveiksliuką ir mėgink dar kart.',
                    'button' => 'Įkelti paveiksliuką',
                    'dropzone' => 'Tam, kad įkelti, mesk čia',
                    'dropzone_info' => 'Taip pat gali mesti čia, kad įkelti, paveiksliuką',
                    'size_info' => 'Viršelio dydis turėtų būti 2400x620',
                    'too_large' => 'Įkeltas failas per didelis.',
                    'unsupported_format' => 'Formatas nepalaikomas.',

                    'restriction_info' => [
                        '_' => '',
                        'link' => '',
                    ],
                ],
            ],

            'default_playmode' => [
                'is_default_tooltip' => 'pagrindinis žaidimo rėžimas',
                'set' => 'nustatyti :mode kaip pagrindiniu profilio žaidimo rėžimu',
            ],
        ],

        'extra' => [
            'none' => '',
            'unranked' => 'Rezultatų nėra',

            'achievements' => [
                'achieved-on' => 'Pasiekta :date',
                'locked' => '',
                'title' => 'Pasiekimai',
            ],
            'beatmaps' => [
                'by_artist' => '',
                'title' => 'Beatmapai',

                'favourite' => [
                    'title' => 'Mėgstami Beatmapai',
                ],
                'graveyard' => [
                    'title' => 'Išmesti Beatmapai',
                ],
                'loved' => [
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
                'title' => 'Istorija',

                'monthly_playcounts' => [
                    'title' => 'Žaidimų Istorija',
                    'count_label' => '',
                ],
                'most_played' => [
                    'count' => 'žaista kartų',
                    'title' => 'Daugiausiai žaisti Beatmapai',
                ],
                'recent_plays' => [
                    'accuracy' => 'tikslumas: :percentage',
                    'title' => 'Nesenai žaisti (24h)',
                ],
                'replays_watched_counts' => [
                    'title' => 'Įrašų Peržiūros Istorija',
                    'count_label' => '',
                ],
            ],
            'kudosu' => [
                'recent_entries' => 'Paskutinių Kudosu Istorija',
                'title' => 'Kudosu!',
                'total' => 'Viso uždirbtų Kudosu',

                'entry' => [
                    'amount' => ':amount kudosu',
                    'empty' => "",

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
                'title' => 'Medaliai',
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
                'title' => 'Paskutinės',
            ],
            'realtime' => [
                'title' => '',
            ],
            'top_ranks' => [
                'download_replay' => '',
                'not_ranked' => 'Tik pripažinti beatmapai duoda pp.',
                'pp_weight' => '',
                'view_details' => '',
                'title' => 'Reitingas',

                'best' => [
                    'title' => 'Geriausi rezultatai',
                ],
                'first' => [
                    'title' => 'Pirmos vietos',
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
                'title' => 'Paskyros padėtis',
                'bad_standing' => "<strong>:username</strong> paskyra nėra geroje padėtyje :(",
                'remaining_silence' => '<strong>:username</strong> vėl galės kalbėti už :duration.',

                'recent_infringements' => [
                    'title' => 'Paskutiniai pažeidimai',
                    'date' => 'data',
                    'action' => 'veiksmai',
                    'length' => 'trukmė',
                    'length_permanent' => 'Visam laikui',
                    'description' => 'aprašymas',
                    'actor' => 'nuo :username',

                    'actions' => [
                        'restriction' => '',
                        'silence' => 'Užtildytas',
                        'note' => 'Pastabos',
                    ],
                ],
            ],
        ],

        'info' => [
            'discord' => '',
            'interests' => 'Pomėgiai',
            'location' => 'Dabartinė vieta',
            'occupation' => 'Profesija',
            'twitter' => '',
            'website' => 'Tinklalapis',
        ],
        'not_found' => [
            'reason_1' => 'Vartotojas greičiausiai pasikeitė savo vartotojo vardą.',
            'reason_2' => 'Vartotojas gali būti laikinai nepasiekiamas dėl saugumo arba piktnaudžiavimo.',
            'reason_3' => 'Gali būti kad padarei klaidą!',
            'reason_header' => 'Tam yra keletas galimų priežasčių:',
            'title' => 'Vartotojas nerastas! ;_;',
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
