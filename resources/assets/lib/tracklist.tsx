// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import ArtistTrackJson from 'interfaces/artist-track-json';
import * as React from 'react';
import TracklistTrack from 'tracklist-track';

interface Props {
  tracks: ArtistTrackJson[];
}

export default class Tracklist extends React.PureComponent<Props> {
  render() {
    if (this.props.tracks.length === 0) {
      return null;
    }

    return (
      <div className='tracklist js-audio--group'>
        <table className='tracklist__table'>
          <thead>
            <tr className='tracklist__row--header'>
              <th className='tracklist__col tracklist__col--preview' />
              <th className='tracklist__col tracklist__col--title'>{osu.trans('artist.tracklist.title')}</th>
              <th className='tracklist__col tracklist__col--length'>{osu.trans('artist.tracklist.length')}</th>
              <th className='tracklist__col tracklist__col--bpm'>{osu.trans('artist.tracklist.bpm')}</th>
              <th className='tracklist__col tracklist__col--genre'>{osu.trans('artist.tracklist.genre')}</th>
              <th className='tracklist__col tracklist__col--dl' />
            </tr>
          </thead>
          <tbody>
            {this.props.tracks.map((track) => <TracklistTrack key={track.id} track={track} /> )}
          </tbody>
        </table>
      </div>
    );
  }
}
