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
    'error' => [
        'chat' => [
            'empty' => 'لا يمكن إرسال رسالة فارغة.',
            'limit_exceeded' => 'انت تقوم بإرسال الرسائل بسرعة كبيرة, الرجاء الانتظار قليلاً قبل المحاولة مرة أخرى.',
            'too_long' => 'أنت تحاول إرسال رسالة طويلة جداً.',
        ],
    ],

    'scopes' => [
        'identify' => 'يمكن له ان يتعرف عليك وان يقرأ ملفك الشخصي العام.',

        'friends' => [
            'read' => 'رؤية الأشخاص الذين تتابعهم.',
        ],
    ],
];
