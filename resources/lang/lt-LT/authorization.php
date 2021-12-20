<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'play_more' => '',
    'require_login' => 'Norint tęsti reikia prisijungti.',
    'require_verification' => 'Patvirtinkite jei norite tęsti.',
    'restricted' => "Kol ribotas negali to daryti.",
    'silenced' => "Kol užtildytas negali to daryti.",
    'unauthorized' => 'Prieiga draudžiama.',

    'beatmap_discussion' => [
        'destroy' => [
            'is_hype' => 'Iškėlimo nuėmimas negalimas.',
            'has_reply' => 'Diskusijų su atsakymais ištrinti negalima',
        ],
        'nominate' => [
            'exhausted' => 'Jau pasiekei dienos nominacijų limitą, pamėgink rytoj.',
            'incorrect_state' => 'Įvyko klaida atliekant šį veiksmą, pamėgink atnaujinti puslapį.',
            'owner' => "Savo beatmapo negali nominuoti.",
            'set_metadata' => 'Jūs turite padaryti žanrą ir kalbą prieš nominuojant.',
        ],
        'resolve' => [
            'not_owner' => 'Uždaryti diskusiją gali tik pokalbio ir beatmapo kūrėjai.',
        ],

        'store' => [
            'mapper_note_wrong_user' => 'Tik beatmapo kūrėjas ar nominatorius/QAT grupės narys gali rašyti maperio užrašus.',
        ],

        'vote' => [
            'bot' => "Negalima balsuoti diskusijoje sukurtos roboto",
            'limit_exceeded' => 'Palauk kurį laiką prieš balsuojant daugiau',
            'owner' => "Negali balsuoti už savo diskusiją.",
            'wrong_beatmapset_state' => 'Gali balsuoti tik už nepabaigtų beatmapų diskusijas.',
        ],
    ],

    'beatmap_discussion_post' => [
        'destroy' => [
            'not_owner' => 'Jūs galite tik ištrinti savo pranešimų.',
            'resolved' => 'Jūs negalite ištrinti įrašo kuris priklauso išspręstai diskusijai.',
            'system_generated' => 'Automatiškai sugeneruotas įrašas negali būti ištrintas.',
        ],

        'edit' => [
            'not_owner' => 'Tik žinutės autorius gali redaguoti žinutę.',
            'resolved' => 'Jūs negalite redaguoti įrašo kuris priklauso išspręstai diskusijai.',
            'system_generated' => 'Automatiškai sugeneruotos žinutės negali būti redaguotos.',
        ],

        'store' => [
            'beatmapset_locked' => 'Šis beatmapo diskusiją užrakintą.',
        ],
    ],

    'beatmapset' => [
        'metadata' => [
            'nominated' => 'Jūs negalite pakeisti nominuoto žemėlapio duomenų. Susisiekite su BN arba NAT nariu jeigu jūs manote, kad tai buvo nustatyta neteisingai.',
        ],
    ],

    'chat' => [
        'blocked' => 'Negalima išsiųsti žinutės vartotujui kuris jumis yra užblokavę arba jūs jį esą užblokavę.',
        'friends_only' => 'Vartotojas šiuo metu užblokavo žinutės iš žmonių kurie nėra vartotojo draugų sąraše.',
        'moderated' => 'Šiuo momentu šis kanalas yra prižiūrimas.',
        'no_access' => 'Jūs neturite leidimo įeiti į šį kanalą.',
        'restricted' => 'Būnant užblokuotam, apribotam, užtildytam, jūs negalite siųsti žinutės.',
        'silenced' => '',
    ],

    'comment' => [
        'update' => [
            'deleted' => "Ištrintos žinutės negalima redaguoti.",
        ],
    ],

    'contest' => [
        'voting_over' => 'Po konkurso balsavimo pabaigos, balso keitimas nebegalimas.',

        'entry' => [
            'limit_reached' => '',
            'over' => '',
        ],
    ],

    'forum' => [
        'moderate' => [
            'no_permission' => 'Leidimo keisti šį forumą jūs neturitę.',
        ],

        'post' => [
            'delete' => [
                'only_last_post' => 'Trinti galima tik paskutinę žinutę.',
                'locked' => 'Po temos užrakinimo trinti žinučių negalima.',
                'no_forum_access' => 'Prieiga prie norimo forumo reikalauja papildomų teisių.',
                'not_owner' => 'Tik žinutės autorius gali ištrinti žinutę.',
            ],

            'edit' => [
                'deleted' => 'Ištrintos žinutės negalima redaguoti.',
                'locked' => 'Žinutės redagavimas buvo uždraustas.',
                'no_forum_access' => 'Prieiga prie norimo forumo reikalauja papildomų teisių.',
                'not_owner' => 'Tik žinutės autorius gali ištrinti žinutę.',
                'topic_locked' => 'Po temos užrakinimo trinti žinučių negalima.',
            ],

            'store' => [
                'play_more' => 'Prašau pažaisk žaidimą prieš dalyvaujant forumuose! Jei kyla problemų su žaidimu, prašau kreiptis į Pagalbos ir Palaikymo forumą.',
                'too_many_help_posts' => "Tau reikia daugiau žaisti žaidimą prieš siunčiant daugiau žinučių. Jeigu vis dar kyla problemų žaidžiant, siųsk el. paštą į support@ppy.sh", // FIXME: unhardcode email address.
            ],
        ],

        'topic' => [
            'reply' => [
                'double_post' => 'Prašome redaguoti paskutinę žinutė, nesunčiant jos dar kartą.',
                'locked' => 'Negalima atsakinėti į užrakintą temą.',
                'no_forum_access' => 'Prieiga prie norimo forumo reikalauja papildomų teisių.',
                'no_permission' => 'Atsakymui neturi leidimo.',

                'user' => [
                    'require_login' => 'Atrašymui reikia prisijungti.',
                    'restricted' => "Kol esi ribojamas negali atrašinėti.",
                    'silenced' => "Kol esi užtildytas negali atrašinėti.",
                ],
            ],

            'store' => [
                'no_forum_access' => 'Prieiga prie norimo forumo reikalauja papildomų teisių.',
                'no_permission' => 'Neturi teisių kurti naujai temai.',
                'forum_closed' => 'Forumas buvo uždarytas ir rašyti jame nebegalima.',
            ],

            'vote' => [
                'no_forum_access' => 'Prieiga prie norimo forumo reikalauja papildomų teisių.',
                'over' => 'Apklausa baigėsi ir balsavimai nebegalimi.',
                'play_more' => 'Jūs turita pažaisti ilgiau prieš balsuojant forume.',
                'voted' => 'Keisti balso negalima.',

                'user' => [
                    'require_login' => 'Balsavimui reikia prisijungti.',
                    'restricted' => "Kol esi ribojamas negali balsuoti.",
                    'silenced' => "Kol esi pritildytas negali balsuoti.",
                ],
            ],

            'watch' => [
                'no_forum_access' => 'Prieiga prie norimo forumo reikalauja papildomų teisių.',
            ],
        ],

        'topic_cover' => [
            'edit' => [
                'uneditable' => 'Nurodytas neteisingas viršelis.',
                'not_owner' => 'Viršelį gali redaguoti tik savininkas.',
            ],
            'store' => [
                'forum_not_allowed' => 'Šis forumas nepriima temų viršelių.',
            ],
        ],

        'view' => [
            'admin_only' => 'Šį forumą gali skaityti tik administratoriai.',
        ],
    ],

    'user' => [
        'page' => [
            'edit' => [
                'locked' => 'Vartotojo puslapis užrakintas.',
                'not_owner' => 'Gali redaguoti tik savo profilio puslapį.',
                'require_supporter_tag' => 'osu! remėjo žyma yra reikalinga.',
            ],
        ],
    ],
];
