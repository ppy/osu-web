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
    'limitation_notice' => 'HINWEIS: Nur Leute, die <a href=":lazer_link">osu!lazer</a> oder die neue Webseite nutzen, werden PMs durch dieses System erhalten.<br/>Wenn du unsicher bist, sende ihnen stattdessen über die <a href=":oldpm_link">alte Forum-PM-Seite</a> eine Nachricht.',
    'talking_in' => 'sprechen in :channel',
    'talking_with' => 'sprechen mit :name',
    'title_compact' => 'chat',

    'cannot_send' => [
        'channel' => 'Du kannst derzeit keine Nachrichten an diesen Kanal senden. Dies kann folgende Gründe haben:',
        'user' => 'Du kannst derzeit keine Nachrichten an diesen User senden. Dies kann folgende Gründe haben:',
        'reasons' => [
            'blocked' => 'Du wurdest vom Empfänger blockiert',
            'channel_moderated' => 'Der Kanal wurde moderiert',
            'friends_only' => 'Der Empfänger akzeptiert nur Nachrichten von Personen in seiner Freundesliste',
            'restricted' => 'Du bist zurzeit eingeschränkt',
            'target_restricted' => 'Der Empfänger ist zurzeit eingeschränkt',
        ],
    ],
    'input' => [
        'disabled' => 'Nachricht konnte nicht gesendet werden...',
        'placeholder' => 'Nachricht verfassen...',
        'send' => 'Senden',
    ],
    'no-conversations' => [
        'howto' => "Starte eine Unterhaltung von einem User-Profil oder einem Usercard-Popup.",
        'lazer' => 'Öffentliche Kanäle, die du mit <a href=":link">osu!lazer</a> beitrittst, werden auch hier angezeigt.',
        'pm_limitations' => 'Nur Leute, die <a href=":link">osu!lazer</a> oder die neue Webseite nutzen, werden PMs erhalten.',
        'title' => 'noch keine Unterhaltungen',
    ],
];
