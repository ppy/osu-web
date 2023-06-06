// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { DiscussionsContext } from 'beatmap-discussions/discussions-context';
import { BeatmapsContext } from 'beatmap-discussions/beatmaps-context';
import NewReview from 'beatmap-discussions/new-review';
import { ReviewEditorConfigContext } from 'beatmap-discussions/review-editor-config-context';
import BackToTop from 'components/back-to-top';
import { route } from 'laroute';
import { deletedUser } from 'models/user';
import core from 'osu-core-singleton';
import * as React from 'react';
import * as BeatmapHelper from 'utils/beatmap-helper';
import { defaultFilter, defaultMode, makeUrl, parseUrl, stateFromDiscussion } from 'utils/beatmapset-discussion-helper';
import { nextVal } from 'utils/seq';
import { currentUrl } from 'utils/turbolinks';
import { Discussions } from './discussions';
import { Events } from './events';
import { Header } from './header';
import { ModeSwitcher } from './mode-switcher';
import { NewDiscussion } from './new-discussion';
import { action, computed, makeObservable, observable } from 'mobx';
import { observer } from 'mobx-react';
import BeatmapsetWithDiscussionsJson from 'interfaces/beatmapset-with-discussions-json';
import DiscussionMode, { DiscussionPage, discussionPages } from './discussion-mode';
import { Filter } from './current-discussions';
import { isEmpty, keyBy, maxBy } from 'lodash';
import moment from 'moment';
import { findDefault } from 'utils/beatmap-helper';
import { group } from 'utils/beatmap-helper';
import GameMode from 'interfaces/game-mode';
import { switchNever } from 'utils/switch-never';
import DiscussionsState from './discussions-state';

const checkNewTimeoutDefault = 10000;
const checkNewTimeoutMax = 60000;

interface InitialData {
  beatmapset: BeatmapsetWithDiscussionsJson;
  reviews_config: {
    max_blocks: number;
  };
}

interface Props {
  container: HTMLElement;
  initial: InitialData;
}

interface State {
  beatmapset: BeatmapsetWithDiscussionsJson;
  currentMode: DiscussionPage;
  currentFilter: Filter | null;
  currentBeatmapId: number | null;
  focusNewDiscussion: boolean;
  pinnedNewDiscussion: boolean;
  readPostIds: Set<number>;
  readPostIdsArray: number[];
  selectedUserId: number | null;
  showDeleted: boolean;
}

interface UpdateOptions {
  callback: () => void;
  mode: DiscussionPage;
  modeIf: DiscussionPage;
  beatmapId: number;
  playmode: GameMode;
  beatmapset: BeatmapsetWithDiscussionsJson;
  watching: boolean;
  filter: Filter;
  selectedUserId: number;
}

@observer
export default class Main extends React.Component<Props, State> {
  private readonly discussionsState: DiscussionsState;
  private readonly disposers = new Set<((() => void) | undefined)>();
  private readonly eventId = `beatmap-discussions-${nextVal()}`;
  // FIXME: update url handler to recognize this instead
  private focusNewDiscussion = currentUrl().hash === '#new';
  private readonly modeSwitcherRef = React.createRef<HTMLDivElement>();
  private readonly newDiscussionRef = React.createRef<HTMLDivElement>();
  private nextTimeout = checkNewTimeoutDefault;
  private reviewsConfig = this.props.initial.reviews_config;
  private readonly timeouts: Record<string, number> = {};
  private xhrCheckNew?: JQuery.jqXHR<InitialData>;

  constructor(props: Props) {
    super(props);

    const existingState = JSON.parse(props.container.dataset.beatmapsetDiscussionState ?? null) as (BeatmapsetWithDiscussionsJson | null); // TODO: probably wrong


    this.discussionsState = new DiscussionsState(props.initial.beatmapset);

    this.discussionsState = JSON.parse(props.container.dataset.beatmapsetDiscussionState ?? null) as (BeatmapsetWithDiscussionsJson | null); // TODO: probably wrong
    if (this.discussionsState != null) {
      this.discussionsState.readPostIds = new Set(this.discussionsState.readPostIdsArray);
      this.pinnedNewDiscussion = this.discussionsState.pinnedNewDiscussion;
    } else {
      this.jumpToDiscussion = true;
      for (const discussion of props.initial.beatmapset.discussions) {
        if (discussion.posts != null) {
          for (const post of discussion.posts) {
            this.discussionsState.readPostIds.add(post.id);
          }
        }
      }
    }

    makeObservable(this);
  }

