// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { BeatmapsetJson } from 'beatmapsets/beatmapset-json';

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
  nominations_summary?: NominationsSummaryInterface;
  ranked_date: string;
  submitted_date: string;
  storyboard: boolean;
}
