// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserJson from './user-json';

export default interface UserAccountHistoryJson {
  actor?: UserJson | null;
  description: string;
  id: number;
  length: number;
  supporting_url?: string;
  timestamp: string;
  type: 'note' | 'restriction' | 'silence';
}
