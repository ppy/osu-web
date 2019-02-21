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
    'support' => [
        'header' => [
            // size in font-size
            'big_description' => 'Iubești osu!?<br/>
                                Susține dezvoltarea osu! :D',
            'small_description' => '',
            'support_button' => 'Vreau să sprijin osu!',
        ],

        'dev_quote' => 'osu! este un joc complet gratuit, dar să-l rulezi, cu siguranță, nu este așa gratis. 
        Între costurile de punere în funcțiune a serverelor și a lățimii de bandă internațională de înaltă calitate, timpul petrecut pentru menținerea sistemului și a comunității,
        oferind premii pentru competiții, răspunzând la întrebările de asistență și, în general, păstrând lumea fericită, osu! consumă o cantitate destul de mare de bani!
        Oh, și nu uita faptul că noi o facem fără nicio publicitate sau parteneriat cu alte instrumente prostești și altele!
            <br/><br/>osu! este la sfârșitul zilei în mare parte condus de mine, probabil mă știi cel mai bine sub numele de "peppy".
            A trebuit să renunț la slujba mea pentru a ține pasul cu osu!,
            și uneori mă străduiesc să mențin standardele la care mă lupt.
            Mi-ar plăcea să ofer mulțumirile mele personale celor care au sprijinit osu! până acum,
            și la fel de mult celor ce continuă să sprijine acest joc uimitor și comunitatea în viitor :).',

        'supporter_status' => [
            'contribution' => 'Mulțumim pentru sprijinul vostru de până acum! Ai contribuit cu un total de :dollars pentru :tags achiziționări de tag-uri!',
            'gifted' => ':giftedTags din achiziționările tale de tag-uri au fost dăruite (pentru un total de :giftedDollars dăruiți), cât de generos!',
            'not_yet' => "Încă nu ai eticheta de suporter :(",
            'title' => 'Statusul curent de suporter',
            'valid_until' => 'Tag-ul tău curent de suporter este valid până la :date!',
            'was_valid_until' => 'Tag-ul tău de suporter a fost valid pâna la data de :date.',
        ],

        'why_support' => [
            'title' => 'De ce ar trebui să sprijin osu!?',
            'blocks' => [
                'dev' => 'Dezvoltat și menținut predominant de un tip în Australia',
                'time' => 'Ia atât de mult timp să-l mențin că nu mai poate fi posibil să-l numesc un "hobby".',
                'ads' => 'Niciun anunț oriunde.<br/><br/>
                        Spre deosebire de 99.95% din web, noi nu profităm prin a-ți aunca lucruri în față.',
                'goodies' => 'Primești niște avantaje suplimentare!',
            ],
        ],

        'perks' => [
            'title' => 'Oh? Ce primesc?!',
            'osu_direct' => [
                'title' => 'osu!direct',
                'description' => 'acces rapid și ușor pentru a căuta beatmaps fără a părăsi jocul.',
            ],

            'auto_downloads' => [
                'title' => 'Descărcări automate',
                'description' => 'Descărcări automate când joci multiplayer, când îi urmărești pe alții, sau când dai clic pe link-uri în chat!',
            ],

            'upload_more' => [
                'title' => 'Încarcă mai mult',
                'description' => 'Sloturi suplimentare pentru beatmaps în așteptare (pe beatmap clasificat) până la un maxim de 10.',
            ],

            'early_access' => [
                'title' => 'Acces anticipat',
                'description' => 'Acces la lansări timpurii, unde poți încerca noi funcții înainte de toți ceilalți!',
            ],

            'customisation' => [
                'title' => 'Personalizare',
                'description' => 'Personalizează-ți profilul adăugând o pagină de utilizator complet personalizabilă.',
            ],

            'beatmap_filters' => [
                'title' => 'Organizarea beatmap',
                'description' => 'Filtrează cautările de beatmaps, prin mape jucate și nejucate, dar și prin clasamentul obținut (dacă există).',
            ],

            'yellow_fellow' => [
                'title' => 'Porecla de aur',
                'description' => 'Fii recunoscut în joc cu o nouă culoare galben-deschis.',
            ],

            'speedy_downloads' => [
                'title' => 'Descărcări rapide',
                'description' => 'Mai puține restricții de descărcare, mai ales când folosești osu!direct.',
            ],

            'change_username' => [
                'title' => 'Schimbarea numelui de utilizator',
                'description' => 'Abilitatea de a-ți schimba numele fără costuri suplimentare. (o singură dată)',
            ],

            'skinnables' => [
                'title' => 'Posibilități de personalizare',
                'description' => 'Posibilități extra de personalizare în joc, ca fundalul din meniul principal.',
            ],

            'feature_votes' => [
                'title' => 'Voturi pentru funcționalități',
                'description' => 'Votează pentru funcționalități noi. (2 pe lună)',
            ],

            'sort_options' => [
                'title' => 'Opțiuni de sortare',
                'description' => 'Abilitatea de a vedea clasarea după țară / prieteni / moduri specifice în joc.',
            ],

            'feel_special' => [
                'title' => 'Simte-te special',
                'description' => 'Sentimentul special de a participa la buna funcționare osu!',
            ],

            'more_to_come' => [
                'title' => 'Și mult mai multe în viitor',
                'description' => '',
            ],
        ],

        'convinced' => [
            'title' => 'Sunt convins! :D',
            'support' => 'sprijină osu!',
            'gift' => 'sau oferiți altor jucători',
            'instructions' => 'Faceți clic pe butonul în formă de inimă pentru a merge la magazinul osu!',
        ],
    ],
];
