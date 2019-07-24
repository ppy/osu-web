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
    'deleted' => '[utilizator șters]',

    'beatmapset_activities' => [
        'title' => "Istoricul modificărilor lui :user",
        'title_compact' => 'Modding',

        'discussions' => [
            'title_recent' => 'Discuții începute recent',
        ],

        'events' => [
            'title_recent' => 'Evenimente recente',
        ],

        'posts' => [
            'title_recent' => 'Postări recente',
        ],

        'votes_received' => [
            'title_most' => 'Cele mai aprecitate (ultimele 3 luni)',
        ],

        'votes_made' => [
            'title_most' => 'Cele mai apreciate (ultimele 3 luni)',
        ],
    ],

    'blocks' => [
        'banner_text' => 'Ai blocat acest utilizator.',
        'blocked_count' => 'utilizatori blocați (:count)',
        'hide_profile' => 'ascunde profilul',
        'not_blocked' => 'Acest utilizator nu este blocat.',
        'show_profile' => 'arată profilul',
        'too_many' => 'A fost atinsă limita de blocare.',
        'button' => [
            'block' => 'blochează',
            'unblock' => 'deblochează',
        ],
    ],

    'card' => [
        'loading' => 'Se încarcă...',
        'send_message' => 'trimite mesaj',
    ],

    'login' => [
        '_' => 'Autentifică-te',
        'locked_ip' => 'adresa ta IP este blocată. Te rugăm să aștepți câteva minute.',
        'username' => 'Nume de utilizator',
        'password' => 'Parolă',
        'button' => 'Autentifică-te',
        'button_posting' => 'Se conectează...',
        'remember' => 'Ține-mă minte pe acest computer',
        'title' => 'Te rog autentifică-te pentru a continua',
        'failed' => 'Conectare incorectă',
        'register' => "Nu ai un cont osu!? Fă-ți unul nou",
        'forgot' => 'Ți-ai uitat parola?',
        'beta' => [
            'main' => 'Accesul beta este momentan limitat la utilizatorii autorizați.',
            'small' => '(suporterii osu! vor primi acces curând)',
        ],

        'here' => 'aici', // this is substituted in when generating a link above. change it to suit the language.
    ],

    'posts' => [
        'title' => 'Postările lui :username',
    ],

    'signup' => [
        '_' => 'Înregistrează-te',
    ],
    'anonymous' => [
        'login_link' => 'dă clic pentru a te conecta',
        'login_text' => 'conectează-te',
        'username' => 'Vizitator',
        'error' => 'Trebuie să fii conectat pentru a face acest lucru.',
    ],
    'logout_confirm' => 'Ești sigur că vrei să te deconectezi? :(',
    'report' => [
        'button_text' => 'raportează',
        'comments' => 'Comentarii suplimentare',
        'placeholder' => 'Te rugăm să oferi orice informație ce crezi că ar putea fi utilă.',
        'reason' => 'Motiv',
        'thanks' => 'Mulțumim pentru raportul tău!',
        'title' => 'Raportezi pe :username?',

        'actions' => [
            'send' => 'Trimite raportul',
            'cancel' => 'Anulează',
        ],

        'options' => [
            'cheating' => 'Cheating',
            'insults' => 'M-a insultat pe mine / pe alții',
            'spam' => 'Spam',
            'unwanted_content' => 'Partajarea unui conținut nepotrivit',
            'nonsense' => 'Nonsens',
            'other' => 'Altele (scrie mai jos)',
        ],
    ],
    'restricted_banner' => [
        'title' => 'Contul tău a fost restricționat!',
        'message' => 'Când ești restricționat, nu vei putea să interacționezi cu alți jucători și scorurile tale vor fi vizibile doar pentru tine. Acesta este de obicei rezultatul unui proces automat și, de obicei, în termen de 24 de ore. Dacă dorești să contești, te rugăm să <a href="mailto:accounts@ppy.sh">contactezi asistența</a>.',
    ],
    'show' => [
        'age' => ':age ani',
        'change_avatar' => 'schimbă-ți avatarul!',
        'first_members' => 'Aici încă de la început',
        'is_developer' => 'dezvoltator osu!',
        'is_supporter' => 'suporter osu!',
        'joined_at' => 'Încris :date',
        'lastvisit' => 'Văzut ultima dată :date',
        'lastvisit_online' => '',
        'missingtext' => 'S-ar putea să fi făcut o greșeală de scriere! (sau este posibil ca utilizatorul să fi fost restricționat)',
        'origin_country' => 'Din :country',
        'page_description' => 'osu! - Tot ce ai dorit vreodată să știi despre :username!',
        'previous_usernames' => 'cunoscut anterior ca',
        'plays_with' => 'Joacă cu :devices',
        'title' => "Profilul lui :username",

        'edit' => [
            'cover' => [
                'button' => 'Schimbă coperta de profil',
                'defaults_info' => 'Mai multe opțiuni de coperte vor fi disponibile în viitor',
                'upload' => [
                    'broken_file' => 'Imposibil de procesat imaginea. Verifică imaginea încărcată și încearcă din nou.',
                    'button' => 'Încarcă imaginea',
                    'dropzone' => 'Plasați fișiere aici pentru a le încărca',
                    'dropzone_info' => 'Poți, de asemenea, să-ți plasezi imaginea aici pentru a o încărca',
                    'restriction_info' => "Încărcare disponibilă pentru <a href='".route('store.products.show', 'supporter-tag')."' target='_blank'>numai</a>suporteri osu!",
                    'size_info' => 'Dimensiunea coperții trebuie să fie de 2800x620',
                    'too_large' => 'Fișierul încărcat este prea mare.',
                    'unsupported_format' => 'Format nesuportat.',
                ],
            ],

            'default_playmode' => [
                'is_default_tooltip' => 'mod de joc implicit',
                'set' => 'setează :mode ca modul de joc implicit al profilului',
            ],
        ],

        'extra' => [
            'followers' => '1 urmăritor|:count urmăritori',
            'unranked' => 'Nu există jocuri recente',

            'achievements' => [
                'achieved-on' => 'Realizat pe :date',
                'locked' => 'Blocat',
                'title' => 'Realizări',
            ],
            'beatmaps' => [
                'by_artist' => 'de :artist',
                'none' => 'Nici unul... încă.',
                'title' => 'Beatmaps',

                'favourite' => [
                    'title' => 'Beatmaps favorite',
                ],
                'graveyard' => [
                    'title' => 'Beatmaps îngropate',
                ],
                'loved' => [
                    'title' => 'Beatmaps iubite',
                ],
                'ranked_and_approved' => [
                    'title' => 'Beatmaps clasate & aprobate',
                ],
                'unranked' => [
                    'title' => 'Beatmaps în așteptare',
                ],
            ],
            'historical' => [
                'empty' => 'Nicio înregistrare de performanță. :(',
                'title' => 'Istoric',

                'monthly_playcounts' => [
                    'title' => 'Istoricul jocurilor',
                    'count_label' => 'Jocuri',
                ],
                'most_played' => [
                    'count' => 'jucat de',
                    'title' => 'Cele mai jucate beatmaps',
                ],
                'recent_plays' => [
                    'accuracy' => 'precizie: :percentage',
                    'title' => 'Jocuri recente (24 de ore)',
                ],
                'replays_watched_counts' => [
                    'title' => 'Istoricul reluărilor vizionate',
                    'count_label' => 'Reluări vizionate',
                ],
            ],
            'kudosu' => [
                'available' => 'Kudosu avabili',
                'available_info' => "Kudosu pot fi tranzacționați pentru stele kudosu, ce pot ajuta ca beatmapul tău să obțină mai multă atenție. Acesta este numărul de kudosu ce nu au fost tranzacționați încă.",
                'recent_entries' => 'Istoricul Kudosu recent',
                'title' => 'Kudosu!',
                'total' => 'Suma totală de Kudosu câștigați',
                'total_info' => 'Bazat pe cât de mult a contribuit utilizatorul la moderarea unui beatmap. Vezi <a href="'.osu_url('user.kudosu').'">această pagină</a> pentru mai multe informații.',

                'entry' => [
                    'amount' => ':amount kudosu',
                    'empty' => "Acest utilizator nu a primit niciun kudosu!",

                    'beatmap_discussion' => [
                        'allow_kudosu' => [
                            'give' => 'A primit :amount de la respringerea revocării de kudosu la postarea :post',
                        ],

                        'deny_kudosu' => [
                            'reset' => 'A refuzat :amount de la postarea :post',
                        ],

                        'delete' => [
                            'reset' => 'A pierdut :amount de la ștergerea postării :post',
                        ],

                        'restore' => [
                            'give' => 'A primit :amount de la restaurarea postării :post',
                        ],

                        'vote' => [
                            'give' => 'A primit :amount de la obținerea de voturi în postarea din :post',
                            'reset' => 'A pierdut :amount de la pierderea de voturi în postarea din :post',
                        ],

                        'recalculate' => [
                            'give' => 'A primit :amount de la recalcularea voturilor în postarea din :post',
                            'reset' => 'A pierdut :amount de la recalucarea voturilor în postarea din :post',
                        ],
                    ],

                    'forum_post' => [
                        'give' => 'A primit :amount de la :giver pentru o postare la :post',
                        'reset' => 'Kudosu resetați de :giver pentru postarea :post',
                        'revoke' => 'Kudosu respinși de :giver pentru postarea :post',
                    ],
                ],
            ],
            'me' => [
                'title' => 'eu!',
            ],
            'medals' => [
                'empty' => "Acest utilizator nu a primit nici unul încă. ;_;",
                'recent' => 'Recente',
                'title' => 'Medalii',
            ],
            'recent_activity' => [
                'title' => 'Recent',
            ],
            'top_ranks' => [
                'download_replay' => 'Descarcă replay-ul',
                'empty' => 'Nicio performanță uimitoare nu a fost înregistrată încă. :(',
                'not_ranked' => 'Numai beatmaps clasate acordă pp.',
                'pp_weight' => 'ponderat :percentage',
                'title' => 'Clasamente',

                'best' => [
                    'title' => 'Cele mai bune performanțe',
                ],
                'first' => [
                    'title' => 'Primele locuri',
                ],
            ],
            'account_standing' => [
                'title' => 'Starea contului',
                'bad_standing' => "Contul lui <strong>:username</strong> nu este într-o stare prea bună :(",
                'remaining_silence' => '<strong>:username</strong> va putea să vorbească din nou în :duration.',

                'recent_infringements' => [
                    'title' => 'Sancțiuni recente',
                    'date' => 'data',
                    'action' => 'acțiune',
                    'length' => 'durată',
                    'length_permanent' => 'Permanent',
                    'description' => 'descriere',
                    'actor' => 'de :username',

                    'actions' => [
                        'restriction' => 'Interdicție',
                        'silence' => 'Amuțire',
                        'note' => 'Notă',
                    ],
                ],
            ],
        ],

        'header_title' => [
            '_' => ':info jucător',
            'info' => 'Detalii',
        ],

        'info' => [
            'discord' => '',
            'interests' => 'Interese',
            'lastfm' => 'Last.fm',
            'location' => 'Locația curentă',
            'occupation' => 'Ocupație',
            'skype' => '',
            'twitter' => '',
            'website' => 'Site web',
        ],
        'not_found' => [
            'reason_1' => 'S-ar putea să-și fi schimbat numele de utilizator.',
            'reason_2' => 'Contul tău poate fi indisponibil momentan din cauza problemelor legate de securitate sau abuz.',
            'reason_3' => 'Este posibil să fi făcut o greșeală de scriere!',
            'reason_header' => 'Există câteva motive posibile pentru asta:',
            'title' => 'Utilizatorul nu a fost găsit! ;_;',
        ],
        'page' => [
            'button' => 'Editează profilul',
            'description' => '<strong>eu!</strong> este o zonă personală personalizabilă în pagina ta de profil.',
            'edit_big' => 'Editează-mă!',
            'placeholder' => 'Introdu conținutul paginii aici',
            'restriction_info' => "Trebuie să fii un <a href='".route('store.products.show', 'supporter-tag')."' target='_blank'>suporter osu!</a> pentru a debloca această funcție.",
        ],
        'post_count' => [
            '_' => 'A contribuit la :link',
            'count' => ':count postare pe forum|:count posări pe forum',
        ],
        'rank' => [
            'country' => 'Clasament pe țară pentru :mode',
            'country_simple' => 'Clasament pe țară',
            'global' => 'Clasament global pentru :mode',
            'global_simple' => 'Clasament global',
        ],
        'stats' => [
            'hit_accuracy' => 'Precizie',
            'level' => 'Nivelul :level',
            'level_progress' => 'Progres până la nivelul următor',
            'maximum_combo' => 'Combo maxim',
            'medals' => 'Medalii',
            'play_count' => 'Număr de jocuri',
            'play_time' => 'Timpul total de joc',
            'ranked_score' => 'Scor clasat',
            'replays_watched_by_others' => 'Istoria reluărilor vizionate de alții',
            'score_ranks' => 'Clasament de scoruri',
            'total_hits' => 'Număr de clicuri',
            'total_score' => 'Scor total',
        ],
    ],

    'status' => [
        'all' => '',
        'online' => 'Online',
        'offline' => 'Offline',
    ],
    'store' => [
        'saved' => 'Utilizator creat',
    ],
    'verify' => [
        'title' => 'Verificarea contului',
    ],
];
