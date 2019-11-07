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
    'not_negative' => ':attribute non può essere negativo.',
    'required' => ':attribute è richiesto.',
    'too_long' => ':attribute ha superato la lunghezza massima - può essere solo fino a :limit caratteri.',
    'wrong_confirmation' => 'La conferma non corrisponde.',

    'beatmap_discussion_post' => [
        'discussion_locked' => 'La discussione è chiusa.',
        'first_post' => 'Non puoi cancellare il post iniziale.',

        'attributes' => [
            'message' => 'Il messaggio',
        ],
    ],

    'beatmapset_discussion' => [
        'beatmap_missing' => 'Il timestamp è specificato ma manca la beatmap.',
        'beatmapset_no_hype' => "La beatmap non può essere promossa.",
        'hype_requires_null_beatmap' => 'La promozione deve essere fatta nella sezione Generale (tutte le difficoltà).',
        'invalid_beatmap_id' => 'Difficoltà specificata non valida.',
        'invalid_beatmapset_id' => 'Beatmap specificata non valida.',
        'locked' => 'La discussione è chiusa.',

        'attributes' => [
            'message_type' => 'Tipo di messaggio',
            'timestamp' => 'Data',
        ],

        'hype' => [
            'guest' => 'Devi avere effettuato il login per promuovere.',
            'hyped' => 'Hai già promosso questa beatmap.',
            'limit_exceeded' => 'Hai usato tutte le tue promozioni.',
            'not_hypeable' => 'Questa beatmap non può essere promossa',
            'owner' => 'Nessuna promozione nella tua beatmap.',
        ],

        'timestamp' => [
            'exceeds_beatmapset_length' => 'Il timestamp specificato è oltre la lunghezza della beatmap.',
            'negative' => "Il timestamp non può essere negativo.",
        ],
    ],

    'comment' => [
        'deleted_parent' => 'Non è permesso rispondere ad un commento eliminato.',

        'attributes' => [
            'message' => 'Il messaggio',
        ],
    ],

    'follow' => [
        'invalid' => ':attribute specificato invalido.',
    ],

    'forum' => [
        'feature_vote' => [
            'not_feature_topic' => 'Puoi votare solamente una richiesta di feature.',
            'not_enough_feature_votes' => 'Non hai abbastanza voti.',
        ],

        'poll_vote' => [
            'invalid' => 'Specificata un\'Opzione Invalida.',
        ],

        'post' => [
            'beatmapset_post_no_delete' => 'Cancellare i metadata di una beatmap non è consentito.',
            'beatmapset_post_no_edit' => 'Modificare i metadata di una beatmap non è consentito.',
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
            'grace_period_expired' => 'Non è possibile modificare un sondaggio dopo :limit ore',
            'hiding_results_forever' => 'Non è possibile nascondere i risultati di un sondaggio che non finisce mai.',
            'invalid_max_options' => 'Le opzioni per utente non possono superare il numero di opzioni disponibili.',
            'minimum_one_selection' => 'È richiesto un minimo di un\'opzione per utente.',
            'minimum_two_options' => 'È necessario almeno due opzioni.',
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
        'contains_username' => 'Password potrebbe non contenere il nome utente.',
        'email_already_used' => 'Indirizzo email già in uso.',
        'invalid_country' => 'Paese non presente nel database.',
        'invalid_discord' => 'Nome utente di Discord non valido.',
        'invalid_email' => "Non sembra essere un indirizzo email valido.",
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
        'wrong_password_confirmation' => 'La conferma della password non coincide.',
        'too_long' => 'Lunghezza massima superata - può essere solo fino a :limit caratteri.',

        'attributes' => [
            'username' => 'Nome utente',
            'user_email' => 'Indirizzo email',
            'password' => 'Password',
        ],

        'change_username' => [
            'restricted' => 'Non puoi cambiare il tuo nome utente mentre sei limitato.',
            'supporter_required' => [
                '_' => 'Devi essere :link per cambiare il tuo nome!',
                'link_text' => 'osu! sostenuto',
            ],
            'username_is_same' => 'Questo è già il tuo nome utente, stupido!',
        ],
    ],

    'user_report' => [
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
