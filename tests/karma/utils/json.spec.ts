// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { flattenFormErrorJson, jsonClone } from 'utils/json';

describe('utils/json', () => {
  describe('.flattenFormErrorJson', () => {
    it('results in map with flatten key', () => {
      const json = {
        base: ['base message'],
        user: {
          name: ['name message'],
          url: {
            home: ['home message'],
            work: ['work message'],
          },
        },
      };
      const result = flattenFormErrorJson(json);

      expect([...result]).toEqual([
        ['base', ['base message']],
        ['user[name]', ['name message']],
        ['user[url][home]', ['home message']],
        ['user[url][work]', ['work message']],
      ]);
    });
  });

  describe('.jsonClone', () => {
    it('results in a new object', () => {
      const obj = { test: '1234' };
      const result = jsonClone(obj);

      expect(result).toEqual(obj);
      expect(result).not.toBe(obj);
    });

    it('does not make a shallow copy', () => {
      const obj = { test: { inner: '1234' } };
      const result = jsonClone(obj);

      expect(result.test).toEqual(obj.test);
      expect(result.test).not.toBe(obj.test);
    });

    it('null should remain null', () => {
      expect(jsonClone(null)).toBe(null);
    });

    it('undefined should remain undefined', () => {
      expect(jsonClone(undefined)).toBe(undefined);
    });
  });
});
