<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'invalid_ruleset' => '',

    'change_owner' => [
        'too_many' => '',
    ],

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
        'guest' => 'Vieraileva vaikeustaso - :user',
        'kudosu_denied' => 'Evätty saamasta kudosua.',
        'message_placeholder_deleted_beatmap' => 'Tämä vaikeustaso on poistettu, joten siitä ei voi enää keskustella.',
        'message_placeholder_locked' => 'Keskustelu tälle beatmapille on poistettu käytöstä.',
        'message_placeholder_silenced' => "Keskusteluun ei voi osallistua mykistettynä.",
        'message_type_select' => 'Valitse kommentin tyyppi',
        'reply_notice' => 'Vastaa painamalla enter-näppäintä.',
        'reply_resolve_notice' => 'Paina enteriä vastataksesi. Paina ctrl+enteriä vastataksesi ja ratkaistaksesi.',
        'reply_placeholder' => 'Kirjoita vastauksesi tähän',
        'require-login' => 'Kirjaudu sisään lähettääksesi viestejä tai vastauksia',
        'resolved' => 'Ratkaistu',
        'restore' => 'palauta',
        'show_deleted' => 'Näytä poistetut',
        'title' => 'Keskustelut',
        'unresolved_count' => ':count_delimited ratkaisematon ongelma|:count_delimited ratkaisematonta ongelmaa',

        'collapse' => [
            'all-collapse' => 'Sulje kaikki',
            'all-expand' => 'Avaa kaikki',
        ],

        'empty' => [
            'empty' => 'Ei vielä keskusteluja!',
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
            'in_general' => 'Tämä viesti menee rytmikarttasetin yleiseen keskusteluun. Modataksesi tätä rytmikarttaa, aloita viestisi aikaleimalla (esim. 00:12:345).',
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
            'nomination_reset' => 'Nollaa ehdollepano',
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
                    'diff' => 'Jos tämä viesti alkaa aikaleimalla, se näytetään aikajanalla.',
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
            'title' => ':title, kartoittanut: :mapper',
        ],

        'sort' => [
            'created_at' => 'Luomisaika',
            'timeline' => 'Aikajana',
            'updated_at' => 'Viimeisin päivitys',
        ],

        'stats' => [
            'deleted' => 'Poistettu',
            'mapper_notes' => 'Muistiinpanot',
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
            'ranked' => 'Tämä beatmap hyväksyttiin :date!',
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
        'button' => 'Hurraa rytmikarttaa!',
        'button_done' => 'Olet jo hurrannut!',
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
        'button' => 'Jätä palautetta',
    ],

    'nominations' => [
        'already_nominated' => 'Olet jo asettanut ehdolle tämän rytmikartan.',
        'cannot_nominate' => 'Et voi asettaa ehdolle tähän pelimuotoon kuuluvia rytmikarttoja.',
        'delete' => 'Poista',
        'delete_own_confirm' => 'Oletko varma? Rytmikartta poistetaan ja sinut uudelleenohjataan takaisin profiiliisi.',
        'delete_other_confirm' => 'Oletko varma? Rytmikartta poistetaan ja sinut uudelleenohjataan takaisin käyttäjän profiiliin.',
        'disqualification_prompt' => 'Hylkäyksen syy?',
        'disqualified_at' => 'Hylätty :time_ago (:reason).',
        'disqualified_no_reason' => 'ei määriteltyä syytä',
        'disqualify' => 'Hylkää',
        'incorrect_state' => 'Virhe toiminnon suorittamisessa, kokeile päivittää sivu.',
        'love' => 'Rakasta',
        'love_choose' => 'Valitse rakastetun vaikeustaso',
        'love_confirm' => 'Rakasta tätä rytmikarttaa?',
        'nominate' => 'Aseta ehdolle',
        'nominate_confirm' => 'Aseta tämä rytmikartta ehdolle?',
        'nominated_by' => 'ehdollepannut :users',
        'not_enough_hype' => "Hurrausta ei ole riittävästi.",
        'remove_from_loved' => 'Poista rakastetuista rytmikartoista',
        'remove_from_loved_prompt' => 'Rakastetuista rytmikartoista poistamisen syy:',
        'required_text' => 'Ehdollepanot: :current/:required',
        'reset_message_deleted' => 'poistettu',
        'title' => 'Ehdollepanojen tilanne',
        'unresolved_issues' => 'On edelleen ratkaisemattomia ongelmia, jotka pitää käsitellä ensin.',

        'rank_estimate' => [
            '_' => 'Tämä kartta tulee arviolta rankatuksi :date, jos ongelmia ei löydy. Se on :position. :queue.',
            'unresolved_problems' => 'Tämä kartta on tällä hetkellä estetty poistumasta kelpuutettujen osiosta, kunnes :problems on ratkaistu.',
            'problems' => 'nämä ongelmat',
            'on' => ':date',
            'queue' => 'rankkausjonossa',
            'soon' => 'pian',
        ],

        'reset_at' => [
            'nomination_reset' => 'Ehdollepanoprosessi nollattu :time_ago käyttäjän :user uuden ongelman :discussion vuoksi (:message).',
            'disqualify' => 'Hylätty :time_ago käyttäjän :user uuden ongelman :discussion vuoksi (:message).',
        ],

        'reset_confirm' => [
            'disqualify' => 'Oletko varma? Tämä poistaa rytmikartan kelpuutetuista ja nollaa ehdollepanoprosessin.',
            'nomination_reset' => 'Oletko varma? Uuden ongelman lähettäminen nollaa ehdollepanoprosessin.',
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
                'artist' => 'Artisti',
                'difficulty' => 'Vaikeustaso',
                'favourites' => 'Suosikit',
                'updated' => 'Päivitetty',
                'ranked' => 'Rankattu',
                'rating' => 'Luokitus',
                'plays' => 'Pelikerrat',
                'relevance' => 'Osuvuus',
                'nominations' => 'Ehdollepanot',
            ],
            'supporter_filter_quote' => [
                '_' => 'Rajataksesi tunnisteella :filters sinulla on oltava aktiivinen :link',
                'link_text' => 'osu!tukijamerkki',
            ],
        ],
    ],
    'general' => [
        'converts' => 'Sisällytä automaattisesti muunnetut rytmikartat',
        'featured_artists' => 'Esitellyt artistit',
        'follows' => 'Tilatut kartoittajat',
        'recommended' => 'Suositeltu vaikeustaso',
        'spotlights' => 'Rytmikartat kohdevaloissa',
    ],
    'mode' => [
        'all' => 'Kaikki',
        'any' => 'Kaikki',
        'osu' => '',
        'taiko' => '',
        'fruits' => '',
        'mania' => '',
        'undefined' => 'ei määritetty',
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
        'ranked' => 'Rankattu',
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
        'unspecified' => 'Määrittelemätön',
    ],

    'nsfw' => [
        'exclude' => 'Piilota',
        'include' => 'Näytä',
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
        'playcount' => ':count Pelikertaa',
        'favourites' => ':count Suosikkia',
    ],
    'variant' => [
        'mania' => [
            '4k' => '4K',
            '7k' => '7K',
            'all' => 'Kaikki',
        ],
    ],
];
