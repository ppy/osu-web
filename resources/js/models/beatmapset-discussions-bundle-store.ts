// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapsetDiscussionsBundleJson from 'interfaces/beatmapset-discussions-bundle-json';
import { computed, makeObservable } from 'mobx';
import { mapBy, mapByWithNulls } from 'utils/map';
import BeatmapsetDiscussions from './beatmapset-discussions';

export default class BeatmapsetDiscussionsBundleStore implements BeatmapsetDiscussions {
  constructor(private bundle: BeatmapsetDiscussionsBundleJson) {
    makeObservable(this);
  }

  @computed
  get beatmaps() {
    return mapBy(this.bundle.beatmaps, 'id');
  }

  @computed
  get beatmapsets() {
    return mapBy(this.bundle.beatmapsets, 'id');
  }

  @computed
  get discussions() {
    // TODO: add bundle.discussions?
    return mapByWithNulls(this.bundle.included_discussions, 'id');
  }

  @computed
  get users() {
    return mapByWithNulls(this.bundle.users, 'id');
  }
}
