// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { BeatmapsetDiscussionJsonForShow } from 'interfaces/beatmapset-discussion-json';
import BeatmapsetWithDiscussionsJson from 'interfaces/beatmapset-with-discussions-json';
import GameMode from 'interfaces/game-mode';
import { isEmpty, keyBy, maxBy } from 'lodash';
import { action, computed, makeObservable, observable, toJS } from 'mobx';
import { deletedUser } from 'models/user';
import moment from 'moment';
import core from 'osu-core-singleton';
import { findDefault, group, sortWithMode } from 'utils/beatmap-helper';
import { makeUrl, parseUrl } from 'utils/beatmapset-discussion-helper';
import { switchNever } from 'utils/switch-never';
import { Filter, filters } from './current-discussions';
import DiscussionMode, { DiscussionPage, isDiscussionPage } from './discussion-mode';

type DiscussionsAlias = BeatmapsetWithDiscussionsJson['discussions'];

export interface UpdateOptions {
  beatmapset: BeatmapsetWithDiscussionsJson;
  watching: boolean;
}

// FIXME this doesn't make it so the modes with optional beatmapId can pass a beatmapId that gets ignored.
function filterDiscusionsByMode(discussions: DiscussionsAlias, mode: 'general' | 'timeline', beatmapId: number): DiscussionsAlias;
function filterDiscusionsByMode(discussions: DiscussionsAlias, mode: 'generalAll' | 'reviews'): DiscussionsAlias;
function filterDiscusionsByMode(discussions: DiscussionsAlias, mode: DiscussionMode, beatmapId?: number) {
  switch (mode) {
    case 'general':
      return discussions.filter((discussion) => discussion.beatmap_id === beatmapId);
    case 'generalAll':
      return discussions.filter((discussion) => discussion.beatmap_id == null && discussion.message_type !== 'review');
    case 'reviews':
      return discussions.filter((discussion) => discussion.message_type === 'review');
    case 'timeline':
      return discussions.filter((discussion) => discussion.beatmap_id === beatmapId && discussion.timestamp != null);
    default:
      switchNever(mode);
      throw new Error('missing valid mode');
  }
}

function isFilter(value: unknown): value is Filter {
  return (filters as readonly unknown[]).includes(value);
}

export default class DiscussionsState {
  @observable currentBeatmapId: number;
  @observable currentFilter: Filter = 'total'; // TODO: filter should always be total when page is events (also no highlight)
  @observable currentMode: DiscussionPage = 'general';
  @observable discussionCollapsed = new Map<number, boolean>();
  @observable discussionDefaultCollapsed = false;
  @observable highlightedDiscussionId: number | null = null;
  @observable jumpToDiscussion = false;
  @observable pinnedNewDiscussion = false;

  @observable readPostIds = new Set<number>();
  @observable selectedUserId: number | null = null;
  @observable showDeleted = true;

  private previousFilter: Filter = 'total';
  private previousPage: DiscussionPage = 'general';

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
  get currentBeatmapDiscussions() {
    return this.discussionsByBeatmap(this.currentBeatmapId);
  }

  @computed
  get currentBeatmapDiscussionsCurrentModeWithFilter() {
    if (this.currentMode === 'events') return [];
    return this.currentDiscussions[this.currentMode];
  }

  @computed
  get currentDiscussions() {
    const discussions = this.currentDiscussionsGroupedByFilter[this.currentFilter];)

