// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { AnchorHTMLAttributes } from 'react';

export function propsFromHref(href: string) {
  const currentBeatmapsetDiscussions = BeatmapDiscussionHelper.urlParse(window.location.href);

  const targetUrl = new URL(href);
  const props: AnchorHTMLAttributes<HTMLAnchorElement> = {
    children: href,
    rel: 'nofollow noreferrer',
    target: '_blank',
  };

  if (targetUrl.host === window.location.host) {
    const targetBeatmapsetDiscussions = BeatmapDiscussionHelper.urlParse(targetUrl.href, null, { forceDiscussionId: true });
    if (targetBeatmapsetDiscussions?.discussionId != null) {
      if (currentBeatmapsetDiscussions?.beatmapsetId === targetBeatmapsetDiscussions.beatmapsetId) {
        // same beatmapset, format: #123
        props.children = `#${targetBeatmapsetDiscussions.discussionId}`;
        props.className = 'js-beatmap-discussion--jump';
        props.target = undefined;
      } else {
        // different beatmapset, format: 1234#567
        props.children = `${targetBeatmapsetDiscussions.beatmapsetId}#${targetBeatmapsetDiscussions.discussionId}`;
      }
    }
  }

  return props;
}
