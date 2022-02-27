<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'event' => [
        'approve' => 'Schváleno.',
        'beatmap_owner_change' => 'Majitel obtížnosti :beatmap se změnil na :new_user.',
        'discussion_delete' => 'Moderátor smazal tuto diskusi :discussion.',
        'discussion_lock' => 'Diskuze o této mapě byly vypnuty. (:text)',
        'discussion_post_delete' => 'Moderátor smazal příspěvek z této diskuse :discussion.',
        'discussion_post_restore' => 'Moderátor obnovil příspěvek z této diskuse :discussion.',
        'discussion_restore' => 'Moderátor obnovil tuto diskusi :discussion.',
        'discussion_unlock' => 'Diskuze o této mapě byly zapnuty.',
        'disqualify' => 'Diskvalifikováno uživatelem :user. Důvod: :discussion (:text).',
        'disqualify_legacy' => 'Diskvalifikováno uživatelem :user. Důvod: text.',
        'genre_edit' => 'Žánr změněn z :old na :new.',
        'issue_reopen' => 'Vyřešený problém :discussion byl obnoven.',
        'issue_resolve' => 'Problém :discussion byl označen jako vyřešen.',
        'kudosu_allow' => 'Odmítnutí kudosu pro diskuzi :discussion odebráno.',
        'kudosu_deny' => 'Diskuse :discussion nemůže přjímat kudosu.',
        'kudosu_gain' => 'Diskuse :discussion uživatele :user dosáhla dostatku hlasů pro kudosu.',
        'kudosu_lost' => 'Diskuse :discussion uživatele :user ztratila hlasy a získané kudosu byly odebrány.',
        'kudosu_recalculate' => 'Diskusi :discussion byly získané kudosu přepočteny.',
        'language_edit' => 'Jazyk změněn z :old na :new.',
        'love' => 'Tuto mapu miluje :user',
        'nominate' => 'Nominováno uživatelem :user.',
        'nominate_modes' => 'Nominoval/a :user (:modes).',
        'nomination_reset' => 'Nový problém :discussion (:text) způsobil resetování nominace.',
        'nomination_reset_received' => 'Nominace uživatelem :user byla resetována uživatelem :source_user (:text)',
        'nomination_reset_received_profile' => 'Nominace byla resetována uživatelem :user (:text)',
        'qualify' => 'Tato beatmapa získala požadované množství nominací a byla kvalifikována.',
        'rank' => 'Hodnocené.',
        'remove_from_loved' => 'Odstraněno z Loved uživatelem :user. (:text)',

        'nsfw_toggle' => [
            'to_0' => 'Odebráno explicitní označení',
            'to_1' => 'Označeno jako explicitní',
        ],
    ],

    'index' => [
        'title' => 'Události beatmapsetu',

        'form' => [
            'period' => 'Období',
            'types' => 'Typy',
        ],
    ],

    'item' => [
        'content' => 'Obsah',
        'discussion_deleted' => '[odstraněno]',
        'type' => 'Typ',
    ],

    'type' => [
        'approve' => 'Schválení',
        'beatmap_owner_change' => 'Změna majitele obtížnosti',
        'discussion_delete' => 'Odstranění diskuze',
        'discussion_post_delete' => 'Odstranění odpovědí diskuze',
        'discussion_post_restore' => 'Obnovení odpovědí diskuze',
        'discussion_restore' => 'Obnovení diskuze',
        'disqualify' => 'Diskvalifikace',
        'genre_edit' => 'Úprava žánru',
        'issue_reopen' => 'Znovuotevření diskuze',
        'issue_resolve' => 'Vyřešení diskuze',
        'kudosu_allow' => 'Příspěvek Kudosu',
        'kudosu_deny' => 'Odmítnutí Kudosu',
        'kudosu_gain' => 'Zisk Kudosu',
        'kudosu_lost' => 'Ztráta Kudosu',
        'kudosu_recalculate' => 'Přepočet Kudosu',
        'language_edit' => 'Úprava jazyka',
        'love' => 'Obliba',
        'nominate' => 'Nominace',
        'nomination_reset' => 'Resetování nominací',
        'nomination_reset_received' => 'Nominace byla obnovena',
        'nsfw_toggle' => 'Explicitní značka',
        'qualify' => 'Kvalifikace',
        'rank' => 'Hodnocení',
        'remove_from_loved' => 'Odstranení z Loved',
    ],
];
