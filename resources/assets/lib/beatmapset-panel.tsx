// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { BeatmapsetJson, BeatmapsetStatus } from 'beatmapsets/beatmapset-json';
import { Img2x } from 'img2x';
import { route } from 'laroute';
import { sum, values } from 'lodash';
import { observer } from 'mobx-react';
import OsuUrlHelper from 'osu-url-helper';
import * as React from 'react';
import { StringWithComponent } from 'string-with-component';
import TimeWithTooltip from 'time-with-tooltip';
import * as BeatmapHelper from 'utils/beatmap-helper';
import { showVisual, toggleFavourite } from 'utils/beatmapset-helper';

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

@observer
export default class BeatmapsetPanel extends React.PureComponent<Props> {
  render() {
    const beatmapset = this.props.beatmapset;
    const shouldShowVisual = showVisual(beatmapset);
    const showHypeCounts = beatmapset.hype != null;
    const nominations = showHypeCounts ? this.getNominations() : null;
    const downloadLink = this.getDownloadLink();
    const groupedBeatmaps = BeatmapHelper.group(beatmapset.beatmaps ?? []);
    const url = route('beatmapsets.show', { beatmapset: beatmapset.id});
    const displayDateAttribute = displayDateMap[beatmapset.status];
    const favouriteIcon = this.props.beatmapset.has_favourited ? 'fas fa-heart' : 'far fa-heart';
    const favouriteTitleVariant = this.props.beatmapset.has_favourited ? 'unfavourite' : 'favourite';

    return (
      <div
        className={`beatmapset-panel ${shouldShowVisual ? 'js-audio--player' : ''}`}
        data-audio-url={beatmapset.preview_url}
      >
        <a
          href={url}
          className='beatmapset-panel__cover-container'
        >
          <div className='beatmapset-panel__cover beatmapset-panel__cover--default' />
          {shouldShowVisual && (
            <Img2x
              className='beatmapset-panel__cover'
              onError={this.hideImage}
              src={beatmapset.covers.card}
            />
          )}
        </a>
        <div className='beatmapset-panel__content'>
          <div className='beatmapset-panel__play-container'>
            <div className='beatmapset-panel__extra-icons'>
              {beatmapset.video && (
                <div
                  className='beatmapset-panel__extra-icon'
                  title={osu.trans('beatmapsets.show.info.video')}
                >
                  <i className='fas fa-film' />
                </div>
              )}
              {beatmapset.storyboard && (
                <div
                  className='beatmapset-panel__extra-icon'
                  title={osu.trans('beatmapsets.show.info.storyboard')}
                >
                  <i className='fas fa-image' />
                </div>
              )}
            </div>
            {shouldShowVisual && (
              <button
                type='button'
                className='beatmapset-panel__play js-audio--play'
              />
            )}
          </div>
          <div className='beatmapset-panel__info'>
            <div className='beatmapset-panel__info-row beatmapset-panel__info-row--title'>
              <a
                className='beatmapset-panel__main-link u-ellipsis-overflow'
                href={url}
              >
                {BeatmapHelper.getTitle(beatmapset)}
              </a>
              {beatmapset.nsfw && (
                <span className='nsfw-badge nsfw-badge--panel'>
                  {osu.trans('beatmapsets.nsfw_badge.label')}
                </span>
              )}
            </div>
            <div className='beatmapset-panel__info-row beatmapset-panel__info-row--artist'>
              <a
                className='beatmapset-panel__main-link u-ellipsis-overflow'
                href={url}
              >
                {osu.trans('beatmapsets.show.details.by_artist', { artist: BeatmapHelper.getArtist(beatmapset) })}
              </a>
            </div>
            <div className='beatmapset-panel__info-row beatmapset-panel__info-row--mapper'>
              <div className='u-ellipsis-overflow'>
                <StringWithComponent
                  pattern={osu.trans('beatmapsets.show.details.mapped_by')}
                  mappings={{
                    ':mapper':
                      <a
                        key='mapper'
                        href={route('users.show', { user: beatmapset.user_id })}
                        className='beatmapset-panel__mapper-link u-hover js-usercard'
                        data-user-id={beatmapset.user_id}
                      >
                        {beatmapset.creator}
                      </a>,
                  }}
                />
              </div>
            </div>

            <div className='beatmapset-panel__info-row beatmapset-panel__info-row--stats'>
              {showHypeCounts && beatmapset.hype != null && this.renderStatsItem({
                icon: 'fas fa-bullhorn',
                title: osu.trans('beatmaps.hype.required_text', {
                  current: osu.formatNumber(beatmapset.hype.current),
                  required: osu.formatNumber(beatmapset.hype.required),
                }),
                value: beatmapset.hype.current,
              })}

              {showHypeCounts && nominations != null && this.renderStatsItem({
                icon: 'fas fa-thumbs-up',
                title: osu.trans('beatmaps.nominations.required_text', {
                  current: osu.formatNumber(nominations.current),
                  required: osu.formatNumber(nominations.required),
                }),
                value: nominations.current,
              })}

              {this.renderStatsItem({
                icon: 'fas fa-play-circle',
                title: osu.trans('beatmaps.panel.playcount', { count: osu.formatNumber(beatmapset.play_count) }),
                value: beatmapset.play_count,
              })}

              {this.renderStatsItem({
                icon: favouriteIcon,
                title: osu.trans('beatmaps.panel.favourites', { count: osu.formatNumber(beatmapset.favourite_count) }),
                value: beatmapset.favourite_count,
              })}

              <div className='beatmapset-panel__stats-item'>
                <span className='beatmapset-panel__stats-item-icon'>
                  <i className='fas fa-fw fa-check-circle' />
                </span>
                <TimeWithTooltip dateTime={beatmapset[displayDateAttribute]} format='L' />
              </div>
            </div>

            <div className='beatmapset-panel__info-row'>
              <div
                className='beatmapset-status beatmapset-status--panel'
                style={{
                  '--bg': `var(--beatmapset-${beatmapset.status}-bg)`,
                  '--colour': `var(--beatmapset-${beatmapset.status}-colour)`,
                } as React.CSSProperties}
              >
                {osu.trans(`beatmapsets.show.status.${beatmapset.status}`)}
              </div>
              <div className='beatmapset-panel__beatmaps-all'>
                {BeatmapHelper.modes.map((mode) => {
                  const beatmaps = groupedBeatmaps[mode];

                  if (beatmaps == null) {
                    return null;
                  }

                  return (
                    <div className='beatmapset-panel__beatmaps' key={mode}>
                      <div className='beatmapset-panel__beatmap-icon'>
                        <i className={`fal fa-extra-mode-${mode}`} />
                      </div>
                      {beatmaps.map((beatmap) => (
                        <div
                          className='beatmapset-panel__beatmap'
                          style={{
                            '--bg': `var(--diff-${BeatmapHelper.getDiffRating(beatmap.difficulty_rating)})`,
                          } as React.CSSProperties}
                          key={`beatmap-${beatmap.id}`}
                        />
                      ))}
                    </div>
                  );
                })}
              </div>
            </div>
          </div>

          <div className='beatmapset-panel__menu-container'>
            <div className='beatmapset-panel__menu'>
              <button
                className='beatmapset-panel__menu-item js-login-required--click'
                onClick={this.toggleFavourite}
                title={osu.trans(`beatmapsets.show.details.${favouriteTitleVariant}`)}
                type='button'
              >
                <span className={favouriteIcon} />
              </button>

              <a
                href={route('beatmapsets.discussion', { beatmapset: beatmapset.id })}
                className='beatmapset-panel__menu-item'
              >
                <span className='fas fa-comment-alt' />
              </a>

              {downloadLink.url != null ? (
                <a
                  href={downloadLink.url}
                  title={downloadLink.title}
                  className='beatmapset-panel__menu-item'
                  data-turbolinks='false'
                >
                  <span className='fas fa-file-download' />
                </a>
              ) : (
                <span
                  title={downloadLink.title}
                  className='beatmapset-panel__menu-item beatmapset-panel__menu-item--disabled'
                >
                  <span className='fas fa-file-download' />
                </span>
              )}
            </div>
          </div>
        </div>
      </div>
    );
  }

