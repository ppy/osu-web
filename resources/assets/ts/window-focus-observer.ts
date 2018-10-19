/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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

import { WindowBlurAction, WindowFocusAction } from './actions/window-focus-actions';
import Dispatcher from './dispatcher';

export default class WindowFocusObserver {
  private dispatcher: Dispatcher;

  constructor(window: Window, dispatcher: Dispatcher) {
    this.dispatcher = dispatcher;
    $(window).on('blur focus', this.focusChange);
  }

  focusChange = (e: JQuery.Event<EventTarget>) => {
    if (e.type === 'focus') {
      this.windowFocused();
    } else {
      this.windowBlurred();
    }
  }

  windowBlurred = () => {
    this.dispatcher.dispatch(new WindowBlurAction());
  }

  windowFocused = () => {
    this.dispatcher.dispatch(new WindowFocusAction());
  }
}
