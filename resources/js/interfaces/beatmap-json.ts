// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapOwnerJson from './beatmap-owner-json';
import BeatmapsetJson from './beatmapset-json';
import Ruleset from './ruleset';
import TagJson from './tag-json';
import UserJson from './user-json';

interface BeatmapFailTimesArray {
  exit: number[];
  fail: number[];
}

interface BeatmapJsonAvailableIncludes {
  beatmapset: BeatmapsetJson | null;
  checksum: string | null;
  failtimes: BeatmapFailTimesArray;
  max_combo: number;
  owners: BeatmapOwnerJson[];
  tags: (TagJson & Required<Pick<TagJson, 'count'>>)[];
  user: UserJson;
}

interface BeatmapJsonDefaultAttributes {
  beatmapset_id: number;
  difficulty_rating: number;
  id: number;
  mode: Ruleset;
  status: string;
  total_length: number;
  user_id: number;
  version: string;
}

type BeatmapJson = BeatmapJsonDefaultAttributes & Partial<BeatmapJsonAvailableIncludes>;

export default BeatmapJson;
