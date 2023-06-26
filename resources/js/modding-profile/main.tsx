// Copyright (c) ppy Pty Ltd <contact@.ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { BeatmapsContext } from 'beatmap-discussions/beatmaps-context';
import { BeatmapsetsContext } from 'beatmap-discussions/beatmapsets-context';
import { DiscussionsContext } from 'beatmap-discussions/discussions-context';
import { ReviewEditorConfigContext } from 'beatmap-discussions/review-editor-config-context';
import HeaderV4 from 'components/header-v4';
import { NotificationBanner } from 'components/notification-banner';
import ProfilePageExtraTab from 'components/profile-page-extra-tab';
import ProfileTournamentBanner from 'components/profile-tournament-banner';
import UserProfileContainer from 'components/user-profile-container';
import BeatmapJson from 'interfaces/beatmap-json';
import BeatmapsetDiscussionJson, { BeatmapsetDiscussionJsonForBundle } from 'interfaces/beatmapset-discussion-json';
import BeatmapsetDiscussionPostJson, { BeatmapsetDiscussionMessagePostJson } from 'interfaces/beatmapset-discussion-post-json';
import BeatmapsetEventJson from 'interfaces/beatmapset-event-json';
import BeatmapsetExtendedJson from 'interfaces/beatmapset-extended-json';
import BeatmapsetJson from 'interfaces/beatmapset-json';
import KudosuHistoryJson from 'interfaces/kudosu-history-json';
import UserExtendedJson from 'interfaces/user-extended-json';
import UserJson from 'interfaces/user-json';
import _, { isEmpty, keyBy, throttle } from 'lodash';
import Kudosu from 'modding-profile/kudosu'
import { deletedUser } from 'models/user'
import core from 'osu-core-singleton';
import Badges from 'profile-page/badges';
import Cover from 'profile-page/cover';
import DetailBar from 'profile-page/detail-bar';
import headerLinks from 'profile-page/header-links';
import * as React from 'react';
import { bottomPage } from 'utils/html';
import { pageChange } from 'utils/page-change';
import { nextVal } from 'utils/seq';
import { switchNever } from 'utils/switch-never'
import { currentUrl, currentUrlRelative } from 'utils/turbolinks'
import { updateQueryString } from 'utils/url'
import Discussions from './discussions'
import Events from './events'
import { Posts } from './posts'
import Stats from './stats'
import Votes, { Direction, VoteSummary } from './votes'
import BeatmapExtendedJson from 'interfaces/beatmap-extended-json';
import UserModdingProfileJson from 'interfaces/user-modding-profile-json';

const moddingExtraPages = ['events', 'discussions', 'posts', 'votes', 'kudosu'] as const;
type ModdingExtraPage = (typeof moddingExtraPages)[number];

// FIXME: these can probably be removed like the profile page
const pages = document.getElementsByClassName('js-switchable-mode-page--scrollspy');
const pagesOffset = document.getElementsByClassName('js-switchable-mode-page--scrollspy-offset');

interface Props {
  beatmaps: BeatmapExtendedJson[];
  beatmapsets: BeatmapsetExtendedJson[];
  container: HTMLElement;
  discussions: BeatmapsetDiscussionJsonForBundle[];
  events: BeatmapsetEventJson[];
  extras: {
    recentlyReceivedKudosu: KudosuHistoryJson[];
  };
  perPage: {
    recentlyReceivedKudosu: number;
  };
  posts: BeatmapsetDiscussionMessagePostJson[];
  user: UserModdingProfileJson;
  users: UserJson[];
  votes: Record<Direction, VoteSummary[]>;
}

interface State {
  beatmaps: BeatmapExtendedJson[];
  beatmapsets: BeatmapsetExtendedJson[];
  currentPage: Page;
  discussions: BeatmapsetDiscussionJsonForBundle[];
  events: BeatmapsetEventJson[];
  posts: BeatmapsetDiscussionMessagePostJson[];
  profileOrder: ModdingExtraPage[];
  user: UserExtendedJson;
  users: UserJson[];
  votes: Record<Direction, VoteSummary[]>;
}

interface Cache {
  beatmaps: Partial<Record<number, BeatmapExtendedJson>>;
  beatmapsets: Partial<Record<number, BeatmapsetExtendedJson>>;
  discussions: Partial<Record<number, BeatmapsetDiscussionJsonForBundle>>;
  userDiscussions: BeatmapsetDiscussionJsonForBundle[];
  users: Partial<Record<number, UserJson>>;
}

type Page = ModdingExtraPage | 'main';

function validPage(page: unknown) {
  if (typeof page === 'string' && (page === 'main' || moddingExtraPages.includes(page as ModdingExtraPage))) {
    return page as Page;
  }

  return null;
}


