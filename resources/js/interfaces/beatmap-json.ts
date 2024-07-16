// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapsetJson from './beatmapset-json';
import Ruleset from './ruleset';
import UserJson from './user-json';

interface BeatmapFailTimesArray {
  exit: number[];
  fail: number[];
}

interface BeatmapJsonAvailableIncludes {
  beatmapset: BeatmapsetJson | null;
  checksum: string | null;
  failtimes: BeatmapFailTimesArray;
  mappers: Mapper[];
  max_combo: number;
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
type Mapper = Pick<UserJson, 'id' | 'username'>;

export default BeatmapJson;
