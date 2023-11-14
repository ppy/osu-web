// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import headerLinks from 'beatmapsets-show/header-links';
import BeatmapBasicStats from 'components/beatmap-basic-stats';
import BeatmapsetBadge from 'components/beatmapset-badge';
import BeatmapsetCover from 'components/beatmapset-cover';
import BeatmapsetMapping from 'components/beatmapset-mapping';
import BigButton from 'components/big-button';
import HeaderV4 from 'components/header-v4';
import PlaymodeTabs from 'components/playmode-tabs';
import StringWithComponent from 'components/string-with-component';
import UserLink from 'components/user-link';
import BeatmapExtendedJson from 'interfaces/beatmap-extended-json';
import BeatmapJson from 'interfaces/beatmap-json';
import BeatmapsetDiscussionsStore from 'interfaces/beatmapset-discussions-store';
import GameMode, { gameModes } from 'interfaces/game-mode';
import { route } from 'laroute';
import { kebabCase, snakeCase } from 'lodash';
import { action, computed, makeObservable } from 'mobx';
import { observer } from 'mobx-react';
import { deletedUserJson } from 'models/user';
import core from 'osu-core-singleton';
import * as React from 'react';
import { makeUrl } from 'utils/beatmapset-discussion-helper';
import { getArtist, getTitle } from 'utils/beatmapset-helper';
import { classWithModifiers } from 'utils/css';
import { trans } from 'utils/lang';
import BeatmapList from './beatmap-list';
import Chart from './chart';
import { Filter } from './current-discussions';
import DiscussionsState from './discussions-state';
import { Nominations } from './nominations';
import { Subscribe } from './subscribe';
import { UserFilter } from './user-filter';

interface Props {
  discussionsState: DiscussionsState;
  store: BeatmapsetDiscussionsStore;
}

const statTypes: Filter[] = ['mine', 'mapperNotes', 'resolved', 'pending', 'praises', 'deleted', 'total'];

@observer
export class Header extends React.Component<Props> {
  private get beatmaps() {
    return this.discussionsState.groupedBeatmaps;
  }

  private get beatmapset() {
    return this.discussionsState.beatmapset;
  }

  private get currentBeatmap() {
    return this.discussionsState.currentBeatmap;
  }

  @computed
  private get discussionCounts() {
    const counts: Partial<Record<Filter, number>> = {};
    const selectedUserId = this.discussionsState.selectedUserId;

    for (const type of statTypes) {
      let discussions = this.discussionsState.discussionsByFilter[type];
      if (selectedUserId != null) {
        discussions = discussions.filter((discussion) => discussion.user_id === selectedUserId);
      }

      counts[type] = discussions.length;
    }

    return counts;
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
        <HeaderV4
          links={headerLinks('discussions', this.beatmapset)}
          linksAppend={(
            <PlaymodeTabs
              currentMode={this.currentBeatmap.mode}
              entries={gameModes.map((mode) => ({
                count: this.discussionsState.discussionsCountByPlaymode[mode],
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

  private readonly createLink = (beatmap: BeatmapJson) => makeUrl({ beatmap });

  // TODO: does it need to be computed?
  private readonly getCount = (beatmap: BeatmapExtendedJson) => beatmap.deleted_at == null ? this.discussionsState.discussionsByBeatmap(beatmap.id).length : undefined;

  @action
  private readonly onClickMode = (event: React.MouseEvent<HTMLAnchorElement>, mode: GameMode) => {
    event.preventDefault();
    this.discussionsState.changeGameMode(mode);
  };

  @action
  private readonly onSelectBeatmap = (beatmapId: number) => {
    this.discussionsState.currentBeatmapId = beatmapId;
    this.discussionsState.changeDiscussionPage('timeline');
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
            <Subscribe beatmapset={this.beatmapset} />
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
                beatmaps={this.beatmaps.get(this.currentBeatmap.mode) ?? []}
                beatmapset={this.beatmapset}
                createLink={this.createLink}
                currentBeatmap={this.currentBeatmap}
                getCount={this.getCount}
                onSelectBeatmap={this.onSelectBeatmap}
                users={this.users}
              />
            </div>
            <div className={`${bn}__filter-group ${bn}__filter-group--stats`}>
              <UserFilter
                discussionsState={this.discussionsState}
                store={this.props.store}
              />
              <div className={`${bn}__stats`}>
                {statTypes.map(this.renderType)}
              </div>
            </div>
          </div>
          <div className='u-relative'>
            <Chart
              discussions={this.timelineDiscussions}
              duration={this.currentBeatmap.total_length * 1000}
            />
            <div className={`${bn}__beatmap-stats`}>
              <div className={`${bn}__guest`}>
                {this.currentBeatmap.user_id !== this.beatmapset.user_id && (
                  <span>
                    <StringWithComponent
                      mappings={{
                        user: <UserLink user={this.users.get(this.currentBeatmap.user_id) ?? deletedUserJson} />,
                      }}
                      pattern={trans('beatmaps.discussions.guest')}
                    />
                  </span>
                )}
              </div>
              <BeatmapBasicStats beatmap={this.currentBeatmap} beatmapset={this.beatmapset} />
            </div>
          </div>
        </div>
      </div>
    );
  }

  private readonly renderType = (type: Filter) => {
    if ((type === 'deleted') && !core.currentUser?.is_admin) {
      return null;
    }

    const bn = 'counter-box';

    let topClasses = classWithModifiers(bn, 'beatmap-discussions', kebabCase(type));
    if (this.discussionsState.currentPage !== 'events' && this.discussionsState.currentFilter === type) {
      topClasses += ' js-active';
    }

    return (
      <a
        key={type}
        className={topClasses}
        data-type={type}
        href={makeUrl({
          beatmapId: this.currentBeatmap.id,
          beatmapsetId: this.beatmapset.id,
          filter: type,
          mode: this.discussionsState.currentPage,
        })}
        onClick={this.setFilter}
      >
        <div className={`${bn}__content`}>
          <div className={`${bn}__title`}>
            {trans(`beatmaps.discussions.stats.${snakeCase(type)}`)}
          </div>
          <div className={`${bn}__count`}>
            {this.discussionCounts[type]}
          </div>
        </div>
        <div className={`${bn}__line`} />
      </a>
    );
  };

  private readonly setFilter = (event: React.SyntheticEvent<HTMLElement>) => {
    event.preventDefault();
    this.discussionsState.changeFilter(event.currentTarget.dataset.type);
  };
}
