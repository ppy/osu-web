// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import Ruleset from 'interfaces/ruleset';
import ScoreModJson from 'interfaces/score-mod-json';
import SoloScoreJson, { SoloScoreStatisticsAttribute } from 'interfaces/solo-score-json';
import { route } from 'laroute';
import modNames from 'mod-names.json';
import core from 'osu-core-singleton';
import { rulesetName } from './beatmap-helper';
import { trans } from './lang';
import { legacyAccuracyAndRank } from './legacy-score-helper';

export function accuracy(score: SoloScoreJson) {
  const acc = shouldReturnLegacyValue(score)
    ? legacyAccuracyAndRank(score).accuracy
    : score.accuracy;

  // Matches rounding on client.
  // Reference: https://github.com/ppy/osu/blob/01828931a211fd4de31cacedbd73a247c1e22bd2/osu.Game/Utils/FormatUtils.cs#L20-L24
  return Math.floor(acc * 10000) / 10000;
}

export function canBeReported(score: SoloScoreJson) {
  return (score.best_id != null || score.type === 'solo_score')
    && core.currentUser != null
    && score.user_id !== core.currentUser.id;
}

/**
 * Process score mods array for display
 *
 * Removes CL mod on legacy score if user has lazer mode disabled
 * and sort the mods.
 */
