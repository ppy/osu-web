// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapsPopup from 'beatmapset-panel/beatmaps-popup';
import { BeatmapsetJson, BeatmapsetStatus } from 'beatmapsets/beatmapset-json';
import { CircularProgress } from 'circular-progress';
import { Img2x } from 'img2x';
import BeatmapJson from 'interfaces/beatmap-json';
import BeatmapsetExtendedJson from 'interfaces/beatmapset-extended-json';
import GameMode from 'interfaces/game-mode';
import { route } from 'laroute';
import { sum, values } from 'lodash';
import { computed, observable } from 'mobx';
import { observer } from 'mobx-react';
import OsuUrlHelper from 'osu-url-helper';
import * as React from 'react';
import { Transition } from 'react-transition-group';
import { StringWithComponent } from 'string-with-component';
import TimeWithTooltip from 'time-with-tooltip';
import { UserLink } from 'user-link';
import * as BeatmapHelper from 'utils/beatmap-helper';
import { showVisual, toggleFavourite } from 'utils/beatmapset-helper';
import { classWithModifiers } from 'utils/css';
import { formatNumberSuffixed, make2x } from 'utils/html';

interface Props {
  beatmapset: BeatmapsetExtendedJson;
}

export interface BeatmapGroup {
  beatmaps: BeatmapJson[];
  mode: GameMode;
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

// hides img elements that have errored (hides native browser broken-image icons)
const hideImage = (e: React.SyntheticEvent<HTMLElement>) => {
  e.currentTarget.style.display = 'none';
};

const BeatmapDot = observer(({ beatmap }: { beatmap: BeatmapJson }) => (
  <div
    className='beatmapset-panel__beatmap-dot'
    style={{
      '--bg': `var(--diff-${BeatmapHelper.getDiffRating(beatmap.difficulty_rating)})`,
    } as React.CSSProperties}
  />
));

const BeatmapDots = observer(({ compact, group }: { compact: boolean; group: BeatmapGroup }) => (
  <div className='beatmapset-panel__extra-item beatmapset-panel__extra-item--dots'>
    <div className='beatmapset-panel__beatmap-icon'>
      <i className={`fal fa-extra-mode-${group.mode}`} />
    </div>
    {compact ? (
      <div className='beatmapset-panel__beatmap-count'>
        {group.beatmaps.length}
      </div>
    ) : (
      group.beatmaps.map((beatmap) => <BeatmapDot key={beatmap.id} beatmap={beatmap} />)
    )}
  </div>
));

const MapperLink = observer(({ beatmapset }: { beatmapset: BeatmapsetJson }) => (
  <UserLink
    className='beatmapset-panel__mapper-link u-hover'
    user={{ id: beatmapset.user_id, username: beatmapset.creator }}
  />
));

const NsfwBadge = () => (
  <span className='nsfw-badge nsfw-badge--panel'>
    {osu.trans('beatmapsets.nsfw_badge.label')}
  </span>
);

const PlayIcon = ({ icon, titleVariant }: { icon: string; titleVariant: string }) => (
  <div
    className='beatmapset-panel__play-icon'
    title={osu.trans(`beatmapsets.show.info.${titleVariant}`)}
  >
    <i className={icon} />
  </div>
);

const StatsItem = ({ icon, title, value }: { icon: string; title: string; value: number }) => (
  <div className='beatmapset-panel__stats-item' title={title}>
    <span className='beatmapset-panel__stats-item-icon'>
      <i className={icon} />
    </span>
    <span>{formatNumberSuffixed(value, undefined, { maximumFractionDigits: 1, minimumFractionDigits: 0 })}</span>
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

    return this.props.beatmapset[attribute];
  }

