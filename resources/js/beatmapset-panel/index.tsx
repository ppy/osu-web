// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapsetBadge from 'components/beatmapset-badge';
import BeatmapsetCover from 'components/beatmapset-cover';
import { CircularProgress } from 'components/circular-progress';
import StringWithComponent from 'components/string-with-component';
import TimeWithTooltip from 'components/time-with-tooltip';
import UserLink from 'components/user-link';
import BeatmapJson from 'interfaces/beatmap-json';
import BeatmapsetExtendedJson from 'interfaces/beatmapset-extended-json';
import BeatmapsetJson, { BeatmapsetStatus } from 'interfaces/beatmapset-json';
import GameMode from 'interfaces/game-mode';
import { route } from 'laroute';
import { sum, values } from 'lodash';
import { action, computed, makeObservable, observable } from 'mobx';
import { observer } from 'mobx-react';
import core from 'osu-core-singleton';
import * as React from 'react';
import { Transition } from 'react-transition-group';
import { getArtist, getDiffColour, getTitle, group as groupBeatmaps } from 'utils/beatmap-helper';
import { showVisual, toggleFavourite } from 'utils/beatmapset-helper';
import { classWithModifiers } from 'utils/css';
import { formatNumber, formatNumberSuffixed } from 'utils/html';
import { trans } from 'utils/lang';
import { beatmapsetDownloadDirect } from 'utils/url';
import BeatmapsPopup from './beatmaps-popup';

export const beatmapsetCardSizes = ['normal', 'extra'] as const;
export type BeatmapsetCardSize = typeof beatmapsetCardSizes[number];

export interface Props {
  beatmapset: BeatmapsetExtendedJson;
}

const beatmapsPopupTransitionDuration = 150;

const displayDateMap: Record<BeatmapsetStatus, 'last_updated' | 'ranked_date'> = {
  approved: 'ranked_date',
  graveyard: 'last_updated',
  loved: 'ranked_date',
  pending: 'last_updated',
  qualified: 'ranked_date',
  ranked: 'ranked_date',
  wip: 'last_updated',
};

const BeatmapDot = observer(({ beatmap }: { beatmap: BeatmapJson }) => (
  <div
    className='beatmapset-panel__beatmap-dot'
    style={{
      '--bg': getDiffColour(beatmap.difficulty_rating),
    } as React.CSSProperties}
  />
));

const BeatmapDots = observer(({ compact, beatmaps, mode }: { beatmaps: BeatmapJson[]; compact: boolean; mode: GameMode }) => (
  <div className='beatmapset-panel__extra-item beatmapset-panel__extra-item--dots'>
    <div className='beatmapset-panel__beatmap-icon'>
      <i className={`fal fa-extra-mode-${mode}`} />
    </div>
    {compact ? (
      <div className='beatmapset-panel__beatmap-count'>
        {beatmaps.length}
      </div>
    ) : (
      beatmaps.map((beatmap) => <BeatmapDot key={beatmap.id} beatmap={beatmap} />)
    )}
  </div>
));

const MapperLink = observer(({ beatmapset }: { beatmapset: BeatmapsetJson }) => (
  <UserLink
    className='beatmapset-panel__mapper-link u-hover'
    user={{ id: beatmapset.user_id, username: beatmapset.creator }}
  />
));

const PlayIcon = ({ icon, titleVariant }: { icon: string; titleVariant: string }) => (
  <div
    className='beatmapset-panel__play-icon'
    title={trans(`beatmapsets.show.info.${titleVariant}`)}
  >
    <i className={icon} />
  </div>
);

interface StatsItemProps {
  icon: string;
  title: string;
  type: string;
  value: number;
}

const StatsItem = ({ icon, title, type, value }: StatsItemProps) => (
  <div
    className={`beatmapset-panel__stats-item beatmapset-panel__stats-item--${type}`}
    title={title}
  >
    <span className='beatmapset-panel__stats-item-icon'>
      <i className={`fa-fw ${icon}`} />
    </span>
    <span>{formatNumberSuffixed(value)}</span>
  </div>
);

@observer
export default class BeatmapsetPanel extends React.Component<Props> {
  @observable private beatmapsPopupHover = false;
  private beatmapsPopupRef = React.createRef<BeatmapsPopup>();
  private blockRef = React.createRef<HTMLDivElement>();
  @observable private mobileExpanded = false;
  private timeouts: Partial<Record<string, number>> = {};

  @computed
  private get beatmapDotsCompact() {
    return this.props.beatmapset.beatmaps != null && this.props.beatmapset.beatmaps.length > 12;
  }

