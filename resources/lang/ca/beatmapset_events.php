<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'event' => [
        'approve' => 'Aprovat.',
        'beatmap_owner_change' => 'El propietari de la dificultat :beatmap ha estat canviat a :new_user.',
        'discussion_delete' => 'El moderador ha eliminat la discussió :discussion.',
        'discussion_lock' => 'S\'ha desactivat la discussió d\'aquest beatmap. (:text)',
        'discussion_post_delete' => 'El moderador ha eliminat la publicació de la discussió :discussion.',
        'discussion_post_restore' => 'El moderador ha restaurat la publicació de la discussió :discussion.',
        'discussion_restore' => 'El moderador ha restaurat la discussió :discussion.',
        'discussion_unlock' => 'S\'ha habilitat la discussió d\'aquest beatmap.',
        'disqualify' => 'Desqualificat per :user. Motiu: :discussion (:text).',
        'disqualify_legacy' => 'Desqualificat per :user. Motiu :text.',
        'genre_edit' => 'El gènere ha canviat de :old a :new.',
        'issue_reopen' => 'El problema resolt :discussion de :discussion_user ha estat reobert per :user.',
        'issue_resolve' => 'El problema :discussion de :discussion_user ha estat marcat com resolt per :user.',
        'kudosu_allow' => 'La negació de kudosu per a la discussió :discussion ha estat eliminada.',
        'kudosu_deny' => 'La discussió :discussion ha estat denegada per kudosu.',
        'kudosu_gain' => 'La discussió :discussion de :user ha obtingut vots suficients per a kudosu.',
        'kudosu_lost' => 'La discussió :discussion de :user ha perdut vots i el seu kudosu ha estat retirat.',
        'kudosu_recalculate' => 'S\'han recalculat els kudosu concedits a la discussió :discussion.',
        'language_edit' => 'L\'idioma ha canviat de :old a :new.',
        'love' => 'Estimat per :user.',
        'nominate' => 'Nominat per :user.',
        'nominate_modes' => 'Nominat per :user (:modes).',
        'nomination_reset' => 'El nou problema :discussion (:text) ha causat un reinici de les nominacions.',
        'nomination_reset_received' => 'La nominiació de :user ha estat reiniciada per :source_user (:text)',
        'nomination_reset_received_profile' => 'Nominació restablida per :user (:text)',
        'offset_edit' => 'La compensació en línia ha canviat de :old a :new.',
        'qualify' => 'Aquest beatmap ha aconseguit el nombre requerit de nominacions i ha estat qualificat.',
        'rank' => 'Classificat.',
        'remove_from_loved' => 'Remogut d\'Estimats per :user. (:text)',
        'tags_edit' => 'L\'idioma ha canviat de ":old" a ":new".',

        'nsfw_toggle' => [
            'to_0' => 'Marca explícita remoguda',
            'to_1' => 'Marcat com a explícit',
        ],
    ],

    'index' => [
        'title' => 'Esdeveniments del beatmapset',

        'form' => [
            'period' => 'Període',
            'types' => 'Tipus',
        ],
    ],

    'item' => [
        'content' => 'Contingut',
        'discussion_deleted' => '[eliminat]',
        'type' => 'Tipus',
    ],

    'type' => [
        'approve' => 'Aprovació',
        'beatmap_owner_change' => 'Canvi de propietari de la dificultat',
        'discussion_delete' => 'Eliminació de la discussió',
        'discussion_post_delete' => 'Eliminació de resposta a discussió',
        'discussion_post_restore' => 'Restauració de resposta a discussió',
        'discussion_restore' => 'Restauració de discussió',
        'disqualify' => 'Desqualificació',
        'genre_edit' => 'Edició de gènere',
        'issue_reopen' => 'Reobertura de discussió',
        'issue_resolve' => 'Resolució de discussió',
        'kudosu_allow' => 'Permís de Kudosu',
        'kudosu_deny' => 'Negació de Kudosu',
        'kudosu_gain' => 'Guany de Kudosu',
        'kudosu_lost' => 'Pèrdua de Kudosu',
        'kudosu_recalculate' => 'Recàlcul de kudosu',
        'language_edit' => 'Editar l\'idioma',
        'love' => 'Amor',
        'nominate' => 'Nominació',
        'nomination_reset' => 'Restabliment de nominació',
        'nomination_reset_received' => 'Restabliment de nominació rebuda',
        'nsfw_toggle' => 'Marca explícita',
        'offset_edit' => 'Edició de compensació',
        'qualify' => 'Qualificació',
        'rank' => 'Classificació',
        'remove_from_loved' => 'Remoció d\'Estimats',
    ],
];
