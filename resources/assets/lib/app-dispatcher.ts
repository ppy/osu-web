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
import DispatchListener from 'dispatch-listener';
import Dispatcher from 'dispatcher';

export const dispatcher = new Dispatcher();

function isDispatchListener(target: any): target is DispatchListener {
  return target.handleDispatchAction;
}

export function dispatch(data: DispatcherAction) {
  dispatcher.dispatch(data);
}

// https://www.typescriptlang.org/docs/handbook/decorators.html#class-decorators
export function dispatchListener<T extends new(...args: any[]) => {}>(ctor: T) {
  return class extends ctor {
    constructor(...args: any[]) {
      super(...args);

      if (isDispatchListener(this)) {
        dispatcher.register(this);
      }
    }
  };
}
