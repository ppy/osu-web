// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { ensureRulesetId, RulesetId } from 'interfaces/ruleset';
import TagJson from 'interfaces/tag-json';
import { route } from 'laroute';
import { groupBy, sortBy } from 'lodash';
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
  private get rulesetId(): RulesetId|undefined {
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
    const ruleset = this.rulesetId;

    const filtered = ruleset != null
      ? this.tags.filter((tag) => tag.rulesetIds.length === 0 || tag.rulesetIds.includes(ruleset))
      : this.tags;

    const queried = filtered.filter((tag) => tag.matchesFullName(this.query));

    const grouped = groupBy(queried, (tag) => tag.group);

    return Object.entries(grouped).map(([name, tags]) => ({ name, tags }));
  }

  @action
  private readonly fetchTags = () => {
    if (this.tags.length > 0) {
      return;
    }

    $.getJSON(route('tags.index'))
      .done(action((response: { tags: TagJson[] }) => this.tags = this.processTags(response.tags)));
  };

  private processTags(tags: TagJson[]): BeatmapTag[] {
    const tagByName: Record<string, BeatmapTag> = {};

    // In some cases there's several tags with the same name across different rulesets.
    // We deduplicate them here and mark the deduplicated tag with each ruleset,
    // so that all of them will be shown in the UI.
    for (const tagJson of tags) {
      const tag = tagByName[tagJson.name];

      if (tag == null) {
        tagByName[tagJson.name] = new BeatmapTag(tagJson);
      } else if (tagJson.ruleset_id !== null) {
        tag.rulesetIds.push(tagJson.ruleset_id);
      }
    }

    const unique = sortBy(Object.values(tagByName), (tag) => tag.fullName);

    // ensure that displayed ruleset icons follow the common order
    for (const tag of unique) {
      tag.rulesetIds.sort();
    }

    return unique;
  }
}
