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
    'edit' => [
        'title_compact' => 'mga setting',
        'username' => 'username',

        'avatar' => [
            'title' => 'Avatar',
            'rules' => 'Mangyaring tiyakin na ang iyong avatar ay sumunod sa: link. <br/> Nangangahulugan ito na dapat itong <strong> angkop sa lahat ng edad </strong>. i.e. walang kahubaran, kabastusan o nilalaman na nagmumungkahi.',
            'rules_link' => 'ang patakaran ng komunidad
	
',
        ],

        'email' => [
            'current' => 'kasalukuyang e-mail',
            'new' => 'bagong email',
            'new_confirmation' => 'kumpirmasyon ng email',
            'title' => 'Email',
        ],

        'password' => [
            'current' => 'kasalukuyang password',
            'new' => 'bagong password',
            'new_confirmation' => 'kumpirmasyon ng password',
            'title' => 'Password',
        ],

        'profile' => [
            'title' => 'Profile',

            'user' => [
                'user_discord' => '',
                'user_from' => 'kasalukuyang lokasyon',
                'user_interests' => 'mga gusto',
                'user_msnm' => '',
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
        'title' => 'Mga abiso',
        'topic_auto_subscribe' => 'awtomatikong paganahin ang mga paunawa sa mga bagong paksa ng forum na nilikha mo',
        'beatmapset_discussion_qualified_problem' => '',

        'mail' => [
            '_' => '',
            'beatmapset:modding' => '',
            'forum_topic_reply' => '',
        ],
    ],

    'oauth' => [
        'authorized_clients' => 'awtorisadong kliyente',
        'own_clients' => 'sariling mga kliyente',
        'title' => 'O-Awtorisasyon',
    ],

    'playstyles' => [
        'keyboard' => 'keyboard',
        'mouse' => 'mouse',
        'tablet' => 'tablet',
        'title' => 'Klase ng paglalaro',
        'touch' => 'touch',
    ],

    'privacy' => [
        'friends_only' => 'i-block ang mga pribadong mensahe mula sa mga taong hindi nasa iyong listahan ng mga kaibigan',
        'hide_online' => 'itago ang iyong presensya online',
        'title' => 'Palihim',
    ],

    'security' => [
        'current_session' => 'kasalukuyan',
        'end_session' => 'Tapusin ang sesyon',
        'end_session_confirmation' => 'Ito\'y agad na tatapusin ang inyong sesyon sa inyong aparato. Sigurado ka ba?',
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
        'text' => 'Pwede mo ngayong i-sara ang tab/window na ito',
        'title' => 'Nakumpleto ang beripikasyon',
    ],

    'verification_invalid' => [
        'title' => 'Hindi wastong o nag-expire na link sa pag-verify',
    ],
];
