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
    'discussion-posts' => [
        'store' => [
            'error' => 'Salvarea postării a eșuat',
        ],
    ],

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
        'kudosu_denied' => 'A refuzat să primească kudosu.',
        'message_placeholder_deleted_beatmap' => 'Această dificultate a fost ștearsă, deci e posibil să nu mai fie discutată.',
        'message_placeholder_locked' => 'Discuție pentru acest beatmap a fost dezactivată.',
        'message_type_select' => 'Selectează tipul comentariului',
        'reply_notice' => 'Apasă enter pentru a răspunde.',
        'reply_placeholder' => 'Scrie-ți răspunsul aici',
        'require-login' => 'Te rugăm să te conectezi pentru a posta sau a răspunde',
        'resolved' => 'Rezolvat',
        'restore' => 'restabilește',
        'show_deleted' => 'Arată șters',
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
                'lock' => 'Motiv pentru încheiere',
                'unlock' => 'Ești sigur că vrei să deblocați?',
            ],
        ],

        'message_hint' => [
            'in_general' => 'Această postare va merge la discuția beatmapset generală. Pentru a modifica acest beatmap, începe mesajul cu un marcaj temporal (ex: 00:12:345).',
            'in_timeline' => 'Pentru a modifica mai multe mărcaje de timp, postează de mai multe ori (o postare per marcaj temporal).',
        ],

        'message_placeholder' => [
            'general' => 'Scrie aici pentru a posta în General (:version)',
            'generalAll' => 'Scrie aici pentru a posta în General (toate dificultățile)',
            'timeline' => 'Scrie aici pentru a posta în Cronologie (:version)',
        ],

        'message_type' => [
            'disqualify' => 'Descalifică',
            'hype' => 'Hype!',
            'mapper_note' => 'Notă',
            'nomination_reset' => 'Resetați nominalizarea',
            'praise' => 'Laudă',
            'problem' => 'Problemă',
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
            'unpin' => 'DeFixează',
        ],

        'show' => [
            'title' => ':title mapat de :mapper',
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
            'loved' => 'Acest beatmap a fost adăugat la \'loved\' pe :date!',
            'ranked' => 'Acest beatmap a fost clasat pe :date!',
            'wip' => 'Notă: Acest beatmap este marcat ca o lucrare în desfășurare de către creator.',
        ],

        'votes' => [
            'none' => [
                'down' => 'Niciun downvote încă',
                'up' => 'Niciun upvote încă',
            ],
            'latest' => [
                'down' => 'Cele mai noi downvoturi',
                'up' => 'Cele mai noi upvote-uri',
            ],
        ],
    ],

    'hype' => [
        'button' => '\'Hype\' acest beatmap!',
        'button_done' => 'Deja entuziasmat!',
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
        'love' => 'Love',
        'love_confirm' => '\'Love\' acest beatmap?',
        'nominate' => 'Nominalizează',
        'nominate_confirm' => 'Nominalizezi acest beatmap?',
        'nominated_by' => 'nominalizat de :users',
        'not_enough_hype' => "Nu este suficient hype.",
        'qualified' => 'Estimat pentru a fi clasat pe :date, dacă nu sunt găsite probleme.',
        'qualified_soon' => 'Estimat să fie clasat în curând, dacă nu sunt găsite probleme.',
        'required_text' => 'Nominalizări: :current/:required',
        'reset_message_deleted' => 'șters',
        'title' => 'Statutul de nominalizare',
        'unresolved_issues' => 'Încă există probleme nerezolvate care trebuie să fie abordate mai întâi.',

        'reset_at' => [
            'nomination_reset' => 'Procesul de nominalizare a fost resetat :time_ago de :user cu noua problemă :discussion (:message).',
            'disqualify' => 'Descalificat :time_ago de :user cu noua problemă :discussion (:message).',
        ],

        'reset_confirm' => [
            'nomination_reset' => 'Ești sigur? Postarea unei probleme noi va reseta procesul de nominalizare.',
            'disqualify' => 'Ești sigur? Asta va elimina beatmap-ul din calificare și va reseta procesul de nominalizare.',
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
                'general' => 'General',
                'mode' => 'Mod',
                'status' => 'Categorii',
                'genre' => 'Gen',
                'language' => 'Limbă',
                'extra' => 'extra',
                'rank' => 'Clasament atins',
                'played' => 'Jucat',
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
                'link_text' => 'etichetă de suporter osu!',
            ],
        ],
    ],
    'general' => [
        'recommended' => 'Dificultatea recomandată',
        'converts' => 'Include beatmaps convertite',
    ],
    'mode' => [
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
        'graveyard' => 'Graveyard',
        'leaderboard' => 'Are Clasament',
        'loved' => 'Loved',
        'mine' => 'Hărțile mele',
        'pending' => 'În așteptare & în lucru',
        'qualified' => 'Calificate',
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
        'novelty' => 'Noutate',
        'hip-hop' => 'Hip Hop',
        'electronic' => 'Electronic',
    ],
    'mods' => [
        '4K' => '',
        '5K' => '',
        '6K' => '',
        '7K' => '',
        '8K' => '',
        '9K' => '',
        'AP' => '',
        'DT' => '',
        'EZ' => '',
        'FI' => '',
        'FL' => '',
        'HD' => '',
        'HR' => '',
        'HT' => '',
        'MR' => '',
        'NC' => '',
        'NF' => '',
        'NM' => '',
        'PF' => '',
        'Relax' => '',
        'SD' => '',
        'SO' => '',
        'TD' => '',
    ],
    'language' => [
        'any' => '',
        'english' => 'Engleză',
        'chinese' => 'Chineză',
        'french' => 'Franceză',
        'german' => 'Germană',
        'italian' => 'Italiană',
        'japanese' => 'Japoneză',
        'korean' => 'Coreeană',
        'spanish' => 'Spaniolă',
        'swedish' => 'Suedeză',
        'instrumental' => 'Instrumental',
        'other' => 'Altul',
    ],
    'played' => [
        'any' => 'Oricare',
        'played' => 'Jucat',
        'unplayed' => 'Nejucat',
    ],
    'extra' => [
        'video' => 'Cu videoclip',
        'storyboard' => 'Cu storyboard',
    ],
    'rank' => [
        'any' => 'Oricare',
        'XH' => 'SS de argint',
        'X' => '',
        'SH' => 'S de argint',
        'S' => '',
        'A' => '',
        'B' => '',
        'C' => '',
        'D' => '',
    ],
    'panel' => [
        'playcount' => 'Numărul de jocuri :count',
        'favourites' => 'Favorite :count',
    ],
];
