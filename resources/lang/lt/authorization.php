<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'play_more' => 'Geriau pažaisk daugiau osu!, jo?',
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
            'owner' => " Savo bitmapo nominuoti negali.",
            'set_metadata' => 'Jūs turite nustatyti žanrą ir kalbą prieš nominuojant.',
        ],
        'resolve' => [
            'not_owner' => 'Uždaryti diskusiją gali tik pokalbio ir bitmapo kūrėjai.',
        ],

        'store' => [
            'mapper_note_wrong_user' => 'Tik bitmapo savininkas ar nominatorius/NAT grupės narys gali rašyti į kūrėjo užrašus.',
        ],

        'vote' => [
            'bot' => "Negalima balsuoti diskusijoje sukurtoje boto",
            'limit_exceeded' => 'Palaukite kurį laiką prieš balsuojant daugiau',
            'owner' => "Negali balsuoti už savo diskusiją.",
            'wrong_beatmapset_state' => 'Gali balsuoti tik nepabaigtų bitmapų diskusijose.',
        ],
    ],

    'beatmap_discussion_post' => [
        'destroy' => [
            'not_owner' => 'Jūs galite ištrinti tik savo įrašus.',
            'resolved' => 'Jūs negalite ištrinti įrašo kuris priklauso išspręstai diskusijai.',
            'system_generated' => 'Automatiškai sugeneruotas įrašas negali būti ištrintas.',
        ],

        'edit' => [
            'not_owner' => 'Tik įrašo autorius gali redaguoti įrašą.',
            'resolved' => 'Jūs negalite redaguoti įrašo kuris priklauso išspręstai diskusijai.',
            'system_generated' => 'Automatiškai sugeneruoti įrašai negali būti redaguojami.',
        ],
    ],

    'beatmapset' => [
        'discussion_locked' => '',

        'metadata' => [
            'nominated' => 'Jūs negalite pakeisti nominuoto bitmapo metaduomenų. Susisiekite su BN arba NAT nariu jeigu jūs manote, kad jie buvo nustatyti neteisingai.',
        ],
    ],

    'chat' => [
        'annnonce_only' => 'Šis kanalas tik skelbimams.',
        'blocked' => 'Negalima išsiųsti žinučių vartotojui, kuris yra jūs užblokavęs, ar jūs esat užblokavę.',
        'friends_only' => 'Vartotojas šiuo metu užblokavo žinutės iš žmonių, kurie nėra vartotojo draugų sąraše.',
        'moderated' => 'Šiuo momentu šis kanalas yra prižiūrimas.',
        'no_access' => 'Jūs neturite leidimo įeiti į šį kanalą.',
        'receive_friends_only' => 'Naudotojas gali negalėti atsakyti, nes priėmat žinutes tik iš žmonių jūsų draugų sąraše.',
        'restricted' => 'Būnant užblokuotam, apribotam, užtildytam, jūs negalite siųsti žinučių.',
        'silenced' => 'Būnant užblokuotam, apribotam, užtildytam, jūs negalite siųsti žinučių.',
    ],

    'comment' => [
        'store' => [
            'disabled' => 'Komentarai išjungti',
        ],
        'update' => [
            'deleted' => "Ištrinto įrašo negalima redaguoti.",
        ],
    ],

    'contest' => [
        'voting_over' => 'Po konkurso balsavimo pabaigos, balso keitimas nebegalimas.',

        'entry' => [
            'limit_reached' => 'Jūs pasiekėt pateikymų limitą šiam konkursui',
            'over' => 'Ačiū už jūsų pateiktis! Pateikimas šiam konkursui buvo sustabdytas ir netrukus prasidės balsavimas.',
        ],
    ],

    'forum' => [
        'moderate' => [
            'no_permission' => 'Leidimo keisti šį forumą jūs neturite.',
        ],

        'post' => [
            'delete' => [
                'only_last_post' => 'Trinti galima tik paskutinį įrašą.',
                'locked' => 'Užrakintos temos įrašų trinti negalima.',
                'no_forum_access' => 'Prieiga prie norimo forumo reikalauja papildomų teisių.',
                'not_owner' => 'Tik įrašo autorius gali ištrinti įrašą.',
            ],

            'edit' => [
                'deleted' => 'Ištrinto įrašo negalima redaguoti.',
                'locked' => 'Įrašo redagavimas buvo uždraustas.',
                'no_forum_access' => 'Prieiga prie norimo forumo reikalauja papildomų teisių.',
                'not_owner' => 'Tik įrašo autorius gali ištrinti įrašą.',
                'topic_locked' => 'Po temos užrakinimo trinti įrašų negalima.',
            ],

            'store' => [
                'play_more' => 'Prašau pažaisk žaidimą prieš dalyvaujant forumuose! Jei kyla problemų su žaidimu, prašau kreiptis į Pagalbos ir Palaikymo forumą.',
                'too_many_help_posts' => "Tau reikia daugiau žaisti žaidimą prieš publikuojant daugiau įrašų. Jeigu vis dar kyla problemų žaidžiant, siųsk el. laišką į support@ppy.sh", // FIXME: unhardcode email address.
            ],
        ],

        'topic' => [
            'reply' => [
                'double_post' => 'Prašome redaguoti paskutinį įrašą, vietoj publikavimo dar kartą.',
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

    'score' => [
        'pin' => [
            'not_owner' => 'Tik rezultato savininkas gali prisegti rezultatą.',
            'too_many' => 'Prisegta perdaug rezultatų.',
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