export class Main extends React.PureComponent<Props, State> {
  private cache: Partial<Cache> = {};
  private readonly disposers = new Set<(() => void) | undefined>();
  private readonly eventId = `users-modding-history-index-${nextVal()}`;
  private initialPage: Page = 'main';
  private modeScrollTimeout: number | undefined;
  private modeScrollUrl: string;
  private readonly pageRefs: Record<ModdingExtraPage, React.RefObject<HTMLDivElement>> = {
    discussions: React.createRef(),
    events: React.createRef(),
    kudosu: React.createRef(),
    posts: React.createRef(),
    votes: React.createRef(),
  };
  private readonly pages = React.createRef<HTMLDivElement>();
  private restoredState = false;
  private readonly tabs = React.createRef<HTMLDivElement>();

  private get discussions() {
    // skipped discussions
    // - not privileged (deleted discussion)
    // - deleted beatmap
    this.cache.discussions ??= _(this.state.discussions)
      .filter((d) => !isEmpty(d))
      .keyBy('id')
      .value();

    return this.cache.discussions;
  }

  constructor(props: Props) {
    super(props);

    const page = validPage(currentUrl().hash.slice(1));
    if (page != null) {
      this.initialPage = page;
    }

    this.state = {
      beatmaps: props.beatmaps,
      beatmapsets: props.beatmapsets,
      currentPage: this.initialPage,
      discussions: props.discussions,
      events: props.events,
      posts: props.posts,
      user: props.user,
      users: props.users,
      votes: props.votes,
    };
  }

  componentDidMount() {
    $.subscribe(`user:update.${this.eventId}`, this.userUpdate);
    $.subscribe(`profile:page:jump.${this.eventId}`, this.pageJump);
    // pageScan does not need to run at 144 fps...
    $(window).on(`scroll.${this.eventId}`, throttle(() => this.pageScan(), 20));

    pageChange();

    this.modeScrollUrl = currentUrlRelative();

    this.disposers.add(core.reactTurbolinks.runAfterPageLoad(() =>
      // The scroll is a bit off on Firefox if not using timeout.
      window.setTimeout(() => this.pageJump(null, this.currentPage), 0),
    ));
  }

  componentWillUnmount() {
    $.unsubscribe(`.${this.eventId}`);
    $(window).off(`.${this.eventId}`);

    $(window).stop();
    window.clearTimeout(this.modeScrollTimeout);
    this.disposers.forEach((disposer) => disposer?.());
  }

  private get beatmaps() {
    this.cache.beatmaps ??= keyBy(this.state.beatmaps, 'id');
    return this.cache.beatmaps;
  }

  private get beatmapsets() {
    this.cache.beatmapsets ??= keyBy(this.state.beatmapsets, 'id');
    return this.cache.beatmapsets;
  }

  private get users() {
    if (this.cache.users == null) {
      this.cache.users = keyBy(this.state.users, 'id');
      this.cache.users.null = this.cache.users.undefined = deletedUser.toJson();
    }

    return this.cache.users;
  }

  private get userDiscussions() {
    this.cache.userDiscussions ??= this.state.discussions.filter((d) => d.user_id === this.state.user.id);
    return this.cache.userDiscussions;
  }

  render() {
    const profileOrder = this.state.profileOrder;

    return (
      <DiscussionsContext.Provider value={this.discussions}>
        <BeatmapsetsContext.Provider value={this.beatmapsets}>
          <BeatmapsContext.Provider value={this.beatmaps}>
            <UserProfileContainer user={this.state.user}>
              <HeaderV4
                backgroundImage={this.props.user.cover.url}
                links={headerLinks(this.props.user, 'modding')}
                // add space for warning banner when user is blocked
                modifiers={{
                  restricted: core.currentUserModel.blocks.has(this.props.user.id) || this.props.user.is_restricted,
                }}
                theme='users'
              />
              <div className='osu-page osu-page--generic-compact'>
                <div
                  className='js-switchable-mode-page--scrollspy js-switchable-mode-page--page'
                  data-page-id='main'
                >
                  <Cover
                    coverUrl={this.props.user.cover.url}
                    currentMode={this.props.user.playmode}
                    user={this.props.user}
                  />
                  {!this.props.user.is_bot && (
                    <>
                      <ProfileTournamentBanner banner={this.state.user.active_tournament_banner} />
                      <div className='profile-detail'>
                        <Badges badges={this.state.user.badges} />
                        <Stats user={this.props.user} />
                      </div>
                    </>
                  )}
                  <DetailBar user={this.props.user} />
                </div>
                <div
                  className='hidden-xs page-extra-tabs page-extra-tabs--profile-page js-switchable-mode-page--scrollspy-offset'>
                  <div
                    ref={this.tabs}
                    className='page-mode page-mode--profile-page-extra'
                  >
                    {profileOrder.map((m) => (
                      <a
                        key={m}
                        className='page-mode__item'
                        data-page-id={m}
                        href={`#${m}`}
                        onClick={this.tabClick}
                      >
                        <ProfilePageExtraTab
                          currentPage={this.state.currentPage}
                          page={m}
                        />
                      </a>
                    ))}
                  </div>
                </div>
                <div
                  ref={this.pages}
                  className='user-profile-pages'
                >
                  {profileOrder.map((name) => (
                    <div
                      key={name}
                      ref={this.pageRefs[name]}
                      className='js-switchable-mode-page--scrollspy js-switchable-mode-page--page'
                      data-page-id={name}
                    >
                      {this.extraPage(name)}
                    </div>
                  ))}
                </div>
              </div>
            </UserProfileContainer>
          </BeatmapsContext.Provider>
        </BeatmapsetsContext.Provider>
      </DiscussionsContext.Provider>
    );
  }