  componentDidMount() {
    $.subscribe(`playmode:set.${this.eventId}`, this.setCurrentPlaymode);

    $.subscribe(`beatmapsetDiscussions:update.${this.eventId}`, this.update);
    $.subscribe(`beatmapDiscussion:jump.${this.eventId}`, this.jumpTo);
    $.subscribe(`beatmapDiscussionPost:markRead.${this.eventId}`, this.markPostRead);
    $.subscribe(`beatmapDiscussionPost:toggleShowDeleted.${this.eventId}`, this.toggleShowDeleted);

    $(document).on(`ajax:success.${this.eventId}`, '.js-beatmapset-discussion-update', this.ujsDiscussionUpdate);
    $(document).on(`click.${this.eventId}`, '.js-beatmap-discussion--jump', this.jumpToClick);
    $(document).on(`turbolinks:before-cache.${this.eventId}`, this.saveStateToContainer);

    if (this.jumpToDiscussion) {
      this.disposers.add(core.reactTurbolinks.runAfterPageLoad(this.jumpToDiscussionByHash));
    }

    this.timeouts.checkNew = window.setTimeout(this.checkNew, checkNewTimeoutDefault);
  }


  componentDidUpdate(_prevProps, prevState) {
    // TODO: autorun
    // if (prevState.currentBeatmapId == this.discussionsState.currentBeatmapId
    //   && prevState.currentFilter == this.discussionsState.currentFilter
    //   && prevState.currentMode == this.discussionsState.currentMode
    //   && prevState.selectedUserId == this.discussionsState.selectedUserId
    //   && prevState.showDeleted == this.discussionsState.showDeleted) {
    //   return;
    // }

    // Turbolinks.controller.advanceHistory(this.urlFromState());
  }

  // private get urlFromState() {
  //   return makeUrl({
  //     beatmap: this.currentBeatmap ?? undefined,
  //     filter: this.currentFilter ?? undefined,
  //     mode: this.currentMode,
  //     user: this.selectedUserId ?? undefined,
  //   });
  // }

  componentWillUnmount() {
    $.unsubscribe(`.${this.eventId}`);
    $(document).off(`.${this.eventId}`);

    Object.values(this.timeouts).forEach(window.clearTimeout);

    this.xhrCheckNew?.abort();
    this.disposers.forEach((disposer) => disposer?.());
  }

