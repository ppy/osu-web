<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'event' => [
        'approve' => 'Patvirtintas.',
        'beatmap_owner_change' => 'Sunkumo savininkas :beatmap buvo pakeistas į :new_user.',
        'discussion_delete' => 'Moderatorius ištrynė diskusija :discussion.',
        'discussion_lock' => 'Šio bitmapo diskusijos buvo išjungtos. (:text)',
        'discussion_post_delete' => 'Moderatorius ištrynė įrašą iš diskusijos :discussion.',
        'discussion_post_restore' => 'Moderatorius atkūrė įrašą tarp diskusijos :discussion.',
        'discussion_restore' => 'Moderatorius atkūrė diskusiją :discussion.',
        'discussion_unlock' => 'Šio bitmapo diskusijos buvo įjungtos.',
        'disqualify' => 'Diskvalifikavo :user. Priežastis: :discussion (:text).',
        'disqualify_legacy' => 'Diskvalifikavo :user. Priežastis: :text.',
        'genre_edit' => 'Žanras pakeistas iš :old į :new.',
        'issue_reopen' => 'Vartotojo :discussion_user Išspręstą problemą :discussion atidarė vėl :user.',
        'issue_resolve' => 'Problema :discussion iškėlė :discussion_user pažymėjo kaip išspręstą :user.',
        'kudosu_allow' => 'Kudosu atmetimas diskusijoje :discussion buvo pašalintas.',
        'kudosu_deny' => 'Diskusijai :discussion atmestas kudosu.',
        'kudosu_gain' => 'Vartotojo :user diskusija :discussion gavo pakankamai balsų dėl kudosu.',
        'kudosu_lost' => 'Vartotojo :user Diskusija :discussion dėl prarastų balsų, prarado kudosu.',
        'kudosu_recalculate' => 'Diskusijos :discussion kudosu kiekis perskaičiuotas.',
        'language_edit' => 'Kalba pakeista iš :old į :new.',
        'love' => 'Vartotojo :user mylimas.',
        'nominate' => 'Nominavo :user.',
        'nominate_modes' => 'Nominavo :user (:modes).',
        'nomination_reset' => 'Nauja problema :discussion (:text) iššaukė nominacijų atstatymą.',
        'nomination_reset_received' => 'Vartotojo :user nominaciją atstatė :source_user (:text)',
        'nomination_reset_received_profile' => 'Nominaciją atstatė :user (:text)',
        'offset_edit' => 'Tinklo poslinkis pakeistas iš :old į :new.',
        'qualify' => 'Šis bitmapas pasiekė reikiamą nominacijų skaičių ir buvo kvalifikuotas.',
        'rank' => 'Reitinguotas.',
        'remove_from_loved' => 'Pašalino iš mylimų :user. (:text)',
        'tags_edit' => '',

        'nsfw_toggle' => [
            'to_0' => 'Pašalinta Eksplicitinio žymė',
            'to_1' => 'Pažymėtas kaip eksplicitinis',
        ],
    ],

    'index' => [
        'title' => 'Bitmapų seto Įvykiai',

        'form' => [
            'period' => 'Laikotarpis',
            'types' => 'Tipai',
        ],
    ],

    'item' => [
        'content' => 'Turinys',
        'discussion_deleted' => '[deleted]',
        'type' => 'Tipas',
    ],

    'type' => [
        'approve' => 'Patvirtinimas',
        'beatmap_owner_change' => 'Sunkumo savininko pakeitimas',
        'discussion_delete' => 'Diskusijos ištrinimas',
        'discussion_post_delete' => 'Diskusijos atsakymo ištrynimas',
        'discussion_post_restore' => 'Diskusijos atsakymo atkūrimas',
        'discussion_restore' => 'Diskusijos atkūrimas',
        'disqualify' => 'Diskvalifikacija',
        'genre_edit' => 'Pakeisti žanrą',
        'issue_reopen' => 'Diskusija atidaroma',
        'issue_resolve' => 'Diskusija išspręndžiama',
        'kudosu_allow' => 'Kudosu įgaliojamas',
        'kudosu_deny' => 'Kudosu atmetimas',
        'kudosu_gain' => 'Kudosu gavimas',
        'kudosu_lost' => 'Kudosu praradimas',
        'kudosu_recalculate' => 'Kudosu perskaičiavimas',
        'language_edit' => 'Pakeisti kalbą',
        'love' => 'Mylimas',
        'nominate' => 'Nominacija',
        'nomination_reset' => 'Nominacijų atstatymas',
        'nomination_reset_received' => 'Nominacijos atstatymas gautas',
        'nsfw_toggle' => 'Eksplicitinio žymė',
        'offset_edit' => 'Poslinkio redagavimas',
        'qualify' => 'Kvalifikacija',
        'rank' => 'Reitingas',
        'remove_from_loved' => 'Pašalinimas iš mylimų',
    ],
];
