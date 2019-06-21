<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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
    'all_read' => 'Toutes les notifications lues !',
    'mark_all_read' => 'Tout effacer',
    'message_multi' => ':count_delimited nouvelle mise à jour sur ":title".|:count_delimited nouvelles mises à jour sur ":title".',

    'item' => [
        'beatmapset' => [
            '_' => 'Beatmap',

            'beatmapset_discussion' => [
                '_' => 'Discussion de la beatmap',
                'beatmapset_discussion_lock' => 'Beatmap ":title" a été verrouillée pour la discussion.',
                'beatmapset_discussion_post_new' => ':username a publié un nouveau message dans la discussion de beatmap ":title".',
                'beatmapset_discussion_unlock' => 'Beatmap ":title" a été déverrouillée pour la discussion.',
            ],

            'beatmapset_state' => [
                '_' => 'Statut de la Beatmap modifié',
                'beatmapset_disqualify' => 'Beatmap ":title" a été disqualifiée par :username.',
                'beatmapset_love' => 'Beatmap ":title" a été promu comme aimée par :username.',
                'beatmapset_nominate' => 'Beatmap ":title" a été nominée par :username.',
                'beatmapset_qualify' => 'Beatmap ":title" a reçu assez de nominations et est donc en attente de classement.',
                'beatmapset_reset_nominations' => 'Problème posté par :username reset nomination de beatmap ":title" ',
            ],
        ],

        'forum_topic' => [
            '_' => 'Sujet du forum',

            'forum_topic_reply' => [
                '_' => 'Nouvelle réponse du forum',
                'forum_topic_reply' => ':username a répondu au sujet du forum ":title".',
            ],
        ],

        'legacy_pm' => [
            '_' => 'Ancienne page forum des messages privés',

            'legacy_pm' => [
                '_' => '',
                'legacy_pm' => ':count_delimited message non lu.|:count_delimited messages non lus.',
            ],
        ],
    ],
];
