<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'event' => [
        'approve' => 'Vahvistettu.',
        'beatmap_owner_change' => 'Vaikeuden omistaja levelillä :beatmap muuttui käyttäjäksi :new_user.',
        'discussion_delete' => 'Moderaattori poisti keskustelun :discussion.',
        'discussion_lock' => 'Keskustelu tällä beatmapillä on poistettu käytöstä. (:text)',
        'discussion_post_delete' => 'Moderaattori poisti viestin keskustelusta :discussion.',
        'discussion_post_restore' => 'Moderaattori toi viestin takaisin keskusteluun :discussion.',
        'discussion_restore' => 'Moderaattori toi keskustelun :discussion takaisin.',
        'discussion_unlock' => 'Keskustelu tälle beatmapille on otettu käyttöön.',
        'disqualify' => 'Hyväksymisen keskeytti :user. Syy: :discussion (:text).',
        'disqualify_legacy' => ':user keskeytti hyväksymisen. Syy: :text.',
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
        'nomination_reset' => 'Uusi ongelma :discussion (:text) nollasi suositukset.',
        'nomination_reset_received' => 'Käyttäjän :user suosituksen oli nollannut :source_user (:text)',
        'nomination_reset_received_profile' => 'Suosituksen oli nollannut :user (:text)',
        'offset_edit' => 'Siirtymä verkossa oli :old ja muutettiin :new.',
        'qualify' => 'Tämä beatmap sai vaaditun määrän suosituksia hyväksymisvaihetta varten.',
        'rank' => 'Hyväksytty.',
        'remove_from_loved' => ':user poisti Rakastetuista. (:text)',
        'tags_edit' => 'Tunnisteet olivat ":old" ja muutettu nyt ":new".',

        'nsfw_toggle' => [
            'to_0' => 'Poistettiin sopimattoman sisällön merkki',
            'to_1' => 'Merkittiin sopimattomaksi sisällöksi',
        ],
    ],

    'index' => [
        'title' => 'Beatmapin Tapahtumat',

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
        'disqualify' => 'Epähyväksyntä',
        'genre_edit' => 'Genren muokkaus',
        'issue_reopen' => 'Keskustelun uudelleenavaaminen',
        'issue_resolve' => 'Keskustelun ratkaiseminen',
        'kudosu_allow' => 'Kusodun hyväksyntä',
        'kudosu_deny' => 'Kusodun kieltäminen',
        'kudosu_gain' => 'Kusodun ansaitseminen',
        'kudosu_lost' => 'Kusodun menettäminen',
        'kudosu_recalculate' => 'Kusodun uudelleenlaskenta',
        'language_edit' => 'Kielen muokkaus',
        'love' => 'Rakkaus',
        'nominate' => 'Äänestetty',
        'nomination_reset' => 'Äänestyksen resetointi',
        'nomination_reset_received' => 'Suosituksen nollaus vastaanotettu',
        'nsfw_toggle' => 'Sopimattoman sisällön merkki',
        'offset_edit' => 'Siirtymän muokkaus',
        'qualify' => 'Hyväksyntä',
        'rank' => 'Luokittelu',
        'remove_from_loved' => 'Rakastetun poisto',
    ],
];
