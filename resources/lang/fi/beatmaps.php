<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'discussion-votes' => [
        'update' => [
            'error' => 'Äänen päivitys ei onnistunut',
        ],
    ],

    'discussions' => [
        'allow_kudosu' => 'salli kudosu',
        'beatmap_information' => 'Beatmap-sivu',
        'delete' => 'poista',
        'deleted' => 'Poistanut :editor :delete_time.',
        'deny_kudosu' => 'hylkää kudosu',
        'edit' => 'muokkaa',
        'edited' => 'Viimeksi muokannut :editor :update_time.',
        'guest' => '',
        'kudosu_denied' => 'Evätty saamasta kudosua.',
        'message_placeholder_deleted_beatmap' => 'Tämä vaikeustaso on poistettu, joten siitä ei voi enää keskustella.',
        'message_placeholder_locked' => 'Keskustelu tällä beatmapille on poistettu käytöstä.',
        'message_placeholder_silenced' => "Keskusteluun ei voi osallistua mykistettynä.",
        'message_type_select' => 'Valitse kommentin tyyppi',
        'reply_notice' => 'Vastaa painamalla enter-näppäintä.',
        'reply_placeholder' => 'Kirjoita vastauksesi tähän',
        'require-login' => 'Kirjaudu sisään lähettääksesi viestejä tai vastauksia',
        'resolved' => 'Ratkaistu',
        'restore' => 'palauta',
        'show_deleted' => 'Näytä poistetut',
        'title' => 'Keskustelut',

        'collapse' => [
            'all-collapse' => 'Sulje kaikki',
            'all-expand' => 'Avaa kaikki',
        ],

        'empty' => [
            'empty' => 'Keskustelut puuttuu!',
            'hidden' => 'Yksikään keskusteluista ei täsmää hakuehtoihisi.',
        ],

        'lock' => [
            'button' => [
                'lock' => 'Lukitse keskustelu',
                'unlock' => 'Avaa keskustelu',
            ],

            'prompt' => [
                'lock' => 'Syy lukitsemiseen',
                'unlock' => 'Avataanko varmasti?',
            ],
        ],

        'message_hint' => [
            'in_general' => 'Tämä viesti menee beatmapin yleiseen keskusteluun. Modataksesi tätä beatmappia, aloita viestisi aikaleimalla (esim. 00:12:345).',
            'in_timeline' => 'Modataksesi useampia aikaleimoja, lähetä useampi viesti (yksi viesti per aikaleima).',
        ],

        'message_placeholder' => [
            'general' => 'Kirjoita tähän lähettääksesi viestin Yleiseen (:version)',
            'generalAll' => 'Kirjoita tähän lähettääksesi viestin Yleiseen (Kaikki vaikeustasot)',
            'review' => 'Kirjoitä tähän lähettääksesi arvostelun',
            'timeline' => 'Kirjoita tähän lähettääksesi viestin Aikajanalle (:version)',
        ],

        'message_type' => [
            'disqualify' => 'Hylkää',
            'hype' => 'Hurraus!',
            'mapper_note' => 'Huomautus',
            'nomination_reset' => 'Nollaa Suositus',
            'praise' => 'Kehu',
            'problem' => 'Ongelma',
            'review' => 'Arvostelu',
            'suggestion' => 'Ehdotus',
        ],

        'mode' => [
            'events' => 'Historia',
            'general' => 'Yleinen :scope',
            'reviews' => 'Arvostelut',
            'timeline' => 'Aikajana',
            'scopes' => [
                'general' => 'Tämä vaikeustaso',
                'generalAll' => 'Kaikki vaikeustasot',
            ],
        ],

        'new' => [
            'pin' => 'Kiinnitä',
            'timestamp' => 'Aikaleima',
            'timestamp_missing' => 'Paina ctrl-c editointitilassa ja liitä viestiisi lisätäksesi aikaleiman!',
            'title' => 'Uusi keskustelu',
            'unpin' => 'Poista kiinnitys',
        ],

        'review' => [
            'new' => 'Uusi arvostelu',
            'embed' => [
                'delete' => 'Poista',
                'missing' => '[KESKUSTELU POISTETTU]',
                'unlink' => '',
                'unsaved' => '',
                'timestamp' => [
                    'all-diff' => '',
                    'diff' => '',
                ],
            ],
            'insert-block' => [
                'paragraph' => 'lisää kappale',
                'praise' => 'lisää ylistystä',
                'problem' => 'lisää ongelma',
                'suggestion' => 'lisää ehdotus',
            ],
        ],

        'show' => [
            'title' => ':title, luonut :mapper',
        ],

        'sort' => [
            'created_at' => 'Luomisaika',
            'timeline' => 'Aikajana',
            'updated_at' => 'Viimeisin päivitys',
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
            'approved' => 'Tämä beatmappi hyväksyttiiin :date!',
            'graveyard' => "Tätä beatmappia ei ole päivitetty sitten :date ja sen tekijä on todennäköisesti hylännyt sen...",
            'loved' => 'Tämä beatmap lisättiin Rakastettuihin :date!',
            'ranked' => 'Tämä beatmap hyväksyttiin :date!',
            'wip' => 'Huomaa: Tämän beatmapin tekijä on merkannut sen keskeneräiseksi.',
        ],

        'votes' => [
            'none' => [
                'down' => '',
                'up' => '',
            ],
            'latest' => [
                'down' => '',
                'up' => '',
            ],
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
        'delete' => 'Poista',
        'delete_own_confirm' => 'Oletko varma? Tämä beatmap poistetaan ja sinut uudelleenohjataan takaisin profiiliisi.',
        'delete_other_confirm' => 'Oletko varma? Tämä beatmap poistetaan ja sinut uudelleenohjataan käyttäjän profiiliin.',
        'disqualification_prompt' => 'Hylkäyksen syy?',
        'disqualified_at' => 'Hylättiin :time_ago sitten (:reason).',
        'disqualified_no_reason' => 'ei määriteltyä syytä',
        'disqualify' => 'Hylkää',
        'incorrect_state' => 'Virhe toiminnon suorittamisessa, kokeile päivittää sivu.',
        'love' => 'Rakasta',
        'love_confirm' => 'Rakasta tätä beatmappia?',
        'nominate' => 'Suosittele',
        'nominate_confirm' => 'Suosittele tätä beatmappia?',
        'nominated_by' => 'suositellut :users',
        'not_enough_hype' => "Ei ole riittävästi hypetystä.",
        'remove_from_loved' => 'Poista rakastetuista beatmapeista',
        'remove_from_loved_prompt' => 'Rakastetuista beatmapeista poistamisen syy:',
        'required_text' => 'Suositukset: :current/:required',
        'reset_message_deleted' => 'poistettu',
        'title' => 'Suositusten Tila',
        'unresolved_issues' => 'Vanhat ongelmat on ratkaistava ensin.',

        'rank_estimate' => [
            '_' => 'Tämän beatmapin arvioidaan tulla hyväksytyksi :date, jos mitään ongelmia ei löydy. Se on #:position :queue.',
            'queue' => 'hyväksytysjonossa',
            'soon' => 'pian',
        ],

        'reset_at' => [
            'nomination_reset' => 'Suositteluprosessi nollaantui :time_ago sitten käyttäjän :user uuden ongelman vuoksi :discussion (:message).',
            'disqualify' => 'Hyväksyminen peruuntui :time_ago sitten käyttäjän :user uuden ongelman vuoksi :discussion (:message).',
        ],

        'reset_confirm' => [
            'nomination_reset' => 'Oletko varma? Uuden ongelman lähettäminen kumoaa suositusprosessin.',
            'disqualify' => 'Oletko varma? Tämä poistaa beatmapin esihyväksytyistä ja kumoaa suositusprosessin.',
        ],
    ],

    'listing' => [
        'search' => [
            'prompt' => 'anna hakusana...',
            'login_required' => 'Kirjaudu sisään hakeaksesi.',
            'options' => 'Enemmän Hakuasetuksia',
            'supporter_filter' => 'Tunnisteella :filters rajaaminen vaatii aktiivisen osu!supporter-tagin',
            'not-found' => 'ei tuloksia',
            'not-found-quote' => '... mitään ei löytynyt.',
            'filters' => [
                'extra' => 'extra',
                'general' => 'Yleinen',
                'genre' => 'Tyylilaji',
                'language' => 'Kieli',
                'mode' => 'Pelitila',
                'nsfw' => '',
                'played' => 'Pelatut',
                'rank' => 'Luokitus',
                'status' => 'Luokat',
            ],
            'sorting' => [
                'title' => 'Nimi',
                'artist' => 'Esittäjä',
                'difficulty' => 'Vaikeustaso',
                'favourites' => 'Suosikit',
                'updated' => 'Päivitetty',
                'ranked' => 'Hyväksytty',
                'rating' => 'Luokitus',
                'plays' => 'Pelikerrat',
                'relevance' => 'Osuvuus',
                'nominations' => 'Äänestykset',
            ],
            'supporter_filter_quote' => [
                '_' => 'Rajataksesi tunnisteella :filters sinulla on oltava aktiivinen :link',
                'link_text' => 'osu!supporter-tagi',
            ],
        ],
    ],
    'general' => [
        'converts' => 'Sisällytä muunnetut beatmapit',
        'follows' => 'Tilatut kartoittajat',
        'recommended' => 'Suositeltu vaikeustaso',
    ],
    'mode' => [
        'all' => 'Kaikki',
        'any' => 'Kaikki',
        'osu' => '',
        'taiko' => '',
        'fruits' => '',
        'mania' => '',
    ],
    'status' => [
        'any' => 'Kaikki',
        'approved' => 'Vahvistettu',
        'favourites' => 'Suosikit',
        'graveyard' => 'Hautausmaa',
        'leaderboard' => 'Tulostaulukollinen',
        'loved' => 'Rakastettu',
        'mine' => 'Mappini',
        'pending' => 'Vireillä & WIP',
        'qualified' => 'Esihyväksytty',
        'ranked' => 'Hyväksytty',
    ],
    'genre' => [
        'any' => 'Kaikki',
        'unspecified' => 'Määrittelemätön',
        'video-game' => 'Videopeli',
        'anime' => 'Anime',
        'rock' => 'Rock',
        'pop' => 'Pop',
        'other' => 'Muu',
        'novelty' => 'Epätavallinen',
        'hip-hop' => 'Hip Hop',
        'electronic' => 'Elektroninen',
        'metal' => 'Metalli',
        'classical' => 'Klassinen',
        'folk' => 'Kansanmusiikki',
        'jazz' => 'Jatsi',
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
        'MR' => '',
        'NC' => '',
        'NF' => '',
        'NM' => '',
        'PF' => '',
        'RX' => '',
        'SD' => '',
        'SO' => '',
        'TD' => '',
        'V2' => 'Pisteytys V2',
    ],
    'language' => [
        'any' => 'Kaikki',
        'english' => 'englanti',
        'chinese' => 'kiina',
        'french' => 'ranska',
        'german' => 'saksa',
        'italian' => 'italia',
        'japanese' => 'japani',
        'korean' => 'korea',
        'spanish' => 'espanja',
        'swedish' => 'ruotsi',
        'russian' => 'Venäläinen',
        'polish' => 'Puolalainen',
        'instrumental' => 'Instrumentaalinen',
        'other' => 'Muu',
        'unspecified' => 'Täsmentämätön',
    ],

    'nsfw' => [
        'exclude' => 'Piilota',
        'include' => 'Näytä',
    ],

    'played' => [
        'any' => 'Kaikki',
        'played' => 'Pelatut',
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
    'panel' => [
        'playcount' => 'Pelikerrat :count',
        'favourites' => 'Suosikit :count',
    ],
    'variant' => [
        'mania' => [
            '4k' => '4K',
            '7k' => '7K',
            'all' => 'Kaikki',
        ],
    ],
];
