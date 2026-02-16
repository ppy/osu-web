// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { ContestEntryJsonForResults } from 'interfaces/contest-entry-json';
import { ContestJsonForResults } from 'interfaces/contest-json';
import { route } from 'laroute';
import { action, computed, makeObservable, observable } from 'mobx';
import { updateHistory } from 'utils/turbolinks';

export default class State {
  @observable private selectedEntryId: number;

  constructor(readonly contest: ContestJsonForResults, readonly entries: ContestEntryJsonForResults[], readonly container: HTMLElement) {
    this.selectedEntryId = +(container.dataset.selectedId ?? 0);
    makeObservable(this);
  }

  @computed
  get selected() {
    return this.entries.find((entry) => entry.id === this.selectedEntryId) ?? this.entries[0];
  }

  @action
  select(id: number) {
    updateHistory(route('contests.entries.judge-results', { contest: this.contest.id, contest_entry: id }), 'push');
    this.selectedEntryId = id;
    this.container.dataset.selectedId = id.toString();
  }
}
