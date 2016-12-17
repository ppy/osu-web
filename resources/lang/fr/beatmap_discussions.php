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
    'authorizations' => [
        'update' => [
            'null_user' => 'Vous devez être connecté pour éditer.',
            'system_generated' => 'Un post système ne peut être édité.',
            'wrong_user' => 'Vous devez être le créateur du post pour l\'éditer.',
        ],
    ],
    'system' => [
        'resolved' => [
            'true' => 'Marqué comme résolu par :user',
            'false' => 'Réouvert par :user',
        ],
    ],
];
