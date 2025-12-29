// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapsetCover from 'components/beatmapset-cover';
import DifficultyBadge from 'components/difficulty-badge';
import FlagCountry from 'components/flag-country';
import StringWithComponent from 'components/string-with-component';
import UserAvatar from 'components/user-avatar';
import UserJson from 'interfaces/user-json';
import { route } from 'laroute';
import { debounce, intersection } from 'lodash';
import { action, autorun, makeObservable, observable, runInAction } from 'mobx';
import { disposeOnUnmount, observer } from 'mobx-react';
import React from 'react';
import { hasGuestOwners } from 'utils/beatmap-helper';
import { getArtist, getTitle } from 'utils/beatmapset-helper';
import { classWithModifiers, Modifiers, urlPresence } from 'utils/css';
import { formatNumber, htmlElementOrNull } from 'utils/html';
import { trans, transArray } from 'utils/lang';
import { mapBy } from 'utils/map';
import { getInt } from 'utils/math';
import { switchNever } from 'utils/switch-never';
import WrappedData, { BeatmapForWrappedJson, FavouriteMapper, TopPlay } from './data';

/* eslint-disable sort-keys */
const pageTypeMapping = {
  summary: 'summary',
  top_plays: 'beatmaps',
  daily_challenge: 'plain',
  statistics: 'plain',
  favourite_mappers: 'mappers',
  favourite_artists: 'beatmaps',
  mapping: 'plain',
} as const;
/* eslint-enable sort-keys */

type DisplayType = 'beatmaps' | 'mappers' | 'plain' | 'summary';
type PageType = keyof typeof pageTypeMapping;
const listTypes = new Set<DisplayType>(['beatmaps', 'mappers']) as Set<unknown>;

const pageTitles: Record<PageType, string> = {
  daily_challenge: 'Daily Challenge',
  favourite_artists: 'Favourite Artists',
  favourite_mappers: 'Favourite Mappers',
  mapping: 'Beatmapping',
  statistics: 'Statistics',
  summary: 'Summary',
  top_plays: 'Top Plays',
};

const rankColours = ['#ffe599', '#bab9b8', '#fd9a68'];

function FavouriteMapper(props: { mapper: FavouriteMapper; user?: UserJson }) {
  return (
    <a className='wrapped__favourite-mapper' href={route('users.show', { user: props.mapper.mapper_id })}>
      <div className='wrapped__favourite-mapper-avatar'><UserAvatar modifiers='full-circle' user={props.user} /></div>
      <div className='wrapped__summary-list-item-text'>
        <div className='wrapped__summary-list-item-title'>{props.user?.username ?? trans('users.deleted')}</div>
        <div className='wrapped__summary-list-item-value'>{formatNumber(props.mapper.scores.score_count)} plays</div>
      </div>
    </a>
  );
}

function Mappers(props: { beatmap: BeatmapForWrappedJson }) {
  if (props.beatmap.beatmapset == null) return null;

  const translationKey = hasGuestOwners(props.beatmap, props.beatmap.beatmapset)
    ? 'mapped_by_guest'
    : 'mapped_by';

  return (
    <StringWithComponent
      mappings={{
        mapper: (
          <span className={classWithModifiers('wrapped__text', 'difficulty')}>
            {transArray(props.beatmap.owners.map((owner) => owner.username))}
          </span>
        ),
      }}
      pattern={trans(`beatmapsets.show.details.${translationKey}`)}
    />
  );
}

function TopPlay(props: { beatmap?: BeatmapForWrappedJson; play: TopPlay }) {
  const beatmapset = props.beatmap?.beatmapset;
  return (
    <a className={classWithModifiers('wrapped__top-plays', 'summary-beatmap')} href={route('scores.show', { beatmap: props.play.id })}>
      <div className={classWithModifiers('wrapped__list-item', 'summary-beatmap')}
      >
        <BeatmapsetCover
          beatmapset={beatmapset}
          modifiers='full'
          size='card'
        />
      </div>
      <div className='wrapped__summary-list-item-text'>
        <div className='wrapped__summary-list-item-title'>
          {beatmapset != null ? getTitle(beatmapset) : trans('beatmapsets.cover.deleted')}
        </div>
        <div className='wrapped__summary-list-item-value'>
          {formatNumber(Math.round(props.play.pp))} pp
        </div>
      </div>
    </a>
  );
}

