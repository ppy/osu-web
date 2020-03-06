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
    'require_login' => 'Norint tęsti reikia prisijungti.',
    'require_verification' => '',
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
            'full_bn_required' => '',
            'full_bn_required_hybrid' => '',
            'incorrect_state' => 'Įvyko klaida atliekant šį veiksmą, pamėgink atnaujinti puslapį.',
            'owner' => "Savo beatmapo negali nominuoti.",
        ],
        'resolve' => [
            'not_owner' => 'Uždaryti diskusiją gali tik pokalbio ir beatmapo kūrėjai.',
        ],

        'store' => [
            'mapper_note_wrong_user' => 'Tik beatmapo kūrėjas ar nominatorius/QAT grupės narys gali rašyti maperio užrašus.',
        ],

        'vote' => [
            'limit_exceeded' => 'Palauk kurį laiką prieš balsuojant daugiau',
            'owner' => "Negali balsuoti už savo diskusiją.",
            'wrong_beatmapset_state' => 'Gali balsuoti tik už nepabaigtų beatmapų diskusijas.',
        ],
    ],

    'beatmap_discussion_post' => [
        'destroy' => [
            'not_owner' => '',
            'resolved' => '',
            'system_generated' => '',
        ],

        'edit' => [
            'not_owner' => 'Tik žinutės autorius gali redaguoti žinutę.',
            'resolved' => '',
            'system_generated' => 'Automatiškai sugeneruotos žinutės negali būti redaguotos.',
        ],

        'store' => [
            'beatmapset_locked' => '',
        ],
    ],

    'chat' => [
        'blocked' => 'Negalima išsiųsti žinutės vartotujui kuris jumis yra užblokavę arba jūs jį esą užblokavę.',
        'friends_only' => 'Vartotojas šiuo metu užblokavo žinutės iš žmonių kurie nėra vartotojo draugų sąraše.',
        'moderated' => 'Šiuo momentu šis kanalas yra prižiūrimas.',
        'no_access' => 'Jūs neturite leidimo įeiti į šį kanalą.',
        'restricted' => 'Būnant užblokuotam, apribotam, užtildytam, jūs negalite siųsti žinutės.',
    ],

    'comment' => [
        'update' => [
            'deleted' => "Ištrintos žinutės negalima redaguoti.",
        ],
    ],

    'contest' => [
        'voting_over' => 'Po konkurso balsavimo pabaigos, balso keitimas nebegalimas.',
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
                'play_more' => '',
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
                'forum_not_allowed' => '',
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
