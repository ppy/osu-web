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

export default class ForumPoll {
  constructor(window: Window) {
    $(window.document).on('click', '.js-forum-poll--switch-page', this.switchPage);
    $(window.document).on('click', '.js-forum-poll--switch-edit', this.switchEdit);
  }

  switchEdit = (event: JQuery.ClickEvent) => {
    const $container = $(event.target).parents('.js-forum-poll--container');

    if ($container.attr('data-edit') === '1') {
      $container.attr('data-edit', '0');

      const form = $(event.target).closest('form')[0];

      if (form != null) {
        form.reset();
      }
    } else {
      $container.attr('data-edit', '1');
    }
  }

  switchPage = (event: JQuery.ClickEvent) => {
    const target = event.currentTarget;

    if (!(target instanceof HTMLElement)) {
      return;
    }

    const targetPage = target.dataset.targetPage;

    if (typeof targetPage === 'string') {
      $(event.target).parents('.js-forum-poll--container').attr('data-page', targetPage);
    }
  }
}
