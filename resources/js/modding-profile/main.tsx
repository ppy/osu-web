// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { BeatmapsContext } from 'beatmap-discussions/beatmaps-context';
import { BeatmapsetsContext } from 'beatmap-discussions/beatmapsets-context';
import { DiscussionsContext } from 'beatmap-discussions/discussions-context';
import HeaderV4 from 'components/header-v4';
import ProfilePageExtraTab from 'components/profile-page-extra-tab';
import ProfileTournamentBanner from 'components/profile-tournament-banner';
import UserProfileContainer from 'components/user-profile-container';
import BeatmapExtendedJson from 'interfaces/beatmap-extended-json';
import { BeatmapsetDiscussionJsonForBundle } from 'interfaces/beatmapset-discussion-json';
import { BeatmapsetDiscussionMessagePostJson } from 'interfaces/beatmapset-discussion-post-json';
import BeatmapsetEventJson from 'interfaces/beatmapset-event-json';
import BeatmapsetExtendedJson from 'interfaces/beatmapset-extended-json';
import KudosuHistoryJson from 'interfaces/kudosu-history-json';
import UserJson from 'interfaces/user-json';
import UserModdingProfileJson from 'interfaces/user-modding-profile-json';
import { first, isEmpty, keyBy, last, throttle } from 'lodash';
import { action, computed, makeObservable, observable } from 'mobx';
import { observer } from 'mobx-react';
import Kudosu from 'modding-profile/kudosu';
import { deletedUserJson } from 'models/user';
import core from 'osu-core-singleton';
import Badges from 'profile-page/badges';
import Cover from 'profile-page/cover';
import DetailBar from 'profile-page/detail-bar';
import headerLinks from 'profile-page/header-links';
import * as React from 'react';
import { bottomPage } from 'utils/html';
import { nextVal } from 'utils/seq';
import { switchNever } from 'utils/switch-never';
import { currentUrl } from 'utils/turbolinks';
import Discussions from './discussions';
import Events from './events';
import { Posts } from './posts';
import Stats from './stats';
import Votes, { Direction, VoteSummary } from './votes';

// in display order.
const moddingExtraPages = ['events', 'discussions', 'posts', 'votes', 'kudosu'] as const;
type ModdingExtraPage = (typeof moddingExtraPages)[number];

interface Props {
  beatmaps: BeatmapExtendedJson[];
  beatmapsets: BeatmapsetExtendedJson[];
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

type Page = ModdingExtraPage | 'main';

function validPage(page: unknown) {
  if (typeof page === 'string' && (page === 'main' || moddingExtraPages.includes(page as ModdingExtraPage))) {
    return page as Page;
  }

  return null;
}

@observer
export default class Main extends React.Component<Props> {
  @observable private currentPage: Page = 'main';
  private readonly disposers = new Set<(() => void) | undefined>();
  private readonly eventId = `users-modding-history-index-${nextVal()}`;
  private pageJumpingTo: Page | null = null;
  private readonly pageRefs: Record<Page, React.RefObject<HTMLDivElement>> = {
    discussions: React.createRef(),
    events: React.createRef(),
    kudosu: React.createRef(),
    main: React.createRef(),
    posts: React.createRef(),
    votes: React.createRef(),
  };
  private readonly pages = React.createRef<HTMLDivElement>();
  private readonly pagesOffsetRef = React.createRef<HTMLDivElement>();
  private readonly tabs = React.createRef<HTMLDivElement>();

  @computed
  private get beatmaps() {
    return keyBy(this.props.beatmaps, 'id');
  }

  @computed
  private get beatmapsets() {
    return keyBy(this.props.beatmapsets, 'id');
  }

  @computed
  private get discussions() {
    // skipped discussions
    // - not privileged (deleted discussion)
    // - deleted beatmap
    return keyBy(this.props.discussions.filter((d) => !isEmpty(d)), 'id');
  }

  private get pagesOffset() {
    return this.pagesOffsetRef.current;
  }

  private get stickyHeaderOffset() {
    return core.stickyHeader.headerHeight + (this.pagesOffset?.getBoundingClientRect().height ?? 0);
  }

  @computed
  private get userDiscussions() {
    return this.props.discussions.filter((d) => d.user_id === this.props.user.id);
  }

  @computed
  private get users() {
    const values = keyBy(this.props.users, 'id');
    // eslint-disable-next-line id-blacklist
    values.null = values.undefined = deletedUserJson;

    return values;
  }

  constructor(props: Props) {
    super(props);

    makeObservable(this);
  }