    return {
      general: filterDiscusionsByMode(discussions, 'general', this.currentBeatmapId),
      generalAll: filterDiscusionsByMode(discussions, 'generalAll'),
      reviews: filterDiscusionsByMode(discussions, 'reviews'),
      timeline: filterDiscusionsByMode(discussions, 'timeline', this.currentBeatmapId),
    };
  }

  @computed
  get currentDiscussionsGroupedByFilter() {
    const groups: Record<Filter, DiscussionsAlias> = {
      deleted: [],
      hype: [],
      mapperNotes: [],
      mine: [],
      pending: [],
      praises: [],
      resolved: [],
      total: [],
    };

    for (const filter of filters) {
      groups[filter] = this.filterDiscussionsByFilter(this.currentBeatmapDiscussions, filter);
    }

    return groups;
  }

  @computed
  get discussions() {
    // skipped discussions
    // - not privileged (deleted discussion)
    // - deleted beatmap

    // TODO need some typing to handle the not for show variant
    // null part of the key so we can use .get(null)
    const map = new Map<number | null | undefined, BeatmapsetDiscussionJsonForShow>();

    for (const discussion of this.beatmapset.discussions) {
      if (!isEmpty(discussion)) {
        map.set(discussion.id, discussion);
      }
    }

    return map;
  }

  @computed
  get discussionsCountByPlaymode() {
    const counts: Record<GameMode, number> = {
      fruits: 0,
      mania: 0,
      osu: 0,
      taiko: 0,
    };

    for (const discussion of this.nonNullDiscussions) {
      const mode = discussion.beatmap?.mode;
      if (mode != null) {
        counts[mode]++;
      }
    }

    return counts;
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
  get hasCurrentUserHyped() {
    const currentUser = core.currentUser; // core.currentUser check below doesn't make the inferrence that it's not nullable after the check.
    const discussions = filterDiscusionsByMode(this.currentDiscussionsGroupedByFilter.hype, 'generalAll');
    return currentUser != null && discussions.some((discussion) => discussion?.user_id === currentUser.id);
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

  get selectedUser() {
    return this.selectedUserId != null ? this.users[this.selectedUserId] : null;
  }

  get sortedBeatmaps() {
    // TODO
    // filter to only include beatmaps from the current discussion's beatmapset (for the modding profile page)
    // const beatmaps = filter(this.props.beatmaps, this.isCurrentBeatmap);
    return sortWithMode(Object.values(this.beatmaps));
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
    return [...this.discussions.values()].filter((discussion) => discussion != null) as DiscussionsAlias;
  }

  @computed
  get presentDiscussions() {
    return this.nonNullDiscussions.filter((discussion) => discussion.deleted_at == null) as DiscussionsAlias;
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

  @action
  changeDiscussionPage(page?: string) {
    if (!isDiscussionPage(page)) return;

    const url = makeUrl({
      beatmap: this.currentBeatmap,
      filter: this.currentFilter,
      mode: page,
      user: this.selectedUserId ?? undefined,
    });

    if (page === 'events') {
      // record page and filter when switching to events
      this.previousPage = this.currentMode;
      this.previousFilter = this.currentFilter;
    } else if (this.currentFilter !== this.previousFilter) {
      // restore previous filter when switching away from events
      this.currentFilter = this.previousFilter;
    }

    this.currentMode = page;
    Turbolinks.controller.advanceHistory(url);
  }

  @action
  changeFilter(filter: unknown) {
    if (!isFilter(filter)) return;

    // restore previous page when selecting a filter.
    if (this.currentMode === 'events') {
      this.currentMode = this.previousPage;
    }

    this.currentFilter = filter;
  }

  @action
  changeGameMode(mode: GameMode) {
    const beatmap = findDefault({ items: this.groupedBeatmaps.get(mode) });
    if (beatmap != null) {
      this.currentBeatmapId = beatmap.id;
    }
  }

  discussionsByBeatmap(beatmapId: number) {
    return this.presentDiscussions.filter((discussion) => (discussion.beatmap_id == null || discussion.beatmap_id === beatmapId)) as DiscussionsAlias;
  }

  @action
  markAsRead(ids: number | number[]) {
    if (Array.isArray(ids)) {
      ids.forEach((id) => this.readPostIds.add(id));
    } else {
      this.readPostIds.add(ids);
    }
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

  @action
  update(options: Partial<UpdateOptions>) {
    const {
      beatmapset,
      watching,
    } = options;

    if (beatmapset != null) {
      this.beatmapset = beatmapset;
    }

    if (watching != null) {
      this.beatmapset.current_user_attributes.is_watching = watching;
    }
  }

  private filterDiscussionsByFilter(discussions: DiscussionsAlias, filter: Filter) {
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
      case 'pending': {
        const reviewsWithPending = new Set<BeatmapsetDiscussionJsonForShow>();

        const filteredDiscussions = discussions.filter((discussion) => {
          if (!discussion.can_be_resolved || discussion.resolved) return false;

          if (discussion.parent_id != null) {
            const parentDiscussion = this.discussions.get(discussion.parent_id);
            if (parentDiscussion != null && parentDiscussion.message_type === 'review') {
              reviewsWithPending.add(parentDiscussion);
            }
          }

          return true;
        });

        return [...filteredDiscussions, ...reviewsWithPending.values()];
      }
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
}
