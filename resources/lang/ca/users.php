<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'deleted' => '[usuari eliminat]',

    'beatmapset_activities' => [
        'title' => "Historial de modding de :user",
        'title_compact' => 'Modding',

        'discussions' => [
            'title_recent' => 'Discussions iniciades recentment',
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
        'banner_text' => 'Has bloquejat a aquest usuari.',
        'comment_text' => 'Aquest comentari està ocult.',
        'blocked_count' => 'usuaris bloquejats (:count)',
        'hide_profile' => 'Oculta el perfil',
        'hide_comment' => 'amaga',
        'forum_post_text' => 'La publicació està oculta.',
        'not_blocked' => 'Aquest usuari no està bloquejat.',
        'show_profile' => 'Mostra el perfil',
        'show_comment' => 'mostra',
        'too_many' => 'Límit de bloquejos assolit.',
        'button' => [
            'block' => 'Bloquejar',
            'unblock' => 'Desbloqueja',
        ],
    ],

    'card' => [
        'gift_supporter' => 'Regala l\'etiqueta de supporter',
        'loading' => 'Carregant...',
        'send_message' => 'Enviar missatge',
    ],

    'create' => [
        'form' => [
            'password' => 'contrasenya',
            'password_confirmation' => 'confirmació de contrasenya',
            'submit' => 'crea compte',
            'user_email' => 'correu electrònic',
            'user_email_confirmation' => 'confirmació per correu electrònic',
            'username' => 'nom d’usuari',

            'tos_notice' => [
                '_' => 'en crear un compte acceptes les :link',
                'link' => 'condicions d\'ús',
            ],
        ],
    ],

    'disabled' => [
        'title' => 'Vaja! Sembla que el teu compte ha estat desactivat.',
        'warning' => "En cas que hagis trencat una regla, tingues en compte que generalment hi ha un període d'espera d'un mes durant el qual no considerarem cap sol·licitud d'amnistia. Després d'aquest període, pots contactar amb nosaltres si ho consideres necessari. Tingues en compte que la creació de comptes nous després d'haver tingut una desactivada resultarà en una <strong>extensió d'aquest període d'espera d'un mes</strong>. Si us plau, també tingues en compte que per <strong>cada compte que creïs, estaràs violant més regles</strong>. Et suggerim que no segueixis aquest camí!",

        'if_mistake' => [
            '_' => 'Si creus que es tracta d\'un error, pots posar-te en contacte amb nosaltres (per :email o fent clic al "?" a la part inferior dreta d\'aquesta pàgina). Tingues en compte que sempre confiem plenament en les nostres accions, ja que es basen en dades molt sòlides. Ens reservem el dret d\'ignorar la teva petició si considerem que estàs sent intencionadament deshonest.',
            'email' => 'correu electrònic',
        ],

        'reasons' => [
            'compromised' => 'El teu compte es troba compromès. Pot estar deshabilitat temporalment mentre es verifica la teva identitat.',
            'opening' => 'Hi ha diversos motius que poden resultar en la desactivació del teu compte:',

            'tos' => [
                '_' => 'Has incomplert una o vàries de les nostres :community_rules o les :tos. ',
                'community_rules' => 'regles de la comunitat',
                'tos' => 'condicions d\'ús',
            ],
        ],
    ],

    'filtering' => [
        'by_game_mode' => 'Membres per mode de joc',
    ],

    'force_reactivation' => [
        'reason' => [
            'inactive' => "Fa molt de temps que el teu compte no s'utilitza.",
            'inactive_different_country' => "El teu compte no s'ha utilitzat durant molt de temps.",
        ],
    ],

    'login' => [
        '_' => 'Inicia sessió',
        'button' => 'Inicia sessió',
        'button_posting' => 'Iniciant sessió...',
        'email_login_disabled' => 'L\'inici de sessió amb correu electrònic està deshabilitat. Si us plau, fes servir el teu nom d\'usuari.',
        'failed' => 'Inici de sessió incorrecte',
        'forgot' => 'Has oblidat la contrasenya?',
        'info' => 'Si us plau, inicia la sessió per continuar',
        'invalid_captcha' => 'Massa intents d\'inici de sessió. Resol el captcha i torna-ho a intentar. (Actualitza la pàgina si el captcha no és visible)',
        'locked_ip' => 'La seva adreça IP està bloquejada. Esperi uns minuts.',
        'password' => 'Contrasenya',
        'register' => "No tens un compte d'osu? Crea'n un de nou",
        'remember' => 'Recorda en aquest ordinador',
        'title' => 'Inicia sessió per a continuar',
        'username' => 'Nom d\'usuari',

        'beta' => [
            'main' => 'L\'accés a la fase beta està restringit a usuaris privilegiats.',
            'small' => '(els osu!supporters tindran accés aviat)',
        ],
    ],

    'multiplayer' => [
        'index' => [
            'active' => 'Actiu',
            'ended' => 'Finalitzat',
        ],
    ],

    'ogp' => [
        'modding_description' => 'Mapes: :counts',
        'modding_description_empty' => 'L\'usuari no té cap mapa...',

        'description' => [
            '_' => 'Clasificació (:ruleset): :global | :country',
            'country' => 'País :rank',
            'global' => 'Global :rank',
        ],
    ],

    'posts' => [
        'title' => 'Publicacions de :username',
    ],

    'anonymous' => [
        'login_link' => 'clica per iniciar sessió',
        'login_text' => 'iniciar sessió',
        'username' => 'Convidat',
        'error' => 'Has d\'haver iniciat sessió per a fer això.',
    ],
    'logout_confirm' => 'Estàs segur que vols tancar la sessió? :(',
    'report' => [
        'button_text' => 'Reportar',
        'comments' => 'Comentaris',
        'placeholder' => 'Si us plau, proporciona qualsevol informació que pugui ser útil.',
        'reason' => 'Motiu',
        'thanks' => 'Gràcies pel teu report!',
        'title' => 'Reportar a :username?',

        'actions' => [
            'send' => 'Enviar report',
            'cancel' => 'Cancel·la',
        ],

        'dmca' => [
            'message_1' => [
                '_' => 'Informeu de la infracció dels drets d\'autor a través d\'una reclamació DMCA a :mail segons :policy.',
                'policy' => 'la política de drets d\'autor d\'osu!',
            ],
            'message_2' => 'Això s\'aplica en casos on es fan servir pistes d\'àudio, contingut visual o contingut de mapes sense els permisos apropiats.',
        ],

        'options' => [
            'cheating' => 'Joc brut/trampes',
            'copyright_infringement' => 'Infracció de drets d\'autor',
            'inappropriate_chat' => 'Conducta inadequada al xat',
            'insults' => 'Insultant-me/insultant als altres',
            'multiple_accounts' => 'Fa servir diversos comptes',
            'nonsense' => 'Ximpleries',
            'other' => 'Altres (escriu a sota)',
            'spam' => 'Envia spam',
            'unwanted_content' => 'Enllaça contingut inapropiat',
        ],
    ],
    'restricted_banner' => [
        'title' => 'El teu compte ha estat restringit!',
        'message' => 'Mentre estiguis restringit, no podràs interactuar amb altres jugadors i les teves puntuacions només seran visibles per a tu. Això és, normalment, el resultat d\'un procés automatitzat i s\'aixeca normalment d\'aquí a 24 hores. :link',
        'message_link' => 'Consulta aquesta pàgina per aprendre més.',
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
        'missingtext' => 'Potser has comès un error tipogràfic! (o l\'usuari pot haver estat prohibit)',
        'origin_country' => 'De :country',
        'previous_usernames' => 'conegut anteriorment com',
        'plays_with' => 'Juga amb :devices',

        'comments_count' => [
            '_' => 'Ha publicat :link',
            'count' => ':count_delimited comentari|:count_delimited comentaris',
        ],
        'cover' => [
            'to_0' => 'Ocultar portada',
            'to_1' => 'Mostra la portada',
        ],
        'daily_challenge' => [
            'daily' => 'Ratxa diària',
            'daily_streak_best' => 'Millor ratxa diària',
            'daily_streak_current' => 'Ratxa diària actual',
            'playcount' => 'Participació total',
            'title' => 'Repte\ndiari',
            'top_10p_placements' => 'Llocs del top 10 %',
            'top_50p_placements' => 'Llocs del top 50 %',
            'weekly' => 'Ratxa setmanal',
            'weekly_streak_best' => 'Millor ratxa setmanal',
            'weekly_streak_current' => 'Ratxa setmanal actual',

            'unit' => [
                'day' => ':value d',
                'week' => ':value s',
            ],
        ],
        'edit' => [
            'cover' => [
                'button' => 'Canvia la portada del perfil',
                'defaults_info' => 'Més opcions de portada estaran disponibles en el futur',
                'holdover_remove_confirm' => "La coberta seleccionada anteriorment ja no està disponible. No la podreu tornar a triar si canvieu de coberta. Voleu continuar?",
                'title' => 'Portada',

                'upload' => [
                    'broken_file' => 'Error en processar la imatge. Verifica la imatge pujada i torna-ho a intentar.',
                    'button' => 'Penja una imatge',
                    'dropzone' => 'Deixa anar aquí per penjar',
                    'dropzone_info' => 'També pots deixar anar la imatge aquí per a penjar-la',
                    'size_info' => 'La portada ha de ser de 2400x640',
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

            'hue' => [
                'reset_no_supporter' => 'Voleu restablir els valors per defecte? Cal una etiqueta de seguidor per a canviar el color.',
                'title' => 'Color',

                'supporter' => [
                    '_' => 'Els temes de colors personalitzats només estan disponibles per a :link.',
                    'link' => 'osu!supporters',
                ],
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
                'title' => 'Mapes',

                'favourite' => [
                    'title' => 'Mapes preferits',
                ],
                'graveyard' => [
                    'title' => 'Mapes abandonats',
                ],
                'guest' => [
                    'title' => 'Mapes amb participació de convidats',
                ],
                'loved' => [
                    'title' => 'Mapes estimats',
                ],
                'nominated' => [
                    'title' => 'Betmaps classificats nominats',
                ],
                'pending' => [
                    'title' => 'Mapes pendents',
                ],
                'ranked' => [
                    'title' => 'Mapes classificats',
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
                    'count_label' => 'Jugades',
                ],
                'most_played' => [
                    'count' => 'vegades jugat',
                    'title' => 'Mapes més jugats',
                ],
                'recent_plays' => [
                    'accuracy' => 'precisió :percentage',
                    'title' => 'Jugades recents (24 h)',
                ],
                'replays_watched_counts' => [
                    'title' => 'Historial de repeticions vistes',
                    'count_label' => 'Repeticions vistes',
                ],
            ],
            'kudosu' => [
                'recent_entries' => 'Historial de Kudosu recent',
                'title' => 'Kudosu!',
                'total' => 'Kudosu total obtingut',

                'entry' => [
                    'amount' => ':amount kudosu',
                    'empty' => "Aquest usuari no ha rebut cap kudosu!",

                    'beatmap_discussion' => [
                        'allow_kudosu' => [
                            'give' => 'Ha rebut :amount de revocació de negació de kudosu per la publicació de modding :post',
                        ],

                        'deny_kudosu' => [
                            'reset' => 'S\'ha denegat :amount per la publicació de modding :post',
                        ],

                        'delete' => [
                            'reset' => 'Ha perdut :amount per l\'eliminació de la publicació de modding :post',
                        ],

                        'restore' => [
                            'give' => 'Ha rebut :amount pel restabliment de la publicació de modding :post',
                        ],

                        'vote' => [
                            'give' => 'Rebuts :amount gràcies als vots a la publicació de modding :post',
                            'reset' => 'Ha perdut :amount per perdre vots a la publicació de modding :post',
                        ],

                        'recalculate' => [
                            'give' => 'Ha rebut :amount pels vots en el recàlcul de la publicació de modding :post',
                            'reset' => 'Ha perdut :amount pels vots en el recàlcul de la publicació de modding :post',
                        ],
                    ],

                    'forum_post' => [
                        'give' => 'Ha rebut :amount de :giver per una publicació en :post',
                        'reset' => 'Kudosu reinciat per :giver per la publicació :post',
                        'revoke' => 'S\'ha denegat kudosu de :giver per la publicació :post',
                    ],
                ],

                'total_info' => [
                    '_' => 'Basat en les contribucions que l\'usuari ha fet a la moderació de mapes. Consulta :link per a més informació.',
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
                'title_longer' => 'Publicacions recents',
                'show_more' => 'veure més publicacions',
            ],
            'quickplay' => [
                'title' => 'Partides ràpides',
            ],
            'recent_activity' => [
                'title' => 'Recent',
            ],
            'realtime' => [
                'title' => 'Partides multijugador',
            ],
            'top_ranks' => [
                'download_replay' => 'Baixa la repetició',
                'not_ranked' => 'Només els mapes classificatoris donen pp',
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
                'vote_count' => ':count_delimited vot|:count_delimited vots',
            ],
            'account_standing' => [
                'title' => 'Estat del compte',
                'bad_standing' => "El compte de :username no està en bon estat :(",
                'remaining_silence' => ':username podrà tornar a parlar :duration.',

                'recent_infringements' => [
                    'title' => 'Infraccions recents',
                    'date' => 'data',
                    'action' => 'acció',
                    'length' => 'durada',
                    'length_indefinite' => 'Indefinit',
                    'description' => 'descripció',
                    'actor' => 'per :username',

                    'actions' => [
                        'restriction' => 'Prohibir',
                        'silence' => 'Silenciar',
                        'tournament_ban' => 'Prohibició de tornejos',
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

        'matchmaking' => [
            'title' => 'Partides ràpides',
        ],

        'not_found' => [
            'reason_1' => 'Potser ha canviat el seu nom d\'usuari.',
            'reason_2' => 'Per motius de seguretat o d\'abús, el compte pot estar no disponible temporalment.',
            'reason_3' => 'Potser has comès un error tipogràfic!',
            'reason_header' => 'Pot ser degut a diversos motius:',
            'title' => 'Usuari no trobat! ;_;',
        ],
        'page' => [
            'button' => 'Editar pàgina de perfil',
            'description' => '<strong>jo!</strong> és una zona personalitzable de la teva pàgina de perfil.',
            'edit_big' => 'Edita\'m!',
            'placeholder' => 'Escriu el contingut de la pàgina aquí',

            'restriction_info' => [
                '_' => 'Has de ser :link per a desbloquejar aquesta funció.',
                'link' => 'osu!supporter',
            ],
        ],
        'post_count' => [
            '_' => 'Ha contribuït amb :link',
            'count' => ':count_delimited publicació en el fòrum|:count_delimited publicacions en el fòrum',
        ],
        'rank' => [
            'country' => 'Classificació nacional per :mode',
            'country_simple' => 'Classificació nacional',
            'global' => 'Classifació global per :mode',
            'global_simple' => 'Classificació global',
            'highest' => 'Classificació més alta: :rank el :date',
        ],
        'season_stats' => [
            'division_top_percentage' => ':value millors',
            'total_score' => 'Puntuació total',
        ],
        'stats' => [
            'hit_accuracy' => 'Precisió',
            'hits_per_play' => 'Cops per partida',
            'level' => 'Nivell :level',
            'level_progress' => 'Progrés al següent nivell',
            'maximum_combo' => 'Combo màxim',
            'medals' => 'Medalles',
            'play_count' => 'Nombre de jugades',
            'play_time' => 'Temps total de joc',
            'ranked_score' => 'Puntuació classificada',
            'replays_watched_by_others' => 'Repeticions vistes per altres',
            'score_ranks' => 'Classificació de les puntuacions',
            'total_hits' => 'Encerts totals',
            'total_score' => 'Puntuació total',
            // modding stats
            'graveyard_beatmapset_count' => 'Mapes abandonats',
            'loved_beatmapset_count' => 'Mapes estimats',
            'pending_beatmapset_count' => 'Mapes pendents',
            'ranked_beatmapset_count' => 'Mapes Classificats',
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
