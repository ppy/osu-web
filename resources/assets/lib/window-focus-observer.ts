/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

import { WindowBlurAction, WindowFocusAction } from 'actions/window-focus-actions';
import Dispatcher from './dispatcher';

export default class WindowFocusObserver {
  private dispatcher: Dispatcher;

  constructor(window: Window, dispatcher: Dispatcher) {
    this.dispatcher = dispatcher;
    $(window).on('blur focus', this.focusChange);
  }

  focusChange = (e: JQuery.TriggeredEvent<EventTarget>) => {
    if (e.type === 'focus') {
      this.dispatcher.dispatch(new WindowFocusAction());
    } else {
      this.dispatcher.dispatch(new WindowBlurAction());
    }
  }
}
