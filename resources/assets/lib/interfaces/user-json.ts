// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

export default interface UserJSON {
  avatar_url: string;
  blocks?: any[];
  country_code: string; // TODO: country object?
  id: number;
  is_active: boolean;
  is_admin: boolean;
  is_bot: boolean;
  is_moderator: boolean;
  is_online: boolean;
  is_supporter: boolean;
  pm_friends_only: boolean;
  profile_colour: string;
  username: string;
}
