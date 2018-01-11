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
    'show' => [
        'fallback_translation' => "La page demandée n'est pas encore traduite dans votre langue (:language). Affichage de la version anglaise",
        'languages' => 'Langues',
        'missing' => "La page demandée n'a pas pu être trouvée.",
        'missing_title' => 'Non Trouvée',
        'missing_translation' => "La page demandée n'a pas pu être trouvée pour la langue sélectionnée actuellement",
        'toc' => 'Contenu',

        'edit' => [
            'link' => 'Afficher sur GitHub',
            'refresh' => 'Actualiser',
        ],

        'outdated' => [
            '_' => "Cette page est un ancienne traduction du contenu original. Veuillez vérifier la :default pour plus d'informations (and consider updating the translation if you are able to help out)!",
            'default' => 'Version anglaise',
        ],
    ],
];
