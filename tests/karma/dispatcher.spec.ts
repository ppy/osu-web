// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

/* eslint-disable max-classes-per-file */
import DispatcherAction from 'actions/dispatcher-action';
import DispatchListener from 'dispatch-listener';
import Dispatcher from 'dispatcher';

class ClassA implements DispatchListener {
  count = 0;
  handleDispatchAction(action: DispatcherAction) {
    this.count++;
  }
}

class ClassB implements DispatchListener {
  handleDispatchAction(action: DispatcherAction) {
    // nothing
  }
}

class ClassAC extends ClassA {
  handleDispatchAction(action: DispatcherAction) {
    super.handleDispatchAction(action);
  }
}

class DummyAction extends DispatcherAction {}

describe('Dispatcher', () => {
  let subject: Dispatcher;

  beforeEach(() => {
    subject = new Dispatcher();
  });

  describe('.register', () => {
    it('should register the same instance only once', () => {
      const obj = new ClassA();
      subject.register(obj);
      subject.register(obj);
      expect(subject.size).toBe(1);
    });

    it('should register different instances', () => {
      const obj1 = new ClassA();
      const obj2 = new ClassA();
      subject.register(obj1);
      subject.register(obj2);
      expect(subject.size).toBe(2);
    });

    it('should register different class instances', () => {
      const obj1 = new ClassA();
      const obj2 = new ClassB();
      subject.register(obj1);
      subject.register(obj2);
      expect(subject.size).toBe(2);
    });

    it('should register subclasses separately', () => {
      const obj1 = new ClassA();
      const obj2 = new ClassAC();
      subject.register(obj1);
      subject.register(obj2);
      expect(subject.size).toBe(2);
    });
  });

  describe('.dispatch', () => {
    it('should send the action once', () => {
      const obj1 = new ClassA();
      const obj2 = new ClassAC();
      subject.register(obj1);
      subject.register(obj2);
      subject.register(obj1);
      subject.dispatch(new DummyAction());

      expect(obj1.count).toBe(1);
      expect(obj2.count).toBe(1);
    });
  });
});
