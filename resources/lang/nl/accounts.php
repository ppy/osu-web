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
        'title_compact' => 'instellingen',
        'username' => 'gebruikersnaam',

        'avatar' => [
            'title' => 'Avatar',
            'rules' => 'Zorg ervoor dat uw avatar voldoet aan :link. <br/> Dit betekent dat deze <strong> geschikt moet zijn voor alle leeftijden </strong>. d.w.z. geen naaktheid, godslastering of suggestieve inhoud.',
            'rules_link' => 'de community regels',
        ],

        'email' => [
            'current' => 'huidige e-mail',
            'new' => 'nieuwe e-mail',
            'new_confirmation' => 'e-mail bevestiging',
            'title' => 'E-mail',
        ],

        'password' => [
            'current' => 'huidige wachtwoord',
            'new' => 'nieuwe wachtwoord',
            'new_confirmation' => 'wachtwoord bevestiging',
            'title' => 'Wachtwoord',
        ],

        'profile' => [
            'title' => 'Profiel',

            'user' => [
                'user_discord' => 'discord',
                'user_from' => 'huidige locatie',
                'user_interests' => 'interesses',
                'user_msnm' => 'skype',
                'user_occ' => 'bezigheid',
                'user_twitter' => 'twitter',
                'user_website' => 'website',
            ],
        ],

        'signature' => [
            'title' => 'Ondertekening',
            'update' => 'bijwerken',
        ],
    ],

    'notifications' => [
        'title' => 'Meldingen',
        'topic_auto_subscribe' => 'automatisch meldingen inschakelen op nieuwe forum onderwerpen die u maakt',
        'beatmapset_discussion_qualified_problem' => 'ontvang meldingen voor nieuw probleem op gekwalificeerde beatmaps van de volgende modes',

        'mail' => [
            '_' => 'e-mailnotificaties ontvangen voor',
            'beatmapset:modding' => 'beatmap modding',
            'forum_topic_reply' => 'topic antwoord',
        ],
    ],

    'oauth' => [
        'authorized_clients' => 'autoriseer clients',
        'own_clients' => 'eigen clients',
        'title' => 'OAuth',
    ],

    'playstyles' => [
        'keyboard' => 'toetsenbord',
        'mouse' => 'muis',
        'tablet' => 'tablet',
        'title' => 'Speelstijlen',
        'touch' => 'touch',
    ],

    'privacy' => [
        'friends_only' => 'blokkeer privéberichten van mensen niet in jouw vriendenlijst',
        'hide_online' => 'verberg je online aanwezigheid',
        'title' => 'Privacy',
    ],

    'security' => [
        'current_session' => 'huidige',
        'end_session' => 'Stop de sessie',
        'end_session_confirmation' => 'Dit zal onmiddellijk je sessie op dat apparaat beëindigen. Weet je het zeker?',
        'last_active' => 'Laatst actief:',
        'title' => 'Beveiliging',
        'web_sessions' => 'web sessies',
    ],

    'update_email' => [
        'update' => 'bijwerken',
    ],

    'update_password' => [
        'update' => 'bijwerken',
    ],

    'verification_completed' => [
        'text' => 'U kunt dit tabblad/venster nu sluiten',
        'title' => 'Verificatie is voltooid',
    ],

    'verification_invalid' => [
        'title' => 'Ongeldige of verlopen verificatielink',
    ],
];
