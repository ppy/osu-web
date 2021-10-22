// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapsetEventJson from './beatmapset-event-json';
import BeatmapsetJson from './beatmapset-json';
import UserJson from './user-json';

interface AvailabilityInterface {
  download_disabled: boolean;
  more_information?: string;
}

interface NominationsSummaryInterface {
  current: number;
  required: number;
}

export default interface BeatmapsetExtendedJson extends BeatmapsetJson {
  availability?: AvailabilityInterface;
  events: BeatmapsetEventJson[];
  nominations_summary?: NominationsSummaryInterface;
  ranked: number;
  ranked_date: string;
  ratings: number[];
  related_users: UserJson[];
  storyboard: boolean;
  submitted_date: string;
}
