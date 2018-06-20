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
    'discussion-posts' => [
        'store' => [
            'error' => 'Viestin tallentaminen epäonnistui',
        ],
    ],

    'discussion-votes' => [
        'update' => [
            'error' => 'Äänen päivittäminen epäonnistui',
        ],
    ],

    'discussions' => [
        'allow_kudosu' => 'salli kudosu',
        'delete' => 'poista',
        'deleted' => 'Poistanut :editor :delete_time.',
        'deny_kudosu' => 'evää kudosu',
        'edit' => 'muokkaa',
        'edited' => 'Viimeksi muokannut :editor :update_time.',
        'kudosu_denied' => 'Evätty saamasta kudosua.',
        'message_placeholder' => 'Kirjoita viestisi tähän',
        'message_placeholder_deleted_beatmap' => 'Tämä vaikeusaste on poistettu, joten siitä ei voi enää keskustella.',
        'message_type_select' => 'Valitse kommentin tyyppi',
        'reply_notice' => 'Lisää painamalla enter-näppäintä.',
        'reply_placeholder' => 'Kirjoita vastauksesi tähän',
        'require-login' => 'Kirjaudu sisään lähettääksesi viesti',
        'resolved' => 'Ratkaistu',
        'restore' => 'palauta',
        'title' => 'Keskustelut',

        'collapse' => [
            'all-collapse' => 'Sulje kaikki',
            'all-expand' => 'Avaa kaikki',
        ],

        'empty' => [
            'empty' => 'Ei vielä keskusteluja!',
            'hidden' => 'Mikään keskustelu ei vastaa valittua suodatinta.',
        ],

        'message_hint' => [
            'in_general' => 'Tämä viesti menee rytmikarttasetin yleiseen keskusteluun. Modataksesi tätä rytmikarttaa, aloita viestisi aikaleimalla (esim. 00:12:345).',
            'in_timeline' => 'Modataksesi useampaa aikaleimaa, lähetä useampi viesti (yksi viesti per aikaleima).',
        ],

        'message_type' => [
            'disqualify' => 'Hylkää',
            'hype' => 'Hype!',
            'mapper_note' => 'Muistiinpano',
            'nomination_reset' => 'Käynnistä Ehdokkuus uudelleen',
            'praise' => 'Kehu',
            'problem' => 'Ongelma',
            'suggestion' => 'Ehdotus',
        ],

        'mode' => [
            'events' => 'Historia',
            'general' => 'Yleinen :scope',
            'timeline' => 'Aikajana',
            'scopes' => [
                'general' => 'Tämä vaikeusaste',
                'generalAll' => 'Kaikki vaikeusasteet',
            ],
        ],

        'new' => [
            'timestamp' => 'Aikaleima',
            'timestamp_missing' => 'Paina ctrl-c editointitilassa ja liitä viestisi lisätäksesi aikaleiman!',
            'title' => 'Uusi keskustelu',
        ],

        'show' => [
            'title' => ':title, kartoittanut :mapper',
        ],

        'sort' => [
            '_' => 'Järjestysperuste:',
            'created_at' => 'luontiaika',
            'timeline' => 'aikajana',
            'updated_at' => 'viimeisin päivitys',
        ],

        'stats' => [
            'deleted' => 'Poistettu',
            'mapper_notes' => 'Muistiinpanot',
            'mine' => 'Minun',
            'pending' => 'Vireillä',
            'praises' => 'Kehut',
            'resolved' => 'Ratkaistu',
            'total' => 'Kaikki',
        ],

        'status-messages' => [
            'approved' => 'Tämä rytmikartta hyväksyttiiin :date!',
            'graveyard' => "Tätä rytmikarttaa ei ole päivitetty sitten :date ja sen tekijä on todennäköisesti hyljännyt sen...",
            'loved' => 'Tämä rytmikartta lisättiin rakastettuihin :date!',
            'ranked' => 'Tämä rytmikartta rankattiin :date!',
            'wip' => 'Huomaa: Tämän rytmikartan tekijä on merkannut sen keskeneräiseksi.',
        ],

    ],

    'hype' => [
        'button' => 'Hypetä rytmikarttaa!',
        'button_done' => 'Hypetetty jo!',
        'confirm' => "Oletko varma? Tämä käyttää yhden jäljellä olevista :n hypetyksistäsi, eikä tätä voi peruuttaa.",
        'explanation' => 'Hypetä tätä rytmikarttaa antaaksesi sille lisää näkyvyyttä ehdokkuutta ja rankkausta varten!',
        'explanation_guest' => 'Kirjaudu sisään ja hypetä tätä rytmikarttaa antaaksesi sille lisää näkyvyyttä ehdokkuutta ja rankkausta varten!',
        'new_time' => "Saat uuden hypetyksen :new_time.",
        'remaining' => 'Sinulla on :remaining hypetystä jäljellä.',
        'required_text' => 'Hype: :current/:required',
        'section_title' => 'Hype Juna',
        'title' => 'Hype',
    ],

    'feedback' => [
        'button' => 'Jätä Palautetta',
    ],

    'nominations' => [
        'disqualification_prompt' => 'Syy hylkäykseen?',
        'disqualified_at' => 'Hylätty :time_ago sitten (:reason).',
        'disqualified_no_reason' => 'ei määriteltyä syytä',
        'disqualify' => 'Hylkää',
        'incorrect_state' => 'Virhe suorittaessa toimintaa, kokeile uudelleenladata sivu.',
        'nominate' => 'Aseta Ehdolle',
        'nominate_confirm' => 'Ehdota tätä rytmikarttaa?',
        'nominated_by' => ':users ovat asettaneet ehdolle',
        'qualified' => 'Arvioidaan tulevan rankatuksi :date, jos mitään ongelmia ei löydy.',
        'qualified_soon' => 'Arvioidaan tulevan rankatuksi pian, jos mitään ongelmia ei löydy.',
        'required_text' => 'Ehdolle asetukset: :current/:required',
        'reset_message_deleted' => 'poistettu',
        'title' => 'Ehdokkuus Tila',
        'unresolved_issues' => 'On edelleen olemassa ongelmia, jotka pitää käsitellä.',

        'reset_at' => [
            'nomination_reset' => 'Ehdokkuus prosessi käynnistetty uudelleen käyttäjän :user toimesta uuden ongelman takia :discussion (:message).',
            'disqualify' => 'Hylätty :time_ago käyttäjän :user toimesta uuden ongelman takia :discussion (:message).',
        ],

        'reset_confirm' => [
            'nomination_reset' => 'Oletko varma? Uuden ongelman lähettäminen käynnistää ehdokkuus prosessin uudelleen.',
        ],
    ],

    'listing' => [
        'search' => [
            'prompt' => 'anna hakusana...',
            'options' => 'Lisää Haku-asetuksia',
            'not-found' => 'ei tuloksia',
            'not-found-quote' => '... Eip, mitään ei löytynyt.',
            'filters' => [
                'general' => 'Yleinen',
                'mode' => 'Pelitila',
                'status' => 'Rankkaus tila',
                'genre' => 'Lajityyppi',
                'language' => 'Kieli',
                'extra' => 'extra',
                'rank' => 'Saavutettu Sijoutus',
                'played' => 'Pelattu',
            ],
            'sorting' => [
                'title' => 'nimi',
                'artist' => 'esittäjä',
                'difficulty' => 'vaikeusaste',
                'updated' => 'päivitetty',
                'ranked' => 'rankattu',
                'rating' => 'luokitus',
                'plays' => 'pelikerrat',
                'relevance' => 'osuvuus',
                'nominations' => '',
            ],
        ],
        'mode' => 'Pelitila',
        'status' => 'Rankkaus tila',
        'source' => 'lähteestä :source',
        'load-more' => 'Lataa lisää...',
    ],
    'general' => [
        'recommended' => 'Suositeltu vaikeusaste',
        'converts' => 'Sisällä konvertoidut rytmikartat',
    ],
    'mode' => [
        'any' => 'Mikä tahansa',
        'osu' => '',
        'taiko' => '',
        'fruits' => '',
        'mania' => '',
    ],
    'status' => [
        'any' => 'Mikä tahansa',
        'ranked-approved' => 'Rankatut & Hyväksytyt',
        'approved' => 'Hyväksytty',
        'qualified' => 'Hyväksytty',
        'loved' => 'Rakastetut',
        'faves' => 'Suosikit',
        'pending' => 'Vireillä',
        'graveyard' => 'Hautuumaa',
        'my-maps' => 'Omat kartat',
    ],
    'genre' => [
        'any' => 'Mikä tahansa',
        'unspecified' => 'Määrittelemätön',
        'video-game' => 'Videopeli',
        'anime' => 'Anime',
        'rock' => 'Rock',
        'pop' => 'Pop',
        'other' => 'Muu',
        'novelty' => 'Epätavallinen',
        'hip-hop' => 'Hip Hop',
        'electronic' => 'Elektroninen',
    ],
    'mods' => [
        '4K' => '',
        '5K' => '',
        '6K' => '',
        '7K' => '',
        '8K' => '',
        '9K' => '',
        'AP' => '',
        'DT' => '',
        'EZ' => '',
        'FI' => '',
        'FL' => '',
        'HD' => '',
        'HR' => '',
        'HT' => '',
        'NC' => '',
        'NF' => '',
        'NM' => '',
        'PF' => '',
        'Relax' => '',
        'SD' => '',
        'SO' => '',
        'TD' => '',
    ],
    'language' => [
        'any' => '',
        'english' => 'Englanninkielinen',
        'chinese' => 'Kiinalainen',
        'french' => 'Ranskalainen',
        'german' => 'Saksalainen',
        'italian' => 'Italialainen',
        'japanese' => 'Japanilainen',
        'korean' => 'Korealainen',
        'spanish' => 'Espanjalainen',
        'swedish' => 'Ruotsalainen',
        'instrumental' => 'Instrumentaali',
        'other' => 'Muu',
    ],
    'played' => [
        'any' => 'Mikä tahansa',
        'played' => 'Pelattu',
        'unplayed' => 'Pelaamaton',
    ],
    'extra' => [
        'video' => 'Videollinen',
        'storyboard' => 'Sisältää kuvakäsikirjoituksen',
    ],
    'rank' => [
        'any' => 'Mikä tahansa',
        'XH' => 'Hopea SS',
        'X' => '',
        'SH' => 'Hopea S',
        'S' => '',
        'A' => '',
        'B' => '',
        'C' => '',
        'D' => '',
    ],
];
