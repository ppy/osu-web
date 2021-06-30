// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { BeatmapsetCardSize } from 'beatmapset-panel';
import UserJsonExtended from 'interfaces/user-json-extended';
import UserRelationJson from 'interfaces/user-relation-json';
import { ViewMode } from 'user-card';
import { Filter, SortMode } from 'user-list';
import GameMode from './game-mode';
import UserGroupJson from './user-group-json';

export default interface CurrentUser extends UserJsonExtended {
  blocks: UserRelationJson[];
  follow_user_mapping: number[];
  follower_count?: number;
  friends: UserRelationJson[];
  groups: UserGroupJson[];
  playmode: GameMode;
  unread_pm_count: number;
  user_preferences: UserPreferencesJson;
}

export interface UserPreferencesJson {
  audio_autoplay: boolean;
  audio_muted: boolean;
  audio_volume: number;
  beatmapset_card_size: BeatmapsetCardSize;
  beatmapset_cover_expanded: boolean;
  beatmapset_download: 'all' | 'no_video' | 'direct';
  beatmapset_show_nsfw: boolean;
  beatmapset_title_show_original: boolean;
  comments_show_deleted: boolean;
  forum_posts_show_deleted: boolean;
  ranking_expanded: boolean;
  user_list_filter: Filter;
  user_list_sort: SortMode;
  user_list_view: ViewMode;
}

export const defaultUserPreferencesJson: UserPreferencesJson = {
  audio_autoplay: false,
  audio_muted: false,
  audio_volume: 0.45,
  beatmapset_card_size: 'normal',
  beatmapset_cover_expanded: true,
  beatmapset_download: 'all',
  beatmapset_show_nsfw: false,
  beatmapset_title_show_original: false,
  comments_show_deleted: false,
  forum_posts_show_deleted: true,
  ranking_expanded: true,
  user_list_filter: 'all',
  user_list_sort: 'last_visit',
  user_list_view: 'card',
};
