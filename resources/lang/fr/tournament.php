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
            'subtitle' => 'Une liste des tournois actifs et officiellement reconnus',
            'title' => 'Tournois de la Communauté',
        ],
        'none_running' => "Il n'y a pas de tournois pour le moment, revenez plus tard !",
        'registration_period' => 'Inscriptions: du :start au :end',
    ],
    'show' => [
        'button' => [
            'register' => 'Inscrit-moi !',
            'cancel' => "Annuler l'inscription",
        ],
        'entered' => "Vous êtes inscrit pour ce tournoi.<br><br>Sachez que cela n'implique pas que vous avez été affecté à une équipe.<br><br>D'autres instructions vous seront envoyées via e-mail lorsque le tournoi sera proche, assurez-vous donc que l'adresse e-mail de votre compte est à jour !",
        'login_to_register' => "Veuillez :login pour voir les détails de l'inscription !",
        'not_yet_entered' => "Vous n'êtes pas inscrit pour ce tournoi.",
        'rank_too_low' => 'Désolé, vous ne remplissez pas les critères requis pour participer à ce tournoi !',
        'registration_ends' => 'Inscriptions fermées le :date',
    ],
    'tournament_period' => 'du :start au :end',
];
