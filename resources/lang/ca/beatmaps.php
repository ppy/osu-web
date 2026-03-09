<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'invalid_ruleset' => 'El conjunt de regles especificat no és vàlid.',

    'change_owner' => [
        'too_many' => 'Massa mapejadors convidats.',
    ],

    'discussion-votes' => [
        'update' => [
            'error' => 'Error en actualitzar el vot',
        ],
    ],

    'discussions' => [
        'allow_kudosu' => 'permetre kudosu',
        'beatmap_information' => 'Pàgina del mapa',
        'delete' => 'eliminar',
        'deleted' => 'Eliminat per :editor :delete_time.',
        'deny_kudosu' => 'negar kudosu',
        'edit' => 'editar',
        'edited' => 'Última edició per :editor :update_time.',
        'guest' => 'Dificultat de convidat per :user',
        'kudosu_denied' => 'Negar l\'obtenció de kudosu.',
        'message_placeholder_deleted_beatmap' => 'Aquesta dificultat ha estat eliminada, per tant ja no es pot discutir.',
        'message_placeholder_locked' => 'La discussió per a aquest mapa s\'ha desactivat.',
        'message_placeholder_silenced' => "No podeu publicar una discussió mentre estigui silenciat.",
        'message_type_select' => 'Seleccionar tipus de comentari',
        'reply_notice' => 'Premeu enter per respondre.',
        'reply_resolve_notice' => 'Premeu «Retorn» per a contestar. Premeu Ctrl+Retorn per a contestar i marcar com a resolt.',
        'reply_placeholder' => 'Escriviu la vostra resposta aquí',
        'require-login' => 'Inicia sessió per publicar o respondre',
        'resolved' => 'Resolt',
        'restore' => 'restaurar',
        'show_deleted' => 'Mostra els eliminats',
        'title' => 'Discussions',
        'unresolved_count' => ':count_delimited problema sense resoldre|:count_delimited problemes sense resoldre',

        'collapse' => [
            'all-collapse' => 'Plega-ho tot',
            'all-expand' => 'Expandeix-ho tot',
        ],

        'empty' => [
            'empty' => 'Encara no hi ha discussions!',
            'hidden' => 'Cap discussió no coincideix amb el filtre seleccionat.',
        ],

        'lock' => [
            'button' => [
                'lock' => 'Bloquejar discussió',
                'unlock' => 'Desbloquejar discussió',
            ],

            'prompt' => [
                'lock' => 'Motiu del bloqueig',
                'unlock' => 'Esteu segur que voleu desbloquejar-la?',
            ],
        ],

        'message_hint' => [
            'in_general' => 'Aquest post anirà a la discussió general de mapes. Per modejar aquesta dificultat, comença un missatge amb una marca de temps (ex. 00:12:345).',
            'in_timeline' => 'Per modejar diverses marques de temps, publiqueu diverses vegades (un missatge per marca de temps).',
        ],

        'message_placeholder' => [
            'general' => 'Escriviu aquí per publicar a General (:version)',
            'generalAll' => 'Escriviu aquí per publicar a General (Totes les dificultats)',
            'review' => 'Escriviu aquí per publicar una revisió',
            'timeline' => 'Escriviu aquí per publicar a la Línia de temps (:version)',
        ],

        'message_type' => [
            'disqualify' => 'Desqualificar',
            'hype' => 'Eufòria!',
            'mapper_note' => 'Nota',
            'nomination_reset' => 'Restableix la nominació',
            'praise' => 'Elogi',
            'problem' => 'Problema',
            'problem_warning' => 'Informar d\'un problema',
            'review' => 'Revisió',
            'suggestion' => 'Suggeriment',
        ],

        'message_type_title' => [
            'disqualify' => 'Publicar desqualificació',
            'hype' => 'Publicar eufòria!',
            'mapper_note' => 'Publicar nota',
            'nomination_reset' => 'Eliminar totes les nominacions',
            'praise' => 'Publicar elogi',
            'problem' => 'Publicar problema',
            'problem_warning' => 'Publicar problema',
            'review' => 'Publicar revisió',
            'suggestion' => 'Publicar suggeriment',
        ],

        'mode' => [
            'events' => 'Historial',
            'general' => 'General :scope',
            'reviews' => 'Revisiones',
            'timeline' => 'Cronologia',
            'scopes' => [
                'general' => 'Aquesta dificultat',
                'generalAll' => 'Totes les dificultats',
            ],
        ],

        'new' => [
            'pin' => 'Anclar',
            'timestamp' => 'Marca de temps',
            'timestamp_missing' => 'ctrl-c en mode d\'edició i enganxa el teu missatge per afegir una marca de temps!',
            'title' => 'Nova discusió',
            'unpin' => 'Desanclar',
        ],

        'review' => [
            'new' => 'Nova revisió',
            'embed' => [
                'delete' => 'Eliminar',
                'missing' => '[DISCUSIÓ ELIMINADA]',
                'unlink' => 'Desvincular',
                'unsaved' => 'No desat',
                'timestamp' => [
                    'all-diff' => 'Les publicacions a "Totes les dificultats" no poden tenir marques de temps.',
                    'diff' => 'Si el comentari de :type comença amb una marca de temps, es mostrarà a la Línia de temps.',
                ],
            ],
            'insert-block' => [
                'paragraph' => 'inserir paràgraf',
                'praise' => 'inserir elogi',
                'problem' => 'inserir problema',
                'suggestion' => 'inserir suggeriment',
            ],
        ],

        'show' => [
            'title' => ':title mapejat per :mapper',
        ],

        'sort' => [
            'created_at' => 'Data de creació',
            'timeline' => 'Línia de temps',
            'updated_at' => 'Última actualització',
        ],

        'stats' => [
            'deleted' => 'Eliminat',
            'mapper_notes' => 'Notes',
            'mine' => 'Mío',
            'pending' => 'Pendent',
            'praises' => 'Elogis',
            'resolved' => 'Resolt',
            'total' => 'Tots',
        ],

        'status-messages' => [
            'approved' => 'Aquest mapa es va aprovar el :date!',
            'graveyard' => "Aquest mapa no s'ha actualitzat des del :date, de manera que s'ha abandonat...",
            'loved' => 'Aquest mapa es va afegir a Estimats el :date!',
            'ranked' => 'Aquest mapa va ser classificat el :date!',
            'wip' => 'Nota: el creador ha marcat aquest mapa com a treball en curs.',
        ],

        'votes' => [
            'none' => [
                'down' => 'Encara no hi ha vots negatius',
                'up' => 'Encara no hi ha vots positius',
            ],
            'latest' => [
                'down' => 'Últims vots negatius',
                'up' => 'Últims vots positius',
            ],
        ],
    ],

    'hype' => [
        'button' => 'Mostra eufòria a aquest mapa!',
        'button_done' => 'Ja li has donat la teva mostra d\'eufòria!',
        'confirm' => "Segur? Això farà servir una de les teves :n mostres d'eufòria restants i no es pot desfer.",
        'explanation' => 'Mostra eufòria a aquest mapa per a fer-lo més visible per a la nominació i la classificació!',
        'explanation_guest' => 'Inicia sessió i mostra eufòria a aquest mapa per a fer-lo més visible per a la nominació i la classificació!',
        'new_time' => "Obtindràs una altra mostra d'eufòria :new_time.",
        'remaining' => 'Et queden :remaining mostres d\'eufòria.',
        'required_text' => 'Eufòria: :current/:required',
        'section_title' => 'Mostres d\'eufòria',
        'title' => 'Eufòria',
    ],

    'feedback' => [
        'button' => 'Deixar un comentari',
    ],

    'nominations' => [
        'already_nominated' => 'Ja has nominat aquest mapa.',
        'cannot_nominate' => 'No podeu nominar aquest mode de joc del mapa.',
        'delete' => 'Eliminar',
        'delete_own_confirm' => 'Estàs segur? El mapa s\'eliminarà i se us redigirirà de tornada al perfil.',
        'delete_other_confirm' => 'Estàs segur? El mapa s\'eliminarà i se us redigirirà al perfil d\'usuari.',
        'disqualification_prompt' => 'Motiu de la desqualificació?',
        'disqualified_at' => 'Desqualificat :time_ago (:reason).',
        'disqualified_no_reason' => 'no s\'ha especificat cap raó',
        'disqualify' => 'Desqualificar',
        'incorrect_state' => 'Error en realitzar aquesta acció, intenteu actualitzar la pàgina.',
        'love' => 'Estimar',
        'love_choose' => 'Trieu la dificultat per a l\'estimat',
        'love_confirm' => 'Estimar aquest mapa?',
        'nominate' => 'Nominar',
        'nominate_confirm' => 'Nominar aquest mapa?',
        'nominated_by' => 'nominat per :users',
        'not_enough_hype' => "No hi ha prou eufòria.",
        'remove_from_loved' => 'Eliminar de Estimats',
        'remove_from_loved_prompt' => 'Motiu per remoure d\'Estimats:',
        'required_text' => 'Nominacions: :current/:required',
        'reset_message_deleted' => 'eliminat',
        'title' => 'Estat de nominació',
        'unresolved_issues' => 'Encara hi ha problemes sense resoldre que primer s\'han de resoldre.',

        'rank_estimate' => [
            '_' => 'S\'estima que aquest mapa es classificarà :date si no es troben problemes. És el número :position a la :queue.',
            'unresolved_problems' => 'Aquest mapa no pot sortir de la secció qualificats fins que es resolvin :problems.',
            'problems' => 'aquests problemes',
            'on' => 'a :date',
            'queue' => 'cua de classificació',
            'soon' => 'aviat',
        ],

        'reset_at' => [
            'nomination_reset' => 'El procés de nominació ha estat reiniciat :time_ago per l\'usuari :user amb el nou problema :discussion (:message).',
            'disqualify' => 'Desqualificat :time_ago per :user amb el nou problema :discussion (:message).',
        ],

        'reset_confirm' => [
            'disqualify' => 'Estàs segur? Això eliminarà el mapa de la qualificació i restablirà el procés de nominació.',
            'nomination_reset' => 'N\'estàs segur? Publicar un nou problema reiniciarà el temps de nominació.',
            'problem_warning' => 'Segur que vols informar d\'un problema en aquest mapa? Això alertarà els Nominadors de Mapes.',
        ],
    ],

    'listing' => [
        'search' => [
            'prompt' => 'escriu paraules clau...',
            'login_required' => 'Inicia sessió per cercar.',
            'options' => 'Més opcions de cerca',
            'rank_filter_note' => '',
            'supporter_filter' => 'Filtrar per :filters requereix d\'una etiqueta osu!patrocinador activa',
            'not-found' => 'sense resultats',
            'not-found-quote' => '... no, no s\'ha trobat res.',
            'filters' => [
                'extra' => 'Extra',
                'general' => 'General',
                'genre' => 'Gènere',
                'language' => 'Idioma',
                'mode' => 'Mode',
                'nsfw' => 'Contingut explícit',
                'played' => 'Jugat',
                'rank' => 'Rang obtingut',
                'status' => 'Categories',
            ],
            'sorting' => [
                'title' => 'Títol',
                'artist' => 'Artista',
                'difficulty' => 'Dificultat',
                'favourites' => 'Preferits',
                'updated' => 'Actualitzat',
                'ranked' => 'Classificat',
                'rating' => 'Valoració',
                'plays' => 'Vegades jugat',
                'relevance' => 'Rellevància',
                'nominations' => 'Nominacions',
            ],
            'supporter_filter_quote' => [
                '_' => 'Filtrar per :filters requereix d\'un :link actiu',
                'link_text' => 'Etiqueta osu!supporter',
            ],
        ],
    ],
    'general' => [
        'converts' => 'Inclou beatmaps convertits',
        'featured_artists' => 'Artistes destacats',
        'follows' => 'Mapejadors subscrits',
        'recommended' => 'Dificultat recomanada',
        'spotlights' => 'Mapes destacats',
    ],
    'mode' => [
        'all' => 'Tots',
        'any' => 'Qualsevol',
        'osu' => '',
        'taiko' => '',
        'fruits' => '',
        'mania' => '',
        'undefined' => 'no establit',
    ],
    'status' => [
        'any' => 'Qualsevol',
        'approved' => 'Aprovat',
        'favourites' => 'Preferits',
        'graveyard' => 'Abandonat',
        'leaderboard' => 'Té marcador',
        'loved' => 'Estimat',
        'mine' => 'Els meus mapes',
        'pending' => 'Pendent',
        'wip' => 'WIP',
        'qualified' => 'Qualificat',
        'ranked' => 'Classificat',
    ],
    'genre' => [
        'any' => 'Qualsevol',
        'unspecified' => 'Sense especificar',
        'video-game' => 'Videojoc',
        'anime' => 'Anime',
        'rock' => 'Rock',
        'pop' => 'Pop',
        'other' => 'Altre',
        'novelty' => 'Novetat',
        'hip-hop' => 'Hip Hop',
        'electronic' => 'Electrònica',
        'metal' => 'Metal',
        'classical' => 'Clàssica',
        'folk' => 'Folk',
        'jazz' => 'Jazz',
    ],
    'language' => [
        'any' => 'Qualsevol',
        'english' => 'Anglès',
        'chinese' => 'Xinès',
        'french' => 'Francès',
        'german' => 'Alemany',
        'italian' => 'Italià',
        'japanese' => 'Japonès',
        'korean' => 'Coreà',
        'spanish' => 'Espanyol',
        'swedish' => 'Suec',
        'russian' => 'Rus',
        'polish' => 'Polonès',
        'instrumental' => 'Instrumental',
        'other' => 'Altre',
        'unspecified' => 'Sense especificar',
    ],

    'nsfw' => [
        'exclude' => 'Amaga',
        'include' => 'Mostra',
    ],

    'played' => [
        'any' => 'Qualsevol',
        'played' => 'Jugat',
        'unplayed' => 'No jugat',
    ],
    'extra' => [
        'video' => 'Té vídeo',
        'storyboard' => 'Té storyboard',
    ],
    'rank' => [
        'any' => 'Qualsevol',
        'XH' => 'SS Platejada',
        'X' => '',
        'SH' => 'S Platejada',
        'S' => '',
        'A' => '',
        'B' => '',
        'C' => '',
        'D' => '',
    ],
    'panel' => [
        'playcount' => 'Vegades jugat: :count',
        'favourites' => 'Preferits: :count',
    ],
    'variant' => [
        'mania' => [
            '4k' => '4K',
            '7k' => '7K',
            'all' => 'Totes',
        ],
    ],
];
