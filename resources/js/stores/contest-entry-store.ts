// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import ContestEntryJson from 'interfaces/contest-entry-json';
import { action, makeObservable, observable } from 'mobx';
import { ContestEntry } from 'models/contest-entry';

export default class ContestEntryStore {
  @observable entries = new Map<number, ContestEntry>();

  constructor() {
    makeObservable(this);
  }

  @action
  update(json: ContestEntryJson) {
    const entry = this.entries.get(json.id);
    entry?.updateWithJson(json);
  }

  @action
  updateWithJson(data: ContestEntryJson[]) {
    data.forEach((json) => {
      const entry = new ContestEntry(json);
      this.entries.set(entry.id, entry);
    });
  }
}
