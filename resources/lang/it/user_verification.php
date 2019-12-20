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
    'box' => [
        'sent' => 'Un email è stata inviata a :mail con un codice di verifica. Inserisci il codice.',
        'title' => 'Verifica Account',
        'verifying' => 'Verificando...',
        'issuing' => 'Distribuendo il nuovo codice...',

        'info' => [
            'check_spam' => "Assicurati di controllare la tua cartella spam se nn riesci a trovare la email.",
            'recover' => "Se non riesci ad accedere alla tua email o hai dimenticato quale hai usato, per favore segui il :link.",
            'recover_link' => 'processo di recupero email qui',
            'reissue' => 'Puoi anche :reissue_link oppure :logout_link.',
            'reissue_link' => 'richiedere un altro codice',
            'logout_link' => 'disconnetterti',
        ],
    ],

    'errors' => [
        'expired' => 'Codice di verifica scaduto, è stata inviata una nuova email di verifica.',
        'incorrect_key' => 'Codice di verifica errato.',
        'retries_exceeded' => 'Codice di verifica errato. Raggiunto il limite di tentativi, nuovo codice di verifica inviato.',
        'reissued' => 'Nuovo codice di verifica richiesto, è stata inviata una nuova email di verifica.',
        'unknown' => 'È successo un problema sconosciuto, è stata inviata una nuova email di verifica.',
    ],
];
