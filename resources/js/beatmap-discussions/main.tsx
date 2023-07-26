// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import NewReview from 'beatmap-discussions/new-review';
import { ReviewEditorConfigContext } from 'beatmap-discussions/review-editor-config-context';
import BackToTop from 'components/back-to-top';
import BeatmapsetWithDiscussionsJson from 'interfaces/beatmapset-with-discussions-json';
import { route } from 'laroute';
import { action, makeObservable, observable } from 'mobx';
import { observer } from 'mobx-react';
import BeatmapsetDiscussionsStore from 'models/beatmapset-discussions-store';
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

export interface InitialData {
  beatmapset: BeatmapsetWithDiscussionsJson;
  reviews_config: {
    max_blocks: number;
  };
}

interface Props {
  container: HTMLElement;
  initial: InitialData;
}

function parseJson<T>(json?: string) {
  if (json == null) return;
  return JSON.parse(json) as T;
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
  @observable private store;
  private readonly timeouts: Record<string, number> = {};
  private xhrCheckNew?: JQuery.jqXHR<InitialData>;

  constructor(props: Props) {
    super(props);

    if (this.props.container.dataset.beatmapset != null) {
      JSON.parse(this.props.container.dataset.beatmapset);
    }

    // using DiscussionsState['beatmapset'] as type cast to force errors if it doesn't match with props since the beatmapset is from discussionsState.
    const existingBeatmapset = parseJson<DiscussionsState['beatmapset']>(props.container.dataset.beatmapset);
    this.store = new BeatmapsetDiscussionsStore(existingBeatmapset ?? this.props.initial.beatmapset);
    this.discussionsState = new DiscussionsState(props.initial.beatmapset, this.store, props.container.dataset.discussionsState);

    makeObservable(this);
  }

  componentDidMount() {
    $.subscribe(`beatmapsetDiscussions:update.${this.eventId}`, this.update);
    $.subscribe(`beatmapDiscussionPost:toggleShowDeleted.${this.eventId}`, this.toggleShowDeleted);

    $(document).on(`ajax:success.${this.eventId}`, '.js-beatmapset-discussion-update', this.ujsDiscussionUpdate);
    $(document).on(`click.${this.eventId}`, '.js-beatmap-discussion--jump', this.jumpToClick);
    $(document).on(`turbolinks:before-cache.${this.eventId}`, this.saveStateToContainer);

    if (this.discussionsState.jumpToDiscussion) {
      this.disposers.add(core.reactTurbolinks.runAfterPageLoad(this.jumpToDiscussionByHash));
    }

    this.timeouts.checkNew = window.setTimeout(this.checkNew, checkNewTimeoutDefault);
  }

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
          discussionsState={this.discussionsState}
          store={this.store}
        />
        <ModeSwitcher
          discussionsState={this.discussionsState}
          innerRef={this.modeSwitcherRef}
        />
        {this.discussionsState.currentMode === 'events' ? (
          <Events
            discussions={this.store.discussions}
            events={this.discussionsState.beatmapset.events}
            users={this.store.users}
          />
        ) : (
          <ReviewEditorConfigContext.Provider value={this.reviewsConfig}>
            {this.discussionsState.currentMode === 'reviews' ? (
              <NewReview
                discussionsState={this.discussionsState}
                innerRef={this.newDiscussionRef}
                stickTo={this.modeSwitcherRef}
                store={this.store}
              />
            ) : (
              <NewDiscussion
                autoFocus={this.focusNewDiscussion}
                discussionsState={this.discussionsState}
                innerRef={this.newDiscussionRef}
                stickTo={this.modeSwitcherRef}

              />
            )}
            <Discussions
              discussionsState={this.discussionsState}
              store={this.store}
            />
          </ReviewEditorConfigContext.Provider>
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
    const discussion = this.store.discussions.get(id);

    if (discussion == null) return;

    const {
      mode,
    } = stateFromDiscussion(discussion);

    // unset filter
    const currentDiscussionsByMode = this.discussionsState.discussionsByMode[mode];
    if (currentDiscussionsByMode.find((d) => d.id === discussion.id) == null) {
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
    const parsedUrl = parseUrl(url, this.discussionsState.discussionsArray);

    if (parsedUrl == null) return;

    const { discussionId, postId } = parsedUrl;

    if (discussionId == null) return;

    e.preventDefault();
    this.jumpTo(null, { id: discussionId, postId });
  };

  private readonly jumpToDiscussionByHash = () => {
    const target = parseUrl(null,  this.discussionsState.discussionsArray);

    if (target?.discussionId != null) {
      this.jumpTo(null, { id: target.discussionId, postId: target.postId });
    }
  };

  private readonly saveStateToContainer = () => {
    this.props.container.dataset.beatmapset = JSON.stringify(this.discussionsState.beatmapset);
    this.props.container.dataset.discussionsState = this.discussionsState.toJsonString();
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
