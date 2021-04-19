// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import GameMode from 'interfaces/game-mode';
import UserJson from 'interfaces/user-json';

export default interface UserJsonExtended extends UserJson {
  country: Country;
  cover: Cover;
  is_admin: boolean;
  is_bng: boolean;
  is_full_bn: boolean;
  is_gmt: boolean;
  is_limited_bn: boolean;
  is_moderator: boolean;
  is_nat: boolean;
  is_restricted: boolean;
  is_silenced: boolean;
  playmode: GameMode | null;
}
