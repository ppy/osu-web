/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

import ChatStateStore from 'chat/chat-state-store';
import { observable } from 'mobx';
import { OwnClient } from 'models/oauth/own-client';
import Store from 'stores/store';

interface AccountUIState {
  client: OwnClient | null;
  isCreatingNewClient: boolean;
  newClientVisible: boolean;
}

export default class UIStateStore extends Store {
  @observable account: AccountUIState = {
    client: null,
    isCreatingNewClient: false,
    newClientVisible: false,
  };

  chat = new ChatStateStore(this.root, this.dispatcher);
}
