// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import * as d3 from 'd3';
import { isValid as isBeatmapExtendedJson } from 'interfaces/beatmap-extended-json';
import BeatmapJson from 'interfaces/beatmap-json';
import BeatmapsetJson from 'interfaces/beatmapset-json';
import Ruleset, { rulesets } from 'interfaces/ruleset';
import WithBeatmapOwners from 'interfaces/with-beatmap-owners';
import * as _ from 'lodash';
import core from 'osu-core-singleton';
import { parseJsonNullable } from 'utils/json';

function isVisibleBeatmap(beatmap: BeatmapJson) {
  if (isBeatmapExtendedJson(beatmap)) {
    return beatmap.deleted_at == null && !beatmap.convert;
  }

  return true;
}

const difficultyColourSpectrum = d3.scaleLinear<string>()
  .domain([0.1, 1.25, 2, 2.5, 3.3, 4.2, 4.9, 5.8, 6.7, 7.7, 9])
  .clamp(true)
  .range(['#4290FB', '#4FC0FF', '#4FFFD5', '#7CFF4F', '#F6F05C', '#FF8068', '#FF4E6F', '#C645B8', '#6563DE', '#18158E', '#000000'])
  .interpolate(d3.interpolateRgb.gamma(2.2));

const difficultyTextColourSpectrum = d3.scaleLinear<string>()
  .domain([9, 9.9, 10.6, 11.5, 12.4])
  .clamp(true)
  .range(['#F6F05C', '#FF8068', '#FF4E6F', '#C645B8', '#6563DE', '#18158E'])
  .interpolate(d3.interpolateRgb.gamma(2.2));

interface FindDefaultParams<T> {
  group?: Map<Ruleset, T[]>;
  items?: T[];
  mode?: Ruleset;
}

export function findDefault<T extends BeatmapJson>(params: FindDefaultParams<T>): T | null {
  if (params.items != null) {
    let currentDiffDelta: number | null = null;
    let currentItem: T | null = null;
    const targetDiff = userRecommendedDifficulty(params.mode ?? rulesets[0]);

    for (const item of params.items) {
      const diffDelta = Math.abs(item.difficulty_rating - targetDiff);

      if (isVisibleBeatmap(item) && (currentDiffDelta == null || diffDelta < currentDiffDelta)) {
        currentDiffDelta = diffDelta;
        currentItem = item;
      }
    }

    return currentItem ?? _.last(params.items) ?? null;
  }

  if (params.group == null) return null;

  const findModes = params.mode == null ? userModes() : [params.mode];

  for (const m of findModes) {
    const beatmap = findDefault({ items: params.group.get(m) ?? [], mode: m });

    if (beatmap != null) return beatmap;
  }

  return null;
}

interface FindParams<T> {
  group: Map<Ruleset, T[]>;
  id: number;
  mode?: Ruleset;
}

export function find<T extends BeatmapJson>(params: FindParams<T>): T | null {
  const findModes = params.mode == null ? userModes() : [params.mode];

  for (const m of findModes) {
    const item = params.group.get(m)?.find((i) => i.id === params.id);

    if (item != null) return item;
  }

  return null;
}

export function getDiffColour(rating: number) {
  if (rating < 0.1) return '#AAAAAA';
  if (rating >= 9) return '#000000';
  return difficultyColourSpectrum(rating);
}

export function getDiffTextColour(rating: number) {
  if (rating < 6.5) return '#000000';
  if (rating < 9) return '#F6F05C';
  return difficultyTextColourSpectrum(rating);
}

export function group<T extends BeatmapJson>(beatmaps?: T[] | null, includeEmpty = true): Map<Ruleset, T[]> {
  // TODO: replace with mapBy
  const grouped: Partial<Record<Ruleset, T[]>> = _.groupBy(beatmaps ?? [], 'mode');
  const ret = new Map<Ruleset, T[]>();

  rulesets.forEach((mode) => {
    const value = grouped[mode];
    if (value != null || includeEmpty) {
      ret.set(mode, sort(value ?? []));
    }
  });

  return ret;
}

export function hasGuestOwners(beatmap: WithBeatmapOwners<BeatmapJson>, beatmapset: BeatmapsetJson) {
  return beatmap.owners.some((owner) => owner.id !== beatmapset.user_id);
}

export function isOwner(userId: number, beatmap: WithBeatmapOwners<BeatmapJson>) {
  return beatmap.owners.some((owner) => owner.id === userId);
}

export function rulesetName(id: number): Ruleset {
  switch (id) {
    case 0:
      return 'osu';
    case 1:
      return 'taiko';
    case 2:
      return 'fruits';
    case 3:
      return 'mania';
    default:
      throw new Error('invalid ruleset id passed');
  }
}

export function shouldShowPp(beatmap: BeatmapJson) {
  return beatmap.status === 'ranked' || beatmap.status === 'approved';
}

export function sort<T extends BeatmapJson>(beatmaps: T[]): T[] {
  if (beatmaps.length === 0) {
    return [];
  }

  if (beatmaps[0].mode === 'mania') {
    return _.orderBy(beatmaps, ['convert', 'cs', 'difficulty_rating'], ['desc', 'asc', 'asc']);
  }

  return _.orderBy(beatmaps, ['convert', 'difficulty_rating'], ['desc', 'asc']);
}

export function sortWithMode<T extends BeatmapJson>(beatmaps: T[]): T[] {
  return [...group(beatmaps).values()].flat();
}

function userModes() {
  const currentMode = core.currentUser?.playmode;
  if (currentMode == null || !rulesets.includes(currentMode)) {
    return rulesets;
  }

  const ret = _.without(rulesets, currentMode);
  ret.unshift(currentMode);

  return ret;
}

let userRecommendedDifficultyCache: Partial<Record<Ruleset, number>> | null = null;

function userRecommendedDifficulty(mode: Ruleset) {
  if (userRecommendedDifficultyCache == null) {
    userRecommendedDifficultyCache = parseJsonNullable('json-recommended-star-difficulty-all') ?? {};
    $(document).one('turbo:before-cache', () => {
      userRecommendedDifficultyCache = null;
    });
  }

  return userRecommendedDifficultyCache[mode] ?? 1.0;
}
