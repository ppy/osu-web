<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'event' => [
        'approve' => 'Hyväksytty.',
        'beatmap_owner_change' => 'Vaikeustason :beatmap omistaja vaihtui käyttäjäksi :new_user.',
        'discussion_delete' => 'Moderaattori poisti keskustelun :discussion.',
        'discussion_lock' => 'Tämän rytmikartan keskustelu on poistettu käytöstä. (:text)',
        'discussion_post_delete' => 'Moderaattori poisti viestin keskustelusta :discussion.',
        'discussion_post_restore' => 'Moderaattori toi viestin takaisin keskusteluun :discussion.',
        'discussion_restore' => 'Moderaattori toi keskustelun :discussion takaisin.',
        'discussion_unlock' => 'Tämän rytmikartan keskustelu on otettu käyttöön.',
        'disqualify' => ':user hylkäsi. Syy: :discussion (:text).',
        'disqualify_legacy' => ':user hylkäsi. Syy: :text.',
        'genre_edit' => 'Genre :old muutettu genreen :new.',
        'issue_reopen' => 'Ratkaistu ongelma :discussion uudelleenavattu.',
        'issue_resolve' => 'Ongelma :discussion merkitty ratkaistuksi.',
        'kudosu_allow' => 'Kudosuhylkäys keskustelusta :discussion on poistettu.',
        'kudosu_deny' => 'Keskustelusta :discussion hylättiin kudosu.',
        'kudosu_gain' => 'Keskustelu :discussion käyttäjältä :user sai tarpeeksi ääniä kudosua varten.',
        'kudosu_lost' => 'Keskustelu :discussion käyttäjältä :user menetti ääniä ja annettu kudosu on poistettu.',
        'kudosu_recalculate' => 'Keskustelun :discussion kudosu on uudelleenlaskettu.',
        'language_edit' => 'Kieli :old muutettu kieleen :new.',
        'love' => ':user rakastaa',
        'nominate' => 'Käyttäjän :user suosittelema.',
        'nominate_modes' => 'Käyttäjän :user suosittelema (:modes).',
        'nomination_reset' => 'Uusi ongelma :discussion (:text) aiheutti ehdollepanojen nollauksen.',
        'nomination_reset_received' => ':source_user nollasi käyttäjän :user ehdollepanon (:text)',
        'nomination_reset_received_profile' => ':user nollasi ehdollepanon (:text)',
        'offset_edit' => 'Vastapaino verkossa oli :old ja vaihtui :new.',
        'qualify' => 'Tämä rytmikartta on saanut tarvittavan määrän ehdollepanoja ja on kelpuutettu.',
        'rank' => 'Hyväksytty.',
        'remove_from_loved' => ':user poisti Rakastetuista. (:text)',
        'tags_edit' => 'Tunnisteet olivat ":old" ja muutettu nyt ":new".',

        'nsfw_toggle' => [
            'to_0' => 'Poistettiin sopimattoman sisällön merkki',
            'to_1' => 'Merkitty sopimattomaksi sisällöksi',
        ],
    ],

    'index' => [
        'title' => 'Rytmikarttasetin tapahtumat',

        'form' => [
            'period' => 'Piste',
            'types' => 'Tyypit',
        ],
    ],

    'item' => [
        'content' => 'Sisältö',
        'discussion_deleted' => '[poistettu]',
        'type' => 'Tyyppi',
    ],

    'type' => [
        'approve' => 'Hyväksyntä',
        'beatmap_owner_change' => 'Vaikeustason omistajan muutos',
        'discussion_delete' => 'Poista keskustelu',
        'discussion_post_delete' => 'Keskustelun vastauksen poistaminen',
        'discussion_post_restore' => 'Keskustelun vastauksen palautus',
        'discussion_restore' => 'Keskustelun palauttaminen',
        'disqualify' => 'Hylkäys',
        'genre_edit' => 'Genren muokkaus',
        'issue_reopen' => 'Keskustelun uudelleenavaaminen',
        'issue_resolve' => 'Keskustelun ratkaiseminen',
        'kudosu_allow' => 'Kudosun hyväksyntä',
        'kudosu_deny' => 'Kudosun kieltäminen',
        'kudosu_gain' => 'Kusodun ansaitseminen',
        'kudosu_lost' => 'Kusodun menettäminen',
        'kudosu_recalculate' => 'Kusodun uudelleenlaskenta',
        'language_edit' => 'Kielen muokkaus',
        'love' => 'Rakkaus',
        'nominate' => 'Ehdollepano',
        'nomination_reset' => 'Äänestyksen resetointi',
        'nomination_reset_received' => 'Ehdollepanon nollaus vastaanotettu',
        'nsfw_toggle' => 'Sopimattoman sisällön merkki',
        'offset_edit' => 'Vastapainon muokkaus',
        'qualify' => 'Kelpuuttaminen',
        'rank' => 'Luokittelu',
        'remove_from_loved' => 'Rakastetun poisto',
    ],
];
