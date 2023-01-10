// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserMultiplayerHistoryJson, { EndpointRoomJson, MultiplayerTypeGroup } from 'interfaces/multiplayer-list-json';
import { action, makeObservable, observable } from 'mobx';

export default class MultiplayerListStore {
  @observable cursorString: string | null = null;
  @observable rooms: EndpointRoomJson[] = [];
  @observable typeGroup: MultiplayerTypeGroup = 'realtime';

  constructor() {
    makeObservable(this);
  }

  @action
  updateWithJson(json: UserMultiplayerHistoryJson) {
    for (const room of json.rooms) {
      this.rooms.push(room);
    }

    this.typeGroup = json.type_group;
    this.cursorString = json.cursor_string;
  }
}
