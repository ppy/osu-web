// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

export default interface DailyChallengeUserStatsJson {
  daily_streak_best: number;
  daily_streak_current: number;
  last_update: string | null;
  last_weekly_streak: string | null;
  playcount: number;
  top_10p_placements: number;
  top_50p_placements: number;
  user_id: number;
  weekly_streak_best: number;
  weekly_streak_current: number;
}
