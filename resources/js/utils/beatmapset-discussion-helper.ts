// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { Filter, filters } from 'beatmap-discussions/current-discussions';
import DiscussionMode, { DiscussionPage, discussionPages } from 'beatmap-discussions/discussion-mode';
import guestGroup from 'beatmap-discussions/guest-group';
import mapperGroup from 'beatmap-discussions/mapper-group';
import BeatmapJson from 'interfaces/beatmap-json';
import BeatmapsetDiscussionJson, { BeatmapsetDiscussionJsonForBundle, BeatmapsetDiscussionJsonForShow } from 'interfaces/beatmapset-discussion-json';
import BeatmapsetDiscussionPostJson from 'interfaces/beatmapset-discussion-post-json';
import BeatmapsetJson from 'interfaces/beatmapset-json';
import GameMode from 'interfaces/game-mode';
import UserJson from 'interfaces/user-json';
import { route } from 'laroute';
import { assign, padStart, sortBy } from 'lodash';
import * as moment from 'moment';
import core from 'osu-core-singleton';
import { currentUrl } from 'utils/turbolinks';
import { linkHtml, openBeatmapEditor } from 'utils/url';
import { getInt } from './math';

interface BadgeGroupParams {
  beatmapset: BeatmapsetJson;
  currentBeatmap: BeatmapJson | null;
  discussion: BeatmapsetDiscussionJson;
  user?: UserJson;
}

type MakeUrlOptions = {
  filter?: Filter;
  mode?: DiscussionPage;
  user?: number;
} & (
  // enforces mutual exclusivity when passing in as paramaters.
  // doesn't completely discriminate the type during type checks.
  {
    beatmap?: never;
    beatmapId?: number;
    beatmapsetId?: number;
    discussion?: never;
    discussionId?: number;
    post?: never;
    postId?: number;
  } | {
    beatmap?: BeatmapJson;
    beatmapId?: never;
    beatmapsetId?: never;
    discussion?: BeatmapsetDiscussionJson;
    discussionId?: never;
    post?: BeatmapsetDiscussionPostJson;
    postId?: never;
  }
);

// This is more for ensuring parseUrl returns the correct non-nullable properties
type ParsedUrlParams =
  Omit<MakeUrlOptions, 'beatmap' | 'discussion' | 'post'>
  & Required<Pick<MakeUrlOptions, 'beatmapsetId' | 'filter' | 'mode'>>;

interface PropsFromHrefValue {
  children?: string;
  className?: string;
  href: string;
  rel: 'nofollow noreferrer';
  target?: '_blank';
}

export const defaultFilter = 'total';

// parseUrl and makeUrl lookups
const filterLookup = new Set<unknown>(filters);
const generalPages = new Set<unknown>(['events', 'generalAll', 'reviews']);
const pageLookup = new Set<unknown>(discussionPages);

const defaultBeatmapId = '-';

const linkTimestampRegex = /\b((\d{2}):(\d{2})[:.](\d{3})( \([\d,|]+\)|\b))/g;
export const timestampRegex = /\b(((\d{2,}):([0-5]\d)[:.](\d{3}))(\s\((?:\d+[,|])*\d+\))?)/;
export const timestampRegexGlobal = new RegExp(timestampRegex, 'g');
export const maxLengthTimeline = 750;
export const maxMessagePreviewLength = 100;

export type NearbyDiscussion<T extends BeatmapsetDiscussionJson> = T & { timestamp: number };
type NearbyDiscussionsCategory = 'd0' | 'd100' | 'd1000' | 'other';
const nearbyDiscussionsMessageTypes = new Set(['suggestion', 'problem']);

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

export function canModeratePosts(user?: UserJson) {
  user ??= core.currentUser;
  if (user == null) return false;

  return (user.is_admin || user.is_moderator) ?? false;
}

export function defaultMode(beatmapId?: number | string | null) {
  return beatmapId != null && beatmapId !== defaultBeatmapId ? 'timeline' : 'generalAll';
}

export function discussionMode(discussion: BeatmapsetDiscussionJson): DiscussionMode {
  return discussion.message_type === 'review'
    ? 'reviews'
    : discussion.beatmap_id != null
      ? discussion.timestamp != null
        ? 'timeline'
        : 'general'
      : 'generalAll';
}

export function formatTimestamp(value: number) {
  const ms = value % 1000;
  const s = Math.floor(value / 1000) % 60;
  // remaining duration goes here even if it's over an hour
  const m = Math.floor(value / 1000 / 60);

  return `${padStart(m.toString(), 2, '0')}:${padStart(s.toString(), 2, '0')}:${padStart(ms.toString(), 3, '0')}`;
}


function isDiscussionPage(value: string): value is DiscussionPage {
  return pageLookup.has(value);
}

function isFilter(value: string): value is Filter {
  return filterLookup.has(value);
}

function isNearbyDiscussion<T extends BeatmapsetDiscussionJson>(discussion: T): discussion is NearbyDiscussion<T> {
  return discussion.deleted_at == null
    && discussion.timestamp != null
    && nearbyDiscussionsMessageTypes.has(discussion.message_type)
    && (discussion.user_id !== core.currentUserOrFail.id || moment(discussion.updated_at).diff(moment(), 'hour') <= -24);
}

export function isUserFullNominator(user?: UserJson | null, gameMode?: GameMode) {
  return user != null && user.groups != null && user.groups.some((group) => {
    if (gameMode != null) {
      return (group.identifier === 'bng' || group.identifier === 'nat') && group.playmodes?.includes(gameMode);
    } else {
      return (group.identifier === 'bng' || group.identifier === 'nat');
    }
  });
}

