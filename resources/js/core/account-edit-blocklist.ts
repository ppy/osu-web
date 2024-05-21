// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { reaction } from 'mobx';
import OsuCore from 'osu-core';
import { trans } from 'utils/lang';

const contentClass = '.js-account-edit-blocklist-content';
const countClass = '.js-account-edit-blocklist-count';
const labelClass = '.js-account-edit-blocklist';

export default class AccountEditBlocklist {
  constructor(private readonly core: OsuCore) {
    $(document).on('click', labelClass, this.toggle);
    $(() => reaction(() => this.core.currentUser?.blocks, this.updateBlockCount));
  }

  private readonly toggle = (e: JQuery.ClickEvent) => {
    e.preventDefault();

    $(contentClass).toggleClass('hidden');

    const label = $(contentClass).hasClass('hidden')
      ? trans('common.buttons.show')
      : trans('common.buttons.hide');

    $(labelClass).text(label);
  };

  private readonly updateBlockCount = () => {
    if (this.core.currentUser == null) return;

    $(countClass).text(trans('users.blocks.blocked_count', { count: this.core.currentUser.blocks.length ?? 0 }));
  };
}
