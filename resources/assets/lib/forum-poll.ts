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
  private container: HTMLCollectionOf<Element>;

  constructor(window: Window) {
    $(window.document).on('click', '.js-forum-poll--switch-page', this.switchPage);
    $(window.document).on('click', '.js-forum-poll--switch-edit', this.switchEdit);

    this.container = window.document.getElementsByClassName('js-forum-poll--container');
  }

  switchEdit = () => {
    const container = this.container[0];

    if (!(container instanceof HTMLElement)) {
      return;
    }

    container.dataset.edit = container.dataset.edit === '0' ? '1' : '0';
  }

  switchPage = (event: JQuery.ClickEvent) => {
    const target = event.currentTarget;

    if (!(target instanceof HTMLElement)) {
      return;
    }

    const container = this.container[0];

    if (!(container instanceof HTMLElement)) {
      return;
    }

    container.dataset.page = target.dataset.targetPage;
  }
}