interface WrappedStatProps {
  modifiers?: Modifiers;
  percent?: boolean;
  round?: boolean;
  skippable?: boolean;
  title: string;
  value: number | string;
}

// not really random backgrounds.
const summaryBackgroundUrls = [
  'https://assets.ppy.sh/user-cover-presets/18/d208ed867fba75a6529e2f66796ea65fc7507a62a316b7d4311c2bd82e6c30b0.jpeg',
  'https://assets.ppy.sh/user-cover-presets/19/2d85fcc09cd17097e0043c88646aa73371bbef2499970c276b409bc9b260717c.jpeg',
  'https://assets.ppy.sh/user-cover-presets/7/4a0ccb7b7fdd5c4238b11f0e7c686760fe2c99c6472b19400e82d1a8ff503e31.jpeg',
  'https://assets.ppy.sh/user-cover-presets/20/7be0bc7d933b0b5fefb043fbd11e5018d75f7f64c2a78a8a50148d96ed6745b5.jpeg',
];

function WrappedStat(props: WrappedStatProps) {
  if ((props.skippable ?? false) && props.value === 0) {
    return null;
  }

  const value = typeof props.value === 'number' && (props.round ?? false)
    ? Math.round(props.value)
    : props.value;

  const text = typeof value !== 'number'
    ? value
    : props.percent ?? false
      ? formatNumber(value, 2, { style: 'percent' })
      : formatNumber(value);

  return (
    <div className={classWithModifiers('wrapped__stat', props.modifiers)}>
      <div className={classWithModifiers('wrapped__stat-title', props.modifiers)}>{props.title}</div>
      <div className={classWithModifiers('wrapped__stat-value', props.modifiers)}>{text}</div>
    </div>
  );
}

function WrappedStatItems(props: { children?: React.ReactNode; modifiers?: Modifiers; title: string }) {
  return (
    <div className={classWithModifiers('wrapped__stat', props.modifiers)}>
      <div className={classWithModifiers('wrapped__stat-title', props.modifiers)}>{props.title}</div>
      <div className={classWithModifiers('wrapped__stat-items', props.modifiers)}>
        {props.children}
      </div>
    </div>
  );
}

@observer
export default class WrappedShow extends React.Component<WrappedData> {
  private readonly availablePages: PageType[];
  @observable private backgroundLoaded = false;
  private backgroundPrevious?: string;
  private readonly beatmaps = mapBy(this.props.related_beatmaps, 'id');
  private readonly ref = React.createRef<HTMLDivElement>();
  @observable private selectedIndex = 0;
  @observable private selectedListIndex = 0;
  private readonly setBackgroundLoadedDebounced = debounce(() => this.setBackgroundLoaded(), 100);
  private readonly user;
  private readonly users = mapBy(this.props.related_users, 'id');

  get currentList() {
    switch (this.selectedPageType) {
      case 'favourite_artists':
      case 'favourite_mappers':
      case 'top_plays':
        return this.props.summary[this.selectedPageType];
    }

    return [];
  }

  get hasList() {
    return listTypes.has(pageTypeMapping[this.selectedPageType]);
  }

  get fallbackBackground() {
    return summaryBackgroundUrls[this.user.id % summaryBackgroundUrls.length];
  }

  get isSummaryPage() {
    return this.selectedPageType === 'summary';
  }

  get pageTitle() {
    return pageTitles[this.selectedPageType];
  }

  get selectedFavouriteArtist() {
    return this.props.summary.favourite_artists[this.selectedListIndex];
  }

  get selectedFavouriteMapper() {
    return this.props.summary.favourite_mappers[this.selectedListIndex];
  }

  get selectedTopPlay() {
    return this.props.summary.top_plays[this.selectedListIndex];
  }

