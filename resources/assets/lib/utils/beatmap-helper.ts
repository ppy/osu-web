// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { BeatmapsetJson } from 'beatmapsets/beatmapset-json';
import BeatmapJson from 'interfaces/beatmap-json';
import { isValid as isBeatmapJsonExtended } from 'interfaces/beatmap-json-extended';
import GameMode from 'interfaces/game-mode';
import * as _ from 'lodash';

export const modes: GameMode[] = ['osu', 'taiko', 'fruits', 'mania'];

function isVisibleBeatmap(beatmap: BeatmapJson) {
  if (isBeatmapJsonExtended(beatmap)) {
    return beatmap.deleted_at == null && !beatmap.convert;
  }

  return true;
}

interface FindDefaultParams<T> {
  group?: Partial<Record<GameMode, T[]>>;
  items?: T[];
  mode?: GameMode;
}

export function findDefault<T extends BeatmapJson>(params: FindDefaultParams<T>): T | null {
  if (params.items != null) {
    return _.findLast<T>(params.items, isVisibleBeatmap)
      ?? _.last(params.items)
      ?? null;
  }

  if (params.group == null) return null;

  const findModes = params.mode == null ? userModes() : [params.mode];

  for (const m of findModes) {
    const beatmap = findDefault({ items: params.group[m] });

    if (beatmap != null) return beatmap;
  }

  return null;
}

interface FindParams<T> {
  group: Partial<Record<GameMode, T[]>>;
  id: number;
  mode?: GameMode;
}

export function find<T extends BeatmapJson>(params: FindParams<T>): T | null {
  const findModes = params.mode == null ? userModes() : [params.mode];

  for (const m of findModes) {
    const item = (params.group[m] ?? []).find((i) => i.id === params.id);

    if (item != null) return item;
  }

  return null;
}

export function getDiffRating(rating: number) {
  if (rating < 2) return 'easy';
  if (rating < 2.7) return 'normal';
  if (rating < 4) return 'hard';
  if (rating < 5.3) return 'insane';
  if (rating < 6.5) return 'expert';
  return 'expert-plus';
}

// TODO: should make a Beatmapset proxy object or something
export function getArtist(beatmapset: BeatmapsetJson) {
  if (currentUser?.user_preferences?.beatmapset_title_show_original) {
    return osu.presence(beatmapset.artist_unicode) ?? beatmapset.artist;
  }

  return beatmapset.artist;
}

export function getTitle(beatmapset: BeatmapsetJson) {
  if (currentUser?.user_preferences?.beatmapset_title_show_original) {
    return osu.presence(beatmapset.title_unicode) ?? beatmapset.title;
  }

  return beatmapset.title;
}

export function group<T extends BeatmapJson>(beatmaps: T[]): Partial<Record<GameMode, T[]>> {
  const grouped = _.groupBy(beatmaps, 'mode');

  _.forOwn(grouped, (items, mode) => {
    grouped[mode] = sort(items);
  });

  return grouped;
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
  const grouped = group(beatmaps);

  return _.flatten(modes.map((mode) => grouped[mode] || []));
}

function userModes() {
  const currentMode: GameMode | undefined = currentUser.playmode;
  if (currentMode == null || !modes.includes(currentMode)) {
    return modes;
  }

  const ret = _.without(modes, currentMode);
  ret.unshift(currentMode);

  return ret;
}
