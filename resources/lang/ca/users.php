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
        'forum_post_text' => 'La publicació està oculta. ',
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

    'create' => [
        'form' => [
            'password' => 'contrasenya',
            'password_confirmation' => 'confirmació de contrasenya',
            'submit' => 'crear compte',
            'user_email' => 'correu electrònic',
            'user_email_confirmation' => 'confirmació per correu electrònic',
            'username' => 'nom d’usuari',

            'tos_notice' => [
                '_' => 'al crear un compte acceptes els :link',
                'link' => 'condicions d\'ús',
            ],
        ],
    ],

    'disabled' => [
        'title' => 'Vaja! Sembla que el teu compte ha estat desactivat.',
        'warning' => "En cas que hi hagi trencat una regla, tingueu en compte que generalment hi ha un període d'espera d'un mes durant el qual no considerarem cap sol·licitud d'amnistia. Després d'aquest període, podeu contactar amb nosaltres si ho considereu necessari. Tingueu en compte que la creació de comptes nous després d'haver tingut un desactivat resultarà en una <strong>extensió d'aquest període d'espera d'un mes</strong>. Si us plau, també tingueu en compte que per <strong>cada compte que creeu, estarà violant més regles</strong>. Us suggerim que no seguiu aquest camí!",

        'if_mistake' => [
            '_' => 'Si creieu que es tracta d\'un error, podeu posar-vos en contacte amb nosaltres (per :email o fent clic al "?" a la part inferior dreta d\'aquesta pàgina). Tingueu en compte que sempre confiem plenament en les nostres accions, ja que es basen en dades molt sòlides. Ens reservem el dret d\'ignorar la vostra petició si considerem que està sent intencionadament deshonest.',
            'email' => 'correu electrònic',
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
        'message_link' => 'Vegeu aquesta pàgina per a aprendre més.',
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
            '_' => 'Ha publicat :link',
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
                    'title' => 'Betmaps classificats nominats',
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
                'total' => 'Kudosu total obtingut',

                'entry' => [
                    'amount' => ':amount kudosu',
                    'empty' => "Aquest usuari no ha rebut cap kudosu!",

                    'beatmap_discussion' => [
                        'allow_kudosu' => [
                            'give' => 'Va rebre :amount de revocació de negació de kudosu per la publicació de modding :post',
                        ],

                        'deny_kudosu' => [
                            'reset' => 'S\'ha denegat :amount per la publicació :post',
                        ],

                        'delete' => [
                            'reset' => 'Va perdre :amount per l\'eliminació de la publicació de modding de :post',
                        ],

                        'restore' => [
                            'give' => 'Rebuts :amount pel restabliment de la publicació :post',
                        ],

                        'vote' => [
                            'give' => 'Rebuts :amount gràcies als vots a la publicació de :post',
                            'reset' => 'Has perdut :amount per perdre vots a la publicació :post',
                        ],

                        'recalculate' => [
                            'give' => 'Has rebut :amount pels vots en el recàlcul de la publicació :post',
                            'reset' => 'Has perdut :amount pels vots en el recàlcul de la publicació :post',
                        ],
                    ],

                    'forum_post' => [
                        'give' => 'Has rebut :amount de :giver per la publicació :post',
                        'reset' => 'Kudosu reinciat per :giver pel post :post',
                        'revoke' => 'S\'han denegat els kudosu de :giver per la publicació :post',
                    ],
                ],

                'total_info' => [
                    '_' => 'Basat en les contribucions que l\'usuari ha fet a la moderació de beatmaps. Vegi :link per a més informació.',
                    'link' => 'aquesta pàgina',
                ],
            ],
            'me' => [
                'title' => 'jo!',
            ],
            'medals' => [
                'empty' => "Aquest usuari no n'ha rebut cap encara ;_;",
                'recent' => 'Recents',
                'title' => 'Medalles',
            ],
            'playlists' => [
                'title' => 'Partides de la llista',
            ],
            'posts' => [
                'title' => 'Publicacions',
                'title_longer' => 'Publicacions Recents',
                'show_more' => 'veure més publicacions',
            ],
            'recent_activity' => [
                'title' => 'Recent',
            ],
            'realtime' => [
                'title' => 'Partides multijugador',
            ],
            'top_ranks' => [
                'download_replay' => 'Baixar repetició',
                'not_ranked' => 'Només beatmaps classificatoris donen pp',
                'pp_weight' => 'valorat :percentage',
                'view_details' => 'Veure Detalls',
                'title' => 'Classificacions',

                'best' => [
                    'title' => 'Millors',
                ],
                'first' => [
                    'title' => 'Primera posició',
                ],
                'pin' => [
                    'to_0' => 'Desfixar',
                    'to_0_done' => 'Puntuació desfixada',
                    'to_1' => 'Fixar',
                    'to_1_done' => 'Puntuació fixada',
                ],
                'pinned' => [
                    'title' => 'Puntuacions fixades',
                ],
            ],
            'votes' => [
                'given' => 'Vots atorgats (últims 3 mesos)',
                'received' => 'Vots rebuts (últims 3 mesos)',
                'title' => 'Vots',
                'title_longer' => 'Vots recents',
                'vote_count' => ':count_delimited vot |:count_delimited vots',
            ],
            'account_standing' => [
                'title' => 'Estat del compte',
                'bad_standing' => "El compte de :username no està en bon estat :(",
                'remaining_silence' => ':username podrà tornar a parlar :duration.',

                'recent_infringements' => [
                    'title' => 'Infraccions Recents',
                    'date' => 'data',
                    'action' => 'acció',
                    'length' => 'durada',
                    'length_permanent' => 'Permanent',
                    'description' => 'descripció',
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
            'button' => 'Editar pàgina de perfil',
            'description' => '<strong>jo!</strong> és una zona personalitzable de la teva pàgina de perfil.',
            'edit_big' => 'Edita\'m!',
            'placeholder' => 'Escriu els continguts aquí',

            'restriction_info' => [
                '_' => 'Has de ser un :link per a desbloquejar aquesta funció.',
                'link' => 'osu!supporter',
            ],
        ],
        'post_count' => [
            '_' => 'Ha contribuït amb :link',
            'count' => ':count_delimited publicació|:count_delimited publicacions',
        ],
        'rank' => [
            'country' => 'Classificació per països per :mode',
            'country_simple' => 'Classificació per Països',
            'global' => 'Classifació global per :mode',
            'global_simple' => 'Classificació global',
            'highest' => 'Classificació més alta: :rank el :date',
        ],
        'stats' => [
            'hit_accuracy' => 'Precisió',
            'level' => 'Nivell :level',
            'level_progress' => 'Progrés al següent nivell',
            'maximum_combo' => 'Màxim combo',
            'medals' => 'Medalles',
            'play_count' => 'Nombre de partides',
            'play_time' => 'Temps total de joc',
            'ranked_score' => 'Puntuació classificada',
            'replays_watched_by_others' => 'Repeticions vistes per altres',
            'score_ranks' => 'Classificació de les puntuacions',
            'total_hits' => 'Encerts Totals',
            'total_score' => 'Puntuació total',
            // modding stats
            'graveyard_beatmapset_count' => 'Beatmaps Abandonats',
            'loved_beatmapset_count' => 'Beatmaps Estimats',
            'pending_beatmapset_count' => 'Beatmaps Pendents',
            'ranked_beatmapset_count' => 'Beatmaps Classificats',
        ],
    ],

    'silenced_banner' => [
        'title' => 'Ara mateix estàs silenciat.',
        'message' => 'Algunes accions no estan disponibles.',
    ],

    'status' => [
        'all' => 'Tots',
        'online' => 'En línia',
        'offline' => 'Sense connexió',
    ],
    'store' => [
        'from_client' => 'si us plau, registreu-vos a través del client del joc!',
        'from_web' => 'si us plau, completeu el registre mitjançant el lloc web d\'osu!',
        'saved' => 'Usuari creat',
    ],
    'verify' => [
        'title' => 'Verificació del compte',
    ],

    'view_mode' => [
        'brick' => 'Vista de bloc',
        'card' => 'Vista de targeta',
        'list' => 'Vista de llista',
    ],
];
