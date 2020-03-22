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
    'index' => [
        'none_running' => 'Non ci sono tornei in corso in questo momento, prova a vedere più tardi!',
        'registration_period' => 'Registrazione: :start - :end',

        'header' => [
            'title' => 'Tornei della Community',
        ],

        'item' => [
            'registered' => 'Giocatori registrati',
        ],

        'state' => [
            'current' => 'Tornei in corso',
            'previous' => 'Tornei passati',
        ],
    ],

    'show' => [
        'banner' => 'Supporta la Tua Squadra',
        'entered' => 'Sei iscritto in questo torneo.<br><br>Nota però che questo <b>non</b> significa che sei già stato assegnato ad una squadra.<br><br>Ti verranno inviate ulteriori informazioni via email in vicinanza della data del torneo, quindi assicurati che l\'email del tuo account osu! sia valida!',
        'info_page' => 'Pagina delle Informazioni',
        'login_to_register' => 'Si prega di :login per visualizzare i dettagli di registrazione!',
        'not_yet_entered' => 'Non sei registrato in questo torneo.',
        'rank_too_low' => 'Mi spiace, il tuo rank non soddisfa i requisiti di questo torneo!',
        'registration_ends' => 'Le iscrizioni chiudono il :date',

        'button' => [
            'cancel' => 'Annulla Iscrizione',
            'register' => 'Iscrivimi!',
        ],

        'period' => [
            'end' => 'Fine',
            'start' => 'Inizio',
        ],

        'state' => [
            'before_registration' => 'Le iscrizioni per questo torneo non sono ancora aperte.',
            'ended' => 'Questo torneo è terminato. Controlla la pagina delle informazioni per vedere i risultati.',
            'registration_closed' => 'Le iscrizioni per questo torneo sono terminate. Controlla la pagina delle informazioni per gli ultimi aggiornamenti.',
            'running' => 'Questo torneo è attualmente in corso. Controlla la pagina delle informazioni per avere più dettagli.',
        ],
    ],
    'tournament_period' => ':start - :end',
];
