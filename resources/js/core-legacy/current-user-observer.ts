// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import CurrentUserJson from 'interfaces/current-user-json';
import { pull } from 'lodash';
import { reaction, toJS } from 'mobx';
import core from 'osu-core-singleton';
import { urlPresence } from 'utils/css';

export default class CurrentUserObserver {
  private readonly avatars = document.getElementsByClassName('js-current-user-avatar');
  private readonly covers = document.getElementsByClassName('js-current-user-cover');

  constructor() {
    $.subscribe('user:update', this.setData);
    $(document).on('turbolinks:load', this.reinit);
    $.subscribe('user:followUserMapping:update', this.updateFollowUserMapping);

    // one time setup to monitor cover url variable. No disposer because nothing destroys this object.
    $(() => reaction(() => core.currentUser?.cover.url, this.setCovers));
  }

  private readonly reinit = () => {
    this.setAvatars();
  };

  private setAvatars() {
    const bgImage = urlPresence(core.currentUser?.avatar_url) ?? '';
    for (const el of this.avatars) {
      if (el instanceof HTMLElement) {
        el.style.backgroundImage = bgImage;
      }
    }
  }

  private readonly setCovers = () => {
    const bgImage = urlPresence(core.currentUser?.cover.url) ?? '';
    for (const el of this.covers) {
      if (el instanceof HTMLElement) {
        el.style.backgroundImage = bgImage;
      }
    }
  };

  private readonly setData = (_event: unknown, data: CurrentUserJson) => {
    window.currentUser = data;
    this.reinit();
  };

  private readonly updateFollowUserMapping = (_event: unknown, data: { following: boolean; userId: number }) => {
    const currentUser = core.currentUser;
    if (currentUser == null) return;

    if (data.following) {
      currentUser.follow_user_mapping.push(data.userId);
    } else {
      pull(currentUser.follow_user_mapping, data.userId);
    }

    if (window.currentUser.id != null) {
      window.currentUser.follow_user_mapping = toJS(currentUser.follow_user_mapping);
    }

    $.publish('user:followUserMapping:refresh');
  };
}
