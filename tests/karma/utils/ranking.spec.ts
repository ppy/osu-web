// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { rankingPageFromRank } from 'utils/ranking';

describe('utils/ranking', () => {
  describe('rankingPageFromRank', () => {
    it('returns the page containing the rank', () => {
      expect(rankingPageFromRank(1)).toBe(1);
      expect(rankingPageFromRank(50)).toBe(1);
      expect(rankingPageFromRank(51)).toBe(2);
      expect(rankingPageFromRank(10000)).toBe(200);
    });

    it('returns null for ranks outside visible rankings', () => {
      expect(rankingPageFromRank(null)).toBeNull();
      expect(rankingPageFromRank(0)).toBeNull();
      expect(rankingPageFromRank(10001)).toBeNull();
    });
  });
});
