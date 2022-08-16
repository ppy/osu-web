// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { maxLengthTimeline, validMessageLength } from 'utils/beatmapset-discussion-helper';

describe('utils/beatmapset-discussion-helper', () => {
  describe('.validMessageLength', () => {
    const cases = [
      { description: 'should fail general null message', expected: false, isTimeline: false, message: null },
      { description: 'should fail general empty message', expected: false, isTimeline: false, message: '' },
      { description: 'should fail timeline null message', expected: false, isTimeline: true, message: null },
      { description: 'should fail timeline empty message', expected: false, isTimeline: true, message: '' },
      {
        description: `should pass general message of ${maxLengthTimeline} characters`,
        expected: true,
        isTimeline: false,
        message: 'a'.repeat(maxLengthTimeline),
      },
      {
        description: `should pass general message of more than ${maxLengthTimeline} characters`,
        expected: true,
        isTimeline: false,
        message: 'a'.repeat(maxLengthTimeline + 1),
      },
      {
        description: `should pass timeline message of ${maxLengthTimeline} characters`,
        expected: true,
        isTimeline: true,
        message: 'a'.repeat(maxLengthTimeline),
      },
      {
        description: `should fail timeline message of more than ${maxLengthTimeline} characters`,
        expected: false,
        isTimeline: true,
        message: 'a'.repeat(maxLengthTimeline + 1),
      },
    ];

    cases.forEach((test) => {
      it(test.description, () => {
        expect(validMessageLength(test.message, test.isTimeline)).toBe(test.expected);
      });
    });
  });
});
