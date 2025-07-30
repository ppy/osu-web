<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'admin' => [
        '_' => 'админ',
    ],
    'error' => [
        'error' => [
            '400' => 'неверный запрос',
            '404' => 'не найдено',
            '403' => 'доступ ограничен',
            '401' => 'необходима авторизация',
            '401-verification' => 'подтверждение аккаунта',
            '405' => 'не найдено',
            '422' => 'неверный запрос',
            '429' => 'слишком много запросов',
            '500' => 'что-то сломалось',
            '503' => 'технические работы',
        ],
    ],
    'forum' => [
        '_' => 'форум',
        'topic_logs_controller' => [
            'index' => 'статистика темы',
        ],
    ],
    'main' => [
        'account_controller' => [
            'verify_link' => 'верификация аккаунта',
        ],
        'artists_controller' => [
            '_' => 'избранные исполнители',
        ],
        'beatmap_discussion_posts_controller' => [
            '_' => 'посты в обсуждениях карт',
        ],
        'beatmap_discussions_controller' => [
            '_' => 'обсуждения карты',
        ],
        'beatmap_packs_controller' => [
            '_' => 'сборки карт',
        ],
        'beatmapset_discussion_votes_controller' => [
            '_' => 'голоса в обсуждений карты',
        ],
        'beatmapset_events_controller' => [
            '_' => 'история карты',
        ],
        'beatmapsets_controller' => [
            'discussion' => 'обсуждение карты',
            'index' => 'библиотека карт',
            'show' => 'информация о карте',
        ],
        'changelog_controller' => [
            '_' => 'список изменений',
        ],
        'chat_controller' => [
            '_' => 'чат',
        ],
        'comments_controller' => [
            '_' => 'комментарии',
        ],
        'contest_entries_controller' => [
            'judge_results' => 'результаты судейства конкурса',
        ],
        'contests_controller' => [
            '_' => 'конкурсы',
            'judge' => 'судейство конкурса',
        ],
        'groups_controller' => [
            'show' => 'группы',
        ],
        'home_controller' => [
            'get_download' => 'скачать игру',
            'index' => 'главная страница',
            'search' => 'поиск',
            'support_the_game' => 'поддержать игру',
            'testflight' => 'testflight',
        ],
        'legacy_matches_controller' => [
            '_' => 'матчи',
        ],
        'legal_controller' => [
            '_' => 'информация',
        ],
        'livestreams_controller' => [
            '_' => 'прямые трансляции',
        ],
        'news_controller' => [
            '_' => 'новости',
        ],
        'notifications_controller' => [
            '_' => 'история уведомлений',
        ],
        'password_reset_controller' => [
            '_' => 'восстановление пароля',
        ],
        'ranking_controller' => [
            '_' => 'рейтинг',
        ],
        'scores_controller' => [
            '_' => 'рекорд',
        ],
        'seasons_controller' => [
            '_' => 'рейтинг',
        ],
        'teams_controller' => [
            '_' => 'команды',
            'create' => 'создать команду',
            'edit' => 'настройки команды',
            'leaderboard' => 'командная рейтинговая таблица',
            'show' => 'информация о команде',
        ],
        'tournaments_controller' => [
            '_' => 'турниры',
        ],
        'user_cover_presets_controller' => [
            '_' => 'пресеты обложек',
        ],
        'users_controller' => [
            '_' => 'информация об игроке',
            'create' => 'создать аккаунт',
            'disabled' => 'обратите внимание',
        ],
        'wiki_controller' => [
            '_' => 'вики',
        ],
    ],
    'multiplayer' => [
        'rooms_controller' => [
            'events' => 'история комнаты',
        ],
    ],
    'passport' => [
        'authorization_controller' => [
            '_' => 'авторизация приложения',
        ],
    ],
    'store' => [
        '_' => 'магазин',
    ],
    'teams' => [
        'members_controller' => [
            'index' => 'участники команды',
        ],
    ],
    'users' => [
        'modding_history_controller' => [
            '_' => 'информация о моддере',
        ],
        'multiplayer_controller' => [
            '_' => 'история мультиплеера',
        ],
    ],
];