  @computed
  private get displayDate() {
    const attribute = displayDateMap[this.props.beatmapset.status];

    const ret = this.props.beatmapset[attribute];

    if (ret == null) {
      throw Error('trying to display null date');
    }

    return ret;
  }

  @computed
  private get downloadLink() {
    if (core.currentUser == null) {
      return { title: trans('beatmapsets.show.details.logged-out') };
    }

    if (this.props.beatmapset.availability?.download_disabled) {
      return { title: trans('beatmapsets.availability.disabled') };
    }

    let type = core.userPreferences.get('beatmapset_download');
    if (type === 'direct' && !core.currentUser.is_supporter) {
      type = 'all';
    }

    let url: string;
    let titleVariant: string;

    if (type === 'direct') {
      url = beatmapsetDownloadDirect(this.props.beatmapset.id);
      titleVariant = 'direct';
    } else {
      const params: Record<string, string|number> = {
        beatmapset: this.props.beatmapset.id,
      };

      if (this.props.beatmapset.video) {
        if (type === 'no_video') {
          params.noVideo = 1;
          titleVariant = 'no_video';
        } else {
          titleVariant = 'video';
        }
      } else {
        titleVariant = 'all';
      }

      url = route('beatmapsets.download', params);
    }

    return {
      title: trans(`beatmapsets.panel.download.${titleVariant}`),
      url,
    };
  }

  @computed
  private get favourite() {
    return this.props.beatmapset.has_favourited
      ? {
        icon: 'fas fa-heart',
        toggleTitleVariant: 'unfavourite',
      }
      : {
        icon: 'far fa-heart',
        toggleTitleVariant: 'favourite',
      };
  }

  @computed
  private get groupedBeatmaps() {
    return groupBeatmaps(this.props.beatmapset.beatmaps);
  }

  @computed
  private get isBeatmapsPopupVisible() {
    return this.beatmapsPopupHover || this.mobileExpanded;
  }

  @computed
  private get nominations() {
    if (this.props.beatmapset.nominations_summary != null) {
      return this.props.beatmapset.nominations_summary;
    }

    if (this.props.beatmapset.nominations != null) {
      if (this.props.beatmapset.nominations.legacy_mode) {
        return this.props.beatmapset.nominations;
      }

      return {
        current: sum(values(this.props.beatmapset.nominations.current)),
        required: sum(values(this.props.beatmapset.nominations.required)),
      };
    }
  }

  @computed
  private get showHypeCounts() {
    return this.props.beatmapset.hype != null;
  }

  @computed
  private get showVisual() {
    return showVisual(this.props.beatmapset);
  }

  @computed
  private get url() {
    return route('beatmapsets.show', { beatmapset: this.props.beatmapset.id });
  }

  constructor(props: Props) {
    super(props);

    makeObservable(this);
  }

  componentWillUnmount() {
    $(document).off('click', this.onDocumentClick);
    Object.values(this.timeouts).forEach((timeout) => {
      window.clearTimeout(timeout);
    });
  }

  render() {
    let blockClass = classWithModifiers('beatmapset-panel', {
      'beatmaps-popup-visible': this.isBeatmapsPopupVisible,
      'mobile-expanded': this.mobileExpanded,
      [`size-${core.userPreferences.get('beatmapset_card_size')}`]: true,
      'with-hype-counts': this.showHypeCounts,
    });
    if (this.showVisual) {
      blockClass += ' js-audio--player';
    }

    return (
      <div
        ref={this.blockRef}
        className={blockClass}
        data-audio-url={this.props.beatmapset.preview_url}
        onMouseLeave={this.beatmapsPopupHide}
        style={{
          '--beatmaps-popup-transition-duration': `${beatmapsPopupTransitionDuration}ms`,
        } as React.CSSProperties}
      >
        {this.renderBeatmapsPopup()}
        {this.renderCover()}
        <div className='beatmapset-panel__content'>
          {this.renderPlayArea()}
          {this.renderInfoArea()}
          {this.renderMenuArea()}
        </div>
        <button className='beatmapset-panel__mobile-expand' onClick={this.onMobileExpandToggleClick} type='button'>
          <span className={`fas fa-angle-${this.mobileExpanded ? 'up' : 'down'}`} />
        </button>
      </div>
    );
  }

  private beatmapsPopupDelayedHide = () => {
    window.clearTimeout(this.timeouts.beatmapsPopup);

    if (!this.beatmapsPopupHover) return;

    this.timeouts.beatmapsPopup = window.setTimeout(action(() => {
      this.beatmapsPopupHover = false;
    }), 500);
  };

  private beatmapsPopupDelayedShow = () => {
    window.clearTimeout(this.timeouts.beatmapsPopup);

    if (this.beatmapsPopupHover) return;

    this.timeouts.beatmapsPopup = window.setTimeout(action(() => {
      this.beatmapsPopupHover = true;
    }), 100);
  };

