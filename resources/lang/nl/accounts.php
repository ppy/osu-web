<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
            'current' => 'huidig wachtwoord',
            'new' => 'nieuw wachtwoord',
            'new_confirmation' => 'wachtwoord bevestiging',
            'title' => 'Wachtwoord',
        ],

        'profile' => [
            'title' => 'Profiel',

            'user' => [
                'user_discord' => '',
                'user_from' => 'huidige locatie',
                'user_interests' => 'interesses',
                'user_occ' => 'bezigheid',
                'user_twitter' => '',
                'user_website' => 'website',
            ],
        ],

        'signature' => [
            'title' => 'Ondertekening',
            'update' => 'bijwerken',
        ],
    ],

    'notifications' => [
        'beatmapset_discussion_qualified_problem' => 'ontvang meldingen voor nieuw probleem op gekwalificeerde beatmaps van de volgende modes',
        'beatmapset_disqualify' => 'ontvang meldingen voor wanneer beatmaps van de volgende modes zijn gediskwalificeerd',
        'comment_reply' => 'ontvang meldingen voor reacties op uw reacties',
        'title' => 'Meldingen',
        'topic_auto_subscribe' => 'automatisch meldingen inschakelen op nieuwe forum onderwerpen die u maakt',

        'options' => [
            '_' => 'verzend methodes',
            'beatmap_owner_change' => '',
            'beatmapset:modding' => 'beatmap modding',
            'channel_message' => 'privéberichten',
            'comment_new' => 'nieuwe reacties',
            'forum_topic_reply' => 'topic antwoord',
            'mail' => 'e-mail',
            'mapping' => 'beatmap mapper',
            'push' => 'push',
            'user_achievement_unlock' => 'medaille verdiend',
        ],
    ],

    'oauth' => [
        'authorized_clients' => 'autoriseer clients',
        'own_clients' => 'eigen clients',
        'title' => 'OAuth',
    ],

    'options' => [
        'beatmapset_show_nsfw' => 'verberg waarschuwingen voor expliciete inhoud in beatmaps',
        'beatmapset_title_show_original' => 'beatmap metadata in originele taal weergeven',
        'title' => 'Opties',

        'beatmapset_download' => [
            '_' => 'standaard beatmap download type',
            'all' => 'met video als beschikbaar',
            'direct' => 'open in osu!direct',
            'no_video' => 'zonder video',
        ],
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
