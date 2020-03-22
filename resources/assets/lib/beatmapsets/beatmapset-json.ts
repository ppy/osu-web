// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

interface BeatmapsetCovers {
  card: string;
  cover: string;
  list: string;
  slimcover: string;
}

export interface BeatmapsetJSON extends JSON {
  artist: string;
  covers: BeatmapsetCovers;
  creator: string;
  id: number;
  title: string;
  user_id: number;
}