  @action
  private beatmapsPopupHide = () => {
    window.clearTimeout(this.timeouts.beatmapsPopup);

    this.beatmapsPopupHover = false;
  };

  @action
  private beatmapsPopupKeep = () => {
    window.clearTimeout(this.timeouts.beatmapsPopup);

    this.beatmapsPopupHover = true;
  };

  private onBeatmapsPopupEnter = () => {
    this.beatmapsPopupKeep();
  };

  private onBeatmapsPopupLeave = () => {
    this.beatmapsPopupDelayedHide();
  };

  @action
  private onDocumentClick = (e: JQuery.ClickEvent<Document, unknown, Document, Document | HTMLElement>) => {
    // only for shrinking
    if (!this.mobileExpanded) return;
    // clicking on anything on the panel itself is handled by the relevant element
    if (this.blockRef.current?.contains(e.target)) return;
    // same thing but for beatmaps popup
    if (this.beatmapsPopupRef.current?.contentRef.current?.contains(e.target)) return;

    $(document).off('click', this.onDocumentClick);
    this.mobileExpanded = false;
  };

  private onExtraRowEnter = () => {
    this.beatmapsPopupDelayedShow();
  };

  private onExtraRowLeave = () => {
    this.beatmapsPopupDelayedHide();
  };

  @action
  private onMobileExpandToggleClick = () => {
    this.mobileExpanded = !this.mobileExpanded;
    if (this.mobileExpanded) {
      $(document).on('click', this.onDocumentClick);
    }
  };

  private renderBeatmapsPopup() {
    return (
      <Transition
        in={this.isBeatmapsPopupVisible}
        mountOnEnter
        timeout={{
          enter: 0,
          exit: beatmapsPopupTransitionDuration,
        }}
        unmountOnExit
      >
        {(state) => (
          <BeatmapsPopup
            ref={this.beatmapsPopupRef}
            groupedBeatmaps={this.groupedBeatmaps}
            onMouseEnter={this.onBeatmapsPopupEnter}
            onMouseLeave={this.onBeatmapsPopupLeave}
            parent={this.blockRef.current}
            state={state}
            transitionDuration={beatmapsPopupTransitionDuration}
          />
        )}
      </Transition>
    );
  }

  private renderCover() {
    return (
      <a className='beatmapset-panel__cover-container' href={this.url}>
        <div className='beatmapset-panel__cover-col beatmapset-panel__cover-col--play'>
          <BeatmapsetCover
            beatmapset={this.props.beatmapset}
            modifiers='full'
            size='list'
          />
        </div>
        <div className='beatmapset-panel__cover-col beatmapset-panel__cover-col--info'>
          {core.windowSize.isDesktop &&
            <BeatmapsetCover
              beatmapset={this.props.beatmapset}
              modifiers='full'
              size='card'
            />
          }
        </div>
      </a>
    );
  }

