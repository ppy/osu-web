// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import HeaderV4 from 'header-v4';
import { ArtistTrackWithArtistJson } from 'interfaces/artist-track-json';
import { route } from 'laroute';
import { action, makeObservable, observable } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import ShowMoreLink from 'show-more-link';
import TracklistTrack from 'tracklist-track';
import { jsonClone } from 'utils/json';
import SearchForm, { ArtistTrackSearch } from './search-form';
import Sort from './sort';

export interface ArtistTracksIndex {
  artist_tracks: ArtistTrackWithArtistJson[];
  cursor: unknown;
  search: ArtistTrackSearch;
}

interface Props {
  availableGenres: string[];
  container: HTMLElement;
  data: ArtistTracksIndex;
}

const headerLinks = [
  {
    title: osu.trans('layout.header.artists.index'),
    url: route('artists.index'),
  },
  {
    active: true,
    title: osu.trans('artist.tracks.index._'),
    url: route('artists.tracks.index'),
  },
];

@observer
export default class Main extends React.Component<Props> {
  @observable private data = jsonClone(this.props.data);
  @observable private loadingXhr?: JQuery.jqXHR | null = null;

  constructor(props: Props) {
    super(props);

    makeObservable(this);
  }

  componentWillUnmount() {
    this.loadingXhr?.abort();
  }

  render() {
    return (
      <>
        <HeaderV4 links={headerLinks} theme='artists' />

        <div className='osu-page osu-page--header'>
          <SearchForm
            availableGenres={this.props.availableGenres}
            initialParams={this.props.data.search}
          />
        </div>

        <div className='osu-page osu-page--generic'>
          {this.data.artist_tracks.length === 0 ? (
            <div>
              {osu.trans('artist.tracks.index.form.empty')}
            </div>
          ) : (
            <>
              <Sort params={this.props.data.search} />

              <div className='grid-items grid-items--2'>
                {this.data.artist_tracks.map((t) => (
                  <TracklistTrack key={t.id} modifiers='large' showAlbum track={t} />
                ))}

                <ShowMoreLink
                  callback={this.handleShowMore}
                  hasMore={this.data.cursor != null}
                  loading={this.loadingXhr != null}
                  modifiers='centre-10'
                />
              </div>
            </>
          )}
        </div>
      </>
    );
  }

  @action
  private readonly handleShowMore = () => {
    this.loadingXhr = $.getJSON(route('artists.tracks.index'), { ...this.data.search, cursor: this.data.cursor })
      .done(action((newData: ArtistTracksIndex) => {
        newData.artist_tracks = this.data.artist_tracks.concat(newData.artist_tracks);
        this.data = newData;
        this.props.container.dataset.props = JSON.stringify({ data: this.data });
      })).fail(osu.ajaxError)
      .always(action(() => {
        this.loadingXhr = null;
      }));
  };
}
