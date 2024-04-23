// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { route } from 'laroute';
import { ArtistTrackSearch } from './search-form';

export default function makeLink(params: ArtistTrackSearch) {
  const urlParams: Partial<ArtistTrackSearch> = { ...params };
  if (!urlParams.exclusive_only) {
    delete urlParams.exclusive_only;
  }
  if (urlParams.is_default_sort) {
    // no need to set sort params if default
    delete urlParams.sort;
  }
  // backend automatically determines this
  delete urlParams.is_default_sort;

  return route('artists.tracks.index', urlParams);
}