export function linkTimestamp(text: string, classNames: string[] = []) {
  return text.replace(
    linkTimestampRegex,
    (_match, _timestamp, m: string, s: string, ms: string, range?: string) => {
      const timestamp = `${m}:${s}:${ms}${range ?? ''}`;

      return linkHtml(openBeatmapEditor(timestamp), timestamp, { classNames });
    },
  );
}

export function makeUrl(options: MakeUrlOptions) {
  const {
    beatmap,
    discussion,
    filter,
    post,
    user,
  } = options;

  let {
    beatmapId,
    beatmapsetId,
    discussionId,
    mode,
    postId,
  } = options;

  // TODO: beatmap and discussion are never passed at the same time;
  // ids are also never passed if the objects are being used (except the user id)
  if (beatmap != null) {
    beatmapsetId = beatmap.beatmapset_id;
    beatmapId = beatmap.id;
  }

  if (discussion != null) {
    discussionId = discussion.id;
    const discussionState = stateFromDiscussion(discussion);
    if (discussionState != null) {
      beatmapsetId = discussionState.beatmapsetId;
      beatmapId = discussionState.beatmapId ?? undefined;
      mode = discussionState.mode;
    }
  }

  postId = post?.id ?? postId;

  const params: Partial<Record<string, string | number | null>> = {
    beatmap: beatmapId == null || generalPages.has(mode) ? defaultBeatmapId : beatmapId,
    beatmapset: beatmapsetId,
    mode: mode ?? defaultMode(beatmapId),
  };

  if (filter != null && filter !== 'total' && params.mode !== 'events') {
    params.filter = filter;
  }

  const value = new URL(route('beatmapsets.discussion', params));
  if (discussionId != null) {
    value.hash = `/${discussionId}`;

    if (postId != null) {
      value.hash += `/${postId}`;
    }
  }

  if (user != null) {
    value.searchParams.set('user', user.toString());
  }

  return value.toString();
}

export function nearbyDiscussions<T extends BeatmapsetDiscussionJson, R extends NearbyDiscussion<T>>(discussions: T[], timestamp: number): R[] {
  const nearby: Partial<Record<NearbyDiscussionsCategory, R[]>> = {};

  for (const discussion of discussions) {
    if (isNearbyDiscussion(discussion)) {
      const distance = Math.abs(discussion.timestamp - timestamp);
      const category = nearbyDiscussionsDistanceToCategory(distance);

      if (category != null) {
        nearby[category] ??= [];
        nearby[category]?.push(discussion as R); // TODO: how to type without casting
      }
    }
  }

  const shownDiscussions = nearby.d0 ?? nearby.d100 ?? nearby.d1000 ?? nearby.other ?? [];

  return sortBy(shownDiscussions, 'timestamp');
}

function nearbyDiscussionsDistanceToCategory(distance: number): NearbyDiscussionsCategory | null {
  if (distance > 5000) {
    return null;
  } else if (distance === 0) {
    return 'd0';
  } else if (distance < 100) {
    return 'd100';
  } else if (distance < 1000) {
    return 'd1000';
  } else {
    return 'other';
  }
}

export function parseTimestamp(message?: string | null) {
  if (message == null) return null;

  const matches = message.match(timestampRegex);

  if (matches == null) return null;

  const timestamp = matches.slice(1).map((match) => getInt(match) ?? 0);

  // this isn't all that smart
  return (timestamp[2] * 60 + timestamp[3]) * 1000 + timestamp[4];
}

export function parseUrl(urlString?: string | null, discussions?: BeatmapsetDiscussionJson[] | null) {
  const url = new URL(urlString ?? currentUrl().href);

  const [, pathBeatmapsets, beatmapsetIdString, pathDiscussions, beatmapIdString, mode, filter] = url.pathname.split(/\/+/);
  const beatmapsetId = getInt(beatmapsetIdString);

  if (pathBeatmapsets !== 'beatmapsets' || pathDiscussions !== 'discussion' || beatmapsetId == null) {
    return null;
  }

  const beatmapId = getInt(beatmapIdString);

  const ret: ParsedUrlParams = {
    beatmapId,
    beatmapsetId,
    filter: isFilter(filter) ? filter : 'total',
    // empty path segments are ''
    mode: isDiscussionPage(mode) ? mode : defaultMode(beatmapId),
    user: getInt(url.searchParams.get('user')),
  };

  if (url.hash[1] === '/') {
    const [discussionId, postId] = url.hash.split('/').slice(1, 3).map(getInt);
    if (discussionId != null) {
      ret.discussionId = discussionId;
      if (postId != null) {
        ret.postId = postId;
      }

      if (discussions != null && discussionId != null) {
        const discussion = discussions.find((value) => value.id === discussionId);

        if (discussion != null) {
          assign(ret, stateFromDiscussion(discussion));
          if (discussion.posts != null) {
            const post = discussion.posts.find((value) => value.id === postId);
            if (post == null) {
              ret.postId = undefined;
            }
          }
        } else {
          ret.discussionId = undefined;
          ret.postId = undefined;
        }
      }
    }
  }

  return ret;
}

export function propsFromHref(href = '') {
  const current = parseUrl();

  const props: PropsFromHrefValue = {
    href,
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
    const target = parseUrl(targetUrl.href);
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

export function stateFromDiscussion(discussion: BeatmapsetDiscussionJson) {
  return {
    beatmapId: discussion.beatmap_id,
    beatmapsetId: discussion.beatmapset_id,
    discussionId: discussion.id,
    mode: discussionMode(discussion),
  };
}

export function validMessageLength(message?: string | null, isTimeline = false) {
  if (!message?.length) return false;

  return !isTimeline || message.length <= maxLengthTimeline;
}
