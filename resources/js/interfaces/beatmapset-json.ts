// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapExtendedJson from './beatmap-extended-json';
import BeatmapJson from './beatmap-json';
import BeatmapsetDiscussionJson from './beatmapset-discussion-json';
import BeatmapsetEventJson from './beatmapset-event-json';
import BeatmapsetNominationJson from './beatmapset-nomination-json';
import GameMode from './game-mode';
import GenreJson from './genre-json';
import LanguageJson from './language-json';
import UserJson, { UserJsonDeleted } from './user-json';

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

interface BaseNominationsInterface {
  nominated?: boolean;
  required_hype: number;
}

export interface NominationsInterface extends BaseNominationsInterface {
  current: Partial<Record<GameMode, number>>;
  legacy_mode: false;
  required: Partial<Record<GameMode, number>>;
}

export interface LegacyNominationsInterface extends BaseNominationsInterface {
  current: number;
  legacy_mode: true;
  required: number;
}

export type BeatmapsetNominationsInterface =
  NominationsInterface | LegacyNominationsInterface;

export type BeatmapsetStatus =
  'graveyard' | 'wip' | 'pending' | 'ranked' | 'approved' | 'qualified' | 'loved';

export interface CurrentUserAttributes {
  can_delete: boolean;
  can_edit_metadata: boolean;
  can_edit_offset: boolean;
  can_edit_tags: boolean;
  can_hype: boolean;
  can_hype_reason: string;
  can_love: boolean;
  can_remove_from_loved: boolean;
  is_watching: boolean;
  new_hype_time: string;
  nomination_modes: Partial<Record<GameMode, 'full' | 'limited'>>;
  remaining_hype: number;
}

interface BeatmapsetJsonAvailableIncludes {
  beatmaps: BeatmapJson[];
  converts: BeatmapExtendedJson[];
  current_nominations: BeatmapsetNominationJson[];
  current_user_attributes: CurrentUserAttributes;
  description: BeatmapsetDescription;
  discussions: BeatmapsetDiscussionJson[];
  events: BeatmapsetEventJson[];
  genre: GenreJson;
  has_favourited: boolean;
  language: LanguageJson;
  nominations: BeatmapsetNominationsInterface;
  ratings: number[];
  recent_favourites: UserJson[];
  related_users: UserJson[];
  user: UserJson | UserJsonDeleted;
}

interface HypeData {
  current: number;
  required: number;
}

interface BeatmapsetJsonDefaultAttributes {
  artist: string;
  artist_unicode: string;
  covers: BeatmapsetCovers;
  creator: string;
  favourite_count: number;
  hype: HypeData | null;
  id: number;
  nsfw: boolean;
  offset: number;
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
