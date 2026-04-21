// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import headerLinks from 'beatmapsets-show/header-links';
import BeatmapBasicStats from 'components/beatmap-basic-stats';
import BeatmapsetBadge from 'components/beatmapset-badge';
import BeatmapsetCover from 'components/beatmapset-cover';
import BeatmapsetMapping from 'components/beatmapset-mapping';
import BigButton from 'components/big-button';
import HeaderV4 from 'components/header-v4';
import NotificationBanner from 'components/notification-banner';
import PlaymodeTabs from 'components/playmode-tabs';
import StringWithComponent from 'components/string-with-component';
import BeatmapsetDiscussionsStore from 'interfaces/beatmapset-discussions-store';
import Ruleset, { rulesets } from 'interfaces/ruleset';
import { route } from 'laroute';
import { action, computed, makeObservable } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import { hasGuestOwners } from 'utils/beatmap-helper';
import { getArtist, getTitle } from 'utils/beatmapset-helper';
import { trans, transChoice } from 'utils/lang';
import BeatmapList from './beatmap-list';
import Chart from './chart';
import DiscussionsState from './discussions-state';
import { Nominations } from './nominations';
import { Subscribe } from './subscribe';
import UserLinkList from './user-link-list';

interface Props {
  discussionsState: DiscussionsState;
  store: BeatmapsetDiscussionsStore;
}

@observer
export class Header extends React.Component<Props> {
  private get beatmapset() {
    return this.discussionsState.beatmapset;
  }

  private get currentBeatmap() {
    return this.discussionsState.currentBeatmap;
  }

  private get discussionsState() {
    return this.props.discussionsState;
  }

  @computed
  private get timelineDiscussions() {
    return this.discussionsState.discussionsForSelectedUserByMode.timeline;
  }

  private get users() {
    return this.props.store.users;
  }

  constructor(props: Props) {
    super(props);
    makeObservable(this);
  }

  render() {
    return (
      <>
        {this.beatmapset.deleted_at != null && (
          <NotificationBanner
            message={trans('beatmapsets.show.deleted_banner.message')}
            title={trans('beatmapsets.show.deleted_banner.title')}
            type='info'
          />
        )}
        <HeaderV4
          links={headerLinks('discussions', this.beatmapset)}
          linksAppend={(
            <PlaymodeTabs
              currentMode={this.currentBeatmap.mode}
              entries={rulesets.map((mode) => ({
                count: this.discussionsState.unresolvedDiscussionCounts.byMode[mode],
                countTooltip: transChoice('beatmaps.discussions.unresolved_count', this.discussionsState.unresolvedDiscussionCounts.byMode[mode] ?? 0),
                disabled: (this.discussionsState.groupedBeatmaps.get(mode)?.length ?? 0) === 0,
                mode,
              }))}
              modifiers='beatmapset'
              onClick={this.onClickMode}
            />
          )}
          theme='beatmapset'
        />
        <div className='osu-page'>{this.renderHeaderTop()}</div>
        <div className='osu-page osu-page--small'>{this.renderHeaderBottom()}</div>
      </>
    );
  }

  @action
  private readonly onClickMode = (event: React.MouseEvent<HTMLAnchorElement>, mode: Ruleset) => {
    event.preventDefault();
    this.discussionsState.changeGameMode(mode);
  };

  private renderHeaderBottom() {
    const bn = 'beatmap-discussions-header-bottom';

    return (
      <div className={bn}>
        <div className={`${bn}__content ${bn}__content--details`}>
          <div className={`${bn}__details ${bn}__details--full`}>
            <BeatmapsetMapping
              beatmapset={this.beatmapset}
              user={this.users.get(this.beatmapset.user_id)}
            />
          </div>
          <div className={`${bn}__details`}>
            <Subscribe beatmapset={this.beatmapset} discussionsState={this.discussionsState} />
          </div>
          <div className={`${bn}__details`}>
            <BigButton
              href={route('beatmapsets.show', { beatmapset: this.beatmapset.id })}
              icon='fas fa-info'
              modifiers='full'
              text={trans('beatmaps.discussions.beatmap_information')}
            />
          </div>
        </div>
        <div className={`${bn}__content ${bn}__content--nomination`}>
          <Nominations
            discussionsState={this.discussionsState}
            store={this.props.store}
          />
        </div>
      </div>
    );
  }


  private renderHeaderTop() {
    const bn = 'beatmap-discussions-header-top';

    return (
      <div className={bn}>
        <div className={`${bn}__content`}>
          <div className={`${bn}__cover`}>
            <BeatmapsetCover
              beatmapset={this.beatmapset}
              modifiers='full'
              size='cover'
            />
          </div>
          <div className={`${bn}__title-container`}>
            <h1 className={`${bn}__title`}>
              <a
                className='link link--white link--no-underline'
                href={route('beatmapsets.show', { beatmapset: this.beatmapset.id })}
              >
                {getTitle(this.beatmapset)}
              </a>
              <BeatmapsetBadge beatmapset={this.beatmapset} type='nsfw' />
              <BeatmapsetBadge beatmapset={this.beatmapset} type='spotlight' />
            </h1>
            <h2 className={`${bn}__title ${bn}__title--artist`}>
              {getArtist(this.beatmapset)}
              <BeatmapsetBadge beatmapset={this.beatmapset} type='featured_artist' />
            </h2>
          </div>
          <div className={`${bn}__filters`}>
            <div className={`${bn}__filter-group`}>
              <BeatmapList
                discussionsState={this.discussionsState}
                users={this.users}
              />
            </div>
          </div>
          <div className={`${bn}__beatmap-stats`}>
            <div className={`${bn}__owners`}>
              {hasGuestOwners(this.currentBeatmap, this.beatmapset) && (
                <StringWithComponent
                  mappings={{
                    user: <UserLinkList users={this.currentBeatmap.owners ?? []} />,
                  }}
                  pattern={trans('beatmaps.discussions.guest')}
                />
              )}
            </div>
            <div className={`${bn}__basic-stats`}>
              <BeatmapBasicStats beatmap={this.currentBeatmap} beatmapset={this.beatmapset} />
            </div>
            <div className={`${bn}__chart`}>
              <Chart
                discussions={this.timelineDiscussions}
                duration={this.currentBeatmap.total_length * 1000}
              />
            </div>
          </div>
        </div>
      </div>
    );
  }
}
