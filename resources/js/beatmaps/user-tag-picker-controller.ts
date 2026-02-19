// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { ensureRulesetId, RulesetId } from 'interfaces/ruleset';
import TagJson from 'interfaces/tag-json';
import { route } from 'laroute';
import { findIndex, groupBy, reduce, sortBy } from 'lodash';
import { action, computed, makeObservable, observable, onBecomeObserved } from 'mobx';
import BeatmapTag from 'models/beatmap-tag';
import core from 'osu-core-singleton';

export interface TagGroup {
  name: string;
  tags: BeatmapTag[];
}

export default class UserTagPickerController {
  @observable query: string = '';
  @observable tags: BeatmapTag[] = [];

  @computed
  private get ruleset(): RulesetId|undefined {
    const mode = core.beatmapsetSearchController.filters.mode;

    if (mode !== null) {
      return ensureRulesetId(mode);
    }
  }

  constructor() {
    makeObservable(this);
    onBecomeObserved(this, 'tags', this.fetchTags);
  }

  @computed
  get groups() {
    const ruleset = this.ruleset;

    const filtered = ruleset != null
      ? this.tags.filter((tag) => tag.rulesetIds.length === 0 || tag.rulesetIds.includes(ruleset))
      : this.tags;

    const queried = filtered.filter(
      (tag) => tag.fullName.toLowerCase().includes(this.query.toLowerCase()),
    );

    const grouped = groupBy(
      queried,
      (tag) => tag.group,
    );

    return Object.entries(grouped).map(([name, tags]) => ({ name, tags }));
  }

  @action
  private readonly fetchTags = () => {
    if (this.tags.length > 0) {
      return;
    }

    $.get(route('tags.index'))
      .done(action((response: { tags: TagJson[] }) => this.tags = this.processTags(response.tags)));
  };

  private processTags(tags: TagJson[]): BeatmapTag[] {
    const beatmapTags = tags.map((tag) => new BeatmapTag(tag));

    const sorted = sortBy(beatmapTags, (tag) => tag.fullName);

    // In some cases there's several tags with the same name across different rulesets.
    // We deduplicate them here and mark the deduplicated tag with each ruleset,
    // so that all of them will be shown in the UI.
    const unique = reduce<BeatmapTag, BeatmapTag[]>(
      sorted,
      (result, tag) => {
        const existingTagIndex = findIndex(result, (t) => t.fullName === tag.fullName);

        if (existingTagIndex === -1) {
          result.push(tag);
        } else {
          result[existingTagIndex].rulesetIds.push(...tag.rulesetIds);
        }

        return result;
      },
      [],
    );

    // ensure that displayed ruleset icons follow the common order
    for (const tag of unique) {
      tag.rulesetIds.sort();
    }

    return unique;
  }
}
