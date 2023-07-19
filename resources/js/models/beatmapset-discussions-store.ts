// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapExtendedJson from 'interfaces/beatmap-extended-json';
import BeatmapsetDiscussionJson from 'interfaces/beatmapset-discussion-json';
import BeatmapsetExtendedJson from 'interfaces/beatmapset-extended-json';
import BeatmapsetWithDiscussionsJson from 'interfaces/beatmapset-with-discussions-json';
import UserJson from 'interfaces/user-json';
import { isEmpty } from 'lodash';
import { computed, makeObservable } from 'mobx';
import BeatmapsetDiscussions from './beatmapset-discussions';
import { deletedUserJson } from './user';

export default class BeatmapsetDiscussionsStore implements BeatmapsetDiscussions {
  @computed
  get beatmaps() {
    const hasDiscussion = new Set<number>();
    for (const discussion of this.beatmapset.discussions) {
      if (discussion?.beatmap_id != null) {
        hasDiscussion.add(discussion.beatmap_id);
      }
    }

    const map = new Map<number, BeatmapExtendedJson>();

    for (const beatmap of this.beatmapset.beatmaps) {
      if (!isEmpty(beatmap) && (beatmap.deleted_at == null || hasDiscussion.has(beatmap.id))) {
        map.set(beatmap.id, beatmap);
      }
    }

    return map;
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

    // null part of the key so we can use .get(null)
    const map = new Map<number | null | undefined, BeatmapsetDiscussionJson>();

    for (const discussion of this.beatmapset.discussions) {
      if (!isEmpty(discussion)) {
        map.set(discussion.id, discussion);
      }
    }

    return map;
  }

  @computed
  get users() {
    const map = new Map<number | null | undefined, UserJson>();
    map.set(null, deletedUserJson);
    map.set(undefined, deletedUserJson);

    for (const user of this.beatmapset.related_users) {
      map.set(user.id, user);
    }

    return map;
  }

  constructor(private beatmapset: BeatmapsetWithDiscussionsJson) {
    makeObservable(this);
  }
}
