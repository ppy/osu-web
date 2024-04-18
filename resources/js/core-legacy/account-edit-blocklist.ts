// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import core from 'osu-core-singleton';
import { trans } from 'utils/lang';

const element = '.block-list__content';
const jsClass = '.js-account-edit-blocklist';

export default class AccountEditBlocklist {
  constructor() {
    $(document).on('click', jsClass, this.toggle);
    $.subscribe('user:update', this.updateBlockCount);
  }

  private readonly toggle = (e: JQuery.ClickEvent) => {
    e.preventDefault();

    $(element).toggleClass('hidden');

    const label = $(element).hasClass('hidden')
      ? trans('common.buttons.show')
      : trans('common.buttons.hide');

    $(jsClass).text(label);
  };

  private readonly updateBlockCount = () => {
    if (core.currentUser == null) return;

    $(`${jsClass}-count`).text(trans('users.blocks.blocked_count', { count: core.currentUser.blocks.length ?? 0 }));
  };
}
