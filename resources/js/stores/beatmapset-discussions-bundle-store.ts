// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapsetDiscussionsBundleJson from 'interfaces/beatmapset-discussions-bundle-json';
import BeatmapsetDiscussionsStore from 'interfaces/beatmapset-discussions-store';
import { computed, makeObservable, observable } from 'mobx';
import { mapBy, mapByWithNulls } from 'utils/map';

export default class BeatmapsetDiscussionsBundleStore implements BeatmapsetDiscussionsStore {
  /** TODO: accessor; readonly */
  @observable bundle;

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

  constructor(bundle: BeatmapsetDiscussionsBundleJson) {
    this.bundle = bundle;
    makeObservable(this);
  }
}
