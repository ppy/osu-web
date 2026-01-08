<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'error' => [
        'chat' => [
            'empty' => 'Бос хабарлама жібере алмайсыз.',
            'limit_exceeded' => 'Сіз хабарламаларды тым жылдам жіберіп жатырсыз. Өтініш, күте тұрыңыз.',
            'too_long' => 'Жібергіңіз келетін хабарлама тым ұзын.',
        ],
    ],

    'scopes' => [
        'bot' => 'Чат-бот ретінде әрекет ету.',
        'identify' => 'Сізді идентификациялау және сіздің көпшілікке қолжетімді деректеріңізді оқу.',

        'chat' => [
            'read' => '',
            'write' => 'Сіздің атыңыздан хабарламалар жіберу.',
            'write_manage' => '',
        ],

        'forum' => [
            'write' => 'Сіздің атыңыздан форум тақырыптарын және посттарын құрау және редакциялау.',
            'write_manage' => '',
        ],

        'friends' => [
            'read' => 'Кімдерге жазылғаныңызды көру.',
        ],

        'public' => 'Сіздің атыңыздан жария деректерді оқу.',
    ],
];
