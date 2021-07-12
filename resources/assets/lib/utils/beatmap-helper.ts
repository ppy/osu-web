// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { BeatmapsetJson } from 'beatmapsets/beatmapset-json';
import BeatmapJson from 'interfaces/beatmap-json';
import BeatmapJsonExtended, { isValid as isBeatmapJsonExtended } from 'interfaces/beatmap-json-extended';
import BeatmapsetExtendedJson from 'interfaces/beatmapset-extended-json';
import GameMode from 'interfaces/game-mode';
import UserJson from 'interfaces/user-json';
import * as _ from 'lodash';
import { deletedUser } from 'models/user';
import core from 'osu-core-singleton';

export const modes: GameMode[] = ['osu', 'taiko', 'fruits', 'mania'];

function isVisibleBeatmap(beatmap: BeatmapJson) {
  if (isBeatmapJsonExtended(beatmap)) {
    return beatmap.deleted_at == null && !beatmap.convert;
  }

  return true;
}

interface FindDefaultParams<T> {
  group?: Map<GameMode, T[]>;
  items?: T[];
  mode?: GameMode;
}

export function findDefault<T extends BeatmapJson>(params: FindDefaultParams<T>): T | null {
  if (params.items != null) {
    let currentDiffDelta: number;
    let currentItem: T | null = null;
    const targetDiff = userRecommendedDifficulty(params.mode ?? modes[0]);

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
  if (core.userPreferences.get('beatmapset_title_show_original')) {
    return beatmapset.artist_unicode;
  }

  return beatmapset.artist;
}

export function getBeatmapMapper(beatmapset: BeatmapsetExtendedJson, beatmap: BeatmapJsonExtended) {
  const mapper = beatmapset.related_users.find((user) => user.id === beatmap.user_id);

  if (mapper === undefined) {
    return deletedUser.toJson();
  }

  return mapper;
}

export function getNominators(beatmapset: BeatmapsetExtendedJson) {
  if (!(['pending', 'ranked', 'qualified', 'wip'].includes(beatmapset.status))) {
    return null;
  }

  const nominators: UserJson[] = [];

  for (const event of beatmapset.events.reverse()) {
    if (event.type === 'disqualify' || event.type === 'nomination_reset') {
      break;
    } else if (event.type === 'nominate') {
      const nominator = beatmapset.related_users.find((user) => user.id === event.user_id);

      if (nominator !== undefined) {
        nominators.unshift(nominator);
      }
    }
  }

  if (nominators.length === 0) {
    return null;
  }

  return nominators;
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

  modes.forEach((mode) => {
    ret.set(mode, sort(grouped[mode] ?? []));
  });

  return ret;
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
  const currentMode: GameMode | undefined = currentUser.playmode;
  if (currentMode == null || !modes.includes(currentMode)) {
    return modes;
  }

  const ret = _.without(modes, currentMode);
  ret.unshift(currentMode);

  return ret;
}

let userRecommendedDifficultyCache: Partial<Record<GameMode, number>> | null = null;

function userRecommendedDifficulty(mode: GameMode) {
  if (userRecommendedDifficultyCache == null) {
    userRecommendedDifficultyCache = osu.parseJson<Record<GameMode, number> | null>('json-recommended-star-difficulty-all') ?? {};
    $(document).one('turbolinks:before-cache', () => {
      userRecommendedDifficultyCache = null;
    });
  }

  return userRecommendedDifficultyCache[mode] ?? 1.0;
}
