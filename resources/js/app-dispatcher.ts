// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import DispatchListener from 'dispatch-listener';
import Dispatcher from 'dispatcher';

export const dispatcher = new Dispatcher();

function isDispatchListener(target: unknown): target is DispatchListener {
  return typeof target === 'object'
    && target != null
    && 'handleDispatchAction' in target;
}

export const dispatch = dispatcher.dispatch;

// https://www.typescriptlang.org/docs/handbook/decorators.html#class-decorators
export function dispatchListener<T extends new(...args: any[]) => DispatchListener>(ctor: T) {
  return class extends ctor {
    constructor(...args: any[]) {
      super(...args);

      if (isDispatchListener(this)) {
        dispatcher.register(this);
      }
    }
  };
}
