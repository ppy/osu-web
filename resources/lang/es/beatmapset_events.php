<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

return [
    'event' => [
        'approve' => 'Aprobado.',
        'discussion_delete' => 'Un moderador eliminó la discusión :discussion.',
        'discussion_lock' => 'La discusión para este beatmap ha sido desactivada. (:text)',
        'discussion_post_delete' => 'Un moderador eliminó una publicación en la discusión :discussion.',
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
        'rank' => 'Clasificado.',
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
        'discussion_delete' => 'Eliminación de la discusión',
        'discussion_post_delete' => 'Eliminación de la respuesta de la discusión',
        'discussion_post_restore' => 'Recuperar respuesta a la discusión',
        'discussion_restore' => 'Recuperar discusión',
        'disqualify' => 'Descalificar',
        'issue_reopen' => 'Reabrir discusión',
        'issue_resolve' => 'Resolver discusión',
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
