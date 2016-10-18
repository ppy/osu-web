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
    'forum' => [
        'feature_vote' => [
            'not_feature_topic' => 'Puoi votare solamente una richiesta di feature.',
            'not_enough_feature_votes' => 'Non hai abbastanza voti.',
        ],

        'poll_vote' => [
            'invalid' => 'Specificata un\'Opzione Invalida.',
        ],

        'topic_poll' => [
            'duplicate_options' => 'Non è permesso avere un\'opzione duplicata.',
            'invalid_max_options' => 'Le opzioni per utente non possono superare il numero di opzioni disponibili.',
            'minimum_one_selection' => 'È richiesto un minimo di un\'opzione per utente.',
            'minimum_two' => 'È necessario almeno due opzioni.',
            'too_many_options' => 'Raggiunto il massimo numero di opzioni permesse.',
        ],

        'topic_vote' => [
            'too_many' => 'Sono state selezionate più opzioni del consentito.',
        ],
    ],

    'required' => ':attribute è richiesto.',
];
