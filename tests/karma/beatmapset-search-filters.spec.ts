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
