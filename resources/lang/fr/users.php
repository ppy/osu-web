<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

return [
    'deleted' => '[utilisateur supprimé]',

    'beatmapset_activities' => [
        'title' => "Historique des modifications de :user",
        'title_compact' => 'Modding',

        'discussions' => [
            'title_recent' => 'Discussions commencées récemment',
        ],

        'events' => [
            'title_recent' => 'Évènements récents',
        ],

        'posts' => [
            'title_recent' => 'Posts récents',
        ],

        'votes_received' => [
            'title_most' => 'Les mieux notés (les 3 derniers mois)',
        ],

        'votes_made' => [
            'title_most' => 'Les mieux notés (les 3 derniers mois)',
        ],
    ],

    'blocks' => [
        'banner_text' => 'Vous avez bloqué cet utilisateur.',
        'blocked_count' => 'utilisateurs bloqués (:count)',
        'hide_profile' => 'masquer le profil',
        'not_blocked' => 'Cet utilisateur n’est pas bloqué.',
        'show_profile' => 'afficher le profil',
        'too_many' => 'Limite de blocages atteinte.',
        'button' => [
            'block' => 'bloquer',
            'unblock' => 'débloquer',
        ],
    ],

    'card' => [
        'loading' => 'Chargement...',
        'send_message' => 'envoyer un message',
    ],

    'login' => [
        '_' => 'Se connecter',
        'locked_ip' => 'votre adresse IP est bloquée. Merci d\'attendre quelques minutes.',
        'username' => 'Nom d\'utilisateur',
        'password' => 'Mot de passe',
        'button' => 'Se connecter',
        'button_posting' => 'Connexion...',
        'remember' => 'Se souvenir de moi sur cet ordinateur',
        'title' => 'Merci de vous connecter pour continuer',
        'failed' => 'Identifiants incorrects',
        'register' => "Vous n'avez pas de compte osu! ? Inscrivez-vous maintenant ici",
        'forgot' => 'Mot de passe oublié ?',
        'beta' => [
            'main' => 'Accès bêta restreint aux utilisateurs privilégiés.',
            'small' => '(les supporteurs osu! l\'obtiendront bientôt)',
        ],

        'here' => 'ici', // this is substituted in when generating a link above. change it to suit the language.
    ],

    'posts' => [
        'title' => 'Posts de :username',
    ],

    'anonymous' => [
        'login_link' => 'Cliquez pour vous connecter',
        'login_text' => 'Se connecter',
        'username' => 'Invité',
        'error' => 'Vous devez être connecté pour faire ça.',
    ],
    'logout_confirm' => 'Êtes-vous sûr de vouloir vous déconnecter ? :(',
    'report' => [
        'button_text' => 'signaler',
        'comments' => 'Commentaires supplémentaires',
        'placeholder' => 'Veuillez fournir toute information que vous pensez pouvoir être utile.',
        'reason' => 'Raison',
        'thanks' => 'Merci pour votre signalement !',
        'title' => 'Signaler :username ?',

        'actions' => [
            'send' => 'Envoyer le rapport',
            'cancel' => 'Annuler',
        ],

        'options' => [
            'cheating' => 'Anti-jeu / Tricherie',
            'insults' => 'M’insulte / insulte les autres',
            'spam' => 'Spam',
            'unwanted_content' => 'Envoi de contenu inapproprié',
            'nonsense' => 'Non-sens',
            'other' => 'Autre (écrivez ci-dessous)',
        ],
    ],
    'restricted_banner' => [
        'title' => 'Votre compte a été restreint !',
        'message' => 'Quand vous êtes restreint, vous ne pouvez pas interagir avec les autres joueurs et vos scores ne seront visibles que par vous. Cette restriction est souvent le résultat d\'un processus automatique et sera en général levée dans les 24 heures. Si vous souhaitez faire appel de votre restriction, merci de <a href="mailto:accounts@ppy.sh">contacter le support</a>.',
    ],
    'show' => [
        'age' => ':age ans',
        'change_avatar' => 'changer votre avatar !',
        'first_members' => 'Ici depuis le début',
        'is_developer' => 'osu!developer',
        'is_supporter' => 'osu!supporter',
        'joined_at' => 'Ici depuis :date',
        'lastvisit' => 'Vu pour la dernière fois :date',
        'lastvisit_online' => 'Actuellement en ligne',
        'missingtext' => 'Vous avez peut-être fait une faute de frappe ! (ou l\'utilisateur est banni)',
        'origin_country' => 'De :country',
        'page_description' => 'osu! - Tout ce que vous devez savoir à propos de :username!',
        'previous_usernames' => 'Anciennement connu en tant que',
        'plays_with' => 'Joue avec :devices',
        'title' => "Profil de :username",

        'edit' => [
            'cover' => [
                'button' => 'Changer la bannière du profil',
                'defaults_info' => 'Plus d\'options seront disponibles bientôt',
                'upload' => [
                    'broken_file' => 'Impossible de traiter l\'image. Vérifiez l\'image mise en ligne et réessayez.',
                    'button' => 'Mettre en ligne l\'image',
                    'dropzone' => 'Déplacez ici pour uploader',
                    'dropzone_info' => 'Vous pouvez aussi glisser-déposer l\'image ici pour la mettre en ligne',
                    'size_info' => 'La taille de la bannière devrait être de 2800x620',
                    'too_large' => 'Le fichier est trop volumineux.',
                    'unsupported_format' => 'Format non supporté.',

                    'restriction_info' => [
                        '_' => 'Mise en ligne disponible pour les :link uniquement',
                        'link' => 'osu!supporters',
                    ],
                ],
            ],

            'default_playmode' => [
                'is_default_tooltip' => 'mode de jeu par défaut',
                'set' => 'définir :mode comme mode de jeu par défaut',
            ],
        ],

        'extra' => [
            'none' => 'aucun',
            'unranked' => 'Aucune partie récente',

            'achievements' => [
                'achieved-on' => 'Acquis le :date',
                'locked' => 'Verrouillé',
                'title' => 'Succès',
            ],
            'beatmaps' => [
                'by_artist' => 'par :artist',
                'none' => 'Aucune... pour le moment.',
                'title' => 'Beatmaps',

                'favourite' => [
                    'title' => 'Beatmaps favorites',
                ],
                'graveyard' => [
                    'title' => 'Beatmaps dans le cimetière',
                ],
                'loved' => [
                    'title' => 'Beatmaps loved',
                ],
                'ranked_and_approved' => [
                    'title' => 'Beatmaps classées et approuvées',
                ],
                'unranked' => [
                    'title' => 'Beatmaps en attente',
                ],
            ],
            'discussions' => [
                'title' => 'Discussions',
                'title_longer' => 'Discussions récentes',
                'show_more' => 'voir plus de discussions',
            ],
            'events' => [
                'title' => 'Événements',
                'title_longer' => 'Événements récents',
                'show_more' => 'voir plus d\'événements',
            ],
            'historical' => [
                'empty' => 'Aucune performance enregistrée. :(',
                'title' => 'Historique',

                'monthly_playcounts' => [
                    'title' => 'Historique des parties',
                    'count_label' => 'Parties',
                ],
                'most_played' => [
                    'count' => 'Nombre de fois jouée',
                    'title' => 'Beatmaps les plus jouées',
                ],
                'recent_plays' => [
                    'accuracy' => 'Précision: :percentage',
                    'title' => 'Parties récentes (dernières 24h)',
                ],
                'replays_watched_counts' => [
                    'title' => 'Historique des replays regardées',
                    'count_label' => 'Replays Regardés',
                ],
            ],
            'kudosu' => [
                'available' => 'Kudosu disponible',
                'available_info' => "Les Kudosu peuvent être échangés pour des étoiles kudosu, qui aideront votre beatmap à avoir plus de visibilité. Voici le nombre de kudosu non échangés.",
                'recent_entries' => 'Historique de Kudosu récent',
                'title' => 'Kudosu!',
                'total' => 'Kudosu reçus au total',

                'entry' => [
                    'amount' => ':amount kudosu',
                    'empty' => "Cet utilisateur n'a jamais reçu de Kudosu !",

                    'beatmap_discussion' => [
                        'allow_kudosu' => [
                            'give' => 'Reçu :amount kudosu du post de modding :post',
                        ],

                        'deny_kudosu' => [
                            'reset' => 'Refus de :amount kudosu du post :post',
                        ],

                        'delete' => [
                            'reset' => 'Perte de :amount kudosu suite à la suppression du post :post',
                        ],

                        'restore' => [
                            'give' => 'Réception de :amount kudosu suite à la restoration du post :post',
                        ],

                        'vote' => [
                            'give' => 'Réception de :amount kudosu suite aux votes reçus dans le post :post',
                            'reset' => 'Perte de :amount kudosu suite aux votes perdus dans le post :post',
                        ],

                        'recalculate' => [
                            'give' => 'Réception de :amount suite au recalcul des votes du post :post',
                            'reset' => 'Perte de :amount suite au recalcul des votes du post :post',
                        ],
                    ],

                    'forum_post' => [
                        'give' => 'A reçu :amount de :giver pour un post sur :post',
                        'reset' => 'Kudosu réinitialisé par :giver pour le post :post',
                        'revoke' => 'Kudosu refusé par :giver pour le post sur :post',
                    ],
                ],

                'total_info' => [
                    '_' => 'Basé sur la quantité d\'une contribution que l\'utilisateur a apportée à la modération de la beatmap. Voir :link pour plus d\'informations.',
                    'link' => 'cette page',
                ],
            ],
            'me' => [
                'title' => 'moi !',
            ],
            'medals' => [
                'empty' => "Cet utilisateur n'en a encore jamais reçue. ;_;",
                'recent' => 'Dernier',
                'title' => 'Médailles',
            ],
            'posts' => [
                'title' => 'Messages',
                'title_longer' => 'Messages récents',
                'show_more' => 'voir plus de messages',
            ],
            'recent_activity' => [
                'title' => 'Activité récente',
            ],
            'top_ranks' => [
                'download_replay' => 'Télécharger le replay',
                'empty' => 'Pas de première place. :(',
                'not_ranked' => 'Seules les beatmaps classées accordent des pp.',
                'pp_weight' => 'pondéré :percentage',
                'title' => 'Classements',

                'best' => [
                    'title' => 'Meilleures performances',
                ],
                'first' => [
                    'title' => 'Premières places',
                ],
            ],
            'votes' => [
                'given' => 'Votes donnés (3 derniers mois)',
                'received' => 'Votes reçus (3 derniers mois)',
                'title' => 'Votes',
                'title_longer' => 'Votes récents',
                'vote_count' => ':count_delimited vote|:count_delimited votes',
            ],
            'account_standing' => [
                'title' => 'Statut du compte',
                'bad_standing' => "Le compte de <strong>:username</strong> n'est pas dans un bon statut :(",
                'remaining_silence' => '<strong>:username</strong> pourra de nouveau parler dans :duration.',

                'recent_infringements' => [
                    'title' => 'Sanctions récentes',
                    'date' => 'date',
                    'action' => 'sanction',
                    'length' => 'durée',
                    'length_permanent' => 'Permanent',
                    'description' => 'description',
                    'actor' => 'par :username',

                    'actions' => [
                        'restriction' => 'Restriction',
                        'silence' => 'Silence',
                        'note' => 'Avertissement',
                    ],
                ],
            ],
        ],

        'header_title' => [
            '_' => 'Joueur :info',
            'info' => 'Info',
        ],

        'info' => [
            'discord' => 'Discord',
            'interests' => 'Centres d\'intérêt',
            'lastfm' => 'Last.fm',
            'location' => 'Position actuelle',
            'occupation' => 'Occupation',
            'skype' => 'Skype',
            'twitter' => 'Twitter',
            'website' => 'Site Internet',
        ],
        'not_found' => [
            'reason_1' => 'Il a peut-être changé de nom d\'utilisateur.',
            'reason_2' => 'Ce compte est peut-être temporairement indisponible pour des raisons de sécurité ou d\'abus.',
            'reason_3' => 'Vous avez peut-être fait une faute de frappe !',
            'reason_header' => 'Il y a plusieurs raisons possibles pour cela:',
            'title' => 'Utilisateur non trouvé! ;_;',
        ],
        'page' => [
            'button' => 'Modifier le profil',
            'description' => '<strong>Moi !</strong> est une zone personnalisable du profil.',
            'edit_big' => 'Éditez-moi !',
            'placeholder' => 'Tapez le contenu de la page',

            'restriction_info' => [
                '_' => 'Vous devez être un :link pour déverrouiller cette fonctionnalité.',
                'link' => 'osu!supporter',
            ],
        ],
        'post_count' => [
            '_' => 'A contribué à :link',
            'count' => ':count post du forum|:count posts du forum',
        ],
        'rank' => [
            'country' => 'Classement national en :mode',
            'country_simple' => 'Classement Pays',
            'global' => 'Classement global en :mode',
            'global_simple' => 'Classement Global',
        ],
        'stats' => [
            'hit_accuracy' => 'Précision',
            'level' => 'Niveau :level',
            'level_progress' => 'Progression jusqu’au prochain niveau',
            'maximum_combo' => 'Combo maximum',
            'medals' => 'Médailles',
            'play_count' => 'Nombres de parties',
            'play_time' => 'Temps de jeu total',
            'ranked_score' => 'Score classé',
            'replays_watched_by_others' => 'Replays regardés par les autres',
            'score_ranks' => 'Classements de Scores',
            'total_hits' => 'Nombre de clics',
            'total_score' => 'Score total',
            // modding stats
            'ranked_and_approved_beatmapset_count' => 'Beatmaps classées et approuvées',
            'loved_beatmapset_count' => 'Beatmaps adorées',
            'unranked_beatmapset_count' => 'Beatmaps en attente',
            'graveyard_beatmapset_count' => 'Beatmaps dans le cimetière',
        ],
    ],

    'status' => [
        'all' => 'Tous',
        'online' => 'En ligne',
        'offline' => 'Hors-ligne',
    ],
    'store' => [
        'saved' => 'Utilisateur créé',
    ],
    'verify' => [
        'title' => 'Vérification de compte',
    ],

    'view_mode' => [
        'card' => 'Vue en carte',
        'list' => 'Vue en liste',
    ],
];
