// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import GameMode from './game-mode';

export default interface BeatmapJson {
  difficulty_rating: number;
  id: number;
  max_combo?: number;
  mode: GameMode;
  version: string;
}
