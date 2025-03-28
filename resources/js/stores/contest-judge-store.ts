// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import ContestEntryJson from 'interfaces/contest-entry-json';
import { ContestJsonForStore } from 'interfaces/contest-json';
import ContestScoringCategoryJson from 'interfaces/contest-scoring-category-json';
import { action, makeObservable, observable } from 'mobx';
import { ContestEntry } from 'models/contest-entry';

export default class ContestJudgeStore {
  @observable canJudge = false;
  @observable entries = new Map<number, ContestEntry>();
  @observable scoringCategories: ContestScoringCategoryJson[] = [];

  constructor() {
    makeObservable(this);
  }

  @action
  updateEntry(json: ContestEntryJson) {
    const entry = this.entries.get(json.id);
    entry?.updateWithJson(json);
  }

  @action
  updateWithJson(data: ContestJsonForStore) {
    this.canJudge = data.current_user_attributes.can_judge;

    data.entries.forEach((json) => {
      const entry = new ContestEntry(json);
      this.entries.set(entry.id, entry);
    });

    for (const category of data.scoring_categories) {
      this.scoringCategories.push(category);
    }
  }
}
