// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { route } from 'laroute';
import { action, makeObservable, observable, onBecomeObserved } from 'mobx';
import TagJson from '../interfaces/tag-json';
import BeatmapTag from '../models/beatmap-tag';

export default class UserTagPickerController {
  @observable tags = observable.array<BeatmapTag>();

  constructor() {
    makeObservable(this);
    onBecomeObserved(this, 'tags', this.fetchTags);
  }

  @action
  private readonly fetchTags = () => {
    if (this.tags.length > 0) {
      return;
    }

    $.get(route('tags.index'))
      .done(action((tags: { tags: TagJson[] }) => this.tags.replace(tags.tags.map((tag) => new BeatmapTag(tag)))));
  };
}
