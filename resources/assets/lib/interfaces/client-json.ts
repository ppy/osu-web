// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserJSON from './user-json';

export interface ClientJSON {
  id: number;
  name: string | null;
  scopes: string[];
  user: UserJSON;
  user_id: number;
}
