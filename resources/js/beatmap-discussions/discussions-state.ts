// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapsetDiscussionJson from 'interfaces/beatmapset-discussion-json';
import BeatmapsetWithDiscussionsJson from 'interfaces/beatmapset-with-discussions-json';
import GameMode from 'interfaces/game-mode';
import { maxBy, sum } from 'lodash';
import { action, computed, makeObservable, observable, reaction } from 'mobx';
import moment from 'moment';
import core from 'osu-core-singleton';
import BeatmapsetDiscussionsShowStore from 'stores/beatmapset-discussions-show-store';
import { findDefault, group, sortWithMode } from 'utils/beatmap-helper';
import { canModeratePosts, makeUrl, parseUrl } from 'utils/beatmapset-discussion-helper';
import { parseJsonNullable, storeJson } from 'utils/json';
import { Filter, filters } from './current-discussions';
import DiscussionMode, { discussionModes } from './discussion-mode';
import DiscussionPage, { isDiscussionPage } from './discussion-page';

const jsonId = 'json-discussions-state';

export interface UpdateOptions {
  beatmap_discussion_post_ids: number[];
  beatmapset: BeatmapsetWithDiscussionsJson;
  watching: boolean;
}

function reviver(key: string, value: unknown) {
  if (Array.isArray(value)) {
    if (key === 'discussionCollapsed') {
      return new Map(value);
    }

    if (key === 'readPostIds') {
      return new Set(value);
    }
  }

  return value;
}

function isFilter(value: unknown): value is Filter {
  return (filters as readonly unknown[]).includes(value);
}

export default class DiscussionsState {
  @observable currentBeatmapId: number;
  @observable currentFilter: Filter = 'total'; // TODO: filter should always be total when page is events (also no highlight)
  @observable currentPage: DiscussionPage = 'general';
  @observable discussionCollapsed = new Map<number, boolean>();
  @observable discussionDefaultCollapsed = false;
  @observable highlightedDiscussionId: number | null = null;
  @observable jumpToDiscussion = false;
  @observable pinnedNewDiscussion = false;

  @observable readPostIds = new Set<number>();
  @observable selectedNominatedRulesets: GameMode[] = [];
  @observable selectedUserId: number | null = null;
  @observable showDeleted = true; // this toggle only affects All and deleted discussion filters, other filters don't show deleted

  private previousFilter: Filter = 'total';
  private previousPage: DiscussionPage = 'general';
  private readonly urlStateDisposer;

  get beatmapset() {
    return this.store.beatmapset;
  }

  @computed
  get currentBeatmap() {
    const beatmap = this.store.beatmaps.get(this.currentBeatmapId);
    if (beatmap == null) {
      throw new Error('missing beatmap');
    }

    return beatmap;
  }

  /**
   * Discussions for the current beatmap grouped by filters
   */
  @computed
  get discussionsByFilter() {
    const groups: Record<Filter, BeatmapsetDiscussionJson[]> = {
      deleted: [],
      hype: [],
      mapperNotes: [],
      mine: [],
      pending: [],
      praises: [],
      resolved: [],
      total: this.discussionForSelectedBeatmap,
    };

    const currentUser = core.currentUser;
    const reviewsWithPending = new Set<BeatmapsetDiscussionJson>();

    for (const discussion of this.discussionForSelectedBeatmap) {
      if (discussion.deleted_at != null) {
        groups.deleted.push(discussion);
        continue;
      }

      if (currentUser != null && discussion.user_id === currentUser.id) {
        groups.mine.push(discussion);
      }

      if (discussion.message_type === 'hype') {
        groups.hype.push(discussion);
        groups.praises.push(discussion);
      } else if (discussion.message_type === 'mapper_note') {
        groups.mapperNotes.push(discussion);
      } else if (discussion.message_type === 'praise') {
        groups.praises.push(discussion);
      }

      if (discussion.can_be_resolved) {
        if (discussion.resolved) {
          groups.resolved.push(discussion);
        } else {
          groups.pending.push(discussion);
          // only reviews with unresolved discussions get added.
          if (discussion.parent_id != null) {
            const parentDiscussion = this.store.discussions.get(discussion.parent_id);
            if (parentDiscussion != null && parentDiscussion.message_type === 'review') {
              reviewsWithPending.add(parentDiscussion);
            }
          }
        }
      }
    }

    groups.pending.push(...reviewsWithPending);

    return groups;
  }

