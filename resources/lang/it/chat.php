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
    'limitation_notice' => 'NOTA: Solamente gli utenti che utilizzano <a href=":lazer_link">osu!lazer</a> o il nuovo sito web riceveranno messaggi privati tramite questo sistema.<br/>Se non sei sicuro, invia un messaggio dalla <a href=":oldpm_link">pagina dei messaggi privati del vecchio forum</a>.',
    'talking_in' => 'parlando in :channel',
    'talking_with' => 'parlando con :name',
    'title_compact' => 'chat',

    'cannot_send' => [
        'channel' => 'Al momento non puoi inviare messaggi in questo canale. Ciò può essere dovuto a uno dei seguenti motivi:',
        'user' => 'Al momento non puoi inviare messaggi a questo utente. Ciò può essere dovuto ad uno dei seguenti motivi:',
        'reasons' => [
            'blocked' => 'Sei stato bloccato dal destinatario',
            'channel_moderated' => 'Questo canale è stato moderato',
            'friends_only' => 'Il destinatario accetta messaggi solamente da utenti nella sua lista amici',
            'restricted' => 'Sei attualmente limitato',
            'target_restricted' => 'Il destinatario è attualmente limitato',
        ],
    ],
    'input' => [
        'disabled' => 'impossibile inviare il messaggio...',
        'placeholder' => 'scrivi un messaggio...',
        'send' => 'Invia',
    ],
    'no-conversations' => [
        'howto' => "Inizia le conversazioni dal profilo di un utente o dal popup della sua carta utente.",
        'lazer' => 'I canali pubblici in cui entri attraverso <a href=":link">osu!lazer</a> saranno visibili anche qui.',
        'pm_limitations' => 'Solamente gli utenti che usano <a href=":link">osu!lazer</a> o il nuovo sito web riceveranno i messaggi privati.',
        'title' => 'nessuna conversazione al momento',
    ],
];
