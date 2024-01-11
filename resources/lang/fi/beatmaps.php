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
        'beatmap_information' => 'Rytmikarttasivu',
        'delete' => 'poista',
        'deleted' => 'Poistanut :editor :delete_time.',
        'deny_kudosu' => 'hylkää kudosu',
        'edit' => 'muokkaa',
        'edited' => 'Viimeksi muokannut :editor :update_time.',
        'guest' => 'Vieraileva vaikeustaso - :user',
        'kudosu_denied' => 'Evätty saamasta kudosua.',
        'message_placeholder_deleted_beatmap' => 'Tämä vaikeustaso on poistettu, joten siitä ei voi enää keskustella.',
        'message_placeholder_locked' => 'Tämän rytmikartan keskustelu on poistettu käytöstä.',
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
            'mapper_note' => 'Muistiinpano',
            'nomination_reset' => 'Nollaa Suositus',
            'praise' => 'Kehu',
            'problem' => 'Ongelma',
            'problem_warning' => 'Ilmoita ongelmasta',
            'review' => 'Arvostelu',
            'suggestion' => 'Ehdotus',
        ],

        'message_type_title' => [
            'disqualify' => 'Lähetä hylkäys',
            'hype' => 'Lähetä hurraus!',
            'mapper_note' => 'Lähetä merkintä',
            'nomination_reset' => 'Poista kaikki ehdollepanot',
            'praise' => 'Lähetä ylistys',
            'problem' => 'Lähetä ongelma',
            'problem_warning' => 'Lähetä ongelma',
            'review' => 'Lähetä arvostelu',
            'suggestion' => 'Lähetä ehdotus',
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
                'unlink' => 'Irrota',
                'unsaved' => 'Tallentamaton',
                'timestamp' => [
                    'all-diff' => 'Viestit "Kaikki vaikeustasot" -osiossa eivät voi olla aikaleimattuja.',
                    'diff' => 'Jos tämä :type alkaa aikaleimalla, se näytetään aikajanalla.',
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
            'title' => ':title, kartoittanut :mapper',
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
            'approved' => 'Tämä rytmikartta hyväksyttiiin :date!',
            'graveyard' => "Tätä beatmappia ei ole päivitetty sitten :date ja sen tekijä on todennäköisesti hylännyt sen...",
            'loved' => 'Tämä rytmikartta lisättiin rakastettuihin :date!',
            'ranked' => 'Tämä rytmikartta rankattiin :date!',
            'wip' => 'Huomaa: Tämän rytmikartan tekijä on merkannut sen keskeneräiseksi.',
        ],

        'votes' => [
            'none' => [
                'down' => 'Ei vielä vastaääniä',
                'up' => 'Ei vielä ääniä',
            ],
            'latest' => [
                'down' => 'Viimeisimmät vastaäänet',
                'up' => 'Viimeisimmät äänet',
            ],
        ],
    ],

    'hype' => [
        'button' => 'Hurraa Beatmappia!',
        'button_done' => 'Hurrasit Jo!',
        'confirm' => "Oletko varma? Tämä toiminto käyttää yhden jäljelläolevista hurrauspisteistä eikä se ole peruutettavissa. Hurrauksia jäljellä :n.",
        'explanation' => 'Hurraa tätä rytmikarttaa tuodaksesi sille näkyvyyttä ehdollepanoa ja rankkausta varten!',
        'explanation_guest' => 'Kirjaudu sisään ja hurraa tätä rytmikarttaa tuodaksesi sille näkyvyyttä ehdollepanoa ja rankkausta varten!',
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
        'already_nominated' => 'Olet jo pannut ehdolle tämän rytmikartan.',
        'cannot_nominate' => 'Et voi panna ehdolle tähän pelimuotoon kuuluvia rytmikarttoja.',
        'delete' => 'Poista',
        'delete_own_confirm' => 'Oletko varma? Tämä beatmap poistetaan ja sinut uudelleenohjataan takaisin profiiliisi.',
        'delete_other_confirm' => 'Oletko varma? Tämä beatmap poistetaan ja sinut uudelleenohjataan käyttäjän profiiliin.',
        'disqualification_prompt' => 'Hylkäyksen syy?',
        'disqualified_at' => 'Epäkelpuutettu :time_ago (:reason).',
        'disqualified_no_reason' => 'ei määriteltyä syytä',
        'disqualify' => 'Hylkää',
        'incorrect_state' => 'Virhe toiminnon suorittamisessa, kokeile päivittää sivu.',
        'love' => 'Rakasta',
        'love_choose' => 'Valitse rakastetun vaikeustaso',
        'love_confirm' => 'Rakasta tätä rytmikarttaa?',
        'nominate' => 'Suosittele',
        'nominate_confirm' => 'Ehdollepane tämä rytmikartta?',
        'nominated_by' => 'suositellut :users',
        'not_enough_hype' => "Ei ole riittävästi hurrauksia.",
        'remove_from_loved' => 'Poista rakastetuista rytmikartoista',
        'remove_from_loved_prompt' => 'Rakastetuista rytmikartoista poistamisen syy:',
        'required_text' => 'Suositukset: :current/:required',
        'reset_message_deleted' => 'poistettu',
        'title' => 'Suositusten Tila',
        'unresolved_issues' => 'Vanhat ongelmat on ratkaistava ensin.',

        'rank_estimate' => [
            '_' => 'Tämä kartta tulee arvion perusteella rankatuksi :date, jos ongelmia ei löydy. Se on :position. :queue.',
            'on' => ':date',
            'queue' => 'hyväksytysjonossa',
            'soon' => 'pian',
        ],

        'reset_at' => [
            'nomination_reset' => 'Suositteluprosessi nollaantui :time_ago sitten käyttäjän :user uuden ongelman vuoksi :discussion (:message).',
            'disqualify' => 'Hyväksyminen peruuntui :time_ago sitten käyttäjän :user uuden ongelman vuoksi :discussion (:message).',
        ],

        'reset_confirm' => [
            'disqualify' => 'Oletko varma? Tämä poistaa rytmikartan kelpuutetuista ja kumoaa ehdollepanoprosessin.',
            'nomination_reset' => 'Oletko varma? Uuden ongelman lähettäminen kumoaa suositusprosessin.',
            'problem_warning' => 'Oletko varma, että haluat ilmoittaa ongelmasta tässä rytmikartassa? Tämä aiheuttaa hälytyksen rytmikarttojen ehdollepanijoille.',
        ],
    ],

    'listing' => [
        'search' => [
            'prompt' => 'kirjoita hakusanoja...',
            'login_required' => 'Kirjaudu sisään hakeaksesi.',
            'options' => 'Lisää hakuvaihtoehtoja',
            'supporter_filter' => 'Tunnisteella :filters rajaaminen vaatii aktiivisen osu!supporter-tagin',
            'not-found' => 'ei tuloksia',
            'not-found-quote' => '... mitään ei löytynyt.',
            'filters' => [
                'extra' => 'Ekstra',
                'general' => 'Yleinen',
                'genre' => 'Tyylilaji',
                'language' => 'Kieli',
                'mode' => 'Pelimuoto',
                'nsfw' => 'Sopimaton sisältö',
                'played' => 'Pelattu',
                'rank' => 'Saavutettu arvosana',
                'status' => 'Luokat',
            ],
            'sorting' => [
                'title' => 'Nimi',
                'artist' => 'Esittäjä',
                'difficulty' => 'Vaikeustaso',
                'favourites' => 'Suosikit',
                'updated' => 'Päivitetty',
                'ranked' => 'Rankattu',
                'rating' => 'Luokitus',
                'plays' => 'Pelikerrat',
                'relevance' => 'Osuvuus',
                'nominations' => 'Äänestykset',
            ],
            'supporter_filter_quote' => [
                '_' => 'Rajataksesi tunnisteella :filters sinulla on oltava aktiivinen :link',
                'link_text' => 'osu!n tukijan merkki',
            ],
        ],
    ],
    'general' => [
        'converts' => 'Sisällytä automaattisesti muunnetut rytmikartat',
        'featured_artists' => 'Esitellyt artistit',
        'follows' => 'Tilatut kartoittajat',
        'recommended' => 'Suositeltu vaikeustaso',
        'spotlights' => 'Kohdevaloissa olevat rytmikartat',
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
        'mine' => 'Omat kartat',
        'pending' => 'Vireillä',
        'wip' => 'Työn alla',
        'qualified' => 'Kelpuutettu',
        'ranked' => 'Pisteytetty',
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
        'jazz' => 'Jazz',
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
        'russian' => 'venäjä',
        'polish' => 'puola',
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
        'XH' => 'Hopea-SS',
        'X' => '',
        'SH' => 'Hopea-S',
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
