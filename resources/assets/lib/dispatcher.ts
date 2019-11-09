/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

import DispatcherAction from 'actions/dispatcher-action';
import DispatchListener from './dispatch-listener';

export default class Dispatcher {
  private callbacks: DispatchListener[] = [];
  private trace: boolean = false;

  dispatch(action: DispatcherAction) {
    if (this.trace) {
      console.debug('Dispatcher::dispatch', action);
    }
    this.callbacks.forEach((callback) => {
      callback.handleDispatchAction(action);
    });
  }

  register(callback: DispatchListener) {
    this.callbacks.push(callback);
  }
}
