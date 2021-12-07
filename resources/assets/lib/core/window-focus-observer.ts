// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import WindowFocusAction from 'actions/window-focus-action';
import { dispatch } from 'app-dispatcher';

export default class WindowFocusObserver {
  constructor() {
    $(window).on('blur focus', this.focusChange);
  }

  focusChange = (e: JQuery.TriggeredEvent<EventTarget>) => {
    dispatch(new WindowFocusAction(e.type === 'focus'));
  };
}
