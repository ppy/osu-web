// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { route } from 'laroute';
import { groupBy, sortBy } from 'lodash';
import { action, autorun, computed, makeObservable, observable, onBecomeObserved } from 'mobx';
import TagJson from '../interfaces/tag-json';
import BeatmapTag from '../models/beatmap-tag';

export interface TagGroup {
  name: string;
  tags: BeatmapTag[];
}

export default class UserTagPickerController {
  @observable query: string|null = null;
  @observable showPicker = false;
  @observable tags = observable.array<BeatmapTag>();

  constructor() {
    makeObservable(this);
    onBecomeObserved(this, 'tags', this.fetchTags);

    autorun(() => {
      if (this.showPicker) {
        this.query = null;
      }
    });
  }

  @computed
  get groups() {
    const queried = this.query !== null
      ? this.tags.filter((tag) => tag.fullName.includes(this.query!))
      : this.tags;

    const sorted = sortBy(queried, (tag) => tag.fullName);

    const grouped = groupBy(
      sorted,
      (tag) => tag.group,
    );
    const groups: TagGroup[] = [];

    for (const group of Object.keys(grouped)) {
      groups.push({ name: group, tags: grouped[group] });
    }

    return groups;
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
