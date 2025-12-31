// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { trans } from 'utils/lang';
import BeatmapExtendedJson from './beatmap-extended-json';
import BeatmapJson from './beatmap-json';
import BeatmapsetDiscussionJson from './beatmapset-discussion-json';
import BeatmapsetEventJson from './beatmapset-event-json';
import BeatmapsetNominationJson from './beatmapset-nomination-json';
import GenreJson from './genre-json';
import LanguageJson from './language-json';
import Ruleset from './ruleset';
import TagJson from './tag-json';
import UserJson, { UserJsonDeleted } from './user-json';

export interface Availability {
  download_disabled: boolean;
  more_information: string | null;
}

interface BeatmapsetCovers {
  card: string;
  cover: string;
  list: string;
  slimcover: string;
}

interface BeatmapsetDescription {
  bbcode: string | null;
  description: string | null;
}

// #region nominations interfaces
interface BaseNominationsInterface {
  disqualification?: BeatmapsetEventJson;
  nominated?: boolean;
  nomination_reset?: BeatmapsetEventJson;
  ranking_eta?: string;
  ranking_queue_position?: number;
  required_hype: number;
  required_meta: {
    main_ruleset: number;
    non_main_ruleset: number;
  };
}

export interface NominationsInterface extends BaseNominationsInterface {
  current: Partial<Record<Ruleset, number>>;
  legacy_mode: false;
}

export interface LegacyNominationsInterface extends BaseNominationsInterface {
  current: number;
  legacy_mode: true;
  required: number;
}

export type BeatmapsetNominationsInterface =
  NominationsInterface | LegacyNominationsInterface;
// #endregion

export type BeatmapsetStatus =
  'graveyard' | 'wip' | 'pending' | 'ranked' | 'approved' | 'qualified' | 'loved';

export interface CurrentUserAttributes {
  can_beatmap_update_owner: boolean;
  can_delete: boolean;
  can_edit_metadata: boolean;
  can_edit_offset: boolean;
  can_edit_tags: boolean;
  can_hype: boolean;
  can_hype_reason: string;
  can_love: boolean;
  can_remove_from_loved: boolean;
  is_watching: boolean;
  new_hype_time: string | null;
  nomination_modes: Partial<Record<Ruleset, 'full' | 'limited'>> | null;
  remaining_hype: number;
}

export interface BeatmapsetJsonAvailableIncludes {
  availability: Availability;
  beatmaps: BeatmapJson[];
  converts: BeatmapExtendedJson[];
  current_nominations: BeatmapsetNominationJson[];
  current_user_attributes: CurrentUserAttributes;
  description: BeatmapsetDescription;
  discussions: BeatmapsetDiscussionJson[];
  eligible_main_rulesets: Ruleset[];
  events: BeatmapsetEventJson[];
  genre: GenreJson;
  has_favourited: boolean;
  language: LanguageJson;
  nominations: BeatmapsetNominationsInterface;
  ratings: number[];
  recent_favourites: UserJson[];
  related_tags: TagJson[];
  related_users: UserJson[];
  user: UserJson | UserJsonDeleted;
  version_count: number;
}

interface HypeData {
  current: number;
  required: number;
}

interface BeatmapsetJsonDefaultAttributes {
  anime_cover: boolean;
  artist: string;
  artist_unicode: string;
  covers: BeatmapsetCovers;
  creator: string;
  favourite_count: number;
  hype: HypeData | null;
  id: number;
  nsfw: boolean;
  offset: number;
  pack_tags: string[];
  play_count: number;
  preview_url: string;
  source: string;
  spotlight: boolean;
  status: BeatmapsetStatus;
  title: string;
  title_unicode: string;
  track_id: number | null;
  user_id: number;
  video: boolean;
}

type BeatmapsetJson = BeatmapsetJsonDefaultAttributes & Partial<BeatmapsetJsonAvailableIncludes>;
export default BeatmapsetJson;

export function deletedBeatmapset(): BeatmapsetJson {
  return {
    anime_cover: false,
    artist: '',
    artist_unicode: '',
    covers: {
      card: '',
      cover: '',
      list: '',
      slimcover: '',
    },
    creator: '',
    favourite_count: 0,
    hype: null,
    id: 0,
    nsfw: false,
    offset: 0,
    pack_tags: [],
    play_count: 0,
    preview_url: '',
    source: '',
    spotlight: false,
    status: 'graveyard',
    title: trans('matches.match.beatmap-deleted'),
    title_unicode: '',
    track_id: null,
    user_id: 0,
    video: false,
  };
}
