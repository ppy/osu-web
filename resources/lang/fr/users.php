<?php

/**
 *    Copyright 2015 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed in the hopes of
 *    attracting more community contributions to the core ecosystem of osu!
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

    'login' => [
        '_' => 'Se connecter',
        'username' => 'Nom d\'utilisateur',
        'password' => 'Mot de passe',
        'button' => 'Se connecter',
        'remember' => 'Se souvenir de moi sur cet ordinateur',
        'title' => 'Merci de vous connecter pour continuer',
        'failed' => 'Identifiants incorrects',
        'register' => "Vous n'avez pas de compte osu! ? Inscrivez-vous maitenant ici",
        'forgot' => 'Mot de passe oublié?',
        'beta' => [
            'main' => 'Accès bêta restreint aux utlisateurs privilégiés.',
            'small' => '(les supporteurs l\'obtiendront bientôt)',
        ],

        'here' => 'ici', // this is substituted in when generating a link above. change it to suit the language.
    ],
    'signup' => [
        '_' => 'S\'inscrire',
    ],
    'anonymous' => [
        'login_link' => 'cliquez pour vous connecter',
        'username' => 'Invité',
        'error' => 'Vous devez être connecté pour faire ça.',
    ],
    'logout_confirm' => 'Vous êtes sûr de vous déconnecter? :(',
    'show' => [
        '404' => 'Utilisateur non trouvé! ;_;',
        'current_location' => 'Actuellement à :location.',
        'edit' => [
            'cover' => [
                'button' => 'Changer la bannière du profil',
                'defaults_info' => 'Plus d\'options seront disponibles bientôt',
                'upload' => [
                    'broken_file' => 'Impossible de traiter l\'image. Vérifiez l\'image mis en ligne et réesayez.',
                    'button' => 'Mettre en ligne l\'image',
                    'dropzone' => 'Déplacez ici pour uploader',
                    'dropzone_info' => 'Vous pouvez aussi déplacer l\'image ici pour la mettre en ligne',
                    'restriction_info' => "Mise en ligne disponible pour les <a href='".osu_url('support-the-game')."' target='_blank'>osu!supporteurs</a> uniquement",
                    'size_info' => 'La taille de la bannière devrait être 2000x500',
                    'too_large' => 'Le fichier mis en ligne est trop gros.',
                    'unsupported_format' => 'Format non supporté.',
                ],
            ],
        ],
        'extra' => [
            'achievements' => [
                'title' => 'Succès',
                'achieved-on' => 'Acquis le :date',
            ],
            'beatmaps' => [
                'title' => 'Beatmaps',
            ],
            'historical' => [
                'empty' => 'Aucun enregistrement de performance. :(',
                'most_played' => [
                    'count' => 'nombre de fois jouées',
                    'title' => 'Beatmaps les plus jouées',
                ],
                'recent_plays' => [
                    'accuracy' => 'précision: :percentage',
                    'title' => 'Parties récentes',
                ],
                'title' => 'Historique',
            ],
            'performance' => [
                'title' => 'Performance',
            ],
            'kudosu' => [
                'available' => 'Kudosu Disponible',
                'available_info' => "Le Kudosu peut être échangé pour des étoiles kudosu, qui vous aidera pour que votre beatmap ait plus d'attention. C'est le nombre de Kudosu qui n'avaient pas encore échangés.",
                'entry' => [
                    'empty' => "Cet utilisateur n'a jamais reçu de Kudosu!",
                    'give' => 'A reçu <strong class="kudosu-entries__amount">:amount kudosu</strong> de :giver pour un post sur :post',
                    'revoke' => 'Kudosu refusé de :giver pour le post :post',
                ],
                'recent_entries' => 'Hitorique de Kudosu récents',
                'title' => 'Kudosu!',
                'total' => 'Kudosu reçus au total',
                'total_info' => 'Basé sur combien de fois on a contribué dans la modération de beatmaps. Voir <a href="'.osu_url('user.kudosu').'">cette page</a> pour plus d\'informations.',
            ],
            'me' => [
                'title' => 'moi!',
            ],
            'medals' => [
								'empty' => "Cet utilsateur n'en a jamais reçu. ;_;",
                'title' => 'Médailles',
            ],
            'recent_activities' => [
                'title' => 'Récent',
            ],
            'top_ranks' => [
                'best' => [
                    'title' => 'Meilleures performances',
                ],
                'empty' => 'Pas de meilleurs performances. :(',
                'first' => [
                    'title' => 'Classements à la première place',
                ],
                'pp' => ':amountpp',
                'title' => 'Classements',
                'weighted_pp' => 'pondéré: :pp (:percentage)',
            ],
            'beatmaps' => [
                'title' => 'Beatmaps',
                'favourite' => [
                    'title' => 'Beatmaps favorites (:count)',
                ],
                'ranked_and_approved' => [
                    'title' => 'Beatmaps classés et approuvés (:count)',
                ],
                'none' => 'Aucun... en ce moment.',
            ],
        ],
        'first_members' => 'ici depuis le début',
        'is_supporter' => 'osu!supporter',
        'is_developer' => 'osu!developer',
        'lastvisit' => 'Vu la dernière fois le :date.',
        'joined_at' => 'ici depuis le :date',
        'more_achievements' => 'et plus',
        'origin' => [
            'age' => 'âgé de :age.',
            'country' => 'Depuis :country.',
            'country_age' => 'Âgé de :age ans et de :country.',
        ],
        'page' => [
            'description' => '<strong>moi!</strong> est une zone personnalisable du profil.',
            'edit_big' => 'éditer le moi!',
            'placeholder' => 'Tapez le contenu de la page',
            'restriction_info' => "Vous devez être <a href='".osu_url('support-the-game')."' target='_blank'>osu!supporter</a> pour débloquer cette fonctionnalité.",
        ],
        'plays_with' => [
            '_' => 'Joue avec',
            'keyboard' => 'Clavier',
            'mouse' => 'Souris',
            'tablet' => 'Tablette',
            'touch' => 'Écran tactile',
        ],
        'missingtext' => 'Vous avez fait une erreur typo je crois! (ou l\'utilisateur vous a banni)',
        'page_description' => 'osu! - Tout ce que vous devez savoir à propos de :username!',
        'rank' => [
            'country' => 'Classement national pour :mode',
            'global' => 'Classement global pour :mode',
        ],
        'stats' => [
            'hit_accuracy' => 'Précision du clic',
            'level' => 'Niveau :level',
            'maximum_combo' => 'Combo maximum',
            'play_count' => 'Nombres de parties',
            'ranked_score' => 'Score classé',
            'replays_watched_by_others' => 'Replay regardés par les autres',
            'score_ranks' => 'Classements de Scores',
            'total_hits' => 'Nombre de clics',
            'total_score' => 'Score total',
        ],
        'title' => 'profil de :username',
    ],

    'verify' => [
        'title' => 'Vérification de compte',
    ],
];
