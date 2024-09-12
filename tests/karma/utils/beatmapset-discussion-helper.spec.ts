// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapsetDiscussionJson from 'interfaces/beatmapset-discussion-json';
import GameMode from 'interfaces/ruleset';
import UserGroupJson from 'interfaces/user-group-json';
import UserJson from 'interfaces/user-json';
import * as moment from 'moment';
import core from 'osu-core-singleton';
import { discussionMode, isUserFullNominator, maxLengthTimeline, nearbyDiscussions, validMessageLength } from 'utils/beatmapset-discussion-helper';
import testCurrentUserJson from '../test-current-user-json';

interface TestCase<T> {
  description: string;
  expected: T;
}

const template: BeatmapsetDiscussionJson = Object.freeze({
  beatmap_id: 1,
  beatmapset_id: 1,
  can_be_resolved: true,
  can_grant_kudosu: true,
  created_at: '',
  deleted_at: null,
  deleted_by_id: null,
  id: 1,
  kudosu_denied: false,
  last_post_at: '',
  message_type: 'problem',
  parent_id: null,
  resolved: false,
  timestamp: 1,
  updated_at: '',
  user_id: 1,
});

describe('utils/beatmapset-discussion-helper', () => {
  describe('.discussionMode', () => {
    const cases = [
      {
        description: 'discussion review',
        expected: 'reviews',
        json: Object.assign({}, template, { message_type: 'review' }),
      },
      {
        description: 'discussion without beatmap without timestamp',
        expected: 'generalAll',
        json: Object.assign({}, template, { beatmap_id: null, timestamp: null }),
      },
      {
        description: 'discussion without beatmap with timestamp',
        expected: 'generalAll',
        json: Object.assign({}, template, { beatmap_id: null }),
      },
      {
        description: 'discussion with beatmap without timestamp',
        expected: 'general',
        json: Object.assign({}, template, { timestamp: null }),
      },
      {
        description: 'discussion with beatmap with timestamp',
        expected: 'timeline',
        json: template,
      },
    ];

    cases.forEach((test) => {
      it(test.description, () => {
        expect(discussionMode(test.json)).toBe(test.expected);
      });
    });
  });

  describe('.isUserFullNominator', () => {
    const userTemplate = structuredClone(testCurrentUserJson);
    const groupsTemplate: UserGroupJson = {
      colour: null,
      has_listing: true,
      has_playmodes: true,
      id: 1,
      identifier: 'placeholder',
      is_probationary: false,
      name: 'test',
      short_name: 'test',
    };

    const allowedGroups = ['bng', 'nat'];
    const unallowedGroups = ['admin', 'bng_limited', 'bot', 'dev', 'loved'];

    describe('with no gameMode', () => {
      const cases = [];
      for (const identifier of allowedGroups) {
        cases.push({
          description: `${identifier} is full nominator`,
          expected: true,
          user: { ...userTemplate, groups: [{ ...groupsTemplate, identifier }] },
        });
      }

      for (const identifier of unallowedGroups) {
        cases.push({
          description: `${identifier} is not full nominator`,
          expected: false,
          user: { ...userTemplate, groups: [{ ...groupsTemplate, identifier }] },
        });
      }

      cases.push({
        description: 'groupless is not full nominator',
        expected: false,
        user: { ...userTemplate },
      });

      cases.forEach((test) => {
        it(test.description, () => {
          expect(isUserFullNominator(test.user)).toBe(test.expected);
        });
      });
    });

    describe('with gameMode', () => {
      const cases: (TestCase<boolean> & { gameMode: GameMode; user: UserJson })[] = [];
      for (const identifier of allowedGroups) {
        cases.push({
          description: `${identifier} with matching playmode is full nominator`,
          expected: true,
          gameMode: 'osu',
          user: { ...userTemplate, groups: [{ ...groupsTemplate, identifier, playmodes: ['osu'] }] },
        });

        cases.push({
          description: `${identifier} without matching playmode is not full nominator`,
          expected: false,
          gameMode: 'osu',
          user: { ...userTemplate, groups: [{ ...groupsTemplate, identifier, playmodes: ['taiko'] }] },
        });

        const isFullNominatorWhenNoRulesets = identifier === 'nat';
        cases.push({
          description: `${identifier} without playmodes is${isFullNominatorWhenNoRulesets ? '' : ' not'} full nominator`,
          expected: isFullNominatorWhenNoRulesets,
          gameMode: 'osu',
          user: { ...userTemplate, groups: [{ ...groupsTemplate, identifier }] },
        });
      }

      cases.forEach((test) => {
        it(test.description, () => {
          expect(isUserFullNominator(test.user, test.gameMode)).toBe(test.expected);
        });
      });
    });
  });

  describe('.nearbyDiscussions', () => {
    describe('discussion by the same user', () => {
      const cases = [
        {
          description: 'less than 24 hours ago should be ignored',
          discussions: [Object.assign({}, template, { updated_at: moment().toISOString() })],
          expectEmpty: true,
        },
        {
          description: 'at least than 24 hours ago should be included',
          discussions: [Object.assign({}, template, { updated_at: moment().add(-24, 'hours').toISOString() })],
          expectEmpty: false,
        },
      ];

      beforeAll(() => {
        core.setCurrentUser(testCurrentUserJson);
      });

      afterAll(() => {
        core.setCurrentUser({ id: undefined });
      });

      cases.forEach((test) => {
        it(test.description, () => {
          const result = nearbyDiscussions(test.discussions, 1);
          expect(result.length).toBe(test.expectEmpty ? 0 : 1);
        });
      });
    });
  });

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
