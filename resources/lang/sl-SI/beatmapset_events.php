<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'event' => [
        'approve' => 'Odobreno.',
        'beatmap_owner_change' => 'Lastništvo težavnosti :beatmap je prevzel :new_user.',
        'discussion_delete' => 'Moderator je odstranil razpravo :discussion.',
        'discussion_lock' => 'Razprava za to beatmapoje bila onemogočena. (:text)',
        'discussion_post_delete' => 'Moderator je odstranil objavo iz razprave :discussion.',
        'discussion_post_restore' => 'Moderator je povrnil objavo iz razprave :discussion.',
        'discussion_restore' => 'Moderator je povrnil razpravo :discussion.',
        'discussion_unlock' => 'Razprave za to beatmapo so omogočene.',
        'disqualify' => 'Diskvalficirano s strani :user. Razlog: :discussion (:text).',
        'disqualify_legacy' => 'Diskvalficirano s strani :user. Razlog: :text.',
        'genre_edit' => 'Žanr je bil spremenjen iz :old na :new.',
        'issue_reopen' => ':user je ponovno odprl rešeno težavo :discussion od :discussion_user.',
        'issue_resolve' => ':user je označil težavo :discussion igralca :discussion_user kot rešeno.',
        'kudosu_allow' => 'Zavrnitev Kudosu za razpravo :discussion je bila odstranjena.',
        'kudosu_deny' => 'Razprava :discussion je bila zavrnjena za kudosu.',
        'kudosu_gain' => 'Razprava :discussion igralca :user je pridobila dovoj glasov za kudosu.',
        'kudosu_lost' => 'Razprava :discussion igralca :user je izgubila glasove in odobreni kudosu je bil odstranjen.',
        'kudosu_recalculate' => 'Razprava :discussion je sprožila preračunavo kudosu odobritev.',
        'language_edit' => 'Jezik se je spremenil iz :old v :new.',
        'love' => 'Loved od :user.',
        'nominate' => 'Nominiral :user.',
        'nominate_modes' => 'Nominiral :user (:modes).',
        'nomination_reset' => 'Nova težava :discussion (:text) je sprožila ponastavitev nominacij.',
        'nomination_reset_received' => ':source_user je ponastavil nominacijo igralca :user (:text)',
        'nomination_reset_received_profile' => ':user je ponastavil nominacijo (:text)',
        'offset_edit' => 'Online zamik je spremenjen iz :old na :new.',
        'qualify' => 'Ta beatmapa je dosegla zahtevano število nominacij in se uvrstila med kvalificiranimi beatmapami.',
        'rank' => 'Rankirano.',
        'remove_from_loved' => ':user je odstranil beatmapo iz Loved. (:text)',

        'nsfw_toggle' => [
            'to_0' => 'Eksplicitna oznaka odstranjena',
            'to_1' => 'Označeno kot eksplicitna vsebina',
        ],
    ],

    'index' => [
        'title' => 'Beatmapset dogodki',

        'form' => [
            'period' => 'Obdobje',
            'types' => 'Tipi',
        ],
    ],

    'item' => [
        'content' => 'Vsebina',
        'discussion_deleted' => '[deleted]',
        'type' => 'Tip',
    ],

    'type' => [
        'approve' => 'Dovoljenje',
        'beatmap_owner_change' => 'Sprememba lastnikove težavnosti',
        'discussion_delete' => 'Odstranitev razprave',
        'discussion_post_delete' => 'Ostranitev odgovora na razpravo',
        'discussion_post_restore' => 'Povrnitev odgovora na razpravo',
        'discussion_restore' => 'Povrnitev razprave',
        'disqualify' => 'Diskvalifikacija',
        'genre_edit' => 'Urejanje žanra',
        'issue_reopen' => 'Ponovno odprtje razprave',
        'issue_resolve' => 'Reševanje razprave',
        'kudosu_allow' => 'Dovoljenje za kudosu točke',
        'kudosu_deny' => 'Zavrnitev kudosu točk',
        'kudosu_gain' => 'Pridobitev kudosu točk',
        'kudosu_lost' => 'Izguba kudosu točk',
        'kudosu_recalculate' => 'Preračun kudosu točk',
        'language_edit' => 'Urejanje jezika',
        'love' => 'Love',
        'nominate' => 'Nominacija',
        'nomination_reset' => 'Ponastavitev nominacij',
        'nomination_reset_received' => 'Prejeta ponastavitev nominacij',
        'nsfw_toggle' => 'Eksplicitna oznaka',
        'offset_edit' => 'Ureditev odmika',
        'qualify' => 'Kvalifikacija',
        'rank' => 'Rankiranje',
        'remove_from_loved' => 'Odstranitev loved beatmap',
    ],
];
