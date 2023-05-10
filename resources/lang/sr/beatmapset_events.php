<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'event' => [
        'approve' => 'Одобрено.',
        'beatmap_owner_change' => 'Власник тежине :beatmap je промењен на корисника :new_user.',
        'discussion_delete' => 'Модератор је обрисао дискусију :discussion.',
        'discussion_lock' => 'Дискусија за ову мапу је искључена. (:text)',
        'discussion_post_delete' => 'Модератор је обрисао објаву из дискусије :discussion.',
        'discussion_post_restore' => 'Модератор је обновио дискусију :discussion.',
        'discussion_restore' => 'Модератор је обновио дискусију :discussion.',
        'discussion_unlock' => 'Дискусија за ову мапу је укључена.',
        'disqualify' => 'Дисквалификовано од стране корисника :user. Разлог: :discussion (:text).',
        'disqualify_legacy' => 'Дисквалификовано од стране корисника :user. Разлог: :text.
',
        'genre_edit' => 'Жанр промењен од :old у :new.',
        'issue_reopen' => 'Решен проблем :discussion од стране корисника :discussion_user је поново отворен од стране корисника :user.',
        'issue_resolve' => 'Проблем :discussion од стране корисника :discussion_user је означен као решен од стране корисника :user.',
        'kudosu_allow' => 'Одбијање доделе "Kudosu"-a за дискусију :discussion је уклоњено.',
        'kudosu_deny' => 'Дискусија :discussion је онемогућена за добијање kudosu-а.',
        'kudosu_gain' => 'Дискусија :discussion од стране корисника :user има довољно гласова за добијање kudosu-а.',
        'kudosu_lost' => 'Дискусија :discussion од стране корисника :user је изгубила гласове и "kudosu" је уклоњен.',
        'kudosu_recalculate' => 'Дискусија :discussion је имала своје дозволе за kudosu прерачунате.',
        'language_edit' => 'Језик промењен од :old у :new.',
        'love' => 'Loved од стране корисника :user.',
        'nominate' => 'Номиновано од стране корисника :user.',
        'nominate_modes' => 'Номиновано од стране корисника :user (:modes).',
        'nomination_reset' => 'Нови проблем :discussion (:text) је активирао ресетовање номинација.',
        'nomination_reset_received' => 'Номинација од стране корисника :user је ресетована од стране корисника :source_user (:text)',
        'nomination_reset_received_profile' => 'Номинација је ресетована од стране :user (:text)',
        'offset_edit' => 'Онлајн офсет је промењен од :old на :new.',
        'qualify' => 'Ова мапа је достигла потребан број номинација и сада је квалификована.',
        'rank' => 'Рангирано.',
        'remove_from_loved' => 'Уклоњено из Loved категорије од стране корисника :user. (:text)',
        'tags_edit' => 'Ознаке су промењене са ":old" на ":new".',

        'nsfw_toggle' => [
            'to_0' => 'Експлицитна ознака је уклоњена',
            'to_1' => 'Означено као експлицитно',
        ],
    ],

    'index' => [
        'title' => 'Догађаји сета мапа',

        'form' => [
            'period' => 'Период',
            'types' => 'Врсте',
        ],
    ],

    'item' => [
        'content' => 'Садржај',
        'discussion_deleted' => '[deleted]',
        'type' => 'Врста',
    ],

    'type' => [
        'approve' => 'Одобрење',
        'beatmap_owner_change' => 'Промена власника тежине',
        'discussion_delete' => 'Брисање дискусије',
        'discussion_post_delete' => 'Брисање одговора на дискусију ',
        'discussion_post_restore' => 'Повраћај одговора на дискусију',
        'discussion_restore' => 'Повраћај дискусије',
        'disqualify' => 'Дисквалификуј',
        'genre_edit' => 'Мењање жанра',
        'issue_reopen' => 'Поновно отварање дискусије',
        'issue_resolve' => 'Затварање дискусије',
        'kudosu_allow' => 'Kudosu џепарац',
        'kudosu_deny' => 'Kudosu одбијен',
        'kudosu_gain' => 'Kudosu добијен',
        'kudosu_lost' => 'Kudosu изгубљен',
        'kudosu_recalculate' => 'Kudosu прерачунат',
        'language_edit' => 'Измена језика',
        'love' => 'Love',
        'nominate' => 'Номинација',
        'nomination_reset' => 'Номинације су ресетоване',
        'nomination_reset_received' => 'Ресетовање номинација је пристигло',
        'nsfw_toggle' => 'Означи као експлицитан садржај',
        'offset_edit' => 'Промена офсета',
        'qualify' => 'Квалификација',
        'rank' => 'Рангирање',
        'remove_from_loved' => 'Уклањање из Loved',
    ],
];