  componentDidMount() {
    // pageScan does not need to run at 144 fps...
    $(window).on(`scroll.${this.eventId}`, throttle(() => this.pageScan(), 20));

    const page = validPage(currentUrl().hash.slice(1)) ?? 'main';

    this.disposers.add(core.reactTurbolinks.runAfterPageLoad(() => {
      if (page != null) {
        window.setTimeout(() => {
          this.pageScrollIntoView(page);
        }, 0);
      }
    }));
  }

  componentWillUnmount() {
    $(window).off(`.${this.eventId}`);

    this.disposers.forEach((disposer) => disposer?.());
  }

  render() {
    return (
      <DiscussionsContext.Provider value={this.discussions}>
        <BeatmapsetsContext.Provider value={this.beatmapsets}>
          <BeatmapsContext.Provider value={this.beatmaps}>
            <UserProfileContainer user={this.props.user}>
              <HeaderV4
                backgroundImage={this.props.user.cover.url}
                links={headerLinks(this.props.user, 'modding')}
                theme='users'
              />
              <div className='osu-page osu-page--generic-compact'>
                <div ref={this.pageRefs.main} data-page-id='main'>
                  <Cover
                    coverUrl={this.props.user.cover.url}
                    currentMode={this.props.user.playmode}
                    user={this.props.user}
                  />
                  {!this.props.user.is_bot && (
                    <>
                      <ProfileTournamentBanner banner={this.props.user.active_tournament_banner} />
                      <div className='profile-detail'>
                        <Badges badges={this.props.user.badges} />
                        <Stats user={this.props.user} />
                      </div>
                    </>
                  )}
                  <DetailBar user={this.props.user} />
                </div>
                <div
                  ref={this.pagesOffsetRef}
                  className='page-extra-tabs page-extra-tabs--profile-page'
                >
                  <div
                    ref={this.tabs}
                    className='page-mode page-mode--profile-page-extra'
                  >
                    {moddingExtraPages.map((page) => (
                      <a
                        key={page}
                        className='page-mode__item'
                        data-page-id={page}
                        href={`#${page}`}
                        onClick={this.tabClick}
                      >
                        <ProfilePageExtraTab
                          currentPage={this.currentPage}
                          page={page}
                        />
                      </a>
                    ))}
                  </div>
                </div>
                <div ref={this.pages} className='user-profile-pages'>
                  {moddingExtraPages.map((name) => (
                    <div
                      key={name}
                      ref={this.pageRefs[name]}
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
        return <Discussions discussions={this.userDiscussions} user={this.props.user} users={this.users} />;
      case 'events':
        return <Events events={this.props.events} user={this.props.user} users={this.users} />;
      case 'kudosu':
        return (
          <Kudosu
            expectedInitialCount={this.props.perPage.recentlyReceivedKudosu}
            initialKudosu={this.props.extras.recentlyReceivedKudosu}
            name={name}
            total={this.props.user.kudosu.total}
            userId={this.props.user.id}
          />
        );
      case 'posts':
        return <Posts posts={this.props.posts} user={this.props.user} users={this.users} />;
      case 'votes':
        return <Votes users={this.users} votes={this.props.votes} />;
      default:
        switchNever(name);
        throw new Error('unsupported extra page');
    }
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

    for (const key of moddingExtraPages) {
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
    const pageIds = [...matching];
    // special case for bottom of page if there are multiple pages visible.
    if (bottomPage()) {
      preferred = last(pageIds);
    } else {
      // prefer using the page being navigated to if its element is in view.
      preferred = this.pageJumpingTo != null && matching.has(this.pageJumpingTo) ? this.pageJumpingTo : first(pageIds);
    }

    if (preferred != null) {
      this.currentPage = preferred;
    }
  };

  @action
  private readonly pageScrollIntoView = (page: Page, smooth = false) => {
    const target = page === 'main' ? document.body : this.pageRefs[page].current;
    if (target == null) return;

    const pageId = target.dataset.pageId as Page;
    // fine for the current scroll containers.
    let maxScrollY = document.body.scrollHeight - window.innerHeight;
    if (pageId !== last(moddingExtraPages)) {
      maxScrollY -= 1;
    }

    const top = Math.floor(Math.min(maxScrollY, window.scrollY + target.getBoundingClientRect().top - this.stickyHeaderOffset));
    // smooth scroll when using navigation bar.
    window.scrollTo({ behavior: smooth ? 'smooth' : undefined, top });
  };

  private tabClick = (e: React.SyntheticEvent<HTMLAnchorElement>) => {
    e.preventDefault();

    this.pageJump(validPage(e.currentTarget.dataset.pageId));
  };
}
