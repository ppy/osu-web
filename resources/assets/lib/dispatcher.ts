// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import DispatcherAction from 'actions/dispatcher-action';
import DispatchListener from './dispatch-listener';

export default class Dispatcher {
  private listeners = new Set<DispatchListener>();
  private trace = false;

  dispatch(action: DispatcherAction) {
    if (this.trace) {
      // eslint-disable-next-line no-console
      console.debug('Dispatcher::dispatch', action);
    }
    this.listeners.forEach((listener) => {
      listener.handleDispatchAction(action);
    });
  }

  register(listener: DispatchListener) {
    this.listeners.add(listener);
  }

  unregister(listener: DispatchListener) {
    this.listeners.delete(listener);
  }
}
