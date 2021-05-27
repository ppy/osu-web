<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'event' => [
        'approve' => 'Godkänd.',
        'beatmap_owner_change' => '',
        'discussion_delete' => 'Moderator raderade diskussion :discussion.',
        'discussion_lock' => 'Diskussioner för denna beatmap har inaktiverats. (:text)',
        'discussion_post_delete' => 'Moderator raderade inlägg från diskussionen :discussion.',
        'discussion_post_restore' => 'Moderator återställde inlägg från diskussionen :discussion.',
        'discussion_restore' => 'Moderator återställde diskussionen :discussion.',
        'discussion_unlock' => 'Diskussioner för denna beatmap har aktiverats.',
        'disqualify' => 'Diskvalificerad av :user. Anledning: :discussion (:text).',
        'disqualify_legacy' => 'Diskvalificerad av :user. Anledning: :text.',
        'genre_edit' => 'Genre ändrad från :old till :new.',
        'issue_reopen' => 'Löst problem :discussion öppnat igen.',
        'issue_resolve' => 'Problem :discussion markerat som löst.',
        'kudosu_allow' => 'Kudosu nekning för diskussion :discussion har tagits bort.',
        'kudosu_deny' => 'Diskussionen :discussion nekad för kudosu.',
        'kudosu_gain' => 'Diskussionen :discussion av :user skaffade sig tillräckligt många röster för kudosu.',
        'kudosu_lost' => 'Diskussionen :discussion av :user förlorade röster och tillåten kudosu har tagits bort.',
        'kudosu_recalculate' => 'Diskussionen :discussion har fått sina tillåtna kudosu omberäknade.',
        'language_edit' => 'Språk ändrat från :old till :new.',
        'love' => 'Älskad av :user',
        'nominate' => 'Nominerad av :user.',
        'nominate_modes' => 'Nominerad av :user (:modes).',
        'nomination_reset' => 'Nytt problem :discussion triggade en nomination återställning.',
        'qualify' => 'Denna beatmap har uppnått den nödvändiga antalet av nomineringar och har blivit kvalificerad.',
        'rank' => 'Rankad.',
        'remove_from_loved' => 'Borttagen från Älskad av :user. (:text)',

        'nsfw_toggle' => [
            'to_0' => 'Tog bort explicit markering',
            'to_1' => 'Markerad som explicit',
        ],
    ],

    'index' => [
        'title' => 'Beatmapset händelser',

        'form' => [
            'period' => 'Period',
            'types' => 'Typ',
        ],
    ],

    'item' => [
        'content' => 'Innehåll',
        'discussion_deleted' => '[raderad]',
        'type' => 'Typ',
    ],

    'type' => [
        'approve' => 'Godkännande',
        'beatmap_owner_change' => '',
        'discussion_delete' => 'Borttagning av diskussioner',
        'discussion_post_delete' => 'Borttagning av diskussionssvar',
        'discussion_post_restore' => 'Återställning av diskussionssvar',
        'discussion_restore' => 'Återställning av diskussioner',
        'disqualify' => 'Diskvalificering',
        'genre_edit' => 'Redigera genre',
        'issue_reopen' => 'Diskussionen öppnas på nytt',
        'issue_resolve' => 'Diskussionen löser',
        'kudosu_allow' => 'Kudosu ersättning',
        'kudosu_deny' => 'Kudosu förnekande',
        'kudosu_gain' => 'Kudosu ökning',
        'kudosu_lost' => 'Kudosu förlust',
        'kudosu_recalculate' => 'Kudosu omräkning',
        'language_edit' => 'Redigera språk',
        'love' => 'Älska',
        'nominate' => 'Nominering',
        'nomination_reset' => 'Återställning av nominering',
        'nsfw_toggle' => 'Explicit markering',
        'qualify' => 'Kvalifikation',
        'rank' => 'Rankning',
        'remove_from_loved' => '',
    ],
];
