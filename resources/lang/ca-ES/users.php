<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'deleted' => '[usuari eliminat]',

    'beatmapset_activities' => [
        'title' => "Historial de Modding de :user",
        'title_compact' => 'Modding',

        'discussions' => [
            'title_recent' => 'Discussions recents',
        ],

        'events' => [
            'title_recent' => 'Esdeveniments recents',
        ],

        'posts' => [
            'title_recent' => 'Publicacions recents',
        ],

        'votes_received' => [
            'title_most' => 'Els més votats per (últims 3 mesos)',
        ],

        'votes_made' => [
            'title_most' => 'Els més votats (últims 3 mesos)',
        ],
    ],

    'blocks' => [
        'banner_text' => 'Has blocat aquest usuari.',
        'comment_text' => 'Aquest comentari està ocult.',
        'blocked_count' => 'usuaris bloquejats (:count)',
        'hide_profile' => 'Oculta el perfil',
        'hide_comment' => 'ocultar',
        'not_blocked' => 'Aquest usuari no està blocat.',
        'show_profile' => 'Mostra el perfil',
        'show_comment' => 'mostra',
        'too_many' => 'Límit de bloqueigs assolit.',
        'button' => [
            'block' => 'Blocar',
            'unblock' => 'Desbloqueja',
        ],
    ],

    'card' => [
        'loading' => 'Carregant...',
        'send_message' => 'Enviar missatge',
    ],

    'disabled' => [
        'title' => 'Vaja! Sembla que el teu compte ha estat desactivat.',
        'warning' => "En cas que hi hagi trencat una regla, tingueu en compte que generalment hi ha un període d'espera d'un mes durant el qual no considerarem cap sol·licitud d'amnistia. Després d'aquest període, podeu contactar amb nosaltres si ho considereu necessari. Tingueu en compte que la creació de comptes nous després d'haver tingut un desactivat resultarà en una <strong>extensió d'aquest període d'espera d'un mes</strong>. Si us plau, també tingueu en compte que per <strong>cada compte que creeu, estarà violant més regles</strong>. Us suggerim que no seguiu aquest camí!",

        'if_mistake' => [
            '_' => 'Si creieu que es tracta d\'un error, podeu posar-vos en contacte amb nosaltres (per :email o fent clic al "?" a la part inferior dreta d\'aquesta pàgina). Tingueu en compte que sempre confiem plenament en les nostres accions, ja que es basen en dades molt sòlides. Ens reservem el dret d\'ignorar la vostra petició si considerem que està sent intencionadament deshonest.',
            'email' => 'email',
        ],

        'reasons' => [
            'compromised' => 'El seu compte es troba compromès. Pot estar deshabilitat temporalment mentre es verifica la seva identitat.',
            'opening' => 'Hi ha diversos motius que poden resultar en la desactivació del teu compte:',

            'tos' => [
                '_' => 'Has incomplert una o vàries de les nostres :community_rules o :tos. ',
                'community_rules' => 'normes de la comunitat',
                'tos' => 'condicions d\'ús',
            ],
        ],
    ],

    'filtering' => [
        'by_game_mode' => 'Membres per mode de joc',
    ],

    'force_reactivation' => [
        'reason' => [
            'inactive_different_country' => "El vostre compte no ha estat utilitzat durant molt de temps.",
        ],
    ],

    'login' => [
        '_' => 'Iniciar sessió',
        'button' => 'Iniciar sessió',
        'button_posting' => 'Iniciant sessió...',
        'email_login_disabled' => 'L\'inici de sessió amb correu electrònic està deshabilitat. Si us plau, fes servir el teu nom d\'usuari.',
        'failed' => 'Inici de sessió incorrecte',
        'forgot' => 'Has oblidat la contrasenya?',
        'info' => 'Si us plau, inicia la sessió per continuar',
        'invalid_captcha' => 'Massa intents d\'inici de sessió. Resol el captcha i torna-ho a intentar. (Actualitza la pàgina si el captcha no és visible)',
        'locked_ip' => 'La seva adreça IP està bloquejada. Esperi uns minuts.',
        'password' => 'Contrasenya',
        'register' => "No tens un compte d'osu? Crea'n un de nou",
        'remember' => 'Recordar aquest ordinador',
        'title' => 'Inicia sessió per a continuar',
        'username' => 'Nom d\'usuari',

        'beta' => [
            'main' => 'L\'accés a la fase Beta està restringit als usuaris privilegiats.',
            'small' => '(els osu!supporters tindran accés aviat)',
        ],
    ],

    'posts' => [
        'title' => 'Publicacions de :username ',
    ],

    'anonymous' => [
        'login_link' => 'clica per iniciar sessió',
        'login_text' => 'iniciar sessió',
        'username' => 'Convidat',
        'error' => 'Has d\'haver iniciat sessió per a fer això.',
    ],
    'logout_confirm' => 'Segur que vols tancar la sessió? :(',
    'report' => [
        'button_text' => 'Reportar',
        'comments' => 'Comentaris',
        'placeholder' => 'Si us plau, proporcioni qualsevol informació que pugui ser útil.',
        'reason' => 'Motiu',
        'thanks' => 'Gràcies pel seu informe!',
        'title' => 'Reportar a :username?',

        'actions' => [
            'send' => 'Enviar informe',
            'cancel' => 'Cancel·la',
        ],

        'options' => [
            'cheating' => 'Joc brut/trampes',
            'multiple_accounts' => 'Fa servir diversos comptes',
            'insults' => 'Insulta a mi o a altres',
            'spam' => 'Envia spam',
            'unwanted_content' => 'Enllaça contingut inapropiat',
            'nonsense' => 'Ximpleries',
            'other' => 'Altres (escriu a sota)',
        ],
    ],
    'restricted_banner' => [
        'title' => 'El teu compte ha estat restringit!',
        'message' => 'Mentre estigui restringit, no podreu interactuar amb altres jugadors i les vostres puntuacions només seran visibles per a vosaltres. Això és, normalment, el resultat d\'un procés automatitzat i s\'aixeca normalment d\'aquí a 24 hores. Si vols apel·lar a la teva restricció, si us plau <a href="mailto:accounts@ppy.sh">contacta amb el suport</a>.',
    ],
    'show' => [
        'age' => ':age anys',
        'change_avatar' => 'canvia el teu avatar!',
        'first_members' => 'Aquí des del principi',
        'is_developer' => 'osu!developer',
        'is_supporter' => 'osu!supporter',
        'joined_at' => 'Membre des de :date',
        'lastvisit' => 'Vist per últim cop :date',
        'lastvisit_online' => 'En línia ara mateix',
        'missingtext' => 'Potser has comès un error tipogràfic! (o l\'usuari pot estar expulsat)',
        'origin_country' => 'De :country',
        'previous_usernames' => 'conegut anteriorment com',
        'plays_with' => 'Juga amb :devices',
        'title' => "Perfil de :username",

        'comments_count' => [
            '_' => 'Va publicar :link',
            'count' => ':count_delimited comentari|:count_delimited comentaris',
        ],
        'cover' => [
            'to_0' => 'Ocultar portada',
            'to_1' => 'Mostra la portada',
        ],
        'edit' => [
            'cover' => [
                'button' => 'Canvia la portada del perfil',
                'defaults_info' => 'Més opcions de portada estaran disponibles en el futur',
                'upload' => [
                    'broken_file' => 'Error en processar la imatge. Verifica la imatge pujada i torna-ho a intentar.',
                    'button' => 'Penja una imatge',
                    'dropzone' => 'Deixa anar aquí per penjar',
                    'dropzone_info' => 'També pots deixar anar la imatge aquí per a penjar-la',
                    'size_info' => 'La portada ha de ser de mida 2400x640',
                    'too_large' => 'El fitxer és massa gran.',
                    'unsupported_format' => 'Format no admès.',

                    'restriction_info' => [
                        '_' => 'Càrrega disponible només per a :link',
                        'link' => 'osu!supporters',
                    ],
                ],
            ],

            'default_playmode' => [
                'is_default_tooltip' => 'mode de joc per defecte',
                'set' => 'estableix :mode com a mode de joc per defecte del perfil',
            ],
        ],

        'extra' => [
            'none' => 'cap',
            'unranked' => 'Ni hi ha partides recents',

            'achievements' => [
                'achieved-on' => 'Obtingut el :date',
                'locked' => 'Bloquejat',
                'title' => 'Assoliments',
            ],
            'beatmaps' => [
                'by_artist' => 'per :artist',
                'title' => 'Beatmaps',

                'favourite' => [
                    'title' => 'Beatmaps preferits',
                ],
                'graveyard' => [
                    'title' => 'Beatmaps Abandonats',
                ],
                'guest' => [
                    'title' => 'Beatmaps amb participació de convidats',
                ],
                'loved' => [
                    'title' => 'Beatmaps Estimats',
                ],
                'nominated' => [
                    'title' => '',
                ],
                'pending' => [
                    'title' => 'Beatmaps Pendents',
                ],
                'ranked' => [
                    'title' => 'Beatmaps Classificats',
                ],
            ],
            'discussions' => [
                'title' => 'Discussions',
                'title_longer' => 'Discussions recents',
                'show_more' => 'veure més discussions',
            ],
            'events' => [
                'title' => 'Esdeveniments',
                'title_longer' => 'Esdeveniments recents',
                'show_more' => 'veure més esdeveniments',
            ],
            'historical' => [
                'title' => 'Històric',

                'monthly_playcounts' => [
                    'title' => 'Historial de joc',
                    'count_label' => 'Partides',
                ],
                'most_played' => [
                    'count' => 'vegades jugat',
                    'title' => 'Beatmaps més jugats',
                ],
                'recent_plays' => [
                    'accuracy' => 'precisió :percentage',
                    'title' => 'Partides recents (24h)',
                ],
                'replays_watched_counts' => [
                    'title' => 'Historial de repeticions vistes',
                    'count_label' => 'Repeticions vistes',
                ],
            ],
            'kudosu' => [
                'recent_entries' => 'Historial recent de Kudosu',
                'title' => 'Kudosu!',
                'total' => '',

                'entry' => [
                    'amount' => '',
                    'empty' => "",

                    'beatmap_discussion' => [
                        'allow_kudosu' => [
                            'give' => 'Va rebre :amount de revocació de negació de kudosu per la publicació de modding :post',
                        ],

                        'deny_kudosu' => [
                            'reset' => '',
                        ],

                        'delete' => [
                            'reset' => 'Va perdre :amount per l\'eliminació de la publicació de modding de :post',
                        ],

                        'restore' => [
                            'give' => '',
                        ],

                        'vote' => [
                            'give' => '',
                            'reset' => '',
                        ],

                        'recalculate' => [
                            'give' => '',
                            'reset' => '',
                        ],
                    ],

                    'forum_post' => [
                        'give' => '',
                        'reset' => '',
                        'revoke' => '',
                    ],
                ],

                'total_info' => [
                    '_' => '',
                    'link' => '',
                ],
            ],
            'me' => [
                'title' => '',
            ],
            'medals' => [
                'empty' => "",
                'recent' => '',
                'title' => '',
            ],
            'playlists' => [
                'title' => '',
            ],
            'posts' => [
                'title' => '',
                'title_longer' => '',
                'show_more' => '',
            ],
            'recent_activity' => [
                'title' => '',
            ],
            'realtime' => [
                'title' => '',
            ],
            'top_ranks' => [
                'download_replay' => '',
                'not_ranked' => '',
                'pp_weight' => '',
                'view_details' => '',
                'title' => '',

                'best' => [
                    'title' => '',
                ],
                'first' => [
                    'title' => '',
                ],
                'pin' => [
                    'to_0' => '',
                    'to_0_done' => '',
                    'to_1' => '',
                    'to_1_done' => '',
                ],
                'pinned' => [
                    'title' => '',
                ],
            ],
            'votes' => [
                'given' => '',
                'received' => '',
                'title' => '',
                'title_longer' => '',
                'vote_count' => '',
            ],
            'account_standing' => [
                'title' => '',
                'bad_standing' => "",
                'remaining_silence' => '',

                'recent_infringements' => [
                    'title' => '',
                    'date' => '',
                    'action' => '',
                    'length' => '',
                    'length_permanent' => '',
                    'description' => '',
                    'actor' => 'per :username',

                    'actions' => [
                        'restriction' => 'Restringeix',
                        'silence' => 'Silencia',
                        'tournament_ban' => 'Restringeix dels tornejos',
                        'note' => 'Nota',
                    ],
                ],
            ],
        ],

        'info' => [
            'discord' => '',
            'interests' => 'Interessos',
            'location' => 'Ubicació actual',
            'occupation' => 'Professió',
            'twitter' => '',
            'website' => 'Lloc web',
        ],
        'not_found' => [
            'reason_1' => 'Potser ha canviat el seu nom d\'usuari.',
            'reason_2' => 'Per motius de seguretat o d\'abús, el compte pot estar no disponible temporalment.',
            'reason_3' => 'Potser has fet un error tipogràfic!',
            'reason_header' => 'Pot ser degut a diversos motius:',
            'title' => 'Usuari no trobat! ;_;',
        ],
        'page' => [
            'button' => '',
            'description' => '',
            'edit_big' => '',
            'placeholder' => '',

            'restriction_info' => [
                '_' => '',
                'link' => '',
            ],
        ],
        'post_count' => [
            '_' => '',
            'count' => '',
        ],
        'rank' => [
            'country' => '',
            'country_simple' => '',
            'global' => '',
            'global_simple' => '',
            'highest' => '',
        ],
        'stats' => [
            'hit_accuracy' => '',
            'level' => '',
            'level_progress' => 'Progrés al següent nivell',
            'maximum_combo' => '',
            'medals' => '',
            'play_count' => '',
            'play_time' => '',
            'ranked_score' => '',
            'replays_watched_by_others' => '',
            'score_ranks' => '',
            'total_hits' => '',
            'total_score' => '',
            // modding stats
            'graveyard_beatmapset_count' => 'Beatmaps Abandonats',
            'loved_beatmapset_count' => 'Beatmaps Estimats',
            'pending_beatmapset_count' => 'Beatmaps Pendents',
            'ranked_beatmapset_count' => 'Beatmaps Classificats',
        ],
    ],

    'silenced_banner' => [
        'title' => '',
        'message' => '',
    ],

    'status' => [
        'all' => 'Tots',
        'online' => '',
        'offline' => '',
    ],
    'store' => [
        'saved' => '',
    ],
    'verify' => [
        'title' => '',
    ],

    'view_mode' => [
        'brick' => '',
        'card' => '',
        'list' => '',
    ],
];
