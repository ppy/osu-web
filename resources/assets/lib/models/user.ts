// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserGroupJson from 'interfaces/user-group-json';
import UserJson from 'interfaces/user-json';
import { action, makeObservable, observable } from 'mobx';
import { trans } from 'utils/lang';

export function normaliseUsername(username: string) {
  return username.trim().toLowerCase();
}

export function usernameSortAscending(x: UserJson | User , y: UserJson | User) {
  return x.username.localeCompare(y.username);
}

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
  @observable pmFriendsOnly = false;
  @observable profileColour = '';
  @observable username = '';

  constructor(id: number) {
    this.id = id;

    makeObservable(this);
  }

  is(user?: User | UserJson | null) {
    if (user == null) return false;
    return user.id === this.id;
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
  updateWithJson(json: UserJson) {
    this.avatarUrl = json.avatar_url;
    this.countryCode = json.country_code;
    this.defaultGroup = json.default_group;
    this.isActive = json.is_active;
    this.isBot = json.is_bot;
    this.isOnline = json.is_online;
    this.isSupporter = json.is_supporter;
    this.pmFriendsOnly = json.pm_friends_only;
    this.profileColour= json.profile_colour ?? '';
    this.username = json.username;

    if (json.groups != null) {
      this.groups = json.groups;
    }
  }
}

const deletedUser = new User(-1);
deletedUser.isDeleted = true;
deletedUser.username = trans('users.deleted');

export {
  deletedUser,
};
