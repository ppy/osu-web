// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { ArtistTrackSearch } from './search-form';
import { route } from 'laroute';

export default function makeLink(params: ArtistTrackSearch) {
  return `${route('artists.tracks.index')}?${$.param(params)}`;
}
