<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'event' => [
        'approve' => 'Apstiprināts.',
        'beatmap_owner_change' => 'Grūtības :beatmap īpašnieks nomainīts uz :new_user.',
        'discussion_delete' => 'Moderators izdzēsa diskusiju :discussion.',
        'discussion_lock' => 'Diskusija par šo bītmapi ir atspējota. (:text)',
        'discussion_post_delete' => 'Moderators izdzēsa rakstu no diskusijas :discussion.',
        'discussion_post_restore' => 'Moderators atjaunoja rakstu no diskusijas :discussion.',
        'discussion_restore' => 'Moderators atjaunoja diskusiju :discussion.',
        'discussion_unlock' => 'Diskusija par šo bītmapi ir iespējota.',
        'disqualify' => 'Diskvalificēja: :user. Iemesls: :discussion (:text).',
        'disqualify_legacy' => 'Diskvalificēja: :user. Iemesls: :text.',
        'genre_edit' => 'Žanrs mainīts no :old uz :new.',
        'issue_reopen' => ':discussion_user atrisināja problēmu :discussion, un atkātoti atvēra :user.',
        'issue_resolve' => ':discussion_user izveidoto :discussion atzīmēja kā atrisinātu :user.',
        'kudosu_allow' => 'Kudosu noliegums diskusijai :discussion ir noņemts.',
        'kudosu_deny' => 'Diskusija :discussion ir noliegta priekš kudosu.',
        'kudosu_gain' => ':user veidotā diskusija :discussion ieguva pietiekami daudz balsu priekš kudosu.',
        'kudosu_lost' => ':user veidotā diskusija :discussion zaudēja balsis un piešķirtais kudosu ir noņemts.',
        'kudosu_recalculate' => 'Diskusijai :discussion tika veikta tās kudosu piešķiršanas pārrēķināšana.',
        'language_edit' => 'Valoda mainīta no :old uz :new.',
        'love' => 'Loved piešķīra :user.',
        'nominate' => 'Nominēja :user.',
        'nominate_modes' => 'Nominēja :user (:modes).',
        'nomination_reset' => 'Jauna problēma :discussion (:text) izraisīja nominācijas atiestatīšanu.',
        'nomination_reset_received' => ':user nomināciju atsauca :source_user (:text)',
        'nomination_reset_received_profile' => 'Nomināciju atsauca :user (:text)',
        'offset_edit' => 'Tiešaistes ofsets mainīts no :old uz :new.',
        'qualify' => 'Šī bītmape ir sasniegusi nepieciešamo nomināciju skaitu un ir kvalificēta.',
        'rank' => 'Pieņemts.',
        'remove_from_loved' => 'Noņēma no Loved lietotājs :user. (:text)',
        'tags_edit' => '',

        'nsfw_toggle' => [
            'to_0' => 'Nepiemērota satura atzīme noņemta',
            'to_1' => 'Atzīmēts kā nepiemērota satura',
        ],
    ],

    'index' => [
        'title' => 'Bītkaršu kopas Notikumi',

        'form' => [
            'period' => 'Periods',
            'types' => 'Tipi',
        ],
    ],

    'item' => [
        'content' => 'Saturs',
        'discussion_deleted' => '[dzēsts]',
        'type' => 'Tips',
    ],

    'type' => [
        'approve' => 'Apstiprinājums',
        'beatmap_owner_change' => 'Grūtības īpašnieka maiņa',
        'discussion_delete' => 'Diskusijas dzēšana',
        'discussion_post_delete' => 'Diskusijas atbildes dzēšana',
        'discussion_post_restore' => 'Diskusijas atbildes atjaunošana',
        'discussion_restore' => 'Diskusijas atjaunošana',
        'disqualify' => 'Diskvalifikācija',
        'genre_edit' => 'Žanra rediģēšana',
        'issue_reopen' => 'Diskusijas atkārtota atvēršana',
        'issue_resolve' => 'Diskusijas atrisināšana',
        'kudosu_allow' => 'Kudosu atļauja',
        'kudosu_deny' => 'Kudosu noliegums',
        'kudosu_gain' => 'Iegūtie Kudosu',
        'kudosu_lost' => 'Kudosu zaudējums',
        'kudosu_recalculate' => 'Kudosu pārrēķināšana',
        'language_edit' => 'Valodas rediģēšana',
        'love' => 'Love',
        'nominate' => 'Nominācija',
        'nomination_reset' => 'Nominācijas attiestatīšana',
        'nomination_reset_received' => 'Nominācijas attiestatīšana saņemta',
        'nsfw_toggle' => 'Nepiemērota satura atzīme',
        'offset_edit' => 'Nobīdes rediģēšana',
        'qualify' => 'Kvalifikācija',
        'rank' => 'Ierindojums',
        'remove_from_loved' => 'Loved noņemšana',
    ],
];
