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
import { dispatch, dispatcher, dispatchListener } from 'app-dispatcher';
import DispatchListener from 'dispatch-listener';

/* tslint:disable:max-classes-per-file */
@dispatchListener
class ClassA implements DispatchListener {
  count = 0;
  handleDispatchAction(action: DispatcherAction) {
    this.count++;
  }
}

class ClassAC extends ClassA {
  handleDispatchAction(action: DispatcherAction) {
    super.handleDispatchAction(action);
  }
}

describe('app-dispatcher', () => {
  // @ts-ignore
  const listeners = dispatcher.listeners;

  beforeEach(() => {
    listeners.clear();
  });

  afterEach(() => {
    listeners.clear();
  });

  it('decorated class automatically gets registered', () => {
    expect(listeners.size).toBe(0);
    const obj = new ClassA();
    expect(listeners.size).toBe(1);
    expect(listeners).toContain(obj);
  });

  it('subclass with decorated parent automatically gets registered', () => {
    expect(listeners.size).toBe(0);
    const obj = new ClassAC();
    expect(listeners.size).toBe(1);
    expect(listeners).toContain(obj);
  });

  it('multiple instances of decorated classes are registered', () => {
    expect(listeners.size).toBe(0);
    const obj1 = new ClassA();
    const obj2 = new ClassA();
    expect(listeners.size).toBe(2);
    expect(listeners).toContain(obj1);
    expect(listeners).toContain(obj2);
  });

  it('can override global dispatch', () => {
    let count = 0;
    const obj = new ClassA();

    const original = dispatcher.dispatch;

    dispatcher.dispatch = (event: DispatcherAction) => {
      count++;
    };

    dispatch(new (class extends DispatcherAction {})());

    expect(count).toBe(1);
    expect(obj.count).toBe(0);

    (dispatcher as any).dispatch = original;
  });
});
