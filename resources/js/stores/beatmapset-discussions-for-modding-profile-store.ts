// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapsetDiscussions from 'interfaces/beatmapset-discussions';
import { BeatmapsetDiscussionsBundleJsonForModdingProfile } from 'interfaces/beatmapset-discussions-bundle-json';
import { computed, makeObservable } from 'mobx';
import { mapBy, mapByWithNulls } from 'utils/map';

export default class BeatmapsetDiscussionsBundleForModdingProfileStore implements BeatmapsetDiscussions {
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
    return mapByWithNulls(this.bundle.discussions, 'id');
  }

  @computed
  get users() {
    return mapByWithNulls(this.bundle.users, 'id');
  }

  constructor(private bundle: BeatmapsetDiscussionsBundleJsonForModdingProfile) {
    makeObservable(this);
  }
}
