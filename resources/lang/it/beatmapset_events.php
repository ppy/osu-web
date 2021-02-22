<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'event' => [
        'approve' => 'Approvato.',
        'discussion_delete' => 'Un moderatore ha cancellato la discussione :discussion.',
        'discussion_lock' => 'La discussione per questa beatmap è stata disattivata. (:text)',
        'discussion_post_delete' => 'Un moderatore ha cancellato un post dalla discussione :discussion.',
        'discussion_post_restore' => 'Un moderatore ha ripristinato un post dalla discussione :discussion.',
        'discussion_restore' => 'Un moderatore ha ripristinato la discussione :discussion.',
        'discussion_unlock' => 'La discussione per questa beatmap è stata attivata.',
        'disqualify' => 'Squalificata da :user. Motivazione: :discussion (:text).',
        'disqualify_legacy' => 'Squalificata da :user. Motivazione: :text.',
        'genre_edit' => 'Genere modificato da :old a :new.',
        'issue_reopen' => 'Il problema risolto :discussion è stato riaperto.',
        'issue_resolve' => 'Il problema :discussion è stato segnato come risolto.',
        'kudosu_allow' => 'La negazione di kudosu per la discussione :discussion è stata rimossa.',
        'kudosu_deny' => 'Discussione :discussion negata per kudosu.',
        'kudosu_gain' => 'La discussione :discussion di :user ha ottenuto abbastanza voti per kudosu.',
        'kudosu_lost' => 'La discussione :discussion di :user ha perso voti e il kudosu permesso è stato rimosso.',
        'kudosu_recalculate' => 'La discussione :discussion ha ricevuto un ricalcolo del kudosu permesso.',
        'language_edit' => 'Lingua modificata da :old a :new.',
        'love' => 'Amata da :user.',
        'nominate' => 'Nominata da :user.',
        'nominate_modes' => 'Nominata da :user (:modes).',
        'nomination_reset' => 'Il nuovo problema :discussion (:text) ha comportato un reset di nomina.',
        'qualify' => 'Questa beatmap ha raggiunto il numero richiesto di nomine ed è stata qualificata.',
        'rank' => 'Rankata.',
        'remove_from_loved' => 'Rimossa dalle amate da :user. (:text)',

        'nsfw_toggle' => [
            'to_0' => '',
            'to_1' => '',
        ],
    ],

    'index' => [
        'title' => 'Eventi Beatmapset',

        'form' => [
            'period' => 'Periodo',
            'types' => 'Tipi',
        ],
    ],

    'item' => [
        'content' => 'Contenuto',
        'discussion_deleted' => '[eliminato]',
        'type' => 'Tipo',
    ],

    'type' => [
        'approve' => 'Approvazione',
        'discussion_delete' => 'Eliminazione discussione',
        'discussion_post_delete' => 'Eliminazione risposta a discussione',
        'discussion_post_restore' => 'Recupero risposta a discussione',
        'discussion_restore' => 'Recupero discussione',
        'disqualify' => 'Squalificazione',
        'genre_edit' => 'Modifica il genere',
        'issue_reopen' => 'Riaprimento discussione',
        'issue_resolve' => 'Risolvimento discussione',
        'kudosu_allow' => 'Accettazione kudosu',
        'kudosu_deny' => 'Negazione kudosu',
        'kudosu_gain' => 'Guadagno kudosu',
        'kudosu_lost' => 'Perdita kudosu',
        'kudosu_recalculate' => 'Ricalcolo kudosu',
        'language_edit' => 'Modifica la lingua',
        'love' => 'Ama',
        'nominate' => 'Nominazione',
        'nomination_reset' => 'Reset delle nominazioni',
        'nsfw_toggle' => '',
        'qualify' => 'Qualificazione',
        'rank' => 'Classificazione',
        'remove_from_loved' => 'Rimozione da amata',
    ],
];
