// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import LazyLoadContext, { Props as ContextProps, Snapshot } from 'components/lazy-load-context';
import UserProfileContainer from 'components/user-profile-container';
import { ProfileExtraPage } from 'interfaces/user-extended-json';
import { pull, last, first, throttle, debounce } from 'lodash';
import { action, computed, makeObservable, observable } from 'mobx';
import { observer } from 'mobx-react';
import core from 'osu-core-singleton';
import * as React from 'react';
import { error } from 'utils/ajax';
import { classWithModifiers } from 'utils/css';
import { bottomPage } from 'utils/html';
import { hideLoadingOverlay, showLoadingOverlay } from 'utils/loading-overlay';
import { pageChange } from 'utils/page-change';
import { nextVal } from 'utils/seq';
import { present } from 'utils/string';
import { switchNever } from 'utils/switch-never';
import { currentUrl } from 'utils/turbolinks';
import AccountStanding from './account-standing';
import Beatmapsets from './beatmapsets';
import Controller, { Page, validPage } from './controller';
import Detail from './detail';
import ExtraTab from './extra-tab';
import Header from './header';
import Historical from './historical';
import Kudosu from './kudosu';
import Medals from './medals';
import RecentActivity from './recent-activity';
import TopScores from './top-scores';
import UserPage from './user-page';

interface Props {
  container: HTMLElement;
}

interface ScrollTo {
  baseScrollY?: number;
  scrollBy: number;
  scrollToOptions?: ScrollToOptions;
}

@observer
export default class Main extends React.Component<Props> {
  @observable private readonly contextValue: ContextProps;
  private readonly controller: Controller;
  // debounce can't be too low otherwise it'll trigger on Firefox smooth scroll when it deccelerates at the end
  private readonly debouncedHandleScrollingStop = debounce(() => this.handleScrollingStop(), 100);
  private readonly disposers = new Set<(() => void) | undefined>();
  private draggingTab = false;
  private readonly eventId = `users-show-${nextVal()}`;
  private lastScroll = 0;
  private pageJumpingTo: Page | null = null;
  private readonly pageRefs: Record<Page, React.RefObject<HTMLDivElement>> = {
    account_standing: React.createRef(),
    beatmaps: React.createRef(),
    historical: React.createRef(),
    kudosu: React.createRef(),
    main: React.createRef(),
    me: React.createRef(),
    medals: React.createRef(),
    recent_activity: React.createRef(),
    top_ranks: React.createRef(),
  };
  private readonly pages = React.createRef<HTMLDivElement>();
  private readonly pagesOffsetRef = React.createRef<HTMLDivElement>();
  private scrollTo: ScrollTo = { scrollBy: 0 };
  private readonly tabs = React.createRef<HTMLDivElement>();
  private readonly timeouts: Partial<Record<'draggingTab' | 'initialPageJump' | 'scroll', number>> = {};


  @computed
  private get displayExtraTabs() {
    return this.displayedExtraPages.length > 1;
  }

  @computed
  private get displayedExtraPages() {
    const profileOrder: ProfileExtraPage[] = this.controller.state.user.is_bot
      ? ['me']
      : this.controller.state.user.profile_order.slice();

    if (this.controller.state.user.account_history.length > 0) {
      profileOrder.push('account_standing');
    }

    if (!present(this.controller.state.user.page.raw) && !this.controller.withEdit) {
      pull(profileOrder, 'me');
    }

    return profileOrder;
  }

  private get pagesOffset() {
    return this.pagesOffsetRef.current;
  }

  private get stickyHeaderOffset() {
    return core.stickyHeader.headerHeight + (this.pagesOffset?.getBoundingClientRect().height ?? 0);
  }

  constructor(props: Props) {
    super(props);

    this.controller = new Controller(this.props.container);

    makeObservable(this);

    this.contextValue = {
      done: this.handleLazyLoadDone,
      getSnapshot: this.handleLazyLoadGetSnapshot,
      scrolling: false,
    };
  }

  componentDidMount() {
    const scrollEventId = `scroll.${this.eventId}`;
    $(window).on(scrollEventId, this.handleScrolling);
    $(window).on(scrollEventId, this.debouncedHandleScrollingStop);
    // pageScan does not need to run at 144 fps...
    $(window).on(scrollEventId, throttle(() => this.pageScan(), 20));

    if (this.pages.current != null) {
      $(this.pages.current).sortable({
        cursor: 'move',
        handle: '.js-profile-page-extra--sortable-handle',
        items: '.js-sortable--page',
        revert: 150,
        scrollSpeed: 10,
        update: this.updateOrder,
      });
    }

    if (this.tabs.current != null) {
      $(this.tabs.current).sortable({
        axis: 'x',
        cursor: 'move',
        disabled: !this.controller.withEdit,
        items: '.js-sortable--tab',
        revert: 150,
        scrollSpeed: 0,
        start: () => {
          // Somehow click event still goes through when dragging.
          // This prevents triggering onTabClick.
          window.clearTimeout(this.timeouts.draggingTab);
          this.draggingTab = true;
        },
        stop: () => {
          this.timeouts.draggingTab = window.setTimeout(() => this.draggingTab = false, 500);
        },
        update: this.updateOrder,
      });
    }

    pageChange();

    // preserve scroll if existing saved state but force position to reset
    // on refresh to avoid browser setting scroll position at the bottom on reload.
    // ...except Chrome sets it anyway sometimes.
    // FIXME: firefox seems to restore scroll position slightly further down that it should?
    const page = this.controller.hasSavedState
      ? null
      : validPage(currentUrl().hash.slice(1)) ?? 'main';

    this.pageJumpingTo = page;

    this.disposers.add(core.reactTurbolinks.runAfterPageLoad(() => {
      if (page != null) {
        window.setTimeout(() => {
          this.pageScrollIntoView(page);
        }, 0);
      }
    }));
  }

