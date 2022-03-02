// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import ArtistTrackJson from 'interfaces/artist-track-json';
import * as moment from 'moment';
import * as React from 'react';

interface Props {
  track: ArtistTrackJson;
}

export default class Main extends React.Component<Props> {
  render() {
    return (
      <div className='artist-track-v2'>
        {this.renderCover()}
        {this.renderNameInfo()}
        {this.renderNewBadge()}
        {this.renderBpmGenreInfo()}
      </div>
    );
  }

  private renderBpmGenreInfo() {
    return (
      <div className='artist-track-v2__column'>
        <p>{this.props.track.genre}</p>
        <p>{osu.formatNumber(this.props.track.bpm)}bpm</p>
      </div>
    );
  }

  private renderCover() {
    return (
      <div
        className='artist-track-v2__column artist-track-v2__column--cover'
        style={{
          backgroundImage: osu.urlPresence(this.props.track.cover_url),
        }}
      />
    );
  }

  private renderNameInfo() {
    return (
      <div className='artist-track-v2__column'>
        <p>{this.props.track.title}</p>
        <p>{this.props.track.artist_id}</p>
      </div>
    );
  }

  private renderNewBadge() {
    const updatedAt = moment(this.props.track.updated_at);
    return (
      <div className='artist-track-v2__column'>
        {updatedAt.isAfter(moment().subtract(1, 'month')) && (
          <div>
            NEW
          </div>
        )}
      </div>
    );
  }
}
