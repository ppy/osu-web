<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'edit' => [
        'title_compact' => 'asetukset',
        'username' => 'käyttäjänimi',

        'avatar' => [
            'title' => 'Avatar',
            'reset' => 'nollaa',
            'rules' => 'Pidäthän huolen, että profiilikuvasi noudattaa :link.<br/>Tämä tarkoittaa sitä, että sen on <strong>sovittava kaikenikäisille</strong>, eli ei alastomuutta tai muita hävyttömyyksiä.',
            'rules_link' => 'yhteisön sääntöjä',
        ],

        'email' => [
            'new' => 'uusi sähköpostiosoite',
            'new_confirmation' => 'sähköpostivahvistus',
            'title' => 'Sähköposti',
            'locked' => [
                '_' => 'Ota yhteyttä :accounts, jos sinun tarvitsee päivittää sähköpostiosoitteesi.',
                'accounts' => 'tilien tukiryhmään',
            ],
        ],

        'legacy_api' => [
            'api' => 'api',
            'irc' => 'irc',
            'title' => 'Vanha rajapinta',
        ],

        'password' => [
            'current' => 'nykyinen salasana',
            'new' => 'uusi salasana',
            'new_confirmation' => 'salasanan vahvistus',
            'title' => 'Salasana',
        ],

        'profile' => [
            'country' => 'maa',
            'title' => 'Profiili',

            'country_change' => [
                '_' => "Näyttää siltä, että tilisi maa ei ole sama kuin asuinmaasi. :update_link.",
                'update_link' => 'Aseta tilin maaksi :country',
            ],

            'user' => [
                'user_discord' => '',
                'user_from' => 'nykyinen sijainti',
                'user_interests' => 'kiinnostukset',
                'user_occ' => 'ammatti',
                'user_twitter' => '',
                'user_website' => 'verkkosivu',
            ],
        ],

        'signature' => [
            'title' => 'Allekirjoitus',
            'update' => 'päivitä',
        ],
    ],

    'github_user' => [
        'info' => "Jos osallistut osu!n kehitykseen, GitHub-tilin linkittäminen tässä yhdistää muutoslokin merkintäsi osu!-profiiliisi. GitHub-tilit, joilla ei ole osallistumishistoriaa osu!:n kanssa, ei voida linkittää.",
        'link' => 'Linkitä GitHub-tili',
        'title' => 'GitHub',
        'unlink' => 'Poista GitHub-tilin linkitys',

        'error' => [
            'already_linked' => 'Tämä GitHub-tili on jo linkitetty toiselle käyttäjälle.',
            'no_contribution' => 'GitHub-tiliä ei voi linkittää, jos sillä ei ole osallistumishistoriaa osu!:n tietovarastoihin.',
            'unverified_email' => 'Ole hyvä ja vahvista ensisijainen sähköpostiosoitteesi GitHubissa ja yritä sitten yhdistää tilisi uudelleen.',
        ],
    ],

    'notifications' => [
        'beatmapset_discussion_qualified_problem' => 'vastaanota ilmoituksia uusista ongelmista seuraavien pelimuotojen kelpuutetuissa rytmikartoissa',
        'beatmapset_disqualify' => 'vastaanota ilmoituksia, kun rytmikarttoja hylätään seuraavissa pelimuodoissa',
        'comment_reply' => 'vastaanota ilmoituksia vastauksista kommentteihisi',
        'news_post' => '',
        'title' => 'Ilmoitukset',
        'topic_auto_subscribe' => 'ota automaattisesti ilmoitukset käyttöön tekemillesi uusille foorumiaiheille',

        'options' => [
            '_' => 'toimitusvaihtoehdot',
            'beatmap_owner_change' => 'vieraileva vaikeustaso',
            'beatmapset:modding' => 'beatmapin modaus',
            'channel_message' => 'yksityisviestit',
            'channel_team' => 'tiimin yksityisviestit',
            'comment_new' => 'uudet kommentit',
            'forum_topic_reply' => 'aihevastaus',
            'mail' => 'posti',
            'mapping' => 'mappaaja',
            'news_post' => '',
            'push' => 'push',
        ],
    ],

    'oauth' => [
        'authorized_clients' => 'valtuutetut clientit',
        'own_clients' => 'omat clientit',
        'title' => 'OAuth',
    ],

    'options' => [
        'beatmapset_show_nsfw' => 'piilota varoitukset sopimattomasta sisällöstä beatmapeissa',
        'beatmapset_title_show_original' => 'näytä beatmappien metadata alkuperäisellä kielellä',
        'title' => 'Asetukset',

        'beatmapset_download' => [
            '_' => 'rytmikarttojen oletuslataustyyppi',
            'all' => 'videon kanssa jos saatavilla',
            'direct' => 'avaa osu!directissä',
            'no_video' => 'ilman videota',
        ],
    ],

    'playstyles' => [
        'keyboard' => 'näppäimistö',
        'mouse' => 'hiiri',
        'tablet' => 'piirtopöytä',
        'title' => 'Pelityylit',
        'touch' => 'kosketusnäyttö',
    ],

    'privacy' => [
        'friends_only' => 'estä yksityisviestit henkilöiltä jotka eivät ole kaverilistallasi',
        'hide_online' => 'piilota paikallaolotilasi',
        'hide_online_info' => '',
        'title' => 'Yksityisyys',
    ],

    'security' => [
        'current_session' => 'nykyinen',
        'end_session' => 'Sulje istunto',
        'end_session_confirmation' => 'Tämä lopettaa istuntosi välittömästi kyseisellä laitteella. Oletko varma?',
        'last_active' => 'Viimeksi aktiivisena:',
        'title' => 'Turvallisuus',
        'web_sessions' => 'aktiiviset istunnot',
    ],

    'update_email' => [
        'update' => 'päivitä',
    ],

    'update_password' => [
        'update' => 'päivitä',
    ],

    'user_totp' => [
        'title' => '',
        'usage_note' => '',

        'button' => [
            'remove' => '',
            'setup' => '',
        ],
        'status' => [
            'label' => '',
            'not_set' => '',
            'set' => '',
        ],
    ],

    'verification_completed' => [
        'text' => 'Tämän välilehden/ikkunan voi nyt sulkea',
        'title' => 'Vahvistaminen on valmis',
    ],

    'verification_invalid' => [
        'title' => 'Kelvoton tai vanhentunut vahvistuslinkki
',
    ],
];
