<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'box' => [
        'sent' => 'Un email è stata inviata a :mail con un codice di verifica. Inserisci il codice.',
        'title' => 'Verifica Account',
        'verifying' => 'Verificando...',
        'issuing' => 'Distribuendo il nuovo codice...',

        'info' => [
            'check_spam' => "Assicurati di controllare la tua cartella spam se non riesci a trovare la email.",
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
