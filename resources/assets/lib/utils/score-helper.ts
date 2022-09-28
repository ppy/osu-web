// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import GameMode from 'interfaces/game-mode';
import SoloScoreJson, { SoloScoreStatisticsAttribute } from 'interfaces/solo-score-json';
import { route } from 'laroute';
import modNames from 'mod-names.json';
import core from 'osu-core-singleton';
import { rulesetName } from './beatmap-helper';

export function canBeReported(score: SoloScoreJson): score is SoloScoreJson & Required<Pick<SoloScoreJson, 'user'>> {
  return (score.best_id != null || score.type === 'solo_score')
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

export function hasShow(score: SoloScoreJson) {
  return score.best_id != null || score.type === 'solo_score';
}

const comboHitAttributes = [
  'good',
  'great',
  'large_tick_hit',
  'legacy_combo_increase',
  'meh',
  'ok',
  'perfect',
] as const;

export function isPerfectCombo(score: SoloScoreJson) {
  if (score.legacy_perfect != null) {
    return score.legacy_perfect;
  }

  if (rulesetName(score.ruleset_id) === 'mania') {
    return ([
      'miss',
      'large_tick_miss',
    ] as const).every((attr) => score.statistics[attr] == null || score.statistics[attr] === 0);
  }

  const maxAchievableCombo = comboHitAttributes.reduce(
    (acc, attr) => acc + (score.maximum_statistics[attr] ?? 0),
    0,
  );

  return maxAchievableCombo !== 0 && score.max_combo === maxAchievableCombo;
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

export function modName(acronym: string): string {
  return modNames[acronym] ?? 'unknown';
}

export function scoreDownloadUrl(score: SoloScoreJson) {
  if (score.type === 'solo_score') {
    return route('scores.download', { score: score.id });
  }

  if (score.best_id != null) {
    return route('scores.download-legacy', {
      mode: rulesetName(score.ruleset_id),
      score: score.best_id,
    });
  }

  throw new Error('score json doesn\'t have download url');
}

export function scoreUrl(score: SoloScoreJson) {
  if (score.type === 'solo_score') {
    return route('scores.show', { score: score.id });
  }

  if (score.best_id != null) {
    return route('scores.show-legacy', {
      mode: rulesetName(score.ruleset_id),
      score: score.best_id,
    });
  }

  throw new Error('score json doesn\'t have url');
}

export function totalScore(score: SoloScoreJson) {
  return score.legacy_total_score ?? score.total_score;
}
