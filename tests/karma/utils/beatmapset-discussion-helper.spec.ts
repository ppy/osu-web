// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { BeatmapsetDiscussionJson } from 'legacy-modules';
import User from 'models/user';
import * as moment from 'moment';
import { discussionMode, maxLengthTimeline, nearbyDiscussions, validMessageLength } from 'utils/beatmapset-discussion-helper';

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

const currentUser = new User(1);
currentUser.updateWithJson({
  avatar_url: '',
  country_code: '',
  cover: { custom_url: null, id: null, url: null },
  default_group: '',
  id: 1,
  is_active: true,
  is_bot: false,
  is_deleted: false,
  is_online: true,
  is_supporter: true,
  last_visit: null,
  pm_friends_only: false,
  profile_colour: null,
  username: 'foo',
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

      // FIXME: need a better way of setting user in osu-core for tests.
      beforeAll(() => {
        $.publish('user:update', currentUser);
      });

      afterAll(() => {
        $.publish('user:update', {});
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
