<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'applications' => [
        'accept' => [
            'ok' => 'Vous avez accepté la candidature.',
        ],
        'destroy' => [
            'ok' => 'Candidature annulée.',
        ],
        'reject' => [
            'ok' => 'Vous avez refusé la candidature.',
        ],
        'store' => [
            'ok' => 'Candidature envoyée.',
        ],
    ],

    'card' => [
        'members' => ':count_delimited membre|:count_delimited membres',
    ],

    'create' => [
        'submit' => 'Créer une équipe',

        'form' => [
            'name_help' => 'Le nom de votre équipe. Ce nom est permanent pour le moment.',
            'short_name_help' => 'Maximum 4 caractères.',
            'title' => "Créons une nouvelle équipe",
        ],

        'intro' => [
            'description' => "Jouez avec des amis, qu'ils soient nouveaux ou plus anciens. Vous n'avez pas encore rejoint d'équipe. Vous pouvez rejoindre une équipe existante en visitant leur page d'équipe, ou créer votre propre équipe à partir de cette page.",
            'title' => 'Équipe !',
        ],
    ],

    'destroy' => [
        'ok' => 'Équipe supprimée',
    ],

    'edit' => [
        'ok' => 'Paramètres enregistrés avec succès.',
        'title' => 'Paramètres de l\'équipe',

        'description' => [
            'label' => 'Description',
            'title' => 'Description de l\'équipe',
        ],

        'flag' => [
            'label' => 'Drapeau de l\'équipe',
            'title' => 'Définir le drapeau de l\'équipe',
        ],

        'header' => [
            'label' => 'Bannière',
            'title' => 'Définir la bannière',
        ],

        'settings' => [
            'application_help' => 'Cette option permet aux autres joueurs d\'envoyer une candidature pour rejoindre votre équipe',
            'default_ruleset_help' => 'Le mode de jeu sélectionné par défaut lors de la visite de la page de l\'équipe',
            'flag_help' => 'Taille maximale de :width×:height',
            'header_help' => 'Taille maximale de :width×:height',
            'title' => 'Paramètres de l\'équipe',

            'application_state' => [
                'state_0' => 'Fermées',
                'state_1' => 'Ouvertes',
            ],
        ],
    ],

    'header_links' => [
        'edit' => 'paramètres',
        'leaderboard' => 'classement',
        'show' => 'infos',

        'members' => [
            'index' => 'gestion des membres',
        ],
    ],

    'leaderboard' => [
        'global_rank' => 'Classement global',
    ],

    'members' => [
        'destroy' => [
            'success' => 'Ce membre a été exclu',
        ],

        'index' => [
            'title' => 'Gestion des membres',

            'applications' => [
                'accept_confirm' => 'Êtes-vous sûr de vouloir accepter la candidature de :user ?',
                'created_at' => 'Date',
                'empty' => 'Aucune candidature pour le moment.',
                'empty_slots' => 'Places disponibles ',
                'empty_slots_overflow' => ':count_delimited membre en trop|:count_delimited membres en trop',
                'reject_confirm' => 'Êtes-vous sûr de vouloir refuser la candidature de :user ?',
                'title' => 'Candidatures',
            ],

            'table' => [
                'joined_at' => 'Date d\'adhésion',
                'remove' => 'Exclure',
                'remove_confirm' => 'Êtes-vous sûr de vouloir expulser :user de votre équipe ?',
                'set_leader' => 'Nommer chef d\'équipe',
                'set_leader_confirm' => 'Êtes-vous sûr de vouloir nommer :user en tant que chef de l\'équipe ?',
                'status' => 'Statut',
                'title' => 'Liste des membres',
            ],

            'status' => [
                'status_0' => 'Inactif',
                'status_1' => 'Actif',
            ],
        ],

        'set_leader' => [
            'success' => ':user est désormais le chef de l\'équipe.',
        ],
    ],

    'part' => [
        'ok' => 'Vous avez quitté l\'équipe ;_;',
    ],

    'show' => [
        'bar' => [
            'chat' => 'Tchat d\'équipe',
            'destroy' => 'Dissoudre l\'équipe',
            'join' => 'Demander à rejoindre',
            'join_cancel' => 'Annuler la demande',
            'part' => 'Quitter l\'équipe',
        ],

        'info' => [
            'created' => 'Créée en',
        ],

        'members' => [
            'members' => 'Membres de l\'équipe',
            'owner' => 'Chef d\'équipe',
        ],

        'sections' => [
            'about' => 'À propos de nous !',
            'info' => 'Infos',
            'members' => 'Membres',
        ],

        'statistics' => [
            'empty_slots' => ':count_delimited place disponible|:count_delimited places disponibles',
            'first_places' => '',
            'leader' => 'Chef d\'équipe',
            'rank' => 'Classement',
            'ranked_beatmapsets' => '',
        ],
    ],

    'store' => [
        'ok' => 'Équipe créée.',
    ],
];
