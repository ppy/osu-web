// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapsetDiscussionsStore from 'interfaces/beatmapset-discussions-store';
import BeatmapsetExtendedJson from 'interfaces/beatmapset-extended-json';
import BeatmapsetWithDiscussionsJson from 'interfaces/beatmapset-with-discussions-json';
import { computed, makeObservable, observable } from 'mobx';
import { mapBy, mapByWithNulls } from 'utils/map';

export default class BeatmapsetDiscussionsShowStore implements BeatmapsetDiscussionsStore {
  @observable beatmapset: BeatmapsetWithDiscussionsJson;

  @computed
  get beatmaps() {
    const hasDiscussion = new Set<number>();
    for (const discussion of this.beatmapset.discussions) {
      if (discussion?.beatmap_id != null) {
        hasDiscussion.add(discussion.beatmap_id);
      }
    }

    let visibleBeatmaps = this
      .beatmapset
      .beatmaps
      .filter((beatmap) => beatmap.deleted_at == null || hasDiscussion.has(beatmap.id));

    if (visibleBeatmaps.length === 0) {
      visibleBeatmaps = [this.beatmapset.beatmaps[0]];
    }

    return mapBy(visibleBeatmaps, 'id');
  }

  @computed
  get beatmapsets() {
    return new Map<number, BeatmapsetExtendedJson>([[this.beatmapset.id, this.beatmapset]]);
  }

  @computed
  get discussions() {
    // skipped discussions
    // - not privileged (deleted discussion)
    // - deleted beatmap

    // allow null for the key so we can use .get(null)
    return mapByWithNulls(this.beatmapset.discussions, 'id');
  }

  @computed
  get users() {
    return mapByWithNulls(this.beatmapset.related_users, 'id');
  }

  constructor(beatmapset: BeatmapsetWithDiscussionsJson) {
    this.beatmapset = beatmapset;
    makeObservable(this);
  }
}
