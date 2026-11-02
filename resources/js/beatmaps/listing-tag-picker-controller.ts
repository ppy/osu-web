// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapTagPickerController from 'components/beatmap-tag-picker-controller';
import { ensureRulesetId, RulesetId } from 'interfaces/ruleset';
import { computed, makeObservable, observable } from 'mobx';
import BeatmapTag from 'models/beatmap-tag';
import core from 'osu-core-singleton';

export default class ListingTagPickerController implements BeatmapTagPickerController {
  @computed
  get rulesetId(): RulesetId|undefined {
    const mode = core.beatmapsetSearchController.filters.mode;

    if (mode !== null) {
      return ensureRulesetId(mode);
    }
  }

  @observable query: string = '';

  constructor() {
    makeObservable(this);
  }

  disableTag = (tag: BeatmapTag) => core.beatmapsetSearchController.filters.tagRemove(tag);
  enableTag = (tag: BeatmapTag) => core.beatmapsetSearchController.filters.tagAdd(tag);
  isTagEnabled = (tag: BeatmapTag) => core.beatmapsetSearchController.filters.tagEnabled(tag);
}
