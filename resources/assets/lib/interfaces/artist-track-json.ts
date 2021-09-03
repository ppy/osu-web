// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

export default interface ArtistTrackJson {
  album_id: number | null;
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
  version: string | null;
}
