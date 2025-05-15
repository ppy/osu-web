// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapJson from 'interfaces/beatmap-json';
import ModJson from 'interfaces/mod-json';
import ScoreModJson from 'interfaces/score-mod-json';

export default interface PlaylistItemJson {
  allowed_mods: ModJson;
  beatmap?: BeatmapJson;
  beatmap_id: number;
  expired: boolean;
  id: number;
  required_mods: ScoreModJson;
  room_id: number;
  ruleset_id: number;
}
