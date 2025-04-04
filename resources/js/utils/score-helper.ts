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

type ScoreDisplayType = 'leaderboard' | 'single';

interface ScoreStatisticMapping {
  attributes: SoloScoreStatisticsAttribute[];
  basic: boolean;
  longLabel: string;
  relevantTypes: ScoreDisplayType[];
  shortLabel: string;
}

interface ScoreStatistic {
  basic: boolean;
  longLabel: string;
  maximumValue?: number;
  shortLabel: string;
  value: number;
}

const labelMiss = trans('beatmapsets.show.scoreboard.headers.miss');

export const scoreStatisticsMapping: Record<Ruleset, ScoreStatisticMapping[]> = {
  fruits: [
    { attributes: ['great'], basic: true, longLabel: 'great', relevantTypes: ['leaderboard', 'single'], shortLabel: 'fruits' },
    // for single score display, show miss display separately
    { attributes: ['miss'], basic: true, longLabel: labelMiss, relevantTypes: ['single'], shortLabel: labelMiss },
    { attributes: ['large_tick_hit'], basic: false, longLabel: 'large droplet', relevantTypes: ['leaderboard', 'single'], shortLabel: 'ticks' },
    { attributes: ['small_tick_hit'], basic: false, longLabel: 'small droplet', relevantTypes: ['single'], shortLabel: 'ticks' },
    { attributes: ['small_tick_miss'], basic: false, longLabel: 'small droplet miss', relevantTypes: ['leaderboard'], shortLabel: 'drp miss' },
    // legacy/stable scores merge miss and large_tick_miss into one number, so for leaderboard display merge them together
    { attributes: ['miss', 'large_tick_miss'], basic: false, longLabel: labelMiss, relevantTypes: ['leaderboard'], shortLabel: labelMiss },
    { attributes: ['large_bonus'], basic: false, longLabel: 'banana', relevantTypes: ['single'], shortLabel: 'banana' },
  ],
  mania: [
    { attributes: ['perfect'], basic: true, longLabel: 'perfect', relevantTypes: ['leaderboard', 'single'], shortLabel: 'max' },
    { attributes: ['great'], basic: true, longLabel: 'great', relevantTypes: ['leaderboard', 'single'], shortLabel: '300' },
    { attributes: ['good'], basic: true, longLabel: 'good', relevantTypes: ['leaderboard', 'single'], shortLabel: '200' },
    { attributes: ['ok'], basic: true, longLabel: 'ok', relevantTypes: ['leaderboard', 'single'], shortLabel: '100' },
    { attributes: ['meh'], basic: true, longLabel: 'meh', relevantTypes: ['leaderboard', 'single'], shortLabel: '50' },
    { attributes: ['miss'], basic: true, longLabel: labelMiss, relevantTypes: ['leaderboard', 'single'], shortLabel: labelMiss },
  ],
  osu: [
    { attributes: ['great'], basic: true, longLabel: 'great', relevantTypes: ['leaderboard', 'single'], shortLabel: '300' },
    { attributes: ['ok'], basic: true, longLabel: 'ok', relevantTypes: ['leaderboard', 'single'], shortLabel: '100' },
    { attributes: ['meh'], basic: true, longLabel: 'meh', relevantTypes: ['leaderboard', 'single'], shortLabel: '50' },
    { attributes: ['miss'], basic: true, longLabel: 'miss', relevantTypes: ['leaderboard', 'single'], shortLabel: labelMiss },
    { attributes: ['large_tick_hit'], basic: false, longLabel: 'slider tick', relevantTypes: ['single'], shortLabel: 'tick' },
    { attributes: ['small_tick_hit', 'slider_tail_hit'], basic: false, longLabel: 'slider end', relevantTypes: ['single'], shortLabel: 'end' },
    { attributes: ['small_bonus'], basic: false, longLabel: 'spinner spin', relevantTypes: ['single'], shortLabel: 'spin' },
    { attributes: ['large_bonus'], basic: false, longLabel: 'spinner bonus', relevantTypes: ['single'], shortLabel: 'bonus' },
  ],
  taiko: [
    { attributes: ['great'], basic: true, longLabel: 'great', relevantTypes: ['leaderboard', 'single'], shortLabel: 'great' },
    { attributes: ['ok'], basic: true, longLabel: 'ok', relevantTypes: ['leaderboard', 'single'], shortLabel: 'ok' },
    { attributes: ['miss'], basic: true, longLabel: labelMiss, relevantTypes: ['leaderboard', 'single'], shortLabel: labelMiss },
    { attributes: ['small_bonus'], basic: false, longLabel: 'drum tick', relevantTypes: ['single'], shortLabel: 'drum tick' },
    { attributes: ['large_bonus'], basic: false, longLabel: 'bonus', relevantTypes: ['single'], shortLabel: 'bonus' },
  ],
};

export function calculateStatisticsFor(score: SoloScoreJson, type: ScoreDisplayType): ScoreStatistic[] {
  return scoreStatisticsMapping[rulesetName(score.ruleset_id)]
    .filter((mapping) => mapping.relevantTypes.includes(type))
    .map((mapping) => ({
      basic: mapping.basic,
      longLabel: mapping.longLabel,
      maximumValue: mapping.basic ? undefined : mapping.attributes.reduce((sum, attribute) => sum + (score.maximum_statistics[attribute] ?? 0), 0),
      shortLabel: mapping.shortLabel,
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
