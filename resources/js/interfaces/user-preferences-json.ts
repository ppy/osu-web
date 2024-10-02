// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { BeatmapsetCardSize } from 'beatmapset-panel';
import { ViewMode } from 'components/user-card';
import { Filter, SortMode } from 'components/user-list';

export function defaultUserPreferencesJson(): UserPreferencesJson {
  return {
    audio_autoplay: false,
    audio_muted: false,
    audio_volume: 0.45,
    beatmapset_card_size: 'normal',
    beatmapset_download: 'all',
    beatmapset_show_nsfw: false,
    beatmapset_title_show_original: false,
    comments_show_deleted: false,
    comments_sort: 'new',
    forum_posts_show_deleted: true,
    legacy_score_only: false,
    profile_cover_expanded: true,
    scoring_mode: 'standardised',
    user_list_filter: 'all',
    user_list_sort: 'last_visit',
    user_list_view: 'card',
  };
}

export default interface UserPreferencesJson {
  audio_autoplay: boolean;
  audio_muted: boolean;
  audio_volume: number;
  beatmapset_card_size: BeatmapsetCardSize;
  beatmapset_download: 'all' | 'no_video' | 'direct';
  beatmapset_show_nsfw: boolean;
  beatmapset_title_show_original: boolean;
  comments_show_deleted: boolean;
  comments_sort: string;
  forum_posts_show_deleted: boolean;
  legacy_score_only: boolean;
  profile_cover_expanded: boolean;
  scoring_mode: 'classic' | 'standardised';
  user_list_filter: Filter;
  user_list_sort: SortMode;
  user_list_view: ViewMode;
}
