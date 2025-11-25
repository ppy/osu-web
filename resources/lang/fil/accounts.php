<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'edit' => [
        'title_compact' => 'mga setting',
        'username' => 'username',

        'avatar' => [
            'title' => 'Avatar',
            'reset' => 'tanggalin',
            'rules' => 'Pakitiyak na ang iyong avatar ay sumusunod sa :link.<br/>Nangangahulugan ito na dapat ay <strong>angkop para sa lahat ng edad</strong>. i.e. walang kahubaran, kabastusan, o nagpapahiwatig na nilalaman.',
            'rules_link' => 'ang patakaran ng komunidad
	
',
        ],

        'email' => [
            'new' => 'bagong email',
            'new_confirmation' => 'ikumpirma ang email',
            'title' => 'Email',
            'locked' => [
                '_' => 'Pakipag-ugnay sa :accounts kung kailangan mong ma-update ang iyong email.',
                'accounts' => 'pangkat ng suporta sa account',
            ],
        ],

        'legacy_api' => [
            'api' => 'api',
            'irc' => 'irc',
            'title' => 'Legacy na API',
        ],

        'password' => [
            'current' => 'kasalukuyang password',
            'new' => 'bagong password',
            'new_confirmation' => 'ikumpirma ang password',
            'title' => 'Password',
        ],

        'profile' => [
            'country' => 'bansa',
            'title' => 'Profile',

            'country_change' => [
                '_' => "Mukhang hindi tumutugma ang bansa ng iyong account sa iyong bansang tinitirhan. :update_link.",
                'update_link' => 'I-update sa :country',
            ],

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

    'github_user' => [
        'info' => "Kung isa kang kontribyutor sa mga open-source na repository ng osu!, ang pag-link ng iyong GitHub account dito ay iuugnay ang iyong mga changelog entries sa iyong osu! profile. Mga GitHub account na walang history ng kontribusyon sa osu! ay hindi ma-link.",
        'link' => 'I-link ang GitHub Account',
        'title' => 'GitHub',
        'unlink' => 'I-unlink ang GitHub Account',

        'error' => [
            'already_linked' => 'Ang GitHub account na ito ay naka-link na sa ibang user.',
            'no_contribution' => 'Hindi ma-link ang GitHub account nang walang anumang kasaysayan ng kontribusyon sa mga repositoryo ng osu. ',
            'unverified_email' => 'Paki-verify ng iyong pangunahing email sa GitHub, pagkatapos ay subukang i-link muli ang iyong account.',
        ],
    ],

    'notifications' => [
        'beatmapset_discussion_qualified_problem' => 'tumanggap ng mga notipikasyon sa mga bagong problema sa mga kwalipikadong beatmap sa mga sumusunod na mode',
        'beatmapset_disqualify' => 'tumanggap ng mga notipikasyon kung kailan ang mga beatmap sa mga sumusunod na mode ay na diskwalipika',
        'comment_reply' => 'tumanggap ng mga notipikasyon para sa mga tugon sa iyong mga komento',
        'title' => 'Mga notipikasyon',
        'topic_auto_subscribe' => 'awtomatikong paganahin ang mga notipikasyon sa nilikha mong mga bagong paksa sa forum',

        'options' => [
            '_' => 'mga opsyon sa pagpapaalam',
            'beatmap_owner_change' => 'guest na difficulty',
            'beatmapset:modding' => 'pagmo-mod ng beatmap',
            'channel_message' => 'mga pribadong mensahe',
            'channel_team' => '',
            'comment_new' => 'mga bagong komento',
            'forum_topic_reply' => 'tugon sa paksa',
            'mail' => 'koreo',
            'mapping' => 'mapper ng beatmap',
            'push' => 'push',
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
        'title' => 'Mga istilo ng paglalaro',
        'touch' => 'touch',
    ],

    'privacy' => [
        'friends_only' => 'i-block ang mga pribadong mensahe mula sa mga taong hindi nasa iyong listahan ng mga kaibigan',
        'hide_online' => 'itago ang iyong presensya online',
        'hide_online_info' => '',
        'title' => 'Privacy',
    ],

    'security' => [
        'current_session' => 'kasalukuyan',
        'end_session' => 'Tapusin ang sesyon',
        'end_session_confirmation' => 'Agad nitong tatapusin ang iyong sesyon sa device na iyon. Sigurado ka ba?',
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

    'user_totp' => [
        'title' => '',
        'usage_note' => '',

        'button' => [
            'remove' => '',
            'setup' => '',
        ],
        'status' => [
            'label' => '',
            'not_set' => '',
            'set' => '',
        ],
    ],

    'verification_completed' => [
        'text' => 'Maaari mong isara ang tab/window na ito ngayon',
        'title' => 'Nakumpleto ang beripikasyon',
    ],

    'verification_invalid' => [
        'title' => 'Hindi wasto o na-expire na link ng pagpapatunay',
    ],
];
