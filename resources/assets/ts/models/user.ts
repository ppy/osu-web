/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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

import { action, observable } from 'mobx';

export interface UserJSON {
  id: number;
  username: string;
  avatar_url: string;
  profile_colour: string;
  country_code: string; // maek country
  is_active: boolean;
  is_bot: boolean;
  is_online: boolean;
  is_supporter: boolean;
  pm_friends_only: boolean;
}

export default class User {
  // id: number;
  @observable id: number;
  @observable username: string;
  @observable avatarUrl: string;
  @observable profileColour: string;
  @observable countryCode: string;

  @observable isSupporter: boolean;
  @observable isActive: boolean;
  @observable isBot: boolean;
  @observable isOnline: boolean;

  @observable loaded: boolean = false;

  @observable pmFriendsOnly: boolean = false;

  constructor(id: number) {
    this.id = id;
  }

  load() {
    // TODO: do automagic loading stuff?
  }

  @action
  updateFromJSON(json: UserJSON) {
    // this.id = json.id;
    this.username = json.username;
    this.avatarUrl = json.avatar_url;
    this.profileColour = json.profile_colour;
    this.countryCode = json.country_code;
    this.isSupporter = json.is_supporter;
    this.isActive = json.is_active;
    this.isBot = json.is_bot;
    this.isOnline = json.is_online;
    this.pmFriendsOnly = json.pm_friends_only;
    this.loaded =  true;
  }

  @action
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

  static reviver(key: string, value: any): any {
    return key === '' ? User.fromJSON(value) : value;
  }
}
