<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'availability' => [
        'disabled' => 'Questa beatmap non è al momento disponibile per il download.',
        'parts-removed' => 'Porzioni di questa beatmap sono state rimosse su richiesta del creatore o di un titolare di copyright di terze parti.',
        'more-info' => 'Controlla qui per maggiori informazioni.',
        'rule_violation' => 'Alcuni elementi contenuti in questa mappa sono stati rimossi dopo che sono stati giudicati non idonei per l\'uso in osu!.',
    ],

    'download' => [
        'limit_exceeded' => 'Rallenta, gioca di più.',
    ],

    'featured_artist_badge' => [
        'label' => 'Artista in primo piano',
    ],

    'index' => [
        'title' => 'Lista Beatmap',
        'guest_title' => 'Beatmap',
    ],

    'panel' => [
        'empty' => 'nessuna beatmap',

        'download' => [
            'all' => 'scarica',
            'video' => 'scarica con il video',
            'no_video' => 'scarica senza il video',
            'direct' => 'apri in osu!direct',
        ],
    ],

    'nominate' => [
        'hybrid_requires_modes' => 'Un beatmapset ibrido richiede che venga selezionata almeno una modalità di gioco per poterla nominare.',
        'incorrect_mode' => 'Non hai il permesso di nominare per la modalità: :mode',
        'full_bn_required' => 'Devi essere un nominatore completo per eseguire questa nomina qualificante.',
        'too_many' => 'Requisito di nomina già soddisfatto.',

        'dialog' => [
            'confirmation' => 'Sei sicuro di voler nominare questa beatmap?',
            'header' => 'Nomina Beatmap',
            'hybrid_warning' => 'nota: puoi nominare una sola volta, quindi assicurati di nominare per tutte le modalità di gioco che vuoi',
            'which_modes' => 'Nominare per quali modalità?',
        ],
    ],

    'nsfw_badge' => [
        'label' => 'Explicit',
    ],

    'show' => [
        'discussion' => 'Discussione',

        'details' => [
            'by_artist' => 'di :artist',
            'favourite' => 'Mi piace questa beatmap',
            'favourite_login' => 'Accedi per aggiungere questa beatmap ai preferiti',
            'logged-out' => 'Devi avere effettuato il login prima di scaricare qualsiasi beatmap!',
            'mapped_by' => 'mappata da :mapper',
            'unfavourite' => 'Non mi piace questa beatmap',
            'updated_timeago' => 'ultimo aggiornamento :timeago',

            'download' => [
                '_' => 'Scarica',
                'direct' => '',
                'no-video' => 'senza Video',
                'video' => 'con Video',
            ],

            'login_required' => [
                'bottom' => 'per accedere a maggiori funzionalità',
                'top' => 'Accedi',
            ],
        ],

        'details_date' => [
            'approved' => 'approvata :timeago',
            'loved' => 'amata :timeago',
            'qualified' => 'qualificata :timeago',
            'ranked' => 'classificata :timeago',
            'submitted' => 'inviata :timeago',
            'updated' => 'ultimo aggiornamento :timeago',
        ],

        'favourites' => [
            'limit_reached' => 'Hai troppe beatmap preferite! Rimuovine qualcuna prima di riprovare.',
        ],

        'hype' => [
            'action' => 'Metti hype a questa beatmap se ti sei divertito a giocarla per aiutare a renderla <strong>Classificata</strong>.',

            'current' => [
                '_' => 'Questa mappa è attualmente :status.',

                'status' => [
                    'pending' => 'in attesa',
                    'qualified' => 'qualificata',
                    'wip' => 'work in progress',
                ],
            ],

            'disqualify' => [
                '_' => 'Se trovi un errore in questa beatmap, per favore segnalalo :link.',
            ],

            'report' => [
                '_' => 'Se trovi un problema con questa beatmap, segnalalo :link per avvisare il team.',
                'button' => 'Segnala un Problema',
                'link' => 'qui',
            ],
        ],

        'info' => [
            'description' => 'Descrizione',
            'genre' => 'Genere',
            'language' => 'Lingua',
            'no_scores' => 'Dati ancora in elaborazione...',
            'nsfw' => 'Contenuto esplicito',
            'points-of-failure' => 'Punti di Fallimento',
            'source' => 'Sorgente',
            'storyboard' => 'Questa beatmap contiene storyboard',
            'success-rate' => 'Rateo di Successo',
            'tags' => 'Tag',
            'video' => 'Questa beatmap contiene video',
        ],

        'nsfw_warning' => [
            'details' => 'Questa beatmap ha contenuti espliciti, offensivi o disturbanti. Vuoi vederla comunque?',
            'title' => 'Contenuto Esplicito',

            'buttons' => [
                'disable' => 'Disabilita avviso',
                'listing' => 'Torna alla lista',
                'show' => 'Mostra',
            ],
        ],

        'scoreboard' => [
            'achieved' => 'ottenuto :when',
            'country' => 'Classifica Nazionale',
            'friend' => 'Classifica Amici',
            'global' => 'Classifica Globale',
            'supporter-link' => 'Clicca <a href=":link">qui</a> per vedere tutte le fantastiche funzionalità che otterrai!',
            'supporter-only' => 'Devi essere un osu!supporter per vedere la classifica amici, nazionale, o con mod specifiche!',
            'title' => 'Classifica',

            'headers' => [
                'accuracy' => 'Precisione',
                'combo' => 'Combo Massima',
                'miss' => 'Miss',
                'mods' => 'Mod',
                'pin' => 'Fissa',
                'player' => 'Giocatore',
                'pp' => '',
                'rank' => 'Posto',
                'score' => 'Punteggio',
                'score_total' => 'Punteggio Totale',
                'time' => 'Tempo',
            ],

            'no_scores' => [
                'country' => 'Nessuno dal tuo paese ha fatto un punteggio in questa mappa!',
                'friend' => 'Nessuno dei tuoi amici ha ancora fatto un punteggio su questa mappa!',
                'global' => 'Ancora nessun punteggio. Perché non provi a farne uno?',
                'loading' => 'Caricamento punteggi...',
                'unranked' => 'Beatmap non classificata.',
            ],
            'score' => [
                'first' => 'In testa',
                'own' => 'Il tuo miglior punteggio',
            ],
            'supporter_link' => [
                '_' => '',
                'here' => '',
            ],
        ],

        'stats' => [
            'cs' => 'Dimensione Cerchi',
            'cs-mania' => 'Numero di Tasti',
            'drain' => 'Drenaggio HP',
            'accuracy' => 'Precisione',
            'ar' => 'Approach Rate',
            'stars' => 'Stelle di Difficoltà',
            'total_length' => 'Durata (Lunghezza drenaggio: :hit_length)',
            'bpm' => 'BPM',
            'count_circles' => 'Numero di Cerchi',
            'count_sliders' => 'Numero di Slider',
            'user-rating' => 'Voto degli Utenti',
            'rating-spread' => 'Diffusione della Valutazione',
            'nominations' => 'Nomine',
            'playcount' => 'Volte giocata',
        ],

        'status' => [
            'ranked' => 'Classificata',
            'approved' => 'Approvata',
            'loved' => 'Amata',
            'qualified' => 'Qualificata',
            'wip' => 'WIP',
            'pending' => 'In Attesa',
            'graveyard' => 'Abbandonata',
        ],
    ],
];
