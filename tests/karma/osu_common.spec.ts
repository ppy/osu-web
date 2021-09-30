// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import GroupJson from 'interfaces/group-json';
import * as React from 'react';
import { jsonClone } from 'utils/json';

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

    it('get CSS object with correct colour', () => {
      expect(osu.groupColour(group)).toEqual({
        '--group-colour': '#abcdef',
      } as React.CSSProperties);
    });

    it('get CSS object with initial value when null', () => {
      expect(osu.groupColour({ ...group, colour: null })).toEqual({
        '--group-colour': 'initial',
      } as React.CSSProperties);
    });

    it('get CSS object with initial value when undefined', () => {
      expect(osu.groupColour()).toEqual({
        '--group-colour': 'initial',
      } as React.CSSProperties);
    });
  });

  describe('jsonClone', () => {
    it('clone object with different reference', () => {
      const obj = { test: '1234' };
      const result = jsonClone(obj);

      expect(result).toEqual(obj);
      expect(result).not.toBe(obj);
    });

    it('clone nested object with different reference', () => {
      const obj = { test: { inner: '1234' } };
      const result = jsonClone(obj);

      expect(result.test).toEqual(obj.test);
      expect(result.test).not.toBe(obj.test);
    });

    it('clone null', () => {
      expect(jsonClone(null)).toBe(null);
    });

    it('clone undefined', () => {
      expect(jsonClone(undefined)).toBe(undefined);
    });
  });

  describe('linkify', () => {
    const textWithLink = 'Please visit https://link.com';

    it('replaces the link with an anchor element', () => {
      expect(osu.linkify(textWithLink)).toBe(
        'Please visit <a href="https://link.com" rel="nofollow noreferrer">link.com</a>',
      );
    });

    it('replaces the link with an anchor element with target blank', () => {
      expect(osu.linkify(textWithLink, true)).toBe(
        'Please visit <a href="https://link.com" rel="nofollow noreferrer" target="_blank">link.com</a>',
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
    it('check for non empty string', () => {
      expect(osu.presence('test')).toBe('test');
    });

    it('check for empty string', () => {
      expect(osu.presence('')).toBe(null);
    });

    it('check for null', () => {
      expect(osu.presence(null)).toBe(null);
    });

    it('check for undefined', () => {
      expect(osu.presence()).toBe(null);
    });
  });

  describe('present', () => {
    it('check for non empty string', () => {
      expect(osu.present('test')).toBe(true);
    });

    it('check for empty string', () => {
      expect(osu.present('')).toBe(false);
    });

    it('check for null', () => {
      expect(osu.present(null)).toBe(false);
    });

    it('check for undefined', () => {
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
