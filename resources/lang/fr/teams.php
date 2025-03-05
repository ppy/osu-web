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

    'create' => [
        'submit' => '',

        'form' => [
            'name_help' => '',
            'short_name_help' => '',
            'title' => "",
        ],

        'intro' => [
            'description' => "",
            'title' => '',
        ],
    ],

    'destroy' => [
        'ok' => 'Équipe supprimée',
    ],

    'edit' => [
        'ok' => '',
        'title' => 'Paramètres de l\'équipe',

        'description' => [
            'label' => 'Description',
            'title' => 'Description de l\'équipe',
        ],

        'flag' => [
            'label' => '',
            'title' => '',
        ],

        'header' => [
            'label' => 'Bannière',
            'title' => 'Définir la bannière',
        ],

        'settings' => [
            'application_help' => 'Cette option permet aux autres joueurs d\'envoyer une candidature pour rejoindre votre équipe',
            'default_ruleset_help' => 'Le mode de jeu sélectionné par défaut lors de la visite de la page de l\'équipe',
            'flag_help' => '',
            'header_help' => '',
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
                'empty' => 'Aucune candidature pour le moment.',
                'empty_slots' => 'Places disponibles ',
                'title' => 'Candidatures',
                'created_at' => 'Date',
            ],

            'table' => [
                'status' => 'Statut',
                'joined_at' => 'Date d\'adhésion',
                'remove' => 'Exclure',
                'title' => 'Liste des membres',
            ],

            'status' => [
                'status_0' => 'Inactif',
                'status_1' => 'Actif',
            ],
        ],
    ],

    'part' => [
        'ok' => 'Vous avez quitté l\'équipe ;_;',
    ],

    'show' => [
        'bar' => [
            'chat' => '',
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
            'info' => 'Infos',
            'members' => 'Membres',
        ],
    ],

    'store' => [
        'ok' => '',
    ],
];
