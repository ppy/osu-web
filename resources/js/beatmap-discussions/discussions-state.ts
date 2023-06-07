// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapsetDiscussionJson from 'interfaces/beatmapset-discussion-json';
import BeatmapsetWithDiscussionsJson from 'interfaces/beatmapset-with-discussions-json';
import { isEmpty, keyBy, maxBy } from 'lodash';
import { computed, makeObservable, observable, toJS } from 'mobx';
import { deletedUser } from 'models/user';
import moment from 'moment';
import core from 'osu-core-singleton';
import { findDefault, group } from 'utils/beatmap-helper';
import { parseUrl } from 'utils/beatmapset-discussion-helper';
import { switchNever } from 'utils/switch-never';
import { Filter } from './current-discussions';
import DiscussionMode, { DiscussionPage } from './discussion-mode';

type DiscussionsAlias = BeatmapsetWithDiscussionsJson['discussions'];

export function filterDiscusionsByMode(discussions: DiscussionsAlias, mode: DiscussionMode, beatmapId: number) {
  console.log(mode);
  switch (mode) {
    case 'general':
      return discussions.filter((discussion) => discussion.beatmap_id === beatmapId);
    case 'generalAll':
      return discussions.filter((discussion) => discussion.beatmap_id == null);
    case 'reviews':
      return discussions.filter((discussion) => discussion.message_type === 'review');
    case 'timeline':
      return discussions.filter((discussion) => discussion.beatmap_id === beatmapId && discussion.timestamp != null);
    default:
      switchNever(mode);
      throw new Error('missing valid mode');
  }
}

export function filterDiscussionsByFilter(discussions: DiscussionsAlias, filter: Filter) {
  console.log(filter);
  switch (filter) {
    case 'deleted':
      return discussions.filter((discussion) => discussion.deleted_at != null);
    case 'hype':
      return discussions.filter((discussion) => discussion.message_type === 'hype');
    case 'mapperNotes':
      return discussions.filter((discussion) => discussion.message_type === 'mapper_note');
    case 'mine': {
      const userId = core.currentUserOrFail.id;
      return discussions.filter((discussion) => discussion.user_id === userId);
    }
    case 'pending':
      // TODO:
      // pending reviews
      // if (discussion.parent_id != null) {
      //   const parentDiscussion = discussions[discussion.parent_id];
      //   if (parentDiscussion != null && parentDiscussion.message_type == 'review') return true;
      // }
      return discussions.filter((discussion) => discussion.can_be_resolved && !discussion.resolved);
    case 'praises':
      return discussions.filter((discussion) => discussion.message_type === 'praise' || discussion.message_type === 'hype');
    case 'resolved':
      return discussions.filter((discussion) => discussion.can_be_resolved && discussion.resolved);
    case 'total':
      return discussions;
    default:
      switchNever(filter);
      throw new Error('missing valid filter');
  }
}

export default class DiscussionsState {
  @observable currentBeatmapId: number;
  @observable currentFilter: Filter = 'total';
  @observable currentMode: DiscussionPage = 'general';
  @observable discussionCollapsed = new Map<number, boolean>();
  @observable discussionDefaultCollapsed = false;
  @observable highlightedDiscussionId: number | null = null;
  @observable jumpToDiscussion = false;
  @observable pinnedNewDiscussion = false;

  @observable readPostIds = new Set<number>();
  @observable selectedUserId: number | null = null;
  @observable showDeleted = true;

  @computed
  get beatmaps() {
    const hasDiscussion = new Set<number>();
    for (const discussion of this.beatmapset.discussions) {
      if (discussion?.beatmap_id != null) {
        hasDiscussion.add(discussion.beatmap_id);
      }
    }

    return keyBy(
      this.beatmapset.beatmaps.filter((beatmap) => !isEmpty(beatmap) && (beatmap.deleted_at == null || hasDiscussion.has(beatmap.id))),
      'id',
    );
  }

  @computed
  get currentBeatmap() {
    return this.beatmaps[this.currentBeatmapId];
  }

  @computed
  get discussions() {
    // skipped discussions
    // - not privileged (deleted discussion)
    // - deleted beatmap
    return keyBy(this.beatmapset.discussions.filter((discussion) => !isEmpty(discussion)), 'id') as Partial<Record<number, BeatmapsetWithDiscussionsJson['discussions'][number]>>;
  }

