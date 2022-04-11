<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'invalid' => ':attribute specificato invalido.',
    'not_negative' => ':attribute non può essere negativo.',
    'required' => ':attribute è richiesto.',
    'too_long' => ':attribute ha superato la lunghezza massima - può essere solo fino a :limit caratteri.',
    'wrong_confirmation' => 'La conferma non corrisponde.',

    'beatmapset_discussion' => [
        'beatmap_missing' => 'Il timestamp è specificato ma manca la beatmap.',
        'beatmapset_no_hype' => "La beatmap non può avere hype.",
        'hype_requires_null_beatmap' => 'Si può mettere hype nella sezione Generale (Tutte le difficoltà).',
        'invalid_beatmap_id' => 'Difficoltà specificata non valida.',
        'invalid_beatmapset_id' => 'Beatmap specificata non valida.',
        'locked' => 'La discussione è chiusa.',

        'attributes' => [
            'message_type' => 'Tipo di messaggio',
            'timestamp' => 'Timestamp',
        ],

        'hype' => [
            'discussion_locked' => "Al momento questa beatmap è bloccata per le discussioni e non può avere hype",
            'guest' => 'Devi avere effettuato il login per mettere hype.',
            'hyped' => 'Hai già messo hype a questa beatmap.',
            'limit_exceeded' => 'Hai usato tutti i tuoi hype.',
            'not_hypeable' => 'Questa beatmap non può avere hype',
            'owner' => 'Non puoi mettere hype alla tua beatmap.',
        ],

        'timestamp' => [
            'exceeds_beatmapset_length' => 'Il timestamp specificato è oltre la lunghezza della beatmap.',
            'negative' => "Il timestamp non può essere negativo.",
        ],
    ],

    'beatmapset_discussion_post' => [
        'discussion_locked' => 'La discussione è chiusa.',
        'first_post' => 'Non si può eliminare il post iniziale.',

        'attributes' => [
            'message' => 'Il messaggio',
        ],
    ],

    'comment' => [
        'deleted_parent' => 'Non è permesso rispondere ad un commento eliminato.',
        'top_only' => 'Non è permesso fissare una risposta.',

        'attributes' => [
            'message' => 'Il messaggio',
        ],
    ],

    'follow' => [
        'invalid' => ':attribute specificato invalido.',
    ],

    'forum' => [
        'feature_vote' => [
            'not_feature_topic' => 'Puoi votare solo una richiesta di funzionalità.',
            'not_enough_feature_votes' => 'Non hai abbastanza voti.',
        ],

        'poll_vote' => [
            'invalid' => 'È stata specificata un\'opzione non valida.',
        ],

        'post' => [
            'beatmapset_post_no_delete' => 'Cancellare i metadata della beatmap di un post non è consentito.',
            'beatmapset_post_no_edit' => 'Modificare i metadata della beatmap di un post non è consentito.',
            'first_post_no_delete' => 'Non si può eliminare il post iniziale',
            'missing_topic' => 'Il post non ha un topic',
            'only_quote' => 'La tua risposta contiene solo una citazione.',

            'attributes' => [
                'post_text' => 'Contenuto del post',
            ],
        ],

        'topic' => [
            'attributes' => [
                'topic_title' => 'Titolo dell\'argomento',
            ],
        ],

        'topic_poll' => [
            'duplicate_options' => 'Non è permesso avere un\'opzione duplicata.',
            'grace_period_expired' => 'Non è possibile modificare un sondaggio dopo :limit ore.',
            'hiding_results_forever' => 'Non è possibile nascondere i risultati di un sondaggio che non finisce mai.',
            'invalid_max_options' => 'Le opzioni per utente non possono superare il numero di opzioni disponibili.',
            'minimum_one_selection' => 'È richiesto un minimo di un\'opzione per utente.',
            'minimum_two_options' => 'Servono almeno due opzioni.',
            'too_many_options' => 'Raggiunto il massimo numero di opzioni permesse.',

            'attributes' => [
                'title' => 'Titolo del sondaggio',
            ],
        ],

        'topic_vote' => [
            'required' => 'Seleziona un\'opzione quando voti.',
            'too_many' => 'Sono state selezionate più opzioni del consentito.',
        ],
    ],

    'oauth' => [
        'client' => [
            'too_many' => 'Superato il numero massimo di applicazioni OAuth consentite.',
            'url' => 'Inserisci un URL valido.',

            'attributes' => [
                'name' => 'Nome Applicazione',
                'redirect' => 'URL di richiamo dell\'applicazione',
            ],
        ],
    ],

    'user' => [
        'contains_username' => 'La password non deve contenere il nome utente.',
        'email_already_used' => 'Indirizzo email già in uso.',
        'email_not_allowed' => 'Indirizzo email non valido.',
        'invalid_country' => 'Paese non presente nel database.',
        'invalid_discord' => 'Nome utente di Discord non valido.',
        'invalid_email' => "Non sembra essere un indirizzo email valido.",
        'invalid_twitter' => 'Nome utente di Twitter non valido.',
        'too_short' => 'La nuova password è troppo corta.',
        'unknown_duplicate' => 'Nome utente o indirizzo email già in uso.',
        'username_available_in' => 'Questo nome utente sarà disponibile per l\'uso tra :duration.',
        'username_available_soon' => 'Questo nome utente sarà disponibile per l\'uso da un momento all\'altro!',
        'username_invalid_characters' => 'Il nome utente richiesto contiene caratteri non validi.',
        'username_in_use' => 'Il nome utente è già in uso!',
        'username_locked' => 'Nome utente già in uso!', // TODO: language for this should be slightly different.
        'username_no_space_userscore_mix' => 'Si prega di utilizzare caratteri di sottolineatura o spazi, non entrambi!',
        'username_no_spaces' => "Il nome utente non può iniziare o finire con spazi!",
        'username_not_allowed' => 'La scelta di questo nome utente non è consentita.',
        'username_too_short' => 'Il nome utente richiesto è troppo corto.',
        'username_too_long' => 'Il nome utente richiesto è troppo lungo.',
        'weak' => 'Password bandita.',
        'wrong_current_password' => 'La password attuale non è corretta.',
        'wrong_email_confirmation' => 'La conferma della email non corrisponde.',
        'wrong_password_confirmation' => 'La conferma della password non corrisponde.',
        'too_long' => 'Lunghezza massima superata - può essere solo fino a :limit caratteri.',

        'attributes' => [
            'username' => 'Nome utente',
            'user_email' => 'Indirizzo email',
            'password' => 'Password',
        ],

        'change_username' => [
            'restricted' => 'Non puoi cambiare il tuo nome utente mentre sei limitato.',
            'supporter_required' => [
                '_' => 'Devi avere :link per cambiare il tuo nome!',
                'link_text' => 'sostenuto osu!',
            ],
            'username_is_same' => 'Questo è già il tuo nome utente, sciocco!',
        ],
    ],

    'user_report' => [
        'no_ranked_beatmapset' => 'Le beatmap classificate non possono essere segnalate',
        'reason_not_valid' => ':reason non è valido per questo tipo di segnalazione.',
        'self' => "Non puoi segnalare te stesso!",
    ],

    'store' => [
        'order_item' => [
            'attributes' => [
                'quantity' => 'Quantità',
                'cost' => 'Prezzo',
            ],
        ],
    ],
];
