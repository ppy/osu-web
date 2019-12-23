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
    'box' => [
        'sent' => 'Osoitteeseen :mail on lähetetty vahvistuskoodi. Syötä koodi.',
        'title' => 'Tilin Vahvistaminen',
        'verifying' => 'Varmistetaan...',
        'issuing' => 'Annetaan uutta koodia...',

        'info' => [
            'check_spam' => "Tarkista roskapostikansio jos et löydä lähetettyä sähköpostia.",
            'recover' => "Jos sinulla ei ole pääsyä sähköpostiisi tai olet unohtanut mitä osoitetta olet käyttänyt, aloita :link.",
            'recover_link' => 'sähköpostiosoitteen palauttaminen tästä',
            'reissue' => 'Voit myös :reissue_link tai :logout_link.',
            'reissue_link' => 'pyytää toisen koodin',
            'logout_link' => 'kirjautua ulos',
        ],
    ],

    'errors' => [
        'expired' => 'Vahvistuskoodi erääntyi, uusi vahvistussähköposti lähetetty.',
        'incorrect_key' => 'Virheellinen vahvistuskoodi.',
        'retries_exceeded' => 'Virheellinen vahvistuskoodi. Uudelleenyritysraja ylitetty, uusi vahvistussähköposti lähetetty.',
        'reissued' => 'Vahvistuskoodi uusittu, uusi vahvistussähköposti lähetetty.',
        'unknown' => 'Tuntematon virhe tapahtui, uusi vahvistussähköposti lähetetty.',
    ],
];
