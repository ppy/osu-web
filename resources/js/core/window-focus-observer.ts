// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { action, makeObservable, observable } from 'mobx';

export default class WindowFocusObserver {
  @observable hasFocus = document.hasFocus();

  constructor() {
    makeObservable(this);

    $(window).on('blur focus', action(() => this.hasFocus = document.hasFocus()));
  }
}
