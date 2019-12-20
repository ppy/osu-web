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
