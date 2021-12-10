// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import HeaderV4 from 'header-v4';
import CurrentUserJson from 'interfaces/current-user-json';
import GameMode from 'interfaces/game-mode';
import UserAchievementJson from 'interfaces/user-achievement-json';
import UserStatisticsJson from 'interfaces/user-statistics-json';
import { debounce } from 'lodash';
import { action, observable, makeObservable } from 'mobx';
import { observer } from 'mobx-react';
import Badges from 'profile-page/badges';
import CoverSelector from 'profile-page/cover-selector';
import Detail from 'profile-page/detail';
import DetailMobile from 'profile-page/detail-mobile';
import GameModeSwitcher from 'profile-page/game-mode-switcher';
import HeaderInfo from 'profile-page/header-info';
import headerLinks from 'profile-page/header-links';
import Links from 'profile-page/links';
import RankCount from 'profile-page/rank-count';
import Stats from 'profile-page/stats';
import ProfileTournamentBanner from 'profile-tournament-banner';
import * as React from 'react';
import { nextVal } from 'utils/seq';
import { ProfilePageUserJson } from './extra-page-props';

interface Props {
  currentMode: GameMode;
  stats: UserStatisticsJson;
  user: ProfilePageUserJson;
  userAchievements: UserAchievementJson[];
  withEdit: boolean;
}

@observer
export default class Header extends React.Component<Props> {
  private readonly coverSelector = React.createRef<HTMLDivElement>();
  @observable private coverUrl: string | null = this.props.user.cover.url;
  private readonly debouncedCoverSet = debounce((url: string | null) => this.coverSet(url), 300);
  @observable private selectingCover = false;
  private readonly eventId = `users-show-header-${nextVal()}`;
  @observable private isCoverUpdating = false;
  private xhr?: JQuery.jqXHR<CurrentUserJson>;

  constructor(props: Props) {
    super(props);

    makeObservable(this);
  }

  componentDidMount() {
    $.subscribe(`user:cover:reset.${this.eventId}`, this.coverReset);
    $.subscribe(`user:cover:set.${this.eventId}`, this.onCoverSet);
    $.subscribe(`user:cover:upload:state.${this.eventId}`, this.onCoverUploadState);

    $.subscribe(`key:esc.${this.eventId}`, this.tryCloseCoverSelector);
    $(document).on(`click.${this.eventId}`, this.onDocumentClick);
  }

  componentWillReceiveProps(newProps: Props) {
    this.debouncedCoverSet(newProps.user.cover.url);
  }

  componentWillUnmount() {
    $.unsubscribe(`.${this.eventId}`);
    $(document).off(`.${this.eventId}`);

    this.closeCoverSelector();
    this.debouncedCoverSet.cancel();
    this.xhr?.abort();
  }

  render() {
    return (
      <div className='js-switchable-mode-page--scrollspy js-switchable-mode-page--page' data-page-id='main'>
        <HeaderV4
          backgroundImage={this.coverUrl}
          contentPrepend={<ProfileTournamentBanner banner={this.props.user.active_tournament_banner} />}
          isCoverUpdating={this.isCoverUpdating}
          links={headerLinks(this.props.user, 'show')}
          theme='users'
          titleAppend={<GameModeSwitcher
            currentMode={this.props.currentMode}
            user={this.props.user}
            withEdit={this.props.withEdit}
          />}
        />

        <div className='osu-page osu-page--users'>
          <div className='profile-header'>
            <div className='profile-header__top'>
              <HeaderInfo coverUrl={this.coverUrl} currentMode={this.props.currentMode} user={this.props.user} />

              {!this.props.user.is_bot &&
                <>
                  <DetailMobile
                    rankHistory={this.props.user.rank_history}
                    stats={this.props.stats}
                    userAchievements={this.props.userAchievements}
                  />

                  <Stats stats={this.props.stats} />

                  <div className='profile-header__rank-count-mobile'>
                    <RankCount stats={this.props.stats} />
                  </div>
                </>
              }
            </div>

            <Detail
              stats={this.props.stats}
              type='user'
              user={this.props.user}
              userAchievements={this.props.userAchievements}
            />

            <Badges badges={this.props.user.badges} />

            <Links user={this.props.user} />

            {this.renderCoverSelector()}
          </div>
        </div>
      </div>
    );
  }

  @action
  private readonly closeCoverSelector = () => {
    this.selectingCover = false;
    this.coverReset();
  };

  private readonly coverReset = () => {
    this.debouncedCoverSet(this.props.user.cover.url);
  };

  private coverSet(url: string | null) {
    if (this.isCoverUpdating) return;

    this.coverUrl = url;
  }

  private readonly onCoverSet = (_e: unknown, url: string) => {
    this.debouncedCoverSet(url);
  };

  private readonly onCoverUploadState = (_e: unknown, state: boolean) => {
    this.isCoverUpdating = state;
  };

  private readonly onDocumentClick = (e: JQuery.ClickEvent) => {
    if (!this.selectingCover) return;

    if (e.button !== 0) return;

    if ('target' in e && this.coverSelector.current != null && $(e.target).closest(this.coverSelector.current).length) {
      return;
    }

    this.tryCloseCoverSelector();
  };

  private readonly onClickCoverSelectorToggle = () => {
    if (this.selectingCover) {
      this.closeCoverSelector();
    } else {
      this.openCoverSelector();
    }
  };

  private readonly openCoverSelector = () => {
    this.selectingCover = true;
  };

  private renderCoverSelector() {
    if (!this.props.withEdit) return null;

    return (
      <div ref={this.coverSelector} className='profile-header__cover-editor'>
        <button
          className='btn-circle btn-circle--page-toggle'
          onClick={this.onClickCoverSelectorToggle}
          title={osu.trans('users.show.edit.cover.button')}
        >
          <span className='fas fa-pencil-alt' />
        </button>

        {this.selectingCover &&
          <CoverSelector
            canUpload={this.props.user.is_supporter}
            cover={this.props.user.cover}
          />
        }
      </div>
    );
  }

  private readonly tryCloseCoverSelector = () => {
    if ($('#overlay').is(':visible')) return;
    if (document.body.classList.contains('modal-open')) return;

    this.closeCoverSelector();
  };
}