  private extraPage = (name: ModdingExtraPage) => {
    switch (name) {
      case 'discussions':
        return <Discussions discussions={this.userDiscussions} user={this.state.user} users={this.users} />;
      case 'events':
        return <Events events={this.state.events} user={this.state.user} users={this.users} />;
      case 'kudosu':
        return (
          <Kudosu
            expectedInitialCount={this.props.perPage.recentlyReceivedKudosu}
            initialKudosu={this.props.extras.recentlyReceivedKudosu}
            name={name}
            total={this.state.user.kudosu.total}
            userId={this.state.user.id}
          />
        );
      case 'posts':
        return <Posts posts={this.state.posts} user={this.state.user} users={this.users} />;
      case 'votes':
        return <Votes users={this.users} votes={this.state.votes} />;
      default:
        switchNever(name);
        throw new Error('unsupported extra page');
    }
  };

  private readonly pageScan = () => {
    // TODO: check if we can just apply the main user profile version
    // return if this.modeScrollUrl != currentUrlRelative()

    // return if this.scrolling
    // return if pages.length == 0

    // anchorHeight = pagesOffset[0].getBoundingClientRect().height

    // if bottomPage()
    //   this.setCurrentPage null, _.last(pages).dataset.pageId
    //   return

    // for page in pages
    //   pageDims = page.getBoundingClientRect()
    //   pageBottom = pageDims.bottom - Math.min(pageDims.height * 0.75, 200)
    //   continue unless pageBottom > anchorHeight

    //   this.setCurrentPage null, page.dataset.pageId
    //   return

    // this.setCurrentPage null, page.dataset.pageId
  };

  private readonly pageJump = (_e: unknown, page: Page | null) => {
    if (page == null) return;

    // if page == 'main'
    //   this.setCurrentPage null, page
    //   return

    // target = $(this.extraPages[page])

    // # if invalid page is specified, scan current position
    // if target.length == 0
    //   this.pageScan()
    //   return

    // # Don't bother scanning the current position.
    // # The result will be wrong when target page is too short anyway.
    // this.scrolling = true
    // Timeout.clear this.modeScrollTimeout

    // # count for the tabs height; assume pageJump always causes the header to be pinned
    // # otherwise the calculation needs another phase and gets a bit messy.
    // offsetTop = target.offset().top - pagesOffset[0].getBoundingClientRect().height

    // $(window).stop().scrollTo core.stickyHeader.scrollOffset(offsetTop), 500,
    //   onAfter: =>
    //     # Manually set the mode to avoid confusion (wrong highlight).
    //     # Scrolling will obviously break it but that's unfortunate result
    //     # from having the scrollspy marker at middle of page.
    //     this.setCurrentPage null, page, =>
    //       # Doesn't work:
    //       # - part of state (callback, part of mode setting)
    //       # - simple variable in callback
    //       # Both still change the switch too soon.
    //       this.modeScrollTimeout = Timeout.set 100, => this.scrolling = false
  };

  private setCurrentPage = (_e: null, page: ModdingExtraPage, extraCallback?: () => void) => {
    const callback = () => extraCallback?.();

    if (this.state.currentPage === page) {
      return callback();
    }

    this.setState({ currentPage: page }, callback);
  };

  private tabClick = (e: React.SyntheticEvent<HTMLAnchorElement>) => {
    e.preventDefault();

    this.pageJump(null, validPage(e.currentTarget.dataset.pageId));
  };


  private userUpdate = (_e: unknown, user: UserJson) => {
    if (user?.id !== this.state.user.id) {
      return this.forceUpdate();
    }

    // this component needs full user object but sometimes this event only sends part of it
    this.setState({ user: Object.assign({}, this.state.user, user) });
  };
}
