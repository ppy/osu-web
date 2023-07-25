// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapsetDiscussionJson from 'interfaces/beatmapset-discussion-json';
import BeatmapsetWithDiscussionsJson from 'interfaces/beatmapset-with-discussions-json';
import GameMode from 'interfaces/game-mode';
import { maxBy } from 'lodash';
import { action, computed, makeObservable, observable, toJS } from 'mobx';
import BeatmapsetDiscussions from 'models/beatmapset-discussions';
import moment from 'moment';
import core from 'osu-core-singleton';
import { findDefault, group, sortWithMode } from 'utils/beatmap-helper';
import { makeUrl, parseUrl } from 'utils/beatmapset-discussion-helper';
import { switchNever } from 'utils/switch-never';
import { Filter, filters } from './current-discussions';
import DiscussionMode, { DiscussionPage, isDiscussionPage } from './discussion-mode';

export interface UpdateOptions {
  beatmapset: BeatmapsetWithDiscussionsJson;
  watching: boolean;
}

function parseState(state: string) {
  // eslint-disable-next-line @typescript-eslint/no-unsafe-return
  return JSON.parse(state, (key, value) => {
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
}

// FIXME this doesn't make it so the modes with optional beatmapId can pass a beatmapId that gets ignored.
function filterDiscusionsByMode(discussions: BeatmapsetDiscussionJson[], mode: 'general' | 'timeline', beatmapId: number): BeatmapsetDiscussionJson[];
function filterDiscusionsByMode(discussions: BeatmapsetDiscussionJson[], mode: 'generalAll' | 'reviews'): BeatmapsetDiscussionJson[];
function filterDiscusionsByMode(discussions: BeatmapsetDiscussionJson[], mode: DiscussionMode, beatmapId?: number) {
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
  get currentBeatmap() {
    const beatmap = this.store.beatmaps.get(this.currentBeatmapId);
    if (beatmap == null) {
      throw new Error('missing beatmap');
    }

    return beatmap;
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
    const discussions = this.currentDiscussionsGroupedByFilter[this.currentFilter];

    return {
      general: filterDiscusionsByMode(discussions, 'general', this.currentBeatmapId),
      generalAll: filterDiscusionsByMode(discussions, 'generalAll'),
      reviews: filterDiscusionsByMode(discussions, 'reviews'),
      timeline: filterDiscusionsByMode(discussions, 'timeline', this.currentBeatmapId),
    };
  }

  @computed
  get currentDiscussionsGroupedByFilter() {
    const groups: Record<Filter, BeatmapsetDiscussionJson[]> = {
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
    const userIds = new Set(this.nonNullDiscussions
      .filter((discussion) => discussion.message_type !== 'hype')
      .map((discussion) => discussion.user_id));

    // TODO: sort user.username.toLocaleLowerCase()
    return [...userIds].map((userId) => this.store.users.get(userId)).sort();
  }

  @computed
  get firstBeatmap() {
    return [...this.store.beatmaps.values()][0];
  }

  @computed
  get groupedBeatmaps() {
    return group([...this.store.beatmaps.values()]);
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

  @computed
  get selectedUser() {
    return this.store.users.get(this.selectedUserId);
  }

  @computed
  get sortedBeatmaps() {
    // TODO
    // filter to only include beatmaps from the current discussion's beatmapset (for the modding profile page)
    // const beatmaps = filter(this.props.beatmaps, this.isCurrentBeatmap);
    return sortWithMode([...this.store.beatmaps.values()]);
  }

  @computed
  get nonNullDiscussions() {
    // TODO: they're already non-null
    return [...this.store.discussions.values()].filter((discussion) => discussion != null);
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

          const beatmap = this.store.beatmaps.get(discussion.beatmap_id);
          if (beatmap != null && beatmap.deleted_at == null) return sum++;
        }

        return sum;
      }, 0);
  }

  @computed
  get unresolvedDiscussions() {
    return this.presentDiscussions.filter((discussion) => discussion.can_be_resolved && !discussion.resolved);
  }

  constructor(public beatmapset: BeatmapsetWithDiscussionsJson, private store: BeatmapsetDiscussions, state?: string) {
    // eslint-disable-next-line @typescript-eslint/no-unsafe-assignment
    const existingState = state == null ? null : parseState(state);

    if (existingState != null) {
      Object.apply(this, existingState);
      this.jumpToDiscussion = true;
    } else {
      for (const discussion of beatmapset.discussions) {
        if (discussion.posts != null) {
          for (const post of discussion.posts) {
            this.readPostIds.add(post.id);
          }
        }
      }
    }

    this.currentBeatmapId = (findDefault({ group: this.groupedBeatmaps }) ?? this.firstBeatmap).id;

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
    return this.presentDiscussions.filter((discussion) => (discussion.beatmap_id == null || discussion.beatmap_id === beatmapId));
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
    return JSON.stringify(toJS(this), (key, value) => {
      // don't serialize constructor dependencies, they'll be handled separately.
      if (key === 'beatmapset' || key === 'store') {
        return undefined;
      }

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

  private filterDiscussionsByFilter(discussions: BeatmapsetDiscussionJson[], filter: Filter) {
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
        const reviewsWithPending = new Set<BeatmapsetDiscussionJson>();

        const filteredDiscussions = discussions.filter((discussion) => {
          if (!discussion.can_be_resolved || discussion.resolved) return false;

          if (discussion.parent_id != null) {
            const parentDiscussion = this.store.discussions.get(discussion.parent_id);
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
