// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { BeatmapsetJson, BeatmapsetStatus } from 'beatmapsets/beatmapset-json';
import { CircularProgress } from 'circular-progress';
import { Img2x } from 'img2x';
import BeatmapJson from 'interfaces/beatmap-json';
import GameMode from 'interfaces/game-mode';
import { route } from 'laroute';
import { sum, values } from 'lodash';
import { computed, observable } from 'mobx';
import { observer } from 'mobx-react';
import OsuUrlHelper from 'osu-url-helper';
import * as React from 'react';
import { StringWithComponent } from 'string-with-component';
import TimeWithTooltip from 'time-with-tooltip';
import { UserLink } from 'user-link';
import * as BeatmapHelper from 'utils/beatmap-helper';
import { showVisual, toggleFavourite } from 'utils/beatmapset-helper';
import { classWithModifiers } from 'utils/css';

interface Props {
  beatmapset: BeatmapsetJson;
}

const displayDateMap: Record<BeatmapsetStatus, 'last_updated' | 'ranked_date'> = {
  approved: 'ranked_date',
  graveyard: 'last_updated',
  loved: 'ranked_date',
  pending: 'last_updated',
  qualified: 'ranked_date',
  ranked: 'ranked_date',
  wip: 'last_updated',
};

const ExtraIcon = ({ icon, titleVariant }: { icon: string, titleVariant: string }) => (
  <div
    className='beatmapset-panel__extra-icon'
    title={osu.trans(`beatmapsets.show.info.${titleVariant}`)}
  >
    <i className={icon} />
  </div>
);

const MapperLink = ({ beatmapset }: { beatmapset: BeatmapsetJson }) => (
  <UserLink
    user={{ id: beatmapset.user_id, username: beatmapset.creator }}
    className='beatmapset-panel__mapper-link u-hover'
  />
);

const NsfwBadge = () => (
  <span className='nsfw-badge nsfw-badge--panel'>
    {osu.trans('beatmapsets.nsfw_badge.label')}
  </span>
);

const StatsItem = ({ icon, title, value }: { icon: string, title: string, value: number }) => (
  <div className='beatmapset-panel__stats-item u-hover' title={title}>
    <span className='beatmapset-panel__stats-item-icon'>
      <i className={icon} />
    </span>
    <span>{osu.formatNumberSuffixed(value, 0)}</span>
  </div>
);

