// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { formatNumber } from 'utils/html';

describe('utils/html', () => {
  describe('formatNumber', () => {
    it('formats the number with correct precision', () => {
      expect(formatNumber(12.345, 2)).toBe('12.35');
    });

    it('formats the number without precision', () => {
      expect(formatNumber(12.34, 0)).toBe('12');
    });
  });
});
