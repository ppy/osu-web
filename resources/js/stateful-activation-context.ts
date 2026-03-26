// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { action, makeObservable, observable } from 'mobx';
import { createContext, Key } from 'react';

export class ActiveKeyState<T = Key> {
  @observable value: T | null = null;
  constructor() {
    makeObservable(this);
  }

  @action
  setValue(value: T | null) {
    this.value = value;
  }
}

export const ContainerContext = createContext(new ActiveKeyState());

export const KeyContext = createContext<Key | null>(null);
