// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapsetDiscussionJson from 'interfaces/beatmapset-discussion-json';
import { trans } from 'utils/lang';

export const sortPresets = {
  created_at: {
    sort(a: BeatmapsetDiscussionJson, b: BeatmapsetDiscussionJson) {
      return a.created_at === b.created_at
        ? a.id - b.id
        : Date.parse(a.created_at) - Date.parse(b.created_at);
    },
    text: trans('beatmaps.discussions.sort.created_at'),
  },
  // there's obviously no timeline field
  timeline: {
    sort(a: BeatmapsetDiscussionJson, b: BeatmapsetDiscussionJson) {
      // TODO: this shouldn't be called when not timeline, anyway.
      if (a.timestamp == null || b.timestamp == null) {
        return 0;
      }

      return a.timestamp === b.timestamp
        ? a.id - b.id
        : a.timestamp - b.timestamp;
    },
    text: trans('beatmaps.discussions.sort.timeline'),
  },
  updated_at: {
    sort(a: BeatmapsetDiscussionJson, b: BeatmapsetDiscussionJson) {
      return a.last_post_at === b.last_post_at
        ? b.id - a.id
        : Date.parse(b.last_post_at) - Date.parse(a.last_post_at);
    },
    text: trans('beatmaps.discussions.sort.updated_at'),
  },
};

type Sort = 'created_at' | 'updated_at' | 'timeline';

export default Sort;
