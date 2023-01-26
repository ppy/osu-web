// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

export default class SidebarToggle {
  private readonly menuWrapper: Element;
  private readonly navButton: Element;

  constructor() {
    const navButton = document.getElementById('nav-button');
    const menuWrapper = document.querySelector('.tocify-wrapper');

    if (navButton == null || menuWrapper == null) {
      throw new Error('nav button and/or menu wrapper is missing');
    }

    this.navButton = navButton;
    this.menuWrapper = menuWrapper;

    this.navButton.addEventListener('click', this.onClickNavButton);
  }

  private readonly onClickNavButton = () => {
    this.menuWrapper.classList.toggle('open');
    this.navButton.classList.toggle('open');
  };
}
