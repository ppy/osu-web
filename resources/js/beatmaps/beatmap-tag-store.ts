import TagJson from 'interfaces/tag-json';
import { route } from 'laroute';
import { sortBy } from 'lodash';
import { action, makeObservable, observable, onBecomeObserved } from 'mobx';
import BeatmapTag from 'models/beatmap-tag';

export default class BeatmapTagStore {
  @observable tags: BeatmapTag[] = [];

  constructor() {
    makeObservable(this);
    onBecomeObserved(this, 'tags', this.fetchTags);
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

    const unique = sortBy(Object.values(tagByName), (tag) => tag.name);

    // ensure that displayed ruleset icons follow the common order
    for (const tag of unique) {
      tag.rulesetIds.sort();
    }

    return unique;
  }
}
