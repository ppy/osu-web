// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapsetExtendedJson from 'interfaces/beatmapset-extended-json';
import BeatmapsetWithDiscussionsJson from 'interfaces/beatmapset-with-discussions-json';
import { isEmpty } from 'lodash';
import { computed, makeObservable } from 'mobx';
import BeatmapsetDiscussions from './beatmapset-discussions';

function mapBy<T, K extends keyof T>(array: T[], key: K) {
  const map = new Map<T[K], T>();

  for (const value of array) {
    map.set(value[key], value);
  }

  return map;
}

function mapByWithNulls<T, K extends keyof T>(array: T[], key: K) {
  const map = new Map<T[K] | null | undefined, T>();

  for (const value of array) {
    map.set(value[key], value);
  }

  return map;
}

export default class BeatmapsetDiscussionsStore implements BeatmapsetDiscussions {
  @computed
  get beatmaps() {
    const hasDiscussion = new Set<number>();
    for (const discussion of this.beatmapset.discussions) {
      if (discussion?.beatmap_id != null) {
        hasDiscussion.add(discussion.beatmap_id);
      }
    }

    return mapBy(
      this.beatmapset.beatmaps.filter((beatmap) => !isEmpty(beatmap) && (beatmap.deleted_at == null || hasDiscussion.has(beatmap.id))),
      'id',
    );
  }

  @computed
  get beatmapsets() {
    return new Map<number, BeatmapsetExtendedJson>().set(this.beatmapset.id, this.beatmapset);
  }

  @computed
  get discussions() {
    // skipped discussions
    // - not privileged (deleted discussion)
    // - deleted beatmap

    // allow null for the key so we can use .get(null)
    return mapByWithNulls(this.beatmapset.discussions.filter((discussion) => !isEmpty(discussion)), 'id');
  }

  @computed
  get users() {
    return mapByWithNulls(this.beatmapset.related_users, 'id');
  }

  constructor(private beatmapset: BeatmapsetWithDiscussionsJson) {
    makeObservable(this);
  }
}
