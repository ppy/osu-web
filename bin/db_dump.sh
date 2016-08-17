#!/bin/sh

set -u
set -e

root="$(dirname "${0}")/../database"

_mysqldump() {
  mysqldump -d "${@}" | sed -e 's/ AUTO_INCREMENT=[0-9]*//'
}

_mysqldump osu \
  forum_forum_covers \
  forum_topic_covers \
  osu_achievements \
  osu_apikeys \
  osu_beatmaps \
  osu_beatmapsets \
  osu_changelog \
  osu_countries \
  osu_counts \
  osu_events \
  osu_favouritemaps \
  osu_genres \
  osu_kudos_exchange \
  osu_languages \
  osu_leaders \
  osu_leaders_fruits \
  osu_leaders_mania \
  osu_leaders_taiko \
  osu_login_attempts \
  osu_scores \
  osu_scores_fruits \
  osu_scores_fruits_high \
  osu_scores_high \
  osu_scores_mania \
  osu_scores_mania_high \
  osu_scores_taiko \
  osu_scores_taiko_high \
  osu_user_achievements \
  osu_user_banhistory \
  osu_user_beatmap_playcount \
  osu_user_donations \
  osu_user_performance_rank \
  osu_user_stats \
  osu_user_stats_fruits \
  osu_user_stats_mania \
  osu_user_stats_taiko \
  osu_username_change_history \
  phpbb_acl_groups \
  phpbb_disallow \
  phpbb_forums \
  phpbb_posts \
  phpbb_ranks \
  phpbb_smilies \
  phpbb_topics \
  phpbb_topics_track \
  phpbb_user_group \
  phpbb_users \
  tournament_registrations \
  tournaments \
  user_profile_customizations \
> "${root}/db-osu-structure.sql"

_mysqldump osu_store \
  addresses \
  order_items \
  orders \
  products \
> "${root}/db-osu_store-structure.sql"

mysqldump -t --skip-opt osu \
  osu_genres \
  osu_languages \
> "${root}/db-osu-data.sql"
