// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { BeatmapsContext } from 'beatmap-discussions/beatmaps-context';
import { DiscussionsContext } from 'beatmap-discussions/discussions-context';
import NewReview from 'beatmap-discussions/new-review';
import { ReviewEditorConfigContext } from 'beatmap-discussions/review-editor-config-context';
import BackToTop from 'components/back-to-top';
import BeatmapsetWithDiscussionsJson from 'interfaces/beatmapset-with-discussions-json';
import GameMode from 'interfaces/game-mode';
import { route } from 'laroute';
import { action, makeObservable, observable } from 'mobx';
import { observer } from 'mobx-react';
import core from 'osu-core-singleton';
import * as React from 'react';
import { defaultFilter, parseUrl, stateFromDiscussion } from 'utils/beatmapset-discussion-helper';
import { nextVal } from 'utils/seq';
import { currentUrl } from 'utils/turbolinks';
import { Discussions } from './discussions';
import DiscussionsState, { UpdateOptions } from './discussions-state';
import { Events } from './events';
import { Header } from './header';
import { ModeSwitcher } from './mode-switcher';
import { NewDiscussion } from './new-discussion';

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

@observer
export default class Main extends React.Component<Props> {
  @observable private readonly discussionsState: DiscussionsState;
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

    this.discussionsState = new DiscussionsState(props.initial.beatmapset, props.container.dataset.beatmapsetDiscussionState);

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

    if (this.discussionsState.jumpToDiscussion) {
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

  @action
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
      this.discussionsState.update({ beatmapset: data.beatmapset });
    }).always(() => {
      this.nextTimeout = Math.min(this.nextTimeout, checkNewTimeoutMax);

      this.timeouts.checkNew = window.setTimeout(this.checkNew, this.nextTimeout);
    });
  };

  @action
  private readonly jumpTo = (_event: unknown, { id, postId }: { id: number; postId?: number }) => {
    const discussion = this.discussionsState.discussions[id];

    if (discussion == null) return;

    const {
      mode,
    } = stateFromDiscussion(discussion);

    // unset filter
    if (this.discussionsState.discussionsByFilter(this.discussionsState.currentFilter, mode, this.discussionsState.currentBeatmapId).find((d) => d.id === discussion.id) == null) {
      this.discussionsState.currentFilter = defaultFilter;
    }

    // unset user filter if new discussion would have been filtered out.
    if (this.discussionsState.selectedUserId != null && this.discussionsState.selectedUserId !== discussion.user_id) {
      this.discussionsState.selectedUserId = null;
    }

    this.discussionsState.highlightedDiscussionId = discussion.id;

    const attribute = postId != null ? `data-post-id='${postId}'` : `data-id='${id}'`;
    const target = $(`.js-beatmap-discussion-jump[${attribute}]`);

    if (target.length === 0) return;
    const offset = target.offset();

    if (offset == null || this.modeSwitcherRef.current == null || this.newDiscussionRef.current == null) return;

    let offsetTop = offset.top - this.modeSwitcherRef.current.getBoundingClientRect().height;
    if (this.discussionsState.pinnedNewDiscussion) {
      offsetTop -= this.newDiscussionRef.current.getBoundingClientRect().height;
    }

    $(window).stop().scrollTo(core.stickyHeader.scrollOffset(offsetTop), 500);
  };

  private readonly jumpToClick = (e: JQuery.TriggeredEvent<Document, unknown, HTMLElement, HTMLElement>) => {
    if (!(e.currentTarget instanceof HTMLLinkElement)) return;

    const url = e.currentTarget.href;
    const parsedUrl = parseUrl(url, this.discussionsState.beatmapset.discussions);

    if (parsedUrl == null) return;

    const { discussionId, postId } = parsedUrl;

    if (discussionId == null) return;

    e.preventDefault();
    this.jumpTo(null, { id: discussionId, postId });
  };

  private readonly jumpToDiscussionByHash = () => {
    const target = parseUrl(null, this.discussionsState.beatmapset.discussions);

    if (target?.discussionId != null) {
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
    this.props.container.dataset.beatmapsetDiscussionState = this.discussionsState.toJsonString();
  };

  private readonly setCurrentPlaymode = (_event: unknown, { mode }: { mode: GameMode }) => {
    this.discussionsState.update({ playmode: mode });
  };

  @action
  private readonly setPinnedNewDiscussion = (pinned: boolean) => {
    this.discussionsState.pinnedNewDiscussion = pinned;
  };

  @action
  private readonly toggleShowDeleted = () => {
    this.discussionsState.showDeleted = !this.discussionsState.showDeleted;
  };

  private readonly ujsDiscussionUpdate = (_event: unknown, beatmapset: BeatmapsetWithDiscussionsJson) => {
    // to allow ajax:complete to be run
    window.setTimeout(() => this.discussionsState.update({ beatmapset }), 0);
  };

  @action
  private readonly update = (_event: unknown, options: Partial<UpdateOptions>) => {
    this.discussionsState.update(options);
  };
}
