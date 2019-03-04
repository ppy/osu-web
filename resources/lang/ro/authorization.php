<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

return [
    'beatmap_discussion' => [
        'destroy' => [
            'is_hype' => 'Nu poți anula hype-ul.',
            'has_reply' => 'Nu se poate șterge o discuție cu răspunsuri',
        ],
        'nominate' => [
            'exhausted' => 'Ai atins limita de nominalizări pentru această zi, te rugăm să încerci din nou mâine.',
            'incorrect_state' => 'S-a produs o eroare la efectuarea acestei acțiuni, încearcă să reîmprospătezi pagina.',
            'owner' => "Nu îți poți nominaliza propriul beatmap.",
        ],
        'resolve' => [
            'not_owner' => 'Numai cel ce a început subiectul sau proprietarul acestui beatmap pot rezolva o discuție.',
        ],

        'store' => [
            'mapper_note_wrong_user' => 'Doar proprietarul beatmapului sau nominatorul/membru din QAT pot posta note de mapper.',
        ],

        'vote' => [
            'limit_exceeded' => 'Te rugăm să aștepți un timp înainte să acorzi mai multe voturi',
            'owner' => "Nu îți poți vota propria discuție.",
            'wrong_beatmapset_state' => 'Poți vota doar discuțiile despre beatmapuri în așteptare.',
        ],
    ],

    'beatmap_discussion_post' => [
        'edit' => [
            'system_generated' => 'Postările generate automat nu pot fi editate.',
            'not_owner' => 'Doar proprietarul poate edita această postare.',
        ],
    ],

    'chat' => [
        'blocked' => 'Nu poți trimite mesaje unui utilizator care te-a blocat sau pe care l-ai blocat.',
        'friends_only' => 'Utilizatorul blochează mesajele de la oameni care nu sunt pe lista lor de prieteni.',
        'moderated' => 'Canalul este moderat în prezent.',
        'no_access' => 'Nu ai acces la acest canal.',
        'restricted' => 'Nu poți trimite mesaje cât timp ești amuțit, restricționat sau interzis.',
    ],

    'comment' => [
        'update' => [
            'deleted' => "Nu poți edita o postare ștearsă.",
        ],
    ],

    'contest' => [
        'voting_over' => 'Nu îți poți schimba votul după ce perioada de vot pentru această competiție s-a încheiat.',
    ],

    'forum' => [
        'moderate' => [
            'no_permission' => 'Nu ai permisiunea de a modera acest forum.',
        ],

        'post' => [
            'delete' => [
                'only_last_post' => 'Doar ultima postare poate fi ștearsă.',
                'locked' => 'Nu poți șterge o postare al unui subiect închis.',
                'no_forum_access' => 'Accesul la forumul solicitat este necesar.',
                'not_owner' => 'Doar proprietarul poate șterge această postare.',
            ],

            'edit' => [
                'deleted' => 'Această postare nu poate fi editată.',
                'locked' => 'Postarea nu poate fi editată.',
                'no_forum_access' => 'Accesul la forumul solicitat este necesar.',
                'not_owner' => 'Doar proprietarul poate edita această postare.',
                'topic_locked' => 'Nu poți edita o postare al unui subiect închis.',
            ],

            'store' => [
                'play_more' => 'Te rugăm să te joci înainte de a posta pe forum. Dacă ai o problemă în ceea ce privește jocul, te rugăm să o postezi pe forumul de ajutor și asistență.',
                'too_many_help_posts' => "Trebuie să te joci înainte de a putea face postări suplimentare. Dacă ai o problemă legată de joc, trimite un e-mail la support@ppy.sh", // FIXME: unhardcode email address.
            ],
        ],

        'topic' => [
            'reply' => [
                'double_post' => 'Te rugăm să editezi ultima postare în loc să postezi din nou.',
                'locked' => 'Nu se poate răspunde la o discuție închisă.',
                'no_forum_access' => 'Accesul la forumul solicitat este necesar.',
                'no_permission' => 'Nu ai permisiunea de a răspunde.',

                'user' => [
                    'require_login' => 'Te rugăm să te autentifici pentru a răspunde.',
                    'restricted' => "Nu poți răspunde cât timp ești restricționat.",
                    'silenced' => "Nu poți răspunde cât timp ești amuțit.",
                ],
            ],

            'store' => [
                'no_forum_access' => 'Accesul la forumul solicitat este necesar.',
                'no_permission' => 'Nu ai permisiunea de a crea un subiect nou.',
                'forum_closed' => 'Forumul este închis și nu mai pot fi adăugate alte postări.',
            ],

            'vote' => [
                'no_forum_access' => 'Accesul la forumul solicitat este necesar.',
                'over' => 'Sondajul s-a încheiat și nu se mai poate vota.',
                'voted' => 'Schimbarea votului nu este permisă.',

                'user' => [
                    'require_login' => 'Te rugăm să te autentifici pentru a vota.',
                    'restricted' => "Nu poți vota cât timp ești restricționat.",
                    'silenced' => "Nu poți vota cât timp ești amuțit.",
                ],
            ],

            'watch' => [
                'no_forum_access' => 'Accesul la forumul solicitat este necesar.',
            ],
        ],

        'topic_cover' => [
            'edit' => [
                'uneditable' => 'Coperta specificată este invalidă.',
                'not_owner' => 'Numai proprietarul poate edita coperta.',
            ],
        ],

        'view' => [
            'admin_only' => 'Numai administratorul poate vizualiza acest forum.',
        ],
    ],

    'require_login' => 'Te rugăm să te autentifici pentru a continua.',

    'unauthorized' => 'Acces respins.',

    'silenced' => "Nu poți face asta cât timp ești amuțit.",

    'restricted' => "Nu poți face asta cât timp ești restricționat.",

    'user' => [
        'page' => [
            'edit' => [
                'locked' => 'Pagina utilizatorului este închisă.',
                'not_owner' => 'Îți poți edita doar propria pagină de utilizator.',
                'require_supporter_tag' => 'eticheta de suporter osu! este necesară.',
            ],
        ],
    ],
];
