// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { jsonClone } from 'utils/json';

describe('utils/json', () => {
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
