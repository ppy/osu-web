// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapsetJson from './beatmapset-json';
import GameMode from './game-mode';
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
  user: UserJson;
}

interface BeatmapJsonDefaultAttributes {
  beatmapset_id: number;
  difficulty_rating: number;
  id: number;
  mode: GameMode;
  status: string;
  total_length: number;
  user_id: number;
  version: string;
}

type BeatmapJson = BeatmapJsonDefaultAttributes & Partial<BeatmapJsonAvailableIncludes>;
export default BeatmapJson;
