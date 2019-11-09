<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

return [
    'event' => [
        'approve' => 'Godkjent.',
        'discussion_delete' => 'Moderator slettet diskusjonen :discussion.',
        'discussion_lock' => 'Diskusjon for dette beatmappet har blitt deaktivert. (:text)',
        'discussion_post_delete' => 'Moderator slettet innlegg fra diskusjonen :discussion.',
        'discussion_post_restore' => 'Moderator gjenopprettet innlegg fra diskusjonen :discussion.',
        'discussion_restore' => 'Moderator gjenopprettet diskusjon :discussion.',
        'discussion_unlock' => 'Diskusjon for dette beatmappet har blitt aktivert.',
        'disqualify' => 'Diskvalifisert av :user. Årsak: :discussion (:text).',
        'disqualify_legacy' => 'Diskvalifisert av :user. Årsak: :text.',
        'issue_reopen' => 'Løst problem ved :discussion har blitt gjenåpnet.',
        'issue_resolve' => 'Problemet med :discussion har blitt markert som løst.',
        'kudosu_allow' => 'Kudosu fornektelse for diskusjon :discussion har blitt fjernet.',
        'kudosu_deny' => 'Diskusjonen :discussion ble nektet for kudosu.',
        'kudosu_gain' => 'Diskusjonen :discussion av :user oppnådde nok stemmer til kudosu.',
        'kudosu_lost' => 'Diskusjonen :discussion av :user har mistet stemmer og innvilget kudosu er blitt fjernet.',
        'kudosu_recalculate' => 'Diskusjonen :discussion har fått kudosu tilskuddene rekalkulert.',
        'love' => 'Elsket av :user',
        'nominate' => 'Nominert av :user.',
        'nomination_reset' => 'Nytt problem :discussion (:text) utløste en tilbakestilling av nominasjonen.',
        'qualify' => 'Dette beatmappet har nådd det nødvendige antallet med nominasjoner og har nå blitt kvalifisert.',
        'rank' => 'Rangert.',
    ],

    'index' => [
        'title' => 'Beatmapset Hendelser',

        'form' => [
            'period' => 'Periode',
            'types' => 'Typer',
        ],
    ],

    'item' => [
        'content' => 'Innhold',
        'discussion_deleted' => '[deleted]',
        'type' => 'Type',
    ],

    'type' => [
        'approve' => 'Godkjenning',
        'discussion_delete' => 'Diskusjon sletting',
        'discussion_post_delete' => 'Diskusjonsvar sletting',
        'discussion_post_restore' => 'Diskusjonsvar gjenopprettelse',
        'discussion_restore' => 'Gjenopprett diskusjon',
        'disqualify' => 'Diskvalifikasjon',
        'issue_reopen' => 'Gjenåpne diskusjon',
        'issue_resolve' => 'Løs diskusjon',
        'kudosu_allow' => 'Kudosu kvote',
        'kudosu_deny' => 'Kudosu benektelse',
        'kudosu_gain' => 'Kudosu gevinst',
        'kudosu_lost' => 'Kudosu tap',
        'kudosu_recalculate' => 'Kudosu rekalkulering',
        'love' => 'Elsk',
        'nominate' => 'Nominasjon',
        'nomination_reset' => 'Nominasjon nullstilling',
        'qualify' => 'Kvalifikasjon',
        'rank' => 'Rangering',
    ],
];
