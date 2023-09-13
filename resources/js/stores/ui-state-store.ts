// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { makeObservable, observable } from 'mobx';
import { OwnClient } from 'models/oauth/own-client';

interface AccountUIState {
  client: OwnClient | null;
  isCreatingNewClient: boolean;
  newClientVisible: boolean;
}

export default class UIStateStore {
  @observable account: AccountUIState = {
    client: null,
    isCreatingNewClient: false,
    newClientVisible: false,
  };

  constructor() {
    makeObservable(this);
  }
}
