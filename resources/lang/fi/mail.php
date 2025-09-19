<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'beatmapset_update_notice' => [
        'new' => 'Tiedoksesi vain, että ":title" on saanut uuden päivityksen poissaolosi aikana.',
        'subject' => 'Uusi päivitys rytmikarttaan ":title"',
        'unwatch' => 'Jos et enää halua seurata tätä rytmikarttaa, voit joko klikata "Lopeta seuraaminen" -linkkiä edellä mainitussa sivussa tai modausseurantalistassa:',
        'visit' => 'Voit katsoa keskustelua täällä:',
    ],

    'common' => [
        'closing' => 'Terveisin',
        'hello' => 'Hei :user,',
        'report' => 'Vastaa tähän sähköpostiin VÄLITTÖMÄSTI, jos et ole pyytänyt tätä muutosta.',
        'ignore' => 'Jos et pyytänyt tätä, voit turvallisesti jättää tämän sähköpostin huomioimatta.',
    ],

    'donation_thanks' => [
        'benefit_more' => 'Tukijoille on myös luvassa ajan myötä uusia lisäetuja!',
        'feedback' => "Jos sinulla on kysyttävää tai palautetta, älä epäröi vastata tähän sähköpostiin; Vastaan sinulle mahdollisimman pian!",
        'keep_free' => 'Sinunlaisien henkilöiden ansiosta osu! pystyy pitämään pelin ja yhteisön sujuvasti käynnissä ilman mainoksia tai pakollisia maksuja.',
        'keep_running' => 'Tukesi ansiosta osu! pysyy käynnissä noin :minutes! Se ei ehkä tunnu paljolta, mutta pienistä puroista syntyy suuri joki :).',
        'subject' => 'Kiitos, osu! <3 sinua',
        'translation' => 'Seuraava on yhteisön tuottama käännös tiedostusta varten:',

        'benefit' => [
            'gift' => 'Lahjasi saaneilla on nyt pääsy osu!direct:iin ja moniin muihin tukija-etuihin.',
            'self' => 'Saat nyt pääsyn osu!direct:iin ja moniin muihin tukija-etuihin :duration ajalle. ',
        ],

        'support' => [
            '_' => 'Kiitos paljon :support osu!:a kohtaan',
            'first' => 'tuestasi',
            'repeat' => 'jatkuneesta tuestasi',
        ],
    ],

    'forum_new_reply' => [
        'new' => 'Tiedoksesi vain, että ":title" on saanut uuden vastauksen poissaolosi aikana.',
        'subject' => '[osu!] Uusi vastaus aiheessa ":title"',
        'unwatch' => 'Jos et enää halua seurata tätä aihetta, voit napsauttaa "Lopeta aiheen seuraaminen" -linkkiä, joka löytyy ylhäällä olevan aiheen alareunasta tai aihe-tilausten hallintasivulta:',
        'visit' => 'Siirry suoraan viimeisimpään vastaukseen käyttämällä seuraavaa linkkiä:',
    ],

    'password_reset' => [
        'code' => 'Vahvistuskoodisi on:',
        'requested' => 'Joko sinä tai joku sinua esittävä, on pyytänyt salasanan nollausta osu! -tilillesi.',
        'subject' => 'osu! tilin palautus',
    ],

    'store_payment_completed' => [
        'prepare_shipping' => 'Olemme saaneet maksusi ja valmistelemme tilaustasi kuljetusta varten. Tilauksella saattaa kestää muutaman päivän lähettää, riippuen tilausten määrästä. Voit seurata tilauksesi edistymistä täällä, mukaan lukien seurantatiedot, jos saatavilla:',
        'processing' => 'Olemme vastaanottaneet maksusi ja käsittelemme tällä hetkellä tilaustasi. Voit seurata tilauksesi etenemistä täällä:',
        'questions' => "Jos sinulla on jotain kysyttävää, älä epäröi vastata tähän sähköpostiin.",
        'shipping' => 'Toimitetaan',
        'subject' => 'Vastaanotimme osu!kauppa-tilauksesi!',
        'thank_you' => 'Kiitos osu!kauppa-tilauksestasi!',
        'total' => 'Yhteensä',
    ],

    'supporter_gift' => [
        'anonymous_gift' => 'Henkilö, joka lahjoitti sinulle tämän tägin, voi halutessaan pysyä anonyyminä, joten heitä ei ole maininttu tässä ilmoituksessa.',
        'anonymous_gift_maybe_not' => 'Mutta tiedät todennäköisesti jo, kuka hän on ;).',
        'duration' => 'Kiitos hänen, sinulla on pääsy osu!directiin ja muihin osu!tukijaetuihin seuraavan :duration ajan.',
        'features' => 'Voit saada lisätietoja näistä ominaisuuksista täältä:',
        'gifted' => 'Joku on juuri lahjoittanut sinulle osu!tukijamerkin!',
        'gift_message' => 'Tämän merkin lahjoittanut henkilö jätti sinulle viestin:',
        'subject' => 'Sinulle on lahjoitettu osu!tukijamerkki!',
    ],

    'user_email_updated' => [
        'changed_to' => 'Tämä on vahvistussähköposti ilmoittaaksesi sinulle, että osu! -sähköpostiosoitteesi on muutettu osoitteeseen: ":email".',
        'check' => 'Varmista, että olet saanut tämän sähköpostin uuteen osoitteeseesi, jotta et menetä pääsyoikeutta osu!-tilillesi tulevaisuudessa.',
        'sent' => 'Turvallisuussyistä tämä sähköposti on lähetetty sekä uuteen että vanhaan sähköpostiosoitteeseesi.',
        'subject' => 'osu!-sähköpostin muutoksen vahvistaminen',
    ],

    'user_force_reactivation' => [
        'main' => 'Tilisi epäillään olevan joko kompromisoitu, sillä on ollut lähiaikoina epäilyttävää toimintaa, tai ERITTÄIN heikko salasana. Tämän seurauksena vaadimme, että asetat uuden salasanan. Varmista, että valitset TURVALLISEN salasanan.',
        'perform_reset' => 'Voit suorittaa nollauksen täällä :url',
        'reason' => 'Syy:',
        'subject' => 'osu!-tilin uudelleenaktivointia vaaditaan',
    ],

    'user_notification_digest' => [
        'new' => 'Tiedoksesi vain, että seuraamiisi aiheisiin on tullut uusia päivityksiä.',
        'settings' => 'Muuta sähköposti-ilmoitusten asetuksia:',
        'subject' => 'Uusia osu!-ilmoituksia',
    ],

    'user_password_updated' => [
        'confirmation' => 'Tämä on vain vahvistus siitä, että osu!-salasanasi on vaihdettu.',
        'subject' => 'osu!-salasanan muutoksen vahvistaminen',
    ],

    'user_verification' => [
        'code' => 'Vahvistuskoodisi on:',
        'code_hint' => 'Voit syöttää koodin välilyönneillä tai ilman niitä.',
        'link' => 'Vaihtoehtoisesti, voit myös suorittaa vahvistuksen loppuun alla olevasta linkistä:',
        'report' => 'Jos et ole pyytänyt tätä, ole hyvä ja VASTAA HETI, koska tilisi voi olla vaarassa.',
        'subject' => 'osu!-tilin vahvistaminen',

        'action_from' => [
            '_' => 'Tililläsi suoritettu toiminto maasta :country vaatii vahvistuksen.',
            'unknown_country' => 'tuntemattomasta maasta',
        ],
    ],
];
