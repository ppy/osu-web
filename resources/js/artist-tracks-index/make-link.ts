// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { route } from 'laroute';
import { ArtistTrackSearch } from './search-form';

export default function makeLink(params: ArtistTrackSearch) {
  return `${route('artists.tracks.index')}?${$.param(params)}`;
}
