// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserAchievementJson from 'interfaces/user-achievement-json';
import UserExtendedJson from 'interfaces/user-extended-json';
import UserStatisticsJson from 'interfaces/user-statistics-json';
import { computed } from 'mobx';
import { observer } from 'mobx-react';
import core from 'osu-core-singleton';
import DetailBarColumns from 'profile-page/detail-bar-columns';
import MedalsCount from 'profile-page/medals-count';
import PlayTime from 'profile-page/play-time';
import Pp from 'profile-page/pp';
import Rank from 'profile-page/rank';
import * as React from 'react';
import { RankChart } from 'react/profile-page/rank-chart';
import { RankCount } from 'react/profile-page/rank-count';

export type DetailType = 'modding' | 'multiplayer' | 'user';

interface Props {
  stats: UserStatisticsJson;
  type: DetailType;
  user: UserExtendedJson;
  userAchievements: UserAchievementJson[];
}

@observer
export default class Detail extends React.Component<Props> {
  @computed
  get isExpanded() {
    return core.userPreferences.get('ranking_expanded');
  }

  render() {
    return (
      <div className='profile-detail'>
        <div className='profile-detail-bar'>
          {this.renderExpander()}
          <DetailBarColumns user={this.props.user}>
            {this.renderExtras()}
          </DetailBarColumns>
        </div>
        {this.renderExpandedDetails()}
      </div>
    );
  }

  private handleExpanderClick = () => {
    core.userPreferences.set('ranking_expanded', !core.userPreferences.get('ranking_expanded'));
  };

  private renderExpandedDetails() {
    if (this.props.user.is_bot || this.props.type !== 'user') return null;

    return (
      <div className={this.isExpanded ? '' : 'hidden'}>
        <div className='profile-detail__row profile-detail__row--top'>
          <div className='profile-detail__col profile-detail__col--top-left'>
            <div className='profile-detail__top-left-item'>
              <PlayTime stats={this.props.stats} />
            </div>
            <div className='profile-detail__top-left-item'>
              <MedalsCount userAchievements={this.props.userAchievements} />
            </div>
            <div className='profile-detail__top-left-item'>
              <Pp stats={this.props.stats} />
            </div>
          </div>
          <div className='profile-detail__col'>
            <RankCount stats={this.props.stats} />
          </div>
        </div>
        <div className='profile-detail__row'>
          <div className='profile-detail__col profile-detail__col--bottom-left'>
            {this.props.stats.is_ranked ? (
              <RankChart rankHistory={this.props.user.rank_history} stats={this.props.stats} />
            ) : (
              <div className='profile-detail__empty-chart'>{osu.trans('users.show.extra.unranked')}</div>
            )}

          </div>
          <div className='profile-detail__col profile-detail__col--bottom-right'>
            <div className='profile-detail-bar__bottom-right-item'>
              <Rank modifiers='large' stats={this.props.stats} type='global' />
            </div>
            <div className='profile-detail-bar__bottom-right-item'>
              <Rank stats={this.props.stats} type='country' />
            </div>
          </div>
        </div>
      </div>
    );
  }

  private renderExpander() {
    if (this.props.user.is_bot || this.props.type !== 'user') return null;

    const className = this.isExpanded ? 'fas fa-chevron-up' : 'fas fa-chevron-down';
    return (
      <div className='profile-detail-bar__page-toggle'>
        <button
          className='btn-circle btn-circle--page-toggle'
          onClick={this.handleExpanderClick}
          title={osu.trans(`common.buttons.${this.isExpanded ? 'collapse' : 'expand'}`)}
        >
          <span className={className} />
        </button>
      </div>
    )
  }

  private renderExtras() {
    if (this.props.user.is_bot) return null;

    switch (this.props.type) {
      case 'modding':
        return this.renderModding();
      case 'user':
        return this.renderUser();
    }

    return null;
  }

  private renderModding() {
    return (
      <>
        <div className='profile-detail-bar__entry'>
          <Rank stats={this.props.stats} type='global' />
        </div>
        <div className='profile-detail-bar__entry'>
          <Rank stats={this.props.stats} type='country' />
        </div>
        <div className='profile-detail-bar__entry profile-detail-bar__entry--level'>
          <div
            className='profile-detail-bar__level'
            title={osu.trans('users.show.stats.level', { level: this.props.stats.level.current })}
          >
            {this.props.stats.level.current}
          </div>
        </div>
      </>
    );
  }

  private renderUser() {
    return (
      <>
        {this.isExpanded ? (
          <div
            className='profile-detail-bar__entry profile-detail-bar__entry--level-progress hidden-xs'
            title={osu.trans('users.show.stats.level_progress')}
          >
            <div className='bar bar--user-profile'>
              <div className='bar__fill' style={{ width: `${this.props.stats.level.progress}%` }}/>
              <div className='bar__text'>{`${this.props.stats.level.progress}%`}</div>
            </div>
          </div>
        ) : (
          <>
            <div className='profile-detail-bar__entry hidden-xs'>
              <Rank stats={this.props.stats} type='global' />
            </div>
            <div className='profile-detail-bar__entry hidden-xs'>
              <Rank stats={this.props.stats} type='country' />
            </div>
          </>
        )}

        <div className='profile-detail-bar__entry profile-detail-bar__entry--level'>
          <div
            className='profile-detail-bar__level'
            title={osu.trans('users.show.stats.level', { level: this.props.stats.level.current })}
          >
            {this.props.stats.level.current}
          </div>
        </div>
      </>
    );
  }
}
