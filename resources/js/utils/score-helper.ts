// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import GameMode from 'interfaces/game-mode';
import SoloScoreJson, { SoloScoreStatisticsAttribute } from 'interfaces/solo-score-json';
import { route } from 'laroute';
import core from 'osu-core-singleton';
import { rulesetName } from './beatmap-helper';
import { trans } from './lang';
import { legacyAccuracyAndRank } from './legacy-score-helper';

export function accuracy(score: SoloScoreJson) {
  return shouldReturnLegacyValue(score)
    ? legacyAccuracyAndRank(score).accuracy
    : score.accuracy;
}

export function canBeReported(score: SoloScoreJson) {
  return (score.best_id != null || score.type === 'solo_score')
    && core.currentUser != null
    && score.user_id !== core.currentUser.id;
}

// Removes CL mod on legacy score if user has lazer mode disabled
export function filterMods(score: SoloScoreJson) {
  return shouldReturnLegacyValue(score)
    ? score.mods.filter((mod) => mod.acronym !== 'CL')
    : score.mods;

}

// TODO: move to application state repository thingy later
export function hasMenu(score: SoloScoreJson) {
  return canBeReported(score) || hasReplay(score) || hasShow(score) || core.scorePins.canBePinned(score);
}

export function hasReplay(score: SoloScoreJson) {
  return score.has_replay;
}

export function hasShow(score: SoloScoreJson) {
  return score.best_id != null || score.type === 'solo_score';
}

export function isPerfectCombo(score: SoloScoreJson) {
  return shouldReturnLegacyValue(score)
    ? score.legacy_perfect
    : score.is_perfect_combo;
}

interface AttributeDisplayMapping {
  attributes: SoloScoreStatisticsAttribute[];
  key: string;
  label: string;
}

interface AttributeDisplayTotal {
  key: string;
  label: string;
  total: number;
}

const labelMiss = trans('beatmapsets.show.scoreboard.headers.miss');

export const modeAttributesMap: Record<GameMode, AttributeDisplayMapping[]> = {
  fruits: [
    { attributes: ['great'], key: 'great', label: 'fruits' },
    { attributes: ['large_tick_hit'], key: 'ticks', label: 'ticks' },
    { attributes: ['small_tick_miss'], key: 'drp_miss', label: 'drp miss' },
    // legacy/stable scores merge miss and large_tick_miss into one number
    { attributes: ['miss', 'large_tick_miss'], key: 'miss', label: labelMiss },
  ],
  mania: [
    { attributes: ['perfect'], key: 'perfect', label: 'max' },
    { attributes: ['great'], key: 'great', label: '300' },
    { attributes: ['good'], key: 'good', label: '200' },
    { attributes: ['ok'], key: 'ok', label: '100' },
    { attributes: ['meh'], key: 'meh', label: '50' },
    { attributes: ['miss'], key: 'miss', label: labelMiss },
  ],
  osu: [
    { attributes: ['great'], key: 'great', label: '300' },
    { attributes: ['ok'], key: 'ok', label: '100' },
    { attributes: ['meh'], key: 'meh', label: '50' },
    { attributes: ['miss'], key: 'miss', label: labelMiss },
  ],
  taiko: [
    { attributes: ['great'], key: 'great', label: 'great' },
    { attributes: ['ok'], key: 'ok', label: 'good' },
    { attributes: ['miss'], key: 'miss', label: labelMiss },
  ],
};

export function attributeDisplayTotals(ruleset: GameMode, score: SoloScoreJson): AttributeDisplayTotal[] {
  return modeAttributesMap[ruleset].map((mapping) => ({
    key: mapping.key,
    label: mapping.label,
    total: mapping.attributes.reduce((sum, attribute) => sum + (score.statistics[attribute] ?? 0), 0),
  }));
}

export function rank(score: SoloScoreJson) {
  return shouldReturnLegacyValue(score)
    ? legacyAccuracyAndRank(score).rank
    : score.rank;
}

export function scoreDownloadUrl(score: SoloScoreJson) {
  if (score.type === 'solo_score') {
    return route('scores.download', { score: score.id });
  }

  if (score.best_id != null) {
    return route('scores.download-legacy', {
      rulesetOrScore: rulesetName(score.ruleset_id),
      score: score.best_id,
    });
  }

  throw new Error('score json doesn\'t have download url');
}

export function scoreUrl(score: SoloScoreJson) {
  if (score.type === 'solo_score') {
    return route('scores.show', { rulesetOrScore: score.id });
  }

  if (score.best_id != null) {
    return route('scores.show', {
      rulesetOrScore: rulesetName(score.ruleset_id),
      score: score.best_id,
    });
  }

  throw new Error('score json doesn\'t have url');
}

function shouldReturnLegacyValue(score: SoloScoreJson) {
  return score.legacy_score_id !== null && core.userPreferences.get('legacy_score_only');
}

export function totalScore(score: SoloScoreJson) {
  return shouldReturnLegacyValue(score)
    ? score.legacy_total_score
    : score.total_score;
}