export function filterMods(score: SoloScoreJson) {
  const shownMods = shouldReturnLegacyValue(score)
    ? score.mods.filter((mod) => mod.acronym !== 'CL')
    : score.mods;

  return shownMods
    .slice()
    .sort((a, b) => (modDetails(a).index[score.ruleset_id] ?? 0) - (modDetails(b).index[score.ruleset_id] ?? 0));
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

export function modDetails(mod: ScoreModJson) {
  return modNames[mod.acronym] ?? {
    acronym: mod.acronym,
    index: {},
    name: '',
    setting_labels: {},
    type: 'Fun',
  };
}

interface LeaderboardStatisticMapping {
  attributes: SoloScoreStatisticsAttribute[];
  key: string;
  label: string;
}

interface LeaderboardStatistic {
  key: string;
  label: string;
  total: number;
}

const labelMiss = trans('beatmapsets.show.scoreboard.headers.miss');

export const scoreStatisticsForLeaderboards: Record<Ruleset, LeaderboardStatisticMapping[]> = {
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

export function calculateStatisticsForLeaderboard(ruleset: Ruleset, score: SoloScoreJson): LeaderboardStatistic[] {
  return scoreStatisticsForLeaderboards[ruleset].map((mapping) => ({
    key: mapping.key,
    label: mapping.label,
    total: mapping.attributes.reduce((sum, attribute) => sum + (score.statistics[attribute] ?? 0), 0),
  }));
}

interface ScoreStatisticMapping {
  attributes: SoloScoreStatisticsAttribute[];
  basic: boolean;
  key: string;
  label: string;
}

interface ScoreStatistic {
  basic: boolean;
  key: string;
  label: string;
  maximum_value?: number;
  value: number;
}

export const scoreStatisticsForSingleScore: Record<Ruleset, ScoreStatisticMapping[]> = {
  fruits: [
    { attributes: ['great'], basic: true, key: 'great', label: 'great' },
    { attributes: ['miss'], basic: true, key: 'miss', label: labelMiss },
    { attributes: ['large_tick_hit'], basic: false, key: 'large_tick', label: 'large droplet' },
    { attributes: ['small_tick_hit'], basic: false, key: 'small_tick', label: 'small droplet' },
    { attributes: ['large_bonus'], basic: false, key: 'banana', label: 'banana' },
  ],
  mania: [
    { attributes: ['perfect'], basic: true, key: 'perfect', label: 'perfect' },
    { attributes: ['great'], basic: true, key: 'great', label: 'great' },
    { attributes: ['good'], basic: true, key: 'good', label: 'good' },
    { attributes: ['ok'], basic: true, key: 'ok', label: 'ok' },
    { attributes: ['meh'], basic: true, key: 'meh', label: 'meh' },
    { attributes: ['miss'], basic: true, key: 'miss', label: labelMiss },
  ],
  osu: [
    { attributes: ['great'], basic: true, key: 'great', label: 'great' },
    { attributes: ['ok'], basic: true, key: 'ok', label: 'ok' },
    { attributes: ['meh'], basic: true, key: 'meh', label: 'meh' },
    { attributes: ['miss'], basic: true, key: 'miss', label: labelMiss },
    { attributes: ['large_tick_hit'], basic: false, key: 'slider_tick', label: 'slider tick' },
    { attributes: ['small_tick_hit', 'slider_tail_hit'], basic: false, key: 'slider_end', label: 'slider end' },
    { attributes: ['small_bonus'], basic: false, key: 'spinner_spin', label: 'spinner spin' },
    { attributes: ['large_bonus'], basic: false, key: 'spinner_bonus', label: 'spinner bonus' },
  ],
  taiko: [
    { attributes: ['great'], basic: true, key: 'great', label: 'great' },
    { attributes: ['ok'], basic: true, key: 'ok', label: 'good' },
    { attributes: ['miss'], basic: true, key: 'miss', label: labelMiss },
    { attributes: ['small_bonus'], basic: false, key: 'drum_tick', label: 'drum tick' },
    { attributes: ['large_bonus'], basic: false, key: 'bonus', label: 'bonus' },
  ],
};

export function calculateStatisticsForSingleScore(score: SoloScoreJson): ScoreStatistic[] {
  return scoreStatisticsForSingleScore[rulesetName(score.ruleset_id)].map((mapping) => ({
    basic: mapping.basic,
    key: mapping.key,
    label: mapping.label,
    maximum_value: mapping.basic ? undefined : mapping.attributes.reduce((sum, attribute) => sum + (score.maximum_statistics[attribute] ?? 0), 0),
    value: mapping.attributes.reduce((sum, attribute) => sum + (score.statistics[attribute] ?? 0), 0),
  }));
}

export function rank(score: SoloScoreJson) {
  return shouldReturnLegacyValue(score)
    ? legacyAccuracyAndRank(score).rank
    : score.rank;
}

export function rankCutoffs(score: SoloScoreJson): number[] {
  // for SS, use minimum accuracy of 0.99 (any less and it's too small)
  // actual array is reversed as it's rendered from D to SS clockwise

  let absoluteCutoffs: number[] = [];
  const ruleset = rulesetName(score.ruleset_id);

  if (shouldReturnLegacyValue(score)) {
    switch (ruleset) {
      case 'fruits':
        absoluteCutoffs = [0, 0.8501, 0.9001, 0.9401, 0.9801, 0.99, 1];
        break;

      case 'mania':
        absoluteCutoffs = [0, 0.7, 0.8, 0.9, 0.95, 0.99, 1];
        break;

      case 'osu':
        // S: (0.9 * 300 + 0.1 * 100) / 300 = 0.933
        // A: (0.8 * 300 + 0.2 * 100) / 300 = 0.867
        // B: (0.7 * 300 + 0.3 * 100) / 300 = 0.8
        absoluteCutoffs = [0, 0.6, 0.8, 0.867, 0.933, 0.99, 1];
        break;

      case 'taiko':
        // S: (0.9 * 300 + 0.1 * 50) / 300 = 0.917
        // A: (0.8 * 300 + 0.2 * 50) / 300 = 0.833
        // B: (0.7 * 300 + 0.3 * 50) / 300 = 0.75
        absoluteCutoffs = [0, 0.6, 0.75, 0.833, 0.917, 0.99, 1];
        break;
    }
  } else {
    switch (ruleset) {
      case 'fruits':
        // cross-reference: https://github.com/ppy/osu/blob/b658d9a681a04101900d5ce6c5b84d56320e08e7/osu.Game.Rulesets.Catch/Scoring/CatchScoreProcessor.cs#L108-L135
        absoluteCutoffs = [0, 0.85, 0.9, 0.94, 0.98, 0.99, 1];
        break;

      case 'mania':
      case 'osu':
      case 'taiko':
        // cross-reference: https://github.com/ppy/osu/blob/b658d9a681a04101900d5ce6c5b84d56320e08e7/osu.Game/Rulesets/Scoring/ScoreProcessor.cs#L541-L572
        absoluteCutoffs = [0, 0.7, 0.8, 0.9, 0.95, 0.99, 1];
        break;
    }
  }

  return differenceBetweenConsecutiveElements(absoluteCutoffs);
}

function differenceBetweenConsecutiveElements(arr: number[]): number[] {
  const result = [];

  for (let i = 1; i < arr.length; ++i) {
    result.push(arr[i] - arr[i - 1]);
  }

  return result;
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
  if (shouldReturnLegacyValue(score)) {
    return score.legacy_total_score;
  }

  if (score.type === 'solo_score' && core.userPreferences.get('scoring_mode') === 'classic') {
    return score.classic_total_score;
  }

  return score.total_score;
}
