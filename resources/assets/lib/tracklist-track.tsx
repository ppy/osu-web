// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import ArtistJson from 'interfaces/artist-json';
import ArtistTrackJson, { ArtistTrackWithArtistJson } from 'interfaces/artist-track-json';
import { route } from 'laroute';
import * as React from 'react';
import { classWithModifiers, Modifiers } from 'utils/css';

type TrackJson = {
  artist: ArtistJson;
  track: ArtistTrackJson;
} | {
  track: ArtistTrackWithArtistJson;
};

type Props = {
  modifiers?: Modifiers;
  showAlbum: boolean;
} & TrackJson;

export default class TracklistTrack extends React.PureComponent<Props> {
  static readonly defaultProps = {
    showAlbum: false,
  };

  private get artist() {
    if ('artist' in this.props) {
      return this.props.track.artist ?? this.props.artist;
    }

    return this.props.track.artist;
  }

  render() {
    return (
      <div className={classWithModifiers('artist-track', { original: this.props.track.exclusive }, this.props.modifiers)}>
        <div
          className='artist-track__col artist-track__col--preview'
          style={{
            backgroundImage: osu.urlPresence(this.props.track.cover_url),
          }}
        />

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
            <a href={route('artists.show', { artist: this.artist.id })}>
              {this.artist.name}
            </a>
          </div>
          {this.props.showAlbum && this.props.track.album != null && (
            <div className='artist-track__info'>
              <a href={`${route('artists.show', { artist: this.artist.id })}#album-${this.props.track.album_id}`}>
                {this.props.track.album.title}
              </a>
            </div>
          )}
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

        <div className='artist-track__col artist-track__col--genre'>
          <div className='u-ellipsis-overflow'>{this.props.track.genre}</div>
          <div>{this.props.track.bpm}bpm</div>
        </div>

        <div className='artist-track__col artist-track__col--length'>
          {this.props.track.length}
        </div>

        <div className='artist-track__col artist-track__col--buttons'>
          <button
            className='artist-track__button js-audio--play js-audio--player'
            data-audio-url={this.props.track.preview}
          >
            <span className='fa-fw play-button' />
          </button>

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
