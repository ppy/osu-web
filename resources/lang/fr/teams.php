<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'applications' => [
        'accept' => [
            'ok' => '',
        ],
        'destroy' => [
            'ok' => '',
        ],
        'reject' => [
            'ok' => '',
        ],
        'store' => [
            'ok' => '',
        ],
    ],

    'destroy' => [
        'ok' => '',
    ],

    'edit' => [
        'saved' => 'Paramètres enregistrés avec succès',
        'title' => 'Paramètres de l\'équipe',

        'description' => [
            'label' => 'Description',
            'title' => 'Description de l\'équipe',
        ],

        'header' => [
            'label' => 'Image d\'en-tête',
            'title' => 'Définir l\'image d\'en-tête',
        ],

        'logo' => [
            'label' => 'Drapeau de l\'équipe',
            'title' => 'Définir le drapeau de l\'équipe',
        ],

        'settings' => [
            'application' => 'Candidatures d\'équipe',
            'application_help' => 'Permettre aux personnes de candidater pour l\'équipe',
            'default_ruleset' => 'Mode de jeu par défaut',
            'default_ruleset_help' => 'Le mode de jeu à sélectionner par défaut lors de la visite de la page de l\'équipe',
            'title' => 'Paramètres de l\'équipe',
            'url' => 'URL',

            'application_state' => [
                'state_0' => 'Fermée',
                'state_1' => 'Ouverte',
            ],
        ],
    ],

    'header_links' => [
        'edit' => '',
        'leaderboard' => '',
        'show' => '',

        'members' => [
            'index' => '',
        ],
    ],

    'leaderboard' => [
        'global_rank' => '',
        'performance' => '',
        'total_score' => '',
    ],

    'members' => [
        'destroy' => [
            'success' => 'Membre d\'équipe retiré',
        ],

        'index' => [
            'title' => 'Gérer les membres',

            'applications' => [
                'empty' => '',
                'empty_slots' => '',
                'title' => '',
                'created_at' => '',
            ],

            'table' => [
                'status' => 'Statut',
                'joined_at' => 'Date d\'adhésion',
                'remove' => 'Retirer',
                'title' => 'Membres Actuels',
            ],

            'status' => [
                'status_0' => 'Inactif',
                'status_1' => 'Actif',
            ],
        ],
    ],

    'part' => [
        'ok' => '',
    ],

    'show' => [
        'bar' => [
            'destroy' => '',
            'join' => '',
            'join_cancel' => '',
            'part' => '',
        ],

        'info' => [
            'created' => 'Formé',
            'website' => 'Site web',
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
];
