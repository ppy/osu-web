<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'deleted' => '[ištrintas vartotojas]',

    'beatmapset_activities' => [
        'title' => ":user Taisymų Istorija",
        'title_compact' => 'Taisymai',

        'discussions' => [
            'title_recent' => 'Neseniai pradėtos diskusijos',
        ],

        'events' => [
            'title_recent' => 'Paskutiniai įvykiai',
        ],

        'posts' => [
            'title_recent' => 'Naujausi įrašai',
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
        'comment_text' => 'Šis komentaras yra paslėptas.',
        'blocked_count' => 'užblokuoti vartotojai (:count)',
        'hide_profile' => 'Slėpti profilį',
        'hide_comment' => 'slėpti',
        'forum_post_text' => 'Šis skelbimas yra paslėptas.',
        'not_blocked' => 'Šis vartotojas nėra užblokuotas.',
        'show_profile' => 'Rodyti profilį',
        'show_comment' => 'rodyti',
        'too_many' => 'Pasiektas blokavimų limitas.',
        'button' => [
            'block' => 'Užblokuoti',
            'unblock' => 'Atblokuoti',
        ],
    ],

    'card' => [
        'gift_supporter' => 'Dovanoti rėmėjo žymą',
        'loading' => 'Įkeliama...',
        'send_message' => 'Siųsti žinutę',
    ],

    'create' => [
        'form' => [
            'password' => 'slaptažodis',
            'password_confirmation' => 'slaptažodžio patvirtinimas',
            'submit' => 'kurti paskyrą',
            'user_email' => 'el. paštas',
            'user_email_confirmation' => 'el. pašto patvirtinimas',
            'username' => 'vartotojo vardas',

            'tos_notice' => [
                '_' => 'susikurdamas paskyrą jūs sutinkate su :link',
                'link' => 'paslaugų teikimo sąlygom',
            ],
        ],
    ],

    'disabled' => [
        'title' => 'O, ne! Panašu, kad jūsu paskyra buvo deaktyvuota.',
        'warning' => "Žinokite, kad taisyklės pažeidimo atveju įprastai yra vieno mėnesio nusiraminimo laikotarpis per kurį nepriimame amnestavimo prašymų. Po šio laikotarpio galite su mumis susisiekti, jei jums to reikia. Naujos paskyros susikūrimas po praeitos deaktyvavimo, lydės į <strong> šio vieno mėnesio nusiraminimo laikotarpio pratęsimą</strong>. Taip pat žinokite, <strong>kad kiekviena nauja susikurta paskyra vis labiau laužo taisykles</strong>. Mes stipriai rekomenduojame nesirinkti šio kelio!",

        'if_mistake' => [
            '_' => 'Jei manote, kad čia kažkokia klaida, galite susisiekti su mumis (per :email arba paspausdami „?“ apatiniame dešiniajame šio puslapio kampe). Prašome žinoti, kad mes visiškai tikri savo veiksmais, nes jie paremti patikimais duomenimis. Mes pasiliekame teisę nepaisyti jūsų prašymo, jei manome, kad esate sąmoningai nenuoširdus.',
            'email' => 'el. paštas',
        ],

        'reasons' => [
            'compromised' => 'Manome, kad jūsų paskyra yra pažeista. Ji galimai bus deaktyvuota iki kol patvirtinsime tapatybę.',
            'opening' => 'Egzistuoja kelios priežastys dėl kurių jūsų paskyra gali būti deaktyvuota:',

            'tos' => [
                '_' => 'Jūs sulaužėt viena ar daugiau mūsų :community_rules arba :tos.',
                'community_rules' => 'bendruomenės taisyklės',
                'tos' => 'paslaugų teikimo sąlygos',
            ],
        ],
    ],

    'filtering' => [
        'by_game_mode' => 'Nariai pagal žaidimo režimą',
    ],

    'force_reactivation' => [
        'reason' => [
            'inactive' => "Jūsų paskyra nenaudojama jau ilgą laiką.",
            'inactive_different_country' => "Jūsų paskyra buvo nenaudojama ilga laiką.",
        ],
    ],

    'login' => [
        '_' => 'Prisijungti',
        'button' => 'Prisijungti',
        'button_posting' => 'Prijungiama...',
        'email_login_disabled' => 'Prisijungimas naudojantis el. paštu išjungtas. Prašom naudoti vartotojo vardą.',
        'failed' => 'Neteisingi prisijungimo duomenys',
        'forgot' => 'Pamiršai slaptažodį?',
        'info' => 'Prisijunkite, kad tęsti',
        'invalid_captcha' => 'Per daug nesėkmingų prisijungimo bandymų, atlikite ženklų testą ir bandykite iš naujo. (Atnaujinkite puslapį, jei nėra ženklų testo)',
        'locked_ip' => 'Tavo IP adresas yra užblokuotas. Palauk porą minučių.',
        'password' => 'Slaptažodis',
        'register' => "Neturi osu! profilio? Susikurk",
        'remember' => 'Prisiminti šį kompiuterį',
        'title' => 'Norint tęsti reikia prisijungti',
        'username' => 'Vartotojo vardas',

        'beta' => [
            'main' => 'Šiuo metu beta prieiga galima tik išskirtiniams vartotojams.',
            'small' => '(osu! rėmėjai bus įleisti greitu metu)',
        ],
    ],

    'multiplayer' => [
        'index' => [
            'active' => 'Aktyvus',
            'ended' => 'Baigėsi',
        ],
    ],

    'ogp' => [
        'modding_description' => 'Beatmap\'ai: :counts',
        'modding_description_empty' => 'Vartotojas nėra sukūręs beatmap\'ų...',

        'description' => [
            '_' => 'Reitingas (:ruleset): :global | :country',
            'country' => 'Šalyje :rank',
            'global' => 'Pasaulyje :rank',
        ],
    ],

    'posts' => [
        'title' => ':username įrašai',
    ],

    'anonymous' => [
        'login_link' => 'paspauskite, kad prisijungti',
        'login_text' => 'prisijungti',
        'username' => 'Svečias',
        'error' => 'Turite būti prisijungęs norint tai padaryti.',
    ],
    'logout_confirm' => 'Ar tikrai nori atsijungti? :(',
    'report' => [
        'button_text' => 'Pranešti',
        'comments' => 'Komentarai',
        'placeholder' => 'Prašome pateikti bet kokia informacija, kuri manote, kad gali būti naudinga.',
        'reason' => 'Priežastis',
        'thanks' => 'Ačiū už jūsų pranešimą!',
        'title' => 'Pranešti apie :username?',

        'actions' => [
            'send' => 'Siųsti pranešimą',
            'cancel' => 'Atšaukti',
        ],

        'dmca' => [
            'message_1' => [
                '_' => 'Prašome pranešti apie autorinių teisių pažeidimus su DMCA skundu į :mail kaip numatyta :policy.',
                'policy' => 'osu! autorinių teisių politikoje',
            ],
            'message_2' => 'Taikoma atvejams kai garso takeliai, vizualus turinys arba beatmap\'o lygio turinys naudojamas be tinkamo leidimo.',
        ],

        'options' => [
            'cheating' => 'Sukčiavimas',
            'copyright_infringement' => 'Autorinių teisių pažeidimas',
            'inappropriate_chat' => 'Netinkamas elgesys pokalbiuose',
            'insults' => 'Įžeidinėja manę / kitus',
            'multiple_accounts' => 'Naudoja kelias paskyras',
            'nonsense' => 'Nesąmonės',
            'other' => 'Kita (nurodykite žemiau)',
            'spam' => 'Siuntinėja šlamštą',
            'unwanted_content' => 'Nuorodos į netinkamą turinį',
        ],
    ],
    'restricted_banner' => [
        'title' => 'Tavo vartotojo prieiga buvo apribota!',
        'message' => 'Kol ribotas, negalėsite sąveikauti su kitais žaidėjais ir jūsų rezultatai bus matomi tik jums. Įprastai šis apribojimas įvyksta dėl automatizuoto proceso ir yra atšaukiamas per 24 valandas. Jei norite apeliuoti šį apribojimą, prašome <a href="mailto:accounts@ppy.sh">susisiekti su pagalba</a>.',
        'message_link' => 'Peržiurėkite šį puslapį, kad sužinotumėte daugiau.',
    ],
    'show' => [
        'age' => ':age metų',
        'change_avatar' => 'pakeisti savo avatarą!',
        'first_members' => 'Čia nuo pat pradžių',
        'is_developer' => 'osu!programuotojas',
        'is_supporter' => 'osu!rėmėjas',
        'joined_at' => 'Prisijungė :date',
        'lastvisit' => 'Atsijunges jau :date',
        'lastvisit_online' => 'Prisijunges',
        'missingtext' => 'Turbūt padarei klaidą! (arba vartotojas buvo užblokuotas)',
        'origin_country' => 'Iš :country',
        'previous_usernames' => 'buvo žinomas kaip',
        'plays_with' => 'Žaidžia su :devices',

        'comments_count' => [
            '_' => 'Publikuota :link',
            'count' => ':count_delimited komentaras|:count_delimited komentarų',
        ],
        'cover' => [
            'to_0' => 'Slėpti viršelį',
            'to_1' => 'Rodyti viršelį',
        ],
        'daily_challenge' => [
            'daily' => 'Kasdieninių Įveikimų Serija',
            'daily_streak_best' => 'Didžiausia Kasdieninių Įveikimų Serija',
            'daily_streak_current' => 'Dabartinė Kasdieninių Įveikimų Serija',
            'playcount' => 'Iš Viso Dalyvauta',
            'title' => 'Kasdienis\nIššūkis',
            'top_10p_placements' => 'Top 10% Pasiekimų',
            'top_50p_placements' => 'Top 50% Pasiekimų',
            'weekly' => 'Savaitinė Įveikimų Serija',
            'weekly_streak_best' => 'Didžiausia Savaitinių Įveikimų Serija',
            'weekly_streak_current' => 'Dabartinė Savaitinių Įveikimų Serija',

            'unit' => [
                'day' => ':valued',
                'week' => ':valuew',
            ],
        ],
        'edit' => [
            'cover' => [
                'button' => 'Keisti profilio viršelį',
                'defaults_info' => 'Daugiau viršelio pasirinkimų pridėsime ateityje',
                'holdover_remove_confirm' => "Prieš tai naudotas viršelis nebėra prieinamas pasirinkimui. Nebegalite pasirinkti jo po pakeitimo į kitą viršelį. Tęsti?",
                'title' => 'Viršelis',

                'upload' => [
                    'broken_file' => 'Nepavyko apdoroti paveiksliuko. Patikrink įkeltą paveiksliuką ir mėgink dar kart.',
                    'button' => 'Įkelti paveiksliuką',
                    'dropzone' => 'Mesk čia, kad įkelti',
                    'dropzone_info' => 'Taip pat gali mesti čia, kad įkelti, paveiksliuką',
                    'size_info' => 'Viršelio dydis turėtų būti 2400x620',
                    'too_large' => 'Įkeltas failas per didelis.',
                    'unsupported_format' => 'Formatas nepalaikomas.',

                    'restriction_info' => [
                        '_' => 'Įkelti gali tik :link',
                        'link' => 'osu!rėmėjai',
                    ],
                ],
            ],

            'default_playmode' => [
                'is_default_tooltip' => 'pagrindinis žaidimo rėžimas',
                'set' => 'nustatyti :mode kaip pagrindiniu profilio žaidimo rėžimu',
            ],

            'hue' => [
                'reset_no_supporter' => 'Grąžinti numatytąją spalva? Rėmėjo žyma yra reikalinga, kad pakeisti į kitą spalvą.',
                'title' => 'Spalva',

                'supporter' => [
                    '_' => 'Spalvų pasirinkimas galimas tik :link',
                    'link' => 'osu!rėmėjai',
                ],
            ],
        ],

        'extra' => [
            'none' => 'nėra',
            'unranked' => 'Rezultatų nėra',

            'achievements' => [
                'achieved-on' => 'Pasiekta :date',
                'locked' => 'Užrakintas',
                'title' => 'Pasiekimai',
            ],
            'beatmaps' => [
                'by_artist' => ':artist',
                'title' => 'Beatmap\'ai',

                'favourite' => [
                    'title' => 'Mėgstami Beatmap\'ai',
                ],
                'graveyard' => [
                    'title' => 'Apleisti Beatmap\'ai',
                ],
                'guest' => [
                    'title' => 'Beatmap\'ai sukurti kaip svečio',
                ],
                'loved' => [
                    'title' => 'Mylimi Beatmap\'ai',
                ],
                'nominated' => [
                    'title' => 'Nominuoti Reitingavimui Beatmap\'ai',
                ],
                'pending' => [
                    'title' => 'Laukiantis Beatmap\'ai',
                ],
                'ranked' => [
                    'title' => 'Reitinguoti Beatmap\'ai',
                ],
            ],
            'discussions' => [
                'title' => 'Diskusijos',
                'title_longer' => 'Paskutinės Diskusijos',
                'show_more' => 'rodyti daugiau diskusijų',
            ],
            'events' => [
                'title' => 'Įvykiai',
                'title_longer' => 'Paskutiniai įvykiai',
                'show_more' => 'rodyti daugiau įvykių',
            ],
            'historical' => [
                'title' => 'Istorija',

                'monthly_playcounts' => [
                    'title' => 'Sužaidimų Istorija',
                    'count_label' => 'Sužaidimai',
                ],
                'most_played' => [
                    'count' => 'žaista kartų',
                    'title' => 'Daugiausiai žaisti Beatmap\'ai',
                ],
                'recent_plays' => [
                    'accuracy' => 'tikslumas: :percentage',
                    'title' => 'Nesenai žaisti (24h)',
                ],
                'replays_watched_counts' => [
                    'title' => 'Įrašų Peržiūros Istorija',
                    'count_label' => 'Įrašai Žiūrėti',
                ],
                'score_replay_stats' => [
                    'title' => '',
                ],
            ],
            'kudosu' => [
                'recent_entries' => 'Paskutinių Kudosu Istorija',
                'title' => 'Kudosu!',
                'total' => 'Visi uždirbti Kudosu',

                'entry' => [
                    'amount' => ':amount kudosu',
                    'empty' => "Naudotojas negavo nei kiek kudosu!",

                    'beatmap_discussion' => [
                        'allow_kudosu' => [
                            'give' => 'Gauta :amount už kudosu atmetimo anuliavimą taisymų įrašą tarp :post',
                        ],

                        'deny_kudosu' => [
                            'reset' => 'Atmesta :amount už taisymų įrašą :post',
                        ],

                        'delete' => [
                            'reset' => 'Prarasta :amount dėl taisymų įrašo ištrynimo iš :post',
                        ],

                        'restore' => [
                            'give' => 'Gauta :amount dėl taisymų įrašo atstatymo tarp :post',
                        ],

                        'vote' => [
                            'give' => 'Gauta :amount už gautus balsus taisymų įraše tarp :post',
                            'reset' => 'Prarasta :amount dėl prarastu balsų taisymų įraše tarp :post',
                        ],

                        'recalculate' => [
                            'give' => 'Gauta :amount dėl balsų perskaičiavimo taisymų įraše tarp :post',
                            'reset' => 'Prarasta :amount dėl balsų perskaičiavimo taisymų įraše tarp :post',
                        ],
                    ],

                    'forum_post' => [
                        'give' => 'Gauta :amount iš :giver dėl įrašo tarp :post',
                        'reset' => ':giver atstatė kudosu už įrašą tarp :post',
                        'revoke' => ':giver atmetė kudosu už įrašą tarp :post',
                    ],
                ],

                'total_info' => [
                    '_' => 'Priklauso nuo to kiek naudotojas prisidėjo prie beatmap\'ų moderavimo. Žiūrėk :link dėl tolimesnės informacijos.',
                    'link' => 'šį puslapį',
                ],
            ],
            'me' => [
                'title' => 'aš!',
            ],
            'medals' => [
                'empty' => "Šis vartotojas dar neturi. ;_;",
                'recent' => 'Naujausi',
                'title' => 'Medaliai',
            ],
            'playlists' => [
                'title' => 'Žaidimų Rinkiniai',
            ],
            'posts' => [
                'title' => 'Įrašai',
                'title_longer' => 'Paskutiniai Įrašai',
                'show_more' => 'rodyti daugiau įrašų',
            ],
            'quickplay' => [
                'title' => '',
            ],
            'recent_activity' => [
                'title' => 'Paskutinės',
            ],
            'realtime' => [
                'title' => 'Tinklo Žaidimai',
            ],
            'top_ranks' => [
                'download_replay' => 'Atsiųsti Įrašą',
                'not_ranked' => 'Tik reitinguoti beatmap\'ai duoda pp',
                'pp_weight' => 'prilygintas :percentage',
                'view_details' => 'Išsamiau',
                'title' => 'Reitingai',

                'best' => [
                    'title' => 'Geriausi Rezultatai',
                ],
                'first' => [
                    'title' => 'Pirmos vietos',
                ],
                'pin' => [
                    'to_0' => 'Atsegti',
                    'to_0_done' => 'Atsegtas rezultatas',
                    'to_1' => 'Prisegti',
                    'to_1_done' => 'Prisegtas rezultatas',
                ],
                'pinned' => [
                    'title' => 'Prisegti Rezultatai',
                ],
            ],
            'votes' => [
                'given' => 'Balsuota (paskutiniai 3 mėnesiai)',
                'received' => 'Gauta Balsų (paskutiniai 3 mėnesiai)',
                'title' => 'Balsai',
                'title_longer' => 'Paskutiniai Balsavimai',
                'vote_count' => 'Prieš:count_delimited balsas| Prieš:count_delimited balsų',
            ],
            'account_standing' => [
                'title' => 'Paskyros padėtis',
                'bad_standing' => "<strong>:username</strong> paskyra nėra geroje padėtyje :(",
                'remaining_silence' => ':username vėl galės kalbėti už :duration.',

                'recent_infringements' => [
                    'title' => 'Paskutiniai pažeidimai',
                    'date' => 'data',
                    'action' => 'veiksmai',
                    'length' => 'trukmė',
                    'length_indefinite' => 'Neribota',
                    'description' => 'aprašymas',
                    'actor' => 'nuo :username',

                    'actions' => [
                        'restriction' => 'Užblokuotas',
                        'silence' => 'Užtildytas',
                        'tournament_ban' => 'Turnyrų užblokavimas',
                        'note' => 'Pastaba',
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

        'matchmaking' => [
            'title' => '',
        ],

        'not_found' => [
            'reason_1' => 'Vartotojas greičiausiai pasikeitė savo vartotojo vardą.',
            'reason_2' => 'Vartotojas gali būti laikinai nepasiekiamas dėl saugumo arba piktnaudžiavimo.',
            'reason_3' => 'Gali būti kad padarei klaidą!',
            'reason_header' => 'Tam yra keletas galimų priežasčių:',
            'title' => 'Vartotojas nerastas! ;_;',
        ],
        'page' => [
            'button' => 'Redaguoti profilio puslapį',
            'description' => '<strong>aš!</strong> yra asmeninis prisitaikomas plotas jūsų profilio puslapyje.',
            'edit_big' => 'Redaguok manę!',
            'placeholder' => 'Rašyk puslapio turinį čia',

            'restriction_info' => [
                '_' => 'Tu turi būti :link, kad atrakinti šia funkciją.',
                'link' => 'osu!rėmėjas',
            ],
        ],
        'post_count' => [
            '_' => 'Indėlis :link',
            'count' => ':count_delimited forumo įrašas|:count_delimited  forumo įrašų',
        ],
        'rank' => [
            'country' => 'Šalies reitingas tarp :mode',
            'country_simple' => 'Šalies Reitingas',
            'global' => 'Pasaulinis reitingas tarp :mode',
            'global_simple' => 'Pasaulinis Reitingas',
            'highest' => 'Aukščiausias reitingas: :rank kada: :date',
        ],
        'season_stats' => [
            'division_top_percentage' => 'Top :value',
            'total_score' => 'Visi taškai',
        ],
        'stats' => [
            'hit_accuracy' => 'Paspaudimų Tikslumas',
            'hits_per_play' => 'Pataikymai Per Sužaidimą',
            'level' => 'Lygis :level',
            'level_progress' => 'Progresas į kitą lygį',
            'maximum_combo' => 'Didžiausias Kombo',
            'medals' => 'Medaliai',
            'play_count' => 'Sužaidimų Skaičius',
            'play_time' => 'Bendras žaidimo laikas
',
            'ranked_score' => 'Reitinguoti taškai',
            'replays_watched_by_others' => 'Įrašų peržiūros iš kitų',
            'score_ranks' => 'Taškų Įvertinimai',
            'total_hits' => 'Visi Pataikymai',
            'total_score' => 'Visi taškai',
            // modding stats
            'graveyard_beatmapset_count' => 'Apleisti Beatmap\'ai',
            'loved_beatmapset_count' => 'Mylimi Beatmap\'ai',
            'pending_beatmapset_count' => 'Laukiantis Beatmap\'ai',
            'ranked_beatmapset_count' => 'Reitinguoti Beatmap\'ai',
        ],
    ],

    'silenced_banner' => [
        'title' => 'Šiuo metu esi nutildytas.',
        'message' => 'Kai kurie veiksmai gali būti neprieinami.',
    ],

    'status' => [
        'all' => 'Visi',
        'online' => 'Prisijungęs',
        'offline' => 'Atsijungęs',
    ],
    'store' => [
        'from_client' => 'prašome registruotis per žaidimo klientą!',
        'from_web' => 'prašome registruotis per tinklalapį',
        'saved' => 'Naudotojas sukurtas',
    ],
    'verify' => [
        'title' => 'Paskyros Patvirtinimas',
    ],

    'view_mode' => [
        'brick' => 'Rodyti plytelėmis',
        'card' => 'Rodymas kortelėmis',
        'list' => 'Rodymas sąrašu',
    ],
];
