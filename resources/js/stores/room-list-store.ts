// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import RoomListJson, { EndpointRoomJson } from 'interfaces/room-list-json';
import { action, makeObservable, observable } from 'mobx';

export default class RoomListStore {
  @observable cursorString: string | null = null;
  @observable rooms: EndpointRoomJson[] = [];

  constructor() {
    makeObservable(this);
  }

  @action
  updateWithJson(json: RoomListJson) {
    for (const room of json.rooms) {
      this.rooms.push(room);
    }

    this.cursorString = json.cursor_string;
  }
}
