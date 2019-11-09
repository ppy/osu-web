<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

return [
    'event' => [
        'approve' => 'Aprobado.',
        'discussion_delete' => 'Un moderador eliminó la discusión :discussion.',
        'discussion_lock' => 'La discusión para este beatmap ha sido desactivada. (:text)',
        'discussion_post_delete' => 'Un moderador eliminó un publicación en la discusión :discussion.',
        'discussion_post_restore' => 'Un moderador restauró una publicación de la discusión :discussion.',
        'discussion_restore' => 'Un moderador restauró la discusión :discussion.',
        'discussion_unlock' => 'La discusión para este beatmap ha sido activada.',
        'disqualify' => 'Descalificado por :user. Motivo: :discussion (:text).',
        'disqualify_legacy' => 'Descalificado por :user. Motivo: :text.',
        'issue_reopen' => 'El problema resuelto :discussion ha sido reabierto.',
        'issue_resolve' => 'El problema :discussion ha sido marcado como resuelto.',
        'kudosu_allow' => 'La negación de kudosu para la discusión :discussion ha sido eliminada.',
        'kudosu_deny' => 'La discusión :discussion ha sido negada para kudosu.',
        'kudosu_gain' => 'La discusión :discussion por :user ha obtenido suficientes votos para kudosu.',
        'kudosu_lost' => 'La discusión :discussion por :user ha perdido votos y su kudosu ganado ha sido removido.',
        'kudosu_recalculate' => 'A la discusión :discussion se le han recalculado los kudosu otorgados.',
        'love' => 'Loved por :user',
        'nominate' => 'Nominado por :user.',
        'nomination_reset' => 'Un nuevo problema :discussion (:text) ha reiniciado las nominaciones.',
        'qualify' => 'Este beatmap ha alcanzado el número requerido de nominaciones y ha sido calificado.',
        'rank' => 'Rankeado.',
    ],

    'index' => [
        'title' => 'Eventos del Beatmapset',

        'form' => [
            'period' => 'Período',
            'types' => 'Tipos',
        ],
    ],

    'item' => [
        'content' => 'Contenido',
        'discussion_deleted' => '[eliminado]',
        'type' => 'Tipo',
    ],

    'type' => [
        'approve' => 'Aprovado',
        'discussion_delete' => 'Borrar discusion',
        'discussion_post_delete' => 'Borrar respuesta a la discusion',
        'discussion_post_restore' => 'Recuperar respuesta a la discusion',
        'discussion_restore' => 'Recuperar discusion',
        'disqualify' => 'Descalificar',
        'issue_reopen' => 'Reabrir discusion',
        'issue_resolve' => 'Resolver discusion',
        'kudosu_allow' => 'Permitir kudosu',
        'kudosu_deny' => 'Denegar kudosu',
        'kudosu_gain' => 'Ganancia de Kudosu',
        'kudosu_lost' => 'Kudosu perdidos',
        'kudosu_recalculate' => 'Recalculación de Kudosu',
        'love' => 'Amor',
        'nominate' => 'Nominación',
        'nomination_reset' => 'Reiniciar nominacion',
        'qualify' => 'Calificación',
        'rank' => 'Clasificación',
    ],
];
