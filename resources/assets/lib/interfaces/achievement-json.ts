// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import GameMode from 'interfaces/game-mode';

export default interface AchievementJson {
  description: string;
  grouping: string;
  icon_url: string;
  id: number;
  instructions: string | null;
  mode: GameMode;
  name: string;
  ordering: number;
  slug: string;
}
