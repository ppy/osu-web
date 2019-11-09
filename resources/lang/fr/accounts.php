<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

return [
    'edit' => [
        'title' => 'Paramètres de <strong>Compte</strong>',
        'title_compact' => 'paramètres',
        'username' => 'nom d\'utilisateur',

        'avatar' => [
            'title' => 'Avatar',
            'rules' => 'Veuillez vous assurer que votre avatar adhère à :link.<br/>Cela signifie qu\'il doit être <strong>adapté à tous les âges</strong>. c\'est-à-dire pas de nudité, de profanation ou de contenu suggestif.',
            'rules_link' => 'les règles de la communauté',
        ],

        'email' => [
            'current' => 'email actuel',
            'new' => 'nouvel email',
            'new_confirmation' => 'confirmation de l\'email',
            'title' => 'Email',
        ],

        'password' => [
            'current' => 'mot de passe actuel',
            'new' => 'nouveau mot de passe',
            'new_confirmation' => 'confirmation du mot de passe',
            'title' => 'Mot de passe',
        ],

        'profile' => [
            'title' => 'Profil',

            'user' => [
                'user_discord' => 'discord',
                'user_from' => 'localisation actuelle',
                'user_interests' => 'centres d\'intérêt',
                'user_msnm' => 'skype',
                'user_occ' => 'occupation',
                'user_twitter' => 'twitter',
                'user_website' => 'site web',
            ],
        ],

        'signature' => [
            'title' => 'Signature',
            'update' => 'mettre à jour',
        ],
    ],

    'notifications' => [
        'title' => 'Notifications',
        'topic_auto_subscribe' => 'activer automatiquement les notifications sur les nouveaux sujets de forum que vous créez',
        'beatmapset_discussion_qualified_problem' => '',
    ],

    'oauth' => [
        'authorized_clients' => 'clients autorisés',
        'own_clients' => 'clients',
        'title' => 'OAuth',
    ],

    'playstyles' => [
        'keyboard' => 'clavier',
        'mouse' => 'souris',
        'tablet' => 'tablette',
        'title' => 'Styles de jeu',
        'touch' => 'écran tactile',
    ],

    'privacy' => [
        'friends_only' => 'Bloque les messages privés des personnes qui ne sont pas dans votre liste d’amis',
        'hide_online' => 'masquer votre présence en ligne',
        'title' => 'Confidentialité',
    ],

    'security' => [
        'current_session' => 'actuel',
        'end_session' => 'Mettre fin à la session',
        'end_session_confirmation' => 'Ceci va immédiatement mettre fin à votre session sur cet appareil. Êtes-vous sûr ?',
        'last_active' => 'Dernière activité:',
        'title' => 'Sécurité',
        'web_sessions' => 'sessions web',
    ],

    'update_email' => [
        'email_subject' => 'Confirmation du changement d\'email d\'osu!',
        'update' => 'mettre à jour',
    ],

    'update_password' => [
        'email_subject' => 'Confirmation du changement de mot de passe d\'osu!',
        'update' => 'mettre à jour',
    ],

    'verification_completed' => [
        'text' => 'Vous pouvez maintenant fermer cet onglet/cette fenêtre',
        'title' => 'La vérification est terminée',
    ],

    'verification_invalid' => [
        'title' => 'Lien de vérification invalide ou expiré',
    ],
];
