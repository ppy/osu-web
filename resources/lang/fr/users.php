<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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
    'deleted' => '[utilisateur supprimé]',

    'beatmapset_activities' => [
        'title' => ":user's Modding History",

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
            'title_most' => 'Les mieux notés (de ces 3 mois)',
        ],

        'votes_made' => [
            'title_most' => 'Les mieux notés (de ces 3 mois)',
        ],
    ],

    'card' => [
        'loading' => 'Chargement...',
        'send_message' => 'envoyer un message',
    ],

    'login' => [
        '_' => 'Se connecter',
        'locked_ip' => 'votre adresse IP est bloquée. Veuillez attendre quelques minutes.',
        'username' => 'Nom d\'utilisateur',
        'password' => 'Mot de passe',
        'button' => 'Se connecter',
        'button_posting' => 'Connexion...',
        'remember' => 'Se souvenir de moi sur cet ordinateur',
        'title' => 'Merci de vous connecter pour continuer',
        'failed' => 'Identifiants incorrects',
        'register' => "Vous n'avez pas de compte osu! ? Inscrivez-vous maintenant ici",
        'forgot' => 'Mot de passe oublié?',
        'beta' => [
            'main' => 'Accès bêta restreint aux utlisateurs privilégiés.',
            'small' => '(les supporteurs l\'obtiendront bientôt)',
        ],

        'here' => 'ici', // this is substituted in when generating a link above. change it to suit the language.
    ],

    'posts' => [
        'title' => 'Posts de :username',
    ],

    'signup' => [
        '_' => 'S\'inscrire',
    ],
    'anonymous' => [
        'login_link' => 'Cliquez pour vous connecter',
        'login_text' => 'Se connecter',
        'username' => 'Invité',
        'error' => 'Vous devez être connecté pour faire ça.',
    ],
    'logout_confirm' => 'Êtes-vous sûr de vouloir vous déconnecter? :(',
    'restricted_banner' => [
        'title' => 'Votre compte a été restreint !',
        'message' => 'Quand vous êtes restreint, vous ne pouvez pas interagir avec les autres joueur et vos scores ne seront visibles qu\'à vous. Cette restriction est souvent le résultat d\'un processus automatique et sera levée en général dans les 24 heures. Si vous souhaitez faire appel de votre restriction, merci de <a href="mailto:accounts@ppy.sh">contacter le support</a>.',
    ],
    'show' => [
        'age' => 'Âgé de :age',
        'change_avatar' => 'changer votre avatar !',
        'first_members' => 'Ici depuis le début',
        'is_developer' => 'osu!developer',
        'is_supporter' => 'osu!supporter',
        'joined_at' => 'Ici depuis :date',
        'lastvisit' => 'Vu la dernière fois :date',
        'missingtext' => 'Vous avez fait une faute de frappe, je crois ! (ou l\'utilisateur est banni)',
        'origin_age' => ':age',
        'origin_country_age' => ':age ans et de :country',
        'origin_country' => 'Depuis :country',
        'page_description' => 'osu! - Tout ce que vous devez savoir à propos de :username!',
        'previous_usernames' => 'Anciennemnt connu en tant que',
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
                    'dropzone_info' => 'Vous pouvez aussi déplacer l\'image ici pour la mettre en ligne',
                    'restriction_info' => "Mise en ligne disponible pour les <a href='".route('store.products.show', 'supporter-tag')."' target='_blank'>osu!supporters</a> uniquement",
                    'size_info' => 'La taille de la bannière devrait être 2000x700',
                    'too_large' => 'Le fichier mis en ligne est trop gros.',
                    'unsupported_format' => 'Format non supporté.',
                ],
            ],

            'default_playmode' => [
                'is_default_tooltip' => 'mode de jeu par défaut',
                'set' => 'définir :mode comme mode de jeu par défaut',
            ],
        ],

        'extra' => [
            'followers' => ':count abonné|:count abonnés',
            'unranked' => 'Aucune partie récente',

            'achievements' => [
                'title' => 'Succès',
                'achieved-on' => 'Acquis le :date',
            ],
            'beatmaps' => [
                'none' => 'Aucune... Pour le moment.',
                'title' => 'Beatmaps',

                'favourite' => [
                    'title' => 'Beatmaps favorites (:count)',
                ],
                'graveyard' => [
                    'title' => 'Beatmaps dans le cimetière (:count)',
                ],
                'ranked_and_approved' => [
                    'title' => 'Beatmaps classées et approuvées (:count)',
                ],
                'unranked' => [
                    'title' => 'Beatmaps en attente (:count)',
                ],
            ],
            'historical' => [
                'empty' => 'Aucun enregistrement de performance. :(',
                'title' => 'Historique',

                'monthly_playcounts' => [
                    'title' => 'Historique des parties',
                ],
                'most_played' => [
                    'count' => 'Nombre de fois jouée',
                    'title' => 'Beatmaps les plus jouées',
                ],
                'recent_plays' => [
                    'accuracy' => 'Précision: :percentage',
                    'title' => 'Parties récentes',
                ],
                'replays_watched_counts' => [
                    'title' => 'Historique des parties regardées',
                ],
            ],
            'kudosu' => [
                'available' => 'Kudosu disponible',
                'available_info' => "Les Kudosu peuvent être échangés pour des étoiles kudosu, qui aideront à ce que votre beatmap ait plus d'attention. C'est le nombre de kudosu non échangés.",
                'recent_entries' => 'Hitorique de Kudosu récents',
                'title' => 'Kudosu!',
                'total' => 'Kudosu reçus au total',
                'total_info' => 'Basé sur notre contribution à la modération de beatmaps. Voir <a href="'.osu_url('user.kudosu').'">cette page</a> pour plus d\'informations.',

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
                            'give' => 'Réception de :amount du vote de recalcul du post :post',
                            'reset' => 'Perte de :amount du vote de recalcul du post :post',
                        ],
                    ],

                    'forum_post' => [
                        'give' => 'A reçu :amount de :giver pour un post sur :post',
                        'reset' => 'Kudosu réinitialisé par :giver pour le post :post',
                        'revoke' => 'Kudosu refusé par :giver pour le post sur :post',
                    ],
                ],
            ],
            'me' => [
                'title' => 'Moi!',
            ],
            'medals' => [
                'empty' => "Cet utilsateur n'en a jamais reçu. ;_;",
                'title' => 'Médailles',
            ],
            'recent_activity' => [
                'title' => 'Activité récente',
            ],
            'top_ranks' => [
                'empty' => 'Pas de première place. :(',
                'not_ranked' => 'Only ranked beatmaps give out pp.',
                'pp' => ':amountpp',
                'title' => 'Classements',
                'weighted_pp' => 'pondéré: :pp (:percentage)',

                'best' => [
                    'title' => 'Meilleures performances',
                ],
                'first' => [
                    'title' => 'Premières places',
                ],
            ],
            'account_standing' => [
                'title' => 'Statut du compte',
                'bad_standing' => "Le compte de <strong>:username</strong> n'est pas dans un bon statut :(",
                'remaining_silence' => '<strong>:username</strong> pourra parler à nouveau dans :duration.',

                'recent_infringements' => [
                    'title' => 'Sanctions récentes',
                    'date' => 'date',
                    'action' => 'sanction',
                    'length' => 'longeur',
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
            'reason_1' => 'They may have changed their username.',
            'reason_2' => 'The account may be temporarily unavailable due to security or abuse issues.',
            'reason_3' => 'You may have made a typo!',
            'reason_header' => 'There are a few possible reasons for this:',
            'title' => 'Utilisateur non trouvé! ;_;',
        ],
        'page' => [
            'description' => '<strong>Moi!</strong> est une zone personnalisable du profil.',
            'edit_big' => 'Éditez-moi !',
            'placeholder' => 'Tapez le contenu de la page',
            'restriction_info' => "Vous devez être <a href='".route('store.products.show', 'supporter-tag')."' target='_blank'>osu!supporter</a> pour débloquer cette fonctionnalité.",
        ],
        'post_count' => [
            '_' => 'A contribué à :link',
            'count' => ':count post du forum|:count posts du forum',
        ],
        'rank' => [
            'country' => 'Classement national en :mode',
            'global' => 'Classement global en :mode',
        ],
        'stats' => [
            'hit_accuracy' => 'Précision',
            'level' => 'Niveau :level',
            'maximum_combo' => 'Combo maximum',
            'play_count' => 'Nombres de parties',
            'play_time' => 'Temps de jeu total',
            'ranked_score' => 'Score classé',
            'replays_watched_by_others' => 'Replays regardés par les autres',
            'score_ranks' => 'Classements de Scores',
            'total_hits' => 'Nombre de clics',
            'total_score' => 'Score total',
        ],
    ],
    'status' => [
        'online' => 'En ligne',
        'offline' => 'Hors-ligne',
    ],
    'store' => [
        'saved' => 'Utilisateur créé',
    ],
    'verify' => [
        'title' => 'Vérification de compte',
    ],
];
