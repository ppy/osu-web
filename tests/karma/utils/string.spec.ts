// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { presence, present } from 'utils/string';

describe('utils/string', () => {
  describe('.presence', () => {
    it('check for non empty string', () => {
      expect(presence('test')).toBe('test');
    });

    it('check for empty string', () => {
      expect(presence('')).toBe(null);
    });

    it('check for null', () => {
      expect(presence(null)).toBe(null);
    });

    it('check for undefined', () => {
      expect(presence()).toBe(null);
    });
  });

  describe('.present', () => {
    it('check for non empty string', () => {
      expect(present('test')).toBe(true);
    });

    it('check for empty string', () => {
      expect(present('')).toBe(false);
    });

    it('check for null', () => {
      expect(present(null)).toBe(false);
    });

    it('check for undefined', () => {
      expect(present()).toBe(false);
    });
  });

  describe('locale file loaded in test runner', () => {
    it('should be loaded', () => {
      expect(window.Lang.has('common.confirmation')).toBe(true);
    });
  });
});
