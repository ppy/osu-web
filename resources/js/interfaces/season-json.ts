// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { RulesetId } from './ruleset';

export default interface SeasonJson {
  end_date: string | null;
  id: number;
  name: string;
  room_count: number;
  ruleset_id: RulesetId | null;
  start_date: string | null;
  variant: '4k' | '7k' | null;
}
