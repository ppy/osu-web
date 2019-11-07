/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

import { UserJSON } from 'chat/chat-api-responses';
import { action, observable } from 'mobx';

export default class User {
  @observable avatarUrl: string = '/images/layout/avatar-guest.png'; // TODO: move to a global config store?
  @observable countryCode: string = 'XX';
  @observable id: number;
  @observable isActive: boolean = false;
  @observable isBot: boolean = false;
  @observable isOnline: boolean = false;
  @observable isSupporter: boolean = false;
  @observable loaded: boolean = false;
  @observable pmFriendsOnly: boolean = false;
  @observable profileColour: string = '';
  @observable username: string = '';

  constructor(id: number) {
    this.id = id;
  }

  static fromJSON(json: UserJSON): User {
    const user = Object.create(User.prototype);
    return Object.assign(user, {
      avatarUrl: json.avatar_url,
      countryCode: json.country_code,
      id: json.id,
      isActive: json.is_active,
      isBot: json.is_bot,
      isOnline: json.is_online,
      isSupporter: json.is_supporter,
      loaded: true,
      pmFriendsOnly: json.pm_friends_only,
      profileColour: json.profile_colour,
      username: json.username,
    });
  }

  is(user: User | UserJSON) {
    return user.id === this.id;
  }

  load() {
    // TODO: do automagic loading stuff?
  }

  /**
   * Compatibility so existing UserAvatar component can be used as-is.
   */
  toJSON() {
    return {
      avatar_url: this.avatarUrl,
      country_code: this.countryCode,
      id: this.id,
      is_active: this.isActive,
      is_bot: this.isBot,
      is_online: this.isOnline,
      is_supporter: this.isSupporter,
      pm_friends_only: this.pmFriendsOnly,
      profile_colour: this.profileColour,
      username: this.username,
    };
  }

  @action
  updateFromJSON(json: UserJSON) {
    this.username = json.username;
    this.avatarUrl = json.avatar_url;
    this.profileColour = json.profile_colour;
    this.countryCode = json.country_code;
    this.isSupporter = json.is_supporter;
    this.isActive = json.is_active;
    this.isBot = json.is_bot;
    this.isOnline = json.is_online;
    this.pmFriendsOnly = json.pm_friends_only;
    this.loaded = true;
  }
}
