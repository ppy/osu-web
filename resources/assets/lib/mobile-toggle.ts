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

const activeClass = 'js-mobile-toggle--active';

export default class MobileToggle {
  constructor() {
    $(document).on('click', '.js-mobile-toggle', this.toggle);
  }

  toggle = (e: JQuery.ClickEvent) => {
    const button = e.currentTarget;

    if (!(button instanceof HTMLElement)) {
      return;
    }

    const targetId = button.dataset.mobileToggleTarget;

    if (targetId == null) {
      return;
    }

    const target = document.querySelector(`.js-mobile-toggle[data-mobile-toggle-id=${targetId}]`);

    if (!(target instanceof HTMLElement)) {
      return;
    }

    const toActive = !button.classList.contains(activeClass);

    button.classList.toggle(activeClass, toActive);
    target.classList.toggle('hidden-xs', !toActive);
  }
}