  render() {
    return (
      <>
        <Header
          beatmaps={this.discussionsState.groupedBeatmaps}
          beatmapset={this.discussionsState.beatmapset}
          currentBeatmap={this.discussionsState.currentBeatmap}
          currentDiscussions={this.discussionsState.currentDiscussions}
          currentFilter={this.discussionsState.currentFilter}
          currentUser={core.currentUser} // TODO: remove after component converted
          discussionStarters={this.discussionsState.discussionStarters}
          discussions={this.discussionsState.discussions}
          events={this.discussionsState.beatmapset.events}
          mode={this.discussionsState.currentMode}
          selectedUserId={this.discussionsState.selectedUserId}
          users={this.discussionsState.users}
        />
        <ModeSwitcher
          beatmapset={this.discussionsState.beatmapset}
          currentBeatmap={this.discussionsState.currentBeatmap}
          currentDiscussions={this.discussionsState.currentDiscussions}
          currentFilter={this.discussionsState.currentFilter}
          innerRef={this.modeSwitcherRef}
          mode={this.discussionsState.currentMode}
        />
        {this.discussionsState.currentMode === 'events' ? (
          <Events
            discussions={this.discussionsState.discussions}
            events={this.discussionsState.beatmapset.events}
            users={this.discussionsState.users}
          />
        ) : (
          <DiscussionsContext.Provider value={this.discussionsState.discussions}>
            <BeatmapsContext.Provider value={this.discussionsState.beatmaps}>
              <ReviewEditorConfigContext.Provider value={this.reviewsConfig}>
                {this.discussionsState.currentMode === 'reviews' ? (
                  <NewReview
                    beatmaps={this.discussionsState.beatmaps}
                    beatmapset={this.discussionsState.beatmapset}
                    currentBeatmap={this.discussionsState.currentBeatmap}
                    innerRef={this.newDiscussionRef}
                    pinned={this.discussionsState.pinnedNewDiscussion}
                    setPinned={this.setPinnedNewDiscussion}
                    stickTo={this.modeSwitcherRef}
                  />
                ) : (
                  <NewDiscussion
                    autoFocus={this.focusNewDiscussion}
                    beatmapset={this.discussionsState.beatmapset}
                    currentBeatmap={this.discussionsState.currentBeatmap}
                    currentDiscussions={this.discussionsState.currentDiscussions}
                    innerRef={this.newDiscussionRef}
                    mode={this.discussionsState.currentMode}
                    pinned={this.discussionsState.pinnedNewDiscussion}
                    setPinned={this.setPinnedNewDiscussion}
                    stickTo={this.modeSwitcherRef}

                  />
                )}
                <Discussions
                  beatmapset={this.discussionsState.beatmapset}
                  currentBeatmap={this.discussionsState.currentBeatmap}
                  currentDiscussions={this.discussionsState.currentDiscussions}
                  currentFilter={this.discussionsState.currentFilter}
                  mode={this.discussionsState.currentMode}
                  readPostIds={this.discussionsState.readPostIds}
                  showDeleted={this.discussionsState.showDeleted}
                  users={this.discussionsState.users}
                />
              </ReviewEditorConfigContext.Provider>
            </BeatmapsContext.Provider>
          </DiscussionsContext.Provider>
        )}
        <BackToTop />
      </>
    );
  }

  private readonly checkNew = () => {
    window.clearTimeout(this.timeouts.checkNew);
    this.xhrCheckNew?.abort();

    this.xhrCheckNew = $.get(route('beatmapsets.discussion', { beatmapset: this.discussionsState.beatmapset.id }), {
      format: 'json',
      last_updated: this.discussionsState.lastUpdate,
    });

    this.xhrCheckNew.done((data, _textStatus, xhr) => {
      if (xhr.status === 304) {
        this.nextTimeout *= 2;
        return;
      }

      this.nextTimeout = checkNewTimeoutDefault;
      this.update(null, { beatmapset: data.beatmapset });
    }).always(() => {
      this.nextTimeout = Math.min(this.nextTimeout, checkNewTimeoutMax);

      this.timeouts.checkNew = window.setTimeout(this.checkNew, this.nextTimeout);
    });
  };

  private readonly jumpTo = (_e: unknown, { id, postId }: { id: number; postId?: number }) => {
    const discussion = this.discussionsState.discussions[id];

    if (discussion == null) return;

    const newState = stateFromDiscussion(discussion);

    newState.filter = this.currentDiscussions().byFilter[this.discussionsState.currentFilter][newState.mode][id] != null
      ? this.discussionsState.currentFilter
      : defaultFilter

    if (this.discussionsState.selectedUserId != null && this.discussionsState.selectedUserId !== discussion.user_id) {
      newState.selectedUserId = null; // unsets userid
    }

    newState.callback = () => {
      $.publish('beatmapset-discussions:highlight', { discussionId: discussion.id });

      const attribute = postId != null ? `data-post-id='${postId}'` : `data-id='${id}'`;
      const target = $(`.js-beatmap-discussion-jump[${attribute}]`);

      if (target.length === 0) return;

      let offsetTop = target.offset().top - this.modeSwitcherRef.current.getBoundingClientRect().height;
      if (this.discussionsState.pinnedNewDiscussion) {
        offsetTop -= this.newDiscussionRef.current.getBoundingClientRect().height
      }

      $(window).stop().scrollTo(core.stickyHeader.scrollOffset(offsetTop), 500);
    }

    this.update(null, newState);
  };

