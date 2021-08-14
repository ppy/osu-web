<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'support' => [
        'convinced' => [
            'title' => 'Mi hai convinto! :D',
            'support' => 'sostieni osu!',
            'gift' => 'o regala il supporter ad altri giocatori',
            'instructions' => 'clicca il pulsante con il cuore per procedere all\'osu!store',
        ],
        'why-support' => [
            'title' => 'Perché dovrei sostenere osu!? Dove vanno a finire i soldi?',

            'team' => [
                'title' => 'Supporto al Team',
                'description' => 'Un piccolo team sviluppa e fa funzionare osu!. Il tuo supporto li aiuterebbe, sai... a vivere.',
            ],
            'infra' => [
                'title' => 'Infrastruttura del Server',
                'description' => 'I contributi vanno ai server per la gestione del sito web, dei servizi multigiocatore, delle classifiche online, ecc.',
            ],
            'featured-artists' => [
                'title' => 'Artisti in primo piano',
                'description' => 'Con il tuo supporto possiamo raggiungere tanti altri fantastici artisti e ottenere la licenza per poter utilizzare molta più musica su osu!',
                'link_text' => 'Visualizza l\'elenco attuale &raquo;',
            ],
            'ads' => [
                'title' => 'Mantenere osu! auto-sostenente',
                'description' => 'I tuoi contributi aiutano a mantenere il gioco indipendente e completamente libero da pubblicità e sponsor esterni.',
            ],
            'tournaments' => [
                'title' => 'Tornei Ufficiali',
                'description' => 'Aiuta a finanziare il funzionamento (e i premi) dei tornei osu! World Cup ufficiali.',
                'link_text' => 'Esplora i tornei &raquo;',
            ],
            'bounty-program' => [
                'title' => 'Programma Open Source Bounty',
                'description' => 'Supporta i contributori della comunità che hanno dato il loro tempo ed impegno per aiutare a rendere osu! migliore.',
                'link_text' => 'Scopri di più &raquo;',
            ],
        ],
        'perks' => [
            'title' => 'Figo! E che vantaggi ottengo?',
            'osu_direct' => [
                'title' => 'osu!direct',
                'description' => 'Ottieni un accesso rapido e semplice per cercare e scaricare beatmap senza dover lasciare il gioco.',
            ],

            'friend_ranking' => [
                'title' => 'Rank degli Amici',
                'description' => "Guarda quanto competi contro i tuoi amici sulla classifica di una beatmap, sia in gioco che sul sito web.",
            ],

            'country_ranking' => [
                'title' => 'Rank del Paese',
                'description' => 'Conquista il tuo paese prima di conquistare il mondo.',
            ],

            'mod_filtering' => [
                'title' => 'Filtro per Mod',
                'description' => 'Vuoi associare solo persone che giocano HDHR? Nessun problema!',
            ],

            'auto_downloads' => [
                'title' => 'Download Automatici',
                'description' => 'Le beatmap verranno scaricate automaticamente in partite multigiocatore, mentre guardi altri giocare, o cliccando vari link in chat!',
            ],

            'upload_more' => [
                'title' => 'Carica di più',
                'description' => 'Spazi addizionali per beatmap in attesa (per beatmap classificate) fino ad un massimo di 10.',
            ],

            'early_access' => [
                'title' => 'Accesso Anticipato',
                'description' => 'Ottieni l\'accesso anticipato a nuove versioni con nuove funzionalità prima che vengano rilasciate!<br/><br/>Questo include l\'accesso anticipato anche a nuove funzionalità sul sito web!',
            ],

            'customisation' => [
                'title' => 'Personalizzazione',
                'description' => "Puoi spiccare caricando un'immagine personalizzata o creando una sezione 'io!' totalmente personalizzabile nel tuo profilo.",
            ],

            'beatmap_filters' => [
                'title' => 'Filtri Beatmap',
                'description' => 'Filtra le ricerche beatmap per mappe giocate e non giocate, o per grado raggiunto (se disponibile).',
            ],

            'yellow_fellow' => [
                'title' => 'Compagno Giallo',
                'description' => 'Fatti riconoscere in gioco con il tuo nuovo colore del nome utente giallo.',
            ],

            'speedy_downloads' => [
                'title' => 'Download Rapidi',
                'description' => 'Restrizioni più leggere sui download, specialmente quando si utilizza osu!direct.',
            ],

            'change_username' => [
                'title' => 'Cambio del Nome Utente',
                'description' => 'Un cambio gratuito di nome è incluso nel tuo primo acquisto del supporter.',
            ],

            'skinnables' => [
                'title' => 'Elementi Skinnabili',
                'description' => 'Maggiori elementi skinnabili in gioco, come ad esempio lo sfondo del menu.',
            ],

            'feature_votes' => [
                'title' => 'Voti delle funzionalità',
                'description' => 'Voti per le richieste di funzionalità. (2 per mese di supporter acquistato)',
            ],

            'sort_options' => [
                'title' => 'Opzioni di Ordinamento',
                'description' => 'La possibilità di vedere la classifica nazionale / amici / con mod specifiche di una beatmap in gioco.',
            ],

            'more_favourites' => [
                'title' => 'Più Preferiti',
                'description' => 'Il numero massimo di beatmap che puoi aggiungere ai preferiti è aumentato da :normally &rarr; :supporter',
            ],
            'more_friends' => [
                'title' => 'Più Amici',
                'description' => 'Il numero massimo di amici che puoi avere è aumentato da :normally &rarr; :supporter',
            ],
            'more_beatmaps' => [
                'title' => 'Carica più Beatmap',
                'description' => 'Il numero di beatmap in attesa di rank che puoi avere allo stesso tempo è calcolato da un valore base sommato ad un bonus aggiuntivo per ogni beatmap classificata che possiedi (fino ad un limite).<br/><br/>Normalmente sarebbe :base più :bonus per ogni beatmap classificata (fino a :bonus_max). Con il supporter, questo aumenta a :supporter_base più :supporter_bonus per beatmap classificata (fino a :supporter_bonus_max).',
            ],
            'friend_filtering' => [
                'title' => 'Classifiche con Amici',
                'description' => 'Competi con i tuoi amici e guarda come ti classifichi rispetto a loro!',
            ],

        ],
        'supporter_status' => [
            'contribution' => 'Grazie per il tuo sostegno finora! Hai contribuito un totale di :dollars in :tags tag acquistati!',
            'gifted' => ":giftedTags dei tuo tag acquistati sono stati regalati (per un totale di :giftedDollars donati), come sei generoso!",
            'not_yet' => "Non hai ancora un tag osu!supporter :(",
            'valid_until' => 'Il tuo attuale tag osu!supporter è valido fino al :date!',
            'was_valid_until' => 'Il tuo tag supporter era valido fino al :date.',
        ],
    ],
];
