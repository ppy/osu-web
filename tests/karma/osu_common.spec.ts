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

import GroupJson from 'interfaces/group-json';
import * as React from 'react';

describe('osu_common', () => {
  describe('locale file loaded in test runner', () => {
    it('should be loaded', () => {
      expect(Lang.has('common.confirmation')).toBe(true);
    });
  });

  describe('groupColour', () => {
    const group: GroupJson = {
      colour: '#abcdef',
      has_listing: true,
      has_playmodes: true,
      id: 1,
      identifier: 'abc',
      is_probationary: false,
      name: 'ABC',
      short_name: 'abc',
    };

    it('should return CSS object with correct colour', () => {
      expect(osu.groupColour(group)).toEqual({
        '--group-colour': '#abcdef',
      } as React.CSSProperties);
    });

    it('should return CSS object with initial value when colour is null', () => {
      expect(osu.groupColour({ ...group, colour: null })).toEqual({
        '--group-colour': 'initial',
      } as React.CSSProperties);
    });

    it('should return CSS object with initial value when group is undefined', () => {
      expect(osu.groupColour()).toEqual({
        '--group-colour': 'initial',
      } as React.CSSProperties);
    });
  });

  describe('jsonClone', () => {
    it('should clone object', () => {
      const obj = { test: '1234' };
      const result = osu.jsonClone(obj);

      expect(result).toEqual(obj);
      expect(result).not.toBe(obj);
    });

    it('should clone nested object', () => {
      const obj = { test: { inner: '1234' } };
      const result = osu.jsonClone(obj);

      expect(result.test).toEqual(obj.test);
      expect(result.test).not.toBe(obj.test);
    });

    it('should clone null', () => {
      expect(osu.jsonClone(null)).toBe(null);
    });

    it('should clone undefined to null', () => {
      expect(osu.jsonClone(undefined)).toBe(null);
    });
  });

  describe('linkify', () => {
    const textWithLink = 'Please visit https://link.com';

    it('replaces the link with an anchor element', () => {
      expect(osu.linkify(textWithLink)).toBe(
        `Please visit <a href="https://link.com" rel="nofollow noreferrer">link.com</a>`,
      );
    });

    it('replaces the link with an anchor element with target blank', () => {
      expect(osu.linkify(textWithLink, true)).toBe(
        `Please visit <a href="https://link.com" rel="nofollow noreferrer" target="_blank">link.com</a>`,
      );
    });

    it('does not change the string', () => {
      expect(osu.linkify('plain text')).toBe('plain text');
    });
  });

  describe('formatBytes', () => {
    it('cenvert to same value in bytes', () => {
      expect(osu.formatBytes(100)).toBe('100 B');
    });

    it('convert value to KB', () => {
      expect(osu.formatBytes(1000)).toBe('1.00 KB');
    });

    it('convert value to MB', () => {
      expect(osu.formatBytes(1000000)).toBe('1.00 MB');
    });

    it('convert value to KB without precision', () => {
      expect(osu.formatBytes(1000, 0)).toBe('1 KB');
    });
  });

  describe('formatNumber', () => {
    it('format null', () => {
      expect(osu.formatNumber(null)).toBe(null);
    });

    it('formats the number with correct precision', () => {
      expect(osu.formatNumber(12.345, 2)).toBe('12.35');
    });

    it('formats the number without precision', () => {
      expect(osu.formatNumber(12.34, 0)).toBe('12');
    });
  });

  describe('presence', () => {
    it('should return same string', () => {
      expect(osu.presence('test')).toBe('test');
    });

    it('should check for empty string', () => {
      expect(osu.presence('')).toBe(null);
    });

    it('should check for null', () => {
      expect(osu.presence(null)).toBe(null);
    });

    it('should check for undefined', () => {
      expect(osu.presence()).toBe(null);
    });
  });

  describe('present', () => {
    it('should check for non empty string', () => {
      expect(osu.present('test')).toBe(true);
    });

    it('should check for empty string', () => {
      expect(osu.present('')).toBe(false);
    });

    it('should check for null', () => {
      expect(osu.present(null)).toBe(false);
    });

    it('should check for undefined', () => {
      expect(osu.present()).toBe(false);
    });
  });

  describe('trans', () => {
    it('returns the translated key', () => {
      expect(osu.trans('common.confirmation')).toBe('Are you sure?');
    });

    it('returns the untranslated key for missing translation', () => {
      expect(osu.trans('common.this_is_not_existed')).toBe('common.this_is_not_existed');
    });
  });

  describe('transArray', () => {
    it('should empty string for empty array', () => {
      expect(osu.transArray([])).toBe('');
    });

    it('should return correct translation for single item array', () => {
      expect(osu.transArray(['Me'])).toBe('Me');
    });

    it('should return correct translation for two items array', () => {
      expect(osu.transArray(['Me', 'My Self'])).toBe('Me and My Self');
    });

    it('should return correct translation for three items array', () => {
      expect(osu.transArray(['Me', 'My Self', 'I'])).toBe('Me, My Self, and I');
    });
  });

  describe('transExists', () => {
    it('check if translation exists', () => {
      expect(osu.transExists('common.confirmation')).toBe(true);
    });

    it('check if translation does not exist', () => {
      expect(osu.transExists('common.this_is_not_existed')).toBe(false);
    });
  });

  describe('updateQueryString', () => {
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
  });
});
