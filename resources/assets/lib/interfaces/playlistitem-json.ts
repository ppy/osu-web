// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapJson from 'interfaces/beatmap-json';

export default interface PlaylistItemJson {
  allowed_mods: unknown;
  beatmap_id: number;
  beatmap?: BeatmapJson;
  expired: boolean;
  id: number;
  required_mods: unknown;
  room_id: number;
  ruleset_id: number;
}

