// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { updateQueryString } from 'utils/url';

describe('utils/url', () => {
  describe('.updateQueryString', () => {
    it('should add the new parameter to the query string', () => {
      const params = {
        foo: 'bar',
      };

      const expected = new URL('/nowhere?foo=bar', location.origin).href;
      const result = updateQueryString('/nowhere', params);

      expect(result).toBe(expected);
    });

    it('should update the existing parameter value', () => {
      const params = {
        something: '2',
      };

      const expected = new URL('/nowhere?something=2', location.origin).href;
      const result = updateQueryString('/nowhere?something=1', params);

      expect(result).toBe(expected);
    });

    it('should append the new parameter value', () => {
      const params = {
        more: '3',
      };

      const expected = new URL('/nowhere?something=1&more=3', location.origin).href;
      const result = updateQueryString('/nowhere?something=1', params);

      expect(result).toBe(expected);
    });

    it('should update the existing parameter and append the new parameter value', () => {
      const params = {
        more: '3',
        something: '5',
      };

      const expected = new URL('/nowhere?something=5&more=3', location.origin).href;
      const result = updateQueryString('/nowhere?something=1', params);

      expect(result).toBe(expected);
    });
  });
});