  private readonly jumpToClick = (e: React.SyntheticEvent<HTMLLinkElement>) => {
    const url = e.currentTarget.getAttribute('href');
    const parsedUrl = parseUrl(url, this.discussionsState.beatmapset.discussions);

    if (parsedUrl == null) return;

    const { discussionId, postId } = parsedUrl;

    if (discussionId == null) return;

    e.preventDefault();
    this.jumpTo(null, { id: discussionId, postId });
  };

  private readonly jumpToDiscussionByHash = () => {
    const target = parseUrl(null, this.discussionsState.beatmapset.discussions);

    if (target.discussionId != null) {
      this.jumpTo(null, { id: target.discussionId, postId: target.postId });
    }
  };

  @action
  private readonly markPostRead = (_event: unknown, { id }: { id: number | number[] }) => {
    if (Array.isArray(id)) {
      id.forEach((i) => this.discussionsState.readPostIds.add(i));
    } else {
      this.discussionsState.readPostIds.add(id);
    }

    // setState
  };

  private readonly saveStateToContainer = () => {
    // This is only so it can be stored with JSON.stringify.
    this.discussionsState.readPostIdsArray = Array.from(this.discussionsState.readPostIds);
    this.props.container.dataset.beatmapsetDiscussionState = JSON.stringify(this.discussionsState);
  };

  private readonly setCurrentPlaymode = (e, { mode }) => {
    this.update(e, { playmode: mode });
  };

  @action
  private readonly setPinnedNewDiscussion = (pinned: boolean) => {
    this.discussionsState.pinnedNewDiscussion = pinned;
  };

  @action
  private readonly toggleShowDeleted = () => {
    this.discussionsState.showDeleted = !this.discussionsState.showDeleted;
  };

  private readonly ujsDiscussionUpdate = (_e: unknown, beatmapset: BeatmapsetWithDiscussionsJson) => {
    // to allow ajax:complete to be run
    window.setTimeout(() => this.update(null, { beatmapset }, 0));
  };

  @action
  private readonly update = (_e: unknown, options: Partial<UpdateOptions>) => {
    const {
      beatmapId,
      beatmapset,
      callback,
      filter,
      mode,
      modeIf,
      playmode,
      selectedUserId,
      watching,
    } = options;

    const newState: Partial<State> = {};

    if (beatmapset != null) {
      newState.beatmapset = beatmapset;
    }

    if (watching != null) {
      newState.beatmapset ??= Object.assign({}, this.discussionsState.beatmapset);
      newState.beatmapset.current_user_attributes.is_watching = watching;
    }

    if (playmode != null) {
      const beatmap = BeatmapHelper.findDefault({ items: this.discussionsState.groupedBeatmaps.get(playmode) });
      beatmapId = beatmap?.id;
    }

    if (beatmapId != null && beatmapId !== this.discussionsState.currentBeatmap.id) {
      newState.currentBeatmapId = beatmapId;
    }

    if (filter != null) {
      if (this.discussionsState.currentMode === 'events') {
        newState.currentMode = this.lastMode ?? defaultMode(newState.currentBeatmapId);
      }

      if (filter !== this.discussionsState.currentFilter) {
        newState.currentFilter = filter;
      }
    }

    if (mode != null && mode !== this.discussionsState.currentMode) {
      if (modeIf == null || modeIf === this.discussionsState.currentMode) {
        newState.currentMode = mode;
      }

      // switching to events:
      // - record last filter, to be restored when setMode is called
      // - record last mode, to be restored when setFilter is called
      // - set filter to total
      if (mode === 'events') {
        this.lastMode = this.discussionsState.currentMode;
        this.lastFilter = this.discussionsState.currentFilter;
        newState.currentFilter = 'total';
      } else if (this.discussionsState.currentMode === 'events') {
        // switching from events:
        // - restore whatever last filter set or default to total
        newState.currentFilter = this.lastFilter ?? 'total'
      }
    }

    // need to setState if null
    if (selectedUserId !== undefined) {
      newState.selectedUserId = selectedUserId
    }

    this.setState(newState, callback);
  };
}
