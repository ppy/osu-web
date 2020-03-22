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
    'limitation_notice' => 'POZNÁMKA: Pouze lidi, kteří používají <a href=":lazer_link">osu!lazer</a> nebo nový vzhled stránek mohou dostávat soukromé zprávy přes tento systém.<br/>Pokud si tím nejste jistý ani jednou z těchto podmínek, pošlete jim zprávu přes <a href=":oldpm_link">starý systém na fórech</a>.',
    'talking_in' => 'píšete do :channel',
    'talking_with' => 'píšete si s :name',
    'title_compact' => 'chat',

    'cannot_send' => [
        'channel' => 'Nemůžeme poslat vaši zprávu do tohoto kanálu. Tohle může být zapříčiněno jakýmkoliv z těchto důvodů:',
        'user' => 'Nemůžeme poslat vaši zprávu tomuhle uživateli. Tohle může být zapříčiněno jakýmkoliv z těchto důvodů:',
        'reasons' => [
            'blocked' => 'Byl jste zablokován příjemcem',
            'channel_moderated' => 'Tento kanál je právě moderován',
            'friends_only' => 'Příjemce může přijímat zprávy pouze od lidí na jeho seznamu přátel',
            'restricted' => 'Váš účet je teď zablokován',
            'target_restricted' => 'Účet příjemce je právě zablokován',
        ],
    ],
    'input' => [
        'disabled' => 'nejsme schopni odeslat tuto zprávu...',
        'placeholder' => 'napište zprávu...',
        'send' => 'Odeslat',
    ],
    'no-conversations' => [
        'howto' => "Začněte konverzce z profilu uživatele nebo z popup karty uživatele.",
        'lazer' => 'Veřejné místnosti, do kterých se připojíte skrz <a href=":link">osu!lazer</a>, zde budete moct taky vidět.',
        'pm_limitations' => 'Pouze lidi užívající <a href=":link">osu!lazer</a> nebo nový vzhled stránek mohou přijímat soukromé zprávy.',
        'title' => 'zatím žádné konverzace',
    ],
];
