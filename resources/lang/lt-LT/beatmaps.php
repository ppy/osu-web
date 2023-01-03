<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'discussion-votes' => [
        'update' => [
            'error' => 'Balsavimo nepavyko atnaujinti',
        ],
    ],

    'discussions' => [
        'allow_kudosu' => 'leisti kudosu',
        'beatmap_information' => 'Bitmapo Puslapis',
        'delete' => 'ištrinti',
        'deleted' => 'Ištrinė :editor :delete_time.',
        'deny_kudosu' => 'atmesti kudosu',
        'edit' => 'redaguoti',
        'edited' => 'Paskutinį kartą redagavo :editor :update_time.',
        'guest' => 'Svečio sunkumas iš :user',
        'kudosu_denied' => 'Uždrausta gauti kudosu.',
        'message_placeholder_deleted_beatmap' => 'Šis sudėtingumas buvo ištrintas, todėl jo diskusijos nebegalimos.',
        'message_placeholder_locked' => 'Šio bitmapo diskusijos buvo išjungtos.',
        'message_placeholder_silenced' => "Negali publikuoti diskusijose kol esi užtildytas.",
        'message_type_select' => 'Pasirink Komentaro Tipą',
        'reply_notice' => 'Spausk Enter norint atsakyti.',
        'reply_placeholder' => 'Rašykite savo atsakymą čia',
        'require-login' => 'Atsakymui reikia prisijungti',
        'resolved' => 'Išspręsta',
        'restore' => 'atkurti',
        'show_deleted' => 'Peržiūrėti ištrintus',
        'title' => 'Diskusijos',

        'collapse' => [
            'all-collapse' => 'Sutraukti visus',
            'all-expand' => 'Išskleisti visus',
        ],

        'empty' => [
            'empty' => 'Diskusijų kol kas nėra!',
            'hidden' => 'Nėra diskusijų atitinkančių filtrą.',
        ],

        'lock' => [
            'button' => [
                'lock' => 'Užrakinti diskusijas',
                'unlock' => 'Atrakinti diskusijas',
            ],

            'prompt' => [
                'lock' => 'Priežastis dėl užrakinimo',
                'unlock' => 'Ar tikrai norite atrakinti?',
            ],
        ],

        'message_hint' => [
            'in_general' => 'Ši žinutė bus perkeltą į bendrą bitmapo diskusiją. Sunkumo kritikavimui, pradėk žinutę su laiko žyma (pvz.: 00:12:345).',
            'in_timeline' => 'Kad kritikuoti kelias laiko žymas, publikuok kelis kartus (vieną publikacija per laiko žymę).',
        ],

        'message_placeholder' => [
            'general' => 'Rašyk čia, kad publikuoti į Bendrą (:version)',
            'generalAll' => 'Rašyk čia kad, publikuoti į Bendrą (Visiem sunkumams)',
            'review' => 'Rašyk čia savo apžvalgą',
            'timeline' => 'Rašyk čia, kad publikuoti į Laiko juostą (:version)',
        ],

        'message_type' => [
            'disqualify' => 'Diskvalifikuoti',
            'hype' => 'Skatinti!',
            'mapper_note' => 'Pastaba',
            'nomination_reset' => 'Atstatyti Nominaciją',
            'praise' => 'Pagirti',
            'problem' => 'Problema',
            'problem_warning' => 'Pranešti Problemą',
            'review' => 'Apžvalga',
            'suggestion' => 'Pasiūlymas',
        ],

        'mode' => [
            'events' => 'Istorija',
            'general' => 'Bendra :scope',
            'reviews' => 'Apžvalgos',
            'timeline' => 'Laiko juosta',
            'scopes' => [
                'general' => 'Šis sunkumas',
                'generalAll' => 'Visi sunkumai',
            ],
        ],

        'new' => [
            'pin' => 'Prisegti',
            'timestamp' => 'Laiko žymė',
            'timestamp_missing' => 'ctrl+c redagavimo lange ir įklijuok į savo žinutę, kad pridėti laiko žymę!',
            'title' => 'Nauja Diskusija',
            'unpin' => 'Atsegti',
        ],

        'review' => [
            'new' => 'Nauja Apžvalga',
            'embed' => [
                'delete' => 'Ištrinti',
                'missing' => '[DISKUSIJA IŠTRINTA]',
                'unlink' => 'Atsieti',
                'unsaved' => 'Neišsaugota',
                'timestamp' => [
                    'all-diff' => 'Publikacijos tarp „Visi sunkumai“ negali būti pažymėtas laiko žyma.',
                    'diff' => 'Jei šis :type prasideda su laiko žyma, jis bus rodomas Laiko Juostoje.',
                ],
            ],
            'insert-block' => [
                'paragraph' => 'įterpti pastraipą',
                'praise' => 'įterpti pagyrimą',
                'problem' => 'įterpti problemą',
                'suggestion' => 'įterpti pasiūlymą',
            ],
        ],

        'show' => [
            'title' => ':title sukūrė :mapper',
        ],

        'sort' => [
            'created_at' => 'Sukūrimo laikas',
            'timeline' => 'Laiko juosta',
            'updated_at' => 'Paskutinis atnaujinimas',
        ],

        'stats' => [
            'deleted' => 'Ištrinta',
            'mapper_notes' => 'Pastabos',
            'mine' => 'Mano',
            'pending' => 'Laukiantis',
            'praises' => 'Pagyrimai',
            'resolved' => 'Išspręsta',
            'total' => 'Visi',
        ],

        'status-messages' => [
            'approved' => 'Šis bitmapas buvo patvirtintas :date!',
            'graveyard' => "Šis bitmapas jau nebeatnaujinamas nuo :date ir greičiausiai buvo apleistas kūrėjo...",
            'loved' => 'Šis beatmapas buvo pridėtas kaip mylimas nuo :date!',
            'ranked' => 'Šis bitmapas buvo reitinguotas nuo :date!',
            'wip' => 'Pastaba: Šis bitmapas yra kūrėjo pažymėtas kaip vis dar kuriamas.',
        ],

        'votes' => [
            'none' => [
                'down' => 'Dar nėra neigiamų balsų',
                'up' => 'Dar nėra teigiamų balsų',
            ],
            'latest' => [
                'down' => 'Pastarieji neigiami balsavimai',
                'up' => 'Pastarieji teigiami balsavimai',
            ],
        ],
    ],

    'hype' => [
        'button' => 'Skatinti Bitmapą!',
        'button_done' => 'Jau Paskatintas!',
        'confirm' => "Ar jūs užtikrintas? Tai išnaudos vieną iš tavo likusių :n skatinimų, ir šio veiksmo nebus galima grąžinti.",
        'explanation' => 'Skatink šį bitmapą, kad jis būtų labiau matomas nominacijai ir reitingavimui!',
        'explanation_guest' => 'Prisijunk ir skatink šį bitmapą, kad jis taptu labiau matomas nominavimui ir reitingavimui!',
        'new_time' => "Jūs gausite dar vieną skatinimą :new_time.",
        'remaining' => 'Jums liko :remaining skatinimai(-ų).',
        'required_text' => 'Skatinimai: :current/:required',
        'section_title' => 'Skatinimo Traukinys',
        'title' => 'Skatinimas',
    ],

    'feedback' => [
        'button' => 'Palikti Atsiliepimą',
    ],

    'nominations' => [
        'delete' => 'Ištrinti',
        'delete_own_confirm' => 'Ar jūs užtikrintas? Bitmapas bus pašalintas ir būsite nukreiptas į savo profilį.',
        'delete_other_confirm' => 'Ar jūs užtikrintas? Bitmapas bus pašalintas ir būsite nukreiptas į vartotojo profilį.',
        'disqualification_prompt' => 'Kodėl diskvalifikuoji?',
        'disqualified_at' => 'Diskvalifikuotas prieš :time_ago (:reason).',
        'disqualified_no_reason' => 'nėra nurodytos priežasties',
        'disqualify' => 'Diskvalifikuoti',
        'incorrect_state' => 'Įvyko klaida atliekant šį veiksmą, pamėgink atnaujinti puslapį.',
        'love' => 'Mylimas',
        'love_choose' => 'Pasirink sunkumą mylimam',
        'love_confirm' => 'Bitmapą į mylimus?',
        'nominate' => 'Nominuoti',
        'nominate_confirm' => 'Nominuoti šį bitmapą?',
        'nominated_by' => 'nominavo :users',
        'not_enough_hype' => "Nepakanka skatinimų.",
        'remove_from_loved' => 'Pašalinti iš Mylimų',
        'remove_from_loved_prompt' => 'Priežastis dėl pašalinimo iš Mylimų:',
        'required_text' => 'Nominacijos: :current/:required',
        'reset_message_deleted' => 'ištrinta',
        'title' => 'Nominacijos Būsena',
        'unresolved_issues' => 'Dar yra neišspręstų problemų, kurias privalote išspręsti.',

        'rank_estimate' => [
            '_' => 'Numatoma, kad šis bitmapas bus reitinguotas :date, jei nebus rasta problemų. Jis yra #:position tarp :queue.',
            'queue' => 'reitingavimo eilės',
            'soon' => 'greitai',
        ],

        'reset_at' => [
            'nomination_reset' => 'Nominavimo procesas atstatė :time_ago :user su nauja problema :discussion (:message).',
            'disqualify' => 'Prieš :time_ago diskvalifikavo :user su nauja problema :discussion (:message).',
        ],

        'reset_confirm' => [
            'disqualify' => 'Ar jūs užtikrintas? Tai pašalins bitmapą iš kvalifikuotų ir atstatis nominavimo procesą.',
            'nomination_reset' => 'Ar jūs užtikrintas? Naujos problemos publikavimas atstatis nominavimo procesą.',
            'problem_warning' => 'Ar tiktai norite pranešti problemą šiame bitmape? Bitmapo nominuotojai bus informuoti apie problemą.',
        ],
    ],

    'listing' => [
        'search' => [
            'prompt' => 'įveskite raktažodį...',
            'login_required' => 'Prisijunkite, kad ieškoti.',
            'options' => 'Daugiau Paieškos Pasirinkimų',
            'supporter_filter' => 'Rūšiavimas pagal :filters reikalauja aktyvios osu!rėmėjo žymos',
            'not-found' => 'nėra rezultatų',
            'not-found-quote' => '... ne, nieko nerasta.',
            'filters' => [
                'extra' => 'Papildoma',
                'general' => 'Bendra',
                'genre' => 'Žanras',
                'language' => 'Kalba',
                'mode' => 'Režimas',
                'nsfw' => 'Eksplicitinis Turinys',
                'played' => 'Žaista',
                'rank' => 'Pasiektas Reitingas',
                'status' => 'Kategorijos',
            ],
            'sorting' => [
                'title' => 'Pavadinimas',
                'artist' => 'Atlikėjas',
                'difficulty' => 'Sunkumas',
                'favourites' => 'Mėgstamiausi',
                'updated' => 'Atnaujintas',
                'ranked' => 'Reitinguotas',
                'rating' => 'Įvertinimas',
                'plays' => 'Sužaidimai',
                'relevance' => 'Aktualumas',
                'nominations' => 'Nominacijos',
            ],
            'supporter_filter_quote' => [
                '_' => 'Rūšiavimas pagal :filters reikalauja aktyvios :link',
                'link_text' => 'osu!rėmėjo žymos',
            ],
        ],
    ],
    'general' => [
        'converts' => 'Įtraukti konvertuotus bitmapus',
        'featured_artists' => 'Rekomenduojami atlikėjai',
        'follows' => 'Sekami maperiai',
        'recommended' => 'Rekomenduojamas sunkumas',
        'spotlights' => 'Pasižymėję bitmapai',
    ],
    'mode' => [
        'all' => 'Visi',
        'any' => 'Bet koks',
        'osu' => '',
        'taiko' => '',
        'fruits' => '',
        'mania' => '',
    ],
    'status' => [
        'any' => 'Bet kokie',
        'approved' => 'Patvirtintas',
        'favourites' => 'Mėgstamiausi',
        'graveyard' => 'Kapinės',
        'leaderboard' => 'Turi Rezultatų lentą',
        'loved' => 'Mylimi',
        'mine' => 'Mano Bitmapai',
        'pending' => 'Laukiantis',
        'wip' => 'WIP',
        'qualified' => 'Kvalifikuoti',
        'ranked' => 'Reitinguoti',
    ],
    'genre' => [
        'any' => 'Bet koks',
        'unspecified' => 'Nenurodyta',
        'video-game' => 'Kompiuterinis žaidimas',
        'anime' => 'Anime',
        'rock' => 'Rokas',
        'pop' => 'Pop',
        'other' => 'Kiti',
        'novelty' => 'Neįprastas',
        'hip-hop' => 'Hiphopas',
        'electronic' => 'Elektronika',
        'metal' => 'Metalas',
        'classical' => 'Klasikinė',
        'folk' => 'Liaudies',
        'jazz' => 'Džiazas',
    ],
    'language' => [
        'any' => 'Bet kokia',
        'english' => 'Anglų',
        'chinese' => 'Kinų',
        'french' => 'Prancūzų',
        'german' => 'Vokiečių',
        'italian' => 'Italų',
        'japanese' => 'Japonų',
        'korean' => 'Korėjiečių',
        'spanish' => 'Ispanų',
        'swedish' => 'Švedų',
        'russian' => 'Rusų',
        'polish' => 'Lenkų',
        'instrumental' => 'Instrumentinė',
        'other' => 'Kiti',
        'unspecified' => 'Nenurodyta',
    ],

    'nsfw' => [
        'exclude' => 'Slėpti',
        'include' => 'Rodyti',
    ],

    'played' => [
        'any' => 'Bet kokie',
        'played' => 'Žaista',
        'unplayed' => 'Nežaisti',
    ],
    'extra' => [
        'video' => 'Turi Vaizdo įrašą',
        'storyboard' => 'Foninę Animaciją',
    ],
    'rank' => [
        'any' => 'Bet koks',
        'XH' => 'Sidabrinis SS',
        'X' => '',
        'SH' => 'Sidabrinis S',
        'S' => '',
        'A' => '',
        'B' => '',
        'C' => '',
        'D' => '',
    ],
    'panel' => [
        'playcount' => 'Sužaidimų skaičius :count',
        'favourites' => 'Mėgstamiausi :count',
    ],
    'variant' => [
        'mania' => [
            '4k' => '4K',
            '7k' => '7К',
            'all' => 'Visi',
        ],
    ],
];
