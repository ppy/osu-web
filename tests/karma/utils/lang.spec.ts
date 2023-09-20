// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { trans, transArray, transExists } from 'utils/lang';


describe('utils/lang', () => {
  describe('locale file loaded in test runner', () => {
    it('should be loaded', () => {
      expect(window.Lang.has('common.confirmation')).toBe(true);
    });
  });

  describe('.trans', () => {
    it('returns the translated key', () => {
      expect(trans('common.confirmation')).toBe('Are you sure?');
    });

    it('returns the untranslated key for missing translation', () => {
      expect(trans('common.this_is_not_existed')).toBe('common.this_is_not_existed');
    });
  });

  describe('.transArray', () => {
    it('should empty string for empty array', () => {
      expect(transArray([])).toBe('');
    });

    it('should return correct translation for single item array', () => {
      expect(transArray(['Me'])).toBe('Me');
    });

    it('should return correct translation for two items array', () => {
      expect(transArray(['Me', 'My Self'])).toBe('Me and My Self');
    });

    it('should return correct translation for three items array', () => {
      expect(transArray(['Me', 'My Self', 'I'])).toBe('Me, My Self, and I');
    });
  });

  describe('.transExists', () => {
    it('check if translation exists', () => {
      expect(transExists('common.confirmation')).toBe(true);
    });

    it('check if translation does not exist', () => {
      expect(transExists('common.this_is_not_existed')).toBe(false);
    });
  });
});
