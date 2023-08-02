// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import GroupJson from 'interfaces/group-json';
import { sortBy } from 'lodash';
import { action, computed, makeObservable, observable } from 'mobx';

class GroupStore {
  @observable byId = observable.map<number, GroupJson>();

  @computed
  get byIdentifier() {
    return this.groups.reduce(
      (prev, group) => {
        prev.set(group.identifier, group);
        return prev;
      },
      new Map<string, GroupJson>(),
    );
  }

  @computed
  get groups() {
    return sortBy([...this.byId.values()], 'name');
  }

  constructor() {
    makeObservable(this);
  }

  @action
  update(group: GroupJson): void {
    this.byId.set(group.id, group);
  }

  @action
  updateMany(groups: GroupJson[]): void {
    for (const group of groups) {
      this.update(group);
    }
  }
}

const groupStore = new GroupStore();
export default groupStore;
