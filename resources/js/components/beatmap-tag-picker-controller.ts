// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { RulesetId } from 'interfaces/ruleset';
import { groupBy } from 'lodash';
import { computed, makeObservable, observable } from 'mobx';
import BeatmapTag from 'models/beatmap-tag';
import core from 'osu-core-singleton';

export interface TagGroup {
  name: string;
  tags: BeatmapTag[];
}

export default abstract class BeatmapTagPickerController {
  abstract disableTag: (tag: BeatmapTag) => void;
  abstract enableTag: (tag: BeatmapTag) => void;
  abstract isTagEnabled: (tag: BeatmapTag) => boolean;
  abstract rulesetId: RulesetId|undefined;

  @observable query: string = '';

  constructor() {
    makeObservable(this);
  }

  @computed
  get groups() {
    const querySplit = this.query.trim().toLowerCase().split(/\s+/);

    const filtered = core.beatmapTagStore.tags.filter((tag) => tag.match(querySplit, this.rulesetId));
    const grouped = groupBy(filtered, (tag) => tag.categoryName);

    return Object.entries(grouped).map(([name, tags]) => ({ name, tags }));
  }
}
