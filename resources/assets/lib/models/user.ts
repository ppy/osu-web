// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserGroupJson from 'interfaces/user-group-json';
import UserJson from 'interfaces/user-json';
import { action, observable } from 'mobx';
import { trans } from 'osu-common';

export default class User {
  @observable avatarUrl = '/images/layout/avatar-guest.png'; // TODO: move to a global config store?
  @observable countryCode = 'XX';
  @observable defaultGroup = '';
  @observable groups?: UserGroupJson[];
  @observable id: number;
  @observable isActive = false;
  @observable isBot = false;
  @observable isDeleted = false;
  @observable isOnline = false;
  @observable isSupporter = false;
  @observable lastVisit: string | null = null;
  @observable loaded = false;
  @observable pmFriendsOnly = false;
  @observable profileColour = '';
  @observable username = '';

  constructor(id: number) {
    this.id = id;
  }

  static fromJson(json: UserJson): User {
    const user = new User(json.id);
    return Object.assign(user, {
      avatarUrl: json.avatar_url,
      countryCode: json.country_code,
      defaultGroup: json.default_group,
      groups: json.groups,
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

  is(user?: User | UserJson | null) {
    if (user == null) return false;
    return user.id === this.id;
  }

  load() {
    // TODO: do automagic loading stuff?
  }

  /**
   * Compatibility so existing UserAvatar component can be used as-is.
   */
  toJson() {
    return {
      avatar_url: this.avatarUrl,
      country_code: this.countryCode,
      default_group: this.defaultGroup,
      groups: this.groups,
      id: this.id,
      is_active: this.isActive,
      is_bot: this.isBot,
      is_deleted: this.isDeleted,
      is_online: this.isOnline,
      is_supporter: this.isSupporter,
      last_visit: this.lastVisit,
      pm_friends_only: this.pmFriendsOnly,
      profile_colour: this.profileColour,
      username: this.username,
    };
  }

  @action
  updateFromJson(json: UserJson) {
    this.username = json.username;
    this.avatarUrl = json.avatar_url;
    this.profileColour = json.profile_colour ?? '';
    this.countryCode = json.country_code;
    this.isSupporter = json.is_supporter;
    this.isActive = json.is_active;
    this.isBot = json.is_bot;
    this.isOnline = json.is_online;
    this.pmFriendsOnly = json.pm_friends_only;
    this.loaded = true;
  }
}

const deletedUser = new User(-1);
deletedUser.isDeleted = true;
deletedUser.username = trans('users.deleted');

export {
  deletedUser,
};