  componentWillUnmount() {
    this.debouncedHandleScrollingStop.cancel();
    $(window).off(`.${this.eventId}`);

    [this.pages, this.tabs].forEach((sortable) => {
      if (sortable.current != null) {
        $(sortable.current).sortable('destroy');
      }
    });

    Object.values(this.timeouts).forEach((timeout) => window.clearTimeout(timeout));

    this.controller.destroy();
    this.disposers.forEach((disposer) => disposer?.());
  }

  render() {
    return (
      <UserProfileContainer user={this.controller.state.user}>
        <Header controller={this.controller} />

        <div className='osu-page osu-page--generic-compact'>
          <div
            ref={this.pageRefs.main}
            data-page-id='main'
          >
            <Detail controller={this.controller} />
          </div>

          <div ref={this.pagesOffsetRef} className='page-extra-tabs'>
            {this.displayExtraTabs &&
              <div ref={this.tabs} className='page-mode page-mode--profile-page-extra'>
                {this.displayedExtraPages.map((m) => (
                  <a
                    key={m}
                    className={`page-mode__item ${this.isSortablePage(m) ? 'js-sortable--tab' : ''}`}
                    data-page-id={m}
                    href={`#${m}`}
                    onClick={this.onTabClick}
                  >
                    <ExtraTab controller={this.controller} page={m} />
                  </a>
                ))}
              </div>
            }
          </div>

          {/* value needs to be the same instance of an observable on each render */}
          <LazyLoadContext.Provider value={this.contextValue}>
            <div ref={this.pages} className={classWithModifiers('user-profile-pages', { 'no-tabs': !this.displayExtraTabs })}>
              {this.displayedExtraPages.map((name) => (
                <div
                  key={name}
                  ref={this.pageRefs[name]}
                  className={this.isSortablePage(name) ? 'js-sortable--page' : ''}
                  data-page-id={name}
                >
                  {this.extraPage(name)}
                </div>

              ))}
            </div>
          </LazyLoadContext.Provider>
        </div>
      </UserProfileContainer>
    );
  }

  private readonly extraPage = (name: ProfileExtraPage) => {
    const baseProps = {
      containerRef: this.pageRefs[name],
      controller: this.controller,
      name,
    };

    switch (name) {
      case 'me':
        return <UserPage {...baseProps} />;

      case 'recent_activity':
        return <RecentActivity {...baseProps} />;

      case 'kudosu':
        return <Kudosu {...baseProps} />;

      // TODO: rename to top_scores (also in model's UserProfileCustomization and translations)
      case 'top_ranks':
        return <TopScores {...baseProps} />;

      case 'beatmaps':
        return <Beatmapsets {...baseProps} />;

      case 'medals':
        return <Medals {...baseProps} />;

      case 'historical':
        return <Historical {...baseProps} />;

      case 'account_standing':
        return <AccountStanding {...baseProps} />;

      default:
        switchNever(name);
        throw new Error('unsupported extra page');
    }
  };

  @action
  private readonly handleLazyLoadDone = (key: ProfileExtraPage, snapshot: Snapshot) => {
    const element = this.pageRefs[key].current;
    if (element == null) {
      return;
    }

    const diff = element.getBoundingClientRect().height - snapshot.bounds.height;

    if (this.scrollTo.baseScrollY == null) {
      this.scrollTo.baseScrollY = snapshot.scrollY;
    } else {
      // take the smaller value to ignore premature shifts
      this.scrollTo.baseScrollY = Math.min(snapshot.scrollY, this.scrollTo.baseScrollY);
    }

    const marginTop = this.stickyHeaderOffset;
    if (snapshot.bounds.bottom < marginTop
      // new size goes off the top of visible area, happens at the bottom of page.
      || (snapshot.bounds.top < marginTop && snapshot.bounds.bottom > marginTop)) {
      this.scrollTo.scrollBy += diff;
    }

    // this is used to peg the page to the bottom when new sections load and a page near the bottom is supposed to be in focus
    // otherwise the browser may shift the page up. The indexOf is to restrict it to pages that come after lazy loaded ones, otherwise
    // non-lazy loaded sections at the end don't get pegged to the bottom.
    if (this.pageJumpingTo != null
      && this.pageJumpingTo !== 'main'
      && this.displayedExtraPages.indexOf(this.pageJumpingTo) > this.displayedExtraPages.indexOf(key)) {
      this.pageScrollIntoView(this.pageJumpingTo);
    }

    // This is to make sure the scroll goes to the end of the run loop even if there's no new updates for the current item.
    this.queueScroll();
  };

