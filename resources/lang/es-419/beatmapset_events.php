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
        'discussion_post_restore' => 'Un moderador restauró una publicación en la discusión :discussion.',
        'discussion_restore' => 'Un moderador restauró la discusión :discussion.',
        'discussion_unlock' => 'La discusión para este mapa ha sido activada.',
        'disqualify' => 'Descalificado por :user. Motivo: :discussion (:text).',
        'disqualify_legacy' => 'Descalificado por :user. Motivo: :text.',
        'genre_edit' => 'El género cambió de :old a :new.',
        'issue_reopen' => 'El problema resuelto :discussion de :discussion_user ha sido reabierto por :user.',
        'issue_resolve' => 'El problema :discussion creado por :discussion_user ha sido marcado como resuelto por :user.',
        'kudosu_allow' => 'La negación de kudosu para la discusión :discussion ha sido eliminada.',
        'kudosu_deny' => 'La discusión :discussion ha sido negada para obtener kudosu.',
        'kudosu_gain' => 'La discusión :discussion de :user ha obtenido suficientes votos para obtener kudosu.',
        'kudosu_lost' => 'La discusión :discussion de :user ha perdido votos y su kudosu ganado ha sido eliminado.',
        'kudosu_recalculate' => 'A la discusión :discussion se le ha recalculado el kudosu otorgado.',
        'language_edit' => 'El idioma cambió de :old a :new.',
        'love' => 'Amado por :user.',
        'nominate' => 'Nominado por :user.',
        'nominate_modes' => 'Nominado por :user (:modes).',
        'nomination_reset' => 'Un nuevo problema :discussion (:text) ha restablecido las nominaciones.',
        'nomination_reset_received' => 'La nominación por parte de :user ha sido restablecida por :source_user (:text)',
        'nomination_reset_received_profile' => 'Nominación restablecida por :user (:text)',
        'offset_edit' => 'La compensación en línea ha cambiado de :old a :new.',
        'qualify' => 'Este mapa ha alcanzado el número requerido de nominaciones y ha sido calificado.',
        'rank' => 'Clasificado.',
        'remove_from_loved' => 'Eliminado de amado por :user. (:text)',
        'tags_edit' => 'Las etiquetas cambiaron de «:old» a «:new».',

        'nsfw_toggle' => [
            'to_0' => 'Marca explícita quitada',
            'to_1' => 'Marcado como explícito',
        ],
    ],

    'index' => [
        'title' => 'Eventos del conjunto de mapas',

        'form' => [
            'period' => 'Periodo',
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
        'beatmap_owner_change' => 'Cambio de dueño de una dificultad',
        'discussion_delete' => 'Eliminación de una discusión',
        'discussion_post_delete' => 'Eliminación de una respuesta en una discusión',
        'discussion_post_restore' => 'Restauración de una respuesta en una discusión',
        'discussion_restore' => 'Restauración de una discusión',
        'disqualify' => 'Descalificación de un mapa',
        'genre_edit' => 'Edición de género en un mapa',
        'issue_reopen' => 'Reapertura de una discusión',
        'issue_resolve' => 'Discusiones resueltas',
        'kudosu_allow' => 'Permiso para ganar kudosu',
        'kudosu_deny' => 'Negación para ganar kudosu',
        'kudosu_gain' => 'Ganancia de kudosu',
        'kudosu_lost' => 'Pérdida de kudosu',
        'kudosu_recalculate' => 'Recalculación del kudosu',
        'language_edit' => 'Edición del idioma en un mapa',
        'love' => 'Mapas amados',
        'nominate' => 'Nominaciones en un mapa',
        'nomination_reset' => 'Restablecimiento de nominaciones en un mapa',
        'nomination_reset_received' => 'Restablecimiento de nominaciones recibidas en un mapa',
        'nsfw_toggle' => 'Marca explícita',
        'offset_edit' => 'Edición de la compensación en un mapa',
        'qualify' => 'Calificación de un mapa',
        'rank' => 'Clasificación de un mapa',
        'remove_from_loved' => 'Retiro de un mapa de la categoría amado',
    ],
];