  /**
   * Discussions for the currently selected beatmap and filter grouped by mode.
   */
  @computed
  get discussionsByMode() {
    const discussions = this.discussionsByFilter[this.currentFilter];

    const value: Record<DiscussionMode, BeatmapsetDiscussionJson[]> = {
      general: [],
      generalAll: [],
      reviews: [],
      timeline: [],
    };

    for (const discussion of discussions) {
      if (discussion.message_type === 'review') {
        value.reviews.push(discussion);
      } else if (discussion.beatmap_id == null) {
        value.generalAll.push(discussion);
      } else if (discussion.beatmap_id === this.currentBeatmapId) {
        if (discussion.timestamp != null) {
          value.timeline.push(discussion);
        } else {
          value.general.push(discussion);
        }
      }
    }

    return value;
  }

  @computed
  get discussionForSelectedBeatmap() {
    const discussions = canModeratePosts()
      ? this.discussionsArray
      : this.nonDeletedDiscussions;

    return discussions.filter((discussion) => (discussion.beatmap_id == null || discussion.beatmap_id === this.currentBeatmapId));
  }

  @computed
  get discussionsArray() {
    return [...this.store.discussions.values()];
  }

  @computed
  get discussionsForSelectedUserByMode() {
    if (this.selectedUser == null) {
      return this.discussionsByMode;
    }

    const value: Record<DiscussionMode, BeatmapsetDiscussionJson[]> = {
      general: [],
      generalAll: [],
      reviews: [],
      timeline: [],
    };

    for (const mode of discussionModes) {
      value[mode] = this.discussionsByMode[mode].filter((discussion) => discussion.user_id === this.selectedUserId);
    }

    return value;
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
    const currentUser = core.currentUser;
    return currentUser != null
      && this.discussionsByFilter.hype.some((discussion) => (
        discussion.beatmap_id == null && discussion.user_id === currentUser.id
      ));
  }

  @computed
  get lastUpdate() {
    const maxDiscussions = maxBy(this.beatmapset.discussions, 'updated_at')?.updated_at;
    const maxEvents = maxBy(this.beatmapset.events, 'created_at')?.created_at;

    const maxLastUpdate = Math.max(
      Date.parse(this.beatmapset.last_updated),
      maxDiscussions != null ? Date.parse(maxDiscussions) : 0,
      maxEvents != null ? Date.parse(maxEvents) : 0,
    );

    return moment(maxLastUpdate).unix();
  }

  get calculatedMainRuleset() {
    return this.beatmapset.main_ruleset
      // The main ruleset not being set yet implies there are either no nominations
      // or an equal number of nominations for each ruleset, so the next selection should make it the main ruleset.
      ?? (this.selectedNominatedRulesets.length === 1 ? this.selectedNominatedRulesets[0] : null);
  }

  @computed
  get nonDeletedDiscussions() {
    return this.discussionsArray.filter((discussion) => discussion.deleted_at == null);
  }

  @computed
  get selectedUser() {
    return this.store.users.get(this.selectedUserId);
  }

  @computed
  get sortedBeatmaps() {
    return sortWithMode([...this.store.beatmaps.values()]);
  }

  @computed
  get totalHypeCount() {
    return this.nonDeletedDiscussions
      .reduce((total, discussion) => +(discussion.message_type === 'hype') + total, 0);
  }

  @computed
  get unresolvedDiscussionTotalCount() {
    return this.nonDeletedDiscussions
      .reduce((total, discussion) => {
        if (discussion.can_be_resolved && !discussion.resolved) {
          if (discussion.beatmap_id == null) return total + 1;

          const beatmap = this.store.beatmaps.get(discussion.beatmap_id);
          if (beatmap != null && beatmap.deleted_at == null) return total + 1;
        }

        return total;
      }, 0);
  }

  @computed
  get unresolvedDiscussionCounts() {
    const byBeatmap: Partial<Record<number, number>> = {};
    const byMode: Record<GameMode, number> = {
      fruits: 0,
      mania: 0,
      osu: 0,
      taiko: 0,
    };

    for (const discussion of this.nonDeletedDiscussions) {
      if (discussion.beatmap_id != null && discussion.can_be_resolved && !discussion.resolved) {
        byBeatmap[discussion.beatmap_id] = (byBeatmap[discussion.beatmap_id] ?? 0) + 1;

        const mode = this.store.beatmaps.get(discussion.beatmap_id)?.mode;
        if (mode != null) {
          byMode[mode]++;
        }
      }
    }

    return {
      byBeatmap,
      byMode,
    };
  }

