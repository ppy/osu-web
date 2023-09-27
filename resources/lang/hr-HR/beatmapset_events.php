<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'event' => [
        'approve' => 'Odobreno.',
        'beatmap_owner_change' => 'Titula vlasnika težine :beatmap je prebačena na :new_user.',
        'discussion_delete' => 'Moderator je izbrisao raspravu :discussion.',
        'discussion_lock' => 'Rasprava za ovu beatmapu je isključena. (:text)',
        'discussion_post_delete' => 'Moderator je izbrisao objavu iz rasprave :discussion. ',
        'discussion_post_restore' => 'Moderator je obnovio objavu iz rasprave :discussion.',
        'discussion_restore' => 'Moderator je obnovio raspravu :discussion.',
        'discussion_unlock' => 'Rasprava za ovu beatmapu je uključena.',
        'disqualify' => 'Diskvalificirano od :user. Razlog: :discussion (:text).',
        'disqualify_legacy' => 'Diskvalificirano od :user. Razlog: :text.',
        'genre_edit' => 'Žanr promijenjen iz :old u :new.',
        'issue_reopen' => 'Riješen problem :discussion od :discussion_user ponovno otvoreno od :user.',
        'issue_resolve' => 'Problem :discussion od :discussion_user je označen kao riješen od :user.',
        'kudosu_allow' => 'Kudosu zabrana za raspravu :discussion je uklonjena.',
        'kudosu_deny' => 'Rasprava :discussion zabranjena za kudosu.',
        'kudosu_gain' => 'Rasprava :discussion od :user je dobila dovoljno glasova za kudosu.',
        'kudosu_lost' => 'Rasprava :discussion od :user je izgubila glasove i dodijeljeni kudosu je uklonjen.',
        'kudosu_recalculate' => 'Rasprava :discussion je preračunala svoje kudosu potpore.',
        'language_edit' => 'Jezik promijenjen iz :old u :new.',
        'love' => 'Voljeno od :user.',
        'nominate' => 'Nominirano od :user.',
        'nominate_modes' => 'Nominirano od :user (:modes).',
        'nomination_reset' => 'Novi problem :discussion (:text) je pokrenuo resetiranje nominacije.',
        'nomination_reset_received' => 'Nominacija od :user je resetirana od :source_user (:text)',
        'nomination_reset_received_profile' => 'Nominacija je resetirana od :user (:text)',
        'offset_edit' => 'Online pomak je promijenjen iz :old u :new.',
        'qualify' => 'Ova beatmapa je dosegla potreban broj nominacija i kvalificirana je.',
        'rank' => 'Rangirano.',
        'remove_from_loved' => 'Uklonjeno iz Voljeno od :user. (:text)',
        'tags_edit' => '',

        'nsfw_toggle' => [
            'to_0' => 'Uklonjena eksplicitna oznaka',
            'to_1' => 'Označeno kao eksplicitno',
        ],
    ],

    'index' => [
        'title' => 'Događaji seta beatmapa',

        'form' => [
            'period' => 'Razdoblje',
            'types' => 'Vrste',
        ],
    ],

    'item' => [
        'content' => 'Sadržaj',
        'discussion_deleted' => '[izbrisano]',
        'type' => 'Vrsta',
    ],

    'type' => [
        'approve' => 'Odobrenje',
        'beatmap_owner_change' => 'Promjena vlasnika težine',
        'discussion_delete' => 'Rasprava izbrisana',
        'discussion_post_delete' => 'Brisanje odgovora na raspravi',
        'discussion_post_restore' => 'Obnavljanje odgovora na raspravi',
        'discussion_restore' => 'Obnova rasprave',
        'disqualify' => 'Diskvalifikacija',
        'genre_edit' => 'Promjena žanra',
        'issue_reopen' => 'Ponovno otvaranje rasprave',
        'issue_resolve' => 'Rješavanje rasprave',
        'kudosu_allow' => 'Kudosu džeparac',
        'kudosu_deny' => 'Poricanje kudosua',
        'kudosu_gain' => 'Kudosu dobit',
        'kudosu_lost' => 'Kudosu gubitak ',
        'kudosu_recalculate' => 'Kudosu preračunavanje',
        'language_edit' => 'Uređivanje jezika',
        'love' => 'Voli',
        'nominate' => 'Nominacija',
        'nomination_reset' => 'Resetiranje nominacije',
        'nomination_reset_received' => 'Reset nominacije primljen',
        'nsfw_toggle' => 'Eksplicitna oznaka',
        'offset_edit' => 'Uređivanje razmaka',
        'qualify' => 'Kvalifikacija',
        'rank' => 'Ljestvica',
        'remove_from_loved' => 'Uklanjanje iz Voljeno',
    ],
];
