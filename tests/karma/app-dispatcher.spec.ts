// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

/* eslint-disable max-classes-per-file */
import DispatcherAction from 'actions/dispatcher-action';
import { dispatch, dispatcher, dispatchListener } from 'app-dispatcher';
import DispatchListener from 'dispatch-listener';

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
  beforeEach(() => {
    dispatcher.clear();
  });

  afterEach(() => {
    dispatcher.clear();
  });

  it('decorated class automatically gets registered', () => {
    expect(dispatcher.size).toBe(0);
    const obj = new ClassA();
    expect(dispatcher.size).toBe(1);
    expect(dispatcher.has(obj)).toBe(true);
  });

  it('subclass with decorated parent automatically gets registered', () => {
    expect(dispatcher.size).toBe(0);
    const obj = new ClassAC();
    expect(dispatcher.size).toBe(1);
    expect(dispatcher.has(obj)).toBe(true);
  });

  it('multiple instances of decorated classes are registered', () => {
    expect(dispatcher.size).toBe(0);
    const obj1 = new ClassA();
    const obj2 = new ClassA();
    expect(dispatcher.size).toBe(2);
    expect(dispatcher.has(obj1)).toBe(true);
    expect(dispatcher.has(obj2)).toBe(true);
  });

  it('can override global dispatch', () => {
    expect(dispatch).toBe(dispatcher.dispatch);
  });
});
