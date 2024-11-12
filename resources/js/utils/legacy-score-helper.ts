// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import Rank from 'interfaces/rank';
import SoloScoreJson from 'interfaces/solo-score-json';

interface CacheEntry {
  accuracy: number;
  rank: Rank;
}
let cache: Partial<Record<string, CacheEntry>> = {};

// reset cache on navigation
document.addEventListener('turbo:load', () => {
  cache = {};
});

function shouldHaveHiddenRank(score: SoloScoreJson) {
  return score.mods.some((mod) => mod.acronym === 'FI' || mod.acronym === 'FL' || mod.acronym === 'HD');
}

export function legacyAccuracyAndRank(score: SoloScoreJson) {
  const key = `${score.type}:${score.id}`;
  let cached = cache[key];

  if (cached == null) {
    const countMiss = score.statistics.miss ?? 0;
    const countGreat = score.statistics.great ?? 0;

    let accuracy: number;
    let rank: Rank;

    // Reference: https://github.com/ppy/osu/blob/e3ffea1b127cbd3171010972588a8b07cf049ba0/osu.Game/Scoring/Legacy/LegacyScoreDecoder.cs#L170-L274
    switch (score.ruleset_id) {
      // osu
      case 0: {
        const countMeh = score.statistics.meh ?? 0;
        const countOk = score.statistics.ok ?? 0;

        const totalHits = countMeh + countOk + countGreat + countMiss;
        accuracy = totalHits > 0
          ? (countMeh * 50 + countOk * 100 + countGreat * 300) / (totalHits * 300)
          : 1;

        const ratioGreat = totalHits > 0 ? countGreat / totalHits : 1;
        const ratioMeh = totalHits > 0 ? countMeh / totalHits : 1;

        if (score.rank === 'F') {
          rank = 'F';
        } else if (ratioGreat === 1) {
          rank = shouldHaveHiddenRank(score) ? 'XH' : 'X';
        } else if (ratioGreat > 0.9 && ratioMeh <= 0.01 && countMiss === 0) {
          rank = shouldHaveHiddenRank(score) ? 'SH' : 'S';
        } else if ((ratioGreat > 0.8 && countMiss === 0) || ratioGreat > 0.9) {
          rank = 'A';
        } else if ((ratioGreat > 0.7 && countMiss === 0) || ratioGreat > 0.8) {
          rank = 'B';
        } else if (ratioGreat > 0.6) {
          rank = 'C';
        } else {
          rank = 'D';
        }
        break;
      }
      // taiko
      case 1: {
        const countOk = score.statistics.ok ?? 0;

        const totalHits = countOk + countGreat + countMiss;
        accuracy = totalHits > 0
          ? (countOk * 150 + countGreat * 300) / (totalHits * 300)
          : 1;

        const ratioGreat = totalHits > 0 ? countGreat / totalHits : 1;

        if (score.rank === 'F') {
          rank = 'F';
        } else if (ratioGreat === 1) {
          rank = shouldHaveHiddenRank(score) ? 'XH' : 'X';
        } else if (ratioGreat > 0.9 && countMiss === 0) {
          rank = shouldHaveHiddenRank(score) ? 'SH' : 'S';
        } else if ((ratioGreat > 0.8 && countMiss === 0) || ratioGreat > 0.9) {
          rank = 'A';
        } else if ((ratioGreat > 0.7 && countMiss === 0) || ratioGreat > 0.8) {
          rank = 'B';
        } else if (ratioGreat > 0.6) {
          rank = 'C';
        } else {
          rank = 'D';
        }
        break;
      }
      // catch
      case 2: {
        const countLargeTickHit = score.statistics.large_tick_hit ?? 0;
        const countSmallTickHit = score.statistics.small_tick_hit ?? 0;
        const countSmallTickMiss = score.statistics.small_tick_miss ?? 0;

        const totalHits = countSmallTickHit + countLargeTickHit + countGreat + countMiss + countSmallTickMiss;
        accuracy = totalHits > 0
          ? (countSmallTickHit + countLargeTickHit + countGreat) / totalHits
          : 1;

        if (score.rank === 'F') {
          rank = 'F';
        } else if (accuracy === 1) {
          rank = shouldHaveHiddenRank(score) ? 'XH' : 'X';
        } else if (accuracy > 0.98) {
          rank = shouldHaveHiddenRank(score) ? 'SH' : 'S';
        } else if (accuracy > 0.94) {
          rank = 'A';
        } else if (accuracy > 0.9) {
          rank = 'B';
        } else if (accuracy > 0.85) {
          rank = 'C';
        } else {
          rank = 'D';
        }
        break;
      }
      // mania
      case 3: {
        const countPerfect = score.statistics.perfect ?? 0;
        const countGood = score.statistics.good ?? 0;
        const countOk = score.statistics.ok ?? 0;
        const countMeh = score.statistics.meh ?? 0;

        const totalHits = countPerfect + countGood + countOk + countMeh + countGreat + countMiss;
        accuracy = totalHits > 0
          ? ((countGreat + countPerfect) * 300 + countGood * 200 + countOk * 100 + countMeh * 50) / (totalHits * 300)
          : 1;

        if (score.rank === 'F') {
          rank = 'F';
        } else if (accuracy === 1) {
          rank = shouldHaveHiddenRank(score) ? 'XH' : 'X';
        } else if (accuracy > 0.95) {
          rank = shouldHaveHiddenRank(score) ? 'SH' : 'S';
        } else if (accuracy > 0.9) {
          rank = 'A';
        } else if (accuracy > 0.8) {
          rank = 'B';
        } else if (accuracy > 0.7) {
          rank = 'C';
        } else {
          rank = 'D';
        }
        break;
      }
      default:
        throw new Error('unknown score ruleset');
    }

    cached = cache[key] = { accuracy, rank };
  }

  return cached;
}
