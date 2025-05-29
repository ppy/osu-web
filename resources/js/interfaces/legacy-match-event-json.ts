// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import LegacyMatchGameJson from './legacy-match-game-json';

export type LegacyMatchEventType =
  | 'host-changed'
  | 'match-created'
  | 'match-disbanded'
  | 'other'
  | 'player-joined'
  | 'player-kicked'
  | 'player-left';

export interface LegacyMatchEventDetail {
  text?: string;
  type: LegacyMatchEventType;
}

export default interface LegacyMatchEventJson {
  detail: LegacyMatchEventDetail;
  game?: LegacyMatchGameJson;
  id: number;
  timestamp: string;
  user_id: null | number;
}
