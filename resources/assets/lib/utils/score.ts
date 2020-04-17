// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import GameMode from 'interfaces/game-mode';

type ScoreStatsAttribute = 'count_50' | 'count_100' | 'count_300' | 'count_geki' | 'count_katu' | 'count_miss';

interface AttributeData {
  attribute: ScoreStatsAttribute;
  label: string;
}

export const modeAttributesMap: Record<GameMode, AttributeData[]> = {
  fruits: [
    { label: 'fruits', attribute: 'count_300' },
    { label: 'ticks', attribute: 'count_100' },
    { label: 'drp miss', attribute: 'count_katu' },
    { label: 'miss', attribute: 'count_miss' },
  ],
  mania: [
    { label: 'max', attribute: 'count_geki' },
    { label: '300', attribute: 'count_300' },
    { label: '200', attribute: 'count_katu' },
    { label: '100', attribute: 'count_100' },
    { label: '50', attribute: 'count_50' },
    { label: 'miss', attribute: 'count_miss' },
  ],
  osu: [
    { label: '300', attribute: 'count_300' },
    { label: '100', attribute: 'count_100' },
    { label: '50', attribute: 'count_50' },
    { label: 'miss', attribute: 'count_miss' },
  ],
  taiko: [
    { label: 'great', attribute: 'count_300' },
    { label: 'good', attribute: 'count_100' },
    { label: 'miss', attribute: 'count_miss' },
  ],
};
