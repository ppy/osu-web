<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'play_more' => 'Što kažeš na to da sada zaigraš malo osu! umjesto toga?',
    'require_login' => 'Molimo da se prijaviš kako bi nastavio/la.',
    'require_verification' => 'Molimo potvrdi da nastaviš.',
    'restricted' => "Ne možeš to raditi dok si ograničen/a.",
    'silenced' => "Ne možeš to raditi dok si utišan/na.",
    'unauthorized' => 'Zabranjen pristup.',

    'beatmap_discussion' => [
        'destroy' => [
            'is_hype' => 'Nije moguće poništiti hyping.',
            'has_reply' => 'Ne može se obrisati rasprava sa komentarima',
        ],
        'nominate' => [
            'exhausted' => 'Dostigao si svoje dnevno ograničenje za nominiranje, molimo te da pokušaš ponovo sutra.',
            'incorrect_state' => 'Greška u izvođenju tog zadatka, pokušajte osvježiti stranicu.',
            'owner' => "Ne možeš nominirati vlastitu beatmapu.",
            'set_metadata' => 'Prije nominiranja moraš postaviti žanr i jezik.',
        ],
        'resolve' => [
            'not_owner' => 'Samo pokretač threada i vlasnik beatmape mogu riješiti raspravu.',
        ],

        'store' => [
            'mapper_note_wrong_user' => 'Samo vlasnik beatmape ili nominator/član NAT grupe može objaviti mapper bilješke.',
        ],

        'vote' => [
            'bot' => "Nije moguće glasati na raspravu koju je napravio bot",
            'limit_exceeded' => 'Molimo te da pričekaš trenutak prije ponovnog  glasanja',
            'owner' => "Ne možeš glasati na vlastitu raspravu.",
            'wrong_beatmapset_state' => 'Može se samo glasati na raspravama beatmapa u tijeku.',
        ],
    ],

    'beatmap_discussion_post' => [
        'destroy' => [
            'not_owner' => 'Možeš izbrisati samo svoje vlastite objave.',
            'resolved' => 'Ne možeš izbrisati objavu riješene rasprave.',
            'system_generated' => 'Automatski generirana objava se ne može izbrisati.',
        ],

        'edit' => [
            'not_owner' => 'Samo objavljivač može urediti objavu.',
            'resolved' => 'Ne možeš urediti objavu riješene rasprave.',
            'system_generated' => 'Automatski generirana objava se ne može uređivati.',
        ],
    ],

    'beatmapset' => [
        'discussion_locked' => '',

        'metadata' => [
            'nominated' => 'Ne možeš promijeniti metapodatke nominirane mape. Obratite se BN ili NAT članu ako mislite da su pogrešno postavljeni.',
        ],
    ],

    'chat' => [
        'annnonce_only' => 'Ovaj kanal je samo za obavijesti.',
        'blocked' => 'Ne možeš poslati poruku korisniku koji te blokira ili kojeg si blokirao/la.',
        'friends_only' => 'Korisnik blokira poruke od ljudi koji nisu na njegovoj/njezinoj listi prijatelja.',
        'moderated' => 'Ovaj kanal je trenutno nadziran.',
        'no_access' => 'Nemaš pristup tom kanalu.',
        'receive_friends_only' => 'Korisnik možda neće moći odgovoriti zato što samo prihvaćaš poruke od ljudi koji su na tvojoj listi prijatelja.',
        'restricted' => 'Ne možeš slati poruke dok si utišan, ograničen ili izbačen/a.',
        'silenced' => 'Ne možeš slati poruke dok si utišan, ograničen ili izbačen/a.',
    ],

    'comment' => [
        'store' => [
            'disabled' => 'Komentari su onemogućeni',
        ],
        'update' => [
            'deleted' => "Ne možeš urediti izbrisanu objavu.",
        ],
    ],

    'contest' => [
        'voting_over' => 'Ne možeš promijeniti svoj glas nakon završetka razdoblja glasanja za ovo natjecanje.',

        'entry' => [
            'limit_reached' => 'Dosegnuo/la si ograničenje za prijavu za ovo natjecanje',
            'over' => 'Hvala ti na tvojim prijavama. Prijave su zatvorene za ovo natjecanje i glasanje će se uskoro otvoriti.',
        ],
    ],

    'forum' => [
        'moderate' => [
            'no_permission' => 'Nemaš dopuštenje za moderiranje ovog foruma.',
        ],

        'post' => [
            'delete' => [
                'only_last_post' => 'Samo posljednja objava se može izbrisati.',
                'locked' => 'Ne možeš izbrisati objavu zaključane teme.',
                'no_forum_access' => 'Potreban je pristup zatraženom forumu.',
                'not_owner' => 'Samo autor može izbrisati objavu.',
            ],

            'edit' => [
                'deleted' => 'Ne možeš urediti izbrisanu objavu.',
                'locked' => 'Ova objava je zaključena od uređivanja.',
                'no_forum_access' => 'Potreban je pristup zatraženom forumu.',
                'not_owner' => 'Samo autor može urediti objavu.',
                'topic_locked' => 'Ne možeš urediti objavu zaključane teme.',
            ],

            'store' => [
                'play_more' => 'Pokušaj igrati igru ​​prije objavljivanja na forumima, molim te! Ako imaš problema s igranjem, objavi na forumu za pomoć i podršku.',
                'too_many_help_posts' => "Moraš više igrati igru ​​prije nego što možeš objavljivati ​​dodatne objave. Ako i dalje imaš problema s igranjem igre, pošalji e-poštu na support@ppy.sh", // FIXME: unhardcode email address.
            ],
        ],

        'topic' => [
            'reply' => [
                'double_post' => 'Molimo te da urediš svoju prošlu objavu prije ponovnog objavljivanja.',
                'locked' => 'Ne možeš odgovoriti na zaključan thread.',
                'no_forum_access' => 'Potreban je pristup zatraženom forumu.',
                'no_permission' => 'Nemaš dopuštenje da odgovoriš.',

                'user' => [
                    'require_login' => 'Molimo da se prijaviš kako bi odgovorio/la.',
                    'restricted' => "Ne možeš odgovoriti dok si ograničen/a.",
                    'silenced' => "Ne možeš odgovoriti dok si utišan/na.",
                ],
            ],

            'store' => [
                'no_forum_access' => 'Potreban je pristup zatraženom forumu.',
                'no_permission' => 'Nemaš dopuštenje za stvoriti novu temu.',
                'forum_closed' => 'Forum je zatvoren i ne može se objavljivati na njega.',
            ],

            'vote' => [
                'no_forum_access' => 'Potreban je pristup zatraženom forumu.',
                'over' => 'Glasanje je završeno i više se ne može glasati.',
                'play_more' => 'Moraš više igrati prije glasanja na forumu.',
                'voted' => 'Promjena glasa nije dopuštena.',

                'user' => [
                    'require_login' => 'Molimo, prijavite se da biste mogli glasati.',
                    'restricted' => "Ne možeš glasati dok si ograničen/a.",
                    'silenced' => "Ne možeš glasati dok si utišan/na.",
                ],
            ],

            'watch' => [
                'no_forum_access' => 'Potreban je pristup zatraženom forumu.',
            ],
        ],

        'topic_cover' => [
            'edit' => [
                'uneditable' => 'Navedena je nevažeća naslovnica.',
                'not_owner' => 'Samo vlasnik može uređivati ​​naslovnicu.',
            ],
            'store' => [
                'forum_not_allowed' => 'Ovaj forum ne prihvaća naslovnice tema.',
            ],
        ],

        'view' => [
            'admin_only' => 'Samo administrator može vidjeti ovaj forum.',
        ],
    ],

    'score' => [
        'pin' => [
            'not_owner' => 'Samo vlasnik rezultata može prikvačiti rezultat.',
            'too_many' => 'Prikvačeno previše rezultata.',
        ],
    ],

    'user' => [
        'page' => [
            'edit' => [
                'locked' => 'Korisnička stranica je zaključana.',
                'not_owner' => 'Možeš urediti samo svoju korisničku stranicu.',
                'require_supporter_tag' => 'Potrebna je osu!supporter oznaka.',
            ],
        ],
    ],
];
