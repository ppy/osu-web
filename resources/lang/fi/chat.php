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
    'limitation_notice' => 'HUOMAA: Vain käyttäjät jotka käyttävät <a href=":lazer_link">osu!lazeria</a> tai uutta nettisivua saavat yksityisviestejä tämän järjestelmän kautta.<br/>Lähetä viesti <a href=":oldpm_link"> vanhalta yksityisviestisivulta</a>, jos olet epävarma.',
    'talking_in' => 'keskustellaan :channel:ssa',
    'talking_with' => 'keskustelu :name:n kanssa',
    'title_compact' => 'viestit',

    'cannot_send' => [
        'channel' => 'Et voi lähettää tälle kanavalle viestejä juuri nyt, koska',
        'user' => 'Et voi lähettää tälle käyttäjälle viestejä, koska',
        'reasons' => [
            'blocked' => 'Viestin vastaanottaja on estänyt sinut',
            'channel_moderated' => 'Tämä kanava on moderoitu',
            'friends_only' => 'Vastaanottaja sallii viestit vain hänen kavereiltaan',
            'restricted' => 'Käyttäjätilisi on rajoitetussa tilassa',
            'target_restricted' => 'Vastaanottaja on rajoitetussa tilassa',
        ],
    ],
    'input' => [
        'disabled' => 'viestiä ei voida lähettää...',
        'placeholder' => 'kirjoita viesti...',
        'send' => 'Lähetä',
    ],
    'no-conversations' => [
        'howto' => "Aloita keskusteluja käyttäjän profiilista tai käyttäjäkortti-ikkunasta.",
        'lazer' => 'Julkiset kanavat joihin olet liittynyt <a href=":link">osu!lazerilla</a> näkyvät myös täällä.',
        'pm_limitations' => 'Vain <a href=":link">osu!lazerin</a> tai uuden nettisivun käyttäjät voivat vastaanottaa yksityisviestejä.',
        'title' => 'ei keskusteluja...',
    ],
];
