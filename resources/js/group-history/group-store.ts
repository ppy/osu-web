// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import GroupJson from 'interfaces/group-json';
import { sortBy } from 'lodash';
import { action, computed, makeObservable, observable } from 'mobx';
import { mapBy } from 'utils/map';

class GroupStore {
  @observable byId = new Map<number, GroupJson>();

  @computed
  get all() {
    return sortBy([...this.byId.values()], 'name');
  }

  @computed
  get byIdentifier() {
    return mapBy(this.byId.values(), 'identifier');
  }

  constructor() {
    makeObservable(this);
  }

  @action
  update(groups: GroupJson[]): void {
    for (const group of groups) {
      this.byId.set(group.id, group);
    }
  }
}

const groupStore = new GroupStore();
export default groupStore;
