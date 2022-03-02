// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

export const gameModes = ['osu', 'taiko', 'fruits', 'mania'] as const;

type GameMode = typeof gameModes[number];

export default GameMode;
