<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'discussion-votes' => [
        'update' => [
            'error' => 'Actualizarea votului a eșuat',
        ],
    ],

    'discussions' => [
        'allow_kudosu' => 'permite kudosu',
        'beatmap_information' => 'Pagină Beatmap',
        'delete' => 'șterge',
        'deleted' => 'Șters de :editor :delete_time.',
        'deny_kudosu' => 'refuză kudosu',
        'edit' => 'editează',
        'edited' => 'Ultima dată editat de :editor :update_time.',
        'guest' => 'Dificultate cu participare ca oaspete de :user',
        'kudosu_denied' => 'A fost refuzat din a obține kudosu.',
        'message_placeholder_deleted_beatmap' => 'Această dificultate a fost ștearsă, astfel nu mai este posibil să fie discutată.',
        'message_placeholder_locked' => 'Discuția pentru acest beatmap a fost dezactivată.',
        'message_placeholder_silenced' => "Nu poți posta atunci când ești mut.",
        'message_type_select' => 'Selectează tipul comentariului',
        'reply_notice' => 'Apasă enter pentru a răspunde.',
        'reply_placeholder' => 'Scrie-ți răspunsul aici',
        'require-login' => 'Te rugăm să te conectezi pentru a posta sau a răspunde',
        'resolved' => 'Rezolvat',
        'restore' => 'restabilește',
        'show_deleted' => 'Arată șterse',
        'title' => 'Discuții',

        'collapse' => [
            'all-collapse' => 'Restrânge tot',
            'all-expand' => 'Extinde tot',
        ],

        'empty' => [
            'empty' => 'Nicio discuție încă!',
            'hidden' => 'Nicio discuție nu se potrivește cu filtrul selectat.',
        ],

        'lock' => [
            'button' => [
                'lock' => 'Încheie Discuția',
                'unlock' => 'Deblochează Discuția',
            ],

            'prompt' => [
                'lock' => 'Motiv pentru blocare',
                'unlock' => 'Ești sigur că vrei să deblochezi?',
            ],
        ],

        'message_hint' => [
            'in_general' => 'Această postare va merge la discuția beatmap generală. Pentru a da mod la acest beatmap, începe mesajul cu un marcaj temporal (ex: 00:12:345).',
            'in_timeline' => 'Pentru a da mod la mai multe mărcaje de timp, postează de mai multe ori (o postare per marcaj temporal).',
        ],

        'message_placeholder' => [
            'general' => 'Scrie aici pentru a posta în General (:version)',
            'generalAll' => 'Scrie aici pentru a posta în General (toate dificultățile)',
            'review' => 'Scrie aici pentru a posta o recenzie',
            'timeline' => 'Scrie aici pentru a posta în Cronologie (:version)',
        ],

        'message_type' => [
            'disqualify' => 'Descalifică',
            'hype' => 'Hype!',
            'mapper_note' => 'Notă',
            'nomination_reset' => 'Resetați nominalizarea',
            'praise' => 'Laudă',
            'problem' => 'Problemă',
            'problem_warning' => 'Raportează o problemă',
            'review' => 'Recenzie',
            'suggestion' => 'Sugestie',
        ],

        'mode' => [
            'events' => 'Istoric',
            'general' => 'General :scope',
            'reviews' => 'Recenzii',
            'timeline' => 'Cronologie',
            'scopes' => [
                'general' => 'Această dificultate',
                'generalAll' => 'Toate dificultățile',
            ],
        ],

        'new' => [
            'pin' => 'Fixează',
            'timestamp' => 'Marcaj de timp',
            'timestamp_missing' => 'ctrl-c în modul de editare și lipește-ți mesajul pentru a adăuga un marcaj de timp!',
            'title' => 'Discuție nouă',
            'unpin' => 'Defixează',
        ],

        'review' => [
            'new' => 'Recenzie Nouă',
            'embed' => [
                'delete' => 'Șterge',
                'missing' => '[DISCUȚIE ȘTEARSĂ]',
                'unlink' => 'Dezasociați',
                'unsaved' => 'Nesalvat',
                'timestamp' => [
                    'all-diff' => 'Postările de pe "Toate dificultățile" nu pot conține marcaje de timp.',
                    'diff' => 'Dacă această :type începe cu un marcaj de timp, va fi arătată sub Cronologie.',
                ],
            ],
            'insert-block' => [
                'paragraph' => 'inserează un paragraf',
                'praise' => 'inserează laudă',
                'problem' => 'inserează problemă',
                'suggestion' => 'inserează sugestie',
            ],
        ],

        'show' => [
            'title' => ':title creat de :mapper',
        ],

        'sort' => [
            'created_at' => 'Data creării',
            'timeline' => 'Cronologie',
            'updated_at' => 'Ultima actualizare',
        ],

        'stats' => [
            'deleted' => 'Șters',
            'mapper_notes' => 'Note',
            'mine' => 'Ale mele',
            'pending' => 'În așteptare',
            'praises' => 'Laude',
            'resolved' => 'Rezolvat',
            'total' => 'Tot',
        ],

        'status-messages' => [
            'approved' => 'Acest beatmap a fost aprobat pe :date!',
            'graveyard' => "Acest beatmap nu a fost actualizat din :date și este cel mai probabil abandonat de către creator...",
            'loved' => 'Acest beatmap a fost adăugat la Iubit pe :date!',
            'ranked' => 'Acest beatmap a fost clasat pe :date!',
            'wip' => 'Notă: Acest beatmap este marcat ca fiind în lucru de către creator.',
        ],

        'votes' => [
            'none' => [
                'down' => 'Niciun downvote încă',
                'up' => 'Niciun upvote încă',
            ],
            'latest' => [
                'down' => 'Ultimele downvote-uri',
                'up' => 'Ultimele upvote-uri',
            ],
        ],
    ],

    'hype' => [
        'button' => '\'Hype\' acest beatmap!',
        'button_done' => 'Deja Hyped!',
        'confirm' => "Ești sigur? Acest lucru îți va folosi unul din restul tău de :n 'hype' rămași și nu poate fi anulat.",
        'explanation' => '\'Hype\' acest beatmap pentru a-l face mai vizibil pentru nominalizare și clasament!',
        'explanation_guest' => 'Conectează-te și \'hype\' acest beatmap pentru a-l face mai vizibil pentru nominalizare și clasament!',
        'new_time' => "O să primești alt 'hype' pe :new_time.",
        'remaining' => 'Mai ai :remaining \'hype\' rămași.',
        'required_text' => 'Hype: :current/:required',
        'section_title' => 'Trenul Hype',
        'title' => 'Hype',
    ],

    'feedback' => [
        'button' => 'Spune-ți părerea',
    ],

    'nominations' => [
        'delete' => 'Șterge',
        'delete_own_confirm' => 'Ești sigur? Acest beatmap va fi șters, iar tu vei fi redirecționat înapoi la profilul tău.',
        'delete_other_confirm' => 'Ești sigur? Acest beatmap va fi șters, iar tu vei fi redirecționat înapoi la profilul utilizatorului.',
        'disqualification_prompt' => 'Motiv pentru descalificare?',
        'disqualified_at' => 'Descalificat :time_ago (:reason).',
        'disqualified_no_reason' => 'niciun răspuns specificat',
        'disqualify' => 'Descalificare',
        'incorrect_state' => 'S-a produs o eroare la efectuarea acestei acțiuni, încearcă să reîmprospătezi pagina.',
        'love' => 'Iubește',
        'love_choose' => 'Alege dificultatea pentru Iubit',
        'love_confirm' => 'Iubește acest beatmap?',
        'nominate' => 'Nominalizează',
        'nominate_confirm' => 'Nominalizezi acest beatmap?',
        'nominated_by' => 'nominalizat de :users',
        'not_enough_hype' => "Nu este suficient hype.",
        'remove_from_loved' => 'Șterge din Iubit',
        'remove_from_loved_prompt' => 'Motivul pentru ștergere din Iubit:',
        'required_text' => 'Nominalizări: :current/:required',
        'reset_message_deleted' => 'șters',
        'title' => 'Statutul de nominalizare',
        'unresolved_issues' => 'Încă există probleme nerezolvate care trebuie să fie abordate mai întâi.',

        'rank_estimate' => [
            '_' => 'Acest beatmap este estimat a fi clasificat în data de :date dacă nu sunt găsite probleme. Este #:position în :queue.',
            'on' => 'pe :date',
            'queue' => 'lista de așteptare pentru clasament',
            'soon' => 'în curând',
        ],

        'reset_at' => [
            'nomination_reset' => 'Procesul de nominalizare a fost resetat :time_ago de :user cu noua problemă :discussion (:message).',
            'disqualify' => 'Descalificat :time_ago de :user cu noua problemă :discussion (:message).',
        ],

        'reset_confirm' => [
            'disqualify' => 'Ești sigur? Asta va elimina beatmap-ul din calificare și va reseta procesul de nominalizare.',
            'nomination_reset' => 'Ești sigur? Postarea unei probleme noi va reseta procesul de nominalizare.',
            'problem_warning' => 'Ești sigur că vrei să raportezi problema pe acest beatmap? Acest lucru va alerta nominalizatorii.',
        ],
    ],

    'listing' => [
        'search' => [
            'prompt' => 'scrieți cuvinte cheie...',
            'login_required' => 'Conectează-te pentru a căuta.',
            'options' => 'Mai multe opțiuni de căutare',
            'supporter_filter' => 'Trebuie să fii un suporter osu! pentru a putea filtra prin :filters',
            'not-found' => 'niciun rezultat',
            'not-found-quote' => '... nup, nimic găsit.',
            'filters' => [
                'extra' => 'Extra',
                'general' => 'General',
                'genre' => 'Gen',
                'language' => 'Limbă',
                'mode' => 'Mod',
                'nsfw' => 'Conținut Obscen',
                'played' => 'Jucat',
                'rank' => 'Clasament Obținut',
                'status' => 'Categorii',
            ],
            'sorting' => [
                'title' => 'Titlu',
                'artist' => 'Artist',
                'difficulty' => 'Dificultate',
                'favourites' => 'Favorite',
                'updated' => 'Actualizat',
                'ranked' => 'Clasat',
                'rating' => 'Evaluare',
                'plays' => 'Jocuri',
                'relevance' => 'Relevanţă',
                'nominations' => 'Nominalizări',
            ],
            'supporter_filter_quote' => [
                '_' => 'Ai nevoie de un :link activ pentru a filtra prin :filters',
                'link_text' => 'status de suporter osu!',
            ],
        ],
    ],
    'general' => [
        'converts' => 'Include beatmap-uri convertite',
        'featured_artists' => 'Artiști oficiali',
        'follows' => 'Creatori beatmap-uri la care sunteți abonat',
        'recommended' => 'Dificultate recomandată',
        'spotlights' => 'Beatmap-uri promovate',
    ],
    'mode' => [
        'all' => 'Toate',
        'any' => 'Oricare',
        'osu' => '',
        'taiko' => '',
        'fruits' => '',
        'mania' => '',
    ],
    'status' => [
        'any' => 'Oricare',
        'approved' => 'Aprobate',
        'favourites' => 'Favorite',
        'graveyard' => 'Inactiv',
        'leaderboard' => 'Are Clasament',
        'loved' => 'Iubit',
        'mine' => 'Beatmap-urile Mele',
        'pending' => 'În așteptare',
        'wip' => 'În lucru',
        'qualified' => 'Calificat',
        'ranked' => 'Clasat',
    ],
    'genre' => [
        'any' => 'Oricare',
        'unspecified' => 'Nespecificat',
        'video-game' => 'Joc video',
        'anime' => 'Anime',
        'rock' => 'Rock',
        'pop' => 'Pop',
        'other' => 'Altul',
        'novelty' => 'Fantezie',
        'hip-hop' => 'Hip Hop',
        'electronic' => 'Electronic',
        'metal' => 'Metal',
        'classical' => 'Clasică',
        'folk' => 'Folclor',
        'jazz' => 'Jazz',
    ],
    'language' => [
        'any' => 'Orice',
        'english' => 'Engleză',
        'chinese' => 'Chineză',
        'french' => 'Franceză',
        'german' => 'Germană',
        'italian' => 'Italiană',
        'japanese' => 'Japoneză',
        'korean' => 'Coreeană',
        'spanish' => 'Spaniolă',
        'swedish' => 'Suedeză',
        'russian' => 'Rusă',
        'polish' => 'Poloneză',
        'instrumental' => 'Instrumental',
        'other' => 'Altul',
        'unspecified' => 'Nespecificat',
    ],

    'nsfw' => [
        'exclude' => 'Ascunde',
        'include' => 'Arată',
    ],

    'played' => [
        'any' => 'Oricare',
        'played' => 'Jucat',
        'unplayed' => 'Nejucat',
    ],
    'extra' => [
        'video' => 'Cu video',
        'storyboard' => 'Cu storyboard',
    ],
    'rank' => [
        'any' => 'Oricare',
        'XH' => 'SS Argintiu',
        'X' => '',
        'SH' => 'S Argintiu',
        'S' => '',
        'A' => '',
        'B' => '',
        'C' => '',
        'D' => '',
    ],
    'panel' => [
        'playcount' => 'Număr încercări: :count',
        'favourites' => 'Favorite: :count',
    ],
    'variant' => [
        'mania' => [
            '4k' => '4K',
            '7k' => '7K',
            'all' => 'Tot',
        ],
    ],
];