  @computed
  get discussionStarters() {
    const userIds = new Set(Object.values(this.nonNullDiscussions)
      .filter((discussion) => discussion.message_type !== 'hype')
      .map((discussion) => discussion.user_id));

    // TODO: sort user.username.toLocaleLowerCase()
    return [...userIds.values()].map((userId) => this.users[userId]).sort();
  }

  get groupedBeatmaps() {
    return group(Object.values(this.beatmaps));
  }

  @computed
  get lastUpdate() {
    const maxLastUpdate = Math.max(
      +this.beatmapset.last_updated,
      +(maxBy(this.beatmapset.discussions, 'updated_at')?.updated_at ?? 0),
      +(maxBy(this.beatmapset.events, 'created_at')?.created_at ?? 0),
    );

    return maxLastUpdate != null ? moment(maxLastUpdate).unix() : null;
  }

  @computed
  get users() {
    const value = keyBy(this.beatmapset.related_users, 'id');
    // eslint-disable-next-line id-blacklist
    value.null = value.undefined = deletedUser.toJson();

    return value;
  }

  @computed
  get nonNullDiscussions() {
    console.log('nonNullDiscussions');
    return Object.values(this.discussions).filter((discussion) => discussion != null) as BeatmapsetDiscussionJson[];
  }

  @computed
  get presentDiscussions() {
    return this.nonNullDiscussions.filter((discussion) => discussion.deleted_at == null);
  }

  @computed
  get totalHype() {
    return this.presentDiscussions
      .reduce((sum, discussion) => discussion.message_type === 'hype'
        ? sum++
        : sum,
      0);
  }

  @computed
  get unresolvedIssues() {
    return this.presentDiscussions
      .reduce((sum, discussion) => {
        if (discussion.can_be_resolved && !discussion.resolved) {
          if (discussion.beatmap_id == null) return sum++;

          const beatmap = this.beatmaps[discussion.beatmap_id];
          if (beatmap != null && beatmap.deleted_at == null) return sum++;
        }

        return sum;
      }, 0);
  }

  @computed
  get unresolvedDiscussions() {
    return this.presentDiscussions.filter((discussion) => discussion.can_be_resolved && !discussion.resolved);
  }

  constructor(public beatmapset: BeatmapsetWithDiscussionsJson, state?: string) {
    // eslint-disable-next-line @typescript-eslint/no-unsafe-assignment
    const existingState = state == null ? null : JSON.parse(state, (key, value) => {
      if (Array.isArray(value)) {
        if (key === 'discussionCollapsed') {
          return new Map(value);
        }

        if (key === 'readPostIds') {
          return new Set(value);
        }
      }

      // eslint-disable-next-line @typescript-eslint/no-unsafe-return
      return value;
    });

    if (existingState != null) {
      Object.apply(state, existingState);
      this.jumpToDiscussion = true;
    } else {
      for (const discussion of this.beatmapset.discussions) {
        if (discussion.posts != null) {
          for (const post of discussion.posts) {
            this.readPostIds.add(post.id);
          }
        }
      }
    }

    this.currentBeatmapId = (findDefault({ group: this.groupedBeatmaps }) ?? this.beatmaps[0]).id;

    // Current url takes priority over saved state.
    const query = parseUrl(null, beatmapset.discussions);
    if (query != null) {
      // TODO: maybe die instead?
      this.currentMode = query.mode;
      this.currentFilter = query.filter;
      if (query.beatmapId != null) {
        this.currentBeatmapId = query.beatmapId;
      }
      this.selectedUserId = query.user ?? null;
    }

    makeObservable(this);
  }

  discussionsByBeatmap(beatmapId: number) {
    return computed(() => this.presentDiscussions.filter((discussion) => (discussion.beatmap_id == null || discussion.beatmap_id === beatmapId)));
  }

  discussionsByFilter(filter: Filter, mode: DiscussionMode, beatmapId: number) {
    return computed(() => filterDiscussionsByFilter(this.discussionsByMode(mode, beatmapId), filter)).get();
  }

  discussionsByMode(mode: DiscussionMode, beatmapId: number) {
    return computed(() => filterDiscusionsByMode(this.nonNullDiscussions, mode, beatmapId)).get();
  }

  toJsonString() {
    return JSON.stringify(toJS(this), (_key, value) => {
      if (value instanceof Set || value instanceof Map) {
        // eslint-disable-next-line @typescript-eslint/no-unsafe-return
        return Array.from(value);
      }

      // eslint-disable-next-line @typescript-eslint/no-unsafe-return
      return value;
    });
  }
}
