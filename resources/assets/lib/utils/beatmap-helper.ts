// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import * as d3 from 'd3';
import { isValid as isBeatmapExtendedJson } from 'interfaces/beatmap-extended-json';
import BeatmapJson from 'interfaces/beatmap-json';
import BeatmapsetJson from 'interfaces/beatmapset-json';
import GameMode, { gameModes } from 'interfaces/game-mode';
import * as _ from 'lodash';
import core from 'osu-core-singleton';
import { parseJsonNullable } from 'utils/json';

function isVisibleBeatmap(beatmap: BeatmapJson) {
  if (isBeatmapExtendedJson(beatmap)) {
    return beatmap.deleted_at == null && !beatmap.convert;
  }

  return true;
}

const difficultyColourDomain = [0.1, 1.25, 2, 2.5, 3.3, 4.2, 4.9, 5.8, 6.7, 7.7, 9];
const difficultyColourRange = ['#4290FB', '#4FC0FF', '#4FFFD5', '#7CFF4F', '#F6F05C', '#FF8068', '#FF4E6F', '#C645B8', '#6563DE', '#18158E', '#000000'];

const difficultyColourGroup = d3.scaleQuantile<string>()
  .domain(difficultyColourDomain)
  .range(difficultyColourRange);

const difficultyColourSpectrum = d3.scaleLinear<string>()
  .domain(difficultyColourDomain)
  .clamp(true)
  .range(difficultyColourRange)
  .interpolate(d3.interpolateRgb.gamma(2.2));

interface FindDefaultParams<T> {
  group?: Map<GameMode, T[]>;
  items?: T[];
  mode?: GameMode;
}

export function findDefault<T extends BeatmapJson>(params: FindDefaultParams<T>): T | null {
  if (params.items != null) {
    let currentDiffDelta: number;
    let currentItem: T | null = null;
    const targetDiff = userRecommendedDifficulty(params.mode ?? gameModes[0]);

    params.items.forEach((item) => {
      const diffDelta = Math.abs(item.difficulty_rating - targetDiff);

      if (isVisibleBeatmap(item) && (currentDiffDelta == null || diffDelta < currentDiffDelta)) {
        currentDiffDelta = diffDelta;
        currentItem = item;
      }
    });

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
  group: Map<GameMode, T[]>;
  id: number;
  mode?: GameMode;
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

export function getDiffColourGroup(rating: number) {
  if (rating < 0.1) return '#AAAAAA';
  if (rating >= 9) return '#000000';
  return difficultyColourGroup(rating);
}

// TODO: should make a Beatmapset proxy object or something
export function getArtist(beatmapset: BeatmapsetJson) {
  if (core.userPreferences.get('beatmapset_title_show_original')) {
    return beatmapset.artist_unicode;
  }

  return beatmapset.artist;
}

export function getTitle(beatmapset: BeatmapsetJson) {
  if (core.userPreferences.get('beatmapset_title_show_original')) {
    return beatmapset.title_unicode;
  }

  return beatmapset.title;
}

export function group<T extends BeatmapJson>(beatmaps?: T[] | null): Map<GameMode, T[]> {
  const grouped = _.groupBy(beatmaps ?? [], 'mode');
  const ret = new Map<GameMode, T[]>();

  gameModes.forEach((mode) => {
    ret.set(mode, sort(grouped[mode] ?? []));
  });

  return ret;
}

export function rulesetName(id: number): GameMode {
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
  if (currentMode == null || !gameModes.includes(currentMode)) {
    return gameModes;
  }

  const ret = _.without(gameModes, currentMode);
  ret.unshift(currentMode);

  return ret;
}

let userRecommendedDifficultyCache: Partial<Record<GameMode, number>> | null = null;

function userRecommendedDifficulty(mode: GameMode) {
  if (userRecommendedDifficultyCache == null) {
    userRecommendedDifficultyCache = parseJsonNullable('json-recommended-star-difficulty-all') ?? {};
    $(document).one('turbolinks:before-cache', () => {
      userRecommendedDifficultyCache = null;
    });
  }

  return userRecommendedDifficultyCache[mode] ?? 1.0;
}
