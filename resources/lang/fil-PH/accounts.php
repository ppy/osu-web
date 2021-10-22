<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'edit' => [
        'title_compact' => 'mga setting',
        'username' => 'username',

        'avatar' => [
            'title' => 'Avatar',
            'rules' => 'Mangyaring tiyakin na ang iyong avatar ay sumusunod sa: :link.<br/>Nangangahulugan ito na dapat <strong>angkop ito sa lahat ng edad</strong>. i.e. walang kahubaran, kabastusan o nilalaman na nagpapahiwatig ng kalaswaan.',
            'rules_link' => 'ang patakaran ng komunidad
	
',
        ],

        'email' => [
            'current' => 'kasalukuyang e-mail',
            'new' => 'bagong email',
            'new_confirmation' => 'ikumpirma ang email',
            'title' => 'Email',
        ],

        'password' => [
            'current' => 'kasalukuyang password',
            'new' => 'bagong password',
            'new_confirmation' => 'ikumpirma ang password',
            'title' => 'Password',
        ],

        'profile' => [
            'title' => 'Profile',

            'user' => [
                'user_discord' => '',
                'user_from' => 'kasalukuyang lokasyon',
                'user_interests' => 'mga hilig',
                'user_occ' => 'okupasyon',
                'user_twitter' => '',
                'user_website' => 'website',
            ],
        ],

        'signature' => [
            'title' => 'Signatura',
            'update' => 'i-update',
        ],
    ],

    'notifications' => [
        'beatmapset_discussion_qualified_problem' => 'tumanggap ng mga abiso sa mga bagong problema sa mga kwalipikadong beatmaps sa mga sumusunod na mode',
        'beatmapset_disqualify' => 'tumanggap ng mga abiso kung kailan ang mga beatmap sa mga sumusnod na mode ay nadiskwalipika',
        'comment_reply' => 'tumanggap nga mga abiso na tumutugon sa iyong mga komento',
        'title' => 'Mga abiso',
        'topic_auto_subscribe' => 'awtomatikong paganahin ang mga notipikasyon sa nilikha mong mga bagong paksa sa forum',

        'options' => [
            '_' => 'mga opsyon sa pagpapaalam',
            'beatmap_owner_change' => 'difficulty na gawa ng ibang manlalaro',
            'beatmapset:modding' => 'pagmo-mod ng beatmap',
            'channel_message' => 'mga pribadong mensahe',
            'comment_new' => 'mga bagong komento',
            'forum_topic_reply' => 'tugon sa paksa',
            'mail' => 'koreo',
            'mapping' => 'mapper ng beatmap',
            'push' => 'push',
            'user_achievement_unlock' => 'na-unlock na medalya ng user',
        ],
    ],

    'oauth' => [
        'authorized_clients' => 'awtorisadong kliyente',
        'own_clients' => 'sariling mga kliyente',
        'title' => 'OAuth',
    ],

    'options' => [
        'beatmapset_show_nsfw' => 'itago ang mga babala para sa mga sensitibong nilalaman sa mga beatmaps',
        'beatmapset_title_show_original' => 'ipakita ang beatmap metadata sa orihinal na wika',
        'title' => 'Mga pagpipilian',

        'beatmapset_download' => [
            '_' => 'palagiang uri ng pagda-download ng beatmap',
            'all' => 'may video kung mayroon',
            'direct' => 'buksan sa osu!direct',
            'no_video' => 'walang video',
        ],
    ],

    'playstyles' => [
        'keyboard' => 'keyboard',
        'mouse' => 'mouse',
        'tablet' => 'tablet',
        'title' => 'Istilo ng paglalaro',
        'touch' => 'touch',
    ],

    'privacy' => [
        'friends_only' => 'i-block ang mga pribadong mensahe mula sa mga taong hindi nasa iyong listahan ng mga kaibigan',
        'hide_online' => 'itago ang iyong presensya online',
        'title' => 'Privacy',
    ],

    'security' => [
        'current_session' => 'kasalukuyan',
        'end_session' => 'Tapusin ang sesyon',
        'end_session_confirmation' => 'Agad na tatapusin nito ang iyong sesyon sa naturang aparato. Sigurado ka ba?',
        'last_active' => 'Huling aktibo:',
        'title' => 'Seguridad',
        'web_sessions' => 'mga sesyon sa web',
    ],

    'update_email' => [
        'update' => 'i-update',
    ],

    'update_password' => [
        'update' => 'i-update',
    ],

    'verification_completed' => [
        'text' => 'Maaari mo nang i-sara ang tab/window na ito',
        'title' => 'Nakumpleto ang beripikasyon',
    ],

    'verification_invalid' => [
        'title' => 'Hindi wasto o nag-expire na link sa pag-verify',
    ],
];