  private renderInfoArea() {
    return (
      <div className='beatmapset-panel__info'>
        <div className='beatmapset-panel__info-row beatmapset-panel__info-row--title'>
          <a className='beatmapset-panel__main-link u-ellipsis-overflow' href={this.url}>
            {getTitle(this.props.beatmapset)}
          </a>
          <div className="beatmapset-panel__badge-container">
            <BeatmapsetBadge beatmapset={this.props.beatmapset} type='nsfw' />
            <BeatmapsetBadge beatmapset={this.props.beatmapset} type='spotlight' />
          </div>
        </div>
        <div className='beatmapset-panel__info-row beatmapset-panel__info-row--artist'>
          <a className='beatmapset-panel__main-link u-ellipsis-overflow' href={this.url}>
            {trans('beatmapsets.show.details.by_artist', { artist: getArtist(this.props.beatmapset) })}
          </a>
          <div className="beatmapset-panel__badge-container">
            <BeatmapsetBadge beatmapset={this.props.beatmapset} type='featured_artist' />
          </div>
        </div>

        <div className='beatmapset-panel__info-row beatmapset-panel__info-row--source'>
          <div className='u-ellipsis-overflow'>
            {this.props.beatmapset.source}
          </div>
        </div>

        <div className='beatmapset-panel__info-row beatmapset-panel__info-row--mapper'>
          <div className='u-ellipsis-overflow'>
            <StringWithComponent
              mappings={{ mapper: <MapperLink beatmapset={this.props.beatmapset} /> }}
              pattern={trans('beatmapsets.show.details.mapped_by')}
            />
          </div>
        </div>

        <div className='beatmapset-panel__info-row beatmapset-panel__info-row--stats'>
          {this.showHypeCounts && this.props.beatmapset.hype != null && (
            <StatsItem
              icon='fas fa-bullhorn'
              title={trans('beatmaps.hype.required_text', {
                current: formatNumber(this.props.beatmapset.hype.current),
                required: formatNumber(this.props.beatmapset.hype.required),
              })}
              type='hype'
              value={this.props.beatmapset.hype.current}
            />
          )}

          {this.showHypeCounts && this.nominations != null && (
            <StatsItem
              icon='fas fa-thumbs-up'
              title={trans('beatmaps.nominations.required_text', {
                current: formatNumber(this.nominations.current),
                required: formatNumber(this.nominations.required),
              })}
              type='nominations'
              value={this.nominations.current}
            />
          )}

          <StatsItem
            icon={this.favourite.icon}
            title={trans('beatmaps.panel.favourites', { count: formatNumber(this.props.beatmapset.favourite_count) })}
            type='favourite-count'
            value={this.props.beatmapset.favourite_count}
          />

          <StatsItem
            icon='fas fa-play-circle'
            title={trans('beatmaps.panel.playcount', { count: formatNumber(this.props.beatmapset.play_count) })}
            type='play-count'
            value={this.props.beatmapset.play_count}
          />

          <div className='beatmapset-panel__stats-item beatmapset-panel__stats-item--date'>
            <span className='beatmapset-panel__stats-item-icon'>
              <i className='fa-fw fas fa-check-circle' />
            </span>
            <TimeWithTooltip dateTime={this.displayDate} />
          </div>
        </div>

        <a
          className='beatmapset-panel__info-row beatmapset-panel__info-row--extra'
          href={this.url}
          onMouseEnter={this.onExtraRowEnter}
          onMouseLeave={this.onExtraRowLeave}
        >
          <div className='beatmapset-panel__extra-item'>
            <div
              className='beatmapset-status beatmapset-status--panel'
              style={{
                '--bg-hsl': `var(--beatmapset-${this.props.beatmapset.status}-bg-hsl)`,
                '--colour': `var(--beatmapset-${this.props.beatmapset.status}-colour)`,
              } as React.CSSProperties}
            >
              {trans(`beatmapsets.show.status.${this.props.beatmapset.status}`)}
            </div>
          </div>
          {[...this.groupedBeatmaps].map(([mode, beatmaps]) => (
            beatmaps.length > 0 && (
              <BeatmapDots
                key={mode}
                beatmaps={beatmaps}
                compact={this.beatmapDotsCompact}
                mode={mode}
              />
            )
          ))}
        </a>
      </div>
    );
  }

  private renderMenuArea() {
    return (
      <div className='beatmapset-panel__menu-container'>
        <div className='beatmapset-panel__menu'>
          {core.currentUser == null ? (
            <span
              className='beatmapset-panel__menu-item beatmapset-panel__menu-item--disabled'
              title={trans('beatmapsets.show.details.favourite_login')}
            >
              <span className={this.favourite.icon} />
            </span>
          ) : (
            <button
              className='beatmapset-panel__menu-item'
              onClick={this.toggleFavourite}
              title={trans(`beatmapsets.show.details.${this.favourite.toggleTitleVariant}`)}
              type='button'
            >
              <span className={this.favourite.icon} />
            </button>
          )}

          {this.downloadLink.url == null ? (
            <span
              className='beatmapset-panel__menu-item beatmapset-panel__menu-item--disabled'
              title={this.downloadLink.title}
            >
              <span className='fas fa-file-download' />
            </span>
          ) : (
            <a
              className='beatmapset-panel__menu-item'
              data-turbolinks='false'
              href={this.downloadLink.url}
              title={this.downloadLink.title}
            >
              <span className='fas fa-file-download' />
            </a>
          )}
        </div>
      </div>
    );
  }

  private renderPlayArea() {
    return (
      <div className='beatmapset-panel__play-container'>
        {this.showVisual && (
          <button className='beatmapset-panel__play js-audio--play' type='button'>
            <span className='play-button' />
          </button>
        )}
        <div className='beatmapset-panel__play-progress'>
          <CircularProgress
            current={0}
            ignoreProgress
            max={1}
            onlyShowAsWarning={false}
            theme='beatmapset-panel'
          />
        </div>
        <div className='beatmapset-panel__play-icons'>
          {this.props.beatmapset.video && <PlayIcon icon='fas fa-film' titleVariant='video' />}
          {this.props.beatmapset.storyboard && <PlayIcon icon='fas fa-image' titleVariant='storyboard' />}
        </div>
      </div>
    );
  }

  private toggleFavourite = () => {
    toggleFavourite(this.props.beatmapset);
  };
}
