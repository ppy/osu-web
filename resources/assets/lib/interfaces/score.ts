// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserJSON from './user-json';

export default interface Score {
  id: string;
  mode: string;
  replay: boolean;
  user: UserJSON;
  user_id: number;
}
