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
    'index' => [
        'header' => [
            'subtitle' => 'Une liste des tournois actifs et reconnus officiellement.',
            'title' => 'Tournois communautaires',
        ],
        'none_running' => 'Il n\'y a pas de tournois en ce moment, vérifiez plus tard !',
        'registration_period' => 'Inscriptions : :start à :end',
    ],

    'show' => [
        'banner' => 'Support Your Team',
        'entered' => 'Vous êtes inscrit à ce tournoi.<br><br>Cela ne signifie pas que vous avez été assigné à une équipe.<br><br>Des instructions vous seront envoyées proche de la date du tournoi, merci de vérifier que l\'e-mail sur votre compte osu! est toujours valide.',
        'info_page' => 'Information Page',
        'login_to_register' => 'Merci de :login pour voir les détails d\'inscription !',
        'not_yet_entered' => 'Vous n\'êtes pas inscrit à ce tournoi.',
        'rank_too_low' => 'Désolé, vous ne respectez pas les critères de rang pour ce tournoi!',
        'registration_ends' => 'Les inscriptions ferment le :date',

        'button' => [
            'cancel' => 'Annuler l\'inscription',
            'register' => 'Inscription!',
        ],

        'state' => [
            'before_registration' => 'Registration for this tournament has not yet opened.',
            'ended' => 'This tournament has concluded. Check the information page for results.',
            'registration_closed' => 'Registration for this tournament has closed. Check the information page for latest updates.',
            'running' => 'This tournament is currently in progress. Check the information page for more details.',
        ],
    ],
    'tournament_period' => ':start à :end',
];