  get selectedPageType() {
    return this.availablePages[this.selectedIndex];
  }

  constructor(props: WrappedData) {
    super(props);

    const user = this.users.get(props.user_id);
    if (user == null) {
      throw new Error('missing user');
    }

    this.user = user;

    const keys = new Set(Object.keys(props.summary));
    // remove some pages if all 0.
    if (Object.values(props.summary.mapping).every((value) => value === 0)) {
      keys.delete('mapping');
    }
    if (Object.values(props.summary.daily_challenge).every((value) => value === 0)) {
      keys.delete('daily_challenge');
    }
    if (props.summary.favourite_artists.length === 0) {
      keys.delete('favourite_artists');
    }
    if (props.summary.favourite_mappers.length === 0) {
      keys.delete('favourite_mappers');
    }
    if (props.summary.top_plays.length === 0) {
      keys.delete('top_plays');
    }


    this.availablePages = [
      'summary',
      'statistics',
      ...intersection(Object.keys(pageTypeMapping), [...keys.values()]) as PageType[],
    ];

    // console.log(this.availablePages);

    document.addEventListener('keydown', this.handleKeyDown);

    makeObservable(this);

    disposeOnUnmount(
      this,
      autorun(() => this.setBackgroundLoading(this.backgroundForPage(this.selectedPageType).replace('/covers/cover', '/covers/fullsize'))),
    );
  }

  componentWillUnmount() {
    document.removeEventListener('keydown', this.handleKeyDown);
  }

  render() {
    const url= this.backgroundForPage(this.selectedPageType);

    return (
      <div className={classWithModifiers('wrapped', this.selectedPageType)}>
        <div
          ref={this.ref}
          className='wrapped__container'
        >
          {/* gradient separated from content background so it's not effected by the padding, etc */}
          <div className={classWithModifiers('wrapped__background')} />
          <img
            className={classWithModifiers('wrapped__background', { loaded: this.backgroundLoaded })}
            onLoad={this.handleBackgroundLoad}
            // quick and dirty replace, 2x also ended up being necessary
            src={url.replace('/covers/cover', '/covers/fullsize')}
          />
          <div className='wrapped__background wrapped__background--gradient' />
          {this.renderHeader()}
          {this.renderHeaderSummaryMobile()}

          <div className={classWithModifiers('wrapped__page-mark', { summary: this.isSummaryPage })}>
            <span className='wrapped__page-number'>{this.selectedIndex}</span>
            <span className='wrapped__page-title'>{this.pageTitle}</span>
          </div>

          <div className={classWithModifiers('wrapped__content', pageTypeMapping[this.selectedPageType])}>
            {this.renderPage()}
          </div>
        </div>
        <div className='wrapped__switcher'>
          {this.availablePages.map((page, index) => this.renderSwitcher(page, index))}
        </div>
      </div>
    );
  }

  private backgroundForPage(page: PageType, index?: number) {
    // TODO: actual from data
    switch (page) {
      case 'daily_challenge':
        return summaryBackgroundUrls[(this.user.id + 1) % summaryBackgroundUrls.length];
      case 'mapping':
        return summaryBackgroundUrls[(this.user.id + 2) % summaryBackgroundUrls.length];
      case 'statistics':
        return this.user.cover?.url ?? this.fallbackBackground;
      case 'favourite_artists': {
        const beatmap = index == null
          ? this.beatmaps.get(this.selectedFavouriteArtist.scores.score_best_beatmap_id)
          : this.beatmaps.get(this.props.summary.favourite_artists[index]?.scores.score_best_beatmap_id);
        return beatmap?.beatmapset?.covers.cover ?? this.fallbackBackground;
      }
      case 'favourite_mappers': {
        const user = index == null
          ? this.users.get(this.selectedFavouriteMapper.mapper_id)
          : this.users.get(this.props.summary.favourite_mappers[index]?.mapper_id);
        return user?.avatar_url ?? '/images/layout/avatar-guest@2x.png';
      }
      case 'summary':
        return this.beatmaps.get(this.props.summary.top_plays[0]?.beatmap_id)?.beatmapset?.covers.cover ?? this.fallbackBackground;
      case 'top_plays': {
        const beatmap = index == null
          ? this.beatmaps.get(this.selectedTopPlay.beatmap_id)
          : this.beatmaps.get(this.props.summary.top_plays[index]?.beatmap_id);
        return beatmap?.beatmapset?.covers.cover ?? this.fallbackBackground;
      }
    }

    return summaryBackgroundUrls[this.user.id % summaryBackgroundUrls.length];
  }

