// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapExtendedJson from './beatmap-extended-json';
import BeatmapsetJson from './beatmapset-json';

interface Availability {
  download_disabled: boolean;
  more_information: string | null;
}

interface NominationsSummary {
  current: number;
  required: number;
}

interface BeatmapsetExtendedJsonAdditionalAttributes {
  availability: Availability;
  bpm: number;
  can_be_hyped: boolean;
  discussion_locked: boolean;
  is_scoreable: boolean;
  last_updated: string;
  legacy_thread_url: string | null;
  nominations_summary: NominationsSummary;
  ranked: number;
  ranked_date: string | null;
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
  beatmaps: (BeatmapExtendedJson & Required<Pick<BeatmapExtendedJson, 'failtimes' | 'max_combo'>>)[];
  converts: (BeatmapExtendedJson & Required<Pick<BeatmapExtendedJson, 'failtimes'>>)[];
}

type BeatmapsetJsonForShowIncludes = Required<Pick<BeatmapsetExtendedJson,
| 'current_user_attributes'
| 'description'
| 'genre'
| 'language'
| 'ratings'
| 'recent_favourites'
| 'related_users'
| 'user'
>>;

export type BeatmapsetJsonForShow =
  Omit<BeatmapsetExtendedJson & BeatmapsetJsonForShowIncludes, keyof BeatmapsetJsonForShowOverrideIncludes>
  & BeatmapsetJsonForShowOverrideIncludes;
