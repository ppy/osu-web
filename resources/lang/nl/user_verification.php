<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'box' => [
        'sent' => 'Een e-mail is gestuurd naar :mail met een bevestigingscode. Vul de code in.',
        'title' => 'Accountverificatie',
        'verifying' => 'Verifiëren...',
        'issuing' => 'Nieuwe code versturen...',

        'info' => [
            'check_spam' => "Controleer zeker je spam folder als je de e-mail niet terugvindt.",
            'recover' => "Als je je e-mail niet kan bereiken of je bent vergeten wat je hebt gebruikt, volg dan de :link.",
            'recover_link' => 'e-mail herstelproces hier',
            'reissue' => 'Je kan ook :reissue_link of :logout_link.',
            'reissue_link' => 'vraag een andere code aan',
            'logout_link' => 'uitloggen',
        ],
    ],

    'errors' => [
        'expired' => 'Verificatiecode is verlopen, nieuwe verificatie e-mail verstuurd.',
        'incorrect_key' => 'Onjuiste verificatiecode.',
        'retries_exceeded' => 'Onjuiste verificatiecode. Limiet opnieuw proberen overschreden, nieuwe verificatie e-mail verstuurd.',
        'reissued' => 'Verificatiecode is hermaakt, nieuwe verificatie e-mail verstuurd.',
        'unknown' => 'Onbekend probleem trad op, nieuwe verificatie e-mail verstuurd.',
    ],
];
