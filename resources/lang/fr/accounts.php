<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'edit' => [
        'title_compact' => 'paramètres',
        'username' => 'nom d\'utilisateur',

        'avatar' => [
            'title' => 'Avatar',
            'reset' => 'réinitialiser',
            'rules' => 'Veuillez vous assurer que votre avatar correspond aux :link.<br/>Cela signifie qu\'il doit être <strong>adapté à tous les âges</strong>. C\'est-à-dire pas de nudité, de profanation ou de contenu suggestif.',
            'rules_link' => 'Considérations relatives au contenu visuel',
        ],

        'email' => [
            'new' => 'nouvel e-mail',
            'new_confirmation' => 'confirmation de l\'e-mail',
            'title' => 'E-mail',
            'locked' => [
                '_' => 'Veuillez contacter l\':accounts: si vous avez besoin de mettre à jour votre adresse e-mail.',
                'accounts' => 'équipe d\'assistance aux comptes',
            ],
        ],

        'legacy_api' => [
            'api' => 'api',
            'irc' => 'irc',
            'title' => 'Ancienne API',
        ],

        'password' => [
            'current' => 'mot de passe actuel',
            'new' => 'nouveau mot de passe',
            'new_confirmation' => 'confirmation du mot de passe',
            'title' => 'Mot de passe',
        ],

        'profile' => [
            'country' => 'pays',
            'title' => 'Profil',

            'country_change' => [
                '_' => "Il semble que le pays de votre compte ne correspond pas à votre pays de résidence. :update_link.",
                'update_link' => 'Obtenir le drapeau du pays suivant : :country',
            ],

            'user' => [
                'user_discord' => '',
                'user_from' => 'localisation actuelle',
                'user_interests' => 'centres d\'intérêt',
                'user_occ' => 'profession',
                'user_twitter' => '',
                'user_website' => 'site web',
            ],
        ],

        'signature' => [
            'title' => 'Signature',
            'update' => 'mettre à jour',
        ],
    ],

    'github_user' => [
        'info' => "Si vous êtes un contributeur des dépôts open-source d'osu!, associer votre compte GitHub permettra à vos contributions affichées sur les changelogs de mener directement vers votre profil osu!. Les comptes GitHub sans historique de contribution à osu! ne peuvent pas être associés.",
        'link' => 'Associer un compte GitHub',
        'title' => 'GitHub',
        'unlink' => 'Dissocier le compte GitHub',

        'error' => [
            'already_linked' => 'Ce compte GitHub est déjà associé à un autre utilisateur.',
            'no_contribution' => 'Impossible d\'associer un compte GitHub sans historique de contribution dans les dépôts d\'osu!.',
            'unverified_email' => 'Veuillez vérifier votre adresse e-mail principale sur GitHub, puis essayez d\'associer votre compte à nouveau.',
        ],
    ],

    'notifications' => [
        'beatmapset_discussion_qualified_problem' => 'recevoir des notifications lorsqu\'un nouveau problème est posté sur les beatmaps qualifiées dans les modes suivants',
        'beatmapset_disqualify' => 'recevoir des notifications lorsque des beatmaps sont disqualifiées dans les modes suivants',
        'comment_reply' => 'recevoir des notifications pour des réponses à vos commentaires',
        'news_post' => 'recevoir des notifications pour les articles d\'actualité',
        'title' => 'Notifications',
        'topic_auto_subscribe' => 'activer automatiquement les notifications sur les nouveaux sujets que vous créez ou auxquels vous avez répondu sur le forum',

        'options' => [
            '_' => 'types d\'alertes',
            'beatmap_owner_change' => 'guest difficulty',
            'beatmapset:modding' => 'modding de beatmap',
            'channel_message' => 'messages privés',
            'channel_team' => 'messages d\'équipe',
            'comment_new' => 'nouveaux commentaires',
            'forum_topic_reply' => 'réponse à un sujet',
            'mail' => 'mail',
            'mapping' => 'créateur de beatmap',
            'news_post' => 'articles d\'actualité',
            'push' => 'push',
        ],
    ],

    'oauth' => [
        'authorized_clients' => 'clients autorisés',
        'own_clients' => 'vos clients',
        'title' => 'OAuth',
    ],

    'options' => [
        'beatmapset_show_anime_cover' => '',
        'beatmapset_show_nsfw' => 'masquer les avertissements de contenu explicite dans les beatmaps',
        'beatmapset_title_show_original' => 'afficher les métadonnées des beatmaps dans la langue d\'origine',
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
        'title' => 'Périphériques de jeu',
        'touch' => 'écran tactile',
    ],

    'privacy' => [
        'friends_only' => 'bloquer les messages privés des utilisateurs qui ne sont pas dans votre liste d’amis',
        'hide_online' => 'masquer votre présence en ligne',
        'hide_online_info' => 'vous fera apparaître hors-ligne sur osu!lazer si activé',
        'title' => 'Confidentialité',
    ],

    'security' => [
        'current_session' => 'actuelle',
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

    'user_totp' => [
        'title' => 'Application d\'authentification',
        'usage_note' => 'Utiliser une application d\'authentification au lieu de la vérification par courriel. La vérification par courriel est toujours disponible en tant qu\'option de recours.',

        'button' => [
            'remove' => 'Retirer',
            'setup' => 'Ajouter une application d\'authentification',
        ],
        'status' => [
            'label' => 'statut',
            'not_set' => 'Non configuré',
            'set' => 'Configuré',
        ],
    ],

    'verification_completed' => [
        'text' => 'Vous pouvez désormais fermer cet onglet/cette fenêtre',
        'title' => 'La vérification est terminée',
    ],

    'verification_invalid' => [
        'title' => 'Lien de vérification invalide ou expiré',
    ],
];
