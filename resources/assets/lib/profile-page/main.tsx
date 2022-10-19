// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import LazyLoadContext from 'components/lazy-load-context';
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

@observer
export default class Main extends React.Component<Props> {
  @observable private readonly contextValue;
  private readonly controller: Controller;
  private readonly disposers = new Set<(() => void) | undefined>();
  private draggingTab = false;
  private readonly eventId = `users-show-${nextVal()}`;
  private readonly extraPages: Record<ProfileExtraPage, React.RefObject<HTMLDivElement>> = {
    account_standing: React.createRef(),
    beatmaps: React.createRef(),
    historical: React.createRef(),
    kudosu: React.createRef(),
    me: React.createRef(),
    medals: React.createRef(),
    recent_activity: React.createRef(),
    top_ranks: React.createRef(),
  };
  @observable private extraTabsBottom = 0;
  private jumpTo: Page | null = null;
  private lastScroll = 0;
  private readonly pages = React.createRef<HTMLDivElement>();
  private readonly tabs = React.createRef<HTMLDivElement>();
  private readonly timeouts: Partial<Record<'draggingTab' | 'initialPageJump', number>> = {};

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

    if (!osu.present(this.controller.state.user.page.raw) && !this.controller.withEdit) {
      pull(profileOrder, 'me');
    }

    return profileOrder;
  }

  private get pageElements() {
    return document.querySelectorAll<HTMLElement>('.js-switchable-mode-page--scrollspy');
  }

  private get pagesOffset() {
    return document.querySelector<HTMLElement>('.js-switchable-mode-page--scrollspy-offset');
  }

  constructor(props: Props) {
    super(props);

    this.controller = new Controller(this.props.container);

    makeObservable(this);

    this.contextValue = {
      getOptions: this.handleLazyLoadGetOptions,
      getRef: this.handleLazyLoadGetRef,
      offsetTop: this.extraTabsBottom,
      scrolling: false,
    };
  }

  componentDidMount() {
    core.reactTurbolinks.runAfterPageLoad(action(() => {
      if (this.pagesOffset != null) {
        const bounds = this.pagesOffset.getBoundingClientRect();
        this.extraTabsBottom = 50 + bounds.height; // TODO: can't use bottom because the position moves
        this.contextValue.offsetTop = this.extraTabsBottom;
        this.pages.current?.style.setProperty('--scroll-margin-top', `${bounds.height}px`);
      }
    }));

    const scrollEventId = `scroll.${this.eventId}`;
    $(window).on(scrollEventId, this.setLastScroll);
    // debounce can't be too low otherwise it'll trigger on Firefox smooth scroll when it deellerates at the end
    $(window).on(scrollEventId, debounce(action(() => this.contextValue.scrolling = false), 100));
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

    // force position to reset on refresh to avoid browser setting scroll position at the bottom on reload.
    // ...except Chrome sets it anyway sometimes.
    const page = (this.controller.hasSavedState
      ? null
      : validPage(currentUrl().hash.slice(1))
    ) ?? 'main';
    this.jumpTo = page;

    this.disposers.add(core.reactTurbolinks.runAfterPageLoad(() => {
      this.pageScrollIntoView(page);
    }));
  }

  componentWillUnmount() {
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
            className='js-switchable-mode-page--scrollspy js-switchable-mode-page--page'
            data-page-id='main'
          >
            <Detail controller={this.controller} />
          </div>

          <div className='hidden-xs page-extra-tabs js-switchable-mode-page--scrollspy-offset'>
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

          <LazyLoadContext.Provider value={this.contextValue}>
            <div ref={this.pages} className={classWithModifiers('user-profile-pages', { 'no-tabs': !this.displayExtraTabs })}>
              {this.displayedExtraPages.map((name) => (
                <div
                  key={name}
                  ref={this.extraPages[name]}
                  className={`user-profile-pages__page js-switchable-mode-page--scrollspy js-switchable-mode-page--page ${this.isSortablePage(name) ? 'js-sortable--page' : ''}`}
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
      containerRef: this.extraPages[name],
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
  private readonly handleLazyLoadGetOptions = (name: ProfileExtraPage) => {
    const unbottom = last(this.displayedExtraPages) !== name;
    const focus = this.jumpTo === name;

    if (focus) {
      this.jumpTo = null;
    }

    return { focus, unbottom };
  };

  // passing extraPages with the context just causes all the refs' .current to be null
  private readonly handleLazyLoadGetRef = (name: ProfileExtraPage) => this.extraPages[name];

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

    this.jumpTo = page;

    this.pageScrollIntoView(page, true);
  };

  @action
  private readonly pageScan = () => {
    if (this.pagesOffset == null) return;

    const pages = this.pageElements;
    if (pages.length === 0) return;

    const matching = new Set<Page>();

    for (const page of pages) {
      const pageId = page.dataset.pageId as Page;
      const pageDims = page.getBoundingClientRect();

      const pageBottom = pageDims.bottom - Math.min(pageDims.height * 0.75, 200);
      const match = pageId === 'main'
        ? pageBottom > 0
        : pageBottom > this.extraTabsBottom && pageDims.top < window.innerHeight;

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
      preferred = this.jumpTo != null && matching.has(this.jumpTo) ? this.jumpTo : first(pageIds);
    }

    if (preferred != null) {
      this.controller.currentPage = preferred;
    }
  };

  @action
  private readonly pageScrollIntoView = (page: Page, smooth = false) => {
    const target = page === 'main' ? document.body : this.extraPages[page].current;
    if (target == null) return;

    const pageId = target.dataset.pageId as Page;
    let maxScrollY = document.body.scrollHeight - window.innerHeight;
    if (pageId !== last(this.displayedExtraPages)) {
      maxScrollY -= 1;
    }

    const scrollTo = Math.floor(Math.min(maxScrollY, window.scrollY + target.getBoundingClientRect().top - this.extraTabsBottom));
    // smooth scroll when using navigation bar.
    this.jumpTo = page;
    if (smooth) {
      window.scrollTo({ behavior: 'smooth', top: scrollTo });
    } else {
      window.scrollTo({ top: scrollTo });
    }
  };

  @action
  private readonly setLastScroll = () => {
    this.contextValue.scrolling = true;
    // unset if we're clrealy scrolling away from the bottom.
    // layout shifts from lazy sections can cause the page to grow taller or scroll downwards, but not up.
    if (window.scrollY < this.lastScroll) {
      this.jumpTo = null;
    }
    this.lastScroll = window.scrollY;
  };

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
