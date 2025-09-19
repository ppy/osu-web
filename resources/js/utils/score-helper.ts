// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import Ruleset from 'interfaces/ruleset';
import ScoreJson, { ScoreStatisticsAttribute } from 'interfaces/score-json';
import ScoreModJson from 'interfaces/score-mod-json';
import { route } from 'laroute';
import modNames from 'mod-names.json';
import core from 'osu-core-singleton';
import { rulesetName } from './beatmap-helper';
import { trans } from './lang';
import { legacyAccuracyAndRank } from './legacy-score-helper';

export function accuracy(score: ScoreJson) {
  const acc = shouldReturnLegacyValue(score)
    ? legacyAccuracyAndRank(score).accuracy
    : score.accuracy;

  // Matches rounding on client.
  // Reference: https://github.com/ppy/osu/blob/01828931a211fd4de31cacedbd73a247c1e22bd2/osu.Game/Utils/FormatUtils.cs#L20-L24
  return Math.floor(acc * 10000) / 10000;
}

export function canBeReported(score: ScoreJson) {
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
export function filterMods(score: ScoreJson) {
  const shownMods = shouldReturnLegacyValue(score)
    ? score.mods.filter((mod) => mod.acronym !== 'CL')
    : score.mods;

  return shownMods
    .slice()
    .sort((a, b) => (modDetails(a).index[score.ruleset_id] ?? 0) - (modDetails(b).index[score.ruleset_id] ?? 0));
}

// TODO: move to application state repository thingy later
export function hasMenu(score: ScoreJson) {
  return canBeReported(score) || hasReplay(score) || hasShow(score) || core.scorePins.canBePinned(score);
}

export function hasReplay(score: ScoreJson) {
  return score.has_replay;
}

export function hasShow(score: ScoreJson) {
  return score.best_id != null || score.type === 'solo_score';
}

export function isPerfectCombo(score: ScoreJson) {
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
  attributes: ScoreStatisticsAttribute[];
  basic: boolean;
  label: {
    long: string;
    short: string;
  };
  relevantTypes: ScoreDisplayType[];
}

interface ScoreStatistic {
  basic: boolean;
  label: {
    long: string;
    short: string;
  };
  maximumValue?: number;
  value: number;
}

const labelMiss = trans('beatmapsets.show.scoreboard.headers.miss');

export const scoreStatisticsMapping: Record<Ruleset, ScoreStatisticMapping[]> = {
  fruits: [
    { attributes: ['great'], basic: true, label: { long: 'great', short: 'great' }, relevantTypes: ['leaderboard', 'single'] },
    // for single score display, show miss display separately
    { attributes: ['miss'], basic: true, label: { long: labelMiss, short: labelMiss }, relevantTypes: ['single'] },
    { attributes: ['large_tick_hit'], basic: false, label: { long: 'large droplet', short: 'l drp' }, relevantTypes: ['leaderboard', 'single'] },
    { attributes: ['small_tick_hit'], basic: false, label: { long: 'small droplet', short: 's drp' }, relevantTypes: ['single'] },
    { attributes: ['small_tick_miss'], basic: false, label: { long: 'small droplet miss', short: 's drp miss' }, relevantTypes: ['leaderboard'] },
    // legacy/stable scores merge miss and large_tick_miss into one number, so for leaderboard display merge them together
    { attributes: ['miss', 'large_tick_miss'], basic: false, label: { long: labelMiss, short: labelMiss }, relevantTypes: ['leaderboard'] },
    { attributes: ['large_bonus'], basic: false, label: { long: 'banana', short: 'banana' }, relevantTypes: ['single'] },
  ],
  mania: [
    { attributes: ['perfect'], basic: true, label: { long: 'perfect', short: 'perfect' }, relevantTypes: ['leaderboard', 'single'] },
    { attributes: ['great'], basic: true, label: { long: 'great', short: 'great' }, relevantTypes: ['leaderboard', 'single'] },
    { attributes: ['good'], basic: true, label: { long: 'good', short: 'good' }, relevantTypes: ['leaderboard', 'single'] },
    { attributes: ['ok'], basic: true, label: { long: 'ok', short: 'ok' }, relevantTypes: ['leaderboard', 'single'] },
    { attributes: ['meh'], basic: true, label: { long: 'meh', short: 'meh' }, relevantTypes: ['leaderboard', 'single'] },
    { attributes: ['miss'], basic: true, label: { long: labelMiss, short: labelMiss }, relevantTypes: ['leaderboard', 'single'] },
  ],
  osu: [
    { attributes: ['great'], basic: true, label: { long: 'great', short: 'great' }, relevantTypes: ['leaderboard', 'single'] },
    { attributes: ['ok'], basic: true, label: { long: 'ok', short: 'ok' }, relevantTypes: ['leaderboard', 'single'] },
    { attributes: ['meh'], basic: true, label: { long: 'meh', short: 'meh' }, relevantTypes: ['leaderboard', 'single'] },
    { attributes: ['miss'], basic: true, label: { long: labelMiss, short: labelMiss }, relevantTypes: ['leaderboard', 'single'] },
    { attributes: ['large_tick_hit'], basic: false, label: { long: 'slider tick', short: 'tick' }, relevantTypes: ['single'] },
    { attributes: ['small_tick_hit', 'slider_tail_hit'], basic: false, label: { long: 'slider end', short: 'end' }, relevantTypes: ['single'] },
    { attributes: ['small_bonus'], basic: false, label: { long: 'spinner spin', short: 'spin' }, relevantTypes: ['single'] },
    { attributes: ['large_bonus'], basic: false, label: { long: 'spinner bonus', short: 'bonus' }, relevantTypes: ['single'] },
  ],
  taiko: [
    { attributes: ['great'], basic: true, label: { long: 'great', short: 'great' }, relevantTypes: ['leaderboard', 'single'] },
    { attributes: ['ok'], basic: true, label: { long: 'ok', short: 'ok' }, relevantTypes: ['leaderboard', 'single'] },
    { attributes: ['miss'], basic: true, label: { long: labelMiss, short: labelMiss }, relevantTypes: ['leaderboard', 'single'] },
    { attributes: ['small_bonus'], basic: false, label: { long: 'drum tick', short: 'tick' }, relevantTypes: ['single'] },
    { attributes: ['large_bonus'], basic: false, label: { long: 'bonus', short: 'bonus' }, relevantTypes: ['single'] },
  ],
};

export function calculateStatisticsFor(score: ScoreJson, type: ScoreDisplayType): ScoreStatistic[] {
  return scoreStatisticsMapping[rulesetName(score.ruleset_id)]
    .filter((mapping) => mapping.relevantTypes.includes(type))
    .map((mapping) => ({
      basic: mapping.basic,
      label: mapping.label,
      maximumValue: mapping.basic ? undefined : mapping.attributes.reduce((sum, attribute) => sum + (score.maximum_statistics[attribute] ?? 0), 0),
      value: mapping.attributes.reduce((sum, attribute) => sum + (score.statistics[attribute] ?? 0), 0),
    }));
}

export function rank(score: ScoreJson) {
  return shouldReturnLegacyValue(score)
    ? legacyAccuracyAndRank(score).rank
    : score.rank;
}

export function rankCutoffs(score: ScoreJson): number[] {
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

export function scoreDownloadUrl(score: ScoreJson) {
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

export function scoreUrl(score: ScoreJson) {
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

function shouldReturnLegacyValue(score: ScoreJson) {
  return score.legacy_score_id !== null && core.userPreferences.get('legacy_score_only');
}

export function totalScore(score: ScoreJson) {
  if (shouldReturnLegacyValue(score)) {
    return score.legacy_total_score;
  }

  if (score.type === 'solo_score' && core.userPreferences.get('scoring_mode') === 'classic') {
    return score.classic_total_score;
  }

  return score.total_score;
}
