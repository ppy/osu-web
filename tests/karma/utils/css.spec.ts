// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { urlPresence } from 'utils/css';

describe('utils/css', () => {
  describe('.urlPresence', () => {
    describe('when url is empty', () => {
      const cases = [
        {
          description: 'empty string should be undefined',
          url: '',
        },
        {
          description: 'null should be undefined',
          url: null,
        },
        {
          description: 'undefined should be undefined',
          url: undefined,
        },
      ];

      cases.forEach((test) => {
        it(test.description, () => {
          expect(urlPresence(test.url)).toBe(undefined);
        });
      });
    });

    describe('when url is not empty', () => {
      const cases = [
        {
          description: 'should wrap with url',
          expected: 'url("//some-path?a=1")',
          url: '//some-path?a=1',
        },
        {
          description: 'should escape double quotes',
          expected: 'url("https://localhost/why%22double%22quotes?a=%22%22")',
          url: 'https://localhost/why"double"quotes?a=""',
        },
      ];

      cases.forEach((test) => {
        it(test.description, () => {
          expect(urlPresence(test.url)).toBe(test.expected);
        });
      });
    });
  });
});
