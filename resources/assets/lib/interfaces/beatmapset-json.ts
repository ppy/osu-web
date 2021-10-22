// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapJson from './beatmap-json';
import BeatmapsetEventJson from './beatmapset-event-json';
import GameMode from './game-mode';
import GenreJson from './genre-json';
import LanguageJson from './language-json';
import UserJson from './user-json';

interface BeatmapsetCovers {
  card: string;
  cover: string;
  list: string;
  slimcover: string;
}

export interface BeatmapsetNomination {
  beatmapset_id: number;
  created_at: string;
  id: number;
  modes: GameMode[];
  reset: number;
  reset_user_id: number | null;
  updated_at: string | null;
  user?: UserJson;
  user_id: number;
}

interface BaseNominationsInterface {
  legacy_mode: boolean;
  nominated?: boolean;
  required_hype: number;
}

export interface NominationsInterface extends BaseNominationsInterface {
  current: Partial<Record<GameMode, number>>;
  legacy_mode: false;
  required: Partial<Record<GameMode, number>>;
}

export function isLegacyNominationsInterface(x: BaseNominationsInterface): x is LegacyNominationsInterface {
  return x.legacy_mode;
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
  can_hype: boolean;
  can_hype_reason: string;
  can_love: boolean;
  can_remove_from_loved: boolean;
  is_watching: boolean;
  new_hype_time: string;
  nomination_modes: Partial<Record<GameMode, 'full' | 'limited'>>;
  remaining_hype: number;
}

// TODO: incomplete
export default interface BeatmapsetJson {
  artist: string;
  artist_unicode: string;
  beatmaps?: BeatmapJson[];
  beatmapset_nominations?: BeatmapsetNomination[];
  covers: BeatmapsetCovers;
  creator: string;
  current_user_attributes?: CurrentUserAttributes;
  description: {
    bbcode?: string | null;
    description: string | null;
  };
  discussion_enabled: boolean;
  events?: BeatmapsetEventJson[];
  favourite_count: number;
  genre: GenreJson;
  has_favourited?: boolean;
  hype?: {
    current: number;
    required: number;
  };
  id: number;
  is_scoreable: boolean;
  language: LanguageJson;
  last_updated: string;
  legacy_thread_url: string | null;
  nominations?: BeatmapsetNominationsInterface;
  nsfw: boolean;
  play_count: number;
  preview_url: string;
  source: string;
  status: BeatmapsetStatus;
  tags: string;
  title: string;
  title_unicode: string;
  track_id: number | null;
  user_id: number;
  video: boolean;
}
