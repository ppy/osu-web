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
import { BeatmapsetDiscussionJsonForShow } from 'interfaces/beatmapset-discussion-json';
import BeatmapsetEventJson from 'interfaces/beatmapset-event-json';
import BeatmapsetWithDiscussionsJson from 'interfaces/beatmapset-with-discussions-json';
import GameMode, { gameModes } from 'interfaces/game-mode';
import UserJson from 'interfaces/user-json';
import { route } from 'laroute';
import { kebabCase, size, snakeCase } from 'lodash';
import { deletedUser } from 'models/user';
import core from 'osu-core-singleton';
import * as React from 'react';
import { makeUrl } from 'utils/beatmapset-discussion-helper';
import { getArtist, getTitle } from 'utils/beatmapset-helper';
import { classWithModifiers } from 'utils/css';
import { trans } from 'utils/lang';
import BeatmapList from './beatmap-list';
import Chart from './chart';
import CurrentDiscussions, { Filter } from './current-discussions';
import { DiscussionPage } from './discussion-mode';
import { Nominations } from './nominations';
import { Subscribe } from './subscribe';
import { UserFilter } from './user-filter';

interface Props {
  beatmaps: Map<GameMode, BeatmapExtendedJson[]>;
  beatmapset: BeatmapsetWithDiscussionsJson;
  currentBeatmap: BeatmapExtendedJson;
  currentDiscussions: CurrentDiscussions;
  currentFilter: Filter;
  discussions: Partial<Record<number, BeatmapsetDiscussionJsonForShow>>;
  discussionStarters: UserJson[];
  events: BeatmapsetEventJson[];
  mode: DiscussionPage;
  selectedUserId: number | null;
  users: Partial<Record<number, UserJson>>;
}

const statTypes: Filter[] = ['mine', 'mapperNotes', 'resolved', 'pending', 'praises', 'deleted', 'total'];

