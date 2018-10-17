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
        'small' => 'Kilpaile muillakin tavoilla kuin klikkailemalla ympyröitä.',
        'large' => 'Yhteisön kilpailut',
    ],
    'voting' => [
        'over' => 'Äänestys tälle kilpailulle on päättynyt',
        'login_required' => 'Kirjaudu sisään äänestääksesi.',
        'best_of' => [
            'none_played' => "Näyttäisi siltä, ettet pelannut tähän kilpailuun kelpuutettuja karttoja!",
        ],
    ],
    'entry' => [
        '_' => 'tuotos',
        'login_required' => 'Kirjaudu sisään osallistuaksesi kilpailuun.',
        'silenced_or_restricted' => 'Et voi osallistua kilpailuun jos olet rajoitetussa -tai mykistetyssä tilassa.',
        'preparation' => 'Valmistelemme tätä kilpailua. Odota rauhassa!',
        'over' => 'Kiitos lähetämistänne töistä! Osallistumiset kilpailuun on suljettu ja äänestys aukeaa pian.',
        'limit_reached' => 'Olet saavuttanut kilpailuun lähetettävien töiden rajan',
        'drop_here' => 'Pudota tuotoksesi tähän',
        'wrong_type' => [
            'art' => 'Kilpailuun hyväksytään vain .jpg tai .png tiedostoja.',
            'beatmap' => 'Kilpailuun hyväksytään vain .osu tiedostoja.',
            'music' => 'Kilpailuun hyväksytään vain .mp3 tiedostoja.',
        ],
        'too_big' => 'Lähetettyjen töiden määrä on tässä kilpailussa korkeintaan :limit.',
    ],
    'beatmaps' => [
        'download' => 'Lataa tuotos',
    ],
    'vote' => [
        'list' => 'äänet',
        'count' => '1 ääni |:count äänestä',
    ],
    'dates' => [
        'ended' => 'Loppui :date',

        'starts' => [
            '_' => 'Alkoi :date',
            'soon' => 'pian™',
        ],
    ],
    'states' => [
        'entry' => 'Osallistuminen Avoinna',
        'voting' => 'Äänestys on alkanut',
        'results' => 'Tulokset Julkistettu',
    ],
];
