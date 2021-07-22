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

describe('osu_common', () => {
  describe('test locale file loaded in test runner', () => {
    it('should be loaded', () => {
      expect(Lang.has('common.confirmation')).toBe(true);
    })
  })

  describe('test classWithModifiers', () => {
    it('should return correct class with modifier', () => {
      expect(osu.classWithModifiers('base-class', ['modifier'])).toBe('base-class base-class--modifier');
    })

    it('should only return base class name when modifier is undefined', () => {
      expect(osu.classWithModifiers('base-class')).toBe('base-class');
    })

    it('should only return base class name when modifier is empty', () => {
      expect(osu.classWithModifiers('base-class', [])).toBe('base-class');
    })
  })

  describe('test updateQueryString', () => {
    it('should add the new parameter to the query string', () => {
      const params = {
        foo: 'bar',
      };

      const expected = new URL('/nowhere?foo=bar', location.origin).href;
      const result = osu.updateQueryString('/nowhere', params);

      expect(result).toBe(expected);
    });

    it('should update the existing parameter value', () => {
      const params = {
        something: '2',
      };

      const expected = new URL('/nowhere?something=2', location.origin).href;
      const result = osu.updateQueryString('/nowhere?something=1', params);

      expect(result).toBe(expected);
    });

    it('should append the new parameter value', () => {
      const params = {
        more: '3',
      };

      const expected = new URL('/nowhere?something=1&more=3', location.origin).href;
      const result = osu.updateQueryString('/nowhere?something=1', params);

      expect(result).toBe(expected);
    });

    it('should update the existing parameter and append the new parameter value', () => {
      const params = {
        more: '3',
        something: '5',
      };

      const expected = new URL('/nowhere?something=5&more=3', location.origin).href;
      const result = osu.updateQueryString('/nowhere?something=1', params);

      expect(result).toBe(expected);
    });
  })
});
