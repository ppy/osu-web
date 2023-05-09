// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import HeaderV4 from 'components/header-v4';
import ShowMoreLink from 'components/show-more-link';
import TracklistTrack from 'components/tracklist-track';
import { ArtistTrackWithArtistJson } from 'interfaces/artist-track-json';
import { route } from 'laroute';
import { action, makeObservable, observable, reaction, runInAction } from 'mobx';
import { disposeOnUnmount, observer } from 'mobx-react';
import * as React from 'react';
import { onError } from 'utils/ajax';
import { classWithModifiers } from 'utils/css';
import { trans } from 'utils/lang';
import { navigate } from 'utils/turbolinks';
import SearchForm, { ArtistTrackSearch } from './search-form';
import Sort from './sort-bar';

export interface ArtistTracksIndex {
  artist_tracks: ArtistTrackWithArtistJson[];
  cursor_string: string | null;
  search: ArtistTrackSearch;
}

interface Props {
  container: HTMLElement;
}

interface Data {
  availableGenres: string[];
  index: ArtistTracksIndex;
}

const headerLinks = [
  {
    title: trans('layout.header.artists.index'),
    url: route('artists.index'),
  },
  {
    active: true,
    title: trans('artist.tracks.index._'),
    url: route('artists.tracks.index'),
  },
];

@observer
export default class Main extends React.Component<Props> {
  @observable private data = JSON.parse(this.props.container.dataset.data ?? '') as Data;
  @observable private isNavigating = false;
  @observable private loadingXhr?: JQuery.jqXHR<ArtistTracksIndex> | null = null;

  constructor(props: Props) {
    super(props);

    makeObservable(this);

    disposeOnUnmount(this, reaction(
      () => JSON.stringify(this.data),
      (newDataString) => {
        this.props.container.dataset.data = newDataString;
      },
    ));
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
            availableGenres={this.data.availableGenres}
            initialParams={this.data.index.search}
            onNewSearch={this.onNewSearch}
          />
        </div>

        <div className='osu-page osu-page--artist-track-search-result'>
          {this.data.index.artist_tracks.length === 0 ? (
            <div>
              {trans('artist.tracks.index.form.empty')}
            </div>
          ) : (
            <>
              <Sort
                onNewSearch={this.onNewSearch}
                params={this.data.index.search}
              />

              <div className={classWithModifiers('grid-items', '2', { 'fade-out': this.isNavigating })}>
                {this.data.index.artist_tracks.map((t) => (
                  <TracklistTrack key={t.id} modifiers='large' showAlbum track={t} />
                ))}

                <ShowMoreLink
                  callback={this.handleShowMore}
                  hasMore={this.data.index.cursor_string != null}
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
    this.loadingXhr = $.getJSON(route('artists.tracks.index'), { ...this.data.index.search, cursor_string: this.data.index.cursor_string });

    this.loadingXhr.done((newIndex) => runInAction(() => {
      newIndex.artist_tracks = this.data.index.artist_tracks.concat(newIndex.artist_tracks);
      this.data.index = newIndex;
    })).fail(onError).always(action(() => {
      this.loadingXhr = null;
    }));
  };

  private readonly onNewSearch = (url: string) => {
    navigate(url, true);
    this.isNavigating = true;
  };
}
