<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'event' => [
        'approve' => 'Approvata.',
        'beatmap_owner_change' => 'Proprietario della difficoltà ":beatmap" cambiato con :new_user.',
        'discussion_delete' => 'Un moderatore ha cancellato la discussione :discussion.',
        'discussion_lock' => 'La discussione per questa beatmap è stata disattivata. (:text)',
        'discussion_post_delete' => 'Un moderatore ha cancellato un post dalla discussione :discussion.',
        'discussion_post_restore' => 'Un moderatore ha ripristinato un post dalla discussione :discussion.',
        'discussion_restore' => 'Un moderatore ha ripristinato la discussione :discussion.',
        'discussion_unlock' => 'La discussione per questa beatmap è stata abilitata.',
        'disqualify' => 'Squalificata da :user. Motivazione: :discussion (:text).',
        'disqualify_legacy' => 'Squalificata da :user. Motivazione: :text.',
        'genre_edit' => 'Genere modificato da :old a :new.',
        'issue_reopen' => 'Il problema risolto :discussion di :discussion_user è stato riaperto da :user.',
        'issue_resolve' => 'Il problema :discussion di :discussion_user è stato segnato come risolto da :user.',
        'kudosu_allow' => 'La negazione di kudosu per la discussione :discussion è stata rimossa.',
        'kudosu_deny' => 'Discussione :discussion negata per kudosu.',
        'kudosu_gain' => 'La discussione :discussion di :user ha ottenuto abbastanza voti per kudosu.',
        'kudosu_lost' => 'La discussione :discussion di :user ha perso voti e il kudosu permesso è stato rimosso.',
        'kudosu_recalculate' => 'La discussione :discussion ha ricevuto un ricalcolo delle assegnazioni kudosu.',
        'language_edit' => 'Lingua modificata da :old a :new.',
        'love' => 'Amata da :user.',
        'nominate' => 'Nominata da :user.',
        'nominate_modes' => 'Nominata da :user (:modes).',
        'nomination_reset' => 'Il nuovo problema :discussion (:text) ha comportato un reset di nomina.',
        'nomination_reset_received' => 'La nomina di :user è stata resettata da :source_user (:text)',
        'nomination_reset_received_profile' => 'La nomina è stata resettata da :user (:text)',
        'offset_edit' => 'Offset online cambiato da :old a :new.',
        'qualify' => 'Questa beatmap ha raggiunto il numero richiesto di nomine ed è stata qualificata.',
        'rank' => 'Classificata.',
        'remove_from_loved' => 'Rimossa dalle amate da :user. (:text)',
        'tags_edit' => 'Etichette cambiate da ":old" a ":new".',

        'nsfw_toggle' => [
            'to_0' => 'Rimosso il contrassegno esplicito',
            'to_1' => 'Contrassegnata come esplicita',
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
        'beatmap_owner_change' => 'Cambio di proprietario della difficoltà',
        'discussion_delete' => 'Eliminazione della discussione',
        'discussion_lock' => 'Blocco della discussione',
        'discussion_post_delete' => 'Eliminazione risposta dalla discussione',
        'discussion_post_restore' => 'Ripristino risposta nella discussione',
        'discussion_restore' => 'Ripristino della discussione',
        'discussion_unlock' => 'Sblocco della discussione',
        'disqualify' => 'Squalifica',
        'genre_edit' => 'Modifica del genere',
        'issue_reopen' => 'Riapertura della discussione',
        'issue_resolve' => 'Chiusura della discussione',
        'kudosu_allow' => 'Approvazione di kudosu',
        'kudosu_deny' => 'Negazione di kudosu',
        'kudosu_gain' => 'Guadagno di kudosu',
        'kudosu_lost' => 'Perdita di kudosu',
        'kudosu_recalculate' => 'Ricalcolo di kudosu',
        'language_edit' => 'Modifica della lingua',
        'love' => 'Ama',
        'nominate' => 'Nomina',
        'nomination_reset' => 'Reset di nomina',
        'nomination_reset_received' => 'Reset di nomina ricevuto',
        'nsfw_toggle' => 'Contrassegno esplicito',
        'offset_edit' => 'Modifica sull\'offset',
        'qualify' => 'Qualifica',
        'rank' => 'Classificazione',
        'remove_from_loved' => 'Rimozione da amata',
        'tags_edit' => 'Modifica dei tag',
    ],
];
