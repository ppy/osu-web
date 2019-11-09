/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
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
