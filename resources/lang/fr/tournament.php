<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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
    'index' => [
        'none_running' => 'Il n\'y a pas de tournois en ce moment, vérifiez plus tard !',
        'registration_period' => 'Inscriptions : :start à :end',

        'header' => [
            'subtitle' => 'Une liste des tournois actifs et reconnus officiellement.',
            'title' => 'Tournois communautaires',
        ],

        'item' => [
            'registered' => 'Joueurs inscrits',
        ],

        'state' => [
            'current' => 'Tournois en cours',
            'previous' => 'Tournois passés',
        ],
    ],

    'show' => [
        'banner' => 'Soutenez votre équipe',
        'entered' => 'Vous êtes inscrit à ce tournoi.<br><br>Notez que cela ne signifie pas que vous avez été assigné à une équipe.<br><br>Des instructions vous seront envoyées aux alentours de la date du tournoi, merci de vérifier que l\'e-mail lié à votre compte osu! est toujours valide !',
        'info_page' => 'Page d\'informations',
        'login_to_register' => 'Merci de :login pour voir les détails d\'inscription !',
        'not_yet_entered' => 'Vous n\'êtes pas inscrit à ce tournoi.',
        'rank_too_low' => 'Désolé, vous ne respectez pas les critères de rang pour ce tournoi!',
        'registration_ends' => 'Les inscriptions ferment le :date',

        'button' => [
            'cancel' => 'Annuler l\'inscription',
            'register' => 'Inscription!',
        ],

        'state' => [
            'before_registration' => 'Les inscriptions pour ce tournoi n\'ont pas encore débuté.',
            'ended' => 'Ce tournoi est terminé. Visitez la page d\'informations pour voir les résultats.',
            'registration_closed' => 'Les inscriptions pour ce tournoi sont closes. Visitez la page d\'informations pour les dernières actualités.',
            'running' => 'Ce tournoi est actuellement en cours. Visitez la page d\'informations pour plus de détails.',
        ],
    ],
    'tournament_period' => ':start à :end',
];
