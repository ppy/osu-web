// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import GameMode from 'interfaces/game-mode';
import SoloScoreJson, { SoloScoreStatisticsAttribute } from 'interfaces/solo-score-json';
import core from 'osu-core-singleton';

export function canBeReported(score: SoloScoreJson): score is SoloScoreJson & Required<Pick<SoloScoreJson, 'best_id' | 'user'>> {
  return score.best_id != null
    && score.user != null
    && !score.user.is_deleted
    && core.currentUser != null
    && score.user_id !== core.currentUser.id;
}

// TODO: move to application state repository thingy later
export function hasMenu(score: SoloScoreJson) {
  return canBeReported(score) || hasReplay(score) || hasShow(score) || core.scorePins.canBePinned(score);
}

export function hasReplay(score: SoloScoreJson) {
  return score.replay != null && score.replay;
}

export function hasShow(score: SoloScoreJson): score is SoloScoreJson & Required<Pick<SoloScoreJson, 'best_id'>> {
  return score.best_id != null;
}

interface AttributeData {
  attribute: SoloScoreStatisticsAttribute;
  label: string;
}

const labelMiss = osu.trans('beatmapsets.show.scoreboard.headers.miss');

export const modeAttributesMap: Record<GameMode, AttributeData[]> = {
  fruits: [
    { attribute: 'great', label: 'fruits' },
    { attribute: 'large_tick_hit', label: 'ticks' },
    { attribute: 'small_tick_miss', label: 'drp miss' },
    { attribute: 'miss', label: labelMiss },
  ],
  mania: [
    { attribute: 'perfect', label: 'max' },
    { attribute: 'great', label: '300' },
    { attribute: 'good', label: '200' },
    { attribute: 'ok', label: '100' },
    { attribute: 'meh', label: '50' },
    { attribute: 'miss', label: labelMiss },
  ],
  osu: [
    { attribute: 'great', label: '300' },
    { attribute: 'ok', label: '100' },
    { attribute: 'meh', label: '50' },
    { attribute: 'miss', label: labelMiss },
  ],
  taiko: [
    { attribute: 'great', label: 'great' },
    { attribute: 'ok', label: 'good' },
    { attribute: 'miss', label: labelMiss },
  ],
};
