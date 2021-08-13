// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { BeatmapsetSearchFilters } from 'beatmapset-search-filters';

describe('BeatmapsetSearchFilters', () => {
  let subject: BeatmapsetSearchFilters;

  describe('.query', () => {
    beforeEach(() => {
      subject = new BeatmapsetSearchFilters('https://notarealdomain');
    });

    it('should remove leading whitespace', () => {
      subject.query = '  whee 12 ああ';

      expect(subject.query).toBe('whee 12 ああ');
    });

    it('should remove trailing whitespace', () => {
      subject.query = 'whee 12 ああ  ';

      expect(subject.query).toBe('whee 12 ああ');
    });

    it('should treat empty string as null', () => {
      subject.query = '';

      // type inference was a bit _too_ smart.
      expect(subject.query as string | null).toBe(null);
    });
  });

  describe('.update', () => {
    beforeEach(() => {
      subject = new BeatmapsetSearchFilters('https://notarealdomain/?sort=title_desc');
    });

    it('should reset sort when query changes', () => {
      subject.update({ query: 'foo' });

      expect(subject.sort).toBeNull();
    });

    it('should reset sort when status changes', () => {
      subject.update({ status: 'foo' });

      expect(subject.sort).toBeNull();
    });

    it('should not reset sort if status nor query changes', () => {
      subject.update({ mode: 'osu', genre: 'bar' });

      expect(subject.sort).toBe('title_desc');
    });
  });
});
