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

import DispatcherAction from 'actions/dispatcher-action';
import DispatchListener from './dispatch-listener';

export default class Dispatcher {
  private listeners = new Set<DispatchListener>();
  private trace: boolean = false;

  dispatch(action: DispatcherAction) {
    if (this.trace) {
      // tslint:disable-next-line: no-console
      console.debug('Dispatcher::dispatch', action);
    }
    this.listeners.forEach((callback) => {
      callback.handleDispatchAction(action);
    });
  }

  register(callback: DispatchListener) {
    this.listeners.add(callback);
  }
}