  @computed
  private get downloadLink() {
    if (currentUser.id == null) {
      return { title: osu.trans('beatmapsets.show.details.logged-out') };
    }

    if (this.props.beatmapset.availability?.download_disabled) {
      return { title: osu.trans('beatmapsets.availability.disabled') };
    }

    let type = currentUser.user_preferences.beatmapset_download;
    if (type === 'direct' && !currentUser.is_supporter) {
      type = 'all';
    }

    let url: string;
    let titleVariant: string;

    if (type === 'direct') {
      url = OsuUrlHelper.beatmapsetDownloadDirect(this.props.beatmapset.id);
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
      title: osu.trans(`beatmapsets.panel.download.${titleVariant}`),
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
  private get groupedBeatmaps(): BeatmapGroup[] {
    const byMode = BeatmapHelper.group(this.props.beatmapset.beatmaps ?? []);

    const ret: BeatmapGroup[] = [];

    BeatmapHelper.modes.forEach((mode) => {
      const beatmaps = byMode[mode];

      if (beatmaps != null) {
        ret.push({ beatmaps, mode });
      }
    });

    return ret;
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
    return route('beatmapsets.show', { beatmapset: this.props.beatmapset.id});
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

    this.timeouts.beatmapsPopup = window.setTimeout(() => {
      this.beatmapsPopupHover = false;
    }, 500);
  };

  private beatmapsPopupDelayedShow = () => {
    window.clearTimeout(this.timeouts.beatmapsPopup);

    if (this.beatmapsPopupHover) return;

    this.timeouts.beatmapsPopup = window.setTimeout(() => {
      this.beatmapsPopupHover = true;
    }, 100);
  };

  private beatmapsPopupHide = () => {
    window.clearTimeout(this.timeouts.beatmapsPopup);

    this.beatmapsPopupHover = false;
  };

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

  private onDocumentClick = (e: JQuery.ClickEvent) => {
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
          <div className='beatmapset-panel__cover beatmapset-panel__cover--default' />
          {this.showVisual && (
            <img
              className='beatmapset-panel__cover'
              onError={hideImage}
              src={make2x(this.props.beatmapset.covers.list)}
            />
          )}
        </div>
        <div className='beatmapset-panel__cover-col beatmapset-panel__cover-col--info'>
          <div className='beatmapset-panel__cover beatmapset-panel__cover--default' />
          {this.showVisual && (
            <Img2x
              className='beatmapset-panel__cover'
              onError={hideImage}
              src={this.props.beatmapset.covers.card}
            />
          )}
        </div>
      </a>
    );
  }

  private renderInfoArea() {
    return (
      <div className='beatmapset-panel__info'>
        <div className='beatmapset-panel__info-row beatmapset-panel__info-row--title'>
          <a className='beatmapset-panel__main-link u-ellipsis-overflow' href={this.url}>
            {BeatmapHelper.getTitle(this.props.beatmapset)}
          </a>
          {this.props.beatmapset.nsfw && <NsfwBadge />}
        </div>
        <div className='beatmapset-panel__info-row beatmapset-panel__info-row--artist'>
          <a className='beatmapset-panel__main-link u-ellipsis-overflow' href={this.url}>
            {osu.trans('beatmapsets.show.details.by_artist', { artist: BeatmapHelper.getArtist(this.props.beatmapset) })}
          </a>
        </div>
        <div className='beatmapset-panel__info-row beatmapset-panel__info-row--mapper'>
          <div className='u-ellipsis-overflow'>
            <StringWithComponent
              mappings={{ ':mapper': <MapperLink key='mapper' beatmapset={this.props.beatmapset} /> }}
              pattern={osu.trans('beatmapsets.show.details.mapped_by')}
            />
          </div>
        </div>

        <div className='beatmapset-panel__info-row beatmapset-panel__info-row--stats'>
          {this.showHypeCounts && this.props.beatmapset.hype != null && (
            <StatsItem
              icon='fas fa-bullhorn'
              title={osu.trans('beatmaps.hype.required_text', {
                current: osu.formatNumber(this.props.beatmapset.hype.current),
                required: osu.formatNumber(this.props.beatmapset.hype.required),
              })}
              value={this.props.beatmapset.hype.current}
            />
          )}

          {this.showHypeCounts && this.nominations != null && (
            <StatsItem
              icon='fas fa-thumbs-up'
              title={osu.trans('beatmaps.nominations.required_text', {
                current: osu.formatNumber(this.nominations.current),
                required: osu.formatNumber(this.nominations.required),
              })}
              value={this.nominations.current}
            />
          )}

          <StatsItem
            icon='fas fa-play-circle'
            title={osu.trans('beatmaps.panel.playcount', { count: osu.formatNumber(this.props.beatmapset.play_count) })}
            value={this.props.beatmapset.play_count}
          />

          <StatsItem
            icon={this.favourite.icon}
            title={osu.trans('beatmaps.panel.favourites', { count: osu.formatNumber(this.props.beatmapset.favourite_count) })}
            value={this.props.beatmapset.favourite_count}
          />

          <div className='beatmapset-panel__stats-item'>
            <span className='beatmapset-panel__stats-item-icon'>
              <i className='fas fa-fw fa-check-circle' />
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
                '--bg': `var(--beatmapset-${this.props.beatmapset.status}-bg)`,
                '--colour': `var(--beatmapset-${this.props.beatmapset.status}-colour)`,
              } as React.CSSProperties}
            >
              {osu.trans(`beatmapsets.show.status.${this.props.beatmapset.status}`)}
            </div>
          </div>
          {this.groupedBeatmaps.map((group) => (
            <BeatmapDots
              key={group.mode}
              compact={this.beatmapDotsCompact}
              group={group}
            />
          ))}
        </a>
      </div>
    );
  }

  private renderMenuArea() {
    return (
      <div className='beatmapset-panel__menu-container'>
        <div className='beatmapset-panel__menu'>
          {currentUser.id == null ? (
            <span
              className='beatmapset-panel__menu-item beatmapset-panel__menu-item--disabled'
              title={osu.trans('beatmapsets.show.details.favourite_login')}
            >
              <span className={this.favourite.icon} />
            </span>
          ) : (
            <button
              className='beatmapset-panel__menu-item'
              onClick={this.toggleFavourite}
              title={osu.trans(`beatmapsets.show.details.${this.favourite.toggleTitleVariant}`)}
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
        {this.showVisual && <button className='beatmapset-panel__play js-audio--play' type='button' />}
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
