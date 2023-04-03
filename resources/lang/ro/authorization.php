<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'play_more' => 'Cum ar fi să joci osu! în schimb?',
    'require_login' => 'Te rugăm să te autentifici pentru a continua.',
    'require_verification' => 'Vă rugăm să vă verificați pentru a continua.',
    'restricted' => "Nu poți face asta cât timp ești restricționat.",
    'silenced' => "Nu poți face asta cât timp ești mut.",
    'unauthorized' => 'Acces respins.',

    'beatmap_discussion' => [
        'destroy' => [
            'is_hype' => 'Nu poți anula hype-ul.',
            'has_reply' => 'Nu se poate șterge o discuție cu răspunsuri',
        ],
        'nominate' => [
            'exhausted' => 'Ai atins limita de nominalizări pentru această zi, te rugăm să încerci din nou mâine.',
            'incorrect_state' => 'S-a produs o eroare la efectuarea acestei acțiuni, încearcă să reîmprospătezi pagina.',
            'owner' => "Nu îți poți nominaliza propriul beatmap.",
            'set_metadata' => 'Trebuie să setezi genul și limba înainte de a nomina.',
        ],
        'resolve' => [
            'not_owner' => 'Doar creatorul discuției sau al acestui beatmap pot rezolva o discuție.',
        ],

        'store' => [
            'mapper_note_wrong_user' => 'Numai creatorul beatmap-ului sau nominalizatorul/membru din QAT pot posta notițe pentru creator.',
        ],

        'vote' => [
            'bot' => "Nu se poate vota o discuție făcută de un bot",
            'limit_exceeded' => 'Te rugăm să aștepți înainte să acorzi mai multe voturi',
            'owner' => "Nu îți poți vota propria discuție.",
            'wrong_beatmapset_state' => 'Poți vota doar discuțiile despre beatmapuri în așteptare.',
        ],
    ],

    'beatmap_discussion_post' => [
        'destroy' => [
            'not_owner' => 'Poți să ștergi doar postările proprii.',
            'resolved' => 'Nu poți șterge o postare dintr-o discuție rezolvată.',
            'system_generated' => 'Postările generate automat nu pot fi șterse.',
        ],

        'edit' => [
            'not_owner' => 'Doar creatorul poate edita această postare.',
            'resolved' => 'Nu poți edita o postare dintr-o discuție rezolvată.',
            'system_generated' => 'Postările generate automat nu pot fi editate.',
        ],
    ],

    'beatmapset' => [
        'discussion_locked' => 'Discuțiile sunt blocate pe acest beatmap.',

        'metadata' => [
            'nominated' => 'Nu poți schimba datele melodiei a unui beatmap nominalizat. Contactează un membru BN sau NAT dacă crezi că e setat greșit.',
        ],
    ],

    'chat' => [
        'annnonce_only' => 'Acest canal este doar pentru anunțuri.',
        'blocked' => 'Nu poți trimite mesaje unui utilizator care te-a blocat sau pe care l-ai blocat.',
        'friends_only' => 'Utilizatorul blochează mesajele de la oameni care nu sunt pe lista lor de prieteni.',
        'moderated' => 'Acest canal este moderat în prezent.',
        'no_access' => 'Nu ai acces la acest canal.',
        'receive_friends_only' => 'Este posibil ca utilizatorul să nu poată răspunde, deoarece acceptați doar mesaje de la persoane adăugate la prieteni.',
        'restricted' => 'Nu poți trimite mesaje cât timp ești mut, restricționat sau interzis.',
        'silenced' => 'Nu poți trimite mesaje cât timp ești mut, restricționat sau interzis.',
    ],

    'comment' => [
        'store' => [
            'disabled' => 'Comentariile sunt dezactivate',
        ],
        'update' => [
            'deleted' => "Nu poți edita o postare ștearsă.",
        ],
    ],

    'contest' => [
        'voting_over' => 'Nu îți poți schimba votul după ce perioada de vot pentru această competiție s-a încheiat.',

        'entry' => [
            'limit_reached' => 'Ai atins limita de intrări în acest concurs',
            'over' => 'Îți mulțumim pentru intrările tale! Înscrierile s-au închis pentru acest concurs și votarea se va deschide în curând.',
        ],
    ],

    'forum' => [
        'moderate' => [
            'no_permission' => 'Nu ai permisiunea de a modera acest forum.',
        ],

        'post' => [
            'delete' => [
                'only_last_post' => 'Doar ultima postare poate fi ștearsă.',
                'locked' => 'Nu poți șterge o postare al unui subiect închis.',
                'no_forum_access' => 'Accesul la forum-ul solicitat este necesar.',
                'not_owner' => 'Doar creatorul poate șterge această postare.',
            ],

            'edit' => [
                'deleted' => 'Această postare nu poate fi editată.',
                'locked' => 'Postarea nu poate fi editată.',
                'no_forum_access' => 'Accesul la forum-ul solicitat este necesar.',
                'not_owner' => 'Doar creatorul poate edita această postare.',
                'topic_locked' => 'Nu poți edita o postare al unui subiect închis.',
            ],

            'store' => [
                'play_more' => 'Te rugăm să încerci să te joci înainte de a posta pe forum. Dacă ai o problemă în ceea ce privește jocul, te rugăm să o postezi pe forum-ul de ajutor și asistență.',
                'too_many_help_posts' => "Trebuie să te joci înainte de a putea face postări suplimentare. Dacă ai o problemă legată de joc, trimite un e-mail la support@ppy.sh", // FIXME: unhardcode email address.
            ],
        ],

        'topic' => [
            'reply' => [
                'double_post' => 'Te rugăm să editezi ultima postare în loc să postezi din nou.',
                'locked' => 'Nu se poate răspunde la o discuție închisă.',
                'no_forum_access' => 'Accesul la forum-ul solicitat este necesar.',
                'no_permission' => 'Nu ai permisiunea de a răspunde.',

                'user' => [
                    'require_login' => 'Te rugăm să te autentifici pentru a răspunde.',
                    'restricted' => "Nu poți răspunde cât timp ești restricționat.",
                    'silenced' => "Nu poți răspunde cât timp ești mut.",
                ],
            ],

            'store' => [
                'no_forum_access' => 'Accesul la forum-ul solicitat este necesar.',
                'no_permission' => 'Nu ai permisiunea de a crea un subiect nou.',
                'forum_closed' => 'Forum-ul este închis și nu mai pot fi adăugate alte postări.',
            ],

            'vote' => [
                'no_forum_access' => 'Accesul la forum-ul solicitat este necesar.',
                'over' => 'Sondajul s-a încheiat și nu se mai poate vota.',
                'play_more' => 'Trebuie să joci mai mult înainte de a vota pe forum.',
                'voted' => 'Schimbarea votului nu este permisă.',

                'user' => [
                    'require_login' => 'Te rugăm să te autentifici pentru a vota.',
                    'restricted' => "Nu poți vota cât timp ești restricționat.",
                    'silenced' => "Nu poți vota cât timp ești mut.",
                ],
            ],

            'watch' => [
                'no_forum_access' => 'Accesul la forum-ul solicitat este necesar.',
            ],
        ],

        'topic_cover' => [
            'edit' => [
                'uneditable' => 'Fundalul specificat este invalidă.',
                'not_owner' => 'Numai creatorul poate edita fundalul.',
            ],
            'store' => [
                'forum_not_allowed' => 'Acest forum nu acceptă fundale pentru subiecte.',
            ],
        ],

        'view' => [
            'admin_only' => 'Numai administratorul poate vizualiza acest forum.',
        ],
    ],

    'score' => [
        'pin' => [
            'not_owner' => 'Numai creatorul scorului poate fixa acest scor.',
            'too_many' => 'Ai fixat prea multe scoruri.',
        ],
    ],

    'user' => [
        'page' => [
            'edit' => [
                'locked' => 'Pagina de utilizator este blocată.',
                'not_owner' => 'Îți poți edita doar propria pagină de utilizator.',
                'require_supporter_tag' => 'Statusul de suporter osu! este necesar.',
            ],
        ],
    ],
];
