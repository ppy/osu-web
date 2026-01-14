// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapExtendedJson from './beatmap-extended-json';
import BeatmapsetJson, { Availability } from './beatmapset-json';
import Ruleset from './ruleset';
import WithBeatmapOwners from './with-beatmap-owners';

interface NominationsSummary {
  current: number;
  eligible_main_rulesets: Ruleset[] | null;
  required_meta: {
    main_ruleset: number;
    non_main_ruleset: number;
  };
}

interface BeatmapsetExtendedJsonAdditionalAttributes {
  availability: Availability;
  bpm: number;
  can_be_hyped: boolean;
  deleted_at: string | null;
  discussion_locked: boolean;
  is_scoreable: boolean;
  last_updated: string;
  legacy_thread_url: string | null;
  nominations_summary: NominationsSummary;
  ranked: number;
  ranked_date: string | null;
  rating: number;
  storyboard: boolean;
  submitted_date: string | null;
  tags: string;
}

interface BeatmapsetExtendedJsonOverrideIncludes {
  beatmaps: BeatmapExtendedJson[];
}

type BeatmapsetExtendedJson =
  Omit<BeatmapsetJson, keyof BeatmapsetExtendedJsonOverrideIncludes>
  & BeatmapsetExtendedJsonAdditionalAttributes
  & Partial<BeatmapsetExtendedJsonOverrideIncludes>;
export default BeatmapsetExtendedJson;

interface BeatmapsetJsonForShowOverrideIncludes {
  beatmaps: (WithBeatmapOwners<BeatmapExtendedJson> & Required<Pick<BeatmapExtendedJson, 'failtimes' | 'max_combo'>>)[];
  converts: (WithBeatmapOwners<BeatmapExtendedJson> & Required<Pick<BeatmapExtendedJson, 'failtimes'>>)[];
}

type BeatmapsetJsonForShowIncludes = Required<Pick<BeatmapsetExtendedJson,
| 'current_nominations'
| 'current_user_attributes'
| 'description'
| 'genre'
| 'language'
| 'pack_tags'
| 'ratings'
| 'recent_favourites'
| 'related_tags'
| 'related_users'
| 'user'
| 'version_count'
>>;

export type BeatmapsetJsonForShow =
  Omit<BeatmapsetExtendedJson & BeatmapsetJsonForShowIncludes, keyof BeatmapsetJsonForShowOverrideIncludes>
  & BeatmapsetJsonForShowOverrideIncludes;
