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
    'limitation_notice' => 'Бележка: Само хората, които използват <a href=":lazer_link">osu!lazer</a> или новия сайт ще получат лични съобщения чрез тази система.<br/>Ако не сте сигурни, вместо това можете да изпратите съобщение чрез <a href=":oldpm_link">старата страница за лични съобщения</a>.',
    'talking_in' => 'говорите в :channel',
    'talking_with' => 'в разговор с :name',
    'title_compact' => 'чат',

    'cannot_send' => [
        'channel' => 'Неуспешно изпращане на съобщение в дадения канал. Това може да се дължи на някоя от следните причини:',
        'user' => 'Неуспешно изпращане на съобщение до дадения потребител. Това може да се дължи на някоя от следните причини:',
        'reasons' => [
            'blocked' => 'Вие бяхте блокирани от получателя',
            'channel_moderated' => 'Каналът е модериран',
            'friends_only' => 'Получателят приема само съобщения от хора, които са част от списъка му с приятели',
            'restricted' => 'В момента сте с ограничен статут',
            'target_restricted' => 'Получателят е в момента с ограничен статут',
        ],
    ],
    'input' => [
        'disabled' => 'неуспешно изпратено съобщение...',
        'placeholder' => 'напиши своето съобщение...',
        'send' => 'Изпрати',
    ],
    'no-conversations' => [
        'howto' => "Започнете дискусия с потребител от неговия профил или изкачащ прозорец.",
        'lazer' => 'Публичните канали, в които сте се присъединили чрез <a href=":link">osu!lazer</a> ще бъдат видими и тук.',
        'pm_limitations' => 'Само хората, които използват <a href=":link">osu!lazer</a> или новия сайт ще получат лични съобщения.',
        'title' => 'няма налични дискусии',
    ],
];
