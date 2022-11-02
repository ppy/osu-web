<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'deleted' => '[izbrisani korisnik]',

    'beatmapset_activities' => [
        'title' => "Povijest modificiranja od :user",
        'title_compact' => 'Modificiranje',

        'discussions' => [
            'title_recent' => 'Nedavno započete rasprave',
        ],

        'events' => [
            'title_recent' => 'Nedavni događaji',
        ],

        'posts' => [
            'title_recent' => 'Novi objave',
        ],

        'votes_received' => [
            'title_most' => 'Najviše glasova (posljednja 3 mjeseca)',
        ],

        'votes_made' => [
            'title_most' => 'Najviše glasova (posljednja 3 mjeseca)',
        ],
    ],

    'blocks' => [
        'banner_text' => 'Blokirao/la si ovog korisnika.',
        'comment_text' => 'Ovaj komentar je skriven.',
        'blocked_count' => 'blokirani korisnici (:count)',
        'hide_profile' => 'Sakrij profil',
        'hide_comment' => 'sakrij',
        'not_blocked' => 'Taj korisnik nije blokiran.',
        'show_profile' => 'Prikaži profil',
        'show_comment' => 'prikaži',
        'too_many' => 'Dosegnuto je ograničenje blokiranja.',
        'button' => [
            'block' => 'Blokiraj',
            'unblock' => 'Odblokiraj',
        ],
    ],

    'card' => [
        'loading' => 'Učitavanje...',
        'send_message' => 'Pošalji poruku',
    ],

    'disabled' => [
        'title' => 'Uh oh! Čini se da je tvoj račun onemogućen.',
        'warning' => "U slučaju da si prekršio/la pravilo, imaj na umu da općenito postoji razdoblje mirovanja od mjesec dana tijekom kojeg nećemo razmatrati nikakve zahtjeve za amnestiju. Nakon tog razdoblja, slobodni ste nas kontaktirati ako smatrate da je potrebno. Imaj na umu da će stvaranje novih računa nakon što si jedan onemogućio/la rezultirati <strong>produženjem ovog jednomjesečnog hlađenja</strong>.  Također imaj na umu da za <strong>svaki račun koji izradiš dodatno kršiš pravila</strong>.  Toplo preporučamo da ne idete ovim putem!",

        'if_mistake' => [
            '_' => 'Ako smatraš da je ovo pogreška, slobodno nas kontaktiraj (putem :email ili klikom na "?" u donjem desnom kutu ove stranice).  Napominjemo da smo uvijek potpuno sigurni u svoje postupke, jer se temelje na vrlo čvrstim podacima. Zadržavamo pravo zanemariti tvoj zahtjev ako smatramo da si namjerno nepošten/a.',
            'email' => 'e-pošta',
        ],

        'reasons' => [
            'compromised' => 'Smatra se da je vaš račun ugrožen. Može biti privremeno onemogućen dok se potvrdi njegov identitet.',
            'opening' => 'Brojni su razlozi koji mogu dovesti do onemogućavanja tvog računa:',

            'tos' => [
                '_' => 'Prekršio/la si jedno ili više naših :community_rules ili :tos.',
                'community_rules' => 'pravila zajednice',
                'tos' => 'uvjete korištenja',
            ],
        ],
    ],

    'filtering' => [
        'by_game_mode' => 'Članovi prema modu igre',
    ],

    'force_reactivation' => [
        'reason' => [
            'inactive_different_country' => "Tvoj račun nije korišten dugo vremena.",
        ],
    ],

    'login' => [
        '_' => 'Prijava',
        'button' => 'Prijava',
        'button_posting' => 'Prijavljivanje...',
        'email_login_disabled' => 'Prijava putem e-pošte trenutno je onemogućena.  Umjesto toga upotrijebi korisničko ime.',
        'failed' => 'Netočna prijava',
        'forgot' => 'Zaboravljena lozinka?',
        'info' => 'Molimo se prijavi za nastavak',
        'invalid_captcha' => 'Previše neuspjelih pokušaja prijave, ispuni captchu i pokušaj ponovno. (Osvježi stranicu ako captcha nije vidljiva)',
        'locked_ip' => 'Tvoja IP adresa je zaključana. Molimo pričekaj nekoliko minuta.',
        'password' => 'Lozinka',
        'register' => "Nemaš osu! račun? Napravi ga",
        'remember' => 'Upamti ovo računalo',
        'title' => 'Molimo da se prijaviš kako bi nastavio/la',
        'username' => 'Korisničko ime',

        'beta' => [
            'main' => 'Pristup beta verziji trenutno je ograničen na privilegirane korisnike.',
            'small' => '(osu!supporteri će ući uskoro)',
        ],
    ],

    'posts' => [
        'title' => 'Objave od :username',
    ],

    'anonymous' => [
        'login_link' => 'klikni za prijavu',
        'login_text' => 'prijava',
        'username' => 'Gost',
        'error' => 'Moraš biti prijavljen da bi to učinio/la.',
    ],
    'logout_confirm' => 'Jesi li siguran/na da se želiš odjaviti?  :(',
    'report' => [
        'button_text' => 'Prijavi',
        'comments' => 'Komentari',
        'placeholder' => 'Navedi sve informacije za koje smatraš da bi mogle biti korisne.',
        'reason' => 'Razlog',
        'thanks' => 'Hvala na tvojoj prijavi!',
        'title' => 'Prijavi :username?',

        'actions' => [
            'send' => 'Pošalji prijavu',
            'cancel' => 'Poništi',
        ],

        'options' => [
            'cheating' => 'Varanje',
            'multiple_accounts' => 'Korištenje više korisničkih profila',
            'insults' => 'Vrijeđanje mene / drugih',
            'spam' => 'Spamanje',
            'unwanted_content' => 'Povezivanje neprikladnog sadržaja',
            'nonsense' => 'Gluposti',
            'other' => 'Ostalo (navedite ispod)',
        ],
    ],
    'restricted_banner' => [
        'title' => 'Vaš račun je organičen!',
        'message' => 'Dok ste ograničeni, nećete moći komunicirati s drugim igračima i vaši rezultati će biti vidljivi samo Vama. To je obični rezultat automatskog procesa i obično će se ukloniti u roku od 24 sata. Ako se želite apelovati na Vaše ograničenje, molimo <a href="mailto:accounts@ppy.sh">kontaktirajte podršku</a>.',
    ],
    'show' => [
        'age' => ':age godina',
        'change_avatar' => 'promijeni svoj avatar!',
        'first_members' => 'Ovdje od početka',
        'is_developer' => 'osu!developer',
        'is_supporter' => 'osu!supporter',
        'joined_at' => 'Pridružio se :date',
        'lastvisit' => 'Zadnje viđen :date',
        'lastvisit_online' => 'Trenutno online',
        'missingtext' => 'Možda si pogriješio/la pri upisu! (ili je korisnik možda ograničen)',
        'origin_country' => 'Iz :country',
        'previous_usernames' => 'prethodno znan kao',
        'plays_with' => 'Igra sa :devices',
        'title' => ":username-ov profil",

        'comments_count' => [
            '_' => 'Postavio :link',
            'count' => ':count_delimited komentar|:count_delimited komentari',
        ],
        'cover' => [
            'to_0' => 'Sakrij naslovnicu',
            'to_1' => 'Prikaži naslovnicu',
        ],
        'edit' => [
            'cover' => [
                'button' => 'Promjeni naslovnicu profila',
                'defaults_info' => 'Više opcija naslovnice bit će dostupno u budućnosti',
                'upload' => [
                    'broken_file' => 'Obrada slike nije uspjela. Provjeri učitanu sliku i pokušaj ponovno.',
                    'button' => 'Postavi sliku',
                    'dropzone' => 'Ispusti ovdje za prenošenje ',
                    'dropzone_info' => 'Također možeš ispustiti svoju sliku ovdje za prijenos',
                    'size_info' => 'Veličina naslovnice treba biti 2400x640',
                    'too_large' => 'Učitana datoteka je prevelika.',
                    'unsupported_format' => 'Nepodržan format.',

                    'restriction_info' => [
                        '_' => 'Prijenos je dostupan samo za :link',
                        'link' => 'osu!supporterima',
                    ],
                ],
            ],

            'default_playmode' => [
                'is_default_tooltip' => 'zadani način igre',
                'set' => 'postavi :mode kao zadani način igre na profilu',
            ],
        ],

        'extra' => [
            'none' => 'ništa',
            'unranked' => 'Nema nedavnih igranja',

            'achievements' => [
                'achieved-on' => 'Postignuto na :date',
                'locked' => 'Zaključano',
                'title' => 'Postignuća',
            ],
            'beatmaps' => [
                'by_artist' => 'od :artist',
                'title' => 'Beatmape',

                'favourite' => [
                    'title' => 'Omiljene beatmape',
                ],
                'graveyard' => [
                    'title' => 'Beatmape na groblju',
                ],
                'guest' => [
                    'title' => 'Beatmape sudjelovanja gostiju',
                ],
                'loved' => [
                    'title' => 'Voljene beatmape',
                ],
                'pending' => [
                    'title' => 'Beatmape na čekanju',
                ],
                'ranked' => [
                    'title' => 'Rangirane beatmape',
                ],
            ],
            'discussions' => [
                'title' => 'Rasprave',
                'title_longer' => 'Nove rasprave',
                'show_more' => 'pogledaj još rasprava',
            ],
            'events' => [
                'title' => 'Događaji',
                'title_longer' => 'Nedavni događaji',
                'show_more' => 'pogledaj još događaja',
            ],
            'historical' => [
                'title' => 'Povijesno',

                'monthly_playcounts' => [
                    'title' => 'Povijest igranja',
                    'count_label' => 'Igranja',
                ],
                'most_played' => [
                    'count' => 'puta igrano',
                    'title' => 'Najigranije beatmape',
                ],
                'recent_plays' => [
                    'accuracy' => 'preciznost: :percentage',
                    'title' => 'Nedavne igre (24h)',
                ],
                'replays_watched_counts' => [
                    'title' => 'Povijest gledanja repriza',
                    'count_label' => 'Repriza gledano',
                ],
            ],
            'kudosu' => [
                'recent_entries' => 'Nedavna povijest Kudosua',
                'title' => 'Kudosu!',
                'total' => 'Ukupno zarađeno Kudosua',

                'entry' => [
                    'amount' => ':amount kudosu',
                    'empty' => "Ovaj korisnik nema nijedan kudosu!",

                    'beatmap_discussion' => [
                        'allow_kudosu' => [
                            'give' => 'Dobio/la :amount od kudosu ukidanja objave modificiranja :post',
                        ],

                        'deny_kudosu' => [
                            'reset' => 'Odbijeno :amount od objave modificiranja :post',
                        ],

                        'delete' => [
                            'reset' => 'Izgubljeno :amount od brisanja objave modificiranja :post',
                        ],

                        'restore' => [
                            'give' => 'Dobiveno :amount od obnove objave modificiranja :post',
                        ],

                        'vote' => [
                            'give' => 'Dobiveno :amount od dobivanja glasova na objavi modificiranja :post',
                            'reset' => 'Izgubljeno :amount zbog gubljenja glasova na objavi modificiranja :post',
                        ],

                        'recalculate' => [
                            'give' => 'Dobiveno :amount od preračunavanja glasova na objavi modificiranja :post',
                            'reset' => 'Izgubljeno :amount od preračunavanja glasova na objavi modificiranja :post',
                        ],
                    ],

                    'forum_post' => [
                        'give' => 'Dobiveno :amount od :giver za objavu na :post',
                        'reset' => 'Kudosu resetiran od :giver za objavu :post',
                        'revoke' => 'Zabranjen kudosu od :giver za objavu :post',
                    ],
                ],

                'total_info' => [
                    '_' => 'Na temelju toga koliko je korisnik dao doprinos moderiranju beatmapa. Pogledaj :link za više informacija.',
                    'link' => 'ovu stranicu',
                ],
            ],
            'me' => [
                'title' => 'ja!',
            ],
            'medals' => [
                'empty' => "Ovaj korisnik još nije dobio nijedan. ;_;",
                'recent' => 'Najnovije',
                'title' => 'Medalje',
            ],
            'playlists' => [
                'title' => 'Igre popisa',
            ],
            'posts' => [
                'title' => 'Objave',
                'title_longer' => 'Nedavne objave',
                'show_more' => 'pogledaj još objava',
            ],
            'recent_activity' => [
                'title' => 'Nedavno',
            ],
            'realtime' => [
                'title' => 'Multiplayer igre',
            ],
            'top_ranks' => [
                'download_replay' => 'Preuzmi reprizu',
                'not_ranked' => 'Samo rangirane beatmape nagrađuju pp',
                'pp_weight' => 'procijenjen :percentage',
                'view_details' => 'Pogledaj detalje',
                'title' => 'Rangovi',

                'best' => [
                    'title' => 'Najbolji nastup',
                ],
                'first' => [
                    'title' => 'Prva mjesta',
                ],
                'pin' => [
                    'to_0' => 'Otkvači',
                    'to_0_done' => 'Otkvačen rezultat',
                    'to_1' => 'Prikvači',
                    'to_1_done' => 'Prikvačen rezultat',
                ],
                'pinned' => [
                    'title' => 'Prikvačeni rezultati',
                ],
            ],
            'votes' => [
                'given' => 'Dani glasovi (posljednja 3 mjeseca)',
                'received' => 'Primljeni glasovi (posljednja 3 mjeseca)',
                'title' => 'Glasovi',
                'title_longer' => 'Nedavni glasovi',
                'vote_count' => ':count_delimited glas|:count_delimited glasova',
            ],
            'account_standing' => [
                'title' => 'Stanje računa',
                'bad_standing' => "Račun od :username nije u dobrom stanju :(",
                'remaining_silence' => ':username će moći ponovno govoriti :duration.',

                'recent_infringements' => [
                    'title' => 'Nedavni prekršaji',
                    'date' => 'datum',
                    'action' => 'akcija',
                    'length' => 'dužina',
                    'length_permanent' => 'Trajno',
                    'description' => 'opis',
                    'actor' => 'od :username',

                    'actions' => [
                        'restriction' => 'Zabrana',
                        'silence' => 'Utišanje',
                        'tournament_ban' => 'Zabrana turnira',
                        'note' => 'Bilješka',
                    ],
                ],
            ],
        ],

        'info' => [
            'discord' => '',
            'interests' => 'Interesi',
            'location' => 'Trenutna lokacija',
            'occupation' => 'Zanimanje',
            'twitter' => '',
            'website' => 'Web stranica',
        ],
        'not_found' => [
            'reason_1' => 'Možda je promijenio/la svoje korisničko ime.',
            'reason_2' => 'Račun može biti privremeno nedostupan zbog sigurnosnih problema ili problema sa zlouporabom.',
            'reason_3' => 'Možda si napravio/la grešku grešku pri pisanju!',
            'reason_header' => 'Postoji nekoliko mogućih razloga za to:',
            'title' => 'Korisnik nije pronađen! ;_;',
        ],
        'page' => [
            'button' => 'Uredi stranicu profila',
            'description' => '<strong>ja!</strong> je osobno prilagodljivo područje na stranici tvog profila.',
            'edit_big' => 'Uredi me!',
            'placeholder' => 'Ovdje upiši sadržaj stranice',

            'restriction_info' => [
                '_' => 'Moraš biti :link da bi otključao/la ovu značajku.',
                'link' => 'osu!supporter',
            ],
        ],
        'post_count' => [
            '_' => 'Doprinio :link',
            'count' => ':count_delimited objavu na forumu|:count_delimited objava na forumu',
        ],
        'rank' => [
            'country' => 'Rang države za :mode',
            'country_simple' => 'Rang u državi',
            'global' => 'Globalni rang za :mode',
            'global_simple' => 'Globalni rang',
            'highest' => '',
        ],
        'stats' => [
            'hit_accuracy' => 'Preciznost pogodaka',
            'level' => 'Level :level',
            'level_progress' => 'Napredak na sljedeću razinu',
            'maximum_combo' => 'Najveći combo',
            'medals' => 'Medalje',
            'play_count' => 'Broj Igranja',
            'play_time' => 'Ukupno vrijeme igranja',
            'ranked_score' => 'Rangirani bodovi',
            'replays_watched_by_others' => 'Reprize koje su gledali drugi',
            'score_ranks' => 'Bodovi poredak',
            'total_hits' => 'Ukupno pogodaka',
            'total_score' => 'Ukupni Bodovi',
            // modding stats
            'graveyard_beatmapset_count' => 'Beatmape na groblju',
            'loved_beatmapset_count' => 'Voljene beatmape',
            'pending_beatmapset_count' => 'Beatmape na čekanju',
            'ranked_beatmapset_count' => 'Rangirane beatmape',
        ],
    ],

    'silenced_banner' => [
        'title' => 'Trenutno si utišan/a.',
        'message' => 'Neke radnje možda neće biti dostupne.',
    ],

    'status' => [
        'all' => 'Svi',
        'online' => 'Online',
        'offline' => 'Offline',
    ],
    'store' => [
        'saved' => 'Stvoreno od strane korisnika',
    ],
    'verify' => [
        'title' => 'Potvrda računa',
    ],

    'view_mode' => [
        'brick' => 'Pogled cigli',
        'card' => 'Kartični pregled',
        'list' => 'Lista',
    ],
];
