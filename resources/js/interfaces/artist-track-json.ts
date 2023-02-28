// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import ArtistAlbumJson from './artist-album-json';
import ArtistJson from './artist-json';

export type ArtistTrackWithArtistJson = ArtistTrackJson & Required<Pick<ArtistTrackJson, 'artist'>>;

export default interface ArtistTrackJson {
  album: ArtistAlbumJson;
  album_id: number | null;
  artist?: ArtistJson;
  artist_id: number;
  bpm: number;
  cover_url: string;
  exclusive: boolean;
  genre: string;
  id: number;
  is_new: boolean;
  length: number;
  osz: string;
  preview: string;
  title: string;
  updated_at: string;
  version: string | null;
}
