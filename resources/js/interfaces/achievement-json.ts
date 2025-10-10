// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import Ruleset from './ruleset';

export default interface AchievementJson {
  achieved_percent: number;
  description: string;
  grouping: string;
  icon_url: string;
  id: number;
  instructions: string | null;
  mode: Ruleset | null;
  name: string;
  ordering: number;
  slug: string;
}
