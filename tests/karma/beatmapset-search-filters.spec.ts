// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { BeatmapsetSearchFilters } from 'beatmapset-search-filters';
import core from 'osu-core-singleton';
import testCurrentUserJson from './test-current-user-json';

describe('BeatmapsetSearchFilters', () => {
  let subject: BeatmapsetSearchFilters;

  describe('.query', () => {
    beforeAll(() => {
      core.setCurrentUser(testCurrentUserJson);
    });

    afterAll(() => {
      core.setCurrentUser({ id: undefined });
    });

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
      subject.update('query', 'foo' );

      expect(subject.sort).toBeNull();
    });

    it('should reset sort when status changes', () => {
      subject.update('status', 'foo' );

      expect(subject.sort).toBeNull();
    });

    it('should not reset sort if status nor query changes', () => {
      subject.update('genre', 'bar');

      expect(subject.sort).toBe('title_desc');
    });
  });
});