  private readonly handleLazyLoadGetSnapshot = (name: ProfileExtraPage) => {
    const element = this.pageRefs[name].current;
    if (element == null) return;

    return {
      bounds: element.getBoundingClientRect(),
      scrollY: window.scrollY,
    };
  };

  @action
  private readonly handleScrolling = () => {
    this.contextValue.scrolling = true;
    // unset if we're clrealy scrolling away from the bottom.
    // layout shifts from lazy sections can cause the page to grow taller or scroll downwards, but not up.
    if (window.scrollY < this.lastScroll) {
      this.pageJumpingTo = null;
    }
    this.lastScroll = window.scrollY;
  };

  @action
  private readonly handleScrollingStop = () => this.contextValue.scrolling = false;

  private isSortablePage(page: ProfileExtraPage) {
    return this.controller.state.user.profile_order.includes(page);
  }

  private readonly onTabClick = (e: React.MouseEvent<HTMLAnchorElement>) => {
    // See $(this.tabs.current).sortable.
    if (this.draggingTab) return;

    e.preventDefault();
    this.pageJump(validPage(e.currentTarget.dataset.pageId));
  };

  @action
  private readonly pageJump = (page: Page | null) => {
    if (page === null || this.pagesOffset == null) return;

    this.pageJumpingTo = page;

    this.pageScrollIntoView(page, true);
  };

  @action
  private readonly pageScan = () => {
    if (this.pagesOffset == null) return;

    const matching = new Set<Page>();

    for (const key of this.displayedExtraPages) {
      const page = this.pageRefs[key].current;
      if (page == null) continue;

      const pageId = page.dataset.pageId as Page;
      const pageDims = page.getBoundingClientRect();

      const pageBottom = pageDims.bottom - Math.min(pageDims.height * 0.75, 200);
      const match = pageId === 'main'
        ? pageBottom > 0
        : pageBottom > this.stickyHeaderOffset && pageDims.top < window.innerHeight;

      if (match) {
        matching.add(pageId);
      }
    }

    let preferred: Page | undefined;
    const pageIds = [...matching.values()];
    // special case for bottom of page if there are multiple pages visible.
    if (bottomPage()) {
      preferred = last(pageIds);
    } else {
      // prefer using the page being navigated to if its element is in view.
      preferred = this.pageJumpingTo != null && matching.has(this.pageJumpingTo) ? this.pageJumpingTo : first(pageIds);
    }

    if (preferred != null) {
      this.controller.currentPage = preferred;
    }
  };

  @action
  private readonly pageScrollIntoView = (page: Page, smooth = false) => {
    const target = page === 'main' ? document.body : this.pageRefs[page].current;
    if (target == null) return;

    const pageId = target.dataset.pageId as Page;
    // fine for the current scroll containers.
    let maxScrollY = document.body.scrollHeight - window.innerHeight;
    if (pageId !== last(this.displayedExtraPages)) {
      maxScrollY -= 1;
    }

    const scrollTo = Math.floor(Math.min(maxScrollY, window.scrollY + target.getBoundingClientRect().top - this.stickyHeaderOffset));
    // smooth scroll when using navigation bar.
    if (smooth) {
      this.scrollTo.scrollToOptions = { behavior: 'smooth', top: scrollTo };
    } else {
      this.scrollTo.scrollToOptions = { top: scrollTo };
    }

    this.queueScroll();
  };

  private queueScroll() {
    // keep delaying scroll to the end of event loop.
    window.clearTimeout(this.timeouts.scroll);

    this.timeouts.scroll = window.setTimeout(() => {
      // it would be nice to set scrolling = true here
      // but there'd be the issue where it doesn't get unset if it doesn't actually scroll.
      if (this.scrollTo.scrollToOptions != null) {
        window.scrollTo(this.scrollTo.scrollToOptions);
      } else {
        window.scrollTo({ top: (this.scrollTo.baseScrollY ?? 0) + this.scrollTo.scrollBy });
      }

      this.scrollTo = { scrollBy: 0 };
    });
  }

  private readonly updateOrder = (event: Event) => {
    const target = event.target;

    if (target == null) return;

    const $target = $(target);

    const newOrder = $target.sortable('toArray', { attribute: 'data-page-id' }) as ProfileExtraPage[];
    const origOrder = this.controller.state.user.profile_order;

    showLoadingOverlay();

    $target.sortable('cancel');

    this.controller.apiSetExtraPageOrder(newOrder)
      .fail(action((xhr: JQuery.jqXHR, status: string) => {
        error(xhr, status);

        this.controller.state.user.profile_order = origOrder;
      }))
      .always(() => {
        hideLoadingOverlay();
        this.pageScan();
      });
  };
}