  @action
  private readonly handleBackgroundLoad = (e: React.SyntheticEvent<HTMLImageElement>) => {
    this.backgroundPrevious = e.currentTarget.src;
    this.setBackgroundLoadedDebounced();
  };

  // @action doesn't work for some reason?
  private readonly handleKeyDown = (e: KeyboardEvent) => runInAction(() => {
    switch (e.key) {
      case 'ArrowDown':
      case 'ArrowRight':
        if (e.shiftKey && this.hasList && this.currentList.length > 0) {
          if (this.selectedListIndex < this.currentList.length - 1) {
            e.preventDefault();
            this.selectedListIndex++;
            this.scrollSelectedListElementIntoView();
            return;
          }
        }

        if (this.selectedIndex < this.availablePages.length - 1) {
          e.preventDefault();
          this.selectedIndex++;
          this.selectedListIndex = 0;
        }
        return;
      case 'ArrowLeft':
      case 'ArrowUp':
        if (e.shiftKey && this.hasList && this.currentList.length > 0) {
          if (this.selectedListIndex > 0) {
            e.preventDefault();
            this.selectedListIndex--;
            this.scrollSelectedListElementIntoView();
            return;
          }
        }

        if (this.selectedIndex > 0) {
          e.preventDefault();
          this.selectedIndex--;
          this.selectedListIndex = this.currentList.length - 1;
        }
        return;
    }
  });

  @action
  private readonly handleSelectListItem = (e: React.MouseEvent<HTMLElement>) => {
    const element = htmlElementOrNull(e.currentTarget);
    if (element == null) return;

    const index = getInt(element.dataset.index);
    if (index == null) return;

    if (index >= 0 && index < this.currentList.length) {
      e.preventDefault();
      this.selectedListIndex = index;
      this.scrollSelectedListElementIntoView(element);
    }
  };

  @action
  private readonly handleSwitcherOnClick = (e: React.MouseEvent<HTMLElement>) => {
    const element = htmlElementOrNull(e.currentTarget);
    if (element == null) return;

    const index = getInt(element.dataset.index);
    if (index == null) return;

    if (index >= 0 && index < this.availablePages.length) {
      this.selectedIndex = index;
      this.selectedListIndex = 0;
    }
  };

  private renderDailyChallenge() {
    return (
      <div className='wrapped__stats'>
        <WrappedStat modifiers='fancy' title='Cleared' value={this.props.summary.daily_challenge.cleared} />
        <WrappedStat modifiers='fancy' title='Top 10% Placements' value={this.props.summary.daily_challenge.top_10p} />
        <WrappedStat modifiers='fancy' title='Top 50% Placements' value={this.props.summary.daily_challenge.top_50p} />
        <WrappedStat modifiers='fancy' title='Longest Streak' value={this.props.summary.daily_challenge.highest_streak} />
      </div>
    );
  }