  private getDownloadLink() {
    if (currentUser.id == null) {
      return { title: osu.trans('beatmapsets.show.details.logged-out') };
    }

    const beatmapset = this.props.beatmapset;

    if (beatmapset.availability?.download_disabled) {
      return { title: osu.trans('beatmapsets.availability.disabled') };
    }

    let type = currentUser.user_preferences.beatmapset_download;
    if (type === 'direct' && !currentUser.is_supporter) {
      type = 'all';
    }

    let url: string;
    let title: string;

    if (type === 'direct') {
        url = OsuUrlHelper.beatmapsetDownloadDirect(beatmapset.id);
        title = osu.trans('beatmapsets.panel.download.direct');
    } else {
      if (beatmapset.video) {
        if (type === 'no_video') {
          url = route('beatmapsets.download', { beatmapset: beatmapset.id, noVideo: 1 });
          title = osu.trans('beatmapsets.panel.download.no_video');
        } else {
          url = route('beatmapsets.download', { beatmapset: beatmapset.id });
          title = osu.trans('beatmapsets.panel.download.video');
        }
      } else {
        url = route('beatmapsets.download', { beatmapset: beatmapset.id });
        title = osu.trans('beatmapsets.panel.download.all');
      }
    }

    return { url, title };
  }

  private getNominations() {
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
  private hideImage(e: React.SyntheticEvent<HTMLElement>) {
    // hides img elements that have errored (hides native browser broken-image icons)
    e.currentTarget.style.display = 'none';
  }

  private renderStatsItem({ icon, title, value }: { icon: string, title: string, value: number }) {
    return (
      <div
        className='beatmapset-panel__stats-item u-hover'
        title={title}
      >
        <span className='beatmapset-panel__stats-item-icon'>
          <i className={icon} />
        </span>
        <span>{osu.formatNumberSuffixed(value, 0)}</span>
      </div>
    );
  }

  private toggleFavourite = () =>
    toggleFavourite(this.props.beatmapset)
}
