<?php

/**
 *    Copyright 2016 ppy Pty. Ltd.
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
    'beatmap_discussion' => [
        'resolve' => [
            'general_discussion' => 'Algemene discussie can niet opgelost worden.',
            'not_owner' => 'Alleen de maker van maker van de thread of de eigenaar van de beatmap can als opgelost markeren.',
        ],
    ],

    'beatmap_discussion_post' => [
        'edit' => [
            'system_generated' => 'Automatisch gegenereerde posts kunnen niet bewerkt worden.',
            'not_owner' => 'Alleen de eigenaar kan deze post bewerken.',
        ],
    ],

    'chat' => [
        'channel' => [
            'read' => [
                'no_access' => 'Toegang tot did kanaal is niet toegestaan.',
            ],
        ],
        'message' => [
            'send' => [
                'channel' => [
                    'no_access' => 'Toegang tot dit kanaal is vereist.',
                    'moderated' => 'Kanaal is op het moment gemodereerd.',
                ],

                'not_allowed' => 'Je kan geen berichten sturen terwijl je verbanned/restricted/gesilenced bent.',
            ],
        ],
    ],

    'forum' => [
        'post' => [
            'delete' => [
                'only_last_post' => 'Alleen de laatste post kan verwijdert worden.',
                'locked' => 'Kan geen post in een gesloten onderwerp verwijderen.',
                'no_forum_access' => 'Toegang tot dit forum is nodig.',
                'not_owner' => 'Alleen de poster kan deze post verwijderen.',
            ],

            'edit' => [
                'locked' => 'Deze post is gesloten voor bewerkingen.',
                'no_forum_access' => 'Toegang tot dit forum is nodig.',
                'not_owner' => 'Alleen de poster kan deze post bewerken.',
                'topic_locked' => 'Kan geen post in een gesloten onderwerp bewerken.',
            ],
        ],

        'topic' => [
            'reply' => [
                'double_post' => 'Je postte net al. Wacht nog even of bewerk je vorige post.',
                'locked' => 'Je kunt niet antwoorden op een gesloten onderwerp.',
                'no_forum_access' => 'Toegang tot dit forum is nodig.',
                'no_permission' => 'Geen toestemming om te antwoorden.',
            ],

            'store' => [
                'no_forum_access' => 'Toegang tot dit forum is nodig.',
                'no_permission' => 'Geen toestemming om een onderwerp te starten.',
                'forum_closed' => 'Forum is gesloten en kan niet in gepost worden.',
            ],
        ],

        'topic_cover' => [
            'edit' => [
                'uneditable' => 'Foutieve cover gespecificeerd.',
                'not_owner' => 'Alleen de eigenaar kan de cover bewerken.',
            ],
        ],

        'view' => [
            'admin_only' => 'Alleen admins kunnen dit forum zien.',
        ],
    ],

    'require_login' => 'Log alsjeblieft in om verder te gaan.',

    'unauthorized' => 'Toegang geweigerd.',

    'silenced' => 'Je kan dit niet doen terwijl je gesilenced bent.',

    'restricted' => 'Je kan dit niet doen terwijl je restricted bent.',

    'user' => [
        'page' => [
            'edit' => [
                'locked' => 'Gebruikers pagina is gesloten.',
                'not_owner' => 'Je kan alleen je eigen gebruikers pagina bewerken.',
                'require_supporter_tag' => 'Supporter tag is nodig.',
            ],
        ],
    ],
];
