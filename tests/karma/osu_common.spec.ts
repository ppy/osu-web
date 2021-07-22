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

import GroupJson from "interfaces/group-json";
import * as React from "react";

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

  describe('test diffColour', () => {
    it('should return CSS object with correct variable', () => {
      expect(osu.diffColour('normal')).toEqual({
        '--diff': 'var(--diff-normal)',
      } as React.CSSProperties);
    })

    it('should return CSS object with default variable', () => {
      expect(osu.diffColour()).toEqual({
        '--diff': 'var(--diff-default)',
      } as React.CSSProperties);
    })
  })

  describe('test groupColour', () => {
    const group: GroupJson = {
      colour: '#abcdef',
      has_listing: true,
      has_playmodes: true,
      id: 1,
      identifier: 'abc',
      is_probationary: false,
      name: 'ABC',
      short_name: 'abc',
    }

    it('should return CSS object with correct colour', () => {
      expect(osu.groupColour(group)).toEqual({
        '--group-colour': '#abcdef',
      } as React.CSSProperties)
    })

    it('should return CSS object with initial value when colour is null', () => {
      expect(osu.groupColour({ ...group, colour: null })).toEqual({
        '--group-colour': 'initial',
      } as React.CSSProperties)
    })

    it('should return CSS object with initial value when group is undefined', () => {
      expect(osu.groupColour()).toEqual({
        '--group-colour': 'initial',
      } as React.CSSProperties)
    })
  })

  describe('test jsonClone', () => {
    it('should return same object', () => {
      expect(osu.jsonClone({ test: '1234' })).toEqual({ test: '1234' });
    })

    it('should return null', () => {
      expect(osu.jsonClone(null)).toBe(null);
    })

    it('should return null when object is undefined', () => {
      expect(osu.jsonClone(undefined)).toBe(null);
    })
  })

  describe('test linkify', () => {
    const textWithLink = 'Please visit https://osu.ppy.sh/';

    it('should return correct anchor', () => {
      expect(osu.linkify(textWithLink)).toBe(
        `Please visit <a href="https://osu.ppy.sh/" rel="nofollow noreferrer">osu.ppy.sh/</a>`
      )
    })

    it('should return correct anchor with target blank', () => {
      expect(osu.linkify(textWithLink, true)).toBe(
        `Please visit <a href="https://osu.ppy.sh/" rel="nofollow noreferrer" target="_blank">osu.ppy.sh/</a>`
      )
    })
  })

  describe('test formatBytes', () => {
    it('should return same value in bytes', () => {
      expect(osu.formatBytes(100)).toBe('100 B');
    })

    it('should return correct value in KB', () => {
      expect(osu.formatBytes(1000)).toBe('1.00 KB');
    })

    it('should return correct value in MB', () => {
      expect(osu.formatBytes(1000000)).toBe('1.00 MB');
    })

    it('should return correct value in KB without trailing zero', () => {
      expect(osu.formatBytes(1000, 0)).toBe('1 KB');
    })
  })

  describe('test formatNumber', () => {
    it('should return null', () => {
      expect(osu.formatNumber(null)).toBe(null);
    })

    it('should return number with correct precision', () => {
      expect(osu.formatNumber(12.345, 2)).toBe('12.35');
    })

    it('shoudl return integer number', () => {
      expect(osu.formatNumber(12.34, 0)).toBe('12');
    })
  })

  describe('test presence', () => {
    it('should return same string', () => {
      expect(osu.presence('test')).toBe('test');
    })

    it('should return null for empty string', () => {
      expect(osu.presence('')).toBe(null);
    })

    it('should return null for null', () => {
      expect(osu.presence('')).toBe(null);
    })

    it('should return null for undefined', () => {
      expect(osu.presence()).toBe(null);
    })
  })

  describe('test present', () => {
    it('should return true for non empty string', () => {
      expect(osu.present('test')).toBe(true);
    })

    it('should return false for empty string', () => {
      expect(osu.present('')).toBe(false);
    })

    it('should return false for null', () => {
      expect(osu.present(null)).toBe(false);
    })

    it('should return false for undefined', () => {
      expect(osu.present()).toBe(false);
    })
  })

  describe('test trans', () => {
    it('should return correct translation', () => {
      expect(osu.trans('common.confirmation')).toBe('Are you sure?');
    })

    it('should return key for non existed translation', () => {
      expect(osu.trans('common.this_is_not_existed')).toBe('common.this_is_not_existed');
    })
  })

  describe('test transExists', () => {
    it('should return true for existed translation', () => {
      expect(osu.transExists('common.confirmation')).toBe(true);
    })

    it('should return false for non existed translation', () => {
      expect(osu.transExists('common.this_is_not_existed')).toBe(false);
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
