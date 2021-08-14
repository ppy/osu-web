// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
