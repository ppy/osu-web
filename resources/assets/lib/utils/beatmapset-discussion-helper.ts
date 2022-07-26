// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import guestGroup from 'beatmap-discussions/guest-group';
import mapperGroup from 'beatmap-discussions/mapper-group';
import BeatmapJson from 'interfaces/beatmap-json';
import BeatmapsetDiscussionJson, { BeatmapsetDiscussionJsonForBundle, BeatmapsetDiscussionJsonForShow } from 'interfaces/beatmapset-discussion-json';
import BeatmapsetDiscussionPostJson from 'interfaces/beatmapset-discussion-post-json';
import BeatmapsetJson from 'interfaces/beatmapset-json';
import UserJson from 'interfaces/user-json';
import { escape, truncate } from 'lodash';
import { currentUrl } from 'utils/turbolinks';
import { linkHtml, openBeatmapEditor, urlRegex } from 'utils/url';
import { classWithModifiers, Modifiers } from './css';

interface BadgeGroupParams {
  beatmapset: BeatmapsetJson;
  currentBeatmap: BeatmapJson;
  discussion: BeatmapsetDiscussionJson;
  user?: UserJson;
}

interface FormatOptions {
  modifiers?: Modifiers;
  newlines?: boolean;
}

interface PropsFromHrefValue {
  [key: string]: string | undefined;
  children: string;
  className?: string;
  rel: 'nofollow noreferrer';
  target?: '_blank';
}

const lineBreakRegex = /(?:<br>){2,}/g;
const linkTimestampRegex = /\b((\d{2}):(\d{2})[:.](\d{3})( \([\d,|]+\)|\b))/g;
const maxMessagePreviewLength = 100;
export const maxLengthTimeline = 750;

export function badgeGroup({ beatmapset, currentBeatmap, discussion, user }: BadgeGroupParams) {
  if (user == null) {
    return null;
  }

  if (user.id === beatmapset.user_id) {
    return mapperGroup;
  }

  if (currentBeatmap != null && discussion.beatmap_id === currentBeatmap.id && user.id === currentBeatmap.user_id) {
    return guestGroup;
  }

  return user.groups?.[0];
}

function discussionLinkify(text: string) {
  // text should be pre-escaped.
  return text.replace(urlRegex, (match, url: string) => {
    const { children, ...props } = propsFromHref(url);
    // React types it as ReactNode but it can be a string.
    const displayUrl = typeof children === 'string' ? children : url;
    return linkHtml(url, displayUrl, { props, unescape: true });
  });
}

export function format(text: string, options: FormatOptions = {}) {
  text = linkTimestamp(discussionLinkify(escape(text).trim()), ['beatmap-discussion-timestamp-decoration']);

  if (options.newlines ?? true) {
    // replace newlines with <br>
    // - trim trailing spaces
    // - then join with <br>
    // - limit to 2 consecutive <br>s
    text = text
      .split('\n')
      .map((x) => x.trim())
      .join('<br>')
      .replace(lineBreakRegex, '<br><br>');
  }

  const blockClass = classWithModifiers('beatmapset-discussion-message', options.modifiers);

  return `<div class='${blockClass}'>${text}</div>`;
}


export function linkTimestamp(text: string, classNames: string[] = []) {
  return text.replace(
    linkTimestampRegex,
    (_match, timestamp: string, m: string, s: string, ms: string, range?: string) => (
      linkHtml(openBeatmapEditor(`${m}:${s}:${ms}${range ?? ''}`), timestamp, { classNames })
    ),
  );
}

export function previewMessage(message: string) {
  if (message.length > maxMessagePreviewLength) {
    return escape(truncate(message, { length: maxMessagePreviewLength }));
  }

  return format(message, { newlines: false });
}

export function propsFromHref(href: string) {
  const current = BeatmapDiscussionHelper.urlParse(currentUrl().href);

  const props: PropsFromHrefValue = {
    children: href,
    rel: 'nofollow noreferrer',
    target: '_blank',
  };

  let targetUrl: URL | undefined;

  try {
    // TODO: The regexp used sometimes catches invalid URL like "https://example.com]".
    // Either accept that as fact of life or a better regexp is needed which is
    // probably rather difficult especially if we're going to support parsing IDN.
    targetUrl = new URL(href);
  } catch (e: unknown) {
    // ignore error
  }

  if (targetUrl != null && targetUrl.host === currentUrl().host) {
    const target = BeatmapDiscussionHelper.urlParse(targetUrl.href, null, { forceDiscussionId: true });
    if (target?.discussionId != null && target.beatmapsetId != null) {
      const hash = [target.discussionId, target.postId].filter(Number.isFinite).join('/');
      if (current?.beatmapsetId === target.beatmapsetId) {
        // same beatmapset, format: #123
        props.children = `#${hash}`;
        props.className = 'js-beatmap-discussion--jump';
        props.target = undefined;
      } else {
        // different beatmapset, format: 1234#567
        props.children = `${target.beatmapsetId}#${hash}`;
      }
    }
  }

  return props;
}

// Workaround for the discussion starting_post typing mess until the response gets refactored and normalized.
export function startingPost(discussion: BeatmapsetDiscussionJsonForBundle | BeatmapsetDiscussionJsonForShow): BeatmapsetDiscussionPostJson {
  if (!('posts' in discussion)) {
    return discussion.starting_post;
  }

  return discussion.posts[0];
}

export function validMessageLength(message?: string | null, isTimeline = false) {
  if (!message?.length) return false;

  return !isTimeline || message.length <= maxLengthTimeline;
}
