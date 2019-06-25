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
    'all_read' => 'Усе апавяшчэнні прачытаныя!',
    'mark_all_read' => 'Ачысціць усё',
    'message_multi' => ':count_delimited новае абнаўленне на ":title".|:count_delimited новыя абнаўленні на ":title".',

    'item' => [
        'beatmapset' => [
            '_' => 'Бітмапа',

            'beatmapset_discussion' => [
                '_' => 'Абмеркаванне бітмапы',
                'beatmapset_discussion_lock' => 'Бітмапа ":title" заблакавана для абмеркавання.',
                'beatmapset_discussion_post_new' => ':username размясціў новае паведамленне ў абмеркаванні бітмапы ":title".',
                'beatmapset_discussion_unlock' => 'Бітмапа ":title" разблакава для абмеркавання.',
            ],

            'beatmapset_state' => [
                '_' => 'Стан бітмапы зменены',
                'beatmapset_disqualify' => 'Бітмапа ":title" была дыскваліфікавана :username.',
                'beatmapset_love' => ':username надаў стан loved бітмапе ":title".',
                'beatmapset_nominate' => 'Бітмапа ":title" была намінавана :username.',
                'beatmapset_qualify' => 'Бітмапа ":title" было надана дастаткова намінацый для чакання ранга.',
                'beatmapset_reset_nominations' => 'Праблема, якую размясціў :username выклікала скід намінацыі бітмапы ":title" ',
            ],
        ],

        'forum_topic' => [
            '_' => 'Тэма форуму',

            'forum_topic_reply' => [
                '_' => 'Новы адказ на форуме',
                'forum_topic_reply' => 'карыстальнік :username адказаў у тэме ":title".',
            ],
        ],

        'legacy_pm' => [
            '_' => 'Правілы Forum PM',

            'legacy_pm' => [
                '_' => '',
                'legacy_pm' => ':count_delimited непрачытанае паведамленне.|:count_delimited ннепрачытанныя паведамленні.',
            ],
        ],
    ],
];
