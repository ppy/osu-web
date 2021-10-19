<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'box' => [
        'sent' => 'May napadala na email sa :mail na may isang verification code. Ipasok ang code.',
        'title' => 'Beripikasyon ng Account',
        'verifying' => 'Nagve-verify...',
        'issuing' => 'Nagbibigay ng bagong code...',

        'info' => [
            'check_spam' => "Siguraduhin na suriin ang iyong spam folder kung hindi mo makita ang email.",
            'recover' => "Kung hindi mo magamit ang iyong email o nakalimutan na kung ano ang ginamit mo, pakisundan ang :link.",
            'recover_link' => 'proseso ng pagbawi ng email dito',
            'reissue' => 'Pwede ka ring :reissue_link o :logout_link.',
            'reissue_link' => 'humingi ng isa pang code',
            'logout_link' => 'mag-sign out',
        ],
    ],

    'errors' => [
        'expired' => 'Nag-expire na ang verification code, nagpadala na ng bagong verification code.',
        'incorrect_key' => 'Maling verification code.',
        'retries_exceeded' => 'Maling verification code. Lumampas sa limitasyon ng pag-ulit, nagpadala ng bagong verification email.',
        'reissued' => 'Nagpalabas muli ng verfication code, nagpadala ng bagong verification email.',
        'unknown' => 'May naganap na problemang hindi alam, nagpadala ng bagong verification email.',
    ],
];
