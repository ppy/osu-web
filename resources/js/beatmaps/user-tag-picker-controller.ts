// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import Ruleset, { rulesetIdToName, RulesetId } from 'interfaces/ruleset';
import TagJson from 'interfaces/tag-json';
import { route } from 'laroute';
import { findIndex, groupBy, reduce, sortBy } from 'lodash';
import { action, computed, makeObservable, observable, onBecomeObserved } from 'mobx';
import BeatmapTag from 'models/beatmap-tag';
import core from 'osu-core-singleton';

export interface TagGroup {
  name: string;
  tags: BeatmapTagManyRulesets[];
}

export type BeatmapTagManyRulesets = Omit<BeatmapTag, 'ruleset'> & {
  rulesets: Ruleset[];
};

export default class UserTagPickerController {
  @observable query: string|null = null;
  @observable tags: BeatmapTag[] = [];

  @computed
  private get ruleset() {
    const filter = core.beatmapsetSearchController.filters.mode;

    if (filter === null) {
      return null;
    }

    const ruleset = parseInt(filter, 10);

    if (!(ruleset in rulesetIdToName)) {
      return null;
    }

    return rulesetIdToName[ruleset as RulesetId];
  }

  constructor() {
    makeObservable(this);
    onBecomeObserved(this, 'tags', this.fetchTags);
  }

  @computed
  get groups() {
    const query = this.query;
    const ruleset = this.ruleset;

    const filtered = ruleset !== null
      ? this.tags.filter((tag) => tag.ruleset === ruleset || tag.ruleset === null)
      : this.tags;

    const queried = query !== null
      ? filtered.filter((tag) => tag.fullName.toLowerCase().includes(query.toLowerCase()))
      : filtered;

    const sorted = sortBy(queried, (tag) => tag.fullName);

    // In some cases there's several tags with the same name across different rulesets.
    // We deduplicate them here and mark the deduplicated tag with each ruleset,
    // so that all of them will be shown in the UI.
    const unique = reduce<BeatmapTag, BeatmapTagManyRulesets[]>(
      sorted,
      (result, tag) => {
        const existingTagIndex = findIndex(result, (t) => t.fullName === tag.fullName);

        if (existingTagIndex === -1) {
          const tagToAdd = {
            ...tag,
            rulesets: [],
          } as BeatmapTagManyRulesets;

          if (tag.ruleset !== null) tagToAdd.rulesets.push(tag.ruleset);

          result.push(tagToAdd);
        } else if (tag.ruleset !== null) {
          result[existingTagIndex].rulesets.push(tag.ruleset);
        }

        return result;
      },
      [],
    );

    const grouped = groupBy(
      unique,
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
      .done(action((tags: { tags: TagJson[] }) => this.tags = tags.tags.map((tag) => new BeatmapTag(tag))));
  };
}
