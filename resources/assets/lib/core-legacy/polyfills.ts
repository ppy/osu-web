// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import DumbStorage from 'dumb-storage';

declare global {
  interface Window {
    localStorage: Storage;
  }
}

export default class Polyfills {
  constructor() {
    this.localStorage();
  }

  // Mainly for Safari Private Mode.
  private localStorage() {
    try {
      window.localStorage.setItem('_test', '1');
      window.localStorage.removeItem('_test');
    } catch {
      const localStorage = new DumbStorage();
      window.localStorage = localStorage;
      window.localStorage.__proto__ = localStorage;
    }
  }
}
