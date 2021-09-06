// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import ArtistJson from 'interfaces/artist-json';
import ArtistTrackJson from 'interfaces/artist-track-json';
import * as React from 'react';
import TracklistTrack from 'tracklist-track';

interface Props {
  artist: ArtistJson;
  tracks: ArtistTrackJson[];
}

export default class Tracklist extends React.PureComponent<Props> {
  render() {
    if (this.props.tracks.length === 0) {
      return null;
    }

    return (
      <div className='artist-tracks js-audio--group'>
        {this.props.tracks.map((track) => (
          <div key={track.id} className='artist-tracks__item'>
            <TracklistTrack
              artist={this.props.artist}
              track={track}
            />
          </div>
        ))}
      </div>
    );
  }
}