export class Header extends React.PureComponent<Props> {
  render() {
    return (
      <>
        <HeaderV4
          links={headerLinks('discussions', this.props.beatmapset)}
          linksAppend={(
            <PlaymodeTabs
              currentMode={this.props.currentBeatmap.mode}
              entries={gameModes.map((mode) => ({
                count: this.props.currentDiscussions.countsByPlaymode[mode],
                disabled: (this.props.beatmaps.get(mode)?.length ?? 0) === 0,
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

  private readonly getCount = (beatmap: BeatmapExtendedJson) =>
    beatmap.deleted_at == null
      ? this.props.currentDiscussions.countsByBeatmap[beatmap.id]
      : undefined;

  private readonly onClickMode = (event: React.MouseEvent<HTMLAnchorElement>, mode: GameMode) => {
    event.preventDefault();
    $.publish('playmode:set', [{ mode }]);
  };

  private readonly onSelectBeatmap = (beatmapId: number) => {
    $.publish('beatmapsetDiscussions:update', {
      beatmapId,
      mode: 'timeline',
    });
  };

  private renderHeaderBottom() {
    const bn = 'beatmap-discussions-header-bottom';

    return (
      <div className={bn}>
        <div className={`${bn}__content ${bn}__content--details`}>
          <div className={`${bn}__details ${bn}__details--full`}>
            <BeatmapsetMapping
              beatmapset={this.props.beatmapset}
              user={this.props.users[this.props.beatmapset.user_id]}
            />
          </div>
          <div className={`${bn}__details`}>
            <Subscribe beatmapset={this.props.beatmapset} />
          </div>
          <div className={`${bn}__details`}>
            <BigButton
              href={route('beatmapsets.show', { beatmapset: this.props.beatmapset.id })}
              icon='fas fa-info'
              modifiers='full'
              text={trans('beatmaps.discussions.beatmap_information')}
            />
          </div>
        </div>
        <div className={`${bn}__content ${bn}__content--nomination`}>
          <Nominations
            beatmapset={this.props.beatmapset}
            currentDiscussions={this.props.currentDiscussions}
            discussions={this.props.discussions}
            events={this.props.events}
            users={this.props.users}
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
              beatmapset={this.props.beatmapset}
              modifiers='full'
              size='cover'
            />
          </div>
          <div className={`${bn}__title-container`}>
            <h1 className={`${bn}__title`}>
              <a
                className='link link--white link--no-underline'
                href={route('beatmapsets.show', { beatmapset: this.props.beatmapset.id })}
              >
                {getTitle(this.props.beatmapset)}
              </a>
              <BeatmapsetBadge beatmapset={this.props.beatmapset} type='nsfw' />
              <BeatmapsetBadge beatmapset={this.props.beatmapset} type='spotlight' />
            </h1>
            <h2 className={`${bn}__title ${bn}__title--artist`}>
              {getArtist(this.props.beatmapset)}
              <BeatmapsetBadge beatmapset={this.props.beatmapset} type='featured_artist' />
            </h2>
          </div>
          <div className={`${bn}__filters`}>
            <div className={`${bn}__filter-group`}>
              <BeatmapList
                beatmaps={this.props.beatmaps.get(this.props.currentBeatmap.mode) ?? []}
                beatmapset={this.props.beatmapset}
                createLink={this.createLink}
                currentBeatmap={this.props.currentBeatmap}
                getCount={this.getCount}
                onSelectBeatmap={this.onSelectBeatmap}
                users={this.props.users}
              />
            </div>
            <div className={`${bn}__filter-group ${bn}__filter-group--stats`}>
              <UserFilter
                ownerId={this.props.beatmapset.user_id}
                selectedUser={this.props.selectedUserId != null ? this.props.users[this.props.selectedUserId] : null}
                users={this.props.discussionStarters}
              />
              <div className={`${bn}__stats`}>
                {statTypes.map(this.renderType)}
              </div>
            </div>
          </div>
          <div className='u-relative'>
            <Chart
              discussions={this.props.currentDiscussions.byFilter[this.props.currentFilter].timeline}
              duration={this.props.currentBeatmap.total_length * 1000}
            />
            <div className={`${bn}__beatmap-stats`}>
              <div className={`${bn}__guest`}>
                {this.props.currentBeatmap.user_id !== this.props.beatmapset.user_id && (
                  <span>
                    <StringWithComponent
                      mappings={{
                        user: <UserLink user={this.props.users[this.props.currentBeatmap.user_id] ?? deletedUser} />,
                      }}
                      pattern={trans('beatmaps.discussions.guest')}
                    />
                  </span>
                )}
              </div>
              <BeatmapBasicStats beatmap={this.props.currentBeatmap} beatmapset={this.props.beatmapset} />
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
    if (this.props.mode !== 'events' && this.props.currentFilter === type) {
      topClasses += ' js-active';
    }

    const discussionsByFilter = this.props.currentDiscussions.byFilter[type];
    const total = Object.values(discussionsByFilter).reduce((acc, discussions) => acc + size(discussions), 0);

    return (
      <a
        key={type}
        className={topClasses}
        data-type={type}
        href={makeUrl({
          beatmapId: this.props.currentBeatmap.id,
          beatmapsetId: this.props.beatmapset.id,
          filter: type,
          mode: this.props.mode,
        })}
        onClick={this.setFilter}
      >
        <div className={`${bn}__content`}>
          <div className={`${bn}__title`}>
            {trans(`beatmaps.discussions.stats.${snakeCase(type)}`)}
          </div>
          <div className={`${bn}__count`}>
            {total}
          </div>
        </div>
        <div className={`${bn}__line`} />
      </a>
    );
  };

  private readonly setFilter = (event: React.SyntheticEvent<HTMLElement>) => {
    event.preventDefault();
    $.publish('beatmapsetDiscussions:update', { filter: event.currentTarget.dataset.type });
  };
}
