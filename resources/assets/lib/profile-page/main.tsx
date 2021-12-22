// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { ProfileExtraPage } from 'interfaces/user-extended-json';
import { pull, last } from 'lodash';
import { action, computed, makeObservable } from 'mobx';
import { observer } from 'mobx-react';
import core from 'osu-core-singleton';
import * as React from 'react';
import UserProfileContainer from 'user-profile-container';
import { error } from 'utils/ajax';
import { bottomPage, htmlElementOrNull } from 'utils/html';
import { hideLoadingOverlay, showLoadingOverlay } from 'utils/loading-overlay';
import { pageChange } from 'utils/page-change';
import { nextVal } from 'utils/seq';
import { switchNever } from 'utils/switch-never';
import { currentUrl } from 'utils/turbolinks';
import AccountStanding from './account-standing';
import Beatmapsets from './beatmapsets';
import Controller, { Page, validPage } from './controller';
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
  private readonly controller: Controller;
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
  private readonly pages = React.createRef<HTMLDivElement>();
  private scrolling = false;
  private readonly tabs = React.createRef<HTMLDivElement>();
  private readonly timeouts: Partial<Record<'draggingTab' | 'modeScroll' | 'initialPageJump', number>> = {};

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
    return document.querySelectorAll('.js-switchable-mode-page--scrollspy');
  }

  private get pagesOffset() {
    const elem = document.querySelector('.js-switchable-mode-page--scrollspy-offset');

    if (elem == null) {
      throw new Error('page offset reference is missing');
    }

    return elem;
  }

  constructor(props: Props) {
    super(props);

    this.controller = new Controller(this.props.container);

    makeObservable(this);
  }

  componentDidMount() {
    $(window).on(`scroll.${this.eventId}`, this.pageScan);

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
        containment: 'parent',
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

    const page = this.controller.hasSavedState
      ? null
      : validPage(currentUrl().hash.slice(1));

    core.reactTurbolinks.runAfterPageLoad(this.eventId, () => {
      if (page == null) {
        this.pageScan();
      } else {
        // The scroll is a bit off on Firefox if not using timeout.
        this.timeouts.initialPageJump = window.setTimeout(() => this.pageJump(page));
      }
    });
  }

  componentWillUnmount() {
    $(window).off(`.${this.eventId}`);

    [this.pages, this.tabs].forEach((sortable) => {
      if (sortable.current != null) {
        $(sortable.current).sortable('destroy');
      }
    });

    Object.values(this.timeouts).forEach((timeout) => window.clearTimeout(timeout));

    $(window).stop();
    this.controller.destroy();
  }

  render() {
    return (
      <UserProfileContainer user={this.controller.state.user}>
        <Header controller={this.controller} />

        <div className='hidden-xs page-extra-tabs page-extra-tabs--profile-page js-switchable-mode-page--scrollspy-offset'>
          {this.displayedExtraPages.length > 1 &&
            <div className='osu-page'>
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
            </div>
          }
        </div>

        <div ref={this.pages} className='user-profile-pages'>
          {this.displayedExtraPages.map((name) => (
            <div
              key={name}
              ref={this.extraPages[name]}
              className={`user-profile-pages__item js-switchable-mode-page--scrollspy js-switchable-mode-page--page ${this.isSortablePage(name) ? 'js-sortable--page' : ''}`}
              data-page-id={name}
            >
              {this.extraPage(name)}
            </div>
          ))}
        </div>
      </UserProfileContainer>
    );
  }

  private readonly extraPage = (name: ProfileExtraPage) => {
    const baseProps = {
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
    if (page === null) return;

    let offsetTop: number;

    if (page === 'main') {
      offsetTop = 0;
    } else {
      const target = this.extraPages[page].current;

      if (target == null) return;

      // count for the tabs height; assume pageJump always causes the header to be pinned
      // otherwise the calculation needs another phase and gets a bit messy.
      offsetTop = window.scrollY + target.getBoundingClientRect().top - this.pagesOffset.getBoundingClientRect().height;
    }

    // Don't bother scanning the current position.
    // The result will be wrong when target page is too short anyway.
    this.scrolling = true;

    $(window).stop().scrollTo(core.stickyHeader.scrollOffset(offsetTop), 500, {
      onAfter: action(() => {
        this.controller.currentPage = page;
        this.scrolling = false;
      }),
    });
  };

  @action
  private readonly pageScan = () => {
    if (this.scrolling) return;

    const pages = this.pageElements;

    if (pages.length === 0) return;

    let page: HTMLElement | null = null;

    if (bottomPage()) {
      page = htmlElementOrNull(last(pages));
    } else {
      const anchorHeight = this.pagesOffset.getBoundingClientRect().height;

      for (const p of pages) {
        page = htmlElementOrNull(p);

        if (page == null) {
          throw new Error('page element is somehow not an HTMLElement');
        }

        const pageDims = page.getBoundingClientRect();
        const pageBottom = pageDims.bottom - Math.min(pageDims.height * 0.75, 200);

        if (pageBottom > anchorHeight) break;
      }
    }

    if (page != null) {
      this.controller.currentPage = page.dataset.pageId as ProfileExtraPage;
    }
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
