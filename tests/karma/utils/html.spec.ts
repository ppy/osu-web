// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { formatBytes, formatNumber, isClickable, isInputElement } from 'utils/html';

describe('utils/html', () => {
  describe('formatBytes', () => {
    it('cenvert to same value in bytes', () => {
      expect(formatBytes(100)).toBe('100 B');
    });

    it('convert value to KB', () => {
      expect(formatBytes(1000)).toBe('1.00 KB');
    });

    it('convert value to MB', () => {
      expect(formatBytes(1000000)).toBe('1.00 MB');
    });

    it('convert value to KB without precision', () => {
      expect(formatBytes(1000, 0)).toBe('1 KB');
    });
  });

  describe('formatNumber', () => {
    it('formats the number with correct precision', () => {
      expect(formatNumber(12.345, 2)).toBe('12.35');
    });

    it('formats the number without precision', () => {
      expect(formatNumber(12.34, 0)).toBe('12');
    });
  });

  describe('isClickable', () => {
    ([
      [false, ['div', 'li', 'ol', 'p', 'ul']],
      [true, ['a', 'button', 'input', 'option', 'select', 'textarea']],
    ] as const).forEach(([res, elTypes]) => {
      elTypes.forEach((elType) => {
        it(`returns ${res} for "${elType}" element`, () => {
          expect(isClickable(document.createElement(elType))).toBe(res);
        });
      });
    });


    it('returns true for child of clickable element', () => {
      const el = document.createElement('p');
      document.createElement('button').appendChild(el);
      expect(isClickable(el)).toBe(true);
    });

    it('returns true for contentEditable element', () => {
      const el = document.createElement('p');
      el.contentEditable = 'true';
      expect(isClickable(el)).toBe(true);
    });
  });

  describe('isInputElement', () => {
    ([
      [false, ['a', 'button', 'div', 'li', 'ol', 'p', 'ul']],
      [true, ['input', 'select', 'option', 'textarea']],
    ] as const).forEach(([res, elTypes]) => {
      elTypes.forEach((elType) => {
        it(`returns ${res} for "${elType}" element`, () => {
          expect(isInputElement(document.createElement(elType))).toBe(res);
        });
      });
    });

    it('returns true for contentEditable element', () => {
      const el = document.createElement('p');
      el.contentEditable = 'true';
      expect(isInputElement(el)).toBe(true);
    });
  });
});
