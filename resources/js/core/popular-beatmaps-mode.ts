// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

export default class PopularBeatmapsMode {
  constructor() {
    $(document).on('click', '.js-popular-beatmaps-mode', this.onClick);
  }

  private readonly onClick = (event: JQuery.ClickEvent) => {
    const selectedButton = event.currentTarget;
    if (!(selectedButton instanceof HTMLButtonElement)) return;
    
    const container = selectedButton.closest('.js-popular-beatmaps');
    if (!(container instanceof HTMLElement)) return;
    
    const mode = selectedButton.dataset.popularMode;

    for (const button of container.querySelectorAll<HTMLButtonElement>('.js-popular-beatmaps-mode')) {
      button.classList.toggle('game-mode-link--active', button.dataset.popularMode === mode);
    }

    for (const panel of container.querySelectorAll<HTMLElement>('.js-popular-beatmaps-panel')) {
      panel.classList.toggle('u-hidden', panel.dataset.popularPanel !== mode);
    }
  };
}
