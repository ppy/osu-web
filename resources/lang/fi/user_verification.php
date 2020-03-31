<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