  @computed
  get url() {
    return makeUrl({
      beatmap: this.currentBeatmap,
      filter: this.currentFilter,
      mode: this.currentPage,
      user: this.selectedUserId ?? undefined,
    });
  }

  constructor(private readonly store: BeatmapsetDiscussionsShowStore) {
    const existingState = parseJsonNullable(jsonId, false, reviver);

    if (existingState != null) {
      Object.assign(this, existingState);
    } else {
      this.jumpToDiscussion = true;
      for (const discussion of store.beatmapset.discussions) {
        if (discussion.posts != null) {
          for (const post of discussion.posts) {
            this.readPostIds.add(post.id);
          }
        }
      }
    }

    this.currentBeatmapId = (findDefault({ group: this.groupedBeatmaps }) ?? this.firstBeatmap).id;

    // Current url takes priority over saved state.
    const query = parseUrl(null, store.beatmapset.discussions);
    if (query != null) {
      // TODO: maybe die instead?
      this.currentPage = query.mode;
      this.currentFilter = query.filter;
      if (query.beatmapId != null) {
        this.currentBeatmapId = query.beatmapId;
      }
      this.selectedUserId = query.user ?? null;
    }

    makeObservable(this);

    this.urlStateDisposer = reaction(() => this.url, (current, prev) => {
      if (current !== prev) {
        Turbolinks.controller.advanceHistory(this.url);
      }
    });
  }

  @action
  changeDiscussionPage(page?: string) {
    if (!isDiscussionPage(page)) return;

    if (page === 'events') {
      // record page and filter when switching to events
      this.previousPage = this.currentPage;
      this.previousFilter = this.currentFilter;
    } else if (this.currentPage === 'events' && this.currentFilter !== this.previousFilter) {
      // restore previous filter when switching away from events
      this.currentFilter = this.previousFilter;
    }

    this.currentPage = page;
  }

  @action
  changeFilter(filter: unknown) {
    if (!isFilter(filter)) return;

    // restore previous page when selecting a filter.
    if (this.currentPage === 'events') {
      this.currentPage = this.previousPage;
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

  destroy() {
    this.urlStateDisposer();
  }

  @action
  markAsRead(ids: number | number[]) {
    if (Array.isArray(ids)) {
      ids.forEach((id) => this.readPostIds.add(id));
    } else {
      this.readPostIds.add(ids);
    }
  }

  nominationsCount(type: 'current' | 'required') {
    const nominations = this.beatmapset.nominations;
    if (nominations.legacy_mode) {
      return nominations[type];
    }

    if (type === 'current' || this.calculatedMainRuleset == null) {
      return sum(Object.values(nominations[type]));
    }

    let total = 0;

    Object.keys(nominations[type]).forEach((ruleset) =>
      ruleset === this.calculatedMainRuleset
        ? total += nominations.required_meta.main_ruleset
        : total += nominations.required_meta.non_main_ruleset,
    );

    return total;
  }

  saveState() {
    storeJson(jsonId, this.toJson());
  }

  toJson() {
    // Convert serialized properties into primitives supported by JSON.stringify.
    // Values that need conversion should have the appropriate reviver to restore
    // the original type when deserializing.
    return {
      currentBeatmapId: this.currentBeatmapId,
      currentFilter: this.currentFilter,
      currentPage: this.currentPage,
      discussionCollapsed: [...this.discussionCollapsed],
      discussionDefaultCollapsed: this.discussionDefaultCollapsed,
      highlightedDiscussionId: this.highlightedDiscussionId,
      jumpToDiscussion: this.jumpToDiscussion,
      pinnedNewDiscussion: this.pinnedNewDiscussion,
      readPostIds: [...this.readPostIds],
      selectedUserId: this.selectedUserId,
      showDeleted: this.showDeleted,
    };
  }

  @action
  update(options: Partial<UpdateOptions>) {
    if (options.beatmap_discussion_post_ids != null) {
      this.markAsRead(options.beatmap_discussion_post_ids);
    }

    if (options.beatmapset != null) {
      this.store.beatmapset = options.beatmapset;
    }

    if (options.watching != null) {
      this.beatmapset.current_user_attributes.is_watching = options.watching;
    }
  }
}
