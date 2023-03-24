// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserJson from './user-json';

export interface ClientJson {
  id: number;
  name: string | null;
  scopes: string[];
  user: UserJson;
  user_id: number;
}