  private renderFavouriteArtists() {
    const selectedItem = this.selectedFavouriteArtist;
    const selectedBeatmap = this.beatmaps.get(selectedItem.scores.score_best_beatmap_id);

    return (
      <>
        <div className='wrapped__list-container'>
          <div className={classWithModifiers('wrapped__list', 'beatmap')}>
            {this.props.summary.favourite_artists.map((item, index) => (
              <div
                key={index}
                className={classWithModifiers('wrapped__list-item', 'beatmap', { selected: this.selectedListIndex === index })}
                data-index={index}
                onClick={this.handleSelectListItem}
              >
                <BeatmapsetCover
                  beatmapset={this.beatmaps.get(item.scores.score_best_beatmap_id)?.beatmapset}
                  modifiers='full'
                  size='card'
                />
              </div>
            ))}
          </div>
        </div>
        {selectedBeatmap != null && (
          <div className='wrapped__list-details'>
            {this.renderListDetailsTitle(
              <a className={classWithModifiers('wrapped__text', 'container')} href={route('beatmaps.show', { beatmap: selectedBeatmap.id })}>
                <div className={classWithModifiers('wrapped__text')}>{selectedItem.artist.name}</div>
              </a>,
              'centred',
            )}
            <div className='wrapped__stats wrapped__stats--dense'>
              <WrappedStat title='Plays' value={selectedItem.scores.score_count} />
              <WrappedStat round title='Best pp' value={selectedItem.scores.pp_best} />
              <WrappedStat title='Best Score' value={selectedItem.scores.score_best} />
              <WrappedStat round title='Average pp' value={selectedItem.scores.pp_avg} />
              <WrappedStat round title='Average Score' value={selectedItem.scores.score_avg} />
            </div>
          </div>
        )}
      </>
    );
  }

  private renderFavouriteMappers() {
    const selectedItem = this.selectedFavouriteMapper;
    const mapper = this.users.get(selectedItem.mapper_id);

    return (
      <>
        <div className='wrapped__list-container'>
          <div className='wrapped__list'>
            {this.props.summary.favourite_mappers.map((item, index) => (
              <div
                key={item.mapper_id}
                className={classWithModifiers('wrapped__list-item', { selected: this.selectedListIndex === index })}
                data-index={index}
                onClick={this.handleSelectListItem}
              >
                <UserAvatar modifiers='wrapped' user={this.users.get(item.mapper_id)} />
              </div>
            ))}
          </div>
        </div>
        <div className='wrapped__list-details'>
          {this.renderListDetailsTitle(
            <a className={classWithModifiers('wrapped__text', 'container')} href={route('users.show', { user: mapper?.id })}>
              <div className={classWithModifiers('wrapped__text')}>{mapper?.username}</div>
            </a>,
            'centred',
          )}
          <div className='wrapped__stats wrapped__stats--dense'>
            <WrappedStat title='Plays' value={selectedItem.scores.score_count} />
            <WrappedStat round title='Best pp' value={selectedItem.scores.pp_best} />
            <WrappedStat title='Best Score' value={selectedItem.scores.score_best} />
            <WrappedStat round title='Average pp' value={selectedItem.scores.pp_avg} />
            <WrappedStat round title='Average Score' value={selectedItem.scores.score_avg} />
          </div>
        </div>
      </>
    );
  }

  private renderHeader() {
    const summary = this.selectedPageType === 'summary';
    return (
      <div className={classWithModifiers('wrapped__header', { summary })}>
        <div className='wrapped__user'>
          <span
            className='wrapped__user-avatar'
            style={{ backgroundImage: urlPresence(this.user.avatar_url) }}
          />
          {this.isSummaryPage && (
            <span className='wrapped__user-flag'>
              <FlagCountry country={this.user.country} modifiers={['flat', 'large']} />
            </span>
          )}
          <span className={classWithModifiers('wrapped__username', { summary })}>{this.user.username}</span>
        </div>
        <img className='wrapped__logo' src='/images/wrapped/logo.svg' />
      </div>
    );
  }

  // version of the header just for mobile because it just has to be different
  private renderHeaderSummaryMobile() {
    if (this.selectedPageType !== 'summary') return null;

    return (
      <>
        <div className={classWithModifiers('wrapped__header', 'summary-mobile')}>
          <div className={classWithModifiers('wrapped__user', 'summary-mobile')}>
            <span
              className='wrapped__user-avatar'
              style={{ backgroundImage: urlPresence(this.user.avatar_url) }}
            />
            <span className={classWithModifiers('wrapped__username', 'summary-mobile')}>{this.user.username}</span>
          </div>
          <img className='wrapped__summary-logo' src='/images/wrapped/wrapped-summary-logo.svg' />
        </div>
      </>
    );
  }

