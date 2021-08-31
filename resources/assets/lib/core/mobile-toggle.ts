// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
  };
}
