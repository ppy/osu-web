// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import ArtistJson from 'interfaces/artist-json';
import ArtistTrackJson from 'interfaces/artist-track-json';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';

interface Props {
  artist: ArtistJson;
  track: ArtistTrackJson;
}

export default class TracklistTrack extends React.PureComponent<Props> {
  private get artist() {
    return this.props.track.artist ?? this.props.artist;
  }

  render() {
    let blockClass = classWithModifiers('artist-track', { original: this.props.track.exclusive });
    blockClass += ' js-audio--player';

    return (
      <div className={blockClass} data-audio-url={this.props.track.preview}>
        <div
          className='artist-track__col artist-track__col--preview'
          style={{
            backgroundImage: osu.urlPresence(this.props.track.cover_url),
          }}
        >
          <button className='artist-track__button artist-track__button--play js-audio--play'>
            <span className='fa-fw play-button' />
          </button>
        </div>


        <div className='artist-track__col artist-track__col--names'>
          <div className='artist-track__title u-ellipsis-overflow'>
            {this.props.track.title}
            {osu.present(this.props.track.version) && (
              <>
                {' '}
                <span className='artist-track__version'>
                  {this.props.track.version}
                </span>
              </>
            )}
          </div>
          <div className='artist-track__info'>
            {this.artist.name}
          </div>
        </div>

        <div className='artist-track__col artist-track__col--badges'>
          {this.props.track.exclusive && (
            <span
              className='pill-badge pill-badge--pink pill-badge--with-shadow'
              title={osu.trans('artist.songs.original')}
            >
              {osu.trans('artist.songs.original_badge')}
            </span>
          )}
          {this.props.track.is_new && (
            <span className='pill-badge pill-badge--yellow pill-badge--with-shadow'>
              {osu.trans('common.badges.new')}
            </span>
          )}
        </div>

        <div className='artist-track__col artist-track__col--details'>
          <div className='u-ellipsis-overflow artist-track__detail artist-track__detail--genre'>
            {this.props.track.genre}
          </div>
          <div className='artist-track__detail artist-track__detail--bpm'>
            {osu.formatNumber(this.props.track.bpm)}bpm
          </div>

          <div className='artist-track__detail artist-track__detail--length'>
            {this.props.track.length}
          </div>
        </div>

        <div className='artist-track__col artist-track__col--buttons'>
          <a
            className='artist-track__button'
            href={this.props.track.osz}
            title={osu.trans('artist.beatmaps.download')}
          >
            <span className='fas fa-fw fa-download' />
          </a>
        </div>
      </div>
    );
  }
}
