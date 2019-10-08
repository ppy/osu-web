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
    'codes' => [
        'http-401' => 'Per favore effettua il login per poter continuare.',
        'http-403' => 'Accesso Negato.',
        'http-404' => 'Non trovato.',
        'http-429' => 'Troppi tentativi. Riprova più tardi.',
    ],
    'account' => [
        'profile-order' => [
            'generic' => 'Si è verificato un errore. Prova a ricaricare la pagina.',
        ],
    ],
    'beatmaps' => [
        'invalid_mode' => 'Modalità specificata non valida.',
        'standard_converts_only' => 'Nessuno score disponibile per la modalità richiesta in questa difficoltà della beatmap.',
    ],
    'checkout' => [
        'generic' => 'Si è verificato un errore durante la preparazione del tuo checkout.',
    ],
    'search' => [
        'default' => 'Impossibile ottenere alcun risultato, riprova più tardi.',
        'operation_timeout_exception' => 'Attualmente la ricerca è più occupata del solito, riprova più tardi.',
    ],

    'logged_out' => 'Sei stato disconnesso. Per favore effettua di nuovo il login e riprova.',
    'supporter_only' => 'Devi essere un supporter per poter usare questa funzionalità.',
    'no_restricted_access' => 'Non puoi fare questa azione mentre il tuo account è limitato.',
    'unknown' => 'Si è verificato un errore sconosciuto.',
];
