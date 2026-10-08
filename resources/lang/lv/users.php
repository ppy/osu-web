<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'deleted' => '[dzēsts lietotājs]',

    'beatmapset_activities' => [
        'title' => ":user bītkaršu pārbaudes vēsture",
        'title_compact' => 'Bītkaršu pārbaude',

        'discussions' => [
            'title_recent' => 'Nesen sāktas diskusijas',
        ],

        'events' => [
            'title_recent' => 'Nesenie notikumi',
        ],

        'posts' => [
            'title_recent' => 'Jaunākie ieraksti',
        ],

        'votes_received' => [
            'title_most' => 'Visvairāk atzīti (3 mēnešu laikā)',
        ],

        'votes_made' => [
            'title_most' => 'Visvairāk atzīti (3 mēnešu laikā)',
        ],
    ],

    'blocks' => [
        'banner_text' => 'Jūs esiet nobloķējis šo lietotāju.',
        'comment_text' => 'Šis komentārs ir paslēpts.',
        'blocked_count' => 'bloķētie lietotāji (:count)',
        'hide_profile' => 'Slēpt profilu',
        'hide_comment' => 'paslēpt',
        'forum_post_text' => 'Šis raksts ir paslēpts.',
        'not_blocked' => 'Šis lietotājs nav bloķēts.',
        'show_profile' => 'Rādīt profilu',
        'show_comment' => 'rādīt',
        'too_many' => 'Ir sasniegts bloķēsanas limits.',
        'button' => [
            'block' => 'Bloķēt',
            'unblock' => 'Atbloķēt',
        ],
    ],

    'card' => [
        'gift_supporter' => 'Uzdāvināt supporter birku.',
        'loading' => 'Notiek ielāde...',
        'send_message' => 'nosūtīt ziņu',
    ],

    'create' => [
        'form' => [
            'password' => 'parole',
            'password_confirmation' => 'paroles apstiprināšana',
            'submit' => 'izveidot kontu',
            'user_email' => 'e-pasts',
            'user_email_confirmation' => 'e-pasta apstiprināšana',
            'username' => 'lietotājvārds',

            'tos_notice' => [
                '_' => 'izveidojot kontu, tu piekrīti :link',
                'link' => 'pakalpojumu sniegšanas noteikumi',
            ],
        ],
    ],

    'disabled' => [
        'title' => 'Ak nē! Izskatās ka tavs konts ir atslēgts.',
        'warning' => "Ja esi pārkāpis kādu noteikumu, ņem vērā, ka parasti tiek piemērots viena mēneša gaidīšanas periods, kura laikā mēs neizskatām nekādus apžēlošanas pieprasījumus. Pēc šī perioda vari ar mums sazināties, ja uzskati to par nepieciešamu. Ņem vērā, ka jaunu kontu izveide pēc tam, kad kāds no taviem kontiem ir atspējots, <strong>pagarinās šo viena mēneša nogaidīšanas periodu</strong>. Tāpat ņem vērā, ka <strong>ar katru izveidoto kontu tu turpini pārkāpt noteikumus</strong>. Mēs stingri iesakām tā nerīkoties!",

        'if_mistake' => [
            '_' => 'Ja tu domā ka tā ir kļūda, droši vari sazināties ar mums (caur :email vai uzspiežot "?" apakšējā labajā stūrī šajā lapā). Lūdzu iegaumē to ka mēs vienmēr esam ļoti pārliecināti par saviem lēmumiem, jo tie tiek balstīti uz ļoti stipru informāciju. Mums arī paliek opcija noraidīt tavu pieprasījumu, ja mums ir aizdomas, ka tu esi tīšām negodīgs.',
            'email' => 'e-pasts',
        ],

        'reasons' => [
            'compromised' => 'Tavs konts ir atzīts par uzlauztu. Tas var tikt īslaicīgi atspējots, kamēr tiek apstiprināta tā identitāte.',
            'opening' => 'Ir daudzi iesmesli, kuru rezultātā tavs konts var tikt izslēgt:',

            'tos' => [
                '_' => 'Tu esi pārkāpis vienu vai vairākus no mūsu :community_rules vai :tos.',
                'community_rules' => 'kopienas noteikumi',
                'tos' => 'lietošanas noteikumi',
            ],
        ],
    ],

    'filtering' => [
        'by_game_mode' => 'Lietotāji spēles veidā',
    ],

    'force_reactivation' => [
        'reason' => [
            'inactive' => "Tavs konts nav ilgi ticis izmantots.",
            'inactive_different_country' => "Tavs konts nav ilgi ticis izmantots.",
        ],
    ],

    'login' => [
        '_' => 'Ienākt',
        'button' => 'Ienākt',
        'button_posting' => 'Savienojas...',
        'email_login_disabled' => 'Pierakstīšanās ar e-pastu pašlaik nav iespējama. Lūdzu izmanto lietotājvārdu tā vietā.',
        'failed' => 'Nepareizi dati',
        'forgot' => 'Aizmirsāt paroli?',
        'info' => 'Lūdzu pieraksties lai turpinātu',
        'invalid_captcha' => 'Pārāk daudz neizdevušos pierakstīšanās mēģinājumu, lūdzu izpildi captcha un mēģini vēlreiz. (Atsvaidzini lapu ja captcha nav redzama)',
        'locked_ip' => 'jūsu IP adrese ir bloķēta. Lūdzu uzgaidiet pāris minūtes',
        'password' => 'Parole',
        'register' => "Nav osu! profila? Izveido jaunu",
        'remember' => 'Atcerēties šo datoru',
        'title' => 'Lūdzu, pierakstieties, lai atbildētu.',
        'username' => 'Lietotājvārds',

        'beta' => [
            'main' => 'Beta piekļuve šobrīd ir pieejama tikai privileģētiem profiliem.',
            'small' => '(osu!atbalstītāji drīz pienāks klāt)',
        ],
    ],

    'multiplayer' => [
        'index' => [
            'active' => 'Aktīvs',
            'ended' => 'Beidzies',
        ],
    ],

    'ogp' => [
        'modding_description' => 'Bītkartes :counts',
        'modding_description_empty' => 'Lietotājam nav bītkartes...',

        'description' => [
            '_' => 'Vieta (:ruleset): :global | :country',
            'country' => 'Valsts :rank',
            'global' => 'Globāli :rank',
        ],
    ],

    'posts' => [
        'title' => ':username raksti',
    ],

    'anonymous' => [
        'login_link' => 'nospiediet, lai pieslēgtos',
        'login_text' => 'ienākt',
        'username' => 'Viesis',
        'error' => 'Jums vajag pierakstīties, lai veiktu šo rīcību.',
    ],
    'logout_confirm' => 'Vai esiet pārliecināts, ka vēlaties iziet? :(',
    'report' => [
        'button_text' => 'Ziņot',
        'comments' => 'Papildus Komentāri',
        'placeholder' => 'Lūgums nodrošināt jebkādu informāciju, kas jūsuprāt būtu noderīga.',
        'reason' => 'Iemesls',
        'thanks' => 'Paldies par jūsu sūdzību!',
        'title' => 'Ziņot par :username?',

        'actions' => [
            'send' => 'Nosūtīt Sūdzību',
            'cancel' => 'Atcelt',
        ],

        'dmca' => [
            'message_1' => [
                '_' => 'Lūdzu pasūdzēties par autortiesību politiku pārkāpumu, nosūtot DMCA prasību uz :mail saskaņā ar :policy.',
                'policy' => 'osu! autortiesību politika',
            ],
            'message_2' => 'Tas attiecas uz gadījumiem, kad audio ieraksti, vizuālais saturs vai bītkartes saturs tiek izmantots bez atbilstošas atļaujas.',
        ],

        'options' => [
            'cheating' => 'Netīra spēle / Krāpšanās',
            'copyright_infringement' => 'Autortiesību pārkāpums',
            'inappropriate_chat' => 'Nepiedienīga uzvedība tērzētavā',
            'insults' => 'Mani / Citus aizvainoja',
            'multiple_accounts' => 'Izmanto vairākus kontus',
            'nonsense' => 'Bezsakars',
            'other' => 'Cits (norādīt zemāk)',
            'spam' => 'Spams',
            'unwanted_content' => 'Pievieno neatbilstošu saturu',
        ],
    ],
    'restricted_banner' => [
        'title' => 'Jūsu konts tika ierobežots!',
        'message' => 'Kamēr esiet ierobežots, jūs nevarēsiet sazināties ar citiem spēlētājiem un jūsu rezultāts būs pieejams tikai jums. Šis parasti mēdz būt rezultāts pateicoties automātiskam procesam un kas visticamāk tiks nolaists 24 stundu laikā. Ja vēlaties iesniegt apelāciju par jūsu ierobežojumu, lūgums <a href="mailto:accounts@ppy.sh">sazināties ar atbalsta komandu</a>.',
        'message_link' => 'Apskati šo lapu lai uzzinātu vairāk.',
    ],
    'show' => [
        'age' => ':age gadus vecs',
        'change_avatar' => 'mainīt sava profila attēlu!',
        'first_members' => 'Šeit kopš paša sākuma',
        'is_developer' => 'osu!izstrādātājs',
        'is_supporter' => 'osu!atbalstītājs',
        'joined_at' => 'Pievienojās :date',
        'lastvisit' => 'Pēdējoreiz manīts :date',
        'lastvisit_online' => 'Pašlaik tiešsaistē',
        'missingtext' => 'Jūs iespējams pieļāvāt rakstisku kļūdu! (vai lietotājs ir nobanots)',
        'origin_country' => 'No :country',
        'previous_usernames' => 'agrāk pazīstams kā',
        'plays_with' => 'Spēlē ar :devices',

        'comments_count' => [
            '_' => 'Publicēja :link',
            'count' => ':count_delimited komentārs|:count_delimited komentāri',
        ],
        'cover' => [
            'to_0' => 'Paslēpt pārvalku',
            'to_1' => 'Rādīt pārvalku',
        ],
        'daily_challenge' => [
            'daily' => 'Dienu ',
            'daily_streak_best' => 'Labākais Dienu ',
            'daily_streak_current' => 'Pašreizējais Dienu ',
            'playcount' => 'Kopējais piedalīšanās skaits',
            'title' => 'Ikdienas\nIzaicinājums',
            'top_10p_placements' => 'Top 10% Novietojums',
            'top_50p_placements' => 'Top 50% Novietojums',
            'weekly' => 'Nedēļu ',
            'weekly_streak_best' => 'Labākais Nedēļu ',
            'weekly_streak_current' => 'Pašreizējais Nedēļu ',

            'unit' => [
                'day' => ':valued',
                'week' => ':valuew',
            ],
        ],
        'detail_switch' => [
            'to_v1' => 'Rādīt mazāk informācijas',
            'to_v2' => 'Rādīt vairāk informācijas',
        ],
        'edit' => [
            'cover' => [
                'button' => 'Mainīt Profila Pārklāju',
                'defaults_info' => 'Vairāk pārklāja iestatījumu būs pieejami nākotnē',
                'holdover_remove_confirm' => "Iepriekš izvēlētais pārklājs vairāk nav pieejams izvēlei. Tu nevari to izvēlēties atkal, pēc tam kad esi mto nomainījis uz citu. Turpināt?",
                'title' => 'Pārklājs',

                'upload' => [
                    'broken_file' => 'Neizdevās apstrādāt bildi. Verificējiet augšupielādēto bildi un mēģiniet vēlreiz.',
                    'button' => 'Augšupielādēt bildi',
                    'dropzone' => 'Nomest šeit, lai augšupielādētu',
                    'dropzone_info' => 'Jūs variet savu bildi nomest arī šeit, lai augšupielādētu',
                    'size_info' => 'Pārklāja izmēram būtu jābūt 2400x620 lielam',
                    'too_large' => 'Augšupielādētais fails ir pārāk liels.',
                    'unsupported_format' => 'Neatbalstīts formāts.',

                    'restriction_info' => [
                        '_' => 'Augšupielāde pieejama tikai priekš :link',
                        'link' => 'osu!atbalstītāji',
                    ],
                ],
            ],

            'default_playmode' => [
                'is_default_tooltip' => 'noklusējuma spēles režīms',
                'set' => 'uzstādīt :mode kā profila noklusējuma spēles režīmu',
            ],

            'hue' => [
                'reset_no_supporter' => 'Iestatīt krāsu uz pamata krāsu? Atbalstītāja žertons būs nepieciešams, lai to nomainītu uz citu krāsu. ',
                'title' => 'Krāsa',

                'supporter' => [
                    '_' => 'Personalizējami krāsu dizaini ir pieejami tikai :link',
                    'link' => 'osu!atbalstītāji',
                ],
            ],
        ],

        'extra' => [
            'none' => 'neviens',
            'unranked' => 'Nav pēdējo izspēļu',

            'achievements' => [
                'achieved-on' => 'Sasniegts :date',
                'locked' => 'Aizslēgts',
                'title' => 'Sasniegumi',
            ],
            'beatmaps' => [
                'by_artist' => 'no :artist',
                'title' => 'Bītkarte',

                'favourite' => [
                    'title' => 'Mīļākās Bītkartes',
                ],
                'graveyard' => [
                    'title' => 'Pamestās Bītkartes',
                ],
                'guest' => [
                    'title' => 'Viesautoru bītkartes',
                ],
                'loved' => [
                    'title' => 'Mīļākās Bītkartes',
                ],
                'nominated' => [
                    'title' => 'Nominētās Rangotās Bītkartes',
                ],
                'pending' => [
                    'title' => 'Gaidošās Bītkartes',
                ],
                'ranked' => [
                    'title' => 'Rangotās Bītkartes',
                ],
            ],
            'discussions' => [
                'title' => 'Diskusijas',
                'title_longer' => 'Beidzamās Diskusijas',
                'show_more' => 'redzēt vairāk diskusiju',
            ],
            'events' => [
                'title' => 'Notikumi',
                'title_longer' => 'Beidzamie Notikumi',
                'show_more' => 'redzēt vairāk notikumu',
            ],
            'historical' => [
                'title' => 'Vēsturiski',

                'monthly_playcounts' => [
                    'title' => 'Spēļu Vēsture',
                    'count_label' => 'Spēles',
                ],
                'most_played' => [
                    'count' => 'reizes spēlēts',
                    'title' => 'Visspēlētākās Bītmapes',
                ],
                'recent_plays' => [
                    'accuracy' => 'precizitāte: :percentage',
                    'title' => 'Beidzamās Spēles (24h)',
                ],
                'replays_watched_counts' => [
                    'title' => 'Skatīto ierakstu vēsture',
                    'count_label' => 'Skatītie ieraksti',
                ],
                'score_replay_stats' => [
                    'title' => 'Visvairāk skatītie ieraksti',
                ],
            ],
            'kudosu' => [
                'recent_entries' => 'Beidzamo Kudosu Vēsture',
                'title' => 'Kudosu!',
                'total' => 'Kopā Iegūtie Kudosu',

                'entry' => [
                    'amount' => ':amount kudosu',
                    'empty' => "Šis lietotājs vēl nav saņēmis nevienu kudosu!",

                    'beatmap_discussion' => [
                        'allow_kudosu' => [
                            'give' => 'Saņēma :amount no kudosu??????????????????',
                        ],

                        'deny_kudosu' => [
                            'reset' => 'Noliedza :amount no moderācijas raksta :post',
                        ],

                        'delete' => [
                            'reset' => 'Pazaudēja :amount no moderācijas raksta izdzēšanas :post',
                        ],

                        'restore' => [
                            'give' => 'Saņēma :amount no moderācijas raksta atjaunināšanas :post',
                        ],

                        'vote' => [
                            'give' => 'Saņēma :amount no balsu saņemšanas moderācijas rakstā :post',
                            'reset' => 'Pazaudēja :amount no balsu zaudēšanas :post rakstā',
                        ],

                        'recalculate' => [
                            'give' => 'Saņēma :amount no balsu rekalkulāciias, :post raksta modificēšanā',
                            'reset' => 'Pazaudēja :amount no balsu rekalkulāciias, :post raksta modificēšanā',
                        ],
                    ],

                    'forum_post' => [
                        'give' => 'Saņēmis :amount no :giver rakstam :post',
                        'reset' => 'Kudosu atiestatīja :giver rakstam :post',
                        'revoke' => 'Noliedza kudosu :giver rakstam :post',
                    ],
                ],

                'total_info' => [
                    '_' => 'Balstīts uz lietotāja ieguldījumu bītkaršu pārbaudē. Plašāku informāciju skatiet :link.',
                    'link' => 'šī lapa',
                ],
            ],
            'me' => [
                'title' => 'Es!',
            ],
            'medals' => [
                'empty' => "Šis lietotājs nav necik saņēmis. ;_;",
                'recent' => 'Jaunākais',
                'title' => 'Medaļas',
            ],
            'playlists' => [
                'title' => 'Saraksta Spēles',
            ],
            'posts' => [
                'title' => 'Ziņas',
                'title_longer' => 'Jaunākās ziņas',
                'show_more' => 'apskatīt vairāk rakstus',
            ],
            'ranked-play' => [
                'title' => 'Rangotās spēles mači',
            ],
            'recent_activity' => [
                'title' => 'Nesenie',
            ],
            'realtime' => [
                'title' => 'Daudzspēlētāju Spēles',
            ],
            'top_ranks' => [
                'download_replay' => 'Lejupielādēt Ierakstu',
                'not_ranked' => 'Tikai rangotas bītkartes piešķir pp',
                'pp_weight' => 'nosvērti :percentage',
                'view_details' => 'Skatīt detaļas',
                'title' => 'Ranki',

                'best' => [
                    'title' => 'Labākais Sniegums',
                ],
                'first' => [
                    'title' => 'Pirmās Vietas Ranki',
                ],
                'pin' => [
                    'to_0' => 'Atspraust',
                    'to_0_done' => 'Nepiesprausts rezultāts',
                    'to_1' => 'Piespraust',
                    'to_1_done' => 'Piespraustais rezultāts',
                ],
                'pinned' => [
                    'title' => 'Piespraustie Rezultāti',
                ],
            ],
            'votes' => [
                'given' => 'Dotās balsis (beidzamos 3 mēnešus)',
                'received' => 'Saņemtās Balsis (beidzamos 3 mēnešus)',
                'title' => 'Balsis',
                'title_longer' => 'Beidzamās Balsis',
                'vote_count' => ':count_delimited balss|:count_delimited balsis',
            ],
            'account_standing' => [
                'title' => 'Konta Stāvoklis',
                'bad_standing' => "<strong>:username </strong> konts neatrodas labā stāvoklī :(",
                'remaining_silence' => '<strong>:username</strong> varēs runāt atkārtoti pēc :duration.',

                'recent_infringements' => [
                    'title' => 'Beidzamie Pārkāpumi',
                    'date' => 'datums',
                    'action' => 'darbība',
                    'length' => 'ilgums',
                    'length_indefinite' => 'Nenoteikts',
                    'description' => 'apraksts',
                    'actor' => 'no :username',

                    'actions' => [
                        'restriction' => 'Bans',
                        'silence' => 'Klusums',
                        'tournament_ban' => 'Turnīru aizliegums',
                        'note' => 'Piezīme',
                    ],
                ],
            ],
        ],

        'info' => [
            'discord' => '',
            'interests' => 'Intereses',
            'location' => 'Pašreizējā Atrašanās Vieta',
            'occupation' => 'Nodarbošanās',
            'twitter' => '',
            'website' => 'Mājaslapa',
        ],

        'matchmaking' => [
            'losses' => 'Zaudējumi',
            'plays' => 'Kopējaie mači',
            'rank' => 'Rangs',
            'rating' => 'Reitings',
            'recent_history' => 'Pēdējo maču vēsture',
            'recent_history_provisional' => '',
            'tier' => 'Līga',
            'title' => 'Rangota spēle',
            'wins' => 'Uzvaras',
        ],

        'not_found' => [
            'reason_1' => 'Meklējamais cilvēks, iespējams nomainīja savu lietotājvārdu.',
            'reason_2' => 'Konts var nebūt uz kādu laiku pieejams, drošību vai ļaunprātīgu iemeslu dēļ.',
            'reason_3' => 'Iespējams, ka esi izdarījis rakstveida kļūdu!',
            'reason_header' => 'Šim ir pāris iespējamu iemeslu:',
            'title' => 'Lietotājs nav atrasts! ;_;',
        ],
        'page' => [
            'button' => 'rediģēt profila lapu',
            'description' => '<strong>es!</strong> ir personiski rediģējams lauks tavā profila lapā.',
            'edit_big' => 'Rediģēt es!',
            'placeholder' => 'Ievadi lapas saturu šeit',

            'restriction_info' => [
                '_' => 'Tev jābūt :link, lai atvērtu šo iespēju.',
                'link' => 'osu!supporter',
            ],
        ],
        'post_count' => [
            '_' => 'Dotais ieguldījums :link',
            'count' => ':count_delimited foruma raksts|:count_delimited foruma raksti',
        ],
        'rank' => [
            'country' => 'Valsts ranks pēc :mode',
            'country_simple' => 'Valsts Pozīcijas',
            'global' => 'Globālais ranks pēc :mode',
            'global_simple' => 'Globālās Pozīcijas',
            'highest' => 'Augstākais novietojums: :rank :date',
            'kudosu_outside_top_1000' => '',
            'kudosu_simple' => '',
        ],
        'score_processing' => [
            'title' => 'Jauns zvaigžņu vērtējuma / PP algoritms ir :link.',
            'title_link' => 'tiek ieviests',
            'message' => 'Jaunākie rezultāti var netikt uzreiz atspoguļoti lietotāju profilos.',
        ],
        'season_stats' => [
            'division_top_percentage' => 'Top :value',
            'label' => 'Spotlights',
            'total_score' => 'Kopējais punktu skaits',
        ],
        'solo' => [
            'title' => 'Solo spēle',
        ],
        'stats' => [
            'hit_accuracy' => 'Trāpījuma Precizitāte',
            'hits_per_play' => 'Sitieni Katrā Mēģinājumā',
            'level' => 'Līmenis :level',
            'level_progress' => 'progress uz nākamo līmeni',
            'maximum_combo' => 'Maksimālā Kombinācija',
            'medals' => 'Medaļas',
            'play_count' => 'Spēļu skaits',
            'play_time' => 'Kopējais Spēlēšanas Laiks',
            'ranked_score' => 'Rangotie Punkti',
            'replays_watched_by_others' => 'Citu skatītie ieraksti',
            'score_ranks' => 'Punktu Reitingi',
            'total_hits' => 'Totālie sitieni',
            'total_score' => 'Totālais Punktu Skaits',
            // modding stats
            'graveyard_beatmapset_count' => 'Pamestās Bītkartes',
            'guest_beatmapset_count' => '',
            'loved_beatmapset_count' => 'Iemīlētās Bītkartes',
            'nominated_beatmapset_count' => '',
            'pending_beatmapset_count' => 'Gaidošās Bītkartes',
            'ranked_beatmapset_count' => 'Rangotās Bītkartes',
        ],
    ],

    'silenced_banner' => [
        'title' => 'Tu pašlaik esi apklusināts.',
        'message' => 'Dažas darbības iespējams var nebūt pieejamas.',
    ],

    'status' => [
        'all' => 'Viss',
        'online' => 'Pieslēdzies',
        'offline' => 'Atslēdzies',
    ],
    'store' => [
        'from_client' => 'lūdzu tā vietā reğistrējies ar spēles klijentu!',
        'from_web' => 'lūdzu pabeidz reğistrāciju izmantojot osu! mājaslapu',
        'saved' => 'Lietotājs izveidots',
    ],
    'verify' => [
        'title' => 'Konta Verifikācija',
    ],

    'view_mode' => [
        'brick' => 'Ķieğeļa skats',
        'card' => 'Profila skats',
        'list' => 'Saraksta skats',
    ],
];
