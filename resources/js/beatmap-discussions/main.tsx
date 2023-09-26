// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import NewReview from 'beatmap-discussions/new-review';
import { ReviewEditorConfigContext } from 'beatmap-discussions/review-editor-config-context';
import BackToTop from 'components/back-to-top';
import BeatmapsetWithDiscussionsJson from 'interfaces/beatmapset-with-discussions-json';
import { route } from 'laroute';
import { action, makeObservable, observable } from 'mobx';
import { observer } from 'mobx-react';
import core from 'osu-core-singleton';
import * as React from 'react';
import BeatmapsetDiscussionsStore from 'stores/beatmapset-discussions-store';
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
  private readonly focusNewDiscussion = currentUrl().hash === '#new';
  private readonly modeSwitcherRef = React.createRef<HTMLDivElement>();
  private readonly newDiscussionRef = React.createRef<HTMLDivElement>();
  private nextTimeout = checkNewTimeoutDefault;
  private readonly reviewsConfig = this.props.initial.reviews_config;
  @observable private readonly store;
  private timeoutCheckNew?: number;
  private xhrCheckNew?: JQuery.jqXHR<InitialData>;

  constructor(props: Props) {
    super(props);

    // using DiscussionsState['beatmapset'] as type cast to force errors if it doesn't match with props since the beatmapset is from discussionsState.
    const existingBeatmapset = parseJson<DiscussionsState['beatmapset']>(props.container.dataset.beatmapset);
    this.store = new BeatmapsetDiscussionsStore(existingBeatmapset ?? this.props.initial.beatmapset);
    this.discussionsState = new DiscussionsState(this.store, props.container.dataset.discussionsState);

    makeObservable(this);
  }

  componentDidMount() {
    $.subscribe(`beatmapsetDiscussions:update.${this.eventId}`, this.update);

    $(document).on(`ajax:success.${this.eventId}`, '.js-beatmapset-discussion-update', this.ujsDiscussionUpdate);
    $(document).on(`click.${this.eventId}`, '.js-beatmap-discussion--jump', this.jumpToClick);
    $(document).on(`turbolinks:before-cache.${this.eventId}`, this.saveStateToContainer);

    if (this.discussionsState.jumpToDiscussion) {
      this.disposers.add(core.reactTurbolinks.runAfterPageLoad(this.jumpToDiscussionByHash));
    }

    this.timeoutCheckNew = window.setTimeout(this.checkNew, checkNewTimeoutDefault);
  }

  componentWillUnmount() {
    $.unsubscribe(`.${this.eventId}`);
    $(document).off(`.${this.eventId}`);

    document.documentElement.style.removeProperty('--scroll-padding-top-extra');

    window.clearTimeout(this.timeoutCheckNew);
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
        {this.discussionsState.currentPage === 'events' ? (
          <Events
            discussions={this.store.discussions}
            events={this.discussionsState.beatmapset.events}
            users={this.store.users}
          />
        ) : (
          <ReviewEditorConfigContext.Provider value={this.reviewsConfig}>
            {this.discussionsState.currentPage === 'reviews' ? (
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
    if (this.xhrCheckNew != null) return;

    window.clearTimeout(this.timeoutCheckNew);

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

      this.timeoutCheckNew = window.setTimeout(this.checkNew, this.nextTimeout);
    });
  };

  @action
  private jumpTo(id: number, postId?: number) {
    const discussion = this.store.discussions.get(id);

    if (discussion == null) return;

    const {
      beatmapId,
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

    if (beatmapId != null) {
      this.discussionsState.currentBeatmapId = beatmapId;
    }

    this.discussionsState.currentPage = mode;
    this.discussionsState.highlightedDiscussionId = discussion.id;

    window.setTimeout(() => this.jumpToAfterRender(id, postId), 0);
  }

  private jumpToAfterRender(discussionId: number, postId?: number) {
    const attribute = postId != null ? `data-post-id='${postId}'` : `data-id='${discussionId}'`;
    const target = document.querySelector(`.js-beatmap-discussion-jump[${attribute}]`);

    if (target == null || this.modeSwitcherRef.current == null || this.newDiscussionRef.current == null) return;

    let margin = this.modeSwitcherRef.current.getBoundingClientRect().height;
    if (this.discussionsState.pinnedNewDiscussion) {
      margin += this.newDiscussionRef.current.getBoundingClientRect().height;
    }

    // Update scroll-padding instead of adding scroll-margin, otherwise it doesn't anchor in the right place.
    document.documentElement.style.setProperty('--scroll-padding-top-extra', `${Math.floor(margin)}px`);

    // avoid smooth scrolling to avoid triggering lazy loaded images.
    // FIXME: Safari still has the issue where images just out of view get loaded and push the page down
    // because it doesn't anchor the scroll position.
    target.scrollIntoView({ behavior: 'instant', block: 'start', inline: 'nearest' });
  }

  private readonly jumpToClick = (e: JQuery.TriggeredEvent<Document, unknown, HTMLElement, HTMLElement>) => {
    if (!(e.currentTarget instanceof HTMLAnchorElement)) return;

    const url = e.currentTarget.href;
    const parsedUrl = parseUrl(url, this.discussionsState.discussionsArray);

    if (parsedUrl == null) return;

    const { discussionId, postId } = parsedUrl;

    if (discussionId == null) return;

    e.preventDefault();
    this.jumpTo(discussionId, postId);
  };

  private readonly jumpToDiscussionByHash = () => {
    const target = parseUrl(null, this.discussionsState.discussionsArray);

    if (target?.discussionId != null) {
      this.jumpTo(target.discussionId, target.postId);
    }
  };

  private readonly saveStateToContainer = () => {
    this.props.container.dataset.beatmapset = JSON.stringify(this.discussionsState.beatmapset);
    this.props.container.dataset.discussionsState = this.discussionsState.toJsonString();
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
