<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'event' => [
        'approve' => 'Aprobat.',
        'beatmap_owner_change' => 'Creatorul dificultății :beatmap schimbat în :new_user.',
        'discussion_delete' => 'Un moderator a șters discuția :discussion.',
        'discussion_lock' => 'Discuția pentru acest beatmap a fost dezactivată. (:text)',
        'discussion_post_delete' => 'Un moderator a șters postarea din discuția :discussion.',
        'discussion_post_restore' => 'Un moderator a restaurat postarea din discuția :discussion.',
        'discussion_restore' => 'Un moderator a restaurat discuția :discussion.',
        'discussion_unlock' => 'Discuție pentru acest beatmap a fost activată.',
        'disqualify' => 'Descalificat de :user. Motiv: :discussion (:text).',
        'disqualify_legacy' => 'Descalificat de :user. Motiv :text.',
        'genre_edit' => 'Genul s-a schimbat de la :old la :new.',
        'issue_reopen' => 'Problema rezolvată :discussion s-a redeschis.',
        'issue_resolve' => 'Problema :discussion postată de :discussion_user a fost marcată drept rezolvată de către :user.',
        'kudosu_allow' => 'Negocierea de kudosu pentru discuția :discussion a fost eliminată.',
        'kudosu_deny' => 'Discuția :discussion a fost respinsă pentru kudosu.',
        'kudosu_gain' => 'Discuția :discussion de :user a obținut destule voturi pentru kudosu.',
        'kudosu_lost' => 'Discuția :discussion de :user a pierdut voturi și kudosu acordați au fost eliminați.',
        'kudosu_recalculate' => 'Numărul de kudosu acordat pentru discuția :discussion a fost recalculat.',
        'language_edit' => 'Limba s-a schimbat de la :old la :new.',
        'love' => 'Iubit de către :user.',
        'nominate' => 'Nominalizat de :user.',
        'nominate_modes' => 'Nominalizat de :user (:modes).',
        'nomination_reset' => 'O problemă nouă :discussion (:text) a declanșat reluarea unei nominalizări.',
        'nomination_reset_received' => 'Nominalizarea de :user a fost resetată de către :source_user (:text)',
        'nomination_reset_received_profile' => 'Nominalizarea a fost resetată de :user (:text)',
        'offset_edit' => 'Offset-ul online schimbat din :old la :new.',
        'qualify' => 'Acest beatmap a atins numărul limită de nominalizări și s-a calificat.',
        'rank' => 'Clasat.',
        'remove_from_loved' => 'Eliminat din Iubit de :user. (:text)',
        'tags_edit' => 'Etichetele au fost schimbate din ":old" în ":new".',

        'nsfw_toggle' => [
            'to_0' => 'Marcaj conținut obscen șters',
            'to_1' => 'Marcat drept obscen',
        ],
    ],

    'index' => [
        'title' => 'Evenimente beatmapset',

        'form' => [
            'period' => 'Perioadă',
            'types' => 'Tipuri',
        ],
    ],

    'item' => [
        'content' => 'Conținut',
        'discussion_deleted' => '[deleted]',
        'type' => 'Tip',
    ],

    'type' => [
        'approve' => 'Aprobare',
        'beatmap_owner_change' => 'Schimbare a proprietarului dificultății',
        'discussion_delete' => 'Ștergerea discuției',
        'discussion_post_delete' => 'Ștergerea răspunsului',
        'discussion_post_restore' => 'Restaurarea răspunsului',
        'discussion_restore' => 'Restaurarea discuției',
        'disqualify' => 'Descalificare',
        'genre_edit' => 'Editare gen',
        'issue_reopen' => 'Redeschiderea discuției',
        'issue_resolve' => 'Rezolvarea discuției',
        'kudosu_allow' => 'Alocația de kudosu',
        'kudosu_deny' => 'Respingere de kudosu',
        'kudosu_gain' => 'Câștigare de kudosu',
        'kudosu_lost' => 'Pierdere de kudosu',
        'kudosu_recalculate' => 'Recalcularea kudosu',
        'language_edit' => 'Editare limbă',
        'love' => 'Iubire',
        'nominate' => 'Nominalizare',
        'nomination_reset' => 'Resetarea nominalizărilor',
        'nomination_reset_received' => 'Resetare a nominalizării primită',
        'nsfw_toggle' => 'Marcaj obscen',
        'offset_edit' => 'Editare offset',
        'qualify' => 'Calificare',
        'rank' => 'Clasament',
        'remove_from_loved' => 'Scoaterea din Iubit',
    ],
];
