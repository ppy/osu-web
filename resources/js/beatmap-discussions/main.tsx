// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import NewReview from 'beatmap-discussions/new-review';
import { ReviewEditorConfigContext } from 'beatmap-discussions/review-editor-config-context';
import BackToTop from 'components/back-to-top';
import BeatmapsetWithDiscussionsJson from 'interfaces/beatmapset-with-discussions-json';
import { route } from 'laroute';
import { action, makeObservable, observable, reaction, toJS } from 'mobx';
import { observer } from 'mobx-react';
import core from 'osu-core-singleton';
import * as React from 'react';
import BeatmapsetDiscussionsShowStore from 'stores/beatmapset-discussions-show-store';
import { parseUrl } from 'utils/beatmapset-discussion-helper';
import { parseJson, storeJson } from 'utils/json';
import { nextVal } from 'utils/seq';
import { currentUrl } from 'utils/turbolinks';
import { Discussions } from './discussions';
import DiscussionsState from './discussions-state';
import { Events } from './events';
import { Header } from './header';
import { ModeSwitcher } from './mode-switcher';
import { NewDiscussion } from './new-discussion';

const checkNewTimeoutDefault = 30000;
const checkNewTimeoutMax = 60000;
const beatmapsetJsonId = 'json-beatmapset';

interface Props {
  reviewsConfig: {
    max_blocks: number;
  };
}

interface UpdateResponseJson {
  beatmapset: BeatmapsetWithDiscussionsJson;
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
  @observable private readonly store;
  private timeoutCheckNew?: number;
  private xhrCheckNew?: JQuery.jqXHR<UpdateResponseJson>;

  constructor(props: Props) {
    super(props);

    // TODO: avoid reparsing/loading everything on browser navigation for better performance.
    const beatmapset = parseJson<BeatmapsetWithDiscussionsJson>(beatmapsetJsonId);

    this.store = new BeatmapsetDiscussionsShowStore(beatmapset);
    this.discussionsState = new DiscussionsState(this.store);

    makeObservable(this);
  }

  componentDidMount() {
    $(document).on(`ajax:success.${this.eventId}`, '.js-beatmapset-discussion-update', this.ujsDiscussionUpdate);
    $(document).on(`click.${this.eventId}`, '.js-beatmap-discussion--jump', this.jumpToClick);
    document.addEventListener('turbolinks:before-cache', this.destroy);

    this.disposers.add(core.reactTurbolinks.runAfterPageLoad(action(() => {
      this.jumpToDiscussionByHash();

      // normalize url after first render because the default discussion filter depends on ranked state.
      Turbolinks.controller.replaceHistory(this.discussionsState.url);

      // Watch for reactions after the initial render and url normalization;
      // we don't want state changes to trigger advanceHistory on first render.
      this.disposers.add(
        reaction(() => this.discussionsState.url, (current, prev) => {
          if (current !== prev) {
            Turbolinks.controller.advanceHistory(current);
          }
        }),
      );
    })));

    this.timeoutCheckNew = window.setTimeout(this.checkNew, checkNewTimeoutDefault);
  }

  componentWillUnmount() {
    $.unsubscribe(`.${this.eventId}`);
    $(document).off(`.${this.eventId}`);
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
          <ReviewEditorConfigContext.Provider value={this.props.reviewsConfig}>
            {this.discussionsState.currentPage === 'reviews' ? (
              <NewReview
                discussionsState={this.discussionsState}
                innerRef={this.newDiscussionRef}
                onFocus={this.handleNewDiscussionFocus}
                stickTo={this.modeSwitcherRef}
                store={this.store}
              />
            ) : (
              <NewDiscussion
                autoFocus={this.focusNewDiscussion}
                discussionsState={this.discussionsState}
                innerRef={this.newDiscussionRef}
                onFocus={this.handleNewDiscussionFocus}
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
      this.xhrCheckNew = undefined;
    });
  };

  private readonly destroy = () => {
    document.removeEventListener('turbolinks:before-cache', this.destroy);

    document.documentElement.style.removeProperty('--scroll-padding-top-extra');
    window.clearTimeout(this.timeoutCheckNew);
    this.xhrCheckNew?.abort();

    storeJson(beatmapsetJsonId, toJS(this.store.beatmapset));
    this.discussionsState.saveState();

    this.disposers.forEach((disposer) => disposer?.());
  };

  private readonly handleNewDiscussionFocus = () => {
    // Bug with position: sticky and scroll-padding: https://bugs.chromium.org/p/chromium/issues/detail?id=1466472
    document.documentElement.style.removeProperty('--scroll-padding-top-extra');
  };

  @action
  private jumpTo(id: number, postId?: number) {
    this.discussionsState.changeToDiscussion(id, postId);

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

  private readonly ujsDiscussionUpdate = (_event: unknown, beatmapset: BeatmapsetWithDiscussionsJson) => {
    // to allow ajax:complete to be run
    window.setTimeout(() => this.discussionsState.update({ beatmapset }), 0);
  };
}
