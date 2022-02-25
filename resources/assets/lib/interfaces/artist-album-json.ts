// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

export default interface ArtistAlbumJson {
  artist_id: number;
  cover_url: string | null;
  genre: string;
  id: number;
  is_new: boolean;
  title: string;
  title_romanized: string | null;
}
