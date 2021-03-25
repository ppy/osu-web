// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { WindowBlurAction, WindowFocusAction } from 'actions/window-focus-actions';
import { dispatch } from 'app-dispatcher';

export default class WindowFocusObserver {
  constructor() {
    $(window).on('blur focus', this.focusChange);
  }

  focusChange = (e: JQuery.TriggeredEvent<EventTarget>) => {
    if (e.type === 'focus') {
      dispatch(new WindowFocusAction());
    } else {
      dispatch(new WindowBlurAction());
    }
  };
}
