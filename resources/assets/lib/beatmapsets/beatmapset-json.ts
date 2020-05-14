// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import GenreJson from 'interfaces/genre-json';
import LanguageJson from 'interfaces/language-json';

interface BeatmapsetCovers {
  card: string;
  cover: string;
  list: string;
  slimcover: string;
}

export interface BeatmapsetJson {
  artist: string;
  covers: BeatmapsetCovers;
  creator: string;
  genre: GenreJson;
  id: number;
  language: LanguageJson;
  title: string;
  user_id: number;
}
