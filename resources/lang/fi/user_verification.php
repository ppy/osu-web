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
    'box' => [
        'sent' => 'Osoitteeseen :mail on lähetetty vahvistus koodi. Syötä koodi.',
        'title' => 'Tilin Vahvistaminen',
        'verifying' => 'Varmistetaan...',
        'issuing' => 'Annetaan uutta koodia...',

        'info' => [
            'check_spam' => "Varmista roskapostikansiosi jos et voi löytää sähköpostia.",
            'recover' => "Jos et pääse sähköpostiisi tai olet unohtanut sen sähköpostin mitä käytit niin :link.",
            'recover_link' => '',
            'reissue' => 'Voit myös :reissua_link tai :logout_link.',
            'reissue_link' => 'pyydä toinen koodi',
            'logout_link' => 'kirjaudu ulos',
        ],
    ],

    'email' => [
        'subject' => 'osu! tilin vahvistaminen',
    ],

    'errors' => [
        'expired' => 'Vahvistuskoodi päättynyt, uusi vahvistussähköposti lähetetty.',
        'incorrect_key' => 'Virheellinen vahvistuskoodi.',
        'retries_exceeded' => 'Väärä vahvistuskoodi. Uudelleenyritysraja ylitetty, uusi vahvistussähköposti lähetetty.',
        'reissued' => '',
        'unknown' => 'Tuntematon virhe tapahtui, uusi vahvistussähköposti lähetetty.',
    ],
];
