<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'edit' => [
        'title_compact' => 'paramètres',
        'username' => 'nom d\'utilisateur',

        'avatar' => [
            'title' => 'Avatar',
            'rules' => 'Veuillez vous assurer que votre avatar correspond aux :link.<br/>Cela signifie qu\'il doit être <strong>adapté à tous les âges</strong>. c\'est-à-dire pas de nudité, de profanation ou de contenu suggestif.',
            'rules_link' => 'règles de la communauté',
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
                'user_discord' => '',
                'user_from' => 'localisation actuelle',
                'user_interests' => 'centres d\'intérêt',
                'user_occ' => 'occupation',
                'user_twitter' => '',
                'user_website' => 'site web',
            ],
        ],

        'signature' => [
            'title' => 'Signature',
            'update' => 'mettre à jour',
        ],
    ],

    'notifications' => [
        'beatmapset_discussion_qualified_problem' => 'recevoir des notifications lorsqu\'un nouveau problème est posté sur les beatmaps qualifiées dans les modes suivants',
        'beatmapset_disqualify' => 'recevoir des notifications lorsque des beatmaps sont disqualifiées dans les modes suivants',
        'comment_reply' => 'recevoir des notifications pour des réponses à vos commentaires',
        'title' => 'Notifications',
        'topic_auto_subscribe' => 'activer automatiquement les notifications sur les nouveaux sujets que vous créez sur le forum',

        'options' => [
            '_' => 'types d\'alertes',
            'beatmap_owner_change' => 'guest difficulty',
            'beatmapset:modding' => 'modding de beatmap',
            'channel_message' => 'messages privés',
            'comment_new' => 'nouveaux commentaires',
            'forum_topic_reply' => 'réponse à un sujet',
            'mail' => 'email',
            'mapping' => 'mappeur',
            'push' => 'push',
            'user_achievement_unlock' => 'médaille utilisateur déverrouillée',
        ],
    ],

    'oauth' => [
        'authorized_clients' => 'clients autorisés',
        'own_clients' => 'vos clients',
        'title' => 'OAuth',
    ],

    'options' => [
        'beatmapset_show_nsfw' => 'masquer les avertissements pour contenu explicite dans les beatmaps',
        'beatmapset_title_show_original' => 'afficher les métadonnées de la beatmap dans la langue d\'origine',
        'title' => 'Options',

        'beatmapset_download' => [
            '_' => 'téléchargement des beatmaps par défaut',
            'all' => 'avec vidéo si disponible',
            'direct' => 'ouvrir dans osu!direct',
            'no_video' => 'sans vidéo',
        ],
    ],

    'playstyles' => [
        'keyboard' => 'clavier',
        'mouse' => 'souris',
        'tablet' => 'tablette',
        'title' => 'Styles de jeu',
        'touch' => 'écran tactile',
    ],

    'privacy' => [
        'friends_only' => 'bloquer les messages privés des personnes qui ne sont pas dans votre liste d’amis',
        'hide_online' => 'masquer votre présence en ligne',
        'title' => 'Confidentialité',
    ],

    'security' => [
        'current_session' => 'actuel',
        'end_session' => 'Mettre fin à la session',
        'end_session_confirmation' => 'Ceci va immédiatement mettre fin à votre session sur cet appareil. Êtes-vous sûr ?',
        'last_active' => 'Dernière activité :',
        'title' => 'Sécurité',
        'web_sessions' => 'sessions web',
    ],

    'update_email' => [
        'update' => 'mettre à jour',
    ],

    'update_password' => [
        'update' => 'mettre à jour',
    ],

    'verification_completed' => [
        'text' => 'Vous pouvez désormais fermer cet onglet/cette fenêtre',
        'title' => 'La vérification est terminée',
    ],

    'verification_invalid' => [
        'title' => 'Lien de vérification invalide ou expiré',
    ],
];
