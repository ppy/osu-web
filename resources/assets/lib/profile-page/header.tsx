// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import HeaderV4 from 'header-v4';
import { action, observable, makeObservable } from 'mobx';
import { observer } from 'mobx-react';
import { isModalShowing } from 'modal-helper';
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
import Controller from './controller';

interface Props {
  controller: Controller;
}

@observer
export default class Header extends React.Component<Props> {
  private readonly coverSelector = React.createRef<HTMLDivElement>();
  private readonly eventId = `users-show-header-${nextVal()}`;
  @observable private selectingCover = false;

  constructor(props: Props) {
    super(props);

    makeObservable(this);
  }

  componentDidMount() {
    $.subscribe(`key:esc.${this.eventId}`, this.tryCloseCoverSelector);
    $(document).on(`click.${this.eventId}`, this.onDocumentClick);
  }

  componentWillUnmount() {
    $.unsubscribe(`.${this.eventId}`);
    $(document).off(`.${this.eventId}`);

    this.closeCoverSelector();
  }

  render() {
    return (
      <div className='js-switchable-mode-page--scrollspy js-switchable-mode-page--page' data-page-id='main'>
        <HeaderV4
          backgroundImage={this.props.controller.displayCoverUrl}
          contentPrepend={<ProfileTournamentBanner banner={this.props.controller.state.user.active_tournament_banner} />}
          isCoverUpdating={this.props.controller.isUpdatingCover}
          links={headerLinks(this.props.controller.state.user, 'show')}
          theme='users'
          titleAppend={<GameModeSwitcher controller={this.props.controller} />}
        />

        <div className='osu-page osu-page--users'>
          <div className='profile-header'>
            <div className='profile-header__top'>
              <HeaderInfo coverUrl={this.props.controller.displayCoverUrl} currentMode={this.props.controller.currentMode} user={this.props.controller.state.user} />

              {!this.props.controller.state.user.is_bot &&
                <>
                  <DetailMobile
                    rankHistory={this.props.controller.state.user.rank_history}
                    stats={this.props.controller.state.user.statistics}
                    userAchievements={this.props.controller.state.user.user_achievements}
                  />

                  <Stats stats={this.props.controller.state.user.statistics} />

                  <div className='profile-header__rank-count-mobile'>
                    <RankCount stats={this.props.controller.state.user.statistics} />
                  </div>
                </>
              }
            </div>

            <Detail
              stats={this.props.controller.state.user.statistics}
              type='user'
              user={this.props.controller.state.user}
              userAchievements={this.props.controller.state.user.user_achievements}
            />

            <Badges badges={this.props.controller.state.user.badges} />

            <Links user={this.props.controller.state.user} />

            {this.renderCoverSelector()}
          </div>
        </div>
      </div>
    );
  }

  @action
  private readonly closeCoverSelector = () => {
    this.selectingCover = false;
    this.props.controller.setDisplayCoverUrl(null);
  };

  private readonly onClickCoverSelectorToggle = () => {
    if (this.selectingCover) {
      this.closeCoverSelector();
    } else {
      this.openCoverSelector();
    }
  };

  private readonly onDocumentClick = (e: JQuery.ClickEvent) => {
    if (!this.selectingCover) return;

    if (e.button !== 0) return;

    if ('target' in e && this.coverSelector.current != null && $(e.target).closest(this.coverSelector.current).length) {
      return;
    }

    this.tryCloseCoverSelector();
  };

  @action
  private readonly openCoverSelector = () => {
    this.selectingCover = true;
  };

  private renderCoverSelector() {
    if (!this.props.controller.withEdit) return null;

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
          <CoverSelector controller={this.props.controller} />
        }
      </div>
    );
  }

  private readonly tryCloseCoverSelector = () => {
    if (isModalShowing()) return;

    this.closeCoverSelector();
  };
}
