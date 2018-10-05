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
    'header' => [
        'small' => 'Competi in più modi oltre che a cliccare cerchi.',
        'large' => 'Contest della Comunità',
    ],
    'voting' => [
        'over' => 'Le votazioni per questo contest sono terminate',
        'login_required' => 'Per favore effettua il login per votare.',
        'best_of' => [
            'none_played' => "Sembra che tu non abbia giocato nessuna beatmap che si qualificasse per questo contest!",
        ],
    ],
    'entry' => [
        '_' => 'iscrizione',
        'login_required' => 'Per favore effettua il login per entrare nel contest.',
        'silenced_or_restricted' => 'Non puoi entrare nei contest se sei ristretto o silenziato.',
        'preparation' => 'Attualmente stiamo preparando il contest. Per favore attendi con pazienza!',
        'over' => 'Grazie per le tue iscrizioni! Le richieste sono terminate per questo contest e le votazioni avverrano presto.',
        'limit_reached' => 'Hai raggiunto il limite massimo di iscrizioni per questo contest',
        'drop_here' => 'Trascina la tua iscrizione qui',
        'wrong_type' => [
            'art' => 'Solo file .jpg e .png sono accettati per questo contest.',
            'beatmap' => 'Solo file .osu sono accettati per questo contest.',
            'music' => 'Solo file .mp3 sono accettati per questo contest.',
        ],
        'too_big' => 'Le iscrizioni per questo contest possono solo essere fino a :limit.',
    ],
    'beatmaps' => [
        'download' => 'Scarica iscrizione',
    ],
    'vote' => [
        'list' => 'voti',
        'count' => '1 voto|:count voti',
    ],
    'dates' => [
        'ended' => 'Terminato :date',

        'starts' => [
            '_' => 'Inizia :date',
            'soon' => 'presto™',
        ],
    ],
    'states' => [
        'entry' => 'Iscrizioni aperte',
        'voting' => 'Votazione iniziata',
        'results' => 'Risultati pubblicati',
    ],
];
