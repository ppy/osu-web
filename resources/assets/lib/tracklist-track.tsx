// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import ArtistTrackJson from 'interfaces/artist-track-json';
import * as React from 'react';
import TrackPreview from 'track-preview';
import { classWithModifiers } from 'utils/css';

interface Props {
  track: ArtistTrackJson;
}

export default class TracklistTrack extends React.PureComponent<Props> {
  render() {
    return (
      <tr className='tracklist__row'>
        <td>
          <TrackPreview track={this.props.track} />
        </td>
        <td className={classWithModifiers('tracklist__title', { exclusive: this.props.track.exclusive })}>
          {this.props.track.exclusive && (
            <span
              className='fal fa-fw fa-extra-osu tracklist__exclusive-icon'
              title={osu.trans('artist.songs.original')}
            />
          )}
          <span className='tracklist__name u-ellipsis-overflow'>
            {this.props.track.title}
            {osu.present(this.props.track.version) && (
              <>
                {' '}
                <span className='tracklist__version'>
                  {this.props.track.version}
                </span>
              </>
            )}
          </span>
          {this.props.track.is_new && (
            <span className='tracklist__new'>
              <span className='pill-badge pill-badge--yellow pill-badge--with-shadow'>
                {osu.trans('common.badges.new')}
              </span>
            </span>
          )}
        </td>

        <td className='tracklist__length'>{this.props.track.length}</td>
        <td className='tracklist__bpm'>{this.props.track.bpm}bpm</td>
        <td className='tracklist__genre u-ellipsis-overflow'>{this.props.track.genre}</td>
        <td className='tracklist__dl'>
          {this.props.track.osz != null ? (
            <a className='tracklist__link' href={this.props.track.osz} title={osu.trans('artist.beatmaps.download')}>
              <span className='fas fa-fw fa-download' />
            </a>
          ) : (
            <span className='tracklist__link--disabled' title={osu.trans('artist.beatmaps.download-na')}>
              <span className='fas fa-fw fa-download' />
            </span>
          )}
        </td>
      </tr>
    );
  }
}
