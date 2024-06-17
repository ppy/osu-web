<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'event' => [
        'approve' => 'Aprobado.',
        'beatmap_owner_change' => 'El dueño de la dificultad :beatmap ha sido cambiado a :new_user.',
        'discussion_delete' => 'Un moderador eliminó la discusión :discussion.',
        'discussion_lock' => 'La discusión para este mapa ha sido desactivada. (:text)',
        'discussion_post_delete' => 'Un moderador eliminó una publicación en la discusión :discussion.',
        'discussion_post_restore' => 'Un moderador restauró una publicación de la discusión :discussion.',
        'discussion_restore' => 'Un moderador restauró la discusión :discussion.',
        'discussion_unlock' => 'La discusión para este mapa ha sido activada.',
        'disqualify' => 'Descalificado por :user. Motivo: :discussion (:text).',
        'disqualify_legacy' => 'Descalificado por :user. Motivo: :text.',
        'genre_edit' => 'El género cambió de :old a :new.',
        'issue_reopen' => 'El problema resuelto :discussion por :discussion_user ha sido reabierto por :user.',
        'issue_resolve' => 'El problema :discussion por :discussion_user ha sido marcado como resuelto por :user.',
        'kudosu_allow' => 'La negación de kudosu para la discusión :discussion ha sido eliminada.',
        'kudosu_deny' => 'La discusión :discussion ha sido negada para kudosu.',
        'kudosu_gain' => 'La discusión :discussion por :user ha obtenido suficientes votos para kudosu.',
        'kudosu_lost' => 'La discusión :discussion por :user ha perdido votos y su kudosu ganado ha sido eliminado.',
        'kudosu_recalculate' => 'A la discusión :discussion se le han recalculado los kudosu otorgados.',
        'language_edit' => 'El lenguaje cambió de :old a :new.',
        'love' => 'Amado por :user.',
        'nominate' => 'Nominado por :user.',
        'nominate_modes' => 'Nominado por :user (:modes).',
        'nomination_reset' => 'Un nuevo problema :discussion (:text) ha restablecido las nominaciones.',
        'nomination_reset_received' => 'La nominación por parte de :user ha sido restablecida por :source_user (:text)',
        'nomination_reset_received_profile' => 'Nominación restablecida por :user (:text)',
        'offset_edit' => 'La compensación en línea ha cambiado de :old a :new.',
        'qualify' => 'Este mapa ha alcanzado el número requerido de nominaciones y ha sido calificado.',
        'rank' => 'Clasificado.',
        'remove_from_loved' => 'Eliminado de amados por :user. (:text)',
        'tags_edit' => 'Las etiquetas cambiaron de «:old» a «:new».',

        'nsfw_toggle' => [
            'to_0' => 'Marca explícita quitada',
            'to_1' => 'Marcado como explícito',
        ],
    ],

    'index' => [
        'title' => 'Eventos del conjunto de mapas',

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
        'approve' => 'Aprobación',
        'beatmap_owner_change' => 'Cambio de dueño de la dificultad',
        'discussion_delete' => 'Eliminación de discusión',
        'discussion_post_delete' => 'Eliminación de respuesta a discusión',
        'discussion_post_restore' => 'Restauración de respuesta a discusión',
        'discussion_restore' => 'Restauración de discusión',
        'disqualify' => 'Descalificación',
        'genre_edit' => 'Edición de género',
        'issue_reopen' => 'Reapertura de discusión',
        'issue_resolve' => 'Resolución de discusión',
        'kudosu_allow' => 'Permiso de kudosu',
        'kudosu_deny' => 'Negación de kudosu',
        'kudosu_gain' => 'Ganancia de kudosu',
        'kudosu_lost' => 'Pérdida de kudosu',
        'kudosu_recalculate' => 'Recalculación de kudosu',
        'language_edit' => 'Edición del idioma',
        'love' => 'Amados',
        'nominate' => 'Nominación',
        'nomination_reset' => 'Restablecimiento de nominación',
        'nomination_reset_received' => 'Restablecimiento de nominación recibida',
        'nsfw_toggle' => 'Marca explícita',
        'offset_edit' => 'Edición de compensación',
        'qualify' => 'Calificación',
        'rank' => 'Clasificación',
        'remove_from_loved' => 'Eliminación de amados',
    ],
];
