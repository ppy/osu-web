<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'authorizations' => [
        'update' => [
            'null_user' => 'Өзгерту үшін аккаунтқа кіру керек.',
            'system_generated' => 'Жүйе жасаған жазбаны өзгерту мүмкін емес.',
            'wrong_user' => 'Өзгерту үшін жазбаның иесі болуы керек.',
        ],
    ],

    'events' => [
        'empty' => 'Ештеңе болған жоқ... әлі.',
    ],

    'index' => [
        'deleted_beatmap' => 'жойылған',
        'none_found' => 'Бұл іздеу критерийлеріне сәйкес келетін пікірталастар табылмады.',
        'title' => 'Карта пікірталастары',

        'form' => [
            '_' => 'Іздеу',
            'deleted' => 'Жойылған пікірталастарды қосу',
            'mode' => 'Карта режимі',
            'only_unresolved' => 'Тек шешілмеген пікірталастарды көрсету',
            'show_review_embeds' => '',
            'types' => 'Хабарламаның түрлері',
            'username' => 'Пайдаланушы аты',

            'beatmapset_status' => [
                '_' => 'Картаның Күйі',
                'all' => 'Бәрі',
                'disqualified' => 'Дисквалификацияланған',
                'never_qualified' => 'Ешқашан Квалификацияланбаған',
                'qualified' => 'Квалификацияланған',
                'ranked' => 'Рейтингілік',
            ],

            'user' => [
                'label' => 'Пайдаланушы',
                'overview' => 'Әрекеттерге шолу',
            ],
        ],
    ],

    'item' => [
        'created_at' => 'Жазба күні',
        'deleted_at' => 'Жою күні',
        'message_type' => 'Түрі',
        'permalink' => 'Тұрақты Сілтеме',
    ],

    'nearby_posts' => [
        'confirm' => 'Жазбалардың ешқайсысы менің сұрағыма қатысты емес',
        'notice' => ':timestamp (:existing_timestamps) ішінде жазбалар бар. Жазу алдында оларды тексеріңіз.',
        'unsaved' => ':count қарауда ',
    ],

    'owner_editor' => [
        'button' => 'Деңгей иесі',
        'reset_confirm' => 'Осы қиындық үшін иесін қалпына келтіру керек пе?',
        'user' => 'Иесі',
        'version' => 'Деңгейі',
    ],

    'refresh' => [
        'checking' => '',
        'has_updates' => '',
        'no_updates' => 'Жаңарту жоқ.',
        'updating' => 'Жаңарту...',
    ],

    'reply' => [
        'open' => [
            'guest' => 'Жауап беру үшін аккаунтқа кіріңіз',
            'user' => 'Жауап беру',
        ],
    ],

    'review' => [
        'block_count' => ':used / :max блоктар қолданылған',
        'go_to_parent' => 'Қараудың жазбаны көру',
        'go_to_child' => 'Пікірталасты көру',
        'validation' => [
            'block_too_large' => 'әр блокта тек :limit таңбаларына дейін болуы мүмкін',
            'external_references' => 'қарауда осы қарауға жатпайтын мәселелерге сілтемелер бар',
            'invalid_block_type' => 'жарамсыз блоктың түрі',
            'invalid_document' => 'жарамсыз қарау',
            'invalid_discussion_type' => 'жарамсыз пікірталас түрі',
            'minimum_issues' => 'қарауда ең аз :count мәселе болуы керек',
            'missing_text' => 'блокта мәтін жоқ',
            'too_many_blocks' => 'қарауда тек :count параграф/мәселе болуы мүмкін',
        ],
    ],

    'system' => [
        'resolved' => [
            'true' => ':user шешкен деп белгіленген',
            'false' => ':user-ден қайта ашылды',
        ],
    ],

    'timestamp_display' => [
        'general' => 'негізгі',
        'general_all' => 'негізгі (барлығы)',
    ],

    'user_filter' => [
        'everyone' => 'Әркім',
        'label' => 'Пайдаланушы бойынша іріктеу',
    ],
];
