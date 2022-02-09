// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

export const scoreboardTypes = ['global', 'country', 'friend'] as const;

type ScoreboardType = typeof scoreboardTypes[number];
export default ScoreboardType;
