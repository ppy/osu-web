// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import GameMode from 'interfaces/game-mode';

type ScoreStatsAttribute = 'count_50' | 'count_100' | 'count_300' | 'count_geki' | 'count_katu' | 'count_miss';

interface AttributeData {
  attribute: ScoreStatsAttribute;
  label: string;
}

const labelMiss = osu.trans('beatmapsets.show.scoreboard.headers.miss');

export const modeAttributesMap: Record<GameMode, AttributeData[]> = {
  fruits: [
    { attribute: 'count_300', label: 'fruits' },
    { attribute: 'count_100', label: 'ticks' },
    { attribute: 'count_katu', label: 'drp miss' },
    { attribute: 'count_miss', label: labelMiss },
  ],
  mania: [
    { attribute: 'count_geki', label: 'max' },
    { attribute: 'count_300', label: '300' },
    { attribute: 'count_katu', label: '200' },
    { attribute: 'count_100', label: '100' },
    { attribute: 'count_50', label: '50' },
    { attribute: 'count_miss', label: labelMiss },
  ],
  osu: [
    { attribute: 'count_300', label: '300' },
    { attribute: 'count_100', label: '100' },
    { attribute: 'count_50', label: '50' },
    { attribute: 'count_miss', label: labelMiss },
  ],
  taiko: [
    { attribute: 'count_300', label: 'great' },
    { attribute: 'count_100', label: 'good' },
    { attribute: 'count_miss', label: labelMiss },
  ],
};