  private renderListDetailsTitle(content: React.ReactNode, modifiers?: Modifiers) {
    return (
      <div className={classWithModifiers('wrapped__list-details-title', modifiers)}>
        <div
          className='wrapped__rank'
          style={{ '--rank-colour': rankColours[this.selectedListIndex] ?? '' } as React.CSSProperties}
        >
          {`#${this.selectedListIndex + 1}`}
        </div>
        {content}
      </div>
    );
  }

  private renderMapping() {
    const mapping = this.props.summary.mapping;

    return (
      <div className='wrapped__stats'>
        <WrappedStat modifiers='fancy' skippable title='Betmaps Ranked' value={mapping.ranked} />
        <WrappedStat modifiers='fancy' skippable title='Betmaps Nominated' value={mapping.nominations} />
        <WrappedStat modifiers='fancy' skippable title='Betmaps Loved' value={mapping.loved} />
        <WrappedStat modifiers='fancy' skippable title='Betmaps Made' value={mapping.created} />
        <WrappedStat modifiers='fancy' skippable title='Guest Beatmaps' value={mapping.guest} />
        <WrappedStat modifiers='fancy' skippable title='Kudosu Received' value={mapping.kudosu} />
        <WrappedStat modifiers='fancy' skippable title='Beatmap Discussions' value={mapping.discussions} />
      </div>
    );
  }

  private renderPage() {
    switch (this.selectedPageType) {
      case 'daily_challenge':
        return this.renderDailyChallenge();
      case 'favourite_artists':
        return this.renderFavouriteArtists();
      case 'favourite_mappers':
        return this.renderFavouriteMappers();
      case 'mapping':
        return this.renderMapping();
      case 'summary':
        return this.renderSummary();
      case 'statistics':
        return this.renderStatistics();
      case 'top_plays':
        return this.renderTopPlays();
      default:
        switchNever(this.selectedPageType);
        return <></>;
    }
  }

  private renderStatistics() {
    const summary = this.props.summary;

    return (
      <div className='wrapped__stats'>
        <WrappedStat
          modifiers='fancy'
          percent
          title='Plays Percentile'
          value={summary.scores.playcount.top_percent}
        />
        <WrappedStat modifiers='fancy' title='Beatmaps Played' value={summary.scores.playcount.playcount} />
        <WrappedStat modifiers='fancy' title='Position' value={summary.scores.playcount.pos} />

        <WrappedStat modifiers='fancy' round title='Total pp' value={summary.scores.pp} />
        <WrappedStat modifiers='fancy' percent title='Average Accuracy' value={summary.scores.acc} />
        <WrappedStat modifiers='fancy' title='Highest Combo' value={summary.scores.combo} />
        <WrappedStat modifiers='fancy' title='Highest Score' value={summary.scores.score} />

        <WrappedStat modifiers='fancy' title='Medals Collected' value={summary.medals} />
        <WrappedStat modifiers='fancy' title='Replays Watched' value={summary.replays} />
      </div>
    );
  }

  private renderSummary() {
    const summary = this.props.summary;

    return (
      <>
        <div className='wrapped__top-stats'>
          <WrappedStat modifiers='fancy' title='Beatmaps Played' value={summary.scores.playcount.playcount} />
          <WrappedStat modifiers='fancy' title='pp' value={Math.round(summary.scores.pp)} />
          <WrappedStat modifiers='fancy' title='Highest Score' value={summary.scores.score} />
          <WrappedStat modifiers='fancy' title='Medals' value={summary.medals} />
          <WrappedStat modifiers='fancy' skippable title='Daily Challenge Streak' value={summary.daily_challenge.highest_streak} />
          <WrappedStat modifiers='fancy' skippable title='Replays Watched' value={summary.replays} />
        </div>
        <div className='wrapped__bottom-stats'>
          <WrappedStatItems modifiers={['fancy', 'summary']} title='Your Favourite Mappers'>
            {summary.favourite_mappers.map((value) =>
              <FavouriteMapper key={value.mapper_id} mapper={value} user={this.users.get(value.mapper_id)} />,
            )}
          </WrappedStatItems>
          <WrappedStatItems modifiers={['fancy', 'summary']} title='Your Top Plays'>
            {summary.top_plays.map((value) => <TopPlay key={value.id} beatmap={this.beatmaps.get(value.beatmap_id)} play={value} />)}
          </WrappedStatItems>
        </div>
      </>
    );
  }

