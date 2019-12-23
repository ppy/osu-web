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
    'require_login' => 'Каб працягнуць, увайдзіце.',
    'require_verification' => '',
    'restricted' => "Нельга рабіць гэта падчас абмежавання.",
    'silenced' => "Нельга рабіць гэта падчас зацішша.",
    'unauthorized' => 'Доступ забаронены.',

    'beatmap_discussion' => [
        'destroy' => [
            'is_hype' => 'Нельга адмяніць хайп.',
            'has_reply' => 'Нельга выдаліць абмеркаванне з адказамі',
        ],
        'nominate' => [
            'exhausted' => 'Вы дасягнуліі ліміту намінацый, паспрабуйце нанова заўтра.',
            'full_bn_required' => 'Вы павінны быць паўнапраўным намінатарам, каб выставіць гэта на намінацыю.',
            'full_bn_required_hybrid' => 'Вы павінны быць паўнапраўным намінатарам, каб намінаваць бітмапы з больш чым за адзін рэжым гульні.',
            'incorrect_state' => 'Узнікла невядомая памылка, паспрабуйце перазагрузіць старонку.',
            'owner' => "Нельга намінаваць уласную бітмапу.",
        ],
        'resolve' => [
            'not_owner' => 'Толькі стваральнік тэмы і бітмапы можа скончыць абмеркаванне.',
        ],

        'store' => [
            'mapper_note_wrong_user' => 'Толькі ўладальнік бітмапы або намінатар/член суполкі можа размяшчаць нататкі для мапераў.',
        ],

        'vote' => [
            'limit_exceeded' => 'Трохі пачакайце перш, чым працягнуць галасаваць далей',
            'owner' => "Нельга прагаласаваць за ўласнае абмеркаванне.",
            'wrong_beatmapset_state' => 'Магчыма толькі прагаласаваць у абмеркаваннях бітмап, што чакаюцца.',
        ],
    ],

    'beatmap_discussion_post' => [
        'destroy' => [
            'not_owner' => '',
            'resolved' => '',
            'system_generated' => '',
        ],

        'edit' => [
            'not_owner' => 'Толькі аўтар можа рэдагаваць допіс.',
            'resolved' => '',
            'system_generated' => 'Немагчыма рэдагаваць аўтаматычна створаны допіс.',
        ],

        'store' => [
            'beatmapset_locked' => 'Гэта бітмапа заблакавана для абмеркавання.',
        ],
    ],

    'chat' => [
        'blocked' => 'Нельга адправіць паведамленне карыстальніку, які заблакаваў вас або якога заблакаваў вы.',
        'friends_only' => 'Карыстальнік заблакаваў паведамленні ад людзей, якіх няма ў спісе сяброў.',
        'moderated' => 'Канал зараз мадэруецца.',
        'no_access' => 'Вы не маеце доступу да гэтага каналу.',
        'restricted' => 'Нельга адпраўляць паведамленні, калі вы ў спісе забаненых, абмежаваных або рыд-онлі.',
    ],

    'comment' => [
        'update' => [
            'deleted' => "Нельга рэдагаваць выдалены допіс.",
        ],
    ],

    'contest' => [
        'voting_over' => 'Немагчыма змяніць голас пасля сканчэння перыяду галасавання.',
    ],

    'forum' => [
        'moderate' => [
            'no_permission' => 'Няма дазволу на модэрацыю гэтага форуму.',
        ],

        'post' => [
            'delete' => [
                'only_last_post' => 'Толькі апошні допіс можа быць выдалены.',
                'locked' => 'Нельга выдаліць допіс у закрытай тэме.',
                'no_forum_access' => 'Неабходны дазвол да запытанага форуму.',
                'not_owner' => 'Толькі аўтар можа выдаліць гэты допіс.',
            ],

            'edit' => [
                'deleted' => 'Нельга рэдагаваць выдалены допіс.',
                'locked' => 'Допіс абаронены ад рэдагавання.',
                'no_forum_access' => 'Неабходны дазвол да запытанага форуму.',
                'not_owner' => 'Толькі аўтар можа рэдагаваць гэты допіс.',
                'topic_locked' => 'Нельга рэдагаваць допіс у закрытай тэме.',
            ],

            'store' => [
                'play_more' => 'Першая чым ствараць допісы на форуме, паспрабуйце пагуляць у гульню! Калі вы маеце праблемы з гульнёй, то звярніцеся да форуму «Дапамога і падтрымка».',
                'too_many_help_posts' => "Перш чым размяшчаць дадатковыя допісы, пагуляйце ў гульню паболей. Калі вы ўсё яшчэ маеце праблемы з гульнёй, то звярніцеся на эл. пошту support@ppy.sh", // FIXME: unhardcode email address.
            ],
        ],

        'topic' => [
            'reply' => [
                'double_post' => 'Калі ласка, адрэдагуйце ваш апошні допіс замест паўторнага стварэння.',
                'locked' => 'Нельга адказваць у закрытай гутаркі.',
                'no_forum_access' => 'Неабходны дазвол да запытанага форуму.',
                'no_permission' => 'Няма дазволу для адказу.',

                'user' => [
                    'require_login' => 'Каб адказаць, увайдзіце.',
                    'restricted' => "Нельга адказваць падчас абмеркавання.",
                    'silenced' => "Нельга адказваць падчас зацішша.",
                ],
            ],

            'store' => [
                'no_forum_access' => 'Неабходны дазвол да запытанага форуму.',
                'no_permission' => 'Няма дазволу для стварэння новых тэм.',
                'forum_closed' => 'Нельга апублікоўваць, калі форум закрыты.',
            ],

            'vote' => [
                'no_forum_access' => 'Неабходны дазвол да запытанага форуму.',
                'over' => 'Апытанне завершана і больш нельга ў ёй галасаваць.',
                'play_more' => 'Вам трэба боль гульняў, каб галасаваць на форуме.',
                'voted' => 'Змяняць свой голас недазволена.',

                'user' => [
                    'require_login' => 'Увайдзіце, каб прагаласаваць.',
                    'restricted' => "Нельга галасаваць падчас абмежавання.",
                    'silenced' => "Нельга галасаваць падчас зацішша.",
                ],
            ],

            'watch' => [
                'no_forum_access' => 'Неабходны дазвол да запытанага форуму.',
            ],
        ],

        'topic_cover' => [
            'edit' => [
                'uneditable' => 'Няправільна вызначаная вокладка.',
                'not_owner' => 'Толькі ўладальнік можа змяняць вокладку.',
            ],
            'store' => [
                'forum_not_allowed' => 'Гэты форум не дазваляе тэмавыя вокладкі.',
            ],
        ],

        'view' => [
            'admin_only' => 'Толькі кіраўнік можа праглядаць гэты форум.',
        ],
    ],

    'user' => [
        'page' => [
            'edit' => [
                'locked' => 'Старонка карыстальніка заблакавана.',
                'not_owner' => 'Магчыма рэдагаваць толькі ўласную старонку.',
                'require_supporter_tag' => 'неабходны osu!supporter.',
            ],
        ],
    ],
];
