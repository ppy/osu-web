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
        'deny_kudosu' => 'hylkää kudosu',
        'edit' => 'muokkaa',
        'edited' => 'Viimeksi muokannut :editor :update_time.',
        'kudosu_denied' => 'Evätty saamasta kudosua.',
        'message_placeholder_deleted_beatmap' => 'Tämä vaikeustaso on poistettu, joten siitä ei voi enää keskustella.',
        'message_type_select' => 'Valitse kommentin tyyppi',
        'reply_notice' => 'Vastaa painamalla enter-näppäintä.',
        'reply_placeholder' => 'Kirjoita vastauksesi tähän',
        'require-login' => 'Kirjaudu sisään lähettääksesi viestejä tai vastauksia',
        'resolved' => 'Ratkaistu',
        'restore' => 'palauta',
        'title' => 'Keskustelut',

        'collapse' => [
            'all-collapse' => 'Sulje kaikki',
            'all-expand' => 'Avaa kaikki',
        ],

        'empty' => [
            'empty' => 'Keskustelut puuttuu!',
            'hidden' => 'Mikään keskustelu ei vastaa valittua suodatinta.',
        ],

        'message_hint' => [
            'in_general' => 'Tämä viesti menee beatmapin yleiseen keskusteluun. Modataksesi tätä beatmappia, aloita viestisi aikaleimalla (esim. 00:12:345).',
            'in_timeline' => 'Modataksesi useampia aikaleimoja, lähetä useampi viesti (yksi viesti per aikaleima).',
        ],

        'message_placeholder' => [
            'general' => 'Kirjoita tähän lähettääksesi viestin Yleiseen (:version)',
            'generalAll' => 'Kirjoita tähän lähettääksesi viestin Yleiseen (Kaikki vaikeustasot)',
            'timeline' => 'Kirjoita tähän lähettääksesi viestin Aikajanalle (:version)',
        ],

        'message_type' => [
            'disqualify' => 'Hylkää',
            'hype' => 'Hurraus!',
            'mapper_note' => 'Huomautus',
            'nomination_reset' => 'Nollaa Suositus',
            'praise' => 'Kehu',
            'problem' => 'Ongelma',
            'suggestion' => 'Ehdotus',
        ],

        'mode' => [
            'events' => 'Historia',
            'general' => 'Yleinen :scope',
            'timeline' => 'Aikajana',
            'scopes' => [
                'general' => 'Tämä vaikeustaso',
                'generalAll' => 'Kaikki vaikeusasteet',
            ],
        ],

        'new' => [
            'timestamp' => 'Aikaleima',
            'timestamp_missing' => 'Paina ctrl-c editointitilassa ja liitä viestiisi lisätäksesi aikaleiman!',
            'title' => 'Uusi keskustelu',
        ],

        'show' => [
            'title' => ':title, luonut :mapper',
        ],

        'sort' => [
            '_' => 'Lajiteltu:',
            'created_at' => 'luontiaika',
            'timeline' => 'aikajana',
            'updated_at' => 'viimeisin päivitys',
        ],

        'stats' => [
            'deleted' => 'Poistettu',
            'mapper_notes' => 'Huomautukset',
            'mine' => 'Omat',
            'pending' => 'Vireillä',
            'praises' => 'Kehut',
            'resolved' => 'Ratkaistu',
            'total' => 'Kaikki',
        ],

        'status-messages' => [
            'approved' => 'Tämä rytmikartta hyväksyttiiin :date!',
            'graveyard' => "Tätä beatmappia ei ole päivitetty sitten :date ja sen tekijä on todennäköisesti hyljännyt sen...",
            'loved' => 'Tämä beatmap lisättiin Rakastettuihin :date!',
            'ranked' => 'Tämä rytmikartta hyväksyttiin :date!',
            'wip' => 'Huomaa: Tämän beatmapin tekijä on merkannut sen keskeneräiseksi.',
        ],

    ],

    'hype' => [
        'button' => 'Hurraa Beatmappia!',
        'button_done' => 'Hurrasit Jo!',
        'confirm' => "Oletko varma? Tämä toiminto käyttää yhden jäljelläolevista hurrauspisteistä eikä se ole peruutettavissa. Hurrauksia jäljellä :n.",
        'explanation' => 'Hurraa tätä beatmappia tuodaksesi sille näkyvyyttä suositusta- ja hyväksymistä varten!',
        'explanation_guest' => 'Kirjaudu sisään ja hurraa tätä beatmappia tuodaksesi sille näkyvyyttä suositusta- ja hyväksymistä varten!',
        'new_time' => "Saat uuden hurrauksen :new_time.",
        'remaining' => 'Sinulla on :remaining hurrausta jäljellä.',
        'required_text' => 'Hurraukset: :current/:required',
        'section_title' => 'Hurrausjuna',
        'title' => 'Hurraukset',
    ],

    'feedback' => [
        'button' => 'Jätä Palautetta',
    ],

    'nominations' => [
        'disqualification_prompt' => 'Syy hylkäykseen?',
        'disqualified_at' => 'Hyväksyminen peruuntui :time_ago (:reason).',
        'disqualified_no_reason' => 'ei määriteltyä syytä',
        'disqualify' => 'Hylkää',
        'incorrect_state' => 'Virhe suorittaessa toimintaa, kokeile ladata sivu uudelleen.',
        'love' => '',
        'love_confirm' => '',
        'nominate' => 'Suosittele',
        'nominate_confirm' => 'Suosittele tätä beatmappia?',
        'nominated_by' => 'suositellut :users',
        'qualified' => 'Arvioidaan hyväksyttävän :date, mikäli mitään ongelmia ei löydy.',
        'qualified_soon' => 'Arvioidaan hyväksyttävän pian, mikäli mitään ongelmia ei löydy.',
        'required_text' => 'Suositukset: :current/:required',
        'reset_message_deleted' => 'poistettu',
        'title' => 'Suositusten Tila',
        'unresolved_issues' => 'On edelleen olemassa ongelmia, jotka pitää käsitellä.',

        'reset_at' => [
            'nomination_reset' => 'Suositusprosessi nollaantui :time_ago käyttäjän :user toimesta uudella ongelmalla :discussion (:message).',
            'disqualify' => 'Hyväksyminen peruuntui :time_ago käyttäjän :user toimesta uudella ongelman takia :discussion (:message).',
        ],

        'reset_confirm' => [
            'nomination_reset' => 'Oletko varma? Uuden ongelman lähettäminen kumoaa suositusprosessin.',
        ],
    ],

    'listing' => [
        'search' => [
            'prompt' => 'anna hakusana...',
            'login_required' => '',
            'options' => 'Lisää Haku-asetuksia',
            'supporter_filter' => '',
            'not-found' => 'ei tuloksia',
            'not-found-quote' => '... Eip, mitään ei löytynyt.',
            'filters' => [
                'general' => 'Yleinen',
                'mode' => 'Pelitila',
                'status' => '',
                'genre' => 'Tyylilaji',
                'language' => 'Kieli',
                'extra' => 'extra',
                'rank' => 'Luokitus',
                'played' => 'Pelattu',
            ],
            'sorting' => [
                'title' => 'nimi',
                'artist' => 'artisti',
                'difficulty' => 'vaikeustaso',
                'updated' => 'päivitetty',
                'ranked' => 'hyväksytty',
                'rating' => 'arvosana',
                'plays' => 'pelaukset',
                'relevance' => 'osuvuus',
                'nominations' => 'suositukset',
            ],
            'supporter_filter_quote' => [
                '_' => 'Tunnisteen :filters rajaamiseksi on oltava aktiivinen :link',
                'link_text' => '',
            ],
        ],
    ],
    'general' => [
        'recommended' => 'Suositeltu vaikeustaso',
        'converts' => 'Sisällä konvertoidut beatmapit',
    ],
    'mode' => [
        'any' => 'Kaikki',
        'osu' => '',
        'taiko' => '',
        'fruits' => '',
        'mania' => '',
    ],
    'status' => [
        'any' => 'Kaikki',
        'ranked-approved' => 'Hyväksytyt & Vahvistetut',
        'approved' => 'Vahvistettu',
        'qualified' => 'Esihyväksytty',
        'loved' => 'Rakastettu',
        'faves' => 'Suosikit',
        'pending' => '',
        'graveyard' => 'Hautausmaa',
        'my-maps' => 'Omat kartat',
    ],
    'genre' => [
        'any' => 'Kaikki',
        'unspecified' => 'Määrittelemättömät',
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
        'english' => 'Englanti',
        'chinese' => 'Kiina',
        'french' => 'Ranska',
        'german' => 'Saksa',
        'italian' => 'Italia',
        'japanese' => 'Japani',
        'korean' => 'Korea',
        'spanish' => 'Espanja',
        'swedish' => 'Ruotsi',
        'instrumental' => 'Instrumentaalinen',
        'other' => 'Muu',
    ],
    'played' => [
        'any' => 'Kaikki',
        'played' => 'Pelattu',
        'unplayed' => 'Pelaamaton',
    ],
    'extra' => [
        'video' => 'Videollinen',
        'storyboard' => 'Sisältää visuaalisen taustaesityksen',
    ],
    'rank' => [
        'any' => 'Kaikki',
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
