// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapJson from 'interfaces/beatmap-json';
import GameMode from 'interfaces/game-mode';
import GenreJson from 'interfaces/genre-json';
import LanguageJson from 'interfaces/language-json';

interface BeatmapsetCovers {
  card: string;
  cover: string;
  list: string;
  slimcover: string;
}

interface BaseNominationsInterface {
  legacy_mode: boolean;
  nominated?: boolean;
  required_hype: number;
}

export interface NominationsInterface extends BaseNominationsInterface {
  current: {
    [mode in GameMode]?: number;
  };
  legacy_mode: false;
  required: {
    [mode in GameMode]?: number;
  };
}

export interface LegacyNominationsInterface extends BaseNominationsInterface {
  current: number;
  legacy_mode: true;
  required: number;
}

export type BeatmapsetNominationsInterface =
  NominationsInterface | LegacyNominationsInterface;

export type BeatmapsetStatus =
  'graveyard' | 'wip' | 'pending' | 'ranked' | 'approved' | 'qualified' | 'loved';

// TODO: incomplete
export interface BeatmapsetJson {
  artist: string;
  artist_unicode: string | null;
  beatmaps?: BeatmapJson[];
  covers: BeatmapsetCovers;
  creator: string;
  genre: GenreJson;
  hype?: {
    current: number;
    required: number;
  };
  id: number;
  language: LanguageJson;
  nominations?: BeatmapsetNominationsInterface;
  status: BeatmapsetStatus;
  title: string;
  title_unicode: string | null;
  user_id: number;
}
