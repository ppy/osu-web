// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import GameMode from './game-mode';
import UserJson from './user-json';

interface BeatmapsetNominationJsonAvailableIncludes {
  user: UserJson;
}

interface BeatmapsetNominationJsonDefaultAttributes {
  beatmapset_id: number;
  created_at: string;
  id: number;
  modes: GameMode[];
  reset: boolean;
  reset_user_id: number | null;
  updated_at: string | null;
  user_id: number;
}

type BeatmapsetNominationJson = BeatmapsetNominationJsonDefaultAttributes & Partial<BeatmapsetNominationJsonAvailableIncludes>;
export default BeatmapsetNominationJson;
