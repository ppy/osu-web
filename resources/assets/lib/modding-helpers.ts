// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { BeatmapsetJSON } from 'beatmapsets/beatmapset-json';
import { route } from 'laroute';
import { Dictionary } from 'lodash';

export interface BeatmapsetEvent {
  beatmapset?: BeatmapsetJSON;
  comment: any;
  created_at: string;
  discussion?: BeatmapDiscussion;
  id: number;
  starting_post?: string; //  used when looking at user modding profile.
  type: string;
  user_id?: number;
}

export function contentText(event: BeatmapsetEvent, users: any, discussionId?: number, discussions?: Dictionary<BeatmapDiscussion>) {
  let discussionLink = '';
  let text = '';
  let user = '';

  if (discussionId != null) {
    if (discussions != null) {
      const discussion = discussions[discussionId];

      let url: string;

      if (discussion != null) {
        url = BeatmapDiscussionHelper.url({ discussion });
        text = BeatmapDiscussionHelper.previewMessage(discussion.posts[0]?.message);
      } else {
        url = route('beatmap-discussions.show', { beatmap_discussion: discussionId });
        text = osu.trans('beatmapset_events.item.discussion_deleted');
      }

      discussionLink = osu.link(url, `#${discussionId}`, { classNames: ['js-beatmap-discussion--jump'] });
    } else {
      discussionLink = osu.link(route('beatmapsets.discussion', { beatmapset: event.beatmapset?.id }), `#${discussionId}`, { classNames: ['js-beatmap-discussion--jump'] });
      const message = event.discussion?.starting_post?.message;
      text = message != null ? BeatmapDiscussionHelper.previewMessage(message) : '[no preview]';
    }
  } else if (event.type === 'discussion_lock') {
    text = BeatmapDiscussionHelper.format(event.comment.reason, { newlines: false });
  } else if (!(event.type in ['genre_edit', 'language_edit'])) {
    text = BeatmapDiscussionHelper.format(event.comment, { newlines: false });
  }

  if (event.user_id != null) {
    user = osu.link(route('users.show', { user: event.user_id }), users[event.user_id]?.username);
  }

  const key = event.type === 'disqualify' && discussionId == null ? 'disqualify_legacy' : event.type;

  const params = {
    discussion: discussionLink,
    text,
    user,
    ...event.comment,
  };

  let message = osu.trans(`beatmapset_events.event.${key}`, params);

  // append owner of the event if not already included in main message
  if (user != null
    && !(event.type in ['disqualify', 'kudosu_gain', 'kudosu_lost', 'nominate'])
  ) {
    message += ` (${user})`;
  }

  return message;
}