@observer
export default class BeatmapsetPanel extends React.Component<Props> {
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
  private get groupedBeatmaps() {
    return BeatmapHelper.group(this.props.beatmapset.beatmaps ?? []);
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

  @observable private beatmapsPopup = false;
  @observable private beatmapsPopupMode: GameMode = 'osu';
  private timeouts: Record<string, number> = {};

  componentWillUnmount() {
    Object.values(this.timeouts).forEach((timeout) => {
      window.clearTimeout(timeout);
    });
  }

  render() {
    let blockClass = classWithModifiers('beatmapset-panel', {
      'with-beatmaps-popup': this.beatmapsPopup,
    });
    if (this.showVisual) {
      blockClass += ' js-audio--player';
    }

    return (
      <div
        className={blockClass}
        data-audio-url={this.props.beatmapset.preview_url}
        onMouseLeave={this.beatmapsPopupHide}
      >
        {this.renderBeatmapsPopup()}
        {this.renderCover()}
        <div className='beatmapset-panel__content'>
          {this.renderPlayArea()}
          {this.renderInfoArea()}
          {this.renderMenuArea()}
        </div>
      </div>
    );
  }

  private beatmapsPopupDelayedHide = () => {
    window.clearTimeout(this.timeouts.beatmapsPopup);

    if (!this.beatmapsPopup) return;

    this.timeouts.beatmapsPopup = window.setTimeout(() => {
      this.beatmapsPopup = false;
    }, 500);
  }

  private beatmapsPopupDelayedShow = () => {
    window.clearTimeout(this.timeouts.beatmapsPopup);

    if (this.beatmapsPopup) return;

    this.timeouts.beatmapsPopup = window.setTimeout(() => {
      this.beatmapsPopup = true;
    }, 500);
  }

  private beatmapsPopupHide = () => {
    window.clearTimeout(this.timeouts.beatmapsPopup);

    this.beatmapsPopup = false;
  }

  private beatmapsPopupKeep = () => {
    window.clearTimeout(this.timeouts.beatmapsPopup);

    this.beatmapsPopup = true;
  }

  private hideImage(e: React.SyntheticEvent<HTMLElement>) {
    // hides img elements that have errored (hides native browser broken-image icons)
    e.currentTarget.style.display = 'none';
  }

  private onBeatmapsEnter = (e: React.MouseEvent<HTMLDivElement>) => {
    this.beatmapsPopupMode = e.currentTarget.dataset.mode as GameMode;

    this.beatmapsPopupDelayedShow();
  }

  private renderBeatmapIcon(beatmap: BeatmapJson) {
    return (
      <div
        className='beatmapset-panel__beatmap'
        style={{
          '--bg': `var(--diff-${BeatmapHelper.getDiffRating(beatmap.difficulty_rating)})`,
        } as React.CSSProperties}
        key={`beatmap-${beatmap.id}`}
      />
    );
  }

  private renderBeatmapIcons() {
    return BeatmapHelper.modes.map((mode) => {
      const beatmaps = this.groupedBeatmaps[mode];

      if (beatmaps == null) return null;

      return (
        <div
          className='beatmapset-panel__beatmaps'
          key={mode}
          onMouseEnter={this.onBeatmapsEnter}
          onMouseLeave={this.beatmapsPopupDelayedHide}
          data-mode={mode}
        >
          <div className='beatmapset-panel__beatmap-icon'>
            <i className={`fal fa-extra-mode-${mode}`} />
          </div>
          {beatmaps.slice(0, 10).map(this.renderBeatmapIcon)}
          {beatmaps.length > 10 && (
            <div className='beatmapset-panel__beatmap-more'>
              +
            </div>
          )}
        </div>
      );
    });
  }

  private renderBeatmapsPopup() {
    return (
      <div
        className='beatmapset-panel__beatmaps-popup-container'
        onMouseEnter={this.beatmapsPopupKeep}
        onMouseLeave={this.beatmapsPopupDelayedHide}
      >
        <div className='beatmapset-panel__beatmaps-popup'>
          {(this.groupedBeatmaps[this.beatmapsPopupMode] ?? []).map((beatmap) => {
            return (
              <a
                key={beatmap.id}
                className='beatmaps-popup-item'
                href={route('beatmaps.show', { beatmap: beatmap.id })}
              >
                <span className='beatmaps-popup-item__col beatmaps-popup-item__col--mode'>
                  <span className={`fal fa-extra-mode-${beatmap.mode}`} />
                </span>
                <span
                  className='beatmaps-popup-item__col beatmaps-popup-item__col--difficulty'
                  style={{
                    '--bg': `var(--diff-${BeatmapHelper.getDiffRating(beatmap.difficulty_rating)})`,
                  } as React.CSSProperties}
                >
                  <span className='beatmaps-popup-item__difficulty-icon'>
                    <span className='fas fa-star' />
                  </span>
                  {osu.formatNumber(beatmap.difficulty_rating)}
                </span>
                <span className='beatmaps-popup-item__col beatmaps-popup-item__col--name'>
                  {beatmap.version}
                </span>
              </a>
            );
          })}
        </div>
      </div>
    );
  }

  private renderCover() {
    return (
      <a href={this.url} className='beatmapset-panel__cover-container'>
        <div className='beatmapset-panel__cover beatmapset-panel__cover--default' />
        {this.showVisual && (
          <Img2x
            className='beatmapset-panel__cover'
            onError={this.hideImage}
            src={this.props.beatmapset.covers.card}
          />
        )}
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
              pattern={osu.trans('beatmapsets.show.details.mapped_by')}
              mappings={{ ':mapper': <MapperLink beatmapset={this.props.beatmapset} key='mapper' /> }}
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
            <TimeWithTooltip dateTime={this.displayDate} format='L' />
          </div>
        </div>

        <div className='beatmapset-panel__info-row'>
          <div
            className='beatmapset-status beatmapset-status--panel'
            style={{
              '--bg': `var(--beatmapset-${this.props.beatmapset.status}-bg)`,
              '--colour': `var(--beatmapset-${this.props.beatmapset.status}-colour)`,
            } as React.CSSProperties}
          >
            {osu.trans(`beatmapsets.show.status.${this.props.beatmapset.status}`)}
          </div>
          <div className='beatmapset-panel__beatmaps-all'>
            {this.renderBeatmapIcons()}
          </div>
        </div>
      </div>
    );
  }

  private renderMenuArea() {
    return (
      <div className='beatmapset-panel__menu-container'>
        <div className='beatmapset-panel__menu'>
          <button
            className='beatmapset-panel__menu-item js-login-required--click'
            onClick={this.toggleFavourite}
            title={osu.trans(`beatmapsets.show.details.${this.favourite.toggleTitleVariant}`)}
            type='button'
          >
            <span className={this.favourite.icon} />
          </button>

          <a
            href={route('beatmapsets.discussion', { beatmapset: this.props.beatmapset.id })}
            className='beatmapset-panel__menu-item'
          >
            <span className='fas fa-comment-alt' />
          </a>

          {this.downloadLink.url == null ? (
            <span
              title={this.downloadLink.title}
              className='beatmapset-panel__menu-item beatmapset-panel__menu-item--disabled'
            >
              <span className='fas fa-file-download' />
            </span>
          ) : (
            <a
              href={this.downloadLink.url}
              title={this.downloadLink.title}
              className='beatmapset-panel__menu-item'
              data-turbolinks='false'
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
        <div className='beatmapset-panel__extra-icons'>
          {this.props.beatmapset.video && <ExtraIcon icon='fas fa-film' titleVariant='video' />}
          {this.props.beatmapset.storyboard && <ExtraIcon icon='fas fa-image' titleVariant='storyboard' />}
        </div>
        {this.showVisual && <button type='button' className='beatmapset-panel__play js-audio--play' />}
        <div className='beatmapset-panel__play-progress'>
          <CircularProgress
            current={0}
            max={1}
            theme='beatmapset-panel'
            onlyShowAsWarning={false}
            ignoreProgress={true}
          />
        </div>
      </div>
    );
  }

  private toggleFavourite = () => {
    if (currentUser.id == null) return;

    toggleFavourite(this.props.beatmapset);
  }
}