  private renderSwitcher(page: PageType, index: number) {
    return (
      <div
        key={index}
        className={classWithModifiers('wrapped__switcher-item', { active: index === this.selectedIndex })}
        data-index={index}
        onClick={this.handleSwitcherOnClick}
      >
        <img src={this.backgroundForPage(page, 0)} />
      </div>
    );
  }

  private renderTopPlays() {
    const selectedItem = this.selectedTopPlay;
    const selectedBeatmap = this.beatmaps.get(selectedItem.beatmap_id);
    const artist = selectedBeatmap?.beatmapset != null ? getArtist(selectedBeatmap.beatmapset) : '';
    const title = selectedBeatmap?.beatmapset != null ? getTitle(selectedBeatmap.beatmapset) : trans('beatmapsets.cover.deleted');

    return (
      <>
        <div className='wrapped__list-container'>
          <div className={classWithModifiers('wrapped__list', 'beatmap')}>
            {this.props.summary.top_plays.map((play, index) => (
              <div
                key={play.id}
                className={classWithModifiers('wrapped__list-item', 'beatmap', { selected: this.selectedListIndex === index })}
                data-index={index}
                onClick={this.handleSelectListItem}
              >
                <BeatmapsetCover
                  beatmapset={this.beatmaps.get(play.beatmap_id)?.beatmapset}
                  modifiers='full'
                  size='card'
                />
              </div>
            ))}
          </div>
        </div>
        {selectedBeatmap != null && (
          <div className='wrapped__list-details'>
            {this.renderListDetailsTitle(
              <a className={classWithModifiers('wrapped__text', 'container')} href={route('scores.show', { score: selectedItem.id })}>
                <div className={classWithModifiers('wrapped__text', 'top')}>
                  {title}
                  <span className={classWithModifiers('wrapped__text', 'artist')}>
                    {` ${trans('beatmapsets.show.details.by_artist', { artist })}`}
                  </span>
                </div>
                <div className={classWithModifiers('wrapped__text', 'bottom')}>
                  <span className='wrapped__difficulty-badge'>
                    <DifficultyBadge rating={selectedBeatmap.difficulty_rating} />
                  </span>
                  <span>
                    <span className={classWithModifiers('wrapped__text', 'difficulty')}>{selectedBeatmap.version}</span>
                    {' '}
                    <Mappers beatmap={selectedBeatmap} />
                  </span>
                </div>
              </a>,
            )}
            <div className='wrapped__stats wrapped__stats--dense'>
              <WrappedStat round title='pp' value={selectedItem.pp} />
              <WrappedStat title='Rank' value={selectedItem.rank} />
              <WrappedStat title='Score' value={selectedItem.total_score} />
              <WrappedStat percent title='Accuracy' value={selectedItem.accuracy} />
              <WrappedStat title='Max Combo' value={selectedItem.max_combo} />
              <WrappedStat title='Great' value={selectedItem.statistics.great ?? 0} />
              <WrappedStat title='Ok' value={selectedItem.statistics.ok ?? 0} />
              <WrappedStat title='Meh' value={selectedItem.statistics.meh ?? 0} />
              <WrappedStat title='Miss' value={selectedItem.statistics.miss ?? 0} />
            </div>
          </div>
        )}
      </>
    );
  }

  // boxing the primitive for observe is annoying so just use querySelector.
  private scrollSelectedListElementIntoView(element?: HTMLElement) {
    (element ?? document.querySelector('.wrapped__list-item--selected'))?.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
  }

  @action
  private setBackgroundLoaded() {
    this.backgroundLoaded = true;
  }

  @action
  private setBackgroundLoading(url: string) {
    if (url === this.backgroundPrevious) return;

    this.backgroundLoaded = false;
  }
}
