// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

export interface ModdingActivityHeatmapDayJson {
  date: string;
  nominations: number;
  posts: number;
  ranks: number;
}

export default interface ModdingActivityHeatmapJson {
  days: ModdingActivityHeatmapDayJson[];
  end_date: string;
  start_date: string;
}
